<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Leaderboard extends Model
{
    use HasFactory;

    protected $fillable = [
        "leaderboard_name",
        "start_date",
        "end_date",
        "user_id",
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    // Establishing many to many relationship between households and leaderboard
    public function households() {
        return $this->belongsToMany(Household::class)->withTimestamps();
    }

}
