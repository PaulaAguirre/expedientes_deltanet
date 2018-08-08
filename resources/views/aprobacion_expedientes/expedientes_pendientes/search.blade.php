{!! Form::open(array('url'=>'aprobacion_expedientes/expedientes_pendientes','method'=>'GET','autocomplete'=>'on','role'=>'search')) !!}
<div class="form-group">
    <div class="input-group">
        <input type="text" class="form-control" name="searchText" placeholder="Buscar ID, por referencia, por Código de OT o memo..." autocomplete="on" value="{{$searchText}}">
        <span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
    </div>
</div>

{{Form::close()}}