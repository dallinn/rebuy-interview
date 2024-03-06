<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Session;

class SessionFactory extends Factory
{
    protected $model = Session::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'start_time' => now()->subHours(rand(1, 4)),
            'end_time' => now(),
            'description' => $this->faker->sentence
        ];
    }
}