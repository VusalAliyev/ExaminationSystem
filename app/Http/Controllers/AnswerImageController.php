<?php

namespace App\Http\Controllers;

use App\Models\AnswerImage;
use App\Models\ExamAnswer;
use Illuminate\Http\Request;

class AnswerImageController extends Controller
{
    public function index()
    {
        $images = AnswerImage::with('answer')->get();
        return view('answer-images.index', compact('images'));
    }

    public function create()
    {
        $answers = ExamAnswer::all();
        return view('answer-images.create', compact('answers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ImagePath' => 'required|string',
            'ExamAnswerID' => 'required|exists:exam_answers,id',
        ]);

        AnswerImage::create($validated);
        return redirect()->route('answer-images.index')->with('success', 'Cevap resmi başarıyla oluşturuldu.');
    }

    public function show($id)
    {
        $image = AnswerImage::with('answer')->findOrFail($id);
        return view('answer-images.show', compact('image'));
    }

    public function edit($id)
    {
        $image = AnswerImage::findOrFail($id);
        $answers = ExamAnswer::all();
        return view('answer-images.edit', compact('image', 'answers'));
    }

    public function update(Request $request, $id)
    {
        $image = AnswerImage::findOrFail($id);

        $validated = $request->validate([
            'ImagePath' => 'required|string',
            'ExamAnswerID' => 'required|exists:exam_answers,id',
        ]);

        $image->update($validated);
        return redirect()->route('answer-images.index')->with('success', 'Cevap resmi başarıyla güncellendi.');
    }

    public function destroy($id)
    {
        $image = AnswerImage::findOrFail($id);
        $image->delete();
        return redirect()->route('answer-images.index')->with('success', 'Cevap resmi başarıyla silindi.');
    }
}
