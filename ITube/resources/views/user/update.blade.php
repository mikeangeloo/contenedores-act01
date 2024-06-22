@extends('nav')
@section('contenido')
        <div class="container">


            {{ Form::model($user, ['url' => route('users.update',$user->id), 'method' => 'PUT', 'enctype'=>'multipart/form-data' ]) }}
            @include('user._form')
            {{ Form::close() }}
            <div class="clearfix"></div>
        </div>
@endsection