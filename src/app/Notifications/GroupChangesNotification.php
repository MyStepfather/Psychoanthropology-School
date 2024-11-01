<?php

namespace App\Notifications;

use App\Actions\Notify\GetAdminToNotify;
use App\Models\Group;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GroupChangesNotification extends Notification
{
    use Queueable;
    protected $data;

    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        extract($this->data);

        $coordinatorName = Group::find($groupId)->coordinator->name;

        return (new MailMessage)
                    ->subject('Изменения в группе координатора:  ' . $coordinatorName)
                    ->line('Изменения в группе координатора:  ' . $coordinatorName)
                    ->line($text);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
