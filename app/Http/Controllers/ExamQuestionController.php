<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\ExamAnswer;
use App\Models\QuestionImage;
use App\Models\AnswerImage;
use App\Models\ExamSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ExamQuestionController extends Controller
{
    public function index()
    {
        $exams = Exam::with(['organizer', 'type', 'group', 'year', 'sector', 'foreignLanguage'])->get();
        return view('admin.exam-questions.index', compact('exams'));
    }

    public function create($examId)
    {
        $exam = Exam::with(['type', 'group', 'foreignLanguage'])->findOrFail($examId);

        // İmtahan türüne ve grubuna göre fennleri belirle
        $subjects = $this->getSubjectsForExam($exam);

        return view('admin.exam-questions.create', compact('exam', 'subjects'));
    }

    public function getQuestionsBySubject(Request $request, $examId, $subjectId)
    {
        try {
            // Sınav ve fennin varlığını kontrol et
            $exam = Exam::find($examId);
            if (!$exam) {
                Log::error('Exam not found', ['exam_id' => $examId]);
                return response()->json(['error' => 'Sınav bulunamadı'], 404);
            }

            $subject = ExamSubject::find($subjectId);
            if (!$subject) {
                Log::error('Subject not found', ['subject_id' => $subjectId]);
                return response()->json(['error' => 'Fənn bulunamadı'], 404);
            }

            // Soruları çek
            $questions = ExamQuestion::where('exam_id', $examId)
                ->where('exam_subject_id', $subjectId)
                ->with(['answers', 'questionImages'])
                ->get();

            // Soruların varlığını kontrol et
            if ($questions->isEmpty()) {
                Log::info('No questions found for exam and subject', [
                    'exam_id' => $examId,
                    'subject_id' => $subjectId,
                ]);
                return response()->json([]);
            }

            // Hata ayıklama için log
            Log::info('getQuestionsBySubject - Questions retrieved successfully', [
                'exam_id' => $examId,
                'subject_id' => $subjectId,
                'questions_count' => $questions->count(),
                'questions' => $questions->toArray(),
            ]);

            return response()->json($questions);
        } catch (\Exception $e) {
            // Hata durumunda logla ve hata mesajını döndür
            Log::error('Error in getQuestionsBySubject', [
                'exam_id' => $examId,
                'subject_id' => $subjectId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json(['error' => 'Sorular yüklenirken bir hata oluştu'], 500);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'exam_subject_id' => 'required|exists:exam_subjects,id',
            'questions' => 'required|array',
            'questions.*.question_content' => 'required|string',
            'questions.*.point' => 'required|numeric|min:0',
            'questions.*.question_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'questions.*.answers' => 'required|array',
            'questions.*.answers.*.content' => 'required|string',
            'questions.*.answers.*.state' => 'required|boolean',
            'questions.*.answers.*.images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        foreach ($validated['questions'] as $index => $questionData) {
            // Soruyu oluştur
            $question = ExamQuestion::create([
                'exam_id' => $validated['exam_id'],
                'exam_subject_id' => $validated['exam_subject_id'],
                'question_content' => $questionData['question_content'],
                'point' => $questionData['point'],
            ]);

            // Soru resimlerini kaydet
            if (isset($questionData['question_images']) && $request->hasFile("questions.{$index}.question_images")) {
                foreach ($request->file("questions.{$index}.question_images") as $image) {
                    $path = $image->store('question_images', 'public');
                    QuestionImage::create([
                        'exam_question_id' => $question->id,
                        'image_path' => $path,
                    ]);
                }
            }

            // Cevapları ve cevap resimlerini kaydet
            foreach ($questionData['answers'] as $answerIndex => $answerData) {
                $answer = ExamAnswer::create([
                    'exam_question_id' => $question->id,
                    'answer_content' => $answerData['content'],
                    'state' => $answerData['state'],
                ]);

                if (isset($answerData['images']) && $request->file("questions.{$index}.answers.{$answerIndex}.images")) {
                    foreach ($request->file("questions.{$index}.answers.{$answerIndex}.images") as $image) {
                        $path = $image->store('answer_images', 'public');
                        AnswerImage::create([
                            'exam_answer_id' => $answer->id,
                            'image_path' => $path,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('exam-questions.index')->with('success', 'Sual(lar) uğurla əlavə edildi.');
    }

    // İmtahan türüne ve grubuna göre fennleri belirleyen yardımcı metod
    public function getSubjectsForExam($exam, $selectedSubject = null)
    {
        $subjects = [];

        // Fenn isimleri ve ID'leri
        $subjectNames = [
            'Azərbaycan Dili' => ExamSubject::where('name', 'Azərbaycan Dili')->first(),
            'Riyaziyyat' => ExamSubject::where('name', 'Riyaziyyat')->first(),
            'İngilis Dili' => ExamSubject::where('name', 'İngilis Dili')->first(),
            'Rus Dili' => ExamSubject::where('name', 'Rus Dili')->first(),
            'Fizika' => ExamSubject::where('name', 'Fizika')->first(),
            'Kimya' => ExamSubject::where('name', 'Kimya')->first(),
            'Azərbaycan Tarixi' => ExamSubject::where('name', 'Azərbaycan Tarixi')->first(),
            'Coğrafiya' => ExamSubject::where('name', 'Coğrafiya')->first(),
            'Ədəbiyyat' => ExamSubject::where('name', 'Ədəbiyyat')->first(),
            'Tarix' => ExamSubject::where('name', 'Tarix')->first(),
            'Biologiya' => ExamSubject::where('name', 'Biologiya')->first(),
            'İnformatika' => ExamSubject::where('name', 'İnformatika')->first(),
        ];

        $examType = $exam->type->type;
        $examGroup = $exam->group->group_name;
        $foreignLanguage = $exam->foreignLanguage ? trim($exam->foreignLanguage->name) : 'İngilis Dili';

        if ($examType === 'Buraxılış') {
            $subjects = [
                $subjectNames['Azərbaycan Dili'],
                $subjectNames[$foreignLanguage === 'İngilis Dili' ? 'İngilis Dili' : 'Rus Dili'],
                $subjectNames['Riyaziyyat'],
            ];
        } elseif ($examType === 'Blok') {
            if ($examGroup === '1') {
                if ($selectedSubject === 'KF') {
                    $subjects = [
                        $subjectNames['Riyaziyyat'],
                        $subjectNames['Fizika'],
                        $subjectNames['Kimya'],
                    ];
                } elseif ($selectedSubject === 'IF') {
                    $subjects = [
                        $subjectNames['Riyaziyyat'],
                        $subjectNames['Fizika'],
                        $subjectNames['İnformatika'],
                    ];
                } else {
                    $subjects = [
                        $subjectNames['Riyaziyyat'],
                        $subjectNames['Fizika'],
                        $subjectNames['Kimya'], // Varsayılan olarak KF
                    ];
                }
            } elseif ($examGroup === '2') {
                $subjects = [
                    $subjectNames['Riyaziyyat'],
                    $subjectNames['Azərbaycan Tarixi'],
                    $subjectNames['Coğrafiya'],
                ];
            } elseif ($examGroup === '3') {
                if ($selectedSubject === 'CT') {
                    $subjects = [
                        $subjectNames['Azərbaycan Dili'],
                        $subjectNames['Coğrafiya'],
                        $subjectNames['Tarix'],
                    ];
                } elseif ($selectedSubject === 'ƏT') {
                    $subjects = [
                        $subjectNames['Azərbaycan Dili'],
                        $subjectNames['Ədəbiyyat'],
                        $subjectNames['Tarix'],
                    ];
                } else {
                    $subjects = [
                        $subjectNames['Azərbaycan Dili'],
                        $subjectNames['Ədəbiyyat'], // Varsayılan olarak ƏT
                        $subjectNames['Tarix'],
                    ];
                }
            } elseif ($examGroup === '4') {
                $subjects = [
                    $subjectNames['Biologiya'],
                    $subjectNames['Fizika'],
                    $subjectNames['Kimya'],
                ];
            }
        } elseif ($examType === 'Hamısı') {
            if ($examGroup === '1') {
                $subjects = [
                    $subjectNames['Azərbaycan Dili'],
                    $subjectNames['Riyaziyyat'],
                    $subjectNames['Fizika'],
                    $subjectNames['Kimya'],
                    $subjectNames[$foreignLanguage === 'İngilis Dili' ? 'İngilis Dili' : 'Rus Dili'],
                ];
            } elseif ($examGroup === '2') {
                $subjects = [
                    $subjectNames['Azərbaycan Dili'],
                    $subjectNames['Riyaziyyat'],
                    $subjectNames['Coğrafiya'],
                    $subjectNames['Azərbaycan Tarixi'],
                    $subjectNames[$foreignLanguage === 'İngilis Dili' ? 'İngilis Dili' : 'Rus Dili'],
                ];
            } elseif ($examGroup === '3') {
                $subjects = [
                    $subjectNames['Azərbaycan Dili'],
                    $subjectNames['Riyaziyyat'],
                    $subjectNames['Ədəbiyyat'],
                    $subjectNames['Tarix'],
                    $subjectNames[$foreignLanguage === 'İngilis Dili' ? 'İngilis Dili' : 'Rus Dili'],
                ];
            } elseif ($examGroup === '4') {
                $subjects = [
                    $subjectNames['Azərbaycan Dili'],
                    $subjectNames['Riyaziyyat'],
                    $subjectNames['Fizika'],
                    $subjectNames['Kimya'],
                    $subjectNames['Biologiya'],
                    $subjectNames[$foreignLanguage === 'İngilis Dili' ? 'İngilis Dili' : 'Rus Dili'],
                ];
            }
        }

        return array_filter($subjects); // Null değerleri filtrele
    }
}
