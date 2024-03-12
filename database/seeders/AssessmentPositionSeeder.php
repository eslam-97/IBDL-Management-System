<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;
use App\Models\AssessmentPosition;

class AssessmentPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = Language::all();

        foreach ($languages as $language) {
            AssessmentPosition::factory()->count(5)->create([
                'language_id' => $language->id,
            ]);
        }
    }
}
