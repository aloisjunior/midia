<?php

namespace ARsig\Http\Controllers\frontend;

use ARsig\Models\Clientes;
use Illuminate\Http\Request;
use ARsig\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class ClienteController extends Controller
{
    public function info()
    {
//        $info = Cache::remember('clientecontroller.info', 3, function () {
            return Clientes::where('ativo', true)
                ->with('arquivos')->get();
//        });

//        $info = Clientes::whereRaw('depoimento_texto is not null')->limit(15)->with('arquivos')->get();

//        return $info;
    }

}
