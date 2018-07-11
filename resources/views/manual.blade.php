@extends ('layouts.admin')
@section ('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-bold" style="background-color: #6b9dbb">Manual de Usuario</div>

                    <div class="panel-body text-center">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="text-bold">Link de Visualización</div>
                            <br>
                            <br>
                        <div>
                            <a href="{{url ('uploads/manual usu docf.pdf')}}"><button class="btn btn-toolbar btn-lg">Ver PDF...<i class="fa fa-file-pdf-o" aria-hidden="true"></i></button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
