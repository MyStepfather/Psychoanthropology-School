<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
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
        return (new MailMessage)
            ->subject('Сброс пароля')
            ->from('test@idschool.tech')
            ->greeting('Здравствуйте, '.$notifiable->name_first)
            ->line('Вы получили это письмо, потому что мы получили запрос на сброс пароля для вашей учетной записи.')
            ->action('Сброс пароля', url(config('app.url').route('password.reset', $this->token, false)))
            ->line('Срок действия этой ссылки для сброса пароля истекает через '.config('auth.passwords.'.config('auth.defaults.passwords').'.expire').' минут.')
            ->line('Если вы не запрашивали сброс пароля, не предпринимайте никаких действий.')
            ->line('Если у вас возникли проблемы с нажатием кнопки "Сброс пароля", скопируйте и вставьте следующую ссылку в адресную строку вашего веб-браузера: '.url(config('app.url').route('password.reset', $this->token, false)));
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
