<?php
/**
 * Autor: Paula Aguirre Copyright (c) 2018.
 */

namespace App\Http\Controllers;

use App\Funcionario;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\Area;

class FuncionarioController extends Controller
{
    /**
     * FuncionarioController constructor.
     */
    public function __construct ()
    {
        return $this->middleware ('roles: 1, 2')->except ('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request)
        {
            $query = trim ( $request->get ( 'searchText' ) );
            $funcionarios = Funcionario::with('user')
                ->where ('id', 'like', '%'.$query.'%')
                //->orWhere ('name', 'like', '%'.$query.'%')
                //->orWhere ('lastname', 'like', '%'.$query.'%')
                ->orderBy ('id', 'ASC')->paginate (5);
            return view ('funcionarios.index', ['funcionarios' => $funcionarios, 'searchText' => $query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $gerentes_jefes = DB::table ('areas')->select ('user_id');
        $users = DB::table ('users')->whereNotIn ('id', $gerentes_jefes)->get ();
        $areas = Area::where('tipo', '=', 'D')->get ();

        return view ('funcionarios.create', ['users' => $users, 'areas' => $areas]);
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
            'user_id' => 'required|unique:funcionarios',
            'departamento_id' => 'required'
        ]);

        $funcionario = new Funcionario($request->all ());

        $funcionario->save ();

        return redirect ('funcionarios');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function show(Funcionario $funcionario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $funcionario = Funcionario::findOrFail ($id);
        $departamentos = Area::where('tipo', '=', 'D')->get ();

        return view ('funcionarios.edit',['funcionario'=>$funcionario, 'departamentos'=>$departamentos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $funcionario = Funcionario::findOrFail ($id);
        $funcionario->fill ($request->all ());
        $funcionario->update ();

        return redirect ('funcionarios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $funcionario = Funcionario::findOrFail ($id);
        $funcionario->delete ();

        return redirect ('funcionarios');
    }
}
