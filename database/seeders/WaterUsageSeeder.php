<?php

namespace Database\Seeders;

use App\Models\WaterUsage;
use App\Models\Household;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class WaterUsageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // get all households to generate water usage data
        $households = Household::all();
        $startDate = Carbon::now()->subMonths(6); // set start date to 6 months
        $endDate = Carbon::now(); // set end date to today

        foreach ($households as $household) {
            $currentDate = $startDate->copy();

            // generate daily water usage data for each household
            while ($currentDate->lte($endDate)) {
                WaterUsage::create([
                    "household_id" => $household->id,
                    "litres_used" => rand(100, 500), // random usage between 100 and 500
                    "usage_date" => $currentDate->format("Y-m-d"),
                ]);

                $currentDate->addDay(); // move to next day
            }
        }
    }
}
