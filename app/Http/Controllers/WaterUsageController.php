<?php

namespace App\Http\Controllers;

use App\Models\WaterUsage;
use App\Models\Household;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WaterUsageController extends Controller
{

    public function viewUsage()
    {
        $user = Auth::user(); // get currently logged in user

        // fetch the household data using the household_id from the user
        $household = Household::find($user->household_id);

        //sorts data by month
        $monthlyData = DB::table('water_usages')
            ->selectRaw("DATE_FORMAT(usage_date, '%Y-%m') as month, SUM(litres_used) as total_litres")
            ->where('household_id', $household->id)
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        //sorts data by day
        $dailyData = DB::table('water_usages')
            ->selectRaw("DATE(usage_date) as date, SUM(litres_used) as total_litres")
            ->where('household_id', $household->id)
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        //sorts data by week
        $weeklyData = DB::table('water_usages')
            ->selectRaw("YEARWEEK(usage_date, 3) as year_week, SUM(litres_used) as total_litres")
            ->where('household_id', $household->id)
            ->groupBy('year_week')
            ->orderBy('year_week', 'asc')
            ->get();

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

        $totalLitres = DB::table('water_usages')
            ->where('household_id', $household->id)
            ->sum('litres_used');

        $totalDays = DB::table('water_usages')
            ->where('household_id', $household->id)
            ->distinct()
            ->count('usage_date');

        $averagePerDay = round($totalLitres / $totalDays, 1);

        // pass household and usage data to the view
        return view('view-usage', compact('household', 'monthlyData', 'dailyData', 'weeklyData', 'currentUsage', 'previousUsage', 'litresSaved', 'averagePerDay'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(WaterUsage $waterUsage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WaterUsage $waterUsage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WaterUsage $waterUsage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WaterUsage $waterUsage)
    {
        //
    }
}
