<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamAnswer;
use App\Models\ExamQuestion;
use App\Models\ExamResult;
use App\Models\UserAnswer;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function show($id)
    {
        // İmtahanı əlaqəli məlumatlarla çək
        $exam = Exam::with(['organizer', 'year', 'group', 'type'])->findOrFail($id);

        // İmtahanın suallarını çək
        $questions = ExamQuestion::where('exam_id', $id)->with('answers')->get();

        // İstifadəçi məlumatını çək
        $user = auth()->user();

        // View-a məlumatları göndər
        return view('exam', compact('exam', 'questions', 'user'));
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
        $answers = $request->input('answer', []);

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

        // Nəticə səhifəsinə yönləndir
        return redirect()->route('results', $exam->id);
    }
}
