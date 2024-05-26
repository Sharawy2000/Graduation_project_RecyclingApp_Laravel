<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Post;

class ProductsNotifications extends Notification implements ShouldQueue
{
    use Queueable;

    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function via($notifiable)
    {
    return ['database', /*'fcm'*/]; // This will send the notification to the database and FCM (Firebase Cloud Messaging)
    }

    public function toDatabase($notifiable)
    {
        return [
            'post_id' => $this->post->id,
            'title' => $this->post->material,
            'message' => 'A new post matching your interests has been created.',
        ];
    }

    public function toFcm($notifiable)
    {
        return [
            'title' => 'New Post',
            'body' => 'A new post matching your interests has been created: ' . $this->post->title,
            'data' => [
                'post_id' => $this->post->id,
            ],
        ];
    }
}
