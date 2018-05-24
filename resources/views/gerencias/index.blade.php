@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado de Gerencias <a href="gerencias/create">@if(in_array (auth ()->user ()->role_id, [1,2] ))<button class="btn btn-success">Nuevo</button>@endif</a></h3>
            @include('gerencias.search')
            <br>
        </div>
    </div>

    <div class="row text-uppercase">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead class="text-center" style="background-color: #8eb4cb">
                        <th>id</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Responsable</th>
                        <th>telefono</th>
                        <th>email</th>
                        @if(in_array (auth ()->user ()->role_id, [1,2] ))
                        <th class="text-center">Opciones</th>
                        @endif

                    </thead>
                    @foreach ($gerencias as $gerencia)
                        <tr class="text-uppercase">
                            <td>{{$gerencia->id}}</td>
                            <td>{{ $gerencia->nombre}}</td>
                            <td>{{ $gerencia->descripcion}}</td>
                            <td>{{$gerencia->user->name}} {{$gerencia->user->lastname}}</td>
                            <td>{{$gerencia->user->phone}}</td>
                            <td class="text-lowercase">{{$gerencia->user->email}}</td>
                            @if(in_array (auth ()->user ()->role_id, [1,2] ))
                            <td class="text-center">
                                <a href="{{URL::action('GerenciaController@edit',$gerencia->id)}}"><button class="btn btn-info">Editar</button></a>
                                <a href="" data-target="#modal-delete-{{$gerencia->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                            </td>
                            @endif
                        </tr>
                        @include('gerencias.modal')
                    @endforeach
                </table>
            </div>
            {{$gerencias->render()}}
        </div>
    </div>

@endsection