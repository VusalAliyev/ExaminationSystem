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
            'AnswerContent' => 'required|string',
            'State' => 'required|string|in:Correct,Incorrect',
            'ExamQuestionID' => 'required|exists:exam_questions,id',
        ]);

        ExamAnswer::create($validated);
        return redirect()->route('exam-answers.index')->with('success', 'Cevap başarıyla oluşturuldu.');
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
            'AnswerContent' => 'required|string',
            'State' => 'required|string|in:Correct,Incorrect',
            'ExamQuestionID' => 'required|exists:exam_questions,id',
        ]);

        $answer->update($validated);
        return redirect()->route('exam-answers.index')->with('success', 'Cevap başarıyla güncellendi.');
    }

    public function destroy($id)
    {
        $answer = ExamAnswer::findOrFail($id);
        $answer->delete();
        return redirect()->route('exam-answers.index')->with('success', 'Cevap başarıyla silindi.');
    }
}
