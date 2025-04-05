<?php

namespace App\Http\Controllers;

use App\Models\ExamSubject;
use Illuminate\Http\Request;

class ExamSubjectController extends Controller
{
    public function index()
    {
        $examSubjects = ExamSubject::all();
        return view('exam-subjects.index', compact('examSubjects'));
    }

    public function create()
    {
        return view('exam-subjects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Name' => 'required|string|max:255',
        ]);

        ExamSubject::create($validated);
        return redirect()->route('exam-subjects.index')->with('success', 'Sınav konusu başarıyla oluşturuldu.');
    }

    public function show($id)
    {
        $examSubject = ExamSubject::findOrFail($id);
        return view('exam-subjects.show', compact('examSubject'));
    }

    public function edit($id)
    {
        $examSubject = ExamSubject::findOrFail($id);
        return view('exam-subjects.edit', compact('examSubject'));
    }

    public function update(Request $request, $id)
    {
        $examSubject = ExamSubject::findOrFail($id);

        $validated = $request->validate([
            'Name' => 'required|string|max:255',
        ]);

        $examSubject->update($validated);
        return redirect()->route('exam-subjects.index')->with('success', 'Sınav konusu başarıyla güncellendi.');
    }

    public function destroy($id)
    {
        $examSubject = ExamSubject::findOrFail($id);
        $examSubject->delete();
        return redirect()->route('exam-subjects.index')->with('success', 'Sınav konusu başarıyla silindi.');
    }
}
