<?php

namespace Database\Factories;

use App\Models\AssessmentCompany;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssessmentCompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AssessmentCompany::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
        ];
    }
}
