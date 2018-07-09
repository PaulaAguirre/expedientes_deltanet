@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
            <h3 style="text-decoration: #1025ff">Expedientes en espera de Aprobación</h3>
            <br>
            @include('aprobacion_expedientes.expedientes_pendientes.search')
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
                    <th>Obra</th>
                    <th>Monto</th>
                    <th class="text-center">Opciones</th>

                    </thead>
                    @foreach ($expedientes as $expediente)
                        @if($expediente->histories->last()->estado == 'pendiente')
                            @if($expediente->histories->last()->area_id == Auth::user ()->area->id)
                                <tr class="text-uppercase">
                                    <td>{{$expediente->id}}</td>
                                    <td>{{$expediente->ot->codigo}} - {{$expediente->ot->obra}}</td>
                                    <td>{{ $expediente->histories->last()->fecha_entrada}}</td>
                                    <td>{{$expediente->creador->name}} {{$expediente->creador->lastname}}</td>
                                    <td>{{$expediente->ot->obra}}</td>
                                    <td>{{$expediente->monto}}</td>

                                    <td class="text-center">
                                        <a href="{{URL::action('HistoryController@edit', $expediente->id)}}"><button class="btn btn-primary">Detalles</button></a>
                                    </td>
                                </tr>
                            @endif
                        @endif
                    @endforeach
                </table>
            </div>

        </div>

    </div>
    {{$expedientes->links()}}
@endsection