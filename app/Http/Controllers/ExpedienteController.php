<?php

namespace App\Http\Controllers;

use App\Expediente;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use App\Tipoexpediente;
use Carbon\Carbon;
use App\History;
use App\Area;
use DB;
use App\User;
use App\Proveedor;
use App\Cliente;
use App\Ot;
use App\Notifications\NuevoPendienteNotification;
class ExpedienteController extends Controller
{
    /**
     * ExpedienteController constructor.
     */
    public function __construct ()
    {

        return $this->middleware ('roles: 1,2')->except (['index', 'show', 'create', 'store', 'edit', 'update']);
        return $this->middleware ('create_expediente')->only ('create', 'store');

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
            $expedientes = Expediente::with ('creador', 'histories', 'tipoexpediente','proveedor', 'cliente')
            ->where ('id', 'like', '%'.$query.'%')
                ->orWhere ('referencia','like', '%'.$query.'%' )
                ->orWhereIn ('ot_id', $ots )
                ->orderBy('fecha_creacion', 'DESC')->paginate (5 );


        }



        return view ('expedientes.index', ['searchText' => $query, 'expedientes' => $expedientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipos = Tipoexpediente::all ();
        $proveedores = Proveedor::all ();
        $clientes = Cliente::all ();
        $ots = Ot::all ();


        return view ('expedientes.create', ['tipos' => $tipos, 'proveedores' => $proveedores,
            'clientes' => $clientes, 'ots' => $ots]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $expediente = new Expediente($request->all());
        $expediente->user_id = \Auth::user ()->id;
        $expediente->fecha_creacion = Carbon::now ('America/Asuncion');

        $expediente->save ();

        $tipo = $expediente->tipoexpediente->id;

        $areas = Tipoexpediente::findOrFail ($tipo)->areas->pluck('id');
        $area_id = $areas->first();

        $history = History::create ([
            'expediente_id' => $expediente->id,
            'area_id' => $area_id,
            'estado' => 'pendiente',
            'motivo' => 'ok',
            'fecha_entrada' => $expediente->fecha_creacion
        ]);

        $responsable = Area::findOrFail ($area_id)->user;
        $responsable->notify(new NuevoPendienteNotification($history));

        return redirect ('expedientes');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expediente = Expediente::findOrFail ($id);

        $this->authorize ('show', $expediente);

        if($expediente->creador->funcionario)
        {
            $area_creacion = $expediente->creador->funcionario->departamento->nombre;
            $cargo = 'Funcionario';
        }
        elseif ($expediente->creador->area)
        {
            $area_creacion = $expediente->creador->area->nombre;
            if ($expediente->creador->area->tipo == 'D')
            {
                $cargo = 'Jefe';
            }
            elseif ($expediente->creador->area->tipo == 'G')
            {
                $cargo = 'Gerente';
            }
        }
        else
        {
            $area_creacion = 'Administrador';
            $cargo = 'Admin';
        }



        $histories = History::where('expediente_id', '=', $expediente->id)->get ();

        $ultima_fecha= $expediente->histories->last()->updated_at;

        $tiempo = $ultima_fecha->diffInDays($expediente->fecha_creacion);
        $tiempo_transcurrido = CarbonInterval::day ($tiempo)->forHumans ();
        //$tiempo_transcurrido =CarbonInterval::compareDateIntervals($ultima_fecha, $tiempo);

        return view ('expedientes.show', ['expediente' => $expediente,
            'histories' => $histories, 'area_creacion'=>$area_creacion, 'cargo' => $cargo, 'tiempo_transcurrido'=>$tiempo_transcurrido]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expediente = Expediente::findOrFail ($id);
        $tipos = Tipoexpediente::all ();
        $proveedores = Proveedor::all ();
        $clientes = Cliente::all ();
        $ots = Ot::all ();

        return view ('expedientes.edit', ['expediente' => $expediente, 'tipos' => $tipos, 'proveedores' => $proveedores,
            'clientes' => $clientes, 'ots' => $ots
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate ($request,[
            'tipo_id' => 'required',
            'ot_id' => 'required'

        ]);

        $expediente = Expediente::findOrFail ($id);
        $expediente->fill ($request->all ());
        $expediente->update ();

        return redirect ('expedientes');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expediente $expediente)
    {
        $expediente->delete ();
        return redirect ('expedientes');
    }
}
