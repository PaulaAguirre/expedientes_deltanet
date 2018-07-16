<?php
/**
 * Autor: Paula Aguirre Copyright (c) 2018.
 */

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateFormRequest;
use App\User;
use Illuminate\Http\Request;
use App\Role;
use App\Http\Requests\UserEditFormRequest;
use App\Area;
use App\Funcionario;

class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct ()
    {
        return $this->middleware ('roles:1,2')->except (['edit', 'update', 'index']);
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
            $users = User::with ('role', 'area')
                ->whereNotIn ('role_id', [1,2])
                ->where('name', 'like', '%'.$query.'%')
                ->orwhere('lastname', 'like', '%'.$query.'%')
                ->orWhere('cedula', 'like', '%'.$query.'%')
                ->orderBy('id', 'ASC')->paginate(5);

        }
        return view ( 'users.index', ['users' => $users, 'searchText' => $query] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles= Role::all ();
        $gerencias = Area::where('tipo', '=', 'G')->get ();
        $departamentos = Area::where('tipo', '=', 'D')->get ();


        return view ('users.create', ["roles"=>$roles, "gerencias" => $gerencias, "departamentos" => $departamentos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateFormRequest $request)
    {

        //dd ($request);

        $user = new User();
        $user->name = $request->get ('name');
        $user->lastname = $request->get ('lastname');
        $user->cedula = $request->get ('cedula');
        $user->phone  = $request->get ('phone');
        $user->mobile = $request->get ('mobile');
        $user->email = $request->get ('email');
        $user->save ();

        if($request->get ('radio_button') == 'si')
        {
            $funcionario = new Funcionario();
            $funcionario->user_id = $user->id;
            $funcionario->departamento_id = $request->get ('departamento_id');
            $funcionario->save ();
        }

        return redirect ()->to ('users');
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
        $roles = Role::all ();
        $user = User::findOrFail($id);

        $this->authorize ('edit', $user);

        return view ('users.edit', ['roles'=>$roles, 'user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditFormRequest $request, $id)
    {
        $user = User::findOrFail ( $id );
        $user->fill($request->all ());

        $this->authorize ('update', $user);
        $user->update();

        return redirect ('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect ()->to ('users');
    }
}
