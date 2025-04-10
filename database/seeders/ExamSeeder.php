<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\ExamType;
use App\Models\ExamGroup;
use App\Models\ExamYear;
use App\Models\ExamOrganizer;
use App\Models\Sector;
use App\Models\ForeignLanguage;
use App\Models\SelectedSubject;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    public function run()
    {
        // Bütün əlaqəli modellərdən ID-ləri və adları alırıq
        $examTypes = ExamType::all()->pluck('id', 'type')->toArray();
        $examGroups = ExamGroup::all()->pluck('id', 'group_name')->toArray();
        $examYears = ExamYear::all()->pluck('id', 'year')->toArray();
        $organizers = ExamOrganizer::all()->pluck('id', 'name')->toArray();
        $sectors = Sector::all()->pluck('id', 'sector_name')->toArray();
        $foreignLanguages = ForeignLanguage::all()->pluck('id', 'name')->toArray();
        $selectedSubjects = SelectedSubject::all()->pluck('id', 'name')->toArray();

        // Seçim üçün massivlər
        $typeOptions = ['Blok', 'Buraxılış', 'Hamısı'];
        $groupOptions = ['1', '2', '3', '4'];
        $yearOptions = range(2000, 2025);
        $organizerOptions = ['DİM', 'Hedef', 'Güvən', 'Other'];
        $sectorOptions = ['Azərbaycan', 'Rus'];
        $foreignLanguageOptions = ['İngilis Dili', 'Rus Dili'];
        $selectedSubjectOptions = ['KF', 'IF', 'CT', 'ƏT'];

        // 30-40 arası dediniz, 40 seçdim
        $examCount = 40;
        for ($i = 1; $i <= $examCount; $i++) {
            // Təsadüfi seçimlər
            $type = $typeOptions[array_rand($typeOptions)];
            $group = $groupOptions[array_rand($groupOptions)];
            $year = $yearOptions[array_rand($yearOptions)];
            $organizer = $organizerOptions[array_rand($organizerOptions)];
            $sector = $sectorOptions[array_rand($sectorOptions)];
            $foreignLanguage = $foreignLanguageOptions[array_rand($foreignLanguageOptions)];

            // SelectedSubject yalnız xüsusi şərtlərdə təyin olunur
            $selectedSubjectId = null;
            if ($type === 'Blok') {
                if ($group == '1') {
                    $selectedSubject = $selectedSubjectOptions[array_rand(['KF', 'IF'])];
                    $selectedSubjectId = $selectedSubjects[$selectedSubject];
                } elseif ($group == '3') {
                    $selectedSubject = $selectedSubjectOptions[array_rand(['CT', 'ƏT'])];
                    $selectedSubjectId = $selectedSubjects[$selectedSubject];
                }
            }

            Exam::create([
                'name' => "$type İmtahan $i ($year)",
                'exam_organizer_id' => $organizers[$organizer],
                'exam_type_id' => $examTypes[$type],
                'exam_group_id' => $examGroups[$group],
                'exam_year_id' => $examYears[$year],
                'sector_id' => $sectors[$sector],
                'foreign_language_id' => $foreignLanguages[$foreignLanguage],
                'selected_subject_id' => $selectedSubjectId,
            ]);
        }
    }
}
