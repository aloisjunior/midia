<?php

namespace ARsig\Http\Controllers\backend;

use ARsig\Events\UserPermissionsChange;
use ARsig\Http\Requests\backend\PermissionRequest;
use ARsig\Models\Permission;
use Illuminate\Http\Request;
use ARsig\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    protected $dataModel;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Permission $permission)
    {
        $this->middleware('auth');
        $this->dataModel = $permission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function index(Request $request)
    {
        $filtro = $request['filtro'];

        if ((isset($filtro)) && (!(trim($filtro) === ''))) {
            $consulta = 'match(permission_title, permission_slug, permission_description) against("' . $filtro . '" IN BOOLEAN MODE)';

            if ($filtro === '*') {
                $consulta = '1=1';
            }

            $roles = DB::table('permissions')
                ->whereRaw($consulta)
                ->get();

        } else {
            $roles = DB::table('permissions')
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
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $input = $request->all();

        $role = $this->dataModel->create($input);

        $role->save();

        if ($request->ajax()) {
            return response()->json('Registro incluído com sucesso', 200);
        }

        return redirect()->route('admin.perfil.index')->with('status', 'registro incluido com sucesso');
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
        $return = $this->dataModel->find($id);

        return response()->json($return);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, $id)
    {
        $role = $this->dataModel->find($id);

        $role->update($request->all());

        $this->notifyChangeForUser($id);


        if ($request->ajax()) {
            return response()->json('Registro alterado com sucesso', 200);
        }

        return redirect()->route('admin.permissao.index')->with('status', 'Registro alterado com sucesso');
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

        $role = $this->dataModel->find($id);

        $role->delete();

        if ($request->ajax()) {
            return response()->json('Registro excluído com sucesso', 200);
        }

        return redirect()->route('admin.permissao.index')->with('status', 'Registro excluído com sucesso');
    }

    public function notifyChangeForUser($permission_id)
    {
        $permission = $this->dataModel->find($permission_id);

        $roles = $permission->roles()->get();

        $users = Array();

        foreach ($roles as $role) {
            $tmpUsers = $role->users()->get();

            foreach ($tmpUsers as $user) {
                $users[] = $user;
            }
        }
        $users = collect($users)->unique('id')->values();
        foreach ($users as $userSend) {
            event(new UserPermissionsChange($userSend));
        }
    }


}
