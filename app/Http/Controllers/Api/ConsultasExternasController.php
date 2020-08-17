<?php

namespace ARsig\Http\Controllers\Api;

use Illuminate\Http\Request;
use ARsig\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Output\StreamOutput;

class ConsultasExternasController extends Controller
{
    public function cnpj(Request $request, $cnpj)
    {
        $curlSession = curl_init();

        //Pede o que retorne o resultado como string
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curlSession, CURLOPT_URL, 'https://receitaws.com.br/v1/cnpj/'.somenteNumeros($cnpj));
        //Pede o que retorne o resultado como string
//        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
        //Ignora certificado SSL
        curl_setopt($curlSession, CURLOPT_SSL_VERIFYPEER, false);

//        timeouts
        curl_setopt($curlSession, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($curlSession, CURLOPT_TIMEOUT, 40); //timeout in seconds


        $jsonData = curl_exec($curlSession);

        curl_close($curlSession);


        $result = json_decode($jsonData);


        return response()->json($result, 200, [], JSON_UNESCAPED_UNICODE)->content();
    }

    public function cep(Request $request, $cep)
    {
        $curlSession = curl_init();

        //Pede o que retorne o resultado como string
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curlSession, CURLOPT_URL, 'https://viacep.com.br/ws/'.somenteNumeros($cep).'/json');
        //Pede o que retorne o resultado como string
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
        //Ignora certificado SSL
        curl_setopt($curlSession, CURLOPT_SSL_VERIFYPEER, false);

//        timeout
        curl_setopt($curlSession, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($curlSession, CURLOPT_TIMEOUT, 40); //timeout in seconds



        $jsonData = curl_exec($curlSession);
//    dd(json_decode($jsonData));
        curl_close($curlSession);
        return response()->json(json_decode($jsonData));
    }
}
