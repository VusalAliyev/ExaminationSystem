<?php

namespace Database\Seeders;

use App\Models\ExamOrganizer;
use Illuminate\Database\Seeder;

class ExamOrganizerSeeder extends Seeder
{
    public function run()
    {
        $organizers = ['DİM', 'Hedef', 'Güvən', 'Other'];

        foreach ($organizers as $organizer) {
            ExamOrganizer::create(['name' => $organizer]);
        }
    }
}
