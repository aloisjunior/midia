<?php

namespace ARsig\Http\Controllers\backend;

use ARsig\Http\Requests\backend\CampanhaRequest;
use ARsig\Models\Campanha;
use Illuminate\Http\Request;
use ARsig\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CampanhaController extends Controller
{
    protected $dataModel;

    public function __construct(Campanha $campanha)
    {
        $this->middleware('auth');
        $this->dataModel = $campanha;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filtro = $request['filtro'];

        if ((isset($filtro)) && (!(trim($filtro) === ''))) {
            $consulta = 'match(nome,
                                descricao,                                 
                                tags,
                                ) against("' . $filtro . '" IN BOOLEAN MODE)';

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

    public function store(CampanhaRequest $request)
    {
//        try {
            $input = $request->all();

//            dd($input);

//            $input['tags'] = implodeArray($input['list_tags']);
//            $input['data_inicio_envio'] = $input['_data_inicio_envio'];


//            $input['user_id'] = Auth::user()->id;
            $campanha = $this->dataModel->create($input);

            $campanha->user()->associate(Auth::user());

            return response()->json(['result'=>'Arquivo inserido com sucesso', 'id'=>$campanha->id], 200);
//        } catch (\Exception $e) {
//
//            return response()->json('error:' . $e->getMessage(), 400);
//        }
    }


    public function edit($id)
    {
        $return = $this->dataModel->find($id);

        return response()->json($return);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \ARsig\Models\Estacao  $estacao
     * @return \Illuminate\Http\Response
     */
    public function update(CampanhaRequest $request, $id)
    {
        try {
//            dd($request);
            $input = $request->all();

            $campanha = $this->dataModel->find($id);

            $input['tags'] = implodeArray($input['list_tags']);

            $campanha->update($input);

            return response()->json('Arquivo alterado com sucesso', 200);
        } catch (\Exception $e) {
            return response()->json('error:' . $e->getMessage(), 400);
        }
    }




    public function destroy($id)
    {
        try {

//            $campanha = $this->dataModel->find($id);


            $this->dataModel->destroy($id);


            return response()->json('Arquivo excluído com sucesso', 200);
        } catch (\Exception $e) {

            return response()->json('error:' . $e->getMessage(), 400);
        }
    }

    public function tags(Request $request)
    {
        $tags = array();

        //$listatags = DB::table('arquivos')
        //    ->where('ativo', 'S')->get();

        $listatags = DB::table('campanha')->get();

        if (count($listatags) > 0) {
            $tagstmp = array();

            foreach ($listatags as $reg) {
                if (!(is_null($reg->tags)) && !(trim($reg->tags) === '')) {
                    array_push($tagstmp, explode(",", $reg->tags));
                }
            }

            foreach ($tagstmp as $tag) {
                $tags = array_merge($tags, $tag);
            }
            $tags = array_unique($tags);

            $final = array();

//            foreach ($tags as $tag => $tmp) {
//                $final[$tmp] = $tmp;
//            }
//            $tags = $final;
        }
        return collect(array_unique($tags))->values();
    }

}
