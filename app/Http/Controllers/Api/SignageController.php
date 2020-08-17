<?php

namespace ARsig\Http\Controllers\Api;

use ARsig\Events\VideoConverterFinish;
use ARsig\Http\Controllers\Controller;
use ARsig\Models\Layouts;
use ARsig\Models\Players;
use ARsig\Models\PlayersLogs;
use ARsig\Models\Playlist;
use ARsig\Models\PlaylistConteudo;
use ARsig\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use RobbieP\CloudConvertLaravel\Facades\CloudConvert;

class SignageController extends Controller
{
    protected $arrayCarrossels = [];
    protected $arrayCarrosselsIndexes = [];

    public function login(Request $request, $token, $token_auth = '')
    {
//        $temToken = isset($token);

        $player = Players::where('token_id', $token)->first();

        $result = false;

        $msg_erro = 'Player não autorizado.';

        if (!isset($player->token_auth) or ($player->token_auth == '')) {
            $player->token_auth = uniqid();
            $player->save();
            $result = true;
        } else {
            $result = ($player->token_auth = $token_auth);
            if (!$result) {
                $msg_erro = 'Token já utilizado.';
            }
        }

        if ($result) {
            $this->atualiza_sinal_app($token);
            return response()->json(['success' => true, 'mensagem' => 'Player autorizado.', 'dados' => $player], 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json(['success' => false, 'mensagem' => $msg_erro], 200, [], JSON_UNESCAPED_UNICODE);
        }
    }

    public function atualiza_sinal_app($token, $token_push = '')
    {
        $player = Players::where('token_id', $token)->first();

        if (count($player) > 0) {
            $atualizacoes = ['ultimo_sinal' => Carbon::now()];

            if ($token_push <> '') {
                $atualizacoes['token_push_android'] = $token_push;
            }

            $player->update($atualizacoes);
        }
    }

    public function destroyCaptura($token)
    {
        $player = Players::find($token);

        try {
            Storage::disk('public')->delete('players/screenshot/' . $player->token_id . '.jpg');
            return response()->json(['success' => true, 'mensagem' => 'Arquivo excluido.'], 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'mensagem' => $e->getMessage()], 200, [], JSON_UNESCAPED_UNICODE);
        }
    }

    // metodo via post
    public function atualiza_sinal_app_post(Request $request, $token, $token_push = '')
    {
        $player = Players::where('token_id', $token)->first();

        $playlist = '';
        if ($request->isJson()) {
            $input = $request->all();
            $playlist = collect($input['conteudos'])->toJson();
        }

//        dd($playlist);

        if (count($player) > 0) {
            $atualizacoes = ['ultimo_sinal' => Carbon::now()];

            if ($token_push <> '') {
                $atualizacoes['token_push_android'] = $token_push;
            }

            if ($playlist <> '') {
                $atualizacoes['playlist'] = $playlist;
            }

            $player->update($atualizacoes);
        }
    }

    public function atualiza_sinal_app_post_v2(Request $request, $token, $version, $token_push = '')
    {
        $player = Players::where('token_id', $token)->first();

        $playlist = '';
        if ($request->isJson()) {
            $input = $request->all();
            if (isset($input['conteudos'])){
               $playlist = collect($input['conteudos'])->toJson();
            }
        }

//        dd($playlist);

        if (count($player) > 0) {
            $atualizacoes = ['ultimo_sinal' => Carbon::now()];

            if ($token_push <> '') {
                $atualizacoes['token_push_android'] = $token_push;
            }

            if ($playlist <> '') {
                $atualizacoes['playlist'] = $playlist;
            }
            if ($version <> '') {
                $atualizacoes['app_version'] = $version;
            }

            $player->update($atualizacoes);
        }
    }

    public function atualiza_sinal_service($token)
    {
        $player = Players::where('token_id', $token)->first();

        if (count($player) > 0) {
            $player->update(['ultimo_sinal_service' => Carbon::now()]);

        }
    }

