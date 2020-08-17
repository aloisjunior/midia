<?php

namespace ARsig\Http\Controllers\backend;

use ARsig\Http\Controllers\Controller;
use ARsig\Http\Requests\backend\ContatoRequest;
use ARsig\Models\Contatos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContatoController extends Controller
{
    protected $dataModel;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Contatos $contato)
    {
        $this->middleware('auth');
        $this->dataModel = $contato;
    }

    public function index(Request $request)
    {
        $filtro = $request['filtro'];

        if ((isset($filtro)) && (!(trim($filtro) === ''))) {
            $consulta = 'match(nome, empresa, cargo, url, telefone, endereco, email, observacao, tags, status, classificacao) 
            against("' . $filtro . '" IN BOOLEAN MODE)';

            if ($filtro === '*') {
                $consulta = '1=1';
            }

            $return = $this->dataModel
                ->whereRaw($consulta)
                ->with('ocorrencias')
                ->get();

        } else {
            $return = $this->dataModel
                ->where('id', '0')
                ->get();
        }

        return response()->json($return);
    }

    public function store(ContatoRequest $request)
    {
        try {
            $input = $request->all();

            $input['tags'] = implodeArray($input['list_tags']);
            $input['bounce'] = implodeArray($input['list_bounce']);
            $input['classificacao'] = implodeArray($input['list_classificacao']);


            $input['user_id'] = Auth::id();
            $input['cod_origem'] = '1';
            $contato = $this->dataModel->create($input);



            return \response()->json('Arquivo inserido com sucesso', 200);
        } catch (\Exception $e) {

            return \response()->json('error:' . $e->getMessage(), 400);
        }
    }


    public function edit($id)
    {
        $return = $this->dataModel->find($id);

        return response()->json($return);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        try {
//            dd($request);
            $input = $request->all();

            $contato = $this->dataModel->find($id);

            $input['tags'] = implodeArray($input['list_tags']);
            $input['bounce'] = implodeArray($input['list_bounce']);
            $input['classificacao'] = implodeArray($input['list_classificacao']);

            $contato->update($input);

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

            $contato = $this->dataModel->find($id);

//            Storage::disk('public')->delete($contato->link);

            $contato->ocorrencias()->delete();

            $contato->delete();


            return \response()->json('Arquivo excluído com sucesso', 200);
        } catch (\Exception $e) {

            return \response()->json('error:' . $e->getMessage(), 400);
        }
    }

    public function tags(Request $request)
    {
        $tags = array();

        //$listatags = DB::table('arquivos')
        //    ->where('ativo', 'S')->get();

        $listatags = DB::table('contatos')->get();

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
