<?php

namespace App\Http\Controllers;

use App\Models\WaterUsage;
use App\Models\Household;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WaterUsageController extends Controller
{

    public function viewUsage()
    {
        $user = Auth::user(); // get currently logged in user

        // fetch the household data using the household_id from the user
        $household = Household::find($user->household_id);

        // get water usage dtaa from the correct table for the users household
        $usageData = WaterUsage::where('household_id', $household->id)->get();

        // pass household and usage data to the view
        return view('view-usage', compact('household', 'usageData'));
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