    public function ProcessaPlaylist($playlistId, $isSub = false, $conteudosIn = '', $versao = '')
    {
        $dados = [];

        if ($conteudosIn <> ''){
            $conteudos = $conteudosIn;
        }else{
            $conteudos = collect(Playlist::find($playlistId)->conteudos()->get())->toArray();
        }

//        dd($conteudos);

        foreach ($conteudos as $index => $cont) {

            switch ($cont['tipo']) {
                case 'conteudo':
                case 'url':
                case 'streaming':
                    if (isset($cont['conteudos'])) { // ajusta para evitar mandar conteudo vazio, que deve estar desativado ou ainda em processamento
                        $regTmp = $cont['conteudos'];
                        if (!$isSub) {
                            $regTmp['tipo'] = $cont['tipo'];
                        } else {
                            $regTmp['tipo'] = 'subplaylist';
                        }
                        $dados[] = $regTmp;
                    }
                    break;
                case 'layout':
                    if ($versao == 'v3') {

                        if ($cont['layout'] && $cont['layout']['ativo'] =='1'){
                            $regTmp = [];

                            $regTmp['id'] = $cont['layout_id'];
                            $regTmp['tipo'] = 'layout';

                            $dados[] = $regTmp;
                        }
                    }
                    break;

                case 'carrossel':
                    if ($cont['tag_carrossel'] != '') {
                        $tmp = strtolower($cont['tag_carrossel']);

                        if (!isset($this->arrayCarrossels[$tmp])) {
                            $carrTmp = PlaylistConteudo::whereRaw('lcase(tags) like "%' . $tmp . '%"')
                                // ajuste para pegar conteudo ativo e processado
                                ->where('ativo', true)
                                ->where('processado', true)
                                ->get();

                            if (count($carrTmp) > 0){
                                $this->arrayCarrossels[$tmp] = collect(
                                    $carrTmp
                                )->toArray();
                                $this->arrayCarrosselsIndexes[$tmp] = 0;
                            }
//                            $this->arrayCarrossels[$tmp] = collect(
//                                PlaylistConteudo::whereRaw('lcase(tags) like "%' . $tmp . '%"')
//                                    ->get()
//                            )->toArray();
//                            $this->arrayCarrosselsIndexes[$tmp] = 0;
                        } else {
                            if (array_key_exists($this->arrayCarrosselsIndexes[$tmp] + 1, $this->arrayCarrossels[$tmp])) {
                                $this->arrayCarrosselsIndexes[$tmp] += 1;
                            } else {
                                $this->arrayCarrosselsIndexes[$tmp] = 0;
                            }
                        }

                        if (isset($this->arrayCarrossels[$tmp])) {
                            $regTmp = collect($this->arrayCarrossels[$tmp][$this->arrayCarrosselsIndexes[$tmp]])->toArray();

                            if (!$isSub) {
                                $regTmp['tipo'] = $cont['tipo'];
                            } else {
                                $regTmp['tipo'] = 'subplaylist';
                            }

                            $dados[] = $regTmp; //collect($this->arrayCarrossels[$tmp][$this->arrayCarrosselsIndexes[$tmp]])->toArray();
                        }
                    }
                    break;
                case 'subplaylist':
                    if (!$isSub) {
                        $subPlaylist = $this->ProcessaPlaylist($cont['subplaylist_id'], true, '', $versao);


                        foreach ($subPlaylist as $tmpCont ){
                            $dados[] = $tmpCont;
                        }

                    }
                    break;
            }
        }

        return $dados;
    }

    public function playlist(Request $request, $token)
    {
        $player = Players::where('token_id', $token)->first();

        $dados = [];

        $this->arrayCarrossels = [];
        $this->arrayCarrosselsIndexes = [];

        if (count($player) > 0) {
            $this->atualiza_sinal_service($token);


            if (isset($player->playlist_id) && ($player->playlist_id != '')) {

                $playlist = Playlist::find($player->playlist_id);

                $playlistTmp = $this->ProcessaPlaylist($player->playlist_id);

            }

            foreach ($playlistTmp as $tmpCont ){
                $dados[] = $tmpCont;
            }

            return response()->json(['success' => true, 'mensagem' => 'Playlist do player.', 'dados' => $dados, 'updated_at' => $playlist->updated_at->toDateTimeString(), 'playlist_nome' => $playlist->nome], 200, [], JSON_UNESCAPED_UNICODE + JSON_NUMERIC_CHECK);
        } else {
            return response()->json(['success' => false, 'mensagem' => 'Playlist não localizada.'], 200, [], JSON_UNESCAPED_UNICODE);
        }
    }


