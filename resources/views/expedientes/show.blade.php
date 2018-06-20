@extends ('layouts.admin')
@section ('contenido')

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>OT:<div class="text-blue text-uppercase">{{$expediente->ot->ot}} {{$expediente->ot->obra}}</div></h3>
            <h4 class="text-bold">Tiempo transcurrido: {{$tiempo_transcurrido}}</h4>

        </div>
    </div><br>

    <div class="row text-uppercase">

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group text-uppercase">
                <label for="tipo">Tipo Expediente</label>
                <p class="text-uppercase">{{$expediente->tipoexpediente->nombre}}</p>
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group text-uppercase">
                <label for="referencia">Referencia</label>
                <p>{{$expediente->referencia}}</p>
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group text-uppercase">
                <label for="tipo">Creador - Cargo</label>
                <p class="text-uppercase">{{$expediente->creador->name}} {{$expediente->creador->lastname}} - {{$cargo}}</p>
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group text-uppercase">
                <label for="tipo">Area</label>
                <p class="text-uppercase">{{$area_creacion}}</p>
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group text-uppercase">
                <label for="cliente">Cliente</label>
                <p class="text-uppercase">{{$expediente->cliente->nombre}}</p>
            </div>
        </div>


        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group text-uppercase">
                <label for="proveedor">Proveedor</label>
                <p class="text-uppercase">{{$expediente->proveedor->name}}</p>
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group text-uppercase">
                <label for="monto">Monto</label>
                <p>{{$expediente->monto}}</p>
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group text-uppercase text-danger text-bold">
                <label for="monto">última edición</label>
                <p>{{$expediente->updated_at}}</p>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="pane panel-primary">
            <div class="panel-body">
                <div class="col-lg-8 col-sm-8 col-md-18 col-xs-12">
                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color: #8eb4cb">
                        <th>Area__<i class="fa fa-arrow-circle-down"></i></th>
                        <th>Fecha Entrada</th>
                        <th>Observaciones</th>
                        <th>Estado</th>
                        </thead>
                        <tfoot>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        </tfoot>
                        <tbody>
                        @foreach($histories as $history)
                            <tr class="text-uppercase">
                                <td>{{$history->area->nombre}}</td>
                                <td>{{$history->fecha_entrada}}</td>
                                <td>{{$history->observaciones}}</td>
                                <td>{{$history->estado}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-offset-6 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <a href="{{URL::previous ()}}"><button class="btn btn-info">Volver</button></a>

        </div>
    </div>
@endsection