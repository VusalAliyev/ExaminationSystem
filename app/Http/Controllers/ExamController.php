<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamOrganizer;
use App\Models\ExamType;
use App\Models\ExamGroup;
use App\Models\ExamYear;
use Illuminate\Http\Request;
class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::with(['organizer', 'type', 'group', 'year'])->get();
        return view('exams.index', compact('exams'));
    }

    public function create()
    {
        $organizers = ExamOrganizer::all();
        $types = ExamType::all();
        $groups = ExamGroup::all();
        $years = ExamYear::all();
        return view('exams.create', compact('organizers', 'types', 'groups', 'years'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Name' => 'required|string|max:255',
            'ExamOrganizerID' => 'required|exists:exam_organizers,id',
            'ExamTypeID' => 'required|exists:exam_types,id',
            'ExamGroupID' => 'required|exists:exam_groups,id',
            'ExamYearID' => 'required|exists:exam_years,id',
        ]);

        Exam::create($validated);
        return redirect()->route('exams.index')->with('success', 'Sınav başarıyla oluşturuldu.');
    }

    public function show($id)
    {
        $exam = Exam::with(['organizer', 'type', 'group', 'year'])->findOrFail($id);
        return view('exams.show', compact('exam'));
    }

    public function edit($id)
    {
        $exam = Exam::findOrFail($id);
        $organizers = ExamOrganizer::all();
        $types = ExamType::all();
        $groups = ExamGroup::all();
        $years = ExamYear::all();
        return view('exams.edit', compact('exam', 'organizers', 'types', 'groups', 'years'));
    }

    public function update(Request $request, $id)
    {
        $exam = Exam::findOrFail($id);

        $validated = $request->validate([
            'Name' => 'required|string|max:255',
            'ExamOrganizerID' => 'required|exists:exam_organizers,id',
            'ExamTypeID' => 'required|exists:exam_types,id',
            'ExamGroupID' => 'required|exists:exam_groups,id',
            'ExamYearID' => 'required|exists:exam_years,id',
        ]);

        $exam->update($validated);
        return redirect()->route('exams.index')->with('success', 'Sınav başarıyla güncellendi.');
    }

    public function destroy($id)
    {
        $exam = Exam::findOrFail($id);
        $exam->delete();
        return redirect()->route('exams.index')->with('success', 'Sınav başarıyla silindi.');
    }
}
