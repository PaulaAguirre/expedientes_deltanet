@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar OT: {{strtoupper ($ot->nombre)}}</h3>
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
    {!!Form:: model($ot, ['method'=>'PATCH', 'route'=>['ots.update', $ot->id],'files'=>'true'])!!}
    {{Form::token()}}
    <div class="row text-uppercase">

        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <div class="form-group">
                <label>Código</label>
                <input type="text" name="codigo" required value="{{$ot->codigo}}" class="form-control text-uppercase" placeholder="código de la orden de trabajo">
            </div>
        </div>

        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <div class="form-group">
                <label for="obra">Obra</label>
                <input type="obra" name="obra" required value="{{$ot->obra}}" class="form-control text-uppercase" placeholder="nombre de la obra">
            </div>
        </div>

        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <div class="form-group">
                <label for="obra">Referencia</label>
                <input type="referencia" name="referencia" required value="{{$ot->referencia}}" class="form-control text-uppercase" placeholder="nombre de la obra">
            </div>
        </div>


        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
            <div class="form-group">
                <input name="_token" value="{{csrf_token()}}" type="hidden">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
        </div>
    </div>
    {!!Form::close()!!}
@endsection