<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AssessmentCompany;

class AssessmentCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 10 assessment companies using the factory
        AssessmentCompany::factory()->count(20)->create();
    }
}
