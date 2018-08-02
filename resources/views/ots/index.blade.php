@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado de Ordenes de trabajo <a href="ots/create"><button class="btn btn-success">Nuevo</button></a></h3>
            @include('ots.search')
            <br>
        </div>
    </div>

    <div class="row text-uppercase">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead style="background-color: #8eb4cb">
                        <th>id</th>
                        <th>Codigo</th>
                        <th>Obra</th>
                        <th>Referencia</th>
                        @if(in_array (auth ()->user ()->role_id, [1,2] ))
                        <th class="text-center col-lg-2">Opciones</th>
                        @endif

                    </thead>
                    @foreach ($ots as $ot)
                        <tr>
                            <td>{{$ot->id}}</td>
                            <td>{{ $ot->codigo}}</td>
                            <td>{{ $ot->obra}}</td>
                            <td>{{ $ot->referencia}}</td>

                            @if(in_array (auth ()->user ()->role_id, [1,2] ))
                            <td class=" text-center">
                                <a href="{{URL::action('OtController@edit',$ot->id)}}"><button class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-check-circle-o" aria-hidden="true"></i></button></a>


                                <a href="" data-target="#modal-delete-{{$ot->id}}" data-toggle="modal" data-placement="top" title="Eliminar"><button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>

                            </td>
                            @endif
                        </tr>
                        @include('ots.modal')
                    @endforeach
                </table>
            </div>
            {{$ots->render()}}
        </div>
    </div>

@endsection