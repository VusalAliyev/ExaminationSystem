<?php

namespace App\Http\Controllers;

use App\Models\ExamType;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExamTypeController extends Controller
{
    public function index(): View
    {
        $examTypes = ExamType::all();
        return view('exam-types.index', compact('examTypes'));
    }
    public function create()
    {
        return view('exam-types.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Type' => 'required|string|max:255',
        ]);

        ExamType::create($validated);
        return redirect()->route('exam-types.index')->with('success', 'Sınav türü başarıyla oluşturuldu.');
    }
    public function show($id)
    {
        $examType = ExamType::findOrFail($id);
        return view('exam-types.show', compact('examType'));
    }

    public function edit($id)
    {
        $examType = ExamType::findOrFail($id);
        return view('exam-types.edit', compact('examType'));
    }

    public function update(Request $request, $id)
    {
        $examType = ExamType::findOrFail($id);

        $validated = $request->validate([
            'Type' => 'required|string|max:255',
        ]);

        $examType->update($validated);
        return redirect()->route('exam-types.index')->with('success', 'Sınav türü başarıyla güncellendi.');
    }

    public function destroy($id)
    {
        $examType = ExamType::findOrFail($id);
        $examType->delete();
        return redirect()->route('exam-types.index')->with('success', 'Sınav türü başarıyla silindi.');
    }
}
