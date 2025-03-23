<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Household extends Model
{
    use HasFactory;

    protected $fillable = [
        "household_name",
        "address", 
        "smart_meter_id"
    ]; // define which fields can be filled through forms

    // Specifying how the households table is connected to other tables
    // Relationship with user model
    public function user() {
        return $this->belongsTo(User::class); // using belongsTo() = each household is owned by a user
    }

    public function leaderboards() {
        return $this->belongsToMany(Leaderboard::class)->withTimestamps();
    }

    public function WaterUsages() {
        return $this->hasMany(WaterUsage::class);
    }
}
