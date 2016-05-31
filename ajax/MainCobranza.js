/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    var URL = 'http://localhost:8080/controlEscolar/index.php/';
    var IVA_GLOBAL = 16;
    var Cuenta;
    var IDEstudiante;
    var IDTutor;
    var FRECPAGO;

//PARA REALIZAR LA SUMA Y GUARDADO DEL PAGO DE LOS SERVICIOS    
    $('.PAGARSERV').click(function () {

        var MODO = $(this).attr('data-mood');
        var IDExp = $(this).attr('data-ID');
        var IDUser = $(this).attr('data-User');
        var descuento = $(this).attr('data-Descuento');
        var FrecPago = $(this).attr('data-FrecPago');
        FRECPAGO = FrecPago;
        $('#descuento').attr('data-por-desc', descuento);
        $('#Parcialidad').text('Parcialidad \u0020' + FrecPago + ' de pagó.');

        ServicioContratado(IDExp, IDUser, descuento, FrecPago);

        if (MODO == 'create') {
            $('#PSguardar').attr('data-save-ID', IDExp);
        }
    });

    $('#PSguardar').click(function () {
        var IDExp = $(this).attr('data-save-ID');
        var servicios = "";

        var reinscripcion = new Reinscripcion(URL, IDExp);
        reinscripcion.init();
        $('#listado_servicios input[type=checkbox]').each(function () {
            if (this.checked) {
                servicios += $(this).val() + ',';
            }
        });
        reinscripcion.setServicios(servicios.slice(0, -1));
        CRUD_Reinscripcion('create', reinscripcion);

    });

    function CRUD_Reinscripcion(MODO, reinscripcion) {

        var correcto = "<div class='alert alert-success alert-dismissible' role='alert' style='box-shadow: 5px 5px 7px #888888;'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Exito!</strong> El Pagó se realizo.</div>";
        var error_enc = "<div class='alert alert-danger alert-dismissible' role='alert' style='box-shadow: 5px 5px 7px #888888;'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Error!</strong>";
        var error_pie = "</div>";

        var descuento = $('#descuento').text();
        var total = $('#total_a_apagar').text();
        var subtotal = total - IVA(total);

        var request = $.ajax({
            url: URL + 'ajax/pago_servicios/' + MODO,
            method: 'POST',
            data: {IDExp: reinscripcion.instancia,
                Egrupo: reinscripcion.grupo,
                REservicio: reinscripcion.servicios,
                Descuento: descuento,
                SubTotal: subtotal,
                Total: total,
                DescBaja: reinscripcion.observaciones},
            dataType: 'html'
        });

        request.done(function (msg) {
            //alert(msg);
            if (msg === 'OK') {
                $('#resp-reinsc').html(correcto);
                $('#PSsalir').show();
                $('#PSrecibo').show();
                $('#PScancelar').hide();
                $('#PSguardar').hide();
            } else {
                $('#resp-reinsc').html(msg);
            }

        });

        request.fail(function (jqXHR, textStatus) {
            alert('FALLO AL GUARDAR EL PAGO: ' + jqXHR);
        });
    }

    $('#PSsalir').click(function () {
        location.reload();
    });

