<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserLikeNotify extends Notification
{
    use Queueable;

    protected string $username;
    protected string $title;
    protected string $type;

    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->username = $data['username'];
        $this->title = $data['title'];
        $this->type = $data['type'];
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
            'type' => $this->type,
            'username' => $this->username,
            'title' => $this->title,
        ];
    }
}
