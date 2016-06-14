/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    var URL = 'http://localhost:8080/controlEscolar/index.php/';

    $('.DIRECTORIO_CORREO').click(function () {
        var func = $(this).attr('data-func');
        $('#func').val(func);
        $("#Pcontenido").html('');
        $("#PARAHide").text('');
        $("#CCHide").text('');
        $('#verGrupos').hide();
        $('#tipo').val("0");
    });

    $('#seleccionarEmails').click(function () {
        var func = $("#func").val();
        var correos = $("#" + func + "Hide").text();
        $("#" + func).text(correos);
    });

    $('#tipo').change(function () {
        var tipo = $("#tipo").val();
        if (tipo === "estudiante" || tipo === "padresfam") {
            $('#Egrupo').val("0");
            $('#verGrupos').show();
        } else {
            $('#verGrupos').hide();
        }
    });

    $(".BEmail").click(function () {
        var nombre = $("#BpEmail").val();
        var tipo = $("#tipo").val();
        var func = $("#func").val();
        var grupo = $("#Egrupo").val();

        var request = $.ajax({
            url: URL + "ajax/getCorreos",
            method: "POST",
            data: {nombre: nombre, tipo: tipo, func: func, grupo: grupo},
            dataType: "html"
        });

        request.done(function (msg) {
            $("#Pcontenido").html(msg);
        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
    });

    $("#SeleccionarTodos").click(function () {
        var nombre = $("#BpEmail").val();
        var tipo = $("#tipo").val();
        var func = $("#func").val();
        var grupo = $("#Egrupo").val();

        var request = $.ajax({
            url: URL + "ajax/getCorreosSeleccionarTodos",
            method: "POST",
            data: {nombre: nombre, tipo: tipo, func: func, grupo: grupo},
            dataType: "html"
        });

        request.done(function (msg) {
            $("#" + func).text(msg);
        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + jqXHR);
        });
    });

    /*
     * FUNCION PARA HACER LA BUSQUEDA DE LAS PLANTILLAS
     */
    $("#plantilla").change(function () {
        var IDPlantilla = $(this).val();
        var href = URL + "docente/citatorio/";
        window.location.href = href + IDPlantilla;
    });

});