//FUNCIONES PARA DETERMINAR Y DEFINIR EL TIPO DE FRECUENCIA CON LA QUE SE REALIZARAN
//LOS PAGOS DE LOS SERVICIOS
    $('#frecpago').change(function () {
        var modo = $(this).val();

        $('#FP_diasemanal').hide();
        $('#FP_diahabil').hide();

        switch (modo) {
            case 'SEMANAL':
                $('#FP_diasemanal').show();
                $('#FP_diahabil').hide();
                $('#desc_quincenal').hide();
                break;
            case 'QUINCENAL':
                $('#FP_diasemanal').hide();
                $('#FP_diahabil').hide();
                $('#desc_quincenal').show();
                break;
            case 'MENSUAL':
                $('#FP_diasemanal').hide();
                $('#FP_diahabil').show();
                $('#desc_quincenal').hide();
                break;
        }
    });

    $('.FORMAPAGO').click(function () {
        $('#FPcancelar').show();
        $('#FPguardar').show();
        $('#FPsalir').hide();
        Cuenta = $(this).attr('data-Cuenta');
        IDEstudiante = $(this).attr('data-IDEstudiante');
        IDTutor = $(this).attr('data-IDTutor');
        var FrecPago = $(this).attr('data-FrecPago');
        var Dia = $(this).attr('data-Dia');
        var IDExp = $(this).attr('data-ID');
        $('#FP-IDExp').val(IDExp);

        //LIMPIAR COMBOS DE FORMA DE PAGO       
        $('#resp-FP').hide();
        $('#frecpago').val($('#frecpago > option:first').val());
        $('#diasemanal').val($('#diasemanal > option:first').val());
        $('#diahabil').val($('#diahabil > option:first').val());
        $('#FP_diasemanal').hide();
        $('#FP_diahabil').hide();
        $('#desc_quincenal').hide();

        switch (FrecPago) {
            case 'SEMANAL':
                $('#FP_diasemanal').show();
                $('#FP_diahabil').hide();
                $('#frecpago > option[value="' + FrecPago + '"]').prop('selected', true);
                $('#diasemanal > option[value="' + Dia + '"]').prop('selected', true);
                $('#desc_quincenal').hide();
                break;
            case 'QUINCENAL':
                $('#frecpago > option[value="' + FrecPago + '"]').prop('selected', true);
                $('#FP_diasemanal').hide();
                $('#FP_diahabil').hide();
                $('#desc_quincenal').show();
                break;
            case 'MENSUAL':
                $('#FP_diasemanal').hide();
                $('#FP_diahabil').show();
                $('#frecpago > option[value="' + FrecPago + '"]').prop('selected', true);
                $('#diahabil > option[value="' + Dia + '"]').prop('selected', true);
                $('#desc_quincenal').hide();
                break;
        }
    });

    $('#FPguardar').click(function () {
        var FrecPago = $('#frecpago').val();
        var Dia = $('#diasemanal').val();
        var IDExp = $('#FP-IDExp').val();

        switch (FrecPago) {
            case 'SEMANAL':
                Dia = $('#diasemanal').val();
                break;
            case 'QUINCENAL':
                Dia = "15";
                break;
            case 'MENSUAL':
                Dia = $('#diahabil').val();
                ;
                break;
        }

        $.get(URL + "cobranza/GeneraFechaPago/" + FrecPago + '/' + Dia, function (data) {
            $("#fecha_limite_pago_" + IDExp).text(data);
        });

        guarda_forma_pago(Cuenta, IDEstudiante, IDTutor, FrecPago, Dia);
    });

    function guarda_forma_pago(Cuenta, IDEstudiante, IDTutor, FrecPago, Dia) {

        var correcto = "<div class='alert alert-success alert-dismissible' role='alert' style='box-shadow: 5px 5px 7px #888888;'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Exito!</strong> La Forma de Pago se guardo.</div>";
        var error_enc = "<div class='alert alert-danger alert-dismissible' role='alert' style='box-shadow: 5px 5px 7px #888888;'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Error!</strong>";
        var error_pie = "</div>";

        var request = $.ajax({
            url: URL + 'ajax/forma_pago/',
            method: 'POST',
            data: {Cuenta: Cuenta,
                IDEstudiante: IDEstudiante,
                IDTutor: IDTutor,
                FrecPago: FrecPago,
                Dia: Dia},
            dataType: 'html'
        });

        request.done(function (msg) {
            if (msg === 'OK') {
                $('#resp-FP').show();
                $('#resp-FP').html(correcto);
                $('#FPcancelar').hide();
                $('#FPguardar').hide();
                $('#FPsalir').show();
            } else {
                $('#resp-FP').html(msg);
            }
        });

        request.fail(function (jqXHR, textStatus) {
            alert('Fallo al guardar la Forma de Pago: ' + jqXHR);
        });
    }

//FUNCION PARA CALCULAR EL COSTO DE LA COLEGIATURA
    $('input[type=checkbox]').click(function () {

        var total_colegiatura = 0.00;

        $('#listado_servicios input[type=checkbox]').each(function () {
            if (this.checked) {
                var precio_servicio = parseFloat($(this).attr('data-price'));
                var label = $(this).attr('id');
                var precio_parcialidad = 0.00;

                switch (FRECPAGO) {
                    case 'SEMANAL':
                        precio_parcialidad = precio_servicio / 4;
                        total_colegiatura = total_colegiatura + precio_parcialidad;
                        $("#PriceText-" + label).text(precio_parcialidad);
                        break;
                    case 'QUINCENAL':
                        precio_parcialidad = precio_servicio / 2;
                        total_colegiatura = total_colegiatura + precio_parcialidad;
                        $("#PriceText-" + label).text(precio_parcialidad);
                        break;
                    case 'MENSUAL':
                        total_colegiatura = total_colegiatura + precio_servicio;
                        $("#PriceText-" + label).text(precio_servicio);
                        break;
                }
            }
        });

        var tmp = $("#descuento").attr('data-por-desc');
        var descontando = (total_colegiatura * tmp) / 100;
        total_colegiatura -= descontando;

        var subtotal = (total_colegiatura) - IVA(total_colegiatura);
        $("#descuento").text('-' + descontando);
        $("#total_a_apagar").text(total_colegiatura);
        $('#subtotal').text(subtotal);
        $('#IVA').text(IVA(total_colegiatura));
    });

    $('#FPsalir').click(function () {
        location.reload();
    });

    function ServicioContratado(IDExp, IDUser, descuento, FrecPago) {
        var total_colegiatura = 0.00;
        $('#listado_servicios input[type=checkbox]').each(function () {
            if (esServicoContratado(IDExp, IDUser, $(this).val()) === 'OK') {

                var precio_servicio = parseFloat($(this).attr('data-price'));
                var label = $(this).attr('id');
                var precio_parcialidad = 0.00;

                switch (FrecPago) {
                    case 'SEMANAL':
                        precio_parcialidad = precio_servicio / 4;
                        total_colegiatura = total_colegiatura + precio_parcialidad;
                        $("#PriceText-" + label).text(precio_parcialidad);
                        break;
                    case 'QUINCENAL':
                        precio_parcialidad = precio_servicio / 2;
                        total_colegiatura = total_colegiatura + precio_parcialidad;
                        $("#PriceText-" + label).text(precio_parcialidad);
                        break;
                    case 'MENSUAL':
                        total_colegiatura = total_colegiatura + precio_servicio;
                        $("#PriceText-" + label).text(precio_servicio);
                        break;
                }

                $(this).prop('checked', true);
                $(this).prop('disabled', true);
            } else {
                $(this).prop('checked', false);
                $(this).prop('disabled', false);
            }

        });

        var descontando = (total_colegiatura * descuento) / 100;
        total_colegiatura -= descontando;
        var subtotal = (total_colegiatura - descontando) - IVA(total_colegiatura);

        $("#descuento").text('-' + descontando);
        $("#total_a_apagar").text(total_colegiatura);
        $('#subtotal').text(subtotal);
        $('#IVA').text(IVA(total_colegiatura));
    }

    function esServicoContratado(IDExp, IDUser, ID) {
        var resp;
        var request = $.ajax({
            url: URL + 'ajax/esServicoContratado/' + ID,
            method: 'POST',
            data: {IDExp: IDExp, IDUser: IDUser, ID: ID},
            dataType: 'html',
            async: false
        });

        request.done(function (msg) {
//            alert(msg)
            resp = msg;
        });

        request.fail(function (jqXHR, textStatus) {
            alert('Fallo al guardar el pago: ' + textStatus);
        });
        return resp;
    }

    function IVA(total) {
        var total_con_iva = (total * IVA_GLOBAL) / 100;
        return total_con_iva;
    }

    /***************************************************************************
     * FUNCIONES PARA VER LOS DETALLES DE LOS PAGOS REALIZADOS                 *
     ***************************************************************************/

    $('.DETALLEPAGO').click(function () {
        var IDExp = $(this).attr('data-IDExp');
        var IDPago = $(this).attr('data-IDPago');
        var html = "";
        
        $("#detallitos").remove();

        $.getJSON(URL + 'ajax/detallesPago/' + IDExp + '/' + IDPago, function (datalles) {
            $.each(datalles, function (key, value) {
                html += "<tr id='detallitos'>";
                html += "<td>" + value.IDPagSer + "</td>";
//                html += "<td>" + value.FecPago + "</td>";
                html += "<td>" + value.Descripcion + "</td>";
                html += "<td>" + value.Nombre + "</td>";
                html += "<td>" + value.Descuento + "</td>";
                html += "<td>" + value.Recargo + "</td>";
                html += "<td>" + value.SubTotal + "</td>";
                html += "<td>" + value.IVA + "</td>";
                html += "<td>" + value.Total + "</td>";
                html += "</tr>";
            });
            $("#lista_detalles > tbody").append(html);
        });
    });

});