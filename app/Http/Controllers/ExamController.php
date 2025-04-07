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
        $questions = ExamQuestion::where('examId', $id)->with('answers')->get();

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
        $questions = ExamQuestion::where('examId', $id)->get();

        // Maksimum balı hesabla (bütün sualların ballarının cəmi)
        $maxScore = $questions->sum('point');

        // Tələbənin cavablarını əldə et
        $answers = $request->input('answer', []);

        // Ümumi balı hesablamaq üçün dəyişənlər
        $totalScore = 0;
        $correctAnswers = 0;
        $wrongAnswers = 0;

        // Hər sual üçün cavabı yoxla
        foreach ($answers as $questionId => $answerId) {
            $question = ExamQuestion::find($questionId);
            $answer = ExamAnswer::find($answerId);

            if ($question && $answer) {
                // Cavabı saxla
                UserAnswer::create([
                    'userId' => $user->id,
                    'examId' => $exam->id,
                    'questionId' => $question->id,
                    'answerId' => $answer->id,
                ]);

                // Əgər cavab düzgündürsə, balı əlavə et
                if ($answer->isCorrect) {
                    $totalScore += $question->point;
                    $correctAnswers++;
                } else {
                    $wrongAnswers++;
                }
            }
        }

        // Nəticəni exam_results cədvəlinə yaz
        $examResult = ExamResult::create([
            'userId' => $user->id,
            'examId' => $exam->id,
            'totalScore' => $totalScore,
            'correctAnswers' => $correctAnswers,
            'wrongAnswers' => $wrongAnswers,
            'maxScore' => $maxScore,
            'completedAt' => now(),
        ]);

        // Nəticə səhifəsinə yönləndir
        return redirect()->route('results', $exam->id);
    }
}
