<?php

namespace ARsig\Http\Controllers\api;

use ARsig\models\Estacao;
use ARsig\Models\User;
use Illuminate\Http\Request;
use ARsig\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class RadioController extends Controller
{
    public function pularmusica(Request $request)
    {
        //pega id da estacao
        $estacao_id = $request->route('id');


        $estacoes = Estacao::where('id', $estacao_id)->first();

        $url = 'http://webradio.rothermel.com.br/admin/funcoes-ajax/pular_musica/'.$estacoes->key;


// chamado via command pois dava erro de link náo seguro em ambiente https
        return Artisan::call('executa:url', ['url'=>$url]);
//        return 'Comando executado com sucesso, em seguida sua rádio atualizará.';
    }


    public function validausuario(Request $request)
    {
        $usuario_email = $request->route('nome');
        $key = $request->route('key');
        $player_version = $request->route('player_version');

        $user = DB::table('users')->where('email', $usuario_email)->first();

        if (!isset($user)) {
            return response()->json(['success' => false, 'mensagem' =>'Usuário não localizado.'], 200, [], JSON_UNESCAPED_UNICODE );
        }

        if ($user->password_md5 == $key){
            return response()->json(['success'=>true, 'mensagem'=>'Usuário autorizado.', 'id'=>$user->id], 200, [], JSON_UNESCAPED_UNICODE );
            //return json_encode(true);
        } else {
            //abort(403, 'Unauthorized action.');
            return response()->json(['success'=>false, 'mensagem'=>'Usuário não autorizado.'], 200, [], JSON_UNESCAPED_UNICODE );
            //return json_encode(false);
        }
    }

    public function listaestacoes(Request $request)
    {
        $usuario_email = $request->route('nome');
        $usuario_id = $request->route('id');

        if (isset($usuario_id)){
            $user = User::where('id', $usuario_id)->first();
        } else{
            $user = User::where('email', $usuario_email)->first();
        }

        if (!isset($user) ){
            return ['success'=>false, 'mensagem'=>'Usuário não localizado.'];
        }

        $estacoes = $user->estacoes()->get();

        return response()->json(['success'=>true, 'mensagem'=>'Estações para o usuário.', 'estacoes'=>$estacoes->toArray()], 200, [], JSON_UNESCAPED_UNICODE );
        //Response::json($estacoes);
    }


}
