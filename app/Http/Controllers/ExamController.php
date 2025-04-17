<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\ExamAnswer;
use App\Models\ExamResult;
use App\Models\UserAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ExamController extends Controller
{
    public function show($id)
    {
        // İmtahanı əlaqəli məlumatlarla çək
        $exam = Exam::with(['organizer', 'year', 'group', 'type', 'foreignLanguage'])->findOrFail($id);

        // Seçilmiş fənn session’dan alınıb
        $selectedSubject = session('selected_subject', null);

        // Hata ayıklama için log
        \Log::info('ExamController@show', [
            'exam_id' => $id,
            'selected_subject' => $selectedSubject,
        ]);

        // İmtahan türüne ve grubuna göre fennleri belirle
        $examQuestionController = new ExamQuestionController();
        $subjects = $examQuestionController->getSubjectsForExam($exam, $selectedSubject);

        // $subjects dizisini bir koleksiyona dönüştür
        $subjectsCollection = collect($subjects);

        // Hata ayıklama için log
        \Log::info('Subjects for Exam', [
            'exam_id' => $id,
            'subjects' => $subjectsCollection->pluck('name')->toArray(),
        ]);

        // View-a məlumatları göndər
        return view('exam', compact('exam', 'subjects'));
    }

    public function finish(Request $request, $id)
    {
        // İmtahanı çək
        $exam = Exam::findOrFail($id);
        $user = auth()->user();

        // İmtahanın suallarını çək
        $questions = ExamQuestion::where('exam_id', $id)->with('answers')->get();

        // Maksimum balı hesabla (bütün sualların ballarının cəmi)
        $maxScore = $questions->sum('point');

        // Tələbənin cavablarını əldə et
        $answers = $request->input('answers', []); // AJAX isteğinden gelen cevaplar

        // Ümumi balı hesablamaq üçün dəyişənlər
        $totalScore = 0;
        $correctAnswers = 0;
        $wrongAnswers = 0;

        // Hər sual üçün cavabı yoxla və saxla
        foreach ($answers as $questionId => $answerId) {
            $question = ExamQuestion::find($questionId);
            $answer = ExamAnswer::find($answerId);

            if ($question && $answer) {
                // Cavabı UserAnswer cədvəlinə saxla
                UserAnswer::create([
                    'user_id' => $user->id,
                    'exam_id' => $exam->id,
                    'question_id' => $question->id,
                    'answer_id' => $answer->id,
                ]);

                // Əgər cavab düzgündürsə, balı əlavə et
                if ($answer->state === 'Correct') {
                    $totalScore += $question->point;
                    $correctAnswers++;
                } else {
                    $wrongAnswers++;
                }
            }
        }

        // Nəticəni exam_results cədvəlinə yaz
        $examResult = ExamResult::create([
            'user_id' => $user->id,
            'exam_id' => $exam->id,
            'total_score' => $totalScore,
            'correct_answers' => $correctAnswers,
            'wrong_answers' => $wrongAnswers,
            'max_score' => $maxScore,
            'completed_at' => now(),
        ]);

        // JSON yanıtı döndür (AJAX için)
        return response()->json([
            'message' => 'Sınav tamamlandı!',
            'total_score' => $totalScore,
            'correct_answers' => $correctAnswers,
            'wrong_answers' => $wrongAnswers,
            'max_score' => $maxScore,
        ]);
    }
}
