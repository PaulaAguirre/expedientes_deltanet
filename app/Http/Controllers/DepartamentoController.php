<?php
/**
 * Autor: Paula Aguirre Copyright (c) 2018.
 */

namespace App\Http\Controllers;

use App\Funcionario;
use App\User;
use Illuminate\Http\Request;
use App\Area;
use DB;
use Illuminate\Validation\Rule;

class DepartamentoController extends Controller
{
    /**
     * DepartamentoController constructor.
     */
    public function __construct ()
    {
        return $this->middleware ('roles: 1,2,9')->except ('index');
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
            $departamentos = Area::with ('user', 'dependencia')
             ->where('tipo', '=', 'D')
            ->Where ('nombre', 'like', '%'.$query.'%')->orderBy ('id', 'ASC')->paginate (8);
            return view ('departamentos.index', ['departamentos' => $departamentos, 'searchText' => $query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gerencias = Area::where('tipo', '=', 'G')->get ();


       $jefes = User::all ();


        return view ('departamentos.create', ['jefes' => $jefes, 'gerencias' => $gerencias]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate ($request,
        [
            'user_id'=>'unique:areas',
            'nombre'=>'unique:areas'
        ]);

        $departamento = new Area($request->all ());
        $departamento->tipo = 'D';
        $departamento->save ();

        $funcionario = Funcionario::where('user_id', '=', $departamento->user_id)->first ();

        $departamento->save ();

        $user = User::findOrFail ($departamento->user_id);
        $user->role_id = 3;
        $user->update ();

        if ($funcionario)
        {
            $funcionario->delete ();
        }

        return redirect ('departamentos');
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

        $gerencias = Area::where('tipo', '=', 'G')->get ();

        $jefes = DB::table ('users')
            ->get ();
        $departamento = Area::findOrFail ($id);

        return view ('departamentos.edit', ['jefes'=>$jefes, 'gerencias'=>$gerencias, 'departamento'=>$departamento]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate ($request,
            [
                'user_id'=>Rule::unique ('areas')->ignore ($id),
                'nombre'=>Rule::unique ('areas')->ignore ($id)
            ]);

        $departamento = Area::findOrFail ($id);

        $user = User::findOrFail ($departamento->user_id);
        $user->role_id = 8;

        $departamento->fill ($request->all ());
        $departamento->update ();

        $jefe = User::findOrFail ($departamento->user_id);
        $jefe->role_id = 3;

        if ($funcionario = Funcionario::where('user_id', '=', $user->id)->first ())
        {
            $funcionario->delete ();
        }

        $user->update ();
        $jefe->update ();

        return redirect ('departamentos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $departamento = Area::findOrFail ($id);
        $departamento->delete ();

        return redirect ('departamentos');
    }
}
