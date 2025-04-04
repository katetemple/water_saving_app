<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Household;
use App\Models\User;
use App\Models\WaterUsage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WaterUsageCalculationsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    // public function test_weekly_water_usage_totals_are_correct(): void
    // {
    //     $household = Household::factory()->create();
    //     $user = User::factory()->create(['household_id' => $household->id]);


    // }

    public function test_average_litres_used_per_day_is_correct(): void
    {
        $household = Household::factory()->create();
        $user = User::factory()->create(['household_id' => $household->id]);

        WaterUsage::create([
            'household_id' => $household->id,
            'usage_date' => '2024-04-01',
            'litres_used' => 300,
        ]);

        WaterUsage::create([
            'household_id' => $household->id,
            'usage_date' => '2024-04-02',
            'litres_used' => 300,
        ]);

        $totalLitres = DB::table('water_usages')
            ->where('household_id', $household->id)
            ->sum('litres_used'); // 600

        $totalDays = DB::table('water_usages')
            ->where('household_id', $household->id)
            ->distinct()
            ->count('usage_date'); // 2 days

        $averagePerDay = round($totalLitres / $totalDays, 1); // 300

        $this->assertEquals(300.0, $averagePerDay);
    }

    public function test_litres_saved_between_months_is_calculated_correctly()
    {
        $household = Household::factory()->create();

        $user = User::factory()->create([
            'household_id' => $household->id,
        ]);

        // previous month
        WaterUsage::create([
            'household_id' => $household->id,
            'usage_date' => now()->subMonth()->startOfMonth(),
            'litres_used' => 300,
        ]);

        // previous month
        WaterUsage::create([
            'household_id' => $household->id,
            'usage_date' => now()->startOfMonth(),
            'litres_used' => 100,
        ]);

        // current and previous month
        $currentMonth = Carbon::now()->format('Y-m');
        $previousMonth = Carbon::now()->subMonth()->format('Y-m');

        $currentUsage = DB::table('water_usages')
            ->where('household_id', $household->id)
            ->whereRaw("DATE_FORMAT(usage_date, '%Y-%m') = ?", [$currentMonth])
            ->sum('litres_used');

        $previousUsage = DB::table('water_usages')
            ->where('household_id', $household->id)
            ->whereRaw("DATE_FORMAT(usage_date, '%Y-%m') = ?", [$previousMonth])
            ->sum('litres_used');

        $litresSaved = $previousUsage - $currentUsage;

        $this->assertEquals(300, $previousUsage);
        $this->assertEquals(100, $currentUsage);
        $this->assertEquals(200, $litresSaved);
    }
}
