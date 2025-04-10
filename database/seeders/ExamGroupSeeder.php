<?php

namespace Database\Seeders;

use App\Models\ExamGroup;
use Illuminate\Database\Seeder;

class ExamGroupSeeder extends Seeder
{
    public function run()
    {
        $groups = ['1', '2', '3', '4'];

        foreach ($groups as $group) {
            ExamGroup::create(['group_name' => $group]);
        }
    }
}
