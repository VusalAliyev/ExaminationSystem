<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamGroup;
use App\Models\ExamOrganizer;
use App\Models\ExamType;
use App\Models\ExamYear;
use App\Models\Sector;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        // Filtreleme parametrelerini al
        $search = $request->input('search');
        $year = $request->input('year');
        $group = $request->input('group');
        $type = $request->input('type');
        $organizer = $request->input('organizer');
        $sector = $request->input('sector');
        $selectedSubject = $request->input('selected_subject');

        // Seçmeli fənn seçimini session’a kaydet
        if ($selectedSubject) {
            session(['selected_subject' => $selectedSubject]);
        }

        // İmtahanları filtrele
        $exams = Exam::with(['organizer', 'type', 'group', 'year', 'sector', 'foreignLanguage'])
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->when($year, function ($query, $year) {
                return $query->where('exam_year_id', $year);
            })
            ->when($group, function ($query, $group) {
                return $query->where('exam_group_id', $group);
            })
            ->when($type, function ($query, $type) {
                return $query->where('exam_type_id', $type);
            })
            ->when($organizer, function ($query, $organizer) {
                return $query->where('exam_organizer_id', $organizer);
            })
            ->when($sector, function ($query, $sector) {
                return $query->where('sector_id', $sector);
            })
            ->get();

        // Filtreleme için dropdown verilerini al
        $years = ExamYear::all();
        $groups = ExamGroup::all();
        $types = ExamType::all();
        $organizers = ExamOrganizer::all();
        $sectors = Sector::all();

        // Hata ayıklama için log
        \Log::info('HomeController@index', [
            'search' => $search,
            'year' => $year,
            'group' => $group,
            'type' => $type,
            'organizer' => $organizer,
            'sector' => $sector,
            'selected_subject' => $selectedSubject,
            'exams_count' => $exams->count(),
        ]);

        return view('home', compact('exams', 'years', 'groups', 'types', 'organizers', 'sectors', 'user'));
    }

    public function store(Request $request)
    {
        // Seçmeli fenn seçimini session’a kaydet
        $selectedSubject = $request->input('selected_subject');
        session(['selected_subject' => $selectedSubject]);

        return response()->json(['message' => 'Seçmeli fənn kaydedildi']);
    }
}
