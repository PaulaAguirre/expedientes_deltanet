@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nuevo Expediente</h3>
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

    {!!Form::open(array('url'=>'expedientes','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="tipo_id">Tipo de Expediente</label>
                <select name="tipo_id" class="selectpicker form-control text-uppercase" title="Seleccione un tipo">
                    @foreach($tipos as $tipo )
                        <option value="{{$tipo->id}}">{{strtoupper ($tipo->nombre)}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="ot_id">OT-Obra</label>
                <select name="ot_id" class="selectpicker form-control text-uppercase" title="Seleccione una OT" data-live-search="true">
                    @foreach($ots as $ot )
                        <option value="{{$ot->id}}">{{strtoupper ($ot->codigo)}} - {{strtoupper ($ot->obra)}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="referencia">Referencia</label>
                <input type="text" name="referencia" required value="{{old('referencia')}}" class="form-control text-uppercase" placeholder="Referencia">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="">Proveedor</label>
                <select name="proveedor_id" class="selectpicker form-control text-uppercase " data-live-search="true" title="Seleccione un proveedor">
                    @foreach($proveedores as $proveedor )
                        <option value="{{$proveedor->id}}">{{strtoupper ($proveedor->name)}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="cliente">Cliente</label>
                <select name="cliente_id" class="selectpicker form-control text-uppercase">
                    @foreach($clientes as $cliente )
                        <option value="{{$cliente->id}}">{{strtoupper ($cliente->nombre)}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="monto">Monto Factura</label>
                <input type="number" name="monto_factura" required value="{{old('monto_factura')}}" class="form-control text-uppercase" placeholder="monto factura">
            </div>
        </div>


        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="monto">Monto Total</label>
                <input type="number" name="monto" required value="{{old('monto')}}" class="form-control text-uppercase" placeholder="monto total">
            </div>
        </div>


        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="notas">Notas</label>
                <textarea class="form-control text-uppercase" name="notas" rows="1" placeholder="Notas extras respecto al expediente"></textarea>
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