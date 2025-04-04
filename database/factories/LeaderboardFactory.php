<?php

namespace Database\Factories;

use App\Models\Leaderboard;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Leaderboard>
 */
class LeaderboardFactory extends Factory
{

    protected $model = Leaderboard::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'leaderboard_name' => $this->faker->sentence(3),
            'start_date' => now()->startOfWeek(),
            'end_date' => now()->addWeek(),
            'user_id' => User::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
