@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar USUARIO: {{strtoupper ($user->name)}} {{strtoupper ($user->lastname)}}</h3>

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
    {!!Form:: model($user, ['method'=>'PATCH', 'route'=>['users.update', $user->id], 'enctype'=>'multipart/form-data'])!!}
    {{Form::token()}}
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" required value="{{$user->name}}" class="form-control text-uppercase" placeholder="Nombre..">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="lastname">Apellido</label>
                <input type="text" id="pidlastname" name="lastname" required value="{{$user->lastname}}" class="form-control text-uppercase" placeholder="Apellido..">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="cedula">Cedula</label>
                <input type="text" name="cedula"  value="{{$user->cedula}}" class="form-control text-uppercase" placeholder="número de cedula..">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="phone">Telefono</label>
                <input type="text" name="phone"  value="{{$user->phone}}" class="form-control text-uppercase" placeholder="Telefono...">
            </div>
        </div>


        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="mobile">Celular</label>
                <input type="text" name="mobile"  value="{{$user->mobile}}" class="form-control text-uppercase" placeholder="Celular...">
            </div>
        </div>


        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email"  value="{{$user->email}}" class="form-control" placeholder="email@example.com">
            </div>
        </div>

        @if(in_array (auth ()->user ()->role_id, [1,2] ))
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label>Role</label>
                <select name="role_id" class="form-control text-uppercase">
                    @foreach($roles as $role)
                        @if ($role->id==$user->role->id)
                            <option value="{{$role->id}}" selected>{{$role->nombre}}</option>
                        @else
                            <option value="{{$role->id}}">{{$role->nombre}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        @endif

        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <div class="form-group">
                <input id="pidrol" name="pidrol" value="{{Auth::user ()->role_id}}" type="hidden">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
        </div>
    </div>
    {!!Form::close()!!}

@push('scripts')
    <script>

        $(document).ready(function () {
            idrol = $("#pidrol").val();
            //alert('el id rol es '+idrol)
           verificar_user(idrol);

        });

        function verificar_user( idrol ) {
            if (idrol == 1 || idrol == 2){
                document.getElementById("name").disabled = false;
            }
            else {
                document.getElementById("name").disabled = false;


            }
        }
    </script>

@endpush

@endsection