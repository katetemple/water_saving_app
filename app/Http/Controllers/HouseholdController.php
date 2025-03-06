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
        
    }

    /**
     * Store a newly created household in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     "name" => "required|string|max:255", // validate input
        // ])

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
