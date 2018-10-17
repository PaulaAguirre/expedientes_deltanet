@extends ('layouts.admin')
@section ('contenido')

    <div class="row text-uppercase">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <button class="btn-bitbucket"><h4>ID: {{$expediente->id}}</h4></button>
            <h3 class="text-blue">OT: {{$expediente->ot->obra}} - {{$expediente->ot->codigo}}</h3>
            <h4 class="text-blue">Número {{$expediente->numero}}</h4>
            <h4 class="text-bold">Tiempo transcurrido en días: {{$tiempo_transcurrido}}</h4>

        </div>
    </div><br>

    <div class="row text-uppercase">

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group text-uppercase">
                <label for="tipo">Tipo Expediente - Memo N°</label>
                <p class="text-uppercase">{{$expediente->tipoexpediente->nombre}} - {{$expediente->memo}}</p>
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
                <label for="proveedor">Numero Factura</label>
                <p class="text-uppercase">{{$expediente->numero_factura ? $expediente->numero_factura : 0}}</p>
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
                <label for="monto">Monto Factura</label>
                <p>{{number_format ($expediente->monto_factura,2, ",", ".")}}</p>
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group text-uppercase">
                <label for="monto">Monto Cheque</label>
                <p>{{ $expediente->monto_cheque ? number_format ($expediente->monto_cheque,2, ",", ".") : 0}}</p>
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group text-uppercase">
                <label for="monto">Monto Total</label>
                <p>{{number_format ($expediente->monto,2, ",", ".")}}</p>
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group text-uppercase text-danger text-bold">
                <label for="monto">última edición</label>
                <p>{{$expediente->updated_at}}</p>
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group text-uppercase">
                <label for="referencia">Referencia</label>
                <p>{{$expediente->referencia}}</p>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="pane panel-primary">
            <div class="panel-body">
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color: #8eb4cb">
                        <th>Orden</th>
                        <th>Area__<i class="fa fa-arrow-circle-down"></i></th>
                        <th>Fecha Entrada</th>
                        <th>Observaciones</th>
                        <th>Enviado por</th>
                        <th>Estado</th>
                        <th>Situacion</th>
                        </thead>
                        <tfoot>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        </tfoot>
                        <tbody>
                        @foreach($histories as $history)
                            <tr class="text-uppercase">
                                <td>{{$history->orden}}</td>
                                <td>{{$history->area->nombre}}</td>
                                <td>{{$history->fecha_entrada}}</td>
                                <td>{{$history->observaciones ? $history->observaciones : 'Sin observaciones'}}</td>
                                <td>{{$history->user ? $history->user->name.' '.$history->user->lastname : ''}}</td>
                                <td>{{$history->estado}}</td>
                                <td>{{$history->expediente->tipoexpediente->areas[$history->orden]->pivot->situacion ? $history->expediente->tipoexpediente->areas[$history->orden]->pivot->situacion : ''}}</td>
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
</div>
@endsection