<?php

namespace ARsig\Listeners;

use ARsig\Events\NovoDownloadSite;
use ARsig\Mail\NotificaDownloadAdmins;
use ARsig\Models\Role;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class NotificarAdminsSobreNovoDownload
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
        $content = [
            'body'=> 'Contato solicitou link para download, enviamos as informações para acompanhamento deste contato.',
            'contato_id'=> $event->model->id,
            'title'=> 'Dados do contato cadastrado',
            'nome'=>$event->input['nome'],
            'email'=>$event->input['email'],
            'telefone'=>$event->input['telefone'],
            'observacao'=>$event->model['observacao'],
            'button' => 'Acesse Agora',
            'url_button'=> config('app.url').'/admin/contatos/'.$event->model->id.'/edit',
//            'url_logo' => env('APP_URL').'/api/e/mail/image/opened/arquivos/36c7bed8c26dbae7c50c474d8b0f3e9ba2ab6947.png/130/0?contato_id=0'
        ];

        $roles = Role::where('slug','admin')->with('users')->first();

        $usuarios = $roles->users()->get();


//      encaminho email para os administradores
        foreach ($usuarios as $usuario) {
            Mail::to($usuario->email)->send(new NotificaDownloadAdmins($content));
        }

    }
}
