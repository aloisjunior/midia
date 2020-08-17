<?php

namespace ARsig\Http\Controllers\Api;

use ARsig\Http\Controllers\imagem\ImagemController;
use ARsig\Models\Contatos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use ARsig\Http\Controllers\Controller;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\Log;

class MailController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function show(Request $request)
    {
        $markdown = new Markdown(view(), config('mail.markdown'));

        return $markdown->render('emails.externos.novocontato.boasvindas', ['content'=>['nome'=>'teste', 'url'=>'teste', 'button'=>'teste']]);
//        return view('emails.externos.novocontato.boasvindas');
    }

    public function click(Request $request)
    {

    }

    public function click_url(Request $request)
    {

    }

    public function opened_imagem(Request $request, $dir, $filename, $largura=0, $altura=0)
    {
        $contato_id = $request->query('contato_id', '0');
        $disparo_id = $request->query('disparo_id', '0');

        if ($contato_id > 0){
//            try{
                $contato = Contatos::findOrFail($contato_id);

//                dd($contato);

                $contato->data_confirmacao = Carbon::now();
                $contato->bounce = 'Bounced';
                $contato->classificacao = 'Cadastrado';

                $contato->save();

//            }catch (\Exception $e) {
//                Log::error('Erro ao atualizar data de confirmação de email para o contato de id: ', ['contato_id'=> $contato_id]);
//            }

        }

        return redirect()->route('imagem.resize', [$dir, $filename, $largura, $altura]);
    }

    public function descadastro(Request $request, $id)
    {

    }
}
