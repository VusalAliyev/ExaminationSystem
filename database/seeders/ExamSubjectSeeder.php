<?php

namespace Database\Seeders;

use App\Models\ExamSubject;
use Illuminate\Database\Seeder;

class ExamSubjectSeeder extends Seeder
{
    public function run()
    {
        $subjects = [
            'Azərbaycan Dili',
            'Riyaziyyat',
            'İngilis Dili',
            'Rus Dili',
            'Fizika',
            'Kimya',
            'Azərbaycan Tarixi',
            'Coğrafiya',
            'Ədəbiyyat',
            'Tarix',
            'Biologiya',
        ];

        foreach ($subjects as $subject) {
            ExamSubject::create(['name' => $subject]);
        }
    }
}
