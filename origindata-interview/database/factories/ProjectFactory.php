<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'company_id' => function () {
                return Company::inRandomOrder()->first()->id; // select random company id to assign to Project
            },
            'start_date' => $this->faker->dateTime(),
            'end_date' => $this->faker->dateTime(),
            'comments' => $this->faker->text(),
        ];
    }
}
