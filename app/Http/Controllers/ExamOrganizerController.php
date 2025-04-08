<?php

namespace App\Http\Controllers;

use App\Models\ExamOrganizer;
use Illuminate\Http\Request;

class ExamOrganizerController extends Controller
{
    public function index()
    {
        $examOrganizers = ExamOrganizer::all();
        return view('admin.exam-organizers.index', compact('examOrganizers'));
    }

    public function create()
    {
        return view('admin.exam-organizers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        ExamOrganizer::create($validated);
        return redirect()->route('exam-organizers.index')->with('success', 'Təşkilatçı uğurla yaradıldı.');
    }

    public function show($id)
    {
        $examOrganizer = ExamOrganizer::findOrFail($id);
        return view('admin.exam-organizers.show', compact('examOrganizer'));
    }

    public function edit($id)
    {
        $examOrganizer = ExamOrganizer::findOrFail($id);
        return view('admin.exam-organizers.edit', compact('examOrganizer'));
    }

    public function update(Request $request, $id)
    {
        $examOrganizer = ExamOrganizer::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $examOrganizer->update($validated);
        return redirect()->route('exam-organizers.index')->with('success', 'Təşkilatçı uğurla yeniləndi.');
    }

    public function destroy($id)
    {
        $examOrganizer = ExamOrganizer::findOrFail($id);
        $examOrganizer->delete();
        return redirect()->route('exam-organizers.index')->with('success', 'Təşkilatçı uğurla silindi.');
    }
}
