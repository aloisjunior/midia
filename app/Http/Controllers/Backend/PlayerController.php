<?php

namespace ARsig\Http\Controllers\Backend;

use ARsig\Http\Requests\backend\PlayerRequest;
use ARsig\Models\Players;
use ARsig\Models\PlayersLogs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use ARsig\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlayerController extends Controller
{
    protected $dataModel;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Players $players)
    {
        $this->middleware('auth');
        $this->dataModel = $players;
    }

    public function index(Request $request)
    {
        $filtro = $request['filtro'];

        if ((isset($filtro)) && (!(trim($filtro) === ''))) {
            $consulta = 'match(nome, tags ) 
            against("' . $filtro . '" IN BOOLEAN MODE)';

            if ($filtro === '*') {
                $consulta = '1=1';
            }

            $return = $this->dataModel
                ->with('playlistatual')
                ->whereRaw($consulta)
                ->get();

        } else {
            $return = $this->dataModel
                ->with('playlistatual')
                ->where('id', '0')
                ->get();
        }

//        return response()->json($return);
        return response()->json(['data' => $return, 'hora_servidor' => Carbon::now()->format('Y-m-d H:i:s')], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function store(PlayerRequest $request)
    {
        try {
            $input = $request->all();

//            $input['tags'] = implodeArray($input['list_tags']);
//            $input['grupos'] = implodeArray($input['list_grupos']);

            $input['token_id'] = uniqid();
            $input['playlist'] = '{}';
            $input['user_id'] = Auth::id();
//            $input['playlist_id'] = $input['playlist'];
            $player = $this->dataModel->create($input);


//            $player->playlist()->associate($input['playlist']);

            return \response()->json('Arquivo inserido com sucesso', 200);
        } catch (\Exception $e) {

            return \response()->json('error:' . $e->getMessage(), 400);
        }
    }

    public function edit($id)
    {
        $return = $this->dataModel->find($id);

        return response()->json($return, 200, [], JSON_NUMERIC_CHECK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \ARsig\Models\Estacao    $estacao
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PlayerRequest $request, $id)
    {
        try {
//            dd($request);
            $input = $request->all();

            $player = $this->dataModel->find($id);


//            $input['tags'] = implodeArray($input['list_tags']);
//            $input['grupos'] = implodeArray($input['list_grupos']);

//            $input['playlist_id'] = $input['playlist'];

            $player->update($input);

            return response()->json('Arquivo alterado com sucesso', 200);
        } catch (\Exception $e) {
            return response()->json('error:' . $e->getMessage(), 400);
        }
    }

    public function playlist_update_group(Request $request)
    {
//        dd($request);
        try {
            $playlist_id = $request['playlist_id'];
            $players_id = $request['players_id'];

            $players = $this->dataModel
                ->whereIn('id', $players_id)
                ->update(['playlist_id' => $playlist_id]);
            return response()->json('Players atualizados com sucesso', 200);
        } catch (\Exception $e) {
            return response()->json('error:' . $e->getMessage(), 400);
        }
    }

    public function reutilizar(Request $request, $id)
    {
        try {
//            dd($request);
//            $input = $request->all();

            $player = $this->dataModel->find($id);

            $player->token_auth = '';
            $player->save();

            return response()->json('Token alterado com sucesso', 200);
        } catch (\Exception $e) {
            return response()->json('error:' . $e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \ARsig\Models\Estacao $estacao
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $contato = $this->dataModel->find($id);


            $contato->delete();


            return response()->json('Arquivo excluído com sucesso', 200);
        } catch (\Exception $e) {

            return response()->json('error:' . $e->getMessage(), 400);
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

    public function grupos(Request $request)
    {
        $grupos = array();

        $listagrupos = $this->dataModel->get();

        if (count($listagrupos) > 0) {

            foreach ($listagrupos as $reg) {
                $grupos = array_merge($grupos, $reg->grupos);
            }
            $grupos = array_unique($grupos);

        }

        $result = collect(array_unique($grupos))->sort()->values();


        return response()->json($result, 200, [], JSON_UNESCAPED_UNICODE);
//        return collect(array_unique($tags))->sort()->values();
    }

    public function tags_grupos(Request $request)
    {
        $tags = array();
        $grupos = array();

        $list = $this->dataModel->with('playlistatual')->get();

        if (count($list) > 0) {

            foreach ($list as $reg) {
                $grupos = array_merge($grupos, $reg->grupos);
                $tags = array_merge($tags, $reg->tags);
            }
            $grupos = array_unique($grupos);
            $tags = array_unique($tags);

        }

        $resultGrupo = collect(array_unique($grupos))->sort()->values();
        $resultTag = collect(array_unique($tags))->sort()->values();


        return response()->json(['tags' => $resultTag, 'grupos' => $resultGrupo, 'players' => $list], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function logs(Request $request, $id)
    {
        $input = $request->all();

        $player = $this->dataModel->find($id)->makeVisible('playlist')->toArray();

        if ($player['playlist']) {
            $unique = collect(json_decode($player['playlist']))->unique();
            $player['playlist'] = $unique->values()->all();
//                dd(json_decode(collect($player['playlist'])->unique('id')->values()->all()));

        }


//        dd($input);

        $dataInicio = $input['data_inicio'];

        if ($dataInicio == 0) {
            $dataInicio = Carbon::now()->toDateTimeString();
        }

//        $logs = DB::table('players_logs')
//            ->where('player_id', $id)
//            ->where('horario', '>', $dataInicio)
//            ->get();
        $logs = PlayersLogs::where('player_id', $id)
            ->where('horario', '>', $dataInicio)
            ->get();

        return response()->json(['data' => $logs, 'data_inicio' => $dataInicio, 'player' => $player, 'hora_servidor' => Carbon::now()->format('Y-m-d H:i:s')], 200, [], JSON_UNESCAPED_UNICODE);
    }


}
