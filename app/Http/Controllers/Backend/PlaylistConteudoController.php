<?php

namespace ARsig\Http\Controllers\Backend;

use ARsig\Http\Controllers\Controller;
use ARsig\Http\Requests\backend\PlaylistConteudoRequest;
use ARsig\Models\PlaylistConteudo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use RobbieP\CloudConvertLaravel\Facades\CloudConvert;


class PlaylistConteudoController extends Controller
{
    protected $dataModel;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(PlaylistConteudo $playlistConteudo)
    {
        $this->middleware('auth');
        $this->dataModel = $playlistConteudo;
    }

    public function index(Request $request)
    {
        $filtro = $request['filtro'];
        $pesquisa = isset($request['tag']) ? $request['tag'] : '';

        $return = [];



        if ((isset($filtro)) && (!(trim($filtro) === ''))) {
            $consulta = 'match(nome, filename, tags ) against("' . $filtro . '" IN BOOLEAN MODE)';

            if ($filtro === '*') {
                $consulta = '1=1';
            }


            $return = $this->dataModel
                ->whereRaw($consulta)
                ->with('playlists')
                ->get();

        } else {
            $return = $this->dataModel
                ->where('id', '0')
                ->with('playlists')
                ->get();
        }

        if ((isset($pesquisa)) && (!(trim($pesquisa) === ''))) {
            $consulta = 'lower(tags) like "%' . strtolower($pesquisa) . '%"';

            if ($pesquisa === '*') {
                $consulta = '1=1';
            }

            $return = $this->dataModel
                ->whereRaw($consulta)
                ->with('playlists')
                ->get();

        }

        // calcular duracao para a tag
        $tempos = [];

        $tempos['duracao'] = Carbon::createFromFormat('H:i:s', '00:00:00');

//        $tempoTotal = Carbon::createFromFormat('H:i:s', '00:00:00');

        foreach ($return as $tmpCont ){
            $tempoTmp = explode(':', $tmpCont['tempo']);

//            dd($tempoTmp);
            $tempos['duracao']->addMinutes($tempoTmp[0])->addSeconds($tempoTmp[1]);

        }

        foreach ($tempos as $key => $value){
            $tempos[$key] = $value->toTimeString();
        }


        return response()->json(['data'=>$return, 'duracao'=>$tempos['duracao']], 200, [], JSON_UNESCAPED_UNICODE + JSON_NUMERIC_CHECK);
//        return response()->json(['data'=>$return, 'duracao'=>$tempos['duracao']], 200, [], JSON_NUMERIC_CHECK);
    }

    public function store(PlaylistConteudoRequest $request)
    {
        try {
            $input = $request->all();

            $input['link'] = $input['arquivo'];

//            $input['tags'] = implodeArray($input['list_tags']);

            $input['tempo'] = $input['tempo'] == '0' ? '00:15' : $input['tempo'];

            $input['user_id'] = Auth::id();

            if (isset($input['_validade_de'])) {
                $input['validade_de'] = $input['_validade_de'];
            }
            if (isset($input['_validade_ate'])) {
                $input['validade_ate'] = $input['_validade_ate'];
            }

            if ($input['tipo_conteudo'] != 'arquivo'){
//                try {
//                    if (Storage::disk('public')->exists($input['link'])){
//                        Storage::disk('public')->delete($input['link']);
//                    }
//                    if (Storage::disk('public')->exists($input['thumbnail'])) {
//                        Storage::disk('public')->delete($input['thumbnail']);
//                    }
//                } catch (\Exception $e) {
//
//                }
                $input['mime'] = '';
                $input['filename'] = '';
                $input['link'] = '';
                $input['thumbnail'] = '';
                $input['size'] = '0';
            }

            $conteudo = $this->dataModel->create($input);


            if (is_str_contain($conteudo->mime, 'video')) {
                $conteudo->update(['processado'=>false]);
                $this->startCloudConvert($conteudo->id);
            } else {
                $conteudo->update(['processado'=>true]);

                $conteudo->UpdateStatusPlaylistsForConteudo();
//                $playlists = collect(PlaylistPlaylistConteudo::whereIn('tag_carrossel', $input['list_tags'])->get())->unique('playlist_id');
//
//                foreach ($playlists as $playlist) {
//                    Playlist::find($playlist->playlist_id)->touch();
//                }
            }


            return \response()->json('Conteúdo inserido com sucesso', 200);
        } catch (\Exception $e) {

            return \response()->json('error:' . $e->getMessage(), 400);
        }
    }

    public function edit($id)
    {

        $return = $this->dataModel->with('cliente')->find($id);

        return response()->json($return);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(PlaylistConteudoRequest $request, $id)
    {
        try {
//            dd($request);
            $input = $request->all();

            $conteudo = $this->dataModel->find($id);

//            $input['tags'] = implodeArray($input['list_tags']);
            $input['tempo'] = $input['tempo'] == '0' ? '00:15' : $input['tempo'];

            if (isset($input['_validade_de'])) {
                $input['validade_de'] = $input['_validade_de'];
            }
            if (isset($input['_validade_ate'])) {
                $input['validade_ate'] = $input['_validade_ate'];
            }

            $fileNameAntigo = $conteudo->filename;

            if ($input['tipo_conteudo'] != 'arquivo'){
//                try {
//                    if (Storage::disk('public')->exists($input['link'])){
//                        Storage::disk('public')->delete($input['link']);
//                    }
//                    if (Storage::disk('public')->exists($input['thumbnail'])) {
//                        Storage::disk('public')->delete($input['thumbnail']);
//                    }
//                } catch (\Exception $e) {
//
//                }

                $input['mime'] = '';
                $input['filename'] = '';
                $input['link'] = '';
                $input['thumbnail'] = '';
                $input['size'] = '0';
            }

            $conteudo->update($input);


            if ((is_str_contain($conteudo->mime, 'video')) &&
                ($fileNameAntigo != $conteudo->filename)) {
                $conteudo->update(['processado' => false]);
                $this->startCloudConvert($conteudo->id);
            } else {
                $conteudo->update(['processado' => true]);
                $conteudo->UpdateStatusPlaylistsForConteudo();

//                $playlists = collect(
//                    PlaylistPlaylistConteudo::whereIn('tag_carrossel', array_values($input['list_tags']))
//                        ->orWhere('playlist_conteudo_id', $id)
//                        ->get()
//                )->unique('playlist_id');
//
////            dd($playlists);
//
//                $subplaylists = collect(
//                    PlaylistPlaylistConteudo::whereIn('subplaylist_id', $playlists->pluck('playlist_id'))
//                        ->get()
//                )->unique('playlist_id');
//
////            dd($subplaylists);
//
//                foreach ($playlists as $playlist) {
//                    Playlist::find($playlist->playlist_id)->touch();
//                }
//
//                foreach ($subplaylists as $subplay) {
//                    Playlist::find($subplay->playlist_id)->touch();
//                }

            }

//            dd($input);


            return \response()->json('Arquivo alterado com sucesso', 200);
        } catch (\Exception $e) {
            return \response()->json('error:' . $e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        try {

            $conteudo = $this->dataModel->find($id);

//            $list_tags = $conteudo->list_tags;


            if ($conteudo->tipo_conteudo == 'arquivo') {
                try {
                    Storage::disk('public')->delete($conteudo->link);
                    Storage::disk('public')->delete($conteudo->thumbnail);
                } catch (\Exception $e) {

                }

            }

            $conteudo->update(['ativo'=>false, 'processado'=>false]);

            $conteudo->UpdateStatusPlaylistsForConteudo();

            DB::table('playlist_playlist_conteudo')->where('playlist_conteudo_id', $id)->delete();
            $conteudo->delete();

//            $playlists = collect(PlaylistPlaylistConteudo::whereIn('tag_carrossel', $list_tags)
//                ->whereOr('playlist_conteudo_id', $id)
//                ->get()
//            )->unique('playlist_id');
//
//            foreach ($playlists as $playlist) {
//                Playlist::find($playlist->playlist_id)->touch();
//            }


            return \response()->json('Arquivo excluído com sucesso', 200);
        } catch (\Exception $e) {

            return \response()->json('error:' . $e->getMessage(), 400);
        }
    }

    public function tags(Request $request)
    {
        $tags = array();

        $listatags = $this->dataModel->get();

        if (count($listatags) > 0) {

            foreach ($listatags as $reg) {
                $tags = array_merge($tags, $reg->tags);
            }
            $tags = array_unique($tags);

        }

        $result = collect(array_unique($tags))->sort()->values();


        return response()->json($result, 200, [], JSON_UNESCAPED_UNICODE);
//        return collect(array_unique($tags))->sort()->values();
    }


//    public function tags(Request $request)
//    {
//        $tags = array();
//
//        $listatags = DB::table('playlist_conteudo')->get();
//
//        if (count($listatags) > 0) {
//            $tagstmp = array();
//
//            foreach ($listatags as $reg) {
//                if (!(is_null($reg->tags)) && !(trim($reg->tags) === '')) {
//                    array_push($tagstmp, explode(",", $reg->tags));
//                }
//            }
//
//            foreach ($tagstmp as $tag) {
//                $tags = array_merge($tags, $tag);
//            }
//            $tags = array_unique($tags);
//
//        }
//
//        return collect(array_unique($tags))->sort()->values();
//    }

    public function uploadThumbnail(Request $request, $dir)
    {
        set_time_limit(120);
        ini_set('max_execution_time', 120);

        $input = $request->all();

        $rules = [];

        $rules['file'] = 'file|max:50000';

        $validation = Validator::make($input, $rules);

        if ($validation->fails()) {
            return \response()->make($validation->errors()->all(), 400);
        }

        $file = $request->file('file');

        $extension = $file->getClientOriginalExtension();
        $mime = $file->getClientMimeType();
        $size = $file->getSize();

        $directory = '';

        if ($dir != '') {
            $directory = $dir . '/';
        }


        $filename = $file->getClientOriginalName();

        $thumb = Image::make($file)->resize(384, 216, function ($constraint) {
            $constraint->aspectRatio();
        });

        Storage::disk('public')->makeDirectory('thumbnail/' . $directory);

        $thumb->save('storage/thumbnail/' . $directory . $filename);


        $thumbFile = 'thumbnail/' . $directory . $filename;

        $result = [
            'arquivo' => $directory . $filename,
            'filename' => $filename,
            'mime' => $mime,
            'size' => $size,
            'thumbnail' => $thumbFile,
        ];

//        dd($result);

        if (true) {
            return $result;
        } else {
            return \response()->json('error', 400);
        }
    }

    public function startCloudConvert($id)
    {
        try {

//            Log::debug('Entrou startCloudConvert('.$id.')');
            $conteudo = PlaylistConteudo::where('id', $id)
                ->where('processado', false)->first();

            if (count($conteudo) > 0) {
//                $extensionTmp = 'png';
//                $nomesomente = pathinfo('storage/' . $conteudo->link, PATHINFO_FILENAME);
//                $filenameTmp = $nomesomente . ".{$extensionTmp}";
//
//                if (Storage::disk('public')->exists($conteudo->thumbnail)) {
//                    Storage::disk('public')->delete($conteudo->thumbnail); // deleta antigo
//                }
//
//                $conteudo->thumbnail = 'thumbnail/playlistconteudo/' . $filenameTmp;
//
//                $responseCloud = CloudConvert::file(url('storage/' . $conteudo->link))->withOptions([
////                $responseCloud = CloudConvert::file(url('https://rothermel.com.br/storage/' . $conteudo->link))->withOptions([ // teste
//                    'thumbnail_format' => 'png',
//                    'thumbnail_size' => '250x',
//                ])->info()->save('storage/' . $conteudo->thumbnail)->response();





                $responseResult = CloudConvert::file(url('storage/' . $conteudo->link))->withOptions([
                    'video_resolution' => '1920x1080',
                    'video_codec' => 'H264',
                    'video_crf' => 18,
                    'video_qscale' => -1,
//                    'video_bitrate' => 1024,
//                    'video_bitrate_max' => null,

                    'faststart' => true,

                    'audio_codec' => 'AAC',
                    'audio_qscale' => -1,
                    'audio_bitrate' => 128,
//                    'audio_channels' => null,
                    'audio_frequency' => 44100,
//                    'audio_normalize' => null,

                ])->callback(url('api/e/signage/cloudconverter/callback/playlist_conteudo/' . $id))->convert('mp4')->response();


                $conteudo->save();

//                dd($responseResult);

                //            CloudConvert::file(url('storage/' . $conteudo->link))->withOptions([
                //                    'thumbnail_format' => 'png',
                //                    'thumbnail_size' => '300x',
                //            ])->callback(url('api/e/signage/cloudconverter/callback/thumbnail/playlist_conteudo/' . $conteudo->id))->info();
            }

//            return \response()->json('error', 200);

        } catch (\Exception $e) {
            Log::debug('Erro startCloudConvert: '.$e->getMessage());
            return \response()->json('error:' . $e->getMessage(), 400);
        }
    }

    public function upload(Request $request, $dir)
    {
        try {
            set_time_limit(900);
            ini_set('max_execution_time', 900);

            $input = $request->all();

            // comentado validações de arquivo
//        $rules = [];
//
//        $rules['file'] = 'file|max:50000';
//
//        $validation = Validator::make($input, $rules);
//
//        if ($validation->fails())
//        {
//            return \response()->make($validation->errors()->all(), 400);
//        }

            $file = $request->file('file');

            $extension = strtolower($file->getClientOriginalExtension());
            $mime = $file->getClientMimeType();
            $size = $file->getSize();

            $directory = '';

            if ($dir != '') {
                $directory = $dir . '/';
            }
            $nomesomente = sha1($file->getFilename() . time());
            $filename = $nomesomente . ".{$extension}";
            $filenameTmp = $filename;

            $upload_success = $file->storeAs('public/' . $directory, $filename);

//        teste com  a api CloudConvert
//        CloudConvert::file('storage/'.$directory.'/'.$filename)->quality(10)->to('jpg');

            $duration = 0;
            $possui_audio = false;

            $thumbFile = "";

            $mimeTmp = $mime;

            if (is_str_contain($mimeTmp, 'video')) {
                $mimeTmp = 'video';
            }


            switch ($mimeTmp) {
                case 'image/bmp':
                case 'image/jpg':
                case 'image/jpeg':
                case 'image/png':
                    // converte o arquivo para jpg e exclui original
                    CloudConvert::file('storage/' . $directory . '/' . $filename)->quality(90)->to('jpg');

                    if ($extension != 'jpg') {
                        Storage::disk('public')->delete($directory . '/' . $filename);
                    }

                    $mime = 'image/jpg';
                    $extensionTmp = 'jpg';
                    $filenameTmp = $nomesomente . ".{$extensionTmp}";

                    $size = Storage::disk('public')->size($directory . '/' . $filenameTmp);
                    // criar rotina de thumbs quando o primeiro upload for imagem

                    $thumb = Image::make('storage/' . $directory . '/' . $filenameTmp)->resize(384, 216, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                    Storage::disk('public')->makeDirectory('thumbnail/' . $directory);

                    $thumb->save('storage/thumbnail/' . $directory . $filenameTmp);

                    $thumbFile = 'thumbnail/' . $directory . $filenameTmp;
                    $duration = '00:15';


                    break;
                ////**************** fim thumbs
//            case 'video/mp4':
                case 'video':
                    // pega a duração do video
                    $getID3 = new \getID3();
                    $fileAna = $getID3->analyze('storage/' . $dir . '/' . $filename);
                    $duration = $fileAna['playtime_string'];
                    $possui_audio = !empty($fileAna['audio']['sample_rate']);
//                    dd($fileAna);

                    //convert

//                    CloudConvert::file('storage/' . $directory . '/' . $filename)->withOptions([
//                        'video_resolution' => '1920x1080',
//                        'video_codec' => 'H264',
//                        'video_crf' => 18,
//                        'video_qscale' => -1,
//                        'video_bitrate' => 1024,
//                        'video_bitrate_max' => null,
//
//                        'faststart' => true,
//
//                        'audio_codec' => 'AAC',
//                        'audio_qscale' => -1,
//                        'audio_bitrate' => 128,
//                        'audio_channels' => null,
//                        'audio_frequency' => 44100,
//                        'audio_normalize' => null,
//
//                    ])->to('mp4');

//                    $mime = 'video/mp4';
//                    $extensionTmp = 'mp4';
//                    $filenameTmp = $nomesomente . ".{$extensionTmp}";

//                    CloudConvert::file('storage/' . $dir . '/' . $filename)->withOptions([
//                        'video_resolution' => '1920x1080',
//                        'video_codec' => 'H264',
//                        'video_crf' => 18,
//                        'video_qscale' => -1,
//                        'video_bitrate' => 1024,
//                        'video_bitrate_max' => null,
//
//                        'faststart' => true,
//
//                        'audio_codec' => 'AAC',
//                        'audio_qscale' => -1,
//                        'audio_bitrate' => 128,
//                        'audio_channels' => null,
//                        'audio_frequency' => 44100,
//                        'audio_normalize' => null,
//
//                    ])->callback(url('api/e/signage/cloudconverter/callback/'.$dir.'/'.$filenameTmp))->convert('mp4');


                    $size = 0;
                // calcular o size no callback
//                    $size = Storage::disk('public')->size($directory . '/' . $filenameTmp);

                // apagar arquivo no callback
//                    if ($extension != 'mp4') {
//                        Storage::disk('public')->delete($directory . '/' . $filename);
//                    }


            }


            $result = [
                'arquivo' => $directory . $filenameTmp,
                'filename' => $filenameTmp,
                'mime' => $mime,
                'size' => $size,
                'duration' => $duration,
                'thumbnail' => $thumbFile,
                'possui_audio' => $possui_audio,
            ];

//        dd($result);

            if ($upload_success) {
                return $result;
            } else {
                return \response()->json('error', 400);
            }
        } catch (\Exception $e) {
            return \response()->json('error:' . $e->getMessage(), 400);
        }
    }


    // revisar
    public function removerimagens(Request $request)
    {
        set_time_limit(120);
        ini_set('max_execution_time', 120);

        $arquivos = $request->all();

//        dd($arquivos);

        $result = Storage::disk('public')->delete($arquivos);

//        foreach ($arquivos as  $key => $arquivo) {
//            $arquivos[$key] = 'thumbnail/'.$arquivo;
//        }

//        dd($arquivos);
//        $result = Storage::disk('public')->delete($arquivos);


//        foreach ($arquivos as $arquivo){
//            $result = Storage::delete($arquivo);
//        }

        if ($result) {
            return \response()->json('Arquivos sem uso excluidos', 200);
        } else {
            return \response()->json('Erro ao excluir arquivos', 400);
        }
    }


}
