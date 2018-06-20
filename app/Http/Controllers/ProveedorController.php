<?php

namespace App\Http\Controllers;

use App\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * ProveedorController constructor.
     */
    public function __construct ()
    {
        $this->middleware ('roles: 1,2')->except ('index');
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
            $proveedores = Proveedor::where('name', 'like', '%'.$query.'%')
                ->orderBy('id', 'DESC')->paginate(4);
            return view ( 'proveedores.index', ['proveedores' => $proveedores, 'searchText' => $query] );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('proveedores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $proveedor = new Proveedor($request->all ());
        $proveedor->save ();

        return redirect ('proveedores');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show(Proveedor $proveedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view ('proveedores.edit', ['proveedor' => Proveedor::findOrFail ($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $proveedor = Proveedor::findOrFail ($id);
        $proveedor->fill($request->all ());
        $proveedor->update ();

        return redirect ('proveedores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proveedor = Proveedor::findOrFail ($id);
        $proveedor->delete ();

        return redirect ('proveedores');
    }
}
