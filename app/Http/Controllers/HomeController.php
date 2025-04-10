<?php
namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamGroup;
use App\Models\ExamOrganizer;
use App\Models\ExamType;
use App\Models\ExamYear;
use App\Models\Sector;
use App\Models\SelectedSubject;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $yearId = $request->input('year');
        $groupId = $request->input('group');
        $typeId = $request->input('type');
        $organizerId = $request->input('organizer');
        $sectorId = $request->input('sector'); // Sektor filtri
        $selectedSubjectId = $request->input('selected_subject'); // Seçmə fənn filtri

        $examsQuery = Exam::with(['organizer', 'year', 'group', 'type', 'sector', 'selected_subject']);

        if ($search) {
            $examsQuery->where('name', 'like', '%' . $search . '%');
        }
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
        if ($sectorId) {
            $examsQuery->where('sector_id', $sectorId);
        }
        if ($selectedSubjectId) {
            $examsQuery->where('selected_subject_id', $selectedSubjectId);
        }

        $exams = $examsQuery->get();
        $years = ExamYear::all();
        $groups = ExamGroup::all();
        $types = ExamType::all();
        $organizers = ExamOrganizer::all();
        $sectors = Sector::all();
        $selected_subjects = SelectedSubject::all();

        $user = auth()->user();

        return view('home', compact('exams', 'years', 'groups', 'types', 'organizers', 'sectors', 'selected_subjects', 'user'));
    }
}
