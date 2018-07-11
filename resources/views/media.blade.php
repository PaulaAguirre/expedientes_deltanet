@extends ('layouts.admin')
@section ('contenido')
    <form action="/media" enctype="multipart/form-data" method="post">
        {{ csrf_field() }}
        <input type="file" name="file">
        <button type="submit">Upload</button>
    </form>

@endsection
