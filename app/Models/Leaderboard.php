<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leaderboard extends Model
{
    protected $fillable = [
        "leaderboard_name",
        "start_date",
        "end_date",
    ];

    // Establishing many to many relationship between households and leaderboard
    public function households() {
        return $this->belongsToMany(Household::class);
    }
}
