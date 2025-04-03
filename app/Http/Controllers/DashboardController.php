<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leaderboard;
use App\Models\User;
use App\Models\Households;
use App\Models\WaterUsage;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $household = $user->household;
        $leaderboardStanding = null;

        if ($household) {
            // get last 7 days water usage
            $usageData = WaterUsage::where('household_id', $user->household_id)
                ->where('usage_date', '>=', now()->subDays(7))
                ->orderBy('usage_date')
                ->get();

            // leaderboard standing
            $leaderboardStanding = Leaderboard::with('households')
                ->whereHas('households', fn($q) => $q->where('household_id', $household->id))
                ->first();

            $todayUsage = WaterUsage::where('household_id', auth()->user()->household_id)
                ->whereDate('usage_date', today())
                ->sum('litres_used');

            return view('dashboard', compact('usageData', 'leaderboardStanding', 'todayUsage'));
        }
        return view('dashboard');
    }
}
