<?php

namespace Database\Factories;

use App\Models\Household;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Household>
 */
class HouseholdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Household::class;
    
    public function definition(): array
    {
        return [
            'household_name' => $this->faker->lastName . ' Family',
            'address' => $this->faker->address,
            'smart_meter_id' => strtoupper(Str::random(10)), // fake smart meter serial number
        ];
    }
}
