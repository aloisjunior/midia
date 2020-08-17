<?php

namespace ARsig\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NovoContato extends Mailable
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
            ->subject('Cadastro de novo contato')
            ->from('obrigado@rothermel.com.br', 'Akhena | Sistema')
            ->markdown('emails.internos.novoContatoSite')
            ->with('content', $this->content);

    }
}
