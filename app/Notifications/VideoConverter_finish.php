<?php

namespace ARsig\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class VideoConverter_finish extends Notification implements ShouldQueue
{
    use Queueable;



//    não esta sendo usado <<<<<<<<<<<<<<<<<<<<<<<<<<<

    public $conteudo;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($conteudo)
    {
        $this->conteudo = $conteudo;
//        $this->user = Auth::user();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast'];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'conteudo_nome' => $this->conteudo->nome,
            'link' => $this->conteudo->link,
        ]);
    }

    public function broadcastAs()
    {
        return 'video.conversao.finish';
    }
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
//        return (new MailMessage)
//                    ->line('The introduction to the notification.')
//                    ->action('Notification Action', url('/'))
//                    ->line('Thank you for using our application!');
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
