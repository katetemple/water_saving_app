<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Household;
use App\Models\Leaderboard;
use Database\Factories\HouseholdFactory;
use Carbon\Carbon;

class LeaderboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 3 new households
        $households = Household::factory()->count(3)->create();

        // create users and assign them to househodls
        $households->each(function ($household) {
            User::factory()->create([
                "household_id" => $household->id
            ]);
        });

        // create leaderboard
        $leaderboard = Leaderboard::create([
            "leaderboard_name" => "March Showdown",
            "user_id" => User::first()->id,
            "start_date" => Carbon::now()->subDays(7)->toDateString(),
            "end_date" => Carbon::now()->toDateString(),
        ]);

        // attach all households to the leaderboard
        $leaderboard->households()->attach($households->pluck('id'));

    }
}
