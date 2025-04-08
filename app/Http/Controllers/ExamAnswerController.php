<?php

namespace App\Http\Controllers;

use App\Models\ExamAnswer;
use App\Models\ExamQuestion;
use Illuminate\Http\Request;

class ExamAnswerController extends Controller
{
    public function index()
    {
        $answers = ExamAnswer::with('question')->get();
        return view('admin.exam-answers.index', compact('answers'));
    }

    public function create()
    {
        $questions = ExamQuestion::all();
        return view('admin.exam-answers.create', compact('questions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'answer_content' => 'required|string',
            'state' => 'required|string|in:Correct,Incorrect',
            'exam_question_id' => 'required|exists:exam_questions,id',
        ]);

        ExamAnswer::create($validated);
        return redirect()->route('exam-answers.index')->with('success', 'Cavab uğurla yaradıldı.');
    }

    public function show($id)
    {
        $answer = ExamAnswer::with('question')->findOrFail($id);
        return view('admin.exam-answers.show', compact('answer'));
    }

    public function edit($id)
    {
        $answer = ExamAnswer::findOrFail($id);
        $questions = ExamQuestion::all();
        return view('admin.exam-answers.edit', compact('answer', 'questions'));
    }

    public function update(Request $request, $id)
    {
        $answer = ExamAnswer::findOrFail($id);

        $validated = $request->validate([
            'answer_content' => 'required|string',
            'state' => 'required|string|in:Correct,Incorrect',
            'exam_question_id' => 'required|exists:exam_questions,id',
        ]);

        $answer->update($validated);
        return redirect()->route('exam-answers.index')->with('success', 'Cavab uğurla yeniləndi.');
    }

    public function destroy($id)
    {
        $answer = ExamAnswer::findOrFail($id);
        $answer->delete();
        return redirect()->route('exam-answers.index')->with('success', 'Cavab uğurla silindi.');
    }
}
