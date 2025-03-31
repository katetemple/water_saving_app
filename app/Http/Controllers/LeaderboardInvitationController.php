<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leaderboard;
use App\Models\User;
use App\Models\LeaderboardInvitation;
use App\Notifications\LeaderboardInvitation as LeaderboardInvitationNotification;

class LeaderboardInvitationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications;
        return view('notifications.index', compact('notifications'));
    }

    public function create(Leaderboard $leaderboard)
    {
        return view('leaderboards.invite', compact('leaderboard'));
    }

    public function inviteUser (Request $request, $leaderboardId)
    {
        $leaderboard = Leaderboard::findOrFail($leaderboardId);
        $invitee = User::where('email', $request->input('email'))->firstOrFail();

        // save the invitation
        LeaderboardInvitation::create([
            'leaderboard_id' => $leaderboard->id,
            'inviter_id' => auth()->id(),
            'invitee_id' => $invitee->id,
        ]);

        // send the notification
        $invitee->notify(new LeaderboardInvitationNotification($leaderboard, auth()->user()));

        return back()->with('success', 'Invitation sent!');
    }

    public function respond (Request $request, $notificationId)
    {
        $notification = auth()->user()->notifications()->findOrFail($notificationId);
        $leaderboardId = $request->input('leaderboard_id');
        $response = $request->input('response');

        // update the invitation status
        $invitation = LeaderboardInvitation::where([
            ['leaderboard_id', '=', $leaderboardId],
            ['invitee_id', '=', auth()->id()],
        ])->firstOrFail();

        $invitation->status = $response;
        $invitation->save();

        if($response === 'accepted') {
            // add invitee's household to leaderboard
            $leaderboard = Leaderboard::findOrFail($leaderboardId);
            $leaderboard->households()->attach(auth()->user()->household_id);
        }

        // mark notifs as read
        $notification->markAsRead();

        return back()->with('success', "You have {$response} the invitation,");
    }
}
