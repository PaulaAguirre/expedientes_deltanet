@extends ('layouts.admin')
@section ('contenido')

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Cliente:<div class="text-blue">{{$cliente->nombre_empresa}}</div></h3>

        </div>
    </div><br>

    <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <p>{{$cliente->dirección}}</p>
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="direccion">Teléfono</label>
                <p>{{$cliente->telefono}}</p>
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="num_comprobante">email</label>
                <p>{{$cliente->email}}</p>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="pane panel-primary">
            <div class="panel-body">
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color: #8eb4cb">
                        <th>Contacto</th>
                        <th>Teléfono</th>
                        <th>Celular</th>
                        <th>email</th>
                        </thead>
                        <tfoot>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        </tfoot>
                        <tbody>
                        @foreach($contactos as $contacto)
                            <tr>
                                <td>{{$contacto->nombre}} {{$contacto->apellido}}</td>
                                <td>{{$contacto->telefono}}</td>
                                <td>{{$contacto->celular}}</td>
                                <td>{{$contacto->email}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection