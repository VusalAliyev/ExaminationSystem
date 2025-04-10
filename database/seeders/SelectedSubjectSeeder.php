<?php

namespace Database\Seeders;

use App\Models\SelectedSubject;
use Illuminate\Database\Seeder;

class SelectedSubjectSeeder extends Seeder
{
    public function run()
    {
        $subjects = ['KF', 'IF', 'CT', 'ƏT'];

        foreach ($subjects as $subject) {
            SelectedSubject::create(['name' => $subject]);
        }
    }
}
