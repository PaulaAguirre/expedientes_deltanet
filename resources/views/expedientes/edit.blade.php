@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Expediente: {{$expediente->referencia}}</h3>
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
    <br>
    {!!Form:: model($expediente, ['method'=>'PATCH', 'route'=>['expedientes.update', $expediente->id],'files'=>'true'])!!}
    {{Form::token()}}
    <div class="row">

            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                <div class="form-group">
                <label for="tipo_id">Tipo de Expediente</label>
                <select name="tipo_id" class="selectpicker form-control text-uppercase" title="Seleccione un tipo">
                    @foreach($tipos as $tipo )
                        @if ($tipo->id==$expediente->tipo_id)
                            <option value="{{$tipo->id}}" selected>{{strtoupper ($tipo->nombre)}}</option>
                        @else
                            <option value="{{$tipo->id}}">{{strtoupper ($tipo->nombre)}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="ot_id">OT-Obra</label>
                <select name="ot_id" class="selectpicker form-control text-uppercase" title="Seleccione una OT" data-live-search="true">
                    @foreach($ots as $ot )
                        @if($ot->id == $expediente->ot_id)
                            <option value="{{$ot->id}}" selected>{{strtoupper ($ot->codigo)}} - {{strtoupper ($ot->obra)}}</option>
                        @else
                            <option value="{{$ot->id}}">{{strtoupper ($ot->codigo)}} - {{strtoupper ($ot->obra)}}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="referencia">Memo N°</label>
                <input type="text" name="memo"  value="{{$expediente->memo}}" class="form-control text-uppercase" placeholder="número de memo">
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="numero">Número</label>
                <input type="text" name="numero"  value="{{$expediente->numero}}" class="form-control text-uppercase" placeholder="N° SP, OC, etc">
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="referencia">Referencia</label>
                <input type="text" name="referencia" required value="{{$expediente->referencia}}" class="form-control text-uppercase" placeholder="Referencia">
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="">Proveedor</label>
                <select name="proveedor_id" class="selectpicker form-control text-uppercase " data-live-search="true" title="Seleccione un proveedor">
                    @foreach($proveedores as $proveedor )
                        @if($proveedor->id == $expediente->proveedor_id)
                            <option value="{{$proveedor->id}}" selected>{{strtoupper ($proveedor->name)}}</option>
                        @else
                            <option value="{{$proveedor->id}}">{{strtoupper ($proveedor->name)}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="cliente">Cliente</label>
                <select name="cliente_id" class="selectpicker form-control text-uppercase">
                    @foreach($clientes as $cliente )
                        @if($cliente->id == $expediente->cliente_id)
                            <option value="{{$cliente->id}}" selected>{{strtoupper ($cliente->nombre)}}</option>
                        @else
                            <option value="{{$cliente->id}}">{{strtoupper ($cliente->nombre)}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>


        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="monto">Monto Factura</label>
                <input type="number" name="monto_factura" required value="{{$expediente->monto_factura}}" class="form-control text-uppercase" placeholder="monto factura">
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="monto">Monto Total</label>
                <input type="number" name="monto" required value="{{$expediente->monto}}" class="form-control text-uppercase" placeholder="monto">
            </div>
        </div>


        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="notas">Notas</label>
                <textarea class="form-control text-uppercase" name="notas" rows="3" placeholder="Notas extras respecto al expediente" >{{$expediente->notas}}</textarea>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <br>
            <p class="text-danger text-bold text-sm">
                Por favor verifique todos los datos antes de enviar.
                Una vez que el Expediente haya sido enviado, ya no podrá ser modificado. Para más información, comuníquese con el Administrador.
            </p>
        </div>


        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12" id="guardar">
            <div class="form-group">
                <input name="_token" value="{{csrf_token()}}" type="hidden">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
        </div>
    </div>
    {!!Form::close()!!}
@endsection