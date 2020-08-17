<?php

namespace ARsig\Http\Controllers\backend;

use ARsig\Models\Estacao;
use Illuminate\Http\Request;
use ARsig\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EstacaoController extends Controller
{
    protected $dataModel;

    public function __construct(Estacao $estacao)
    {
        $this->middleware('auth');
        $this->dataModel = $estacao;
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
                                host, 
                                porta, 
                                tags, 
                                ftp_pastas_offline
                                ) against("' . $filtro . '" IN BOOLEAN MODE)';

            if ($filtro === '*') {
                $consulta = '1=1';
            }

            $return = $this->dataModel
                ->whereRaw($consulta)
//                ->with('ocorrencias')
                ->get();

        } else {
            $return = $this->dataModel
                ->where('id', '0')
                ->get();
        }

        return response()->json($return);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $input = $request->all();

            $input['tags'] = implodeArray($input['list_tags']);


            $input['user_id'] = Auth::id();
            $contato = $this->dataModel->create($input);


            return response()->json('Arquivo inserido com sucesso', 200);
        } catch (\Exception $e) {

            return response()->json('error:' . $e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \ARsig\Models\Estacao  $estacao
     * @return \Illuminate\Http\Response
     */
    public function show(Estacao $estacao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \ARsig\Models\Estacao  $estacao
     * @return \Illuminate\Http\Response
     */
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
    public function update(Request $request, $id)
    {
        try {
//            dd($request);
            $input = $request->all();

            $contato = $this->dataModel->find($id);

            $input['tags'] = implodeArray($input['list_tags']);
            $input['ftp_pastas_offline'] = implodeArray($input['list_ftp_pastas_offline']);

            $contato->update($input);

            return response()->json('Arquivo alterado com sucesso', 200);
        } catch (\Exception $e) {
            return response()->json('error:' . $e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \ARsig\Models\Estacao  $estacao
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

        //$listatags = DB::table('arquivos')
        //    ->where('ativo', 'S')->get();

        $listatags = DB::table('estacao')->get();

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

    public function ftp_pastas_offline(Request $request)
    {
        $tags = array();

        //$listatags = DB::table('arquivos')
        //    ->where('ativo', 'S')->get();

        $listatags = DB::table('estacao')->get();

        if (count($listatags) > 0) {
            $tmp = array();

            foreach ($listatags as $reg) {
                if (!(is_null($reg->ftp_pastas_offline)) && !(trim($reg->ftp_pastas_offline) === '')) {
                    array_push($tmp, explode(",", $reg->ftp_pastas_offline));
                }
            }

            foreach ($tmp as $tag) {
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

    public function listar(Request $request){

//        dd($request);


        $estacoes = DB::table('estacao')
            ->where('ativo', true)
            ->orderBy('nome', 'asc')
            ->get();

        return response()->json($estacoes, 200, [], JSON_NUMERIC_CHECK);
    }
}
