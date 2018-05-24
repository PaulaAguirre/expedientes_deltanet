@extends ('layouts.admin')
@section ('contenido')
    <div class="row text-uppercase">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado de Roles <a href="roles/create"><button class="btn btn-success">Nuevo</button></a></h3>
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
                        <th>Role</th>
                        <th>Descripción</th>
                        <th class="text-center">Opciones</th>

                    </thead>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{ $role->nombre}}</td>
                            <td>{{ $role->descripcion}}</td>

                            <td class="text-center">
                                <a href="{{URL::action('RoleController@edit',$role->id)}}"><button class="btn btn-info">Editar</button></a>
                                <a href="" data-target="#modal-delete-{{$role->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>

                            </td>
                        </tr>
                        @include('roles.modal')
                    @endforeach
                </table>
            </div>
            {{$roles->render()}}
        </div>
    </div>

@endsection