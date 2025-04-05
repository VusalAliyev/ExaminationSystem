<?php

namespace App\Http\Controllers;

use App\Models\QuestionImage;
use App\Models\ExamQuestion;
use Illuminate\Http\Request;

class QuestionImageController extends Controller
{
    public function index()
    {
        $images = QuestionImage::with('question')->get();
        return view('question-images.index', compact('images'));
    }

    public function create()
    {
        $questions = ExamQuestion::all();
        return view('question-images.create', compact('questions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ImagePath' => 'required|string',
            'ExamQuestionID' => 'required|exists:exam_questions,id',
        ]);

        QuestionImage::create($validated);
        return redirect()->route('question-images.index')->with('success', 'Soru resmi başarıyla oluşturuldu.');
    }

    public function show($id)
    {
        $image = QuestionImage::with('question')->findOrFail($id);
        return view('question-images.show', compact('image'));
    }

    public function edit($id)
    {
        $image = QuestionImage::findOrFail($id);
        $questions = ExamQuestion::all();
        return view('question-images.edit', compact('image', 'questions'));
    }

    public function update(Request $request, $id)
    {
        $image = QuestionImage::findOrFail($id);

        $validated = $request->validate([
            'ImagePath' => 'required|string',
            'ExamQuestionID' => 'required|exists:exam_questions,id',
        ]);

        $image->update($validated);
        return redirect()->route('question-images.index')->with('success', 'Soru resmi başarıyla güncellendi.');
    }

    public function destroy($id)
    {
        $image = QuestionImage::findOrFail($id);
        $image->delete();
        return redirect()->route('question-images.index')->with('success', 'Soru resmi başarıyla silindi.');
    }
}
