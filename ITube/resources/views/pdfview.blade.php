<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Itube PDF</title>

    {!! Html::style('css/styles.css') !!}




</head>

<body>
<style type="text/css">

    table td, table th{

        border:1px solid black;

    }

    pre {
        display: block;
        font-family: monospace;
        white-space: pre;
        margin: 1em 0;
    }

</style>

<div class="container">
    <div class="contenidoimg">
    {{ HTML::image('storage/logoItube.png', 'logoItube', array('class' => 'imgLogo')) }}
    </div>
    <h1>Resumen de Trayectorias</h1>
    <h5 style="text-align: right">Fecha: {{ date("Y-m-d", time())}}</h5>
    <h5 style="text-align: right">PDF generado por: ITube® Plataform</h5>

    <br/>


    <table style="text-align: center">

        <tr>



            <th>Titulo</th>
            <th colspan="3">Descripción</th>

        </tr>



        @foreach ($items as $item)
            <tr>
                <th>Material usado:</th><td colspan="3"> {{$item['use_material']}}</td>
            </tr>
            <tr>

                @if($item['tubename2'] != "undefined")
                    <th>Categoría utilizada:</th><td colspan="3"> {{$item['tubename2']}}</td>
                @endif
                @if($item['tubename'] != "undefined")
                    <th>Categoría utilizada:</th><td colspan="3"> {{$item['tubename']}}</td>
                 @endif
            </tr>
        @if(isset($item['interior']))
            <tr>


                <th>¿Es para mobiliario?:</th><td colspan="3">Si</td>
            </tr>
        @else
            <tr>

                <th>¿Es para mobiliario?:</th><td colspan="3">No</td>
            </tr>
        @endif

        <tr>
            <th>Cantidad de cables usados</th>
            <th>Nombre del cable</th>
            <th>Tipo de cable</th>
            <th>Diametro del cable</th>
        </tr>


        @for($i=0; $i<=count($item['numcables'])-1; $i++)
            <tr>
                <td>{{$item['numcables'][$i]}}</td>
                <td>{{$item['cable'][$i]}}</td>
                <td>{{$item['tipocable'][$i]}}</td>
                <td>{{$item['diameter'][$i]}}mm</td>
            </tr>

        @endfor


        @endforeach

    </table>

        <h4>Resumen del calculo: </h4>
    <pre><p>{{$item['respuestas']}}</p></pre>



</div>
</body>
</html>