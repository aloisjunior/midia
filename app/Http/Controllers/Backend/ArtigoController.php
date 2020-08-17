<?php

namespace ARsig\Http\Controllers\Backend;

use ARsig\Http\Requests\backend\ArtigosRequest;
use ARsig\Models\Artigos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use ARsig\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArtigoController extends Controller
{
    public function __construct(Artigos $artigo)
    {
        $this->middleware('auth');
        $this->dataModel = $artigo;
    }

    public function index(Request $request)
    {
        $filtro = $request['filtro'];

        if ((isset($filtro)) && (!(trim($filtro) === ''))) {
            $consulta = 'match(titulo, slug, apresentacao, corpo, tags, categorias, tipo) against("' . $filtro . '" IN BOOLEAN MODE)';

            if ($filtro === '*') {
                $consulta = '1=1';
            }

            $return = $this->dataModel
                ->whereRaw($consulta)
                ->with('user')
                ->with('arquivos')
                ->get();

        } else {
            $return = $this->dataModel
                ->where('id', '0')
                ->get();
        }

//        dd($return);

        return response()->json($return, 200, [], JSON_UNESCAPED_UNICODE);
//        return response()->json($return);
    }

    public function store(ArtigosRequest $request)
    {
        try {
            $input = $request->all();

//            $input['link'] = $input['arquivo'];

            $input['tags'] = implodeArray($input['list_tags']);

            $input['categorias'] = implodeArray($input['list_categorias']);


            $input['user_id'] = Auth::id();

            $artigos = $this->dataModel->create([
                'titulo'=> ucwords($input['titulo']),
                'slug'=> str_slug($input['titulo']),
                'apresentacao'=> $input['apresentacao'],
                'categorias'=> $input['categorias'],
                'corpo'=> $input['corpo'],
                'tags'=>$input['tags'],
                'tipo'=>'artigo',
                'url_video'=> isset($input['url_video']) ? $input['url_video'] : '',
                'ativo'=> $input['ativo'] ? true : false,
            ]);



            $arquivosIncluidos = $input['arquivosLocal'];

            if (count($arquivosIncluidos) > 0) {
                foreach ($arquivosIncluidos as $arquivo) {
                    if (!$arquivo['original'] && !$arquivo['excluir']) {
                        $artigos->arquivos()->create([
                                'filename' => $arquivo['filename'],
                                'mime' => $arquivo['mime'],
                                'link' => $arquivo['link'],
                                'size' => $arquivo['size'],
                                'artigo_id' => $artigos->id,
                            ]
                        );
                    }
                }
            }

            return \response()->json('Artigo inserido com sucesso', 200);
        } catch (\Exception $e) {

            return \response()->json('error:' . $e->getMessage(), 400);
        }
    }

    public function edit($id)
    {
        $return = $this->dataModel->with('user')
            ->with('arquivos')->find($id);

        return response()->json($return);
    }

    public function update(ArtigosRequest $request, $id)
    {
        try {
            $input = $request->all();

//            $input['link'] = $input['arquivo'];

            $input['tags'] = implodeArray($input['list_tags']);

            $input['categorias'] = implodeArray($input['list_categorias']);

//            $input['created_at'] = Carbon::createFromFormat('DD/MM/YYYY HH:mm:ss', $input['created_at'])->format('YYYY-MM-YY HH:mm:ss');

//            $input['user_id'] = Auth::user()->id;


            $input['titulo'] = ucwords($input['titulo']);
            $input['slug'] = str_slug($input['titulo']);

            $artigos = $this->dataModel->find($id);

            $artigos->update($input);

            $arquivos = $input['arquivosLocal'];

//            $artigos->arquivos()->delete();

//            dd($arquivos);

            if (count($arquivos) > 0) {
                foreach ($arquivos as $arquivo) {
                    if ($arquivo['original'] && $arquivo['excluir']){
                        $arquivoExcluir = $artigos->arquivos()->find($arquivo['id']);
//                        Storage::disk('public')->delete($arquivo->link);
                        $arquivoExcluir->delete();
                    };
                    if (!$arquivo['original'] && !$arquivo['excluir']) {
                        $artigos->arquivos()->create([
                                'filename' => $arquivo['filename'],
                                'mime' => $arquivo['mime'],
                                'link' => $arquivo['link'],
                                'size' => $arquivo['size'],
                                'artigo_id' => $artigos->id,
                            ]
                        );
                    }
                }
            }

            $artigos->save();

            return \response()->json('Artigo alterado com sucesso', 200);
        } catch (\Exception $e) {

            return \response()->json('error:' . $e->getMessage(), 400);
        }
    }

    public function destroy(Request $request, $id)
    {
        try {

            $artigo = $this->dataModel->find($id);

            $arquivos = $artigo->arquivos()->get();

            foreach ($arquivos as $arquivo) {
                Storage::disk('public')->delete($arquivo->link);
                Storage::disk('public')->delete('thumbnail/'.$arquivo->link);
            }

            $artigo->arquivos()->delete();

            $artigo->delete();


            return \response()->json('Artigo excluído com sucesso', 200);
        } catch (\Exception $e) {

            return \response()->json('error:' . $e->getMessage(), 400);
        }
    }

    public function tags(Request $request)
    {
        $tags = array();

        //$listatags = DB::table('arquivos')
        //    ->where('ativo', 'S')->get();

        $listatags = DB::table('artigos')->get();

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

    public function categorias(Request $request)
    {
        $categorias = array();

        //$listatags = DB::table('arquivos')
        //    ->where('ativo', 'S')->get();

        $listacategorias = DB::table('artigos')->get();

        if (count($listacategorias) > 0) {
            $categoriastmp = array();

            foreach ($listacategorias as $reg) {
                if (!(is_null($reg->categorias)) && !(trim($reg->categorias) === '')) {
                    array_push($categoriastmp, explode(",", $reg->categorias));
                }
            }

            foreach ($categoriastmp as $categoria) {
                $categorias = array_merge($categorias, $categoria);
            }
            $categorias = array_unique($categorias);

            $final = array();

//            foreach ($categorias as $categoria => $tmp) {
//                $final[$tmp] = $tmp;
//            }
//            $categorias = $final;
        }
//        dd(array_unique($categorias));
        return collect(array_unique($categorias))->values();
    }

}
