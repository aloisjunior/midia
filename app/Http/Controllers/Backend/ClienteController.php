<?php

namespace ARsig\Http\Controllers\backend;

use ARsig\Http\Requests\backend\ClienteRequest;
use ARsig\Models\Clientes;
use Illuminate\Http\Request;
use ARsig\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    public function __construct(Clientes $cliente)
    {
        $this->middleware('auth');
        $this->dataModel = $cliente;
    }

    public function index(Request $request)
    {
        $filtro = $request['filtro'];

        $fields = isset($request['fields']) ? collect($request['fields'])->toArray() : null;

//        dd($fields);
        $consulta = '';
        if ((isset($filtro)) && (!(trim($filtro) === ''))) {

            if ($fields){
                $idx = 0;
                foreach ($fields as $key=>$item) {
                    if ($idx == 0){
                        $consulta = '( ('.$key.' like "%'.$item.'%") ';
                    }else{
                        $consulta .= ' or ('.$key.' like "%'.$item.'%") ';
                    }
                    $idx++;
                }

                if ($consulta) {
                    $consulta .= ' )';
                }

//                dd($consulta);

            }else{
                $consulta = 'match(nome,
                                razao_social, 
                                cnpj_cpf, 
                                email, 
                                contato, 
                                telefone, 
                                endereco, 
                                numero, 
                                bairro, 
                                cidade, 
                                cep,
                                observacao, 
                                depoimento_texto, 
                                depoimento_cargo, 
                                tags) against("' . $filtro . '" IN BOOLEAN MODE)';

                if ($filtro === '*') {
                    $consulta = '1=1';
                }
            }




            $return = $this->dataModel
                ->whereRaw($consulta)
                ->with('arquivos')
                ->get();

        } else {
            $return = $this->dataModel
                ->where('id', '0')
                ->with('arquivos')
                ->get();
        }

        return response()->json($return);
    }

    public function edit(Request $request, $id)
    {

        $return = $this->dataModel->with('arquivos')->find($id);


        return response()->json($return);
    }

    public function store(ClienteRequest $request)
    {
        try {
            $input = $request->all();

//            $input['link'] = $input['arquivo'];


            $input['tags'] = implodeArray($input['list_tags']);
            $input['user_id'] = Auth::id();

            $cliente = $this->dataModel->create($input);



            $arquivosIncluidos = $input['arquivosLocal'];

            if (count($arquivosIncluidos) > 0) {
                foreach ($arquivosIncluidos as $arquivo) {
                    if (!$arquivo['original'] && !$arquivo['excluir']) {
                        $cliente->arquivos()->create([
                                'filename' => $arquivo['filename'],
                                'mime' => $arquivo['mime'],
                                'link' => $arquivo['link'],
                                'size' => $arquivo['size'],
                                'artigo_id' => $cliente->id,
                            ]
                        );
                    }
                }
            }



            return \response()->json('Cliente inserido com sucesso', 200);
        } catch (\Exception $e) {

            return \response()->json('error:' . $e->getMessage(), 400);
        }
    }

    public function update(ClienteRequest $request, $id)
    {
        try {
            $input = $request->all();

//            $input['link'] = $input['arquivo'];

            $input['tags'] = implodeArray($input['list_tags']);


//            if (isset($input['categorias'])) {
//                $input['categorias'] = implodeArray($input['categorias']);
//            }

//            $input['user_id'] = Auth::user()->id;


//            $input['titulo'] = ucwords($input['titulo']);
//            $input['slug'] = str_slug($input['titulo']);

            $cliente = $this->dataModel->find($id);

            $cliente->update($input);

            $arquivos = $input['arquivosLocal'];

//            $artigos->arquivos()->delete();

//            dd($arquivos);

            if (count($arquivos) > 0) {
                foreach ($arquivos as $arquivo) {
                    if ($arquivo['original'] && $arquivo['excluir']){
                        $arquivoExcluir = $cliente->arquivos()->find($arquivo['id']);
//                        Storage::disk('public')->delete($arquivo->link);
                        $arquivoExcluir->delete();
                    };
                    if (!$arquivo['original'] && !$arquivo['excluir']) {
                        $cliente->arquivos()->create([
                                'filename' => $arquivo['filename'],
                                'mime' => $arquivo['mime'],
                                'link' => $arquivo['link'],
                                'size' => $arquivo['size'],
                                'artigo_id' => $cliente->id,
                            ]
                        );
                    }
                }
            }

            $cliente->save();

            return \response()->json('Cliente alterado com sucesso', 200);
        } catch (\Exception $e) {

            return \response()->json('error:' . $e->getMessage(), 400);
        }
    }




    public function destroy(Request $request, $id)
    {
        try {

            $cliente = $this->dataModel->find($id);

            $arquivos = $cliente->arquivos()->get();

            foreach ($arquivos as $arquivo) {
                Storage::disk('public')->delete($arquivo->link);
            }

            $cliente->arquivos()->delete();

            $cliente->delete();


            return \response()->json('Cliente excluído com sucesso', 200);
        } catch (\Exception $e) {

            return \response()->json('error:' . $e->getMessage(), 400);
        }
    }

    public function tags(Request $request)
    {
        $tags = array();

        //$listatags = DB::table('arquivos')
        //    ->where('ativo', 'S')->get();

        $listatags = DB::table('clientes')->get();

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
