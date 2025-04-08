<?php

namespace App\Http\Controllers;

use App\Models\ExamQuestion;
use App\Models\Exam;
use App\Models\ExamSubject;
use Illuminate\Http\Request;

class ExamQuestionController extends Controller
{
    public function index()
    {
        $questions = ExamQuestion::with(['exam', 'subject'])->get();
        return view('admin.exam-questions.index', compact('questions'));
    }

    public function create()
    {
        $exams = Exam::all();
        $subjects = ExamSubject::all();
        return view('admin.exam-questions.create', compact('exams', 'subjects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question_content' => 'required|string',
            'point' => 'required|integer|min:0',
            'exam_subject_id' => 'required|exists:exam_subjects,id',
            'exam_id' => 'required|exists:exams,id',
        ]);

        ExamQuestion::create($validated);
        return redirect()->route('exam-questions.index')->with('success', 'Sual uğurla yaradıldı.');
    }

    public function show($id)
    {
        $question = ExamQuestion::with(['exam', 'subject'])->findOrFail($id);
        return view('admin.exam-questions.show', compact('question'));
    }

    public function edit($id)
    {
        $question = ExamQuestion::findOrFail($id);
        $exams = Exam::all();
        $subjects = ExamSubject::all();
        return view('admin.exam-questions.edit', compact('question', 'exams', 'subjects'));
    }

    public function update(Request $request, $id)
    {
        $question = ExamQuestion::findOrFail($id);

        $validated = $request->validate([
            'question_content' => 'required|string',
            'point' => 'required|integer|min:0',
            'exam_subject_id' => 'required|exists:exam_subjects,id',
            'exam_id' => 'required|exists:exams,id',
        ]);

        $question->update($validated);
        return redirect()->route('exam-questions.index')->with('success', 'Sual uğurla yeniləndi.');
    }

    public function destroy($id)
    {
        $question = ExamQuestion::findOrFail($id);
        $question->delete();
        return redirect()->route('exam-questions.index')->with('success', 'Sual uğurla silindi.');
    }
}
