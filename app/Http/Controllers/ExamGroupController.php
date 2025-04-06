<?php

namespace App\Http\Controllers;
use App\Models\ExamGroup;
use Illuminate\Http\Request;

class ExamGroupController extends Controller
{
    public function index()
    {
        $examGroups = ExamGroup::all();
        return view('admin.exam-groups.index', compact('examGroups'));
    }

    public function create()
    {
        return view('admin.exam-groups.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'GroupNumber' => 'required|string|max:255',
        ]);

        ExamGroup::create($validated);
        return redirect()->route('exam-groups.index')->with('success', 'Sınav grubu başarıyla oluşturuldu.');
    }

    public function show($id)
    {
        $examGroup = ExamGroup::findOrFail($id);
        return view('admin.exam-groups.show', compact('examGroup'));
    }

    public function edit($id)
    {
        $examGroup = ExamGroup::findOrFail($id);
        return view('admin.exam-groups.edit', compact('examGroup'));
    }

    public function update(Request $request, $id)
    {
        $examGroup = ExamGroup::findOrFail($id);

        $validated = $request->validate([
            'GroupNumber' => 'required|string|max:255',
        ]);

        $examGroup->update($validated);
        return redirect()->route('exam-groups.index')->with('success', 'Sınav grubu başarıyla güncellendi.');
    }

    public function destroy($id)
    {
        $examGroup = ExamGroup::findOrFail($id);
        $examGroup->delete();
        return redirect()->route('exam-groups.index')->with('success', 'Sınav grubu başarıyla silindi.');
    }
}
