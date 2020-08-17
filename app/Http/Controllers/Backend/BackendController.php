<?php

namespace ARsig\Http\Controllers\Backend;

use Illuminate\Http\Request;
use ARsig\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BackendController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.index');
    }

    public function permissionTeste($perm){
        dd(Auth::user()->checkPermission($perm));
    }
}
