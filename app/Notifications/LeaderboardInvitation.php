<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LeaderboardInvitation extends Notification
{
    use Queueable;

    protected $leaderboard;
    protected $inviter;

    /**
     * Create a new notification instance.
     */
    public function __construct($leaderboard, $inviter)
    {
        $this->leaderboard = $leaderboard;
        $this->inviter = $inviter;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the database representation of the notification
     * 
     * @return array
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'message' => "{$this->inviter->name} invited you to join the leaderboard: {$this->leaderboard->leaderboard_name}",
            'leaderboard_id' => $this->leaderboard->id,
            'inviter_id' => $this->inviter->id,
        ];
    }

    // /**
    //  * Get the mail representation of the notification.
    //  */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //         ->line('The introduction to the notification.')
    //         ->action('Notification Action', url('/'))
    //         ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return $this->toDatabase($notifiable);
    }
}