    public function playlist_v2(Request $request, $token)
    {
        $player = Players::where('token_id', $token)->first();

        $dados = [];

        $this->arrayCarrossels = [];
        $this->arrayCarrosselsIndexes = [];

        if (count($player) > 0) {
            $this->atualiza_sinal_service($token);

            if (isset($player->playlist_id) && ($player->playlist_id != '')) {

                $playlist = Playlist::find($player->playlist_id);
                $playlistTmp = $this->ProcessaPlaylist($player->playlist_id);
            }

//            dd($playlistTmp);

            $conteudos = collect($playlistTmp)->unique()->values();

//            dd($conteudos);

            foreach ($playlistTmp as $tmpCont ){
                $tmp = [];

                $tmp['id'] = $tmpCont['id'];
                $tmp['tipo'] = $tmpCont['tipo'];

                $dados[] = $tmp;
            }


//            dd($conteudos);

            return response()->json(['success' => true, 'mensagem' => 'Playlist do player.', 'dados' => $dados, 'updated_at' => $playlist->updated_at->toDateTimeString(), 'playlist_nome' => $playlist->nome, 'conteudos'=>$conteudos], 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json(['success' => false, 'mensagem' => 'Playlist não localizada.'], 200, [], JSON_UNESCAPED_UNICODE);
        }
    }

    public function playlist_v3(Request $request, $token)
    {

        // criação de playlist
        $player = Players::where('token_id', $token)->first();

        $dados = [];

        $this->arrayCarrossels = [];
        $this->arrayCarrosselsIndexes = [];

        if (count($player) > 0) {
            $this->atualiza_sinal_service($token);

            if (isset($player->playlist_id) && ($player->playlist_id != '')) {

                $playlist = Playlist::find($player->playlist_id);
                $playlistTmp = $this->ProcessaPlaylist($player->playlist_id, false, '', 'v3');
            }

//            dd($playlistTmp);

            $conteudos = collect($playlistTmp)->where('tipo', '<>', 'layout' )->unique('id')->values();

//            dd($conteudos);

            foreach ($playlistTmp as $tmpCont ){
                $tmp = [];

                $tmp['id'] = $tmpCont['id'];
                $tmp['tipo'] = $tmpCont['tipo'];

                $dados[] = $tmp;
            }
            $result_playlist = $dados;

            // fim playlist

            // layouts

            $layouts = collect(Layouts::where('ativo', true)->get())->toArray();

            $temDados = (count($result_playlist) > 0) && (count($conteudos) > 0);


            return response()->json(['success' => $temDados, 'mensagem' => 'Playlist do player.', 'dados' => $result_playlist, 'layouts' => $layouts, 'updated_at' => $playlist->updated_at->toDateTimeString(), 'playlist_nome' => $playlist->nome, 'conteudos'=>$conteudos], 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json(['success' => false, 'mensagem' => 'Playlist não localizada.'], 200, [], JSON_UNESCAPED_UNICODE);
        }
    }

    public function playlist_x(Request $request, $token, $version = 'v4')
    {

        // criação de playlist
        $player = Players::where('token_id', $token)->first();

        $dados = [];

        $this->arrayCarrossels = [];
        $this->arrayCarrosselsIndexes = [];

        if (count($player) > 0) {
            $this->atualiza_sinal_service($token);

            if (isset($player->playlist_id) && ($player->playlist_id != '')) {

                $playlist = Playlist::find($player->playlist_id);
                $playlistTmp = $this->ProcessaPlaylist($player->playlist_id, false, '', 'v3');
            }

//            dd($playlistTmp);

            $conteudos = collect($playlistTmp)->where('tipo', '<>', 'layout' )->unique('id')->values();

//            dd($conteudos);

            foreach ($playlistTmp as $tmpCont ){
                $tmp = [];

                $tmp['id'] = $tmpCont['id'];
                $tmp['tipo'] = $tmpCont['tipo'];

                $dados[] = $tmp;
            }
            $result_playlist = $dados;

            // fim playlist

            // layouts

            $layouts = collect(Layouts::where('ativo', true)->get())->toArray();

            $templates = [
                [
                    'nome'=>'Barra v1',
                    'link'=>Storage::disk('public')->url('/templates/1/1.zip')
                    ]
            ];

            $temDados = (count($result_playlist) > 0) && (count($conteudos) > 0);

            return response()->json([
                'success' => $temDados,
                'mensagem' => 'Playlist do player.',
                'dados' => $result_playlist,
                'layouts' => $layouts,
                'templates' => $templates,
                'updated_at' => $playlist->updated_at->toDateTimeString(),
                'playlist_nome' => $playlist->nome,
                'conteudos'=>$conteudos
            ], 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json(['success' => false, 'mensagem' => 'Playlist não localizada.'], 200, [], JSON_UNESCAPED_UNICODE);
        }
    }

    public function download_conteudo(Request $request, $conteudo_id, $token_id = 0){

        try{
            $conteudo = PlaylistConteudo::find($conteudo_id);

            $linkFile = $conteudo->link;

            $path = Storage::disk('public')->path($linkFile);
//            $path = storage_path($linkFile);
            $size = $conteudo->size;
            $type = $conteudo->mime;


//            dd($path);

            $start = 0;
            $length = $size;
            $headers = [
                'Content-Type' => $type,
                'Content-Length' => $size,
                'Accept-Ranges' => 'bytes',
                'Content-Transfer-Encoding' => 'binary',
                'Content-Disposition' => 'attachment; filename="' . $path . '"'
            ];
            if (false !== $range = $request->server('HTTP_RANGE', false)) {
                list($param, $range) = explode('=', $range);
                if (strtolower(trim($param)) !== 'bytes') {
                    header('HTTP/1.1 400 Invalid Request');
                    exit;
                }
                list($from, $to) = explode('-', $range);
                if ($from === '') {
                    $end = $size - 1;
                    $start = $end - intval($from);
                } elseif ($to === '') {
                    $start = intval($from);
                    $end = $size - 1;
                } else {
                    $start = intval($from);
                    $end = intval($to);
                }
                if ($end >= $length) {
                    $end = $length - 1;
                }
                $length = $end - $start + 1;
                $headers['Content-Range'] = sprintf('bytes %d-%d/%d', $start, $end, $size);
                $headers['Content-Length'] = $length;
            }

            return response()->download($path, basename($path), $headers);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'erro' => $e->getMessage()], 400, [], JSON_UNESCAPED_UNICODE);
        }
    }


    public function playlist_tempo(Request $request, $playlist_id = '')
    {
        $post_playlist = $request->get('playlist');

        $this->arrayCarrossels = [];
        $this->arrayCarrosselsIndexes = [];


        $playlistTmp = $this->ProcessaPlaylist($playlist_id, false, $post_playlist);

//        dd($playlistTmp);

        $tempos = [];

        $tempos['total'] = Carbon::createFromFormat('H:i:s', '00:00:00');
        $tempos['subplaylist'] = Carbon::createFromFormat('H:i:s', '00:00:00');
        $tempos['carrossel'] = Carbon::createFromFormat('H:i:s', '00:00:00');
        $tempos['rss'] = Carbon::createFromFormat('H:i:s', '00:00:00');
        $tempos['conteudo'] = Carbon::createFromFormat('H:i:s', '00:00:00');

//        $tempoTotal = Carbon::createFromFormat('H:i:s', '00:00:00');

        foreach ($playlistTmp as $tmpCont ){
            $tempoTmp = explode(':', $tmpCont['tempo']);

//            dd($tempoTmp);
            switch ($tmpCont['tipo']) {
                case 'subplaylist':
                    $tempos['subplaylist']->addMinutes($tempoTmp[0])->addSeconds($tempoTmp[1]);
                    break;
                case 'carrossel':
                    $tempos['carrossel']->addMinutes($tempoTmp[0])->addSeconds($tempoTmp[1]);
                    break;
                case 'rss':
                    $tempos['rss']->addMinutes($tempoTmp[0])->addSeconds($tempoTmp[1]);
                    break;
                case 'conteudo':
                    $tempos['conteudo']->addMinutes($tempoTmp[0])->addSeconds($tempoTmp[1]);
                    break;
            }

            $tempos['total']->addMinutes($tempoTmp[0])->addSeconds($tempoTmp[1]);
        }

        foreach ($tempos as $key => $value){
            $tempos[$key] = $value->toTimeString();
        }


//        dd($tempoTotal->toTimeString());

        return response()->json(['tempos' => $tempos], 200, [], JSON_UNESCAPED_UNICODE);

    }


    public function sendLog(Request $request, $token)
    {

        try {
            $player = Players::where('token_id', $token)->first();

//            verificar se precisamos validar mesmo?
            if (count($player) < 1) {
                return response()->json(['success' => false, 'mensagem' => 'Player não localizado'], 422, [], JSON_UNESCAPED_UNICODE);
            }

            $input = $request->json();
            $posts = collect($input)->toArray();

            // ajustar entrada quando o player envia o token_id, durante migração  de versões


            foreach ($posts as $post) {
                $existente = PlayersLogs::where('horario', $post['horario'])
                    ->where('player_id', $post['player_id'])
                    ->get();

                if (count($existente) < 1) {
                    PlayersLogs::create($post);
                }
            }

            return response()->json(['success' => true], 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'mensagem' => 'Erro atualizando os logs'], 422, [], JSON_UNESCAPED_UNICODE);
        }


//        dd($player);


    }

