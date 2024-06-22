<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    {!! Html::style('css/bootstrap.min.css') !!}
    {!! Html::style('css/bootstrap.paper.min.css') !!}
    {!! Html::style('css/styles.css') !!}



    {!! Html::script('js/jquery.min.js') !!}
    {!! Html::script('bootstrap/js/bootstrap.min.js') !!}
    {!! Html::script('js/ajaxCalls.js') !!}


</head>
<nav class="navbar navbar-inverse navbar-global ">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" style="color:white;" href="{{url('/')}}">ITube</a>
        </div>
        @if (Route::has('login'))
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">


                @auth

                    <ul class="nav navbar-nav">
                        <li class="active"><a href="{{url('/')}}"><span class="glyphicon glyphicon-home"></span> Inicio </a></li>
                        <li><a href="{{url('/')}}">
                                <span class="glyphicon glyphicon-upload"></span> Crear proyecto</a></li>
                        <li><a href="{{url('/dashboard/view')}}">
                                <span class="glyphicon glyphicon-book"></span> Dashboard</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <div class="avatar">
                                    {!! Html::image("uploads/usersprofile/{$user->image}",'userimg') !!}
                                </div>
                                    {{ Auth::user()->name }} <span class="caret"></span></a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{route('users.show',$user->id)}}">
                                        <span class="glyphicon glyphicon-edit"></span> Ver Perfil</a></li>

                                <li class="divider"></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        <span class="glyphicon glyphicon-log-out"></span>Salir
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>

                    </ul>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    <span class="glyphicon glyphicon-log-out"></span>Salir
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#">
                                <span class="glyphicon glyphicon-upload"></span> Crear proyecto</a>
                        </li>
                        <li>
                            <a href="{{route('login')}}">
                                <span class="glyphicon glyphicon-log-in"></span>
                                Entrar
                            </a>
                        </li>
                        <li>
                            <a href="{{route('register')}}">
                                <span class="glyphicon glyphicon-user"></span>
                                Crear cuenta
                            </a>
                        </li>
                        @endauth
                </ul>
            </div>
        @endif


    </div>
</nav>
<header>

</header>
@yield('contenido')