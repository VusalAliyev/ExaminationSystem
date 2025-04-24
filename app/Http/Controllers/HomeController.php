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
        // Kullanıcı giriş yapmışsa, user'ı al; yoksa null
        $user = auth()->check() ? auth()->user() : null;

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

        // İmtahanları al (tüm imtahanlar, kullanıcıya bağlı olmadan)
        $examsQuery = Exam::with(['organizer', 'type', 'group', 'year', 'sector']);

        // Filtreleri sadece parametreler mevcutsa uygula
        if ($search) {
            $examsQuery->where('name', 'like', "%{$search}%");
        }
        if ($year) {
            $examsQuery->where('exam_year_id', $year);
        }
        if ($group) {
            $examsQuery->where('exam_group_id', $group);
        }
        if ($type) {
            $examsQuery->where('exam_type_id', $type);
        }
        if ($organizer) {
            $examsQuery->where('exam_organizer_id', $organizer);
        }
        if ($sector) {
            $examsQuery->where('sector_id', $sector);
        }

        // user_id filtresini kaldır, tüm imtahanları çek
        $exams = $examsQuery->get();

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
            'request_inputs' => $request->all(),
            'user_id' => $user ? $user->id : null,
        ]);

        // View'a user'ı null olarak da gönderebiliriz
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
