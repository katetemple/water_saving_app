<?php

namespace App\Http\Controllers;

use App\Models\Household;
use Illuminate\Http\Request;

class HouseholdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new household.
     */
    public function create()
    {
        return view("households.create");
    }

    /**
     * Store a newly created household in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     "name" => "required|string|max:255", // validate input
        // ])

        // Validate form inputs
        $request->validate([
            "household_name" => 'required',
            "address" => "required",
            "smart_meter_id" => "required|unique:households"
        ]);

        // Create new household
        Household::create($request->all());

        // get currently logged in user
        $user = Auth::user();

        // assign the newly created household to the user
        $user->household_id = $household->id;
        $user->save(); // save the updated user model

        return redirect()->route("households.create")->with("success", "Household created successfully");



    }

    /**
     * Display the specified resource.
     */
    public function show(Household $household)
    {
        //
    }

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
     * Show the form for editing the specified resource.
     */
    public function edit(Household $household)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Household $household)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Household $household)
    {
        //
    }
}
