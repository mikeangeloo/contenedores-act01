<body xmlns="http://www.w3.org/1999/html">
@extends('nav')
@section('contenido')
<div class="container">
    <div class="row">
        <div class="panel panel-default col-sm-12">
            <h3>Listado de Categorías Tubos</h3>
            <a href="{{ route('tubes_types.create') }}"><button class="btn btn-success">Nueva categoría</button>
                <hr class="conjunto">

            <table class="table table-bordered" style="border: double; text-align: center;">

                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Fecha de creación</th>
                    <th colspan="2">Opciones</th>
                </tr>

                @foreach($_tubes_types as $tipotubo)
                    <tr>
                        <td>{{$tipotubo->name}}</td>
                        <td>{{$tipotubo->general_description}}</td>
                        <td>{{$tipotubo->created_at}}</td>
                        <td><a href="{{ route('tubes_types.edit',$tipotubo->id) }}"><button class="btn btn-warning">Editar</button></a></td>
                        <td>
                            <form action="{{route('tubes_types.destroy',$tipotubo->id)}}" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <button class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </table>

        </div>
    </div>
</div>
@endsection
</body>


