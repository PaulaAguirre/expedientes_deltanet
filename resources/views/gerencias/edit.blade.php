@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Gerencia: {{strtoupper ($gerencia->nombre)}}</h3>
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
    {!!Form:: model($gerencia, ['method'=>'PATCH', 'route'=>['gerencias.update', $gerencia->id],'files'=>'true'])!!}
    {{Form::token()}}
    <div class="row">

        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <div class="form-group">
                <label for="nombre">Nombre de la Gerencia</label>
                <input type="text" name="nombre" required value="{{$gerencia->nombre}}" class="form-control text-uppercase" placeholder="Nombre">
            </div>
        </div>

        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <div class="form-group">
                <label for="descripcion">Descripción de la gerencia</label>
                <input type="text" name="descripcion" required value="{{$gerencia->descripcion}}" class="form-control text-uppercase" placeholder="Descripción">
            </div>
        </div>

        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <div class="form-group">
                <label>Responsable de la Gerencia</label>
                <select name="user_id" id="user_id" class="form-control text-uppercase selectpicker" title="Seleccione un responsable" data-live-search="true">
                    @foreach($gerentes as $gerente)
                        @if ($gerente->id==$gerencia->user->id)
                            <option value="{{$gerente->id}}" selected>{{strtoupper ($gerente->name)}} {{strtoupper ($gerente->lastname)}}</option>
                        @else
                            <option value="{{$gerente->id}}">{{strtoupper ($gerente->name)}} {{strtoupper ($gerente->lastname)}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>


        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
        </div>
    </div>
    {!!Form::close()!!}
@endsection