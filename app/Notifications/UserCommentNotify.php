<?php

namespace App\Notifications;

use App\Models\CornerPost;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserCommentNotify extends Notification
{
    use Queueable;
    protected string $username;
    protected string $title;

    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->username = $data['username'];
        $this->title = $data['title'];
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


    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'comment',
            'username' => $this->username,
            'title' => $this->title,
        ];
    }
}
