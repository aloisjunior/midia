<?php

namespace ARsig\Http\Controllers\Backend;

use ARsig\Events\UserPermissionsChange;
use ARsig\Http\Requests\backend\UsuarioRequest;
use ARsig\Models\User;
use Illuminate\Http\Request;
use ARsig\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{

    private $dataModel;

    public function __construct(User $user)
    {
        $this->middleware('auth');
        $this->dataModel = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.usuario.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function tokenforuser()
    {
        return csrf_token();
    }

    public function getConfig(Request $request)
    {
        $return = Auth::user();

        if ($request->ajax()) {
            return response()->json($return->config, 200);
        } else {
            return $return->config;
        }
    }

    public function postConfig(Request $request)
    {
        $usuario = Auth::user();
        $usuario->update(['config' => collect($request->all())->toJson()]);
        if ($request->ajax()) {
            return response()->json('Configurações atualizadas com sucesso', 200);
        }

    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioRequest $request)
    {
        $input = $request->all();

//        $input['ativo']  = ( isset($input['ativo']) ) ? true : false;

        $input['config'] = '{}';
//        try {
        $usuario = $this->dataModel->create($input);
        $usuario->password_md5 = md5($usuario->password);
        $usuario->password = Hash::make($usuario->password);

        $usuario->save();
//        } catch ( \Exception $e) {
//            return response()->json(['Erro inserindo registro.'],500);
//        }


        if (isset($request['estacoes'])) {
            //$temp = User::find($id);
            $usuario->estacoes()->sync(collect($request['estacoes'])->pluck('id'));
            $usuario->save();
        }


        if (isset($request['roles'])) {
            //$temp = User::find($id);
            $usuario->roles()->sync(collect($request['roles'])->pluck('id'));
            $usuario->save();
        }

        if ($request->ajax()) {
            return response()->json('Registro incluído com sucesso', 200);
        }

        return redirect()->route('usuario')->with('status', 'registro incluido com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $return = $this->dataModel->with('roles')->with('estacoes')->find($id);

        return response()->json($return, 200, [], JSON_NUMERIC_CHECK);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
//    public function update(UsuarioRequest $request, $id)
    public function update(Request $request, $id)
    {
//        $input['ativo']  = ( isset($input['ativo']) ) ? true : false;

        $usuario = $this->dataModel->find($id);

//        dd(collect($request['estacoes'])->values('id'));

        $request['config'] = collect($request['config'])->toJson();


        if (isset($request['estacoes'])) {
            $usuario->estacoes()->sync(collect($request['estacoes'])->pluck('id'));
            $usuario->save();
        }

        if (isset($request['roles'])) {
            $usuario->roles()->sync(collect($request['roles'])->pluck('id'));
            $usuario->save();
        }

        $usuario->update($request->all());

        $this->notifyChangeForUser($id);

        if ($request->ajax()) {
            return response()->json('Registro alterado com sucesso', 200);
        }

        return redirect()->route('usuario')->with('status', 'Registro alterado com sucesso');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->notifyChangeForUser($id);

        $usuario = $this->dataModel->find($id);

        $usuario->roles()->detach();

        $usuario->estacoes()->detach();

        $usuario->delete();

        if ($request->ajax()) {
            return response()->json('Registro excluído com sucesso', 200);
        }

        return redirect()->route('usuario')->with('status', 'Registro excluído com sucesso');

    }

    //chamadas api
    public function listar(Request $request)
    {

//        dd($request);
        $filtro = $request['filtro'];

        if ((isset($filtro)) && (!(trim($filtro) === ''))) {
            $consulta = 'match(name, email) against("' . $filtro . '" IN BOOLEAN MODE)';

            if ($filtro === '*') {
                $consulta = '1=1';
            }

            $users = DB::table('users')
                ->whereRaw($consulta)
                ->get();

        } else {
            $users = DB::table('users')
                ->where('id', '0')
                ->get();
        }

        return response()->json($users, 200, [], JSON_NUMERIC_CHECK);


//        return response()->json($users);
    }

    public function rolesforuser($id)
    {

//        dd($request);

        $usuario = $this->dataModel->find($id);

        $roles = collect($usuario->roles()->get(['id']))->pluck('id');

        return response()->json($roles);
    }

    public function permissionsforuser()
    {

        $id = Auth::user()->id;

        $usuariologado = $this->dataModel->find($id);


        $acessos = $usuariologado->getAllPermissionsFormAllRoles();

//        $acessos = collect(implodeArray($acessos))->toArray();

//        return response()->json(array_unique($acessos));
        return array_flatten($acessos);

    }

    public function permissionsforuser_v1()
    {
//
//        $user = Auth::user();
//        $id = $user->id;
//
//        $usuariologado = $this->dataModel->find($id);

//        $user = Auth::user();
//        $id = $user->id;
//
//        $usuariologado = $this->dataModel->find($id);
//
//
//        $acessos = $usuariologado->getAllPermissionsFormAllRoles();


        $user = $this->dataModel->find(Auth::user()->id);

        $id = $user->id;


        $acessos = $user->permissions();


        return response()->json(['acessos' => collect($acessos)->values()->toArray(), 'userId' => $id, 'usuario' => $user], 200, [], JSON_UNESCAPED_UNICODE);
//        return response()->json(['acessos' => array_flatten(collect($acessos)->toArray()), 'userId' => $id, 'usuario' => $user], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function estacoesforuser()
    {

        $id = Auth::user()->id;

        $usuariologado = $this->dataModel->find($id);


        $estacoes = $usuariologado->estacoes()->orderBy('nome', 'asc')->get();

//        $estacoes = collect(implodeArray($estacoes))->toArray();

//        return response()->json(array_unique($estacoes));
        return array_flatten($estacoes);

    }

    public function notifyChangeForUser($user_id)
    {
        $user = $this->dataModel->find($user_id);

        event(new UserPermissionsChange($user));

    }



}
