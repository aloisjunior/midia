<?php

namespace ARsig\Http\Controllers\Backend;

use ARsig\Models\Layouts;
use Illuminate\Http\Request;
use ARsig\Http\Controllers\Controller;

class LayoutsController extends Controller
{
    protected $dataModel;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Layouts $layouts)
    {
        $this->middleware('auth');
        $this->dataModel = $layouts;
    }

    public function listar(Request $request)
    {

        $return = $this->dataModel->where('ativo', true)
                ->get();


//        return response()->json($return);
        return response()->json(['data'=>$return], 200, [], JSON_UNESCAPED_UNICODE );
    }

}
