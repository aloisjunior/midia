<?php

namespace ARsig\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NovoContatoSite_BoasVindas extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Seja bem vindo!')
//            ->from('obrigado@'.env('APP_DOMAIN', 'rothermel.com.br'), 'Akhena | Site')
            ->from('obrigado@rothermel.com.br', 'Akhena | Site')
            ->markdown('emails.externos.novocontato.boasvindas')
            ->with('content', $this->content);
    }
}
