<?php
/**
 * Autor: Paula Aguirre Copyright (c) 2018.
 */

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRoleFormRequest;
use App\Role;
use Illuminate\Http\Request;


class RoleController extends Controller
{
    /**
     * RoleController constructor.
     */
    public function __construct ()
    {
        $this->middleware ('roles: 1, 2');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request) {
            $query = trim ( $request->get ( 'searchText' ) );
            $roles = Role::where('nombre', 'like', '%'.$query.'%')
                ->orderBy('id', 'ASC')->paginate(4);
            return view ( 'roles.index', ['roles' => $roles, 'searchText' => $query] );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'nombre' => 'required|unique:roles',
        ]);

        $role = new Role($request->all ());
        $role->save ();
        return redirect ()->to ('roles');
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
        return view ('roles.edit', ['role'=>Role::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleFormRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->fill($request->all ());
        $role->update();

        return redirect ()->to ('roles');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::FindOrFail($id);
        $role->delete();

        return redirect ()->back ();
    }
}
