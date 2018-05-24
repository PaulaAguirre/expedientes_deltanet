@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nuevo Funcionario</h3>
            <br>
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

    {!!Form::open(array('url'=>'funcionarios','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <div class="row">

        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <div class="form-group">
                <label>Seleccionar Funcionario</label>
                <select name="user_id" class="form-control text-uppercase selectpicker" data-live-search="true" title="Seleccione un Funcionario" >
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{strtoupper ($user->name)}} {{strtoupper ($user->lastname)}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <div class="form-group">
                <label>Asignar Departamento</label>
                <select name="departamento_id" class="form-control text-uppercase selectpicker" data-live-search="true" title="Seleccione un Departamento" >
                    @foreach($areas as $area)
                        <option value="{{$area->id}}">{{strtoupper ($area->nombre)}}</option>
                    @endforeach
                </select>
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