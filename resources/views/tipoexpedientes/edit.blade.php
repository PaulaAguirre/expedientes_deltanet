@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Contacto: {{$contacto->nombre}} {{$contacto->apellido}}</h3>
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
    {!!Form:: model($contacto, ['method'=>'PATCH', 'route'=>['contactos.update', $contacto->id],'files'=>'true'])!!}
    {{Form::token()}}
    <div class="row">

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" required value="{{$contacto->nombre}}" class="form-control" placeholder="Nombre...">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="apellido">apellido</label>
                <input type="text" name="apellido" required value="{{$contacto->apellido}}" class="form-control" placeholder="Apellido...">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="telefono">telefono</label>
                <input type="text" name="telefono"  value="{{$contacto->telefono}}" class="form-control" placeholder="telefono...">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="celular">celular</label>
                <input type="text" name="celular"  value="{{$contacto->celular}}" class="form-control" placeholder="celular...">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email"  value="{{$contacto->email}}" class="form-control" placeholder="email@example.com">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="email">cargo</label>
                <input type="cargo" name="cargo"  value="{{$contacto->cargo}}" class="form-control" placeholder="cargo o relación...">
            </div>
        </div>


        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
        </div>
    </div>
    {!!Form::close()!!}
@endsection