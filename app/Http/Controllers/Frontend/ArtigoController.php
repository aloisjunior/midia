<?php

namespace ARsig\Http\Controllers\Frontend;

use ARsig\Http\Controllers\Controller;
use ARsig\Models\Artigo;
use ARsig\Models\Artigos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


class ArtigoController extends Controller
{
    public function listatags()
    {
        $tags = array();

        $artigostags = Cache::remember('artigocontroller.listatags', 180, function () {
            return DB::table('artigos')
                ->where('ativo', true)->get();
        });

        if (count($artigostags) > 0) {
            $tagstmp = array();

            foreach ($artigostags as $artigo) {
                if (!(is_null($artigo->tags))) {
                    array_push($tagstmp, explode(",", $artigo->tags));
                }
            }

            foreach ($tagstmp as $tag) {
                $tags = array_merge($tags, $tag);
            }
        }
        return array_unique($tags);
    }

    public function ultimosposts()
    {
        $ultimosposts = Cache::remember('artigocontroller.ultimosposts', 180, function () {
            return DB::table('artigos')
                ->where('ativo', true)
                ->orderBy('created_at', 'desc')
                ->limit(3)
                ->get();
        });

        return $ultimosposts;
    }

    public function maislidas()
    {
        $ultimosposts = Cache::remember('artigocontroller.maislidas', 180, function () {
            return DB::table('artigos')
                ->where('ativo', true)
                ->orderBy('views', 'desc')
                ->limit(3)
                ->get();
        });

        return $ultimosposts;
    }

    public function categorias()
    {
        $categorias = array();

        //$listatags = DB::table('arquivos')
        //    ->where('ativo', 'S')->get();

        $listacategorias = DB::table('artigos')
            ->where('ativo', true)->get();

//        dd($listacategorias);

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

//            $final = array();

//            foreach ($categorias as $categoria => $tmp) {
//                $final[$tmp] = $tmp;
//            }
//            $categorias = $final;
        }
//        dd(array_unique($categorias));
        return collect(array_unique($categorias))->values();


//        $categorias = array();
//
//        $artigoscategorias = Cache::remember('artigocontroller.categorias', 3, function() {
//            return DB::table('artigos')
//                ->where('ativo', true)->get();
//        });
//
//        if (count($artigoscategorias) > 0) {
//            $categoriatmp = array();
//
//            foreach ($artigoscategorias as $artigo) {
//                if (!(is_null($artigo->categorias))) {
//                    array_push($categoriatmp, explode(",", $artigo->categorias));
//                }
//            }
//
//            foreach ($categoriatmp as $categoria) {
//                $categorias = array_merge($categorias, $categoria);
//            }
//        }
////        return array_unique($categorias);
//        return collect(array_unique($categorias))->values();
    }

    public function index()
    {
//        $artigos = DB::table('artigos')
//            ->select('artigos.*', 'users.name')
//            ->where('artigos.ativo', true)
//            ->join('users', 'artigos.user_id', '=', 'users.id')
//            ->orderBy('artigos.created_at', 'desc')
//            ->paginate(5);

        $artigos = Artigos::where('ativo', true)
            ->with('user')
            ->with('arquivos')
            ->orderBy('artigos.created_at', 'desc')
            ->paginate(5);

        if (count($artigos) > 0) {
            foreach ($artigos as $artigo) {
                if (!(is_null($artigo->tags))) {
                    $collection = collect(explode(",", $artigo->tags));
                    $artigo->tags = $collection;
                }
                if (!(is_null($artigo->categorias))) {
                    $collection = collect(explode(",", $artigo->categorias));
                    $artigo->categorias = $collection;
                }
            }
        }

        $tags = $this->listatags();

        $ultimosposts = $this->ultimosposts();

        $maislidas = $this->maislidas();

        $categorias = $this->categorias();

        $artigos->withPath('/artigos');

//        dd($tags);
//        dd($artigos);

        return view('frontend.artigos', compact('artigos', 'tags', 'ultimosposts', 'categorias', 'maislidas'));
    }

    public function showcategoria(Request $request)
    {
        $nome = $request['nome'];

        $artigos = Cache::remember('artigocontroller.showcategoria.' . $nome, 180, function () use ($nome) {
            return Artigos::where('ativo', true)
                ->with('user')
                ->with('arquivos')
                ->whereRaw('lcase(artigos.categorias) like "%' . strtolower($nome) . '%"')
                ->orderBy('artigos.created_at', 'desc')
                ->paginate(5);
        });

        if (count($artigos) > 0) {

            foreach ($artigos as $artigo) {
                if (!(is_null($artigo->tags))) {
                    $collection = collect(explode(",", $artigo->tags));
                    $artigo->tags = $collection;
                }
                if (!(is_null($artigo->categorias))) {
                    $collection = collect(explode(",", $artigo->categorias));
                    $artigo->categorias = $collection;
                }
            }

        }

        $filtro = 'Categoria: '.$nome;

        $tags = $this->listatags();

        $ultimosposts = $this->ultimosposts();

        $maislidas = $this->maislidas();

        $categorias = $this->categorias();

        return view('frontend.artigos', compact('artigos', 'ultimosposts', 'tags', 'categorias', 'filtro', 'maislidas'));

    }

    public function showtag(Request $request)
    {
        $nome = $request['nome'];

        $artigos = [];

        if (!is_null($nome)) {
            $artigos = Cache::remember('artigocontroller.showtag.' . $nome, 180, function () use ($nome) {
                return Artigos::where('ativo', true)
                    ->with('user')
                    ->with('arquivos')
                    ->whereRaw('lcase(artigos.tags) like "%' . strtolower($nome) . '%"')
                    ->orderBy('artigos.created_at', 'desc')
                    ->paginate(5);

//                    DB::table('artigos')
//                    ->select('artigos.*')
//                    ->where('artigos.tags', 'like', '%' . $nome . '%')
//                    ->where('artigos.ativo', true)
//                    ->orderBy('artigos.created_at', 'desc')
//                    ->paginate(3);
            });
        }

        if (count($artigos) > 0) {
            foreach ($artigos as $artigo) {

                if (!(is_null($artigo->tags))) {
                    $collection = collect(explode(",", $artigo->tags));
                    $artigo->tags = $collection;
                }
                if (!(is_null($artigo->categorias))) {
                    $collection = collect(explode(",", $artigo->categorias));
                    $artigo->categorias = $collection;
                }

            }
        }

        $filtro = 'Tag: '.$nome;

        $tags = $this->listatags();

        $ultimosposts = $this->ultimosposts();

        $maislidas = $this->maislidas();

        $categorias = $this->categorias();

        return view('frontend.artigos', compact('artigos', 'ultimosposts', 'tags', 'categorias', 'filtro', 'maislidas'));
    }

    public function show(Request $request)
    {
        $nome = $request->route('nome');

        $artigos = Artigos::where('slug', '=', $nome)
            ->with('arquivos')
            ->first();
//        dd($artigos);

        $tmp = [];

        if (count($artigos) > 0){
            $tmp = Artigos::find($artigos->id);
        }

//
//
//
        if (count($tmp) > 0) {
            $tmp->views += 1;
            $tmp->save();

        } else {
            return view('errors.404');
        }

//        dd($artigos);

        $tags = $this->listatags();

        $ultimosposts = $this->ultimosposts();

        $maislidas = $this->maislidas();

        $categorias = $this->categorias();

        return view('frontend.artigos-detalhe', compact('artigos', 'ultimosposts', 'tags', 'categorias', 'maislidas'));
    }

    // chamada ajax para footer com ultimos posts
    public function listar(){
        $nome = 'noticias';

        $artigos = Cache::remember('artigocontroller.listar.'.$nome, 180, function () use ($nome) {
            return Artigos::where('ativo', true)
                ->with('user')
                ->with('arquivos')
                ->whereRaw('lcase(artigos.categorias) like "%' . strtolower($nome) . '%"')
                ->orderBy('artigos.created_at', 'desc')
                ->paginate(5);
        });

        if (count($artigos) > 0) {

            foreach ($artigos as $artigo) {
                if (!(is_null($artigo->tags))) {
                    $collection = collect(explode(",", $artigo->tags));
                    $artigo->tags = $collection;
                }
                if (!(is_null($artigo->categorias))) {
                    $collection = collect(explode(",", $artigo->categorias));
                    $artigo->categorias = $collection;
                }
            }

        }

        return response()->json($artigos);

    }
}
