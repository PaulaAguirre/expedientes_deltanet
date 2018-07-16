@extends ('layouts.admin')
@section('contenido')




<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="row text-center">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <img src="{{('/img/logo docfinder 2.png')}}" alt="Lights" style="width: 52%">

        </div>
    </div>


</div>






@endsection
