<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Check>
 */
class CheckFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $uploadTime = Carbon::now();
        $user = User::inRandomOrder()->first();
        $status = $this->faker->randomElement([0, 1]);
        return [
            'status' => 1,
            'user_id' => $user->id,
            'image' => '1.png',
            'date' => $uploadTime,
            'code' =>  Str::random(8),
        ];
    }
}
