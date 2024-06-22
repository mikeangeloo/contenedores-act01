@extends('nav')
@section('contenido')

    <div class="container">
        <div class="col-sm-12 col-lg-6 ">

            <h2>Editar Categoría Tubo</h2>
            {{ Form::model($_tube_type, ['url' => route('tubes_types.update',$_tube_type->id), 'method' => 'PUT', 'class'=>'form-control']) }}
                @include('tubes_types._form')
                {{ csrf_field() }}

            {{ Form::close() }}


        </div>

    </div>


@endsection