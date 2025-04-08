<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamOrganizer;
use App\Models\ExamType;
use App\Models\ExamGroup;
use App\Models\ExamYear;
use Illuminate\Http\Request;

class ExamsController extends Controller
{
    public function index()
    {
        $exams = Exam::with(['organizer', 'type', 'group', 'year'])->get();
        return view('admin.exams.index', compact('exams'));
    }

    public function create()
    {
        $organizers = ExamOrganizer::all();
        $types = ExamType::all();
        $groups = ExamGroup::all();
        $years = ExamYear::all();
        return view('admin.exams.create', compact('organizers', 'types', 'groups', 'years'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'exam_organizer_id' => 'required|exists:exam_organizers,id',
            'exam_type_id' => 'required|exists:exam_types,id',
            'exam_group_id' => 'required|exists:exam_groups,id',
            'exam_year_id' => 'required|exists:exam_years,id',
        ]);

        Exam::create($validated);
        return redirect()->route('exams.index')->with('success', 'İmtahan uğurla yaradıldı.');
    }

    public function show($id)
    {
        $exam = Exam::with(['organizer', 'type', 'group', 'year'])->findOrFail($id);
        return view('admin.exams.show', compact('exam'));
    }

    public function edit($id)
    {
        $exam = Exam::findOrFail($id);
        $organizers = ExamOrganizer::all();
        $types = ExamType::all();
        $groups = ExamGroup::all();
        $years = ExamYear::all();
        return view('admin.exams.edit', compact('exam', 'organizers', 'types', 'groups', 'years'));
    }

    public function update(Request $request, $id)
    {
        $exam = Exam::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'exam_organizer_id' => 'required|exists:exam_organizers,id',
            'exam_type_id' => 'required|exists:exam_types,id',
            'exam_group_id' => 'required|exists:exam_groups,id',
            'exam_year_id' => 'required|exists:exam_years,id',
        ]);

        $exam->update($validated);
        return redirect()->route('exams.index')->with('success', 'İmtahan uğurla yeniləndi.');
    }

    public function destroy($id)
    {
        $exam = Exam::findOrFail($id);
        $exam->delete();
        return redirect()->route('exams.index')->with('success', 'İmtahan uğurla silindi.');
    }
}
