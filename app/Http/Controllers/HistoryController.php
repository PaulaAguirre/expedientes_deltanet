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
        $history = $expediente->histories->where ( 'estado', '=', 'pendiente' )->first ();
        $area_actual = $history->area_id;

        /** buscamos la posición en la que se encuentra el area actual en el array de areas y devolvemos las areas anteriores
         y las areas siguientes al area actual*/
        $areas =$expediente->tipoexpediente->areas->pluck('id');
        $posicion_actual = $areas->search($area_actual);
        $anteriores = $areas->take($posicion_actual);
        $siguientes = $areas->splice($posicion_actual+1);

        $collect_anteriores = collect ([]);
        $collect_siguientes = Collect ([]);

        foreach ($anteriores as $anterior)
        {
            $area = Area::findOrFail ($anterior);
            $collect_anteriores->push ($area);
        }

        foreach ($siguientes as $siguiente)
        {
            $area = Area::findOrFail ($siguiente);
            $collect_siguientes->push ($area);
        }

       /** obtenemos el numero de registros para pasarle el area anterior en el que estuvo el expediente a la vista*/
        $nro_registros = $expediente->histories->count ();

        if ($nro_registros > 2) {
            $history_anterior = $expediente->histories[$nro_registros - 2];

        } else
        {
            $history_anterior = $expediente->histories[0];
        }

        /**Politica de acceso*/
        $this->authorize ('edit', $history);

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
                    'collect_anteriores' => $collect_anteriores,
                    'collect_siguientes' => $collect_siguientes,
                    'area_actual' => $area_actual]);
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
        $area_envio = $request->get ('select_area_id');
        $id_area_adelante = $request->get ('id_area_siguiente');
        $observaciones_adelante = $request->get ('observaciones_adelante');

        $expediente = Expediente::findOrFail ($id);

        $tipo_id = $expediente->tipoexpediente->id;
        //buscamos todas las areas correspondientes a ese tipo de expediente
        $areas_expediente = Tipoexpediente::findOrFail ($tipo_id)->areas->pluck('id')->toArray();
        $area_actual= History::where('expediente_id', '=', $expediente->id)
            ->where ('estado', '=', 'pendiente')->first ();
        //Area (estado pendiente) al que corresponde el jefe o gerente ($area_actual->area_id)


        $sgte_posicion = array_search ($area_actual->area_id, $areas_expediente) + 1 ; //siguiente posicion en el array de areas
       if ($sgte_posicion  < count ($areas_expediente))
       {
           $id_area_sgte = $areas_expediente[$sgte_posicion]; //devuelve el id de la siguiente posicion en el array de areas
       }

        /**buscamos el registro en el que se encuentra el expediente en el history y el area correspondiente*/
        $registro_estado = History::where('expediente_id', '=', $expediente->id)
            ->where ('area_id','=', $area_actual->area_id)
            ->where ('estado', '=', 'pendiente')
            ->first ();


        /**policies*/
        $this->authorize ('update', $registro_estado);

        if ($estado == 'aprobado'){
            $registro_estado->estado = 'aprobado';
            $registro_estado->observaciones = $observaciones;
            $registro_estado->aprobado_por = \Auth::user ()->id;
            $registro_estado->update();

            if ($sgte_posicion  < count ($areas_expediente))
            {

                $new_history = new History();
                $new_history->expediente_id = $expediente->id;
                $new_history->area_id = $id_area_sgte;
                $new_history->estado = 'pendiente';
                $new_history->fecha_entrada = Carbon::now ('America/Asuncion');
                $new_history->observaciones = $observaciones;
                $new_history->save ();

                /**Notificaciones: primero buscamos al usuario al que debemos notificar y le enviamos la notificación*/
                $responsable_notificacion = Area::findOrFail ($id_area_sgte)->user;
                $responsable_notificacion->notify(new NuevoPendienteNotification($new_history));
            }

        }
        elseif ($estado == 'rechazado')
        {

            if($rechazado_area == 'area_actual')
            {
                $registro_estado->estado = 'rechazado';
                $registro_estado->observaciones = $observaciones;
                $registro_estado->aprobado_por = \Auth::user ()->id;
                $registro_estado->update();

                /**obtenemos el usuario al que vamos a notificar y le asignamos una notificación*/
                $usuario_rechazado = $expediente->creador;

                /**Notificaciones: primero buscamos al usuario al que debemos notificar y le enviamos la notificación*/
                $usuario_rechazado->notify(new RechazadosNotification($registro_estado) );
            }
            elseif ($rechazado_area == 'otra_area')
            {
                $registro_estado->estado = 'rechazado';
                $registro_estado->observaciones = $observaciones;
                $registro_estado->aprobado_por = \Auth::user ()->id;
                $registro_estado->update();

                $new_history = new History();
                $new_history->expediente_id = $expediente->id;
                $new_history->area_id = $area_envio;
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
            $registro_estado->estado = 'aprobado';
            $registro_estado->observaciones = $observaciones_adelante;
            $registro_estado->update();

            $new_history = new History();
            $new_history->expediente_id = $expediente->id;
            $new_history->area_id = $id_area_adelante;
            $new_history->estado = 'pendiente';
            $new_history->fecha_entrada = Carbon::now ('America/Asuncion');
            $new_history->observaciones = $observaciones_adelante;
            $new_history->aprobado_por = \Auth::user ()->id;
            $new_history->save ();

            /**obtenemos el usuario al que vamos a notificar y le asignamos una notificación*/

            $responsable_notificacion = Area::findOrFail ($id_area_adelante)->user;
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
