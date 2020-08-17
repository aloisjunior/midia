<?php

namespace ARsig\Listeners;

use ARsig\Events\NovoContatoSite;
use ARsig\Mail\NovoContato;
use ARsig\Models\Role;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class NotificarAdminsSobreNovoContato
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
     * @param  NovoContatoSite  $event
     * @return void
     */
    public function handle(NovoContatoSite $event)
    {
        $content = [
            'body'=> 'Contato realizado via site, enviamos as informações para acompanhamento deste contato.',
            'contato_id'=> $event->model->id,
            'title'=> 'Dados do contato cadastrado',
            'nome'=>$event->input['nome'],
            'assunto'=>$event->input['assunto'],
            'mensagem'=>$event->input['mensagem'],
            'email'=>$event->input['email'],
            'telefone'=>$event->input['telefone'],
            'empresa'=>$event->input['empresa'],
            'cargo'=>$event->input['cargo'],
            'button' => 'Acesse Agora',
            'url_button'=> config('app.url').'/admin/contatos/'.$event->model->id.'/edit',
            'url_logo' => env('APP_URL').'/api/e/mail/image/opened/arquivos/36c7bed8c26dbae7c50c474d8b0f3e9ba2ab6947.png/130/0?contato_id=0'
        ];

        $roles = Role::where('slug','admin')->with('users')->first();

        $usuarios = $roles->users()->get();


//      encaminho email para os administradores
        foreach ($usuarios as $usuario) {
            Mail::to($usuario->email)->send(new NovoContato($content));
        }

//        dd($emails);
        $receiverAddress = 'contato@rothermel.com.br';



    }
}
