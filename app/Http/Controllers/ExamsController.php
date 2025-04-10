<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamOrganizer;
use App\Models\ExamType;
use App\Models\ExamGroup;
use App\Models\ExamYear;
use App\Models\Sector;
use App\Models\ForeignLanguage;
use App\Models\SelectedSubject;
use Illuminate\Http\Request;

class ExamsController extends Controller
{
    public function index()
    {
        $exams = Exam::with(['organizer', 'type', 'group', 'year', 'sector', 'foreignLanguage', 'selected_subject'])->get();
        return view('admin.exams.index', compact('exams'));
    }

    // Yeni sınav oluşturma formunu gösterir
    public function create()
    {
        $organizers = ExamOrganizer::all();
        $types = ExamType::all();
        $groups = ExamGroup::all();
        $years = ExamYear::all();
        $sectors = Sector::all();
        $foreignLanguages = ForeignLanguage::all();
        $selectedSubjects = SelectedSubject::all();

        return view('admin.exams.create', compact('organizers', 'types', 'groups', 'years', 'sectors', 'foreignLanguages', 'selectedSubjects'));
    }

    // Yeni sınavı kaydeder
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'exam_organizer_id' => 'required|exists:exam_organizers,id',
            'exam_type_id' => 'required|exists:exam_types,id',
            'exam_group_id' => 'required|exists:exam_groups,id',
            'exam_year_id' => 'required|exists:exam_years,id',
            'sector_id' => 'required|exists:sectors,id',
            'foreign_language_id' => 'nullable|exists:foreign_languages,id',
            'selected_subject_id' => 'nullable|exists:selected_subjects,id',
        ]);

        Exam::create($validated);
        return redirect()->route('exams.index')->with('success', 'İmtahan uğurla yaradıldı.');
    }

    public function show($id)
    {
        $exam = Exam::with(['organizer', 'type', 'group', 'year', 'sector', 'foreignLanguage', 'selectedSubject'])->findOrFail($id);
        return view('admin.exams.show', compact('exam'));
    }

    public function edit($id)
    {
        $exam = Exam::findOrFail($id);
        $organizers = ExamOrganizer::all();
        $types = ExamType::all();
        $groups = ExamGroup::all();
        $years = ExamYear::all();
        $sectors = Sector::all();
        $foreignLanguages = ForeignLanguage::all();
        $selectedSubjects = SelectedSubject::all();

        return view('admin.exams.edit', compact('exam', 'organizers', 'types', 'groups', 'years', 'sectors', 'foreignLanguages', 'selectedSubjects'));
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
            'sector_id' => 'required|exists:sectors,id',
            'foreign_language_id' => 'nullable|exists:foreign_languages,id',
            'selected_subject_id' => 'nullable|exists:selected_subjects,id',
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
