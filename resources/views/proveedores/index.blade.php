@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado de Proveedores <a href="proveedores/create"><button class="btn btn-success">Nuevo</button></a></h3>
            @include('proveedores.search')
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead style="background-color: #8eb4cb">
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Ruc</th>
                        <th>Teléfono</th>
                        <th>Celular</th>
                        <th>Email</th>
                        @if(in_array (auth ()->user ()->role_id, [1,2] ))
                            <th>Opciones</th>
                        @endif
                    </thead>
                    @foreach ($proveedores as $proveedor)
                        <tr>
                            <td>{{$proveedor->id}}</td>
                            <td>{{$proveedor->name}}</td>
                            <td>{{$proveedor->ruc}}</td>
                            <td>{{$proveedor->phone}}</td>
                            <td>{{$proveedor->mobile}}</td>
                            <td>{{$proveedor->email}}</td>
                            @if(in_array (auth ()->user ()->role_id, [1,2] ))

                                <td>
                                    <a href="{{URL::action('ProveedorController@edit',$proveedor->id)}}"><button class="btn btn-info">Editar</button></a>
                                    <a href="" data-target="#modal-delete-{{$proveedor->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                                </td>
                            @endif
                        </tr>
                        @include('proveedores.modal')
                    @endforeach
                </table>
            </div>
            {{$proveedores->render()}}
        </div>
    </div>

@endsection