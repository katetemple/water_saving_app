<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Leaderboard;
use Tests\TestCase;

class LeaderboardTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_user_can_create_leaderboard(): void
    {
        // fake storage so it doesn't actually store
        Storage::fake('public');

        //create a user 
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post('/leaderboards', [
            'leaderboard_name' => 'Test Leaderboard',
            'start_date' => '2024-04-22',
            'end_date' => '2024-04-23'
        ]);

        $this->assertDatabaseHas('leaderboards', [
            'leaderboard_name' => 'Test Leaderboard',
            'start_date' => '2024-04-22',
            'end_date' => '2024-04-23'
        ]);

        $response->assertRedirect(route('leaderboards.index'));
    }

    public function test_user_can_update_leaderboard(): void
    {
        $leaderboard = Leaderboard::factory()->create();

        //create a user 
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->put(route('leaderboards.update', $leaderboard), [
            'leaderboard_name' => 'Updated Leaderboard',
            'start_date' => '2024-04-22',
            'end_date' => '2024-04-23'
        ]);

        $response->assertRedirect(route('leaderboards.index'));

        $this->assertDatabaseHas('leaderboards', [
            'id' => $leaderboard->id,
            'leaderboard_name' => 'Updated Leaderboard',
            'start_date' => '2024-04-22',
            'end_date' => '2024-04-23'
        ]);
    }

    public function test_user_can_delete_leaderboard(): void
    {
        $leaderboard = Leaderboard::factory()->create();

        //create a user 
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->delete(route('leaderboards.destroy', $leaderboard));

        $response->assertRedirect(route('leaderboards.index'));

        $this->assertDatabaseMissing('leaderboards', [
            'id' => $leaderboard->id,
        ]);
    }
}
