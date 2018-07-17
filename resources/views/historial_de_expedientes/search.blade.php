{!! Form::open(array('url'=>'historial_de_expedientes','method'=>'GET','autocomplete'=>'on','role'=>'search')) !!}
<div class="form-group">
    <div class="input-group">
        <input type="text" class="form-control" name="searchText" placeholder="Buscar ID, por referencia o por Código de OT..." autocomplete="on" value="{{$searchText}}">
        <span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
    </div>
</div>

{{Form::close()}}