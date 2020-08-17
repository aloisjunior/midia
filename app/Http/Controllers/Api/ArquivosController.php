<?php

namespace ARsig\Http\Controllers\api;

use ARsig\Models\Arquivo;
use Illuminate\Http\Request;
use ARsig\Http\Controllers\Controller;

class ArquivosController extends Controller
{
    public function listar(Request $request)
    {

        $arquivos = Arquivo::
              where('ativo', '1')
            ->where('exibe_site', '1')
            ->select('id',
                'nome',
                'descricao',
                'filename',
                'tags')
            ->get();

        $result = $arquivos->toArray();

        foreach ($result as $key => $arq){


            $arq['link_externo'] = '';
        }


        return $result;
    }
    public function tags(Request $request)
    {
        $tags = array();

        //$listatags = DB::table('arquivos')
        //    ->where('ativo', 'S')->get();

        $listatags = Arquivo::where('ativo', '1')
            ->where('exibe_site', '1')
            ->get();

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
