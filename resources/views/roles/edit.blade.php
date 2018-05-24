@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Role: {{strtoupper ($role->nombre)}}</h3>
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
    {!!Form:: model($role, ['method'=>'PATCH', 'route'=>['roles.update', $role->id],'files'=>'true'])!!}
    {{Form::token()}}
    <div class="row">

        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <div class="form-group">
                <label for="nombre">Nombre del Rol</label>
                <input type="text" name="nombre" required value="{{$role->nombre}}" class="form-control text-uppercase" placeholder="Nombre del Rol">
            </div>
        </div>

        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <div class="form-group">
                <label for="descripcion">Descripción del Rol</label>
                <input type="text" name="descripcion" required value="{{$role->descripcion}}" class="form-control text-uppercase" placeholder="Descripcion del Rol">
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