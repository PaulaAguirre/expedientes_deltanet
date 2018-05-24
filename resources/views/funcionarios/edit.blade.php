@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Departamento Asignado al funcionario</h3>
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
    {!!Form:: model($funcionario, ['method'=>'PATCH', 'route'=>['funcionarios.update', $funcionario->id],'files'=>'true'])!!}
    {{Form::token()}}
    <div class="row">
        <br>
        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 text-uppercase">
            <div class="form-group">
                <label for="nombre">Nombre del funcionario:</label>
                <p class="text-uppercase text-green ">{{$funcionario->user->name}} {{$funcionario->user->lastname}}</p>
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label>Departamento</label>
                <select name="departamento_id" class="form-control text-uppercase selectpicker" title="Seleccione un responsable" data-live-search="true">
                    @foreach($departamentos as $departamento)
                        @if ($funcionario->departamento_id==$departamento->id)
                            <option value="{{$departamento->id}}" selected>{{strtoupper ($departamento->nombre)}}</option>
                        @else
                            <option value="{{$departamento->id}}">{{strtoupper ($departamento->nombre)}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
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