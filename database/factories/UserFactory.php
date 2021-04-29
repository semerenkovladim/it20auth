<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'position' => 'Developer',
            'name' => $this->faker->name(),
            'surname' => $this->faker->lastName,
            'middle_name' => $this->faker->lastName,
            'birth' => $this->faker->date(),
            'date_start' => $this->faker->date(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('Q3kR2"&Jj><Qj+#X'), // password
            'department_id' => DepartmentFactory::new()
        ];
    }
}
