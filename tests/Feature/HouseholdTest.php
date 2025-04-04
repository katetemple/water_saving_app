<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Household;
use Tests\TestCase;

class HouseholdTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_user_can_create_household(): void
    {
        // fake storage so it doesn't actually store
        Storage::fake('public');

        //create a user 
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post('/households', [
            'household_name' => 'Test Household',
            'address' => 'Test Adress',
            'smart_meter_id' => 'SM1234567890'
        ]);

        $this->assertDatabaseHas('households', [
            'household_name' => 'Test Household',
            'address' => 'Test Adress',
            'smart_meter_id' => 'SM1234567890'
        ]);

        $response->assertRedirect(route('dashboard'));
    }

    public function test_user_can_update_household(): void
    {
        $household = Household::factory()->create();

        //create a user 
        $user = User::factory()->create([
            'household_id' => $household->id,
        ]);

        $this->actingAs($user);

        $response = $this->put(route('households.update', $household), [
            'household_name' => 'Updated Name',
            'address' => 'Updated Adress',
            'smart_meter_id' => 'SM9999999999'
        ]);

        $response->assertRedirect(route('profile.edit'));

        $this->assertDatabaseHas('households', [
            'id' => $household->id,
            'household_name' => 'Updated Name',
        ]);
    }

    public function test_user_can_delete_household(): void
    {
        $household = Household::factory()->create();

        //create a user 
        $user = User::factory()->create([
            'household_id' => $household->id,
        ]);

        $this->actingAs($user);

        $response = $this->delete(route('households.destroy', $household));

        $response->assertRedirect(route('dashboard'));

        $this->assertDatabaseMissing('households', [
            'id' => $household->id,
        ]);
    }
}
