/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    var url = "http://localhost:8080/controlEscolar/index.php/";

    $(".CatDireccion").click(function () {
        var cattipo = $(this).attr('data-table');

        var request = $.ajax({
            url: url + "ajax/getCatTipo",
            method: "POST",
            data: {cattipo: cattipo},
            dataType: "html"
        });

        request.done(function (msg) {
            $("#contenido").html(msg);
        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
    });

    $(".Bpais").click(function () {
        var nombre = $("#BpPais").val();
        $("#BpPais").val('');

        var request = $.ajax({
            url: url + "ajax/getPais",
            method: "POST",
            data: {nombre: nombre},
            dataType: "html"
        });

        request.done(function (msg) {
            $("#Pcontenido").html(msg);
        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
    });

    $(".Bestado").click(function () {
        var nombre = $("#BpEstado").val();
        $("#BpEstado").val('');
        var idPais = $('#idPais').val();

        var request = $.ajax({
            url: url + "ajax/getEstado",
            method: "POST",
            data: {nombre: nombre, idPais: idPais},
            dataType: "html"
        });

        request.done(function (msg) {
            $("#Econtenido").html(msg);
        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
    });

    $(".BcodpostForm").click(function () {
        var nombre = $("#nomcodpost").val();
        var tmp = parseInt(nombre,10);
        
        $("#BpCodPost").val(tmp.toString());
        Buscar_Cod_Postal(tmp.toString());
    });

    $(".Bcodpost").click(function () {
        var nombre = $("#BpCodPost").val();
        var tmp = parseInt(nombre,10);
        
        $("#BpCodPost").val(tmp.toString());
        Buscar_Cod_Postal(tmp.toString());
    });

    $("#Ecurp").change(function () {
        var curp = $("#Ecurp").val();
        var matricula = curp.substring(0,9);
        $("#Ematricula").val(matricula);
    });

    function Buscar_Cod_Postal(nombre) {
        var idPais = $('#idPais').val();
        var idEdo = $('#idEdo').val();

        var request = $.ajax({
            url: url + "ajax/getCodPost",
            method: "POST",
            data: {nombre: nombre, idPais: idPais, idEdo: idEdo},
            dataType: "html"
        });

        request.done(function (msg) {
            $("#CPcontenido").html('');
            $("#CPcontenido").html(msg);
        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
    }

});