<?php

namespace ARsig\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;


class PasswordVerificationMail extends Notification
{
    use Queueable;

    protected $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify', Carbon::now()->addMinutes(60), ['id' => $notifiable->getKey()]
        );
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Verificação de email')
            ->greeting('Olá!')
            ->line('Vocês está recebendo este e-mail porque seu email ainda não foi verificado. Clique abaixo para verificar ele.')
//            ->action('Confirmar meu email', url(config('app.url').route('verification.verify', ['id' => $this->user->id] , false)))
            ->action('Confirmar meu email',
                $this->verificationUrl($notifiable)
            )->line('Se você não solicitou este procedimento nenhuma ação é necessária');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
