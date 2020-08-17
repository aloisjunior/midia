<?php

namespace ARsig\Events;

use ARsig\Models\Contatos;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NovoDownloadSite
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $model;
    public $input;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Contatos $contato, $input)
    {
        $this->model = $contato;
        $this->input = $input;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
