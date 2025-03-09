<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaterUsage extends Model
{
    protected $fillable = [
        "litres_used",
        "usage_date",
        "household_id"
    ];

    public function household() {
        return $this->belongsTo(Household::class);
    }
}
