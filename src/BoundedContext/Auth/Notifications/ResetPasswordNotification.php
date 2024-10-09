<?php

namespace App\BoundedContext\Auth\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $token;
    public $email;

    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $url = config('app.frontend_url') . '/reset-password/' . $this->token . '?email=' . $this->email;
        return (new MailMessage)
            ->subject('Restablecer contraseña')
            ->greeting('Hola!')
            ->line('Estás recibiendo este correo porque solicitaste un restablecimiento de contraseña para tu cuenta.')
            ->action('Restablecer contraseña', $url)
            ->line('Este enlace de restablecimiento expirará en 60 minutos.')
            ->line('Si no solicitaste un restablecimiento de contraseña, no es necesario realizar ninguna acción.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
