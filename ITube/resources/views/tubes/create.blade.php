@extends('nav')
@section('contenido')

<div class="container">
	<div class="col-sm-12 col-lg-6 panel panel-default">

        <h2>Nuevo tubo</h2>

        <form action="/ITube/public/tube" method="post">
            @include('tubes._form')
            {{ csrf_field() }}

        </form>

    </div>

</div>


@endsection
