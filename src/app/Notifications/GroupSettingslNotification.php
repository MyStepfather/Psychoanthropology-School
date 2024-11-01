<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;

class GroupSettingslNotification extends Notification
{
    use Queueable;

    protected $data;
    /**
     * Create a new notification instance.
     */
    public function __construct($message)
    {
        $this->data = $message;
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

        // Получаем название дня недели на русском
        $dayOfWeek = $weekday;
        $date = Carbon::now()->startOfWeek()->addDays($dayOfWeek - 1);
        $dayName = $date->locale('ru')->translatedFormat('l');

        return (new MailMessage)
            ->from('test@idschool.tech')
            ->subject('Изменения в группе координатора: ' . ($group->coordinator->name ?? 'Имя координатора не указано'))
            ->line('Место проведения: ' . ($place ?? 'Место не указано'))
            ->line('Время: ' . $dayName . ' ' . $time)
            ->line('Помощник координатора: ' . ($helper1 ? ($helper1->name_last ?? 'Фамилия не указана') . ' ' . ($helper1->name_first ?? 'Имя не указано') : 'Помощник не назначен'));
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
