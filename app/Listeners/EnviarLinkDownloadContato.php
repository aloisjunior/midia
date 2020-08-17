<?php

namespace ARsig\Listeners;

use ARsig\Events\NovoDownloadSite;
use ARsig\Mail\LinkDownload;
use ARsig\Models\Arquivo;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class EnviarLinkDownloadContato
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NovoDownloadSite  $event
     * @return void
     */
    public function handle(NovoDownloadSite $event)
    {

        switch ($event->input['tipo']){
            case 'midia':{
                $idfile = 23;
                break;
            }
            case 'radio':{
                $idfile = 30;
                break;
            }
            case 'producao':{
                $idfile = 23;
                break;
            }
        }

        $arquivo = Arquivo::find($idfile)
            ->where('ativo', '1')
            ->first();

        $linkarquivo = Storage::disk('public')->url($arquivo->link);;

        $content = [
            'body'=> 'Estamos enviando seu link para o download conforme solicitado no site rothermel.com.br.',
            'title'=> 'Agradecemos seu interesse',
            'nome'=>$event->input['nome'],
            'email'=>$event->input['email'],
            'telefone'=>$event->input['telefone'],
            'button' => 'Baixar Arquivo',
            'url_button'=> $linkarquivo,
            'url_logo' => env('APP_URL').'/api/e/mail/image/opened/arquivos/36c7bed8c26dbae7c50c474d8b0f3e9ba2ab6947.png/130/0?contato_id='.$event->model['id']
        ];


        Mail::to($event->input['email'])->send(new LinkDownload($content));
    }
}
