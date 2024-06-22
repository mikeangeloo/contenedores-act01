/**
 * Created by Mike on 22/10/2017.
 */

$(document).ready(function() {

    $("#cable_diameter").val("");

    $.ajax({
        url: "/ITube/public/cables_types",
        dataType: "html",
        success: function (msg) {
            $("select[name='cable_type']").html(msg);

        }
    });

    $("select[name='material']").change(function () {
        var materialval = $(this);
        var material = materialval.find(':selected').data('material');




        if(material === "Tubos"){
            $.ajax({

                url: "/ITube/public/tube_types",

                dataType: "html",
                success: function (msg) {
                    $("#selected_material").html(msg);
                    $("#use_material").val(material);
                }
            });
        }else{
            $("#selected_material").empty();
            $("#material_type").empty();
            $("#use_material").val("");
        }


    });



    $("select[name='selected_material']").change(function () {
        var material = $(this);
        var materialdescripcion = material.find(':selected').data('tubename');
        $("#material_description").val(materialdescripcion);

    });

    $('select[name="cable_type"]').change(function () {
        var cable_type_id = $(this).val();
        console.log($("#cable_type"));
        $.ajax({
            url: '/ITube/public/cables/'+cable_type_id,
            dataType: "html",
            success: function (msg) {
                $('select[name="cable_id"]').html(msg);

            }
        });

    });

    $("select[name='cable_id']").change(function () {
        var cable_id = $(this).val();
        $.ajax({
            url: '/ITube/public/cablesdiameter/'+cable_id,
            dataType: "json",
            success: function (msg) {

                console.log(msg);
                $('input[name="cable_diameter"]').val(msg[0].external_diameter);


            }
        });

    });

    $("#calcular").on('click',function(){
        var datos = $('#formulario').serialize();
        console.log(datos);
        $.ajax({
            type: "POST",
            url: "/ITube/public/calcular",
            data: datos,
            dataType: "html",
            success: function( msg ) {
                console.log(msg);
                $("#resultados").html(msg);


            }
        });
    });



    //$("#pdf").on('click',function(){
    //    $("#formulario").submit();
    //
    //
    //});

    $("#pdf").on('click',function(){

        var materialval = $("#selected_material");
        var material = materialval.find(':selected').data('tubename');

        var materialval2 = $("#selected_material2");
        var material2 = materialval2.data('tubename2');

        var cable = $("#cable_type");
        var cablenametype = cable.find(':selected').data('cablename_type');

        var cablen = $("#cable_id");
        var cablename = cablen.find(':selected').data('cablename');

            $("#formulario").append('<input type="hidden" name="tubename" value="'+material+'">');
            $("#formulario").append('<input type="hidden" name="tubename2" value="'+material2+'">');
            $("#formulario").append('<input type="hidden" name="cablename_type" value="'+cablenametype+'">');
            $("#formulario").append('<input type="hidden" name="cablename" value="'+cablename+'">');



        $("#formulario").submit();


    });

    $("#agregar").on('click',function(){

        var numcables = $("#cables_amount").val();
        var cable_type_id = $("#cable_type");
        var cable_type = cable_type_id.find(':selected').data('cablename_type');
        var cable_id = $("#cable_id");
        var cable = cable_id.find(':selected').data('cablename');
        var diameter = $("#cable_diameter").val();

        var area_cables = parseFloat(Math.PI*Math.pow((diameter/2),2)).toFixed(3);

        var totalareaCables = (area_cables)*(numcables);


        var tabla ='<tr>';
        tabla +="<td>"
                    +"<input name='numcables[]' readonly class='form-control' value='"+numcables+"'>"
                +"</td>"
                +"<td>"
                    +"<input name='tipocable[]' class='form-control' readonly value='"+cable_type+"'>"
                +"</td>"
                +"<td>"
                    +"<input name='cable[]' class='form-control' readonly value='"+cable+"'>"
                +"</td>"
                +"<td>"
                    +"<input name='diameter[]' class='form-control' readonly value='"+diameter+"'>"
                +"</td>"
                +"<td>"
                    +"<p>"+totalareaCables+"mm<sup>2</sup></p></td>"
                +"<td>"
                    +"<button type='button' class='btn btn-warning borrar'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button>"
                +"</td>";
        tabla +='</tr>';
        $("#resumen").append(tabla);

    });

    $(function () {
        $(document).on('click', '.borrar', function (event) {
            event.preventDefault();
            $(this).closest('tr').remove();

        });
    });

    $("#guardar").on('click',function(){

       var datos = $("#formulario").serialize();
        $.ajax({
           type: "POST",
            url: "/ITube/public/projects",
            data: datos,
            success: function(data){
                console.log(data);
                window.location.href = "/ITube/public";
            }
        });





    });




});
