<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\History;
use App\Expediente;
use Carbon\Carbon;
use App\Tipoexpediente;
use App\Area;
use App\Notifications\NuevoPendienteNotification;
use App\Notifications\RechazadosNotification;
use Illuminate\Support\Collection;
use DB;
use Illuminate\Support\Facades\Auth;


class HistoryController extends Controller
{
    /**
     * HistoryController constructor.
     */
    public function __construct ()
    {
        return $this->middleware ('roles: 1,2,3');
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
            $ots = DB::table ('ots')->where ('codigo', 'like', '%'.$query.'%')->select ('id');
            $expedientes = Expediente::with ('creador', 'histories', 'tipoexpediente','proveedor', 'cliente')
                ->where ('id', 'like', '%'.$query.'%')
                ->orWhere ('referencia','like', '%'.$query.'%' )
                ->orWhereIn ('ot_id', $ots )
                ->orderBy('fecha_creacion', 'DESC')->paginate (5 );
        }
        return view ('aprobacion_expedientes.expedientes_pendientes.index',
            ['searchText' => $query, 'expedientes' => $expedientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expediente = Expediente::findOrFail ( $id );
        $history = $expediente->histories->where('estado', '=', 'pendiente')->first();
        $areas = $expediente->tipoexpediente->areas;


        /** buscamos las areas anteriores y las areas siguientes del area actual*/

        $areas_anteriores = $areas->take($history->orden);

        //dd ($history->orden);

        if($history->orden < $areas->count()-1)
        {
            $areas_siguientes = $areas->splice($history->orden+1);
        }
        else
        {
            $areas_siguientes = collect ([]);
        }


        /**Politica de acceso*/
        $this->authorize ('edit', $history);

        /**Le pasamos a la vista el history anterior para usar sus datos*/
        if ($history->orden > 0) {
            $history_anterior = $expediente->histories->where('estado', '<>', 'pendiente')->last();
        }
        else
        {
            $history_anterior = $expediente->histories[0];
        }


        /**Notificar a usuarios*/
        $notifications = \Auth::user ()->unreadNotifications
            ->where('type', '=', 'App\Notifications\NuevoPendienteNotification');

        foreach ($notifications as $notification)
        {
            if ($notification->data['expediente_id'] == $id)
            {
                $notification->markAsRead();
                break;
            }

        }

        if (\Auth::user()->role_id == 1 || \Auth::user()->role_id == 2 )
        {
            $responsable = $history->area->user;
            $notifications = $responsable->unreadNotifications
                ->where('type', '=', 'App\Notifications\NuevoPendienteNotification');

            foreach ($notifications as $notification)
            {
                if ($notification->data['expediente_id'] == $id)
                {
                    $notification->markAsRead();
                    break;
                }

            }
        }


        return view ('aprobacion_expedientes.expedientes_pendientes.edit',
            ['expediente' => $expediente, 'history' =>$history,
                'history_anterior' => $history_anterior,
                'areas_anteriores' => $areas_anteriores,
                'areas_siguientes' => $areas_siguientes]);

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

        /**Datos del formulario: estado, area_envio, observaciones*/

        $estado = $request->get ('estado');
        $observaciones = $request->get ('observaciones');
        $rechazado_area = $request->get ('radio_button');
        $orden = $request->get ('select_area_id'); //orden hacia atras
        $orden_siguiente = $request->get ('id_area_siguiente');
        $observaciones_adelante = $request->get ('observaciones_adelante');

        $expediente = Expediente::findOrFail ($id);

        $areas  = $expediente->tipoexpediente->areas; /**buscamos todas las areas correspondientes a ese tipo de expediente*/
        $history_actual =  History::where('expediente_id', '=', $expediente->id)
            ->where ('estado', '=', 'pendiente')->first ();
        //Area (estado pendiente) al que corresponde el jefe o gerente ($area_actual->area_id)


        /**policies*/
        $this->authorize ('update', $history_actual);


        if($estado == 'aprobado')
        {
            $siguiente_posicion = $history_actual->orden+1; //buscamos a qué posición tiene que ir el expediente despues de ser aprobado

            $history_actual->estado = 'aprobado';
            $history_actual->observaciones = $observaciones;
            $history_actual->aprobado_por = Auth::user ()->id;
            $history_actual->update();


            if ($siguiente_posicion < $areas->count())
            {
                $id_area_siguiente = $areas[$siguiente_posicion]->id;

                $new_history = new History();
                $new_history->expediente_id = $expediente->id;
                $new_history->area_id =$id_area_siguiente;
                $new_history->orden = $siguiente_posicion;
                $new_history->estado = 'pendiente';
                $new_history->fecha_entrada = Carbon::now ('America/Asuncion');
                $new_history->observaciones = $observaciones;

                $new_history->save ();

                /**Notificaciones: primero buscamos al usuario al que debemos notificar y le enviamos la notificación*/
                $responsable_notificacion = Area::findOrFail ($id_area_siguiente)->user;
                $responsable_notificacion->notify(new NuevoPendienteNotification($new_history));

            }

        }
        elseif ($estado == 'rechazado')
        {
            if ($rechazado_area == 'area_actual')
            {
                $history_actual->estado = 'rechazado';
                $history_actual->observaciones = $observaciones;
                $history_actual->aprobado_por = \Auth::user ()->id;
                $history_actual->update();

                /**Notificaciones: primero buscamos al usuario al que debemos notificar y le enviamos la notificación*/
                $usuario_rechazado = $expediente->creador;
                $usuario_rechazado->notify(new RechazadosNotification($history_actual) );
            }
            elseif ($rechazado_area == 'otra_area')
            {
                $history_actual->estado = 'rechazado';
                $history_actual->observaciones = $observaciones;
                $history_actual->aprobado_por = \Auth::user ()->id;
                $history_actual->update();

                $new_history = new History();
                $new_history->expediente_id = $expediente->id;
                $new_history->area_id = $areas[$orden]->id;
                $new_history->orden = $orden;
                $new_history->estado = 'rechazado';
                $new_history->fecha_entrada = Carbon::now ('America/Asuncion');
                $new_history->observaciones = $observaciones;
                $new_history->aprobado_por = \Auth::user ()->id;
                $new_history->save ();

                /**obtenemos el usuario al que vamos a notificar y le asignamos una notificación*/
                $usuario_rechazado = $expediente->creador;
                $usuario_rechazado->notify(new RechazadosNotification($new_history) );
            }
        }
        else
        {
            $history_actual->estado = 'aprobado';
            $history_actual->observaciones = $observaciones_adelante;
            $history_actual->update();

            $new_history = new History();
            $new_history->expediente_id = $expediente->id;
            $new_history->area_id = $areas[$orden_siguiente]->id;
            $new_history->orden = $orden_siguiente;
            $new_history->estado = 'pendiente';
            $new_history->fecha_entrada = Carbon::now ('America/Asuncion');
            $new_history->observaciones = $observaciones_adelante;
            $new_history->aprobado_por = \Auth::user ()->id;
            $new_history->save ();

            /**obtenemos el usuario al que vamos a notificar y le asignamos una notificación*/

            $responsable_notificacion = Area::findOrFail ($new_history->area_id)->user;
            $responsable_notificacion->notify(new NuevoPendienteNotification($new_history));
        }

        return redirect ('aprobacion_expedientes/expedientes_pendientes');

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
