@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3 style="text-decoration: #1025ff">Listado de expedientes Rechazados</h3>
            @include('expedientes_rechazados.expedientes_rechazados_creador.search')
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
                    <th>Creador</th>
                    <th>Monto</th>
                    <th>Proveedor</th>
                    <th>Area Actual</th>
                    <th class="text-center">Opciones</th>

                    </thead>

                    @foreach ($expedientes as $expediente)
                        @if($expediente->histories->last()->estado == 'rechazado')
                            @if(Auth::user ()->role_id == 3 || Auth::user ()->role_id == 8)
                                @if($expediente->user_id == Auth::user ()->id)
                                    <tr class="text-uppercase">
                                        <td>{{$expediente->id}}</td>
                                        <td>{{$expediente->ot->codigo}}</td>
                                        <td>{{$expediente->histories->last()->created_at->format('d-m-Y')}}</td>
                                        <td>{{$expediente->creador->name}} {{$expediente->creador->lastname}}</td>
                                        <td>{{number_format($expediente->monto,2, ",", ".")}}</td>
                                        <td>{{$expediente->proveedor->name ? $expediente->proveedor->name : ""}}</td>
                                        <td>{{$expediente->histories->last()->area->nombre}}</td>
                                        <td class="text-center">
                                            <a href="{{URL::action('ExpedienteController@show',$expediente->id)}}"><button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Detalles"><i class="fa fa-eye" aria-hidden="true"></i></button></a>

                                            <a href="{{URL::action('RechazadosController@edit', $expediente->id)}}"><button class="btn btn-warning"data-toggle="tooltip" data-placement="top" title="Regularizar"><i class="fa fa-wrench" aria-hidden="true"></i></button></a>
                                        </td>
                                    </tr>
                                @endif
                            @endif
                            @if(in_array (Auth::user ()->role_id, [1,2]))
                                <tr class="text-uppercase">
                                    <td>{{$expediente->id}}</td>
                                    <td>{{$expediente->ot->codigo}}</td>
                                    <td>{{$expediente->histories->last()->created_at->format('d-m-Y')}}</td>
                                    <td>{{$expediente->creador->name}} {{$expediente->creador->lastname}}</td>
                                    <td>{{number_format($expediente->monto,2, ".", ",")}}</td>
                                    <td>{{$expediente->proveedor->name ? $expediente->proveedor->name : ""}}</td>
                                    <td>{{$expediente->histories->last()->area->nombre}}</td>

                                    <td class="text-center">
                                        <a href="{{URL::action('ExpedienteController@show',$expediente->id)}}"><button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Detalles"><i class="fa fa-eye" aria-hidden="true"></i></button></a>

                                        <a href="{{URL::action('RechazadosController@edit', $expediente->id)}}"><button class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Regularizar"><i class="fa fa-wrench" aria-hidden="true"></i></button></a>
                                    </td>

                                </tr>
                            @endif
                        @endif
                    @endforeach
                </table>
            </div>
        </div>
    </div>

@endsection