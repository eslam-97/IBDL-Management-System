<?php

namespace Database\Factories;

use App\Models\AssessmentCompany;
use App\Models\AssessmentPosition;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssessmentPositionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AssessmentPosition::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->jobTitle,
            'assessment_company_id' => AssessmentCompany::factory(),
        ];
    }
}
