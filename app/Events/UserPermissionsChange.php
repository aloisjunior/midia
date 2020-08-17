<?php

namespace ARsig\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserPermissionsChange implements ShouldBroadcastNow // não adiciona o broadcast a lista, executa direto
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

//    public $broadcastQueue = 'cloudconvert';

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user)
    {
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
            'title' => 'Teste',
            'conteudo_nome' => 'outro'
        ];
    }

//    public function broadcastAs()
//    {
//        return 'video.conversao.finish';
//    }
}
