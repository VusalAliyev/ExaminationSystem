<?php

namespace Database\Seeders;

use App\Models\ExamType;
use Illuminate\Database\Seeder;

class ExamTypeSeeder extends Seeder
{
    public function run()
    {
        $types = ['Blok', 'Buraxılış', 'Hamısı'];

        foreach ($types as $type) {
            ExamType::create(['type' => $type]);
        }
    }
}
