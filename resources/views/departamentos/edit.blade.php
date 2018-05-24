@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Departamento: {{$departamento->nombre}}</h3>
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
    {!!Form:: model($departamento, ['method'=>'PATCH', 'route'=>['departamentos.update', $departamento->id],'files'=>'true'])!!}
    {{Form::token()}}
    <div class="row">

        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <div class="form-group">
                <label for="nombre">Nombre del departamento</label>
                <input type="text" name="nombre" required value="{{$departamento->nombre}}" class="form-control text-uppercase" placeholder="Nombre">
            </div>
        </div>

        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <div class="form-group">
                <label for="descripcion">Descripción del departamento</label>
                <input type="text" name="descripcion" required value="{{$departamento->descripcion}}" class="form-control text-uppercase" placeholder="Descripción">
            </div>
        </div>

        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <div class="form-group">
                <label>Responsable del departamento</label>
                <select name="user_id" class="form-control text-uppercase selectpicker" title="Seleccione un responsable" data-live-search="true">
                    @foreach($jefes as $jefe)
                        @if ($departamento->user_id==$jefe->id)
                            <option value="{{$jefe->id}}" selected>{{strtoupper ($jefe->name)}} {{strtoupper ($jefe->lastname)}}</option>
                        @else
                            <option value="{{$jefe->id}}">{{strtoupper ($jefe->name)}} {{strtoupper ($jefe->lastname)}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <div class="form-group">
                <label>Gerencia Correspondiente</label>
                <select name="dependencia_id"class="form-control text-uppercase selectpicker" title="Seleccione un responsable" data-live-search="true">
                    @foreach($gerencias as $gerencia)
                        @if ($departamento->dependencia_id==$gerencia->id)
                            <option value="{{$gerencia->id}}" selected>{{strtoupper ($gerencia->nombre)}}</option>
                        @else
                            <option value="{{$gerencia->id}}">{{strtoupper ($gerencia->nombre)}}</option>
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