<?php

namespace ARsig\Http\Controllers\imagem;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use ARsig\Http\Controllers\Controller;
//use ARsig\Models\Arquivos;
//use ARsig\Models\Parceiro;

class ImagemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($nome)
    {
//        $temp = Arquivos::where('nome', $nome)
//            ->orWhere('filename', $nome)
//            ->first();
//
//        if (is_null($temp)) {
//            Session::flash('titulo', 'Arquivo não localizado: '.$nome);
//            Session::flash('mensagem', 'Não localizamos este arquivo em nossa base de dados.');
//            return redirect()->route('api.msg');
//        }
//
//
//        $response = Response::make(File::get($temp->link));
//        $response->header('Content-Type', $temp->mime);
//        ob_end_clean();
//        return $response;
    }
    public function resize($dir, $nome, $largura=0, $altura=0)
    {
//        resolver error 500 = falta de memoria ao dar resize
        ini_set('memory_limit','256M');

        $largura = ( $largura == 0 ) ? null : $largura;
        $altura = ( !isset($altura) ) ? 0 : $altura;


        $caminho = $dir.'/'.$nome;

        $exists = Storage::disk('public')->exists($caminho);

        if (!$exists){
            return 'Arquivo não localizado';
        }

//        $img = Image::make(Storage::disk('public')->get($caminho));

        if (($largura > 0) || ($altura > 0)){

           $largura = ( $largura == 0 ) ? null : intval($largura);
           $altura =  ( $altura == 0 ) ? null : intval($altura);
        }

//        $img = Image::cache(function($image) use ($caminho, $largura, $altura) {
//            return $image->make(Storage::disk('public')->get($caminho))->resize($largura, $altura, function($constraint) {
//                $constraint->aspectRatio();
//            })->encode('png');
//        }, 1440, true);

        $img = Image::make(Storage::disk('public')->get($caminho))->resize($largura, $altura, function($constraint) {
            $constraint->aspectRatio();
        });


        ob_end_clean();

//        return Image::make($img)->response('png');
        return $img->response('png');
    }

    public function resize_thumbanail($dir, $nome, $largura=0, $altura=0)
    {
      return $this->resize('thumbnail/'.$dir, $nome, $largura, $altura);
    }


//    public function parceiros_resize($id, $largura=0, $altura=0)
//    {
//
//        $largura = ( $largura == 0 ) ? null : $largura;
//        $altura = ( !isset($altura) ) ? 0 : $altura;
//
//
//        $temp = Parceiro::where('id', $id)
//            ->first();
//
//        if (is_null($temp)) {
//            Session::flash('titulo', 'Arquivo não localizado: '.$nome);
//            Session::flash('mensagem', 'Não localizamos este arquivo em nossa base de dados.');
//            return redirect()->route('api.msg');
//        }
//        //dd($temp);
//
//        $img = Image::make($temp->link_imagem);
//
//        if (($largura > 0) || ($altura > 0)){
//            $img->resize(( $largura == 0 ) ? null : intval($largura), ( $altura == 0 ) ? null : intval($altura), function($constraint) {
//                $constraint->aspectRatio();
//            });
//        }
//        ob_end_clean();
//
//        return $img->response('png');
//    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
