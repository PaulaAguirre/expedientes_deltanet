@extends ('layouts.admin')
@section('contenido')




<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <br>
    <br>
    <br>
    <div class="row text-center">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <img src="{{('img/tranquility (3).png')}}" alt="Lights" style="width: 80%">

        </div>
    </div>


</div>






@endsection
