<?php

namespace ARsig\Http\Controllers\Backend;

use ARsig\Events\UserPermissionsChange;
use ARsig\Http\Requests\backend\RoleRequest;
use ARsig\Models\Permission;
use ARsig\Models\Role;
use Illuminate\Http\Request;
use ARsig\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{

    protected $dataModel;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Role $role)
    {
        $this->middleware('auth');
        $this->dataModel = $role;
    }

    public function index(Request $request)
    {
        $filtro= $request['filtro'];

        if ((isset($filtro)) && (!(trim($filtro)==='')))
        {
            $consulta = 'match(name, slug) against("'.$filtro.'" IN BOOLEAN MODE)';

            if ($filtro === '*'){
                $consulta = '1=1';
            }

            $roles = DB::table('roles')
                ->whereRaw($consulta)
                ->get();

        }else{
            $roles = DB::table('roles')
                ->where('id', '0')
                ->get();
        }

        return response()->json($roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $input = $request->all();

        $role = $this->dataModel->create($input);



        if($request->ajax()) {
            return response()->json('Registro incluído com sucesso',200);
        }

        return redirect()->route('admin.perfil.index')->with('status', 'registro incluido com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $return = $this->dataModel->find($id);

        return response()->json($return);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $role = $this->dataModel->find($id);



        $role->update($request->all());

        $this->notifyChangeForUser($id);

        if($request->ajax()) {
            return response()->json('Registro alterado com sucesso',200);
        }

        return redirect()->route('usuario')->with('status', 'Registro alterado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->notifyChangeForUser($id);

        $role = $this->dataModel->find($id);

        $role->delete();

        if($request->ajax()) {
            return response()->json('Registro excluído com sucesso',200);
        }

        return redirect()->route('admin.perfil.index')->with('status', 'Registro excluído com sucesso');
    }

    // API
    public function listar(Request $request){

//        dd($request);

       $roles = Role::orderBy('name', 'asc')
                ->get();

        return response()->json($roles);
    }

    public function permissoes($id)
    {
        $role = $this->dataModel->find($id);

        $permissions = Permission::orderBy('permission_slug', 'ASC')->get();

        $permissions_saved = collect($role->permissions->pluck('id'))->toarray();

        return response()->json(compact('role', 'permissions', 'permissions_saved'));
    }


    public function permissoes_update(Request $request, $id)
    {
//        $permissions =  collect(Permission::all('permission_slug', 'permission_title', 'id')->lists('permission_slug'))->toarray();

//        $entradas = array();
//
//        foreach($request->input() as $i => $input){
//            if (in_array($i, $permissions))
//                $entradas[] = $input;
//        }

//        $tmp_valores = collect($entradas)->flatten()->toArray();

        $temp = $this->dataModel->find($id);
        $temp->permissions()->sync($request->input());
        $temp->save();

        $this->notifyChangeForUser($id);

        // limpa cache de permissoes de todos usuarios
        //implementar

//        $this->userService->limpa_cache_permissoes();

        if($request->ajax()) {
            return response()->json('Registro alterado com sucesso',200);
        }

        return redirect()->route('admin.perfil.index')->with('status', 'Registro alterado com sucesso');
    }

    public function notifyChangeForUser($role_id)
    {
        $roles = $this->dataModel->with('users')->find($role_id);

        $usersR = Array();

        $tmpUsers = $roles->users()->get();
        foreach ($tmpUsers as $user){
            $usersR[] = $user;
        }
        $usersR = collect($usersR)->unique('id')->values();
        foreach ($usersR as $userSend) {
            event(new UserPermissionsChange($userSend));
        }
    }

}
