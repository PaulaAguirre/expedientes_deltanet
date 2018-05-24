@extends ('layouts.admin')
@section ('contenido')


    <div class="row text-uppercase">
        @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {!!Form:: model($expediente, ['method'=>'PATCH', 'route'=>['expedientes_rechazados_creador.update', $expediente->id]])!!}
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="id">ID</label>
                <p>{{$expediente->id}}</p>
            </div>
        </div>


        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label>Tipo Expediente</label>
                <p>{{$expediente->tipoexpediente->nombre}} - {{$expediente->referencia}}</p>
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="ot">OT</label>
                <p class="text-danger text-bold text-uppercase">{{$expediente->ot->codigo}} - {{$expediente->ot->obra}}</p>
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="creador">Area que Rechazó</label>
                <p>{{$penultimo->area->nombre}}</p>
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="creador">Area a la que se envió</label>
                <p>{{$ultimo->area->nombre}}</p>
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="fecha">Fecha creación - Fecha de Rechazo</label>
                <p>{{$expediente->fecha_creacion}} | {{$rechazado->fecha_entrada}}</p>
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-122">
            <div class="form-group">
                <label for="motivo">Motivo de Rechazo</label>
                <p>{{$rechazado->observaciones}}</p>
            </div>
        </div>



        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-122">
            <div class="form-group">
                <label for="referencia">Referencia</label>
                <p>{{$expediente->referencia}}</p>
            </div>
        </div>



        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="notas">Observaciones de Regularización</label>
                <textarea class="form-control" rows="2" id="observaciones_regularizacion" name="observaciones_regularizacion" required></textarea>

            </div>
            <div hidden>
                <input name="redireccion" value="{{$redireccion}}">
            </div>
        </div>


        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
                <br>
                <button class="btn btn-primary" type="submit">enviar</button>
                <button class="btn btn-danger" type="reset" >Cancelar</button>
            </div>
        </div>
        {!!Form::close()!!}
    </div>

@endsection