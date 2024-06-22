@extends('nav')
@section('contenido')

<body xmlns="http://www.w3.org/1999/html">
<div class="form-group row">
    <div class="container">
        @if(session()->has('status'))
            <p class="alert alert-info">
                {{	session()->get('status') }}
            </p>
        @endif
            <?php
                SESSION_START();
            if(isset($_SESSION['mensaje'])){
                $mensaje = $_SESSION['mensaje'];
                SESSION_DESTROY();
                echo "<p class='alert alert-info'>".$mensaje."</p>";
            }
            if(isset($_SESSION['error'])){
                $mensaje = $_SESSION['error'];
                SESSION_DESTROY();
                echo "<p class='alert alert-danger'>".$mensaje."</p>";
            }

            ?>
            <div class="col-sm-12 col-xs-12">
                <h2>Calcular Trayectorias</h2>
                <hr class="conjunto">

            </div>

        {{--<form class="" name="formulario" id="formulario" action="projects" method="POST">--}}
        <form class="" name="formulario" id="formulario" action="pdfview" method="POST" target="_blank">


            {{ csrf_field() }}
            {{--<input type="submit" value="Probar">--}}
            <div class="col-sm-12 col-xs-12">

                <div class="col-sm-12 col-xs-12">
                    <label for="nombreproyecto">Nombre de proyecto:</label>
                    <input type="text" name="nombreproyecto" id="nombreproyecto">

                </div>
                <div class="col-sm-12 col-xs-12">
                    <br>
                    <label for="descripcionproyecto">Descripción:</label>
                    <input type="text" name="descripcionproyecto" id="descripcionproyecto">
                    <hr class="conjunto3">
                </div>

                <div class="col-xs-12 col-sm-3">

                    <label for="material">Material a utilizar:</label>
                    <select class="form-control" name="material" id="material">
                        <option value="0" data-material="default">---</option>
                        <option value="1" data-material="Tubos">Tubos</option>
                        <option value="2,charolas">Charolas</option>
                        <option value="3,canaletas">Canaletas</option>
                    </select>
                </div>
                <div class="col-xs-12 col-sm-3" name="ajaxSelect" id="ajaxSelect">

                    <label for="selected_material">Categoría</label>
                    <select class="form-control" name="selected_material" id="selected_material">

                    </select>
                </div>
                {{--<div class="col-xs-12 col-sm-3">--}}
                    {{--<label for="tipo">Tipo:</label>--}}
                    {{--<select class="form-control" name="material_type" id="material_type">--}}

                    {{--</select>--}}
                {{--</div>--}}
                <div class="col-xs-12 col-sm-3">

                    <label for="interior">¿Es Mobiliario? Si:</label>
                    <input type="checkbox" name="interior" id="interior">
                </div>

            </div>

            <div class="col-sm-12 col-xs-12">
                <hr class="conjunto2">
                <div class="col-xs-12 col-sm-12">

                    <button class="btn btn-success" name="agregar" id="agregar" type="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>

                </div>
                <br>

                <div class="col-xs-12 col-sm-3">
                    <label for="cables_amount">Número de Cables:</label>
                    <input type="number" class="form-control" id="cables_amount" name="cables_amount" value="1" min="1">
                </div>

                <div class="col-xs-12 col-sm-3">
                    <label for="cable_type">Tipo de cable:</label>
                    <select class="form-control" name="cable_type" id="cable_type">

                    </select>
                </div>
                <div class="col-xs-12 col-sm-3">
                    <label for="cable_id">Cable:</label>
                    <select class="form-control" name="cable_id" id="cable_id">

                    </select>
                </div>

                <div class="col-xs-12 col-sm-3">
                    <label for="cable_diameter">Diametro exterior (mm):</label>
                    <input class="form-control" name="cable_diameter" id="cable_diameter">
                </div>


                <div class="col-sm-12">

                    <h3>Resumen de cables </h3>
                    <button class="btn btn-info text-right" type="button" name="calcular" id="calcular"><span class="glyphicon glyphicon-console" aria-hidden="true"></span>Calcular</button>
                    <button class="btn btn-success" type="button" name="guardar" id="guardar"><span class="glyphicon glyphicon-save-file" aria-hidden="true"></span>Guardar</button>
                    <button class="btn btn-warning" role="button" id="pdf" name="pdf">
                        <span class="glyphicon glyphicon-save" aria-hidden="true"></span>
                        Exportar PDF</button>
                    <hr class="conjunto">
                    <table name="resumen" id="resumen" class="table table-bordered">
                        <th>Número de Cables</th>
                        <th>Tipo Cable</th>
                        <th>Cable</th>
                        <th>Diametro exterior</th>
                        <th>Área Total</th>
                        <th>Opción</th>
                    </table>
                </div>


                <input type="hidden" name="use_material" id="use_material">
                <input type="hidden" name="material_description" id="material_description">
                @if (Route::has('login'))
                    @auth
                        <input type="hidden" name="usuario" id="usuario" value="{{$user->id}}">
                    @else

                       <input type="hidden" name="usuario" id="usuario" value="1">
                    @endauth
                @endif
                <div class="col-xs-12 col-sm-12" name="resultados" id="resultados">
                    <br>
                    <h3>Resultados: </h3>

                </div>
            </div>
        </form>



    </div>
</div>
@endsection

</body>

</html>

