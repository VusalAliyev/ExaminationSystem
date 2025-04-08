<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamGroup;
use App\Models\ExamOrganizer;
use App\Models\ExamType;
use App\Models\ExamYear;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Axtarış sorğusunu əldə et
        $search = $request->input('search');

        // Filtrləri əldə et
        $yearId = $request->input('year');
        $groupId = $request->input('group');
        $typeId = $request->input('type');
        $organizerId = $request->input('organizer');

        // İmtahanları çək (əlaqələri ilə birlikdə)
        $examsQuery = Exam::with(['organizer', 'year', 'group', 'type']);

        // Axtarış varsa, imtahan adında axtar
        if ($search) {
            $examsQuery->where('name', 'like', '%' . $search . '%');
        }

        // Filtrləri tətbiq et
        if ($yearId) {
            $examsQuery->where('exam_year_id', $yearId);
        }
        if ($groupId) {
            $examsQuery->where('exam_group_id', $groupId);
        }
        if ($typeId) {
            $examsQuery->where('exam_type_id', $typeId);
        }
        if ($organizerId) {
            $examsQuery->where('exam_organizer_id', $organizerId);
        }

        // İmtahanları əldə et
        $exams = $examsQuery->get();

        // Filtrlər üçün seçimləri çək
        $years = ExamYear::all();
        $groups = ExamGroup::all();
        $types = ExamType::all();
        $organizers = ExamOrganizer::all();

        // İstifadəçi məlumatını çək
        $user = auth()->user();

        // View-a məlumatları göndər
        return view('home', compact('exams', 'years', 'groups', 'types', 'organizers', 'user'));
    }
}
