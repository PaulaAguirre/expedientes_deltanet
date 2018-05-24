<?php

namespace App\Http\Controllers;

use App\Area;
use App\Tipoexpediente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
class TipoexpedienteController extends Controller
{
    /**
     * TipoexpedienteController constructor.
     */
    public function __construct ()
    {
        return $this->middleware ('roles: 1, 2')->except ('index', 'show');
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
            $tipos =Tipoexpediente:: where ( 'nombre', 'like', '%' . $query . '%' )
                ->paginate ( 5 );

        }

        return view ( 'tipoexpedientes.index', ['tipos' => $tipos, 'searchText' => $query] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::all ();

        return view ('tipoexpedientes.create', ['areas' => $areas]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipoexpediente = new Tipoexpediente($request->all ());
        $tipoexpediente->save ();

       $area_id = $request->get ('idarea');
       $cont = 0;

       while ($cont < count ($area_id)){

           $tipoexpediente->areas ()->attach ($area_id[$cont]);
            $cont = $cont + 1;



       }

        return redirect ('tipoexpedientes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tipoexpediente  $tipoexpediente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipo = Tipoexpediente::findOrFail ($id);
        $areas = $tipo->areas;

        return view ('tipoexpedientes.show', ['tipo' => $tipo, 'areas' => $areas]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tipoexpediente  $tipoexpediente
     * @return \Illuminate\Http\Response
     */
    public function edit(tipoexpediente $tipoexpediente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tipoexpediente  $tipoexpediente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tipoexpediente $tipoexpediente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tipoexpediente  $tipoexpediente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipo = Tipoexpediente::findOrFail ($id);
        $tipo->delete ();

        return redirect ('tipoexpedientes');
    }
}
