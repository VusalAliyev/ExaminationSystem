<?php

namespace Database\Seeders;

use App\Models\ExamYear;
use Illuminate\Database\Seeder;

class ExamYearSeeder extends Seeder
{
    public function run()
    {
        for ($year = 2000; $year <= 2025; $year++) {
            ExamYear::create(['year' => $year]);
        }
    }
}
