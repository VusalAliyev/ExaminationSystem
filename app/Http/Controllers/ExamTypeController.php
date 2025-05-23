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
        return view('admin.exam-types.index', compact('examTypes'));
    }

    public function create()
    {
        return view('admin.exam-types.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255', // 'Type' -> 'type'
        ]);

        ExamType::create($validated);
        return redirect()->route('exam-types.index')->with('success', 'Sınav türü başarıyla oluşturuldu.');
    }

    public function show($id)
    {
        $examType = ExamType::findOrFail($id);
        return view('admin.exam-types.show', compact('examType'));
    }

    public function edit($id)
    {
        $examType = ExamType::findOrFail($id);
        return view('admin.exam-types.edit', compact('examType'));
    }

    public function update(Request $request, $id)
    {
        $examType = ExamType::findOrFail($id);

        $validated = $request->validate([
            'type' => 'required|string|max:255', // 'Type' -> 'type'
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
