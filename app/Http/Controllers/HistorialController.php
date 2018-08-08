<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expediente;
use App\Proveedor;
use App\User;
use Carbon\Carbon;
use App\History;
use Illuminate\Support\Facades\DB;

class HistorialController extends Controller
{
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
            $ots = DB::table ('ots')->where ('codigo', 'like', '%'.$query.'%')->select ('id');
            $proveedores = DB::table('proveedores')->where('name', 'like','%'.$query.'%' )->select('id');
            $expedientes = Expediente::with ('creador', 'histories', 'tipoexpediente','proveedor', 'cliente')
                ->where ('id', 'like', '%'.$query.'%')
                ->orWhere ('referencia','like', '%'.$query.'%' )
                ->orWhere ('memo', 'like', '%'.$query.'%')
                ->orWhereIn ('ot_id', $ots )
                ->orWhereIn ('proveedor_id', $proveedores)
                ->orderBy('id', 'DESC')->paginate (20 );


        }
        return view ('historial_de_expedientes.index', ['searchText' => $query, 'expedientes'=>$expedientes]);
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
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
