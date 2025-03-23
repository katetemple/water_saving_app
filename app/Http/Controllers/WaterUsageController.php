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

        // get water usage dtaa from the correct table for the users household
        // $usageData = WaterUsage::where('household_id', $household->id)->get();

        $usageData = DB::table('water_usages')
            ->selectRaw("DATE_FORMAT(usage_date, '%Y-%m') as month, SUM(litres_used) as total_litres")
            ->where('household_id', $household->id)
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

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

        // pass household and usage data to the view
        return view('view-usage', compact('household', 'usageData', 'currentUsage', 'previousUsage', 'litresSaved'));
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
