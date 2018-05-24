@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado de Departamentos <a href="departamentos/create">@if(in_array (auth ()->user ()->role_id, [1,2] ))<button class="btn btn-success">Nuevo</button>@endif</a></h3>
            @include('departamentos.search')
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
                        <th>Dependencia</th>
                        <th>Telefono</th>
                        <th>Email</th>
                        @if(in_array (auth ()->user ()->role_id, [1,2] ))
                        <th class="text-center">Opciones</th>
                        @endif
                    </thead>
                    @foreach ($departamentos as $departamento)
                        <tr class="text-uppercase">
                            <td>{{$departamento->id}}</td>
                            <td>{{ $departamento->nombre}}</td>
                            <td>{{ $departamento->descripcion}}</td>
                            <td>{{$departamento->user_id ? $departamento->user->name : ''}}  {{$departamento->user_id ? $departamento->user->lastname : ''}}</td>
                            <td>{{$departamento->dependencia->nombre}}</td>
                            <td>{{$departamento->user->phone}}</td>
                            <td class="text-lowercase">{{$departamento->user->email}}</td>
                            @if(in_array (auth ()->user ()->role_id, [1,2] ))
                            <td class="text-center">
                                <a href="{{URL::action('DepartamentoController@edit',$departamento->id)}}"><button class="btn btn-info">Editar</button></a>
                                <a href="" data-target="#modal-delete-{{$departamento->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>

                            </td>
                            @endif
                        </tr>
                        @include('departamentos.modal')
                    @endforeach
                </table>
            </div>
            {{$departamentos->render()}}
        </div>
    </div>

@endsection