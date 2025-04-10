<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ExamTypeSeeder::class,
            ExamYearSeeder::class,
            ExamGroupSeeder::class,
            ExamSubjectSeeder::class,
            ExamOrganizerSeeder::class,
            SectorSeeder::class,
            ForeignLanguageSeeder::class,
            SelectedSubjectSeeder::class,
            ExamSeeder::class,
            ExamQuestionSeeder::class,
            ExamAnswerSeeder::class, // Yeni əlavə olunan seeder
        ]);
    }
}
