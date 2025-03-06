<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Household extends Model
{
    protected $fillable = ["name", "user_id"]; // define which fields can be filled through forms

    // Specifying how the households table is connected to other tables
    // Relationship with user model
    public function user() {
        return $this->belongsTo(User::class); // using belongsTo() = each household is owned by a user
    }
}