    public function sendLog_v2(Request $request, $token)
    {

        try {
            $player = Players::where('token_id', $token)->first();

//            verificar se precisamos validar mesmo?
            if (count($player) < 1) {
                return response()->json(['success' => false, 'mensagem' => 'Player não localizado'], 422, [], JSON_UNESCAPED_UNICODE);
            }

            $input = $request->json();
            $posts = collect($input)->toArray();

            // ajustar entrada quando o player envia o token_id, durante migração  de versões

            foreach ($posts as $post) {

                if (!DB::table('players_logs')
                    ->where('horario', $post['horario'])
                    ->where('local_id', $post['local_id'])
                    ->where('player_id', $post['player_id'])
                    ->exists()){
                    PlayersLogs::create($post);
                }
            }
            return response()->json(['success' => true], 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'mensagem' => 'Erro atualizando os logs'], 422, [], JSON_UNESCAPED_UNICODE);
        }


//        dd($player);


    }


    public function push_send($token, $cmd)
    {
        $jsonResult = false;
        $player = Players::where('token_id', $token)->first();

        if (count($player) > 0) {
            $curlSession = curl_init();

            $url = 'https://fcm.googleapis.com/fcm/send';

            $data = [
                "data" => [
                    //            "title" => "This is an FCM notification message!",
                    "message" => $cmd
                ],
                "registration_ids" => [
                    $player->token_push_android
                ],
                "time_to_live"=>0,
                "apns" => [
                    "headers" => [
                        "apns-expiration" => "0"
                    ]
                ],
                "android" => [
                    "ttl" => "0s"
                ],
                "webpush" => [
                    "headers" => [
                        "TTL" => "0"
                    ]
                ]
            ];

            $headers = [
                "Content-Type:application/json",
                "Authorization:key=AAAAN8aAh88:APA91bFa7aqlSPt_62O5lrvX8rraftgr9VjybM3EXUnGmKk1HIDUKMW1tmRpB_jsvaVRnRZSEzux0GJ4l_lBoHdQms2y4vrNS50W_vz6-yV8sySC8nRj18lPuQS-1XZcOanInc6Zo9Kc"];


            $jsonData = json_encode($data);

            //        dd($jsonData);

            //Pede o que retorne o resultado como string
            curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($curlSession, CURLOPT_URL, $url);
            curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curlSession, CURLOPT_POST, 1);
            curl_setopt($curlSession, CURLOPT_POSTFIELDS, $jsonData);
            curl_setopt($curlSession, CURLOPT_HTTPHEADER, $headers);


            $jsonResult = curl_exec($curlSession);
        }


        if ($jsonResult === FALSE) {
            return response()->json(['success' => false, 'retorno' => $jsonResult, 'mensagem' => 'Erro enviando comando push'], 422, [], JSON_UNESCAPED_UNICODE);
        }

        return response()->json(['success' => true, 'retorno' => $jsonResult], 200, [], JSON_UNESCAPED_UNICODE);

    }

    public function screenshot(Request $request, $token)
    {

        try {

            $file = $request->file('file');

            $file->storeAs('public/players/screenshot', $token . '.jpg');

            return response()->json(['success' => true], 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'mensagem' => 'Erro atualizando os logs'], 422, [], JSON_UNESCAPED_UNICODE);
        }

    }

    public function layouts_v2(Request $request, $token)
    {
        try {
            $this->atualiza_sinal_service($token);


            $layouts = collect(Layouts::where('ativo', true)->get())->toArray();

            return response()->json(['success' => true, 'mensagem' => 'Layouts', 'layouts' => $layouts], 200, [], JSON_UNESCAPED_UNICODE);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'mensagem' => 'Layouts não localizada.'], 200, [], JSON_UNESCAPED_UNICODE);
        }
    }


    public function callback_cloud_thumbnail(Request $request, $id = 0)
    {
        Log::debug('Retorno callback_cloud_thumb['.$id.']');

        $conteudo = PlaylistConteudo::find($id);

        if (count($conteudo) > 0){
            $mimeTmp = $conteudo->mime;

            if (is_str_contain($mimeTmp, 'video')) {
                // apagar arquivo no callback

                $extensionTmp = 'png';
                $nomesomente = pathinfo('storage/'.$conteudo->link, PATHINFO_FILENAME);
                $filenameTmp = $nomesomente . ".{$extensionTmp}";

                if (Storage::disk('public')->exists($conteudo->thumbnail)){
                    Storage::disk('public')->delete($conteudo->thumbnail); // deleta antigo
                }

                $conteudo->thumbnail = 'thumbnail/playlistconteudo/' . $filenameTmp;

                CloudConvert::useProcess($request['url'])
                    ->save('storage/' . $conteudo->thumbnail);

                $conteudo->save();
            }
        }

        Log::debug('Retorno callback_cloud_thumb['.$id.']');
    }
