<?php

namespace ARsig\Http\Controllers\Frontend;

use ARsig\Events\NovoContatoSite;
use ARsig\Events\NovoDownloadSite;
use ARsig\Http\Controllers\Controller;
use ARsig\Http\Requests\frontend\ContatoRequest;
use ARsig\Mail\LinkDownload;
use ARsig\Models\Arquivo;
use ARsig\Models\Contatos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function sobre()
    {
        return view('frontend.sobre');
    }

    public function midiaindoor()
    {
        return view('frontend.midiaindoor');
    }
    public function tvcorporativa()
    {
        return view('frontend.tvcorporativa');
    }
    public function vitrinedigital()
    {
        return view('frontend.vitrinedigital');
    }
    public function radioindoor()
    {
        return view('frontend.radioindoor');
    }
    public function criacaovideos()
    {
        return view('frontend.criacaovideos');
    }
    public function desenvolvimento()
    {
        return view('frontend.desenvolvimento');
    }
    public function downloads()
    {
        return view('frontend.downloads');
    }
   public function pontos()
    {
        return view('frontend.pontos');
    }

    public function downloads_store(Request $request)
    {
        $tags = ['site-area-download'];
        $localorigem = $request->session()->previousUrl('url');

        $tags = collect($tags)->implode(',');

        $contato = Contatos::updateOrCreate([
            'email'=>$request->input('email'),
        ]);

        $contato->update([
            'nome'=>$request->input('nome'),
//            'via_captura'=>'S',
            'tags'=>$tags,
            'cod_origem'=>'2', // indica via captura
            'origem_detalhe'=>$request->session()->previousUrl('url'),
            'observacao'=>'-contato cadastrado/atualizado via tela de confirmação de download.'.chr(13).'-usuário estava na pagina '.$request->session()->previousUrl('url'),
            'telefone'=>$request->input('telefone')
        ]);


        $contato->save();

        // monsta campanha de emails de acordo com o interesse
//        $job = new MontaCampanhaContato($contato);
//        //$job->onQueue('monta-campanha');
//        $this->dispatch($job);


        // rotina para incluir contato e enviar email com link de download.

//        switch ($request->input('tipo')){
//            case 'midia':{
//                $idfile = 23;
//                break;
//            }
//            case 'radio':{
//                $idfile = 30;
//                break;
//            }
//            case 'producao':{
//                $idfile = 23;
//                break;
//            }
//        }
//
//        $arquivo = Arquivo::find($idfile)
//            ->where('ativo', '1')
//            ->first();
//
//
//
//        $linkarquivo = Storage::disk('public')->url($arquivo->link);;
//
//
//        $content = [
//            'body'=> 'Estamos enviando seu link para o download conforme solicitado no site rothermel.com.br.',
//            'title'=> 'Agradecemos seu interesse',
//            'nome'=>$request->input('nome'),
//            'email'=>$request->input('email'),
//            'telefone'=>$request->input('telefone'),
//            'button' => 'Baixar Arquivo',
//            'url_button'=> $linkarquivo,
//            'url_logo' => env('APP_URL').'/api/e/mail/image/opened/arquivos/36c7bed8c26dbae7c50c474d8b0f3e9ba2ab6947.png/130/0?contato_id='.$contato->id
//        ];
//
//        Mail::to($request->input('email'))->send(new LinkDownload($content));

        $input = $request->all();
        event(new NovoDownloadSite($contato, $input));

        return response()->json('Enviado link para download ao email informado', '200');
    }



    public function teste()
    {
//        return view('layouts.frontend.teste2');
//        return view('frontend.midiaindoor');
        // Send an array of permissions to request
//        $login_url = $fb->getLoginUrl(['email']);
//
//        // Obviously you'd do this in blade :)
//        echo '<a href="' . $login_url . '">Login with Facebook</a>';
    }

    public function contato(){
        return view('frontend.contato');
    }

    public function contato_store(ContatoRequest $request){

        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'email' => 'required|email',

        ]);

        if ($validator->fails()) {
            return \response()->make($validator->errors()->all(), 400);
        }

        $input = $request->all();

        $contato = Contatos::updateOrCreate([
            'email'=>$input['email'],
        ]);

        $contato->update(
            [
                'nome'=> ucwords($input['nome']),
                'empresa'=> ucwords($input['empresa']),
                'cargo'=> ucwords($input['cargo']),
                'telefone'=> $input['telefone'],
                'tags'=>'cadastro-contato-site',
                'receber_mailing'=>true,
            ]
        );

        $contato->ocorrencias()->create(
            ['descricao'=>'Cadastrado no sistema via tela de contato','data'=>Carbon::now(), 'link'=>'/contatos/'.$contato->id]
//            ['descricao'=>'Enviado email de boas vindas','data'=>Carbon::now()],
        );

        event(new NovoContatoSite($contato, $input));
    }
}
