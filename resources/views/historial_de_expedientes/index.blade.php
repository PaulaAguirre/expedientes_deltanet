@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
            <h3 style="text-decoration: #1025ff">Historial de Expedientes</h3>
            <br>
            @include('historial_de_expedientes.search')
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead class="text-center" style="background-color: #8eb4cb">
                    <th>id</th>
                    <th>Tipo</th>
                    <th>OT</th>
                    <th>Número</th>
                    <th>Proveedor</th>
                    <th>Area Actual</th>
                    <th>Creador</th>
                    <th>Monto</th>
                    <th>Estado</th>
                    <th class="text-center">Opciones</th>

                    </thead>
                    @foreach ($expedientes as $expediente)
                        <tr class="text-uppercase">
                            <td>{{$expediente->id}}</td>
                            <td>{{$expediente->tipoexpediente->nombre}}</td>
                            <td> {{$expediente->ot->codigo}}</td>
                            <td> {{$expediente->numero}}</td>
                            <td>{{$expediente->proveedor->name}}</td>
                            <td>{{$expediente->histories->last()->area->nombre}}</td>
                            <td>{{$expediente->creador->name}} {{$expediente->creador->lastname}}</td>
                            <td>{{number_format ($expediente->monto_factura,2, ",", ".")}}</td>
                            @if($expediente->histories->last()->estado == 'aprobado')
                                <td class="text-green">Proceso Finalizado</td>
                            @elseif($expediente->histories->last()->estado == 'rechazado')
                                <td class="text-danger">Rechazado</td>
                            @else
                                <td class="text-info">Pendiente</td>
                            @endif
                            <td class="text-center">
                                <a href="{{URL::action('ExpedienteController@show',$expediente->id)}}"><button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Detalles"><i class="fa fa-eye" aria-hidden="true"></i></button></a>

                            </td>
                    @endforeach
                </table>
            </div>

        </div>

    </div>
    {{$expedientes->links()}}
@endsection