@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Tipo Expediente: {{$contacto->nombre}} {{$contacto->apellido}}</h3>
            @if (count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    {!!Form:: model($contacto, ['method'=>'PATCH', 'route'=>['tipoexpedientes.update', $tipoexpediente],'files'=>'true'])!!}
    {{Form::token()}}
    <div class="row">

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" required value="{{$tipoexpediente->nombre}}" class="form-control text-uppercase" placeholder="Nombre del tipo de Expediente..">
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="nombre">Descripcion</label>
                <input type="text" name="nombre" required value="{{$tipoexpediente->descripcion}}" class="form-control text-uppercase" placeholder="Nombre del tipo de Expediente..">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="panel panel-primary">
            <div class="panel panel-body">
                <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 text-center">
                    <div class="form-group">
                        <label>Agregar ruta del expediente</label>
                        <select name="pidarea" class="form-control selectpicker text-uppercase" id="pidarea" title="Seleccione una Gerencia/Dpto" data-live-search="true">
                            @foreach($areas as $area)
                                <option value="{{$area->id}}">{{strtoupper ($area->nombre)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                <br>
                <div class="form-group">
                    <button type="button" id="bt_add" class="btn btn-primary">Agregar Ruta</button>
                </div>
            </div>

            <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                    <thead style="background-color: #8eb4cb">
                    <th>Opciones</th>
                    <th>Nombre</th>
                    </thead>
                    <tbody>
                        @foreach($areas as $area)
                            <tr>
                                <td>{{$area->nombre}}</td>
                                <td><button type="button" class="btn btn-warning">X</button></td>
                            </tr>
                         @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>



    {!!Form::close()!!}
@endsection