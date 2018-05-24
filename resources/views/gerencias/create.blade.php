@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nueva Gerencia</h3>
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

    {!!Form::open(array('url'=>'gerencias','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <div class="row">
        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <div class="form-group">
                <label for="nombre">Nombre de la Gerencia</label>
                <input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control text-uppercase" placeholder="Nombre">
            </div>
        </div>

        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <div class="form-group">
                <label for="descripcion">Descripción de la gerencia</label>
                <input type="text" name="descripcion" required value="{{old('descripcion')}}" class="form-control text-uppercase" placeholder="Descripción">
            </div>
        </div>

        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <div class="form-group">
                <label>Responsable de la Gerencia</label>
                <select name="user_id" class="form-control text-uppercase selectpicker" title="Seleccione un responsable" data-live-search="true" >
                    @foreach($gerentes as $gerente)
                        <option value="{{$gerente->id}}">{{$gerente->name}} {{$gerente->lastname}}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 text-center" id="guardar">
            <div class="form-group">
                <input name="_token" value="{{csrf_token()}}" type="hidden">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
        </div>
    </div>
    {!!Form::close()!!}

@endsection