<?php

namespace ARsig\Http\Controllers\Backend;

use ARsig\Http\Controllers\Api\SignageController;
use ARsig\Http\Requests\backend\PlaylistRequest;
use ARsig\Models\Playlist;
use ARsig\Models\PlaylistPlaylistConteudo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use ARsig\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlaylistController extends Controller
{

    protected $dataModel;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Playlist $playlist)
    {
        $this->middleware('auth');
        $this->dataModel = $playlist;
    }

    public function index(Request $request)
    {
        $filtro = $request['filtro'];

        if ((isset($filtro)) && (!(trim($filtro) === ''))) {
            $consulta = 'match(nome ) against("' . $filtro . '" IN BOOLEAN MODE)';

            if ($filtro === '*') {
                $consulta = '1=1';
            }

            $return = $this->dataModel
                ->whereRaw($consulta)
                ->get();

        } else {
            $return = $this->dataModel
                ->where('id', '0')
                ->get();
        }

        return response()->json($return);
    }


    public function store(PlaylistRequest $request)
    {
        try {
            $input = $request->all();

            $input['user_id'] = Auth::id();

            $playlist = $this->dataModel->create($input);


            if (isset($input['conteudos']))
            {
                $conteudos = $input['conteudos'];

//                DB::table('playlist_playlist_conteudo')->where('playlist_id', $id)->delete();

                foreach ($conteudos as $cont) {
                    $cont['id'] = isset($cont['id']) ? $cont['id'] : null;
                    $cont['tag_carrossel'] = isset($cont['tag_carrossel']) ? strtolower($cont['tag_carrossel']) : '';
                    $cont['tipo'] =isset($cont['tipo']) ? $cont['tipo'] : '';
                    $cont['tempo'] =isset($cont['tempo']) ? $cont['tempo'] : '';
                    $cont['subplaylist_id'] =isset($cont['subplaylist_id']) ? $cont['subplaylist_id'] : null;
                    $cont['layout_id'] =isset($cont['layout_id']) ? $cont['layout_id'] : null;

                    PlaylistPlaylistConteudo::create([
                        'playlist_id'=>$playlist->id,
                        'playlist_conteudo_id'=> isset($cont['conteudos']['id']) ? $cont['conteudos']['id'] : null,
                        'tag_carrossel'=> $cont['tag_carrossel'],
                        'tipo'=> $cont['tipo'],
                        'tempo'=> isset($cont['conteudos']['tempo']) ? $cont['conteudos']['tempo'] : $cont['tempo'],
                        'subplaylist_id'=> $cont['subplaylist_id'],
                        'layout_id'=> $cont['layout_id'],
                    ]);

                }
            }


            return \response()->json('Conteúdo inserido com sucesso', 200);
        } catch (\Exception $e) {

            return \response()->json('error:' . $e->getMessage(), 400);
        }
    }

    public function edit($id)
    {

        $return = collect($this->dataModel->find($id))->toArray();
        $return['conteudos'] = collect($this->dataModel->find($id)->conteudos()->get())->toArray();


//        $signage = new SignageController();
//        dd($signage->ProcessaPlaylist($id, false));
//

//    dd($return['conteudos']);

        foreach ($return['conteudos'] as $index => $cont){
            if ($cont['tag_carrossel'] != ''){
                $tmp = strtolower($cont['tag_carrossel']);

                $tempConteudos =
                    DB::table('playlist_conteudo')
                        ->whereRaw('lcase(tags) like "%'.$tmp.'%"')
                        ->get()
                        ->toArray()
                ;


                $return['conteudos'][$index]['conteudos'] = $tempConteudos;

                $tempos = [];

                $tempos['carrossel'] = Carbon::createFromFormat('H:i:s', '00:00:00');

//                dd($tempConteudos);

                foreach ($tempConteudos as $tmpCont ){
                    $tempoTmp = explode(':', $tmpCont->tempo);

//                    switch ($tmpCont['tipo']) {
//                        case 'carrossel':
                            $tempos['carrossel']->addMinutes($tempoTmp[0])->addSeconds($tempoTmp[1]);
//                            break;
//                    }

//                    $tempos['total']->addMinutes($tempoTmp[0])->addSeconds($tempoTmp[1]);
                }

                foreach ($tempos as $key => $value){
                    $tempos[$key] = $value->toTimeString();
                }


                $return['conteudos'][$index]['duracao'] = $tempos['carrossel'];
            }
            if ($cont['subplaylist_id'] != ''){
                $tmp = $cont['subplaylist_id'];
                $signage = new SignageController();
                $return['conteudos'][$index]['conteudos'] = $signage->ProcessaPlaylist($tmp, true);
            }
        }





        return response()->json($return, 200, [], JSON_UNESCAPED_UNICODE);

    }


    public function update(Request $request, $id)
    {
//        $input['ativo']  = ( isset($input['ativo']) ) ? true : false;

        $playlist = $this->dataModel->find($id);

        $input = $request->all();

        if (isset($input['conteudos']))
        {
            $conteudos = $input['conteudos'];

            DB::table('playlist_playlist_conteudo')->where('playlist_id', $id)->delete();

            foreach ($conteudos as $cont) {
                $cont['id'] = isset($cont['id']) ? $cont['id'] : null;
                $cont['tag_carrossel'] = isset($cont['tag_carrossel']) ? strtolower($cont['tag_carrossel']) : '';
                $cont['tipo'] =isset($cont['tipo']) ? $cont['tipo'] : '';
                $cont['tempo'] =isset($cont['tempo']) ? $cont['tempo'] : '';
                $cont['subplaylist_id'] =isset($cont['subplaylist_id']) ? $cont['subplaylist_id'] : null;
                $cont['layout_id'] =isset($cont['layout_id']) ? $cont['layout_id'] : null;

                PlaylistPlaylistConteudo::create([
                    'playlist_id'=>$id,
                    'playlist_conteudo_id'=> isset($cont['conteudos']['id']) ? $cont['conteudos']['id'] : null,
                    'tag_carrossel'=> $cont['tag_carrossel'],
                    'tipo'=> $cont['tipo'],
                    'tempo'=> isset($cont['conteudos']['tempo']) ? $cont['conteudos']['tempo'] : $cont['tempo'],
                    'subplaylist_id'=> $cont['subplaylist_id'],
                    'layout_id'=> $cont['layout_id'],
                ]);

            }
        }


        $playlist->update($input);

        $playlist->touch();

        $playlists = collect(
            PlaylistPlaylistConteudo::where('subplaylist_id', $id)
                                    ->get()
        )->unique('playlist_id');

//            dd($playlists);

        foreach ($playlists as $playlist){
            Playlist::find($playlist->playlist_id)->touch();
        }



        if($request->ajax()) {
            return response()->json('Registro alterado com sucesso',200);
        }

        return redirect()->route('admin.playlist.index')->with('status', 'Registro alterado com sucesso');

    }
    public function destroy(Request $request, $id)
    {
        $playlist = $this->dataModel->find($id);
        DB::table('playlist_playlist_conteudo')->where('playlist_id', $id)->delete();


        $playlist->delete();

        if($request->ajax()) {
            return response()->json('Registro excluído com sucesso',200);
        }

        return redirect()->route('admin.permissao.index')->with('status', 'Registro excluído com sucesso');
    }


    public function listar(Request $request, $playlist_id_hidden = ''){

        $sqlHide = '(ativo = true)';

        if ($playlist_id_hidden){
            $sqlHide .= ' and (id <> '.$playlist_id_hidden.')';
        }

        $playlists = $this->dataModel
            ->with('conteudos')
            ->whereRaw($sqlHide)
            ->orderBy('nome', 'asc')
            ->get();

        return response()->json($playlists, 200, [], JSON_NUMERIC_CHECK);
    }

}
