<?php

namespace App\Http\Controllers;

use App\Models\ExamYear;
use Illuminate\Http\Request;

class ExamYearController extends Controller
{
    public function index()
    {
        $examYears = ExamYear::all();
        return view('admin.exam-years.index', compact('examYears'));
    }

    public function create()
    {
        return view('admin.exam-years.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Year' => 'required|integer|min:1900|max:9999',
        ]);

        ExamYear::create($validated);
        return redirect()->route('exam-years.index')->with('success', 'Sınav yılı başarıyla oluşturuldu.');
    }

    public function show($id)
    {
        $examYear = ExamYear::findOrFail($id);
        return view('admin.exam-years.show', compact('examYear'));
    }

    public function edit($id)
    {
        $examYear = ExamYear::findOrFail($id);
        return view('admin.exam-years.edit', compact('examYear'));
    }

    public function update(Request $request, $id)
    {
        $examYear = ExamYear::findOrFail($id);

        $validated = $request->validate([
            'Year' => 'required|integer|min:1900|max:9999',
        ]);

        $examYear->update($validated);
        return redirect()->route('exam-years.index')->with('success', 'Sınav yılı başarıyla güncellendi.');
    }

    public function destroy($id)
    {
        $examYear = ExamYear::findOrFail($id);
        $examYear->delete();
        return redirect()->route('exam-years.index')->with('success', 'Sınav yılı başarıyla silindi.');
    }
}
