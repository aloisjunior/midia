<?php

namespace ARsig\Http\Controllers\backend;

use ARsig\Http\Controllers\Controller;
use ARsig\Http\Requests\backend\ArquivoRequest;
use ARsig\Models\Arquivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;


class ArquivoController extends Controller
{
    protected $dataModel;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Arquivo $arquivo)
    {
        $this->middleware('auth');
        $this->dataModel = $arquivo;
    }

    public function index(Request $request)
    {
        $filtro = $request['filtro'];

        if ((isset($filtro)) && (!(trim($filtro) === ''))) {
            $consulta = 'match(nome, descricao, mime, link, tags, filename) against("' . $filtro . '" IN BOOLEAN MODE)';

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

    public function store(ArquivoRequest $request)
    {
        try {
            $input = $request->all();

            $input['link'] = $input['arquivo'];

            $input['tags'] = implodeArray($input['list_tags']);

            $input['user_id'] = Auth::id();

            $arquivos = $this->dataModel->create($input);

            $arquivos->user()->associate(Auth::user());

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

            $arquivos = $this->dataModel->find($id);

            $input['tags'] = implodeArray($input['list_tags']);

            $arquivos->update($input);

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

            $arquivos = $this->dataModel->find($id);

            Storage::disk('public')->delete($arquivos->link);

            $arquivos->delete();


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

        $listatags = DB::table('arquivos')->get();

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
//        dd(array_unique($tags));
        return collect(array_unique($tags))->values();
    }
}
