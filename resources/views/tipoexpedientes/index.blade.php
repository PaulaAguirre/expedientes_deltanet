@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado de Tipos de Expedientes
                @if(in_array (auth ()->user ()->role_id, [1,2] ))
                    <a href="tipoexpedientes/create"><button class="btn btn-success">Nuevo</button></a>
                @endif
            </h3>
            @include('tipoexpedientes.search')
        </div>
    </div>

    <div class="row text-uppercase">
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
            <div class="table-responsive text-uppercase">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead style="background-color: #8eb4cb" >
                    <th class="text-center">id</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Descripción</th>
                    <th class="text-center">Opciones</th>
                    </thead>
                    @foreach ($tipos as $tipo)
                        <tr class="text-center">
                            <td>{{$tipo->id}}</td>
                            <td>{{ $tipo->nombre}}</td>
                            <td>{{ $tipo->descripcion}}</td>

                            <td class="text-center">
                                <a href="{{URL::action('TipoexpedienteController@show',$tipo->id)}}"><button class="btn btn-primary">Detalles</button></a>
                                @if(in_array (auth ()->user ()->role_id, [1,2] ))
                                    <a href="" data-target="#modal-delete-{{$tipo->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                                @endif
                            </td>

                        </tr>
                        @include('tipoexpedientes.modal')
                    @endforeach
                </table>
            </div>
        </div>
        {{$tipos->render()}}
    </div>

@endsection