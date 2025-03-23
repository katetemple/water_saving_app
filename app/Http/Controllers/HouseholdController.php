<?php

namespace App\Http\Controllers;

use App\Models\Household;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Create household
        $household = Household::create([
            "household_name" => $request->household_name,
            "address" => $request->address,
            "smart_meter_id" => $request->smart_meter_id
        ]);

        // get currently logged in user
        $user = Auth::user();

        // assign the newly created household to the user
        $user->household_id = $household->id;
        $user->save(); // save the updated user model

        return redirect()->route('dashboard')->with('success', 'Household created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Household $household)
    {
        //
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
