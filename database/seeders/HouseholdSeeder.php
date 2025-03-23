<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Household;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HouseholdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Household::factory()->count(10)->create(); // make 10 households

        // $currentTimestamp = now();

        // $households = [
        //     [
        //         "household_name" => "Green Family",
        //         "address" => "123 Maple Street, Springfield",
        //         "smart_meter_id" => "SM1234",
        //         "created_at" => $currentTimestamp,
        //         "updated_at" => $currentTimestamp
        //     ],
        //     [
        //         "household_name" => "Smith Residence",
        //         "address" => "456 Oak Avenue, Springfield",
        //         "smart_meter_id" => "SM5678",
        //         "created_at" => $currentTimestamp,
        //         "updated_at" => $currentTimestamp
        //     ],
        //     [
        //         "household_name" => "Johnson Household",
        //         "address" => "789 Pine Road, Springfield",
        //         "smart_meter_id" => "SM9101",
        //         "created_at" => $currentTimestamp,
        //         "updated_at" => $currentTimestamp
        //     ],
        //     [
        //         "household_name" => "Williams Home",
        //         "address" => "101 Cedar Street, Springfield",
        //         "smart_meter_id" => "SM1121",
        //         "created_at" => $currentTimestamp,
        //         "updated_at" => $currentTimestamp
        //     ],
        //     [
        //         "household_name" => "Brown Family",
        //         "address" => "202 Birch Lane, Springfield",
        //         "smart_meter_id" => "SM3141",
        //         "created_at" => $currentTimestamp,
        //         "updated_at" => $currentTimestamp
        //     ],
        // ];

        // // insert into db
        // DB::table("households")->insert($households);
    }
}
