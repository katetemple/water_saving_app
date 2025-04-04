<?php

namespace App\Http\Controllers;

use App\Models\Leaderboard;
use App\Models\Household;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaderboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $household = $user->household;

        // get all leaderboards the user is part of
        $leaderboards = $household
            ? $household->leaderboards()->with('households')->get()
            : collect();

        return view('leaderboards.index', compact('leaderboards'));
    }

    /**
     * Show the form for creating a new leaderboard.
     */
    public function create()
    {
        return view('leaderboards.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "leaderboard_name" => "required|string|max:255",
            "start_date" => "required|date",
            "end_date" => "required|date|after_or_equal:start_date",
        ]);

        $leaderboard = Leaderboard::create([
            "leaderboard_name" => $request->leaderboard_name,
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
            "user_id" => auth()->id(),
        ]);

        // attach the creator's household
        $leaderboard->households()->attach(auth()->user()->household_id);

        return redirect()->route('leaderboards.index')->with('success', 'Leaderboard Created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Leaderboard $leaderboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leaderboard $leaderboard)
    {
        return view('leaderboards.edit', compact('leaderboard'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Leaderboard $leaderboard)
    {
        $request->validate([
            'leaderboard_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $leaderboard->update([
            'leaderboard_name' => $request->leaderboard_name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('leaderboards.index')->with('success', 'Leaderboard updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leaderboard $leaderboard)
    {
        $leaderboard->delete();

        return redirect()->route('leaderboards.index')->with('success', 'Leaderboard deleted successfully');
    }
}
