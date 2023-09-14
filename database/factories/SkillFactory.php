<?php

namespace Database\Factories;

use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

class SkillFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Skill::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Creating a skills array with random number of skills
        $skillsArray = $this->faker->words($this->faker->numberBetween(1,5));

        return [
            'skills' => json_encode($skillsArray), // JSON encode the skills array
            'years_exp' => $this->faker->date(),
            'level' => $this->faker->randomElement(['Beginner', 'Intermediate', 'Expert']),
            // employee_id will be attached dynamically when associating skills with an employee
        ];
    }
}
