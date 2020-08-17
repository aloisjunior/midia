<?php

namespace ARsig\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificaDownloadAdmins extends Mailable
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
            ->subject('Cadastro de novo contato via download')
            ->from('obrigado@'.env('APP_DOMAIN', 'rothermel.com.br'), 'Akhena | Sistema')
            ->markdown('emails.internos.NovoContatoDownload')
            ->with('content', $this->content);

    }
}
