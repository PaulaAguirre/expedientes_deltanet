@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
            <h3 style="text-decoration: #1025ff">Expedientes en espera de Aprobación</h3>
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
                    <th>Memo</th>
                    <th>#</th>
                    <th>Proveedor</th>
                    <th>Fecha</th>
                    <th>Área</th>
                    <th>Monto</th>
                    <th class="text-center">Opciones</th>

                    </thead>
                    @foreach ($expedientes as $expediente)
                        @if($expediente->histories->last()->estado == 'pendiente' && $expediente->histories->last()->area_id == \Illuminate\Support\Facades\Auth::user ()->area->id)
                                <tr class="text-uppercase">
                                    <td>{{$expediente->id}}</td>
                                    <td>{{$expediente->ot->codigo}}</td>
                                    <td>{{$expediente->memo}}</td>
                                    <td>{{$expediente->numero}}</td>
                                    <td>{{$expediente->proveedor->name}}</td>
                                    <td>{{ $expediente->histories->last()->created_at->format('d-m-Y')}}</td>
                                    @if(!$expediente->creador->funcionario && !$expediente->creador->area)
                                        <td>{{''}}</td>
                                    @else
                                        <td>{{$expediente->creador->funcionario ? $expediente->creador->funcionario->departamento->dependencia->nombre : $expediente->creador->area->dependencia->nombre}}</td>
                                    @endif
                                        <td>{{number_format ($expediente->monto,2, ",", ".")}}</td>
                                    <td class="text-center">
                                        <a href="{{URL::action('HistoryController@edit', $expediente->id)}}"><button class="btn btn-primary">Detalles</button></a>
                                    </td>
                                </tr>
                        @endif
                    @endforeach
                </table>
            </div>
        </div>

    </div>

@endsection