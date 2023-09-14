<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'contact_phone' => fake()->phoneNumber,
            'email' => fake()->unique()->safeEmail(),
            'dob' => fake()->date,
            'street_address' => fake()->streetAddress,
            'city' => fake()->city,
            'country' => fake()->country,
            'postal_code' => fake()->postcode,
        ];
    }
}
