<?php

namespace ARsig\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VideoConverterFinish implements ShouldBroadcastNow // não adiciona o broadcast a lista, executa direto
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $conteudo;
    public $user;

    public $broadcastQueue = 'cloudconvert';

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($conteudo, $user)
    {
        $this->conteudo = $conteudo;
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
//        return new PrivateChannel('channel-name');
//        return new Channel('video-events');
        return new Channel('user.'.$this->user->id);
//        return new Channel('user.'.$this->user->id);
    }

    public function broadcastWith() {
        return [
            'title' => 'O conteúdo '.$this->conteudo->nome.' está disponível para utilização.',
            'conteudo_nome' => $this->conteudo->nome
        ];
    }

//    public function broadcastAs()
//    {
//        return 'video.conversao.finish';
//    }
}
