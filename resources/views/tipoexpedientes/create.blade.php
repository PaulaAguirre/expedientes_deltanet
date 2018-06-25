@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nuevo Tipo de Expediente</h3>
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

    {!!Form::open(array('url'=>'tipoexpedientes','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control text-uppercase" placeholder="Nombre del tipo de Expediente..">
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <input type="text" name="descripcion" required value="{{old('descripcion')}}" class="form-control text-uppercase" placeholder="Descripción del Expediente..">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-body" style="background-color: #d2d6de">
                <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 text-center">
                    <div class="form-group">
                        <label>Agregar ruta del expediente</label>
                        <select name="pidarea" class="form-control selectpicker text-uppercase" id="pidarea" title="Seleccione una Gerencia/Dpto" data-live-search="true">
                            @foreach($areas as $area)
                                <option value="{{$area->id}}">{{strtoupper ($area->nombre)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                    <br>
                    <div class="form-group">
                        <button type="button" id="bt_add" class="btn btn-primary">Agregar Ruta</button>
                    </div>
                </div>

                <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color: #8eb4cb">
                        <th>Opciones</th>
                        <th>Nombre</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
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

    @push('scripts')
        <script>
            $(document).ready(function(){
                $('#bt_add').click(function () {
                    agregar();
                })
            })
            var cont = 0;
            $("#guardar").hide();
            function agregar() {
                idarea = $("#pidarea").val();
                area = $("#pidarea option:selected").text();
                if(idarea!=""){
                    var fila = '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarea[]" value="'+idarea+'">'+area+'</td></tr>'
                    cont++;
                    $('#detalles').append(fila);
                    $('#guardar').show();
                }
                else{
                    $("#guardar").hide();
                    alert("Error al agregar un area");
                }
            }
            function eliminar(index) {
                $("#fila"+index).remove();
            }
        </script>
    @endpush
@endsection