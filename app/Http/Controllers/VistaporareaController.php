<?php
/**
 * Autor: Paula Aguirre Copyright (c) 2018.
 */

namespace App\Http\Controllers;
use App\Expediente;
use Illuminate\Http\Request;
use DB;


class VistaporareaController extends Controller
{
    /**
     * VistaporareaController constructor.
     */
    public function __construct ()
    {
        //return $this->middleware ('roles: 1,2,3');
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
            $ots = DB::table ('ots')->where ('codigo', 'like', '%'.$query.'%')->select ('id');
            $proveedores = DB::table('proveedores')->where('name', 'like','%'.$query.'%' )->select('id');
            $expedientes = Expediente::with ('creador', 'histories', 'tipoexpediente','proveedor', 'cliente')
                ->where ('id', 'like', '%'.$query.'%')
                ->orWhere ('referencia','like', '%'.$query.'%' )
                ->orWhereIn ('ot_id', $ots )
                ->orWhereIn ('proveedor_id', $proveedores)
                ->orderBy('fecha_creacion', 'DESC')->paginate (20);


        }



        return view ('expedientes_por_areas.index', ['expedientes' => $expedientes, 'searchText'=> $query]);
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
