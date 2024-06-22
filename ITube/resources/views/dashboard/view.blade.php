
@extends('nav')
@section('contenido')

<div class="container">
    @if(session()->has('status'))
        <p class="alert alert-info">
            {{	session()->get('status') }}
        </p>
    @endif
    <div class="row">



        <div class="col-xs-12 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#proyectos">Mis Proyectos</a></li>
                    <li><a data-toggle="tab" href="#materiales">Mis Materiales</a></li>
                    <li><a data-toggle="tab" href="#Importar">Importar</a></li>
                </ul>

                <div class="tab-content">
                    <div id="proyectos" class="tab-pane fade in active">
                        <div class="panel-body">

                            <table class="table table-bordered">
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre Proyecto</th>
                                    <th>Descripción General</th>
                                    <th>Fecha creación</th>
                                    <th>Opciones</th>
                                </tr>
                                @foreach($projects as $project)
                                    <tr>
                                        <td>{{$project['id']}}</td>
                                        <td>{{$project['name_project']}}</td>
                                        <td>{{$project['general_description']}}</td>
                                        <td>{{$project['created_at']}}</td>
                                        <td>
                                            <a href="{{ route('projects.show',$project['id']) }}"><button class="btn btn-info">Ver</button></a>

                                            <a href="{{ route('projects.edit',$project['id']) }}"><button class="btn btn-warning">Editar</button></a>

                                            <a href="{{url('projects/elimiar/'.$project['id'])}}"><button class="btn btn-danger">Eliminar</button></a>

                                            <a href="{{url('projects/exportarXML/'.$project['id'])}}"><button class="btn btn-primary">Exportar</button></a>

                                            <a href="{{url('projects/exportarXML/'.$project['id'])}}"><button class="btn btn-success">Compartir</button></a>


                                        </td>

                                    </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>
                    <div id="materiales" class="tab-pane fade">
                        <h3>Mis Materiales</h3>
                        <table class="table table-bordered">
                            <tr>
                                <th>Material</th>
                                <th>Cantidad</th>
                                <th>Opciones</th>
                            </tr>
                            <tr>
                                <td>Categoría Tubos</td>
                                <td><?php echo count($tubestypes_id);  ?></td>
                                <td>
                                    <a href="{{route('tubes_types.create')}}"><button class="btn btn-success">Nuevo</button></a>
                                    <a href="{{url('tubes_types')}}"><button class="btn btn-info">Ver</button></a>
                                </td>
                            </tr>

                            <tr>
                                <td>Tubos</td>
                                <td><?php echo count($tubes);  ?></td>
                                <td>
                                    <a href="#"><button class="btn btn-success">Nuevo</button></a>
                                    <a href="#"><button class="btn btn-info">Ver</button></a>
                                </td>
                            </tr>

                            <tr>
                                <td>Cables tipos</td>
                                <td><?php echo count($cabletype_id);  ?></td>
                                <td>
                                    <a href="#"><button class="btn btn-success">Nuevo</button></a>
                                    <a href="#"><button class="btn btn-info">Ver</button></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Cables</td>
                                <td><?php echo count($cable);  ?></td>
                                <td>
                                    <a href="#"><button class="btn btn-success">Nuevo</button></a>
                                    <a href="#"><button class="btn btn-info">Ver</button></a>
                                </td>
                            </tr>

                        </table>

                    </div>
                    <div id="Importar" class="tab-pane fade">

                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

@endsection
