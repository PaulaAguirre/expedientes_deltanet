@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3 style="text-decoration: #1025ff">Listado de expedientes Rechazados</h3>
            <br>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead class="text-center" style="background-color: #8eb4cb">
                    <th>id</th>
                    <th>OT</th>
                    <th>Fecha Entrada</th>
                    @if(in_array (Auth::user ()->role_id, [1,2]))
                    <th>Creador</th>
                    @endif
                    <th>Obra</th>
                    <th>Monto</th>
                    <th>Area Actual</th>
                    <th class="text-center">Opciones</th>

                    </thead>

                    @foreach ($expedientes as $expediente)
                        @if($expediente->histories->last()->estado == 'rechazado')
                            @if(Auth::user ()->role_id == 3 || Auth::user ()->role_id == 8)
                                @if($rechazado->expediente->user_id == Auth::user ()->id)
                                    <tr class="text-uppercase">
                                        <td>{{$expediente->id}}</td>
                                        <td>{{$expediente->ot->codigo}} - {{$expediente->ot->obra}}</td>
                                        <td>{{$expediente->histories->last()->fecha_entrada}}</td>
                                        <td>{{$expediente->creador->name}} {{$expediente->creador->lastname}}</td>
                                        <td>{{$expediente->obra}}</td>
                                        <td>{{$expediente->monto}}</td>
                                        <td>{{$expediente->histories->last()->area->nombre}}</td>

                                        <td class="text-center">
                                            <a href="{{URL::action('RechazadosController@edit', $expediente->id)}}"><button class="btn btn-warning">Regularizar</button></a>
                                        </td>
                                    </tr>
                                @endif
                            @endif
                            @if(in_array (Auth::user ()->role_id, [1,2]))
                                <tr class="text-uppercase">
                                    <td>{{$expediente->id}}</td>
                                    <td>{{$expediente->ot->codigo}} - {{$expediente->ot->obra}}</td>
                                    <td>{{$expediente->histories->last()->fecha_entrada}}</td>
                                    <td>{{$expediente->creador->name}} {{$expediente->creador->lastname}}</td>
                                    <td>{{$expediente->obra}}</td>
                                    <td>{{$expediente->monto}}</td>
                                    <td>{{$expediente->histories->last()->area->nombre}}</td>

                                    <td class="text-center">
                                        <a href="{{URL::action('RechazadosController@edit', $expediente->id)}}"><button class="btn btn-warning">Regularizar</button></a>
                                    </td>

                                </tr>
                            @endif
                        @endif
                    @endforeach
                </table>
            </div>
            {{$expedientes->render()}}
        </div>
    </div>

@endsection