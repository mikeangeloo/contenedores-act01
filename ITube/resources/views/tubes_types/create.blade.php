@extends('nav')
@section('contenido')

<div class="container">
	<div class="col-sm-12 col-lg-6 panel panel-default">

        <h2>Nueva categoría tubo</h2>
        <form action="/ITube/public/tubes_types" method="post">
            @include('tubes_types._form')
            {{ csrf_field() }}

        </form>
    </div>

</div>


@endsection
