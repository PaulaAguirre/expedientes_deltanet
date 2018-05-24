@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado de Expedientes <a href="expedientes/create"><button class="btn btn-success">Nuevo</button></a></h3>
            <small class="text-muted">
                <span class="text-bold">Los estados de los expedientes pueden ser:</span><br>
                Rechazado: Expediente rechazado por algún motivo que debe ser regularizado<br>
                Pendiente: Expediente en espera de aprobación para pasar al sgte. área<br>
                Aprobado: Expediente aprobado por todas las áreas relacionadas a la misma (finalizado).
            </small>
            <p><br></p>
            @include('expedientes.search')

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead style="background-color: #8eb4cb">
                        <th>id</th>
                        <th>Tipo</th>
                        <th>OT</th>
                        <th>Referencia</th>
                        @if(in_array (auth ()->user ()->role_id, [1,2] ))
                            <th>Creador</th>
                            @endif
                        <th>Estado</th>
                        <th class="text-center">Opciones</th>


                    </thead>
                    @foreach ($expedientes as $expediente)
                        @if($expediente->user_id == Auth::user ()->id || in_array (Auth::user ()->role_id, [1,2]))

                            <tr class="text-uppercase">
                            <td>{{$expediente->id}}</td>
                            <td>{{$expediente->tipoexpediente->nombre}}</td>
                            <td> {{$expediente->ot->codigo}} {{$expediente->ot->obra}}</td>
                            <td>{{$expediente->referencia}}</td>
                                @if(in_array (auth ()->user ()->role_id, [1,2] ))
                                    <td>{{$expediente->creador->name}} {{$expediente->creador->lastname}}</td>
                                @endif
                                @if($expediente->histories->last()->estado == 'aprobado')
                                     <td class="text-green">Aprobado</td>
                                @elseif($expediente->histories->last()->estado == 'rechazado')
                                    <td class="text-danger">Rechazado</td>
                                @else
                                    <td class="text-info">Pendiente</td>
                                @endif
                            <td class="text-center">
                                <a href="{{URL::action('ExpedienteController@show',$expediente->id)}}"><button class="btn btn-primary">Detalles</button></a>
                                @if(in_array (auth ()->user ()->role_id, [1,2] ))
                                    <a href="" data-target="#modal-delete-{{$expediente->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                                @endif
                                @if($expediente->histories->last()->estado == 'rechazado')
                                    <a href="{{URL::action ('RechazadosController@edit', $expediente->id)}}"><button class="btn btn-warning">Regularizar</button></a>
                                @endif
                                <a href="{{URL::action ('ExpedienteController@edit', $expediente->id)}}"><button class="btn btn-info">Editar</button></a>
                            </td>

                            </tr>
                        @endif
                        @include('expedientes.modal')
                    @endforeach
                </table>
                {{$expedientes->render()}}
            </div>
        </div>
    </div>
@endsection