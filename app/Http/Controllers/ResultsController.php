<?php

namespace App\Http\Controllers;

use App\Models\UserAnswer;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\ExamResult;

class ResultsController extends Controller
{
    public function show($examId)
    {
        // İstifadəçi məlumatını çək
        $user = auth()->user();

        // İmtahanı çək
        $exam = Exam::with(['organizer', 'year', 'group', 'type'])->findOrFail($examId);

        // Tələbənin bu imtahandan nəticəsini çək
        $result = ExamResult::where('userId', $user->id)
            ->where('examId', $examId)
            ->latest('completedAt')
            ->firstOrFail();

        // Tələbənin cavablarını çək
        $userAnswers = UserAnswer::where('userId', $user->id)
            ->where('examId', $examId)
            ->with(['question', 'answer'])
            ->get();

        // View-a məlumatları göndər
        return view('results', compact('exam', 'result', 'user', 'userAnswers'));
    }
}
