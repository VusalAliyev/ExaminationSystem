<?php

namespace Database\Seeders;

use App\Models\ForeignLanguage;
use Illuminate\Database\Seeder;

class ForeignLanguageSeeder extends Seeder
{
    public function run()
    {
        $languages = ['İngilis Dili', 'Rus Dili'];

        foreach ($languages as $language) {
            ForeignLanguage::create(['name' => $language]);
        }
    }
}