//    public function callback_cloud(Request $request, $id)
//    {
//        try{
//            Log::debug( 'Retorno callback_cloud['.$id.']');
//
//            //        dd($request);
//
//            $conteudo = PlaylistConteudo::where('id', $id)
//                ->where('processado', false)->first();
//
//            if (count($conteudo) > 0){
//                $mimeTmp = $conteudo->mime;
//
//                if (is_str_contain($mimeTmp, 'video')) {
//
//                    $conteudo->mime = 'video/mp4';
//
//                    // apagar arquivo no callback
//
//                    $extensionTmp = 'mp4';
//                    $nomesomente = pathinfo('storage/'.$conteudo->link, PATHINFO_FILENAME);
//                    $filenameTmp = $nomesomente . ".{$extensionTmp}";
//
//                    $arquivoAntigo = $conteudo->link;
//
//                    if ( ($filenameTmp != $conteudo->filename) && (Storage::disk('public')->exists($arquivoAntigo)) ) {
//                        Storage::disk('public')->delete($arquivoAntigo); // deleta antigo
//                    }
//                    $conteudo->filename = $filenameTmp;
//                    $conteudo->link = 'playlistconteudo/' . $filenameTmp;
//
//
//                    CloudConvert::useProcess($request['url'])
//                        ->save('storage/' . $conteudo->link);
//
//
//
//
//                    $conteudo->size = Storage::disk('public')->size($conteudo->link);
//
//                    $conteudo->processado = true;
//
//                    $conteudo->save();
//
//
//                    $conteudo->UpdateStatusPlaylistsForConteudo();
//                }
//            }
//
//            return response()->json(['success' => true, 'mensagem' => 'Callback ok'], 200, [], JSON_UNESCAPED_UNICODE);
//
//        } catch (\Exception $e) {
//            Log::debug( 'Erro callback_cloud['.$id.']: '.$e->getMessage());
//            return response()->json(['success' => false, 'mensagem' => 'Erro executando callback id: '.$id], 500, [], JSON_UNESCAPED_UNICODE);
//        }
//    }

    public function callback_cloud(Request $request, $id)
    {
        try{
            Log::debug( 'Retorno callback_cloud['.$id.']');

    //        dd($request);

            $conteudo = PlaylistConteudo::where('id', $id)
                ->where('processado', false)->first();

            if (count($conteudo) > 0){
                $mimeTmp = $conteudo->mime;

                if (is_str_contain($mimeTmp, 'video')) {

                    $conteudo->mime = 'video/mp4';

                    // apagar arquivo no callback

                    $extensionTmp = 'mp4';
                    $nomesomente = pathinfo('storage/'.$conteudo->link, PATHINFO_FILENAME);
                    $filenameTmp = $nomesomente . ".{$extensionTmp}";

                    $arquivoAntigo = $conteudo->link;

                    if ( ($filenameTmp != $conteudo->filename) && (Storage::disk('public')->exists($arquivoAntigo)) ) {
                        Storage::disk('public')->delete($arquivoAntigo); // deleta antigo
                    }
                    $conteudo->filename = $filenameTmp;
                    $conteudo->link = 'playlistconteudo/' . $filenameTmp;


                    CloudConvert::useProcess($request['url'])
                        ->save('storage/' . $conteudo->link);

                    $conteudo->size = Storage::disk('public')->size($conteudo->link);

                    $conteudo->processado = true;

                    $conteudo->save();

                    $conteudo->UpdateStatusPlaylistsForConteudo();

                    $user = User::find($conteudo->user_id);
                    event(new VideoConverterFinish($conteudo, $user));


                    // cria thumb
//                    $processes = CloudConvert::getProcesses();
//
//                    CloudConvert::deleteProcess($request['id']);
//
//                    $extensionTmp = 'png';
//                    $filenameTmp = $nomesomente . ".{$extensionTmp}";
//
//                    if (Storage::disk('public')->exists($conteudo->thumbnail)){
//                        Storage::disk('public')->delete($conteudo->thumbnail); // deleta antigo
//                    }
//
//                    $conteudo->thumbnail = 'thumbnail/playlistconteudo/' . $filenameTmp;
//
//                    CloudConvert::file(url('storage/' . $conteudo->link))->withOptions([
//                                    'thumbnail_format' => 'png',
//                                    'thumbnail_size' => '300x168',
//                            ])
//                        ->info()
//                        ->download()
//                        ->save('storage/' . $conteudo->thumbnail);
//
//                    $conteudo->save();



                }
            }

            return response()->json(['success' => true, 'mensagem' => 'Callback ok'], 200, [], JSON_UNESCAPED_UNICODE);

        } catch (\Exception $e) {
            Log::debug( 'Erro callback_cloud['.$id.']: '.$e->getMessage());
            return response()->json(['success' => false, 'mensagem' => 'Erro executando callback id: '.$id], 500, [], JSON_UNESCAPED_UNICODE);
        }
    }

    public function layouts(Request $request, $token)
    {
        try {
            $this->atualiza_sinal_service($token);

            $layouts = [
                [
                    'id' => '1',
                    'nome' => 'Layout padrão',
                    'padrao' => true,
                    'largura' => 1920,
                    'altura' => 1080,
                    'areas' => [
                        [
                            'largura' => 1920,
                            'altura' => 1080,
                            'posicaoX' => 0,
                            'posicaoY' => 0,
                            'areaprincipal' => true
                        ]
                    ]
                ],
                [
                    'id' => '2',
                    'nome' => 'Layout Barra',
                    'padrao' => false,
                    'largura' => 1920,
                    'altura' => 1080,
                    'areas' => [
                        [
                            'largura' => 1920,
                            'altura' => 100,
                            'posicaoX' => 0,
                            'posicaoY' => 0,
                            'areaprincipal' => false
                        ],
                        [
                            'largura' => 1920,
                            'altura' => 980,
                            'posicaoX' => 0,
                            'posicaoY' => 101,
                            'areaprincipal' => true
                        ]
                    ]
                ],
                [
                    'id' => '3',
                    'nome' => 'Layout padrão',
                    'padrao' => true,
                    'largura' => 1920,
                    'altura' => 1080,
                    'areas' => [
                        [
                            'largura' => 1920,
                            'altura' => 1080,
                            'posicaoX' => 0,
                            'posicaoY' => 0,
                            'areaprincipal' => true
                        ]
                    ]
                ],

            ];


            return response()->json(['success' => true, 'mensagem' => 'Layouts.', 'layouts' => $layouts], 200, [], JSON_UNESCAPED_UNICODE);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'mensagem' => 'Layouts não localizada.'], 200, [], JSON_UNESCAPED_UNICODE);
        }
    }

}
