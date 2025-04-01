<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class NavigationTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_navigation_to_dashboard(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/dashboard');

        $response->assertStatus(200);
    }

    public function test_navigation_to_leaderboard_page(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/leaderboards');

        $response->assertStatus(200);
    }

    public function test_navigation_to_household_create_page(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/households/create');

        $response->assertStatus(200);
    }

    public function test_navigation_to_leaderboard_create_page(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/leaderboards/create');

        $response->assertStatus(200);
    }

    public function test_navigation_to_notification_page(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/notifications');

        $response->assertStatus(200);
    }

    // public function test_navigation_to_view_usage_page(): void
    // {
    //     $user = User::factory()->create();

    //     $this->actingAs($user);

    //     $response = $this->get('/view-usage');

    //     $response->assertStatus(200);
    // }
}