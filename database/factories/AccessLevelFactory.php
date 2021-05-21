<?php

namespace Database\Factories;

use App\Models\AccessLevel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccessLevelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AccessLevel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $user_id = 4;
        return [
            'account' => rand(0, 1),
            'disk' => rand(0, 1),
            'mail' => rand(0, 1),
            'calendar' => rand(0, 1),
            'photo' => rand(0, 1),
            'contacts' => rand(0, 1),
            'user_id' => $user_id++,
        ];
    }
}
