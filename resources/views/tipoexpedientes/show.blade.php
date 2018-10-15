@extends ('layouts.admin')
@section ('contenido')

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Tipo de Expediente:<div class="text-blue text-uppercase">{{$tipo->nombre}}</div></h3>
        </div>
    </div><br>

    <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <p class="text-uppercase">{{$tipo->descripcion}}</p>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="pane panel-primary">
            <div class="panel-body">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color: #8eb4cb">
                        <th>Orden</th>
                        <th><i class="fa fa-arrow-circle-down"></i>ID Area</th>
                        <th>Nombre</th>
                        <th>Estado</th>
                        </thead>
                        <tfoot>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        </tfoot>
                        <tbody class="text-uppercase">
                        @foreach($areas as $area)
                            <tr>
                                <td>{{$area->pivot->orden}}</td>
                                <td><i class="fa fa-arrow-circle-down"></i>{{$area->id}}</td>
                                <td>{{$area->nombre}}</td>
                                <td>{{$area->pivot->situacion}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <a href="{{url('tipoexpedientes')}}"><button class="btn btn-info">Volver</button></a>

        </div>
    </div>
@endsection