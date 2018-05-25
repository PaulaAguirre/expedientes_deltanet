@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Usuarios <a href="users/create"> @if(in_array (auth ()->user ()->role_id, [1,2] ))<button class="btn btn-success">Nuevo</button>@endif</a></h3>

            @include('users.search')
        </div>
    </div>

    <div class="row text-uppercase">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead  class="text-uppercase" style="background-color: #8eb4cb">
                        <th>id</th>
                        <th>Nombre</th>
                        <th class="col-lg-2">Area</th>
                        <th>Cargo</th>
                        @if(in_array (auth ()->user ()->role_id, [1,2] ))
                            <th>Cédula</th>
                        @endif
                        <th>Teléfono</th>
                        <th>Móvil</th>
                        <th>Email</th>
                        @if(in_array (auth ()->user ()->role_id, [1,2] ))
                            <th>Rol</th>
                            <th>Opciones</th>
                        @endif

                    </thead>
                    @foreach ($users as $user)
                        <tr class="text-uppercase">
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name}} {{$user->lastname}}</td>
                            @if(!in_array ($user->role_id, [1,2]))
                                @if(!$user->funcionario && !$user->area)
                                   <td>{{''}}</td>
                                @else
                                    <td>{{$user->funcionario ? $user->funcionario->departamento->nombre : $user->area->nombre}}</td>
                                @endif
                            @else
                                <td>Administrador App</td>
                            @endif

                            @if(!in_array ($user->role_id, [1,2]))
                                @if(!$user->funcionario && !$user->area)
                                    <td>{{''}}</td>
                                @else
                                    @if($user->funcionario)
                                        <td>funcionario</td>
                                    @elseif($user->area)
                                        <td>{{$user->area->tipo == 'D' ? 'jefe' : 'Gerente'}}</td>
                                    @endif
                                @endif
                            @else
                                <td>Admin App</td>
                            @endif

                            @if(in_array (auth ()->user ()->role_id, [1,2] ))
                                <td>{{ $user->cedula}}</td>
                            @endif
                            <td>{{ $user->phone}}</td>
                            <td>{{ $user->mobile }}</td>
                            <td class="text-lowercase">{{ $user->email }}</td>
                            @if(in_array (auth ()->user ()->role_id, [1,2] ))
                                <td>{{ $user->role->nombre }}</td>
                            @endif
                            <td>
                                    @if(in_array (auth ()->user ()->role_id, [1,2] ))
                                        <a href="{{URL::action('UserController@edit',$user->id)}}"><button class="btn btn-info">Editar</button></a>
                                        <a href="" data-target="#modal-delete-{{$user->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                                    @endif

                            </td>
                        </tr>
                        @include('users.modal')
                    @endforeach
                </table>
                {{$users->render()}}
            </div>

        </div>
    </div>

@endsection