<?php

namespace Database\Seeders;

use App\Models\Sector;
use Illuminate\Database\Seeder;

class SectorSeeder extends Seeder
{
    public function run()
    {
        $sectors = ['Azərbaycan', 'Rus'];

        foreach ($sectors as $sector) {
            Sector::create(['sector_name' => $sector]);
        }
    }
}
