@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
            <h3>Listado de Funcionarios <a href="funcionarios/create">@if(in_array (auth ()->user ()->role_id, [1,2] ))<button class="btn btn-success">Nuevo</button>@endif</a></h3>
            @include('roles.search')
            <br>
        </div>
    </div>

    <div class="row text-uppercase">
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead style="background-color: #8eb4cb">
                        <th>id</th>
                        <th>Nombre</th>
                        <th>Departamento</th>
                        <th>Telefono</th>
                        <th>email</th>
                        @if(in_array (auth ()->user ()->role_id, [1,2] ))
                            <th>Opciones</th>
                        @endif
                    </thead>
                    @foreach ($funcionarios as $funcionario)
                        <tr class="text-uppercase">
                            <td>{{$funcionario->id}}</td>
                            <td>{{ $funcionario->user->name}} {{$funcionario->user->lastname}}</td>
                            <td>{{ $funcionario->departamento->nombre}}</td>
                            <td>{{$funcionario->user->phone}}</td>
                            <td class="text-lowercase">{{$funcionario->user->email}}</td>
                            @if(in_array (auth ()->user ()->role_id, [1,2] ))
                                <td>
                                    <a href="{{URL::action('FuncionarioController@edit',$funcionario->id)}}"><button class="btn btn-info">Editar</button></a>
                                    <a href="" data-target="#modal-delete-{{$funcionario->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>

                                </td>
                            @endif
                        </tr>
                        @include('funcionarios.modal')
                    @endforeach
                </table>
            </div>
            {{$funcionarios->render()}}
        </div>
    </div>

@endsection