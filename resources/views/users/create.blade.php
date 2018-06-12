@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nuevo Usuario</h3>
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

    {!!Form::open(array('url'=>'users','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <div class="row text-uppercase">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" required value="{{old('name')}}" class="form-control text-uppercase" placeholder="Nombre..">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="lastname">Apellido</label>
                <input type="text" name="lastname" required value="{{old('lastname')}}" class="form-control text-uppercase" placeholder="Apellido..">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="cedula">Cedula</label>
                <input type="text" name="cedula"  value="{{old('cedula')}}" class="form-control text-uppercase" placeholder="número de cedula..">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="phone">Telefono</label>
                <input type="text" name="phone"  value="{{old('phone')}}" class="form-control text-uppercase" placeholder="Telefono...">
            </div>
        </div>


        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="mobile">Celular</label>
                <input type="text" name="mobile" required value="{{old('mobile')}}" class="form-control text-uppercase" placeholder="Celular...">
            </div>
        </div>


        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email"  value="{{old('email')}}" class="form-control" placeholder="email@example.com">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label>Desea asignar el usuario a un area ?</label>
                <div class="form-group">
                    <label class="radio-inline">
                        <input type="radio" id="radio_button" name="radio_button" value="si" onclick="mostrar_departamentos()" >si
                    </label>

                    <label class="radio-inline">
                        <input type="radio" id="radio_button" name="radio_button" value="no" onclick="cerrar_departamentos()" checked>no
                    </label>
                </div>
            </div>
        </div>


        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group" style="display:none" id="departamentos">
                <label>Seleccione un Departamento</label>
                <select name="departamento_id" id="departamento_id" class="form-control text-uppercase selectpicker" data-live-search="true" title="Seleccione un Departamento" >
                    @foreach($departamentos  as $departamento)
                        <option value="{{$departamento->id}}">{{strtoupper ($departamento->nombre)}}</option>
                    @endforeach
                </select>

            </div>
        </div>



        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 text-center">
            <div class="form-group">
                <br>
                <br>
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
        </div>
    </div>

    {!! Form::close () !!}

    @push('scripts')
        <script>

            function mostrar_departamentos() {
                departamentos = document.getElementById('departamentos');
                departamentos.style.display = '';
                $("#departamento_id").prop('required', true);

            }

            function cerrar_departamentos() {
                departamentos = document.getElementById('departamentos');
                departamentos.style.display = 'none';
                $("#departamento_id").removeAttr('required');
            }


        </script>
    @endpush

@endsection
