<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaderboardInvitation extends Model
{
    protected $fillable = [
        'leaderboard_id',
        'inviter_id',
        'invitee_id',
        'status',
    ];
}
