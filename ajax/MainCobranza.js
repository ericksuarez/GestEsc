/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    var URL = 'http://localhost:8080/controlEscolar/index.php/';
    var IVA_GLOBAL = 16;

//PARA REALIZAR LA SUMA Y GUARDADO DEL PAGO DE LOS SERVICIOS    
    $('.REINSCRIPCION').click(function () {
        var MODO = $(this).attr('data-mood');
        var IDExp = $(this).attr('data-ID');
        var IDUser = $(this).attr('data-User');
        var descuento = $(this).attr('data-Descuento');
        $('#descuento').attr('data-por-desc', descuento);

        ServicioContratado(IDExp, IDUser, descuento);

        if (MODO == 'create') {
            $('#REguardar').attr('data-save-ID', IDExp);
        }
    });

    $('#REguardar').click(function () {
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

//FUNCIONES PARA DETERMINAR Y DEFINIR EL TIPO DE FRECUENCIA CON LA QUE SE REALIZARAN
//LOS PAGOS DE LOS SERVICIOS
    $('#frecpago').click(function () {
        var modo = $(this).val();

        $('#FP_diasemanal').hide();
        $('#FP_diahabil').hide();

        switch (modo) {
            case 'SEMANAL':
                $('#FP_diasemanal').show();
                $('#FP_diahabil').hide();
                break;
            case 'QUINCENAL':
                $('#FP_diasemanal').hide();
                $('#FP_diahabil').hide();
                $('#desc_quincenal').show();
                break;
            case 'MENSUAL':
                $('#FP_diasemanal').hide();
                $('#FP_diahabil').show();
                break;
        }
    });
    
    $('#FPguardar').click(function () {
        var Cuenta = $(this).attr('data-Cuenta');
        var IDEstudiante = $(this).attr('data-IDEstudiante');
        var IDTutor = $(this).attr('data-IDTutor');
        
        guarda_forma_pago(Cuenta, IDEstudiante, IDTutor);

    });
    
    function guarda_forma_pago(Cuenta, IDEstudiante, IDTutor) {

        var correcto = "<div class='alert alert-success alert-dismissible' role='alert' style='box-shadow: 5px 5px 7px #888888;'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Exito!</strong> El pago se realizo.</div>";
        var error_enc = "<div class='alert alert-danger alert-dismissible' role='alert' style='box-shadow: 5px 5px 7px #888888;'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Error!</strong>";
        var error_pie = "</div>";

        var request = $.ajax({
            url: URL + 'ajax/forma_pago/',
            method: 'POST',
            data: {Cuenta: Cuenta,
                IDEstudiante: IDEstudiante,
                IDTutor: IDTutor},
            dataType: 'html'
        });

        request.done(function (msg) {
            //alert(msg);
            if (msg === 'OK') {
                $('#resp-reinsc').html(correcto);
                $('#FPsalir').show();
            } else {
                $('#resp-reinsc').html(msg);
            }

        });

        request.fail(function (jqXHR, textStatus) {
            alert('Fallo al guardar la Reinscripcion: ' + jqXHR);
        });
    }

//FUNCION PARA CALCULAR EL COSTO DE LA COLEGIATURA
    $('input[type=checkbox]').click(function () {
        var total_colegiatura = 0.00;
        $('#listado_servicios input[type=checkbox]').each(function () {
            if (this.checked) {
                total_colegiatura = total_colegiatura + parseFloat($(this).attr('data-price'));
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

    $('#REsalir').click(function () {
        location.reload();
    });


    function CRUD_Reinscripcion(MODO, reinscripcion) {

        var correcto = "<div class='alert alert-success alert-dismissible' role='alert' style='box-shadow: 5px 5px 7px #888888;'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Exito!</strong> El pago se realizo.</div>";
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
                $('#REsalir').show();
                $('#RErecibo').show();
                $('#REcancelar').hide();
                $('#REguardar').hide();
            } else {
                $('#resp-reinsc').html(msg);
            }

        });

        request.fail(function (jqXHR, textStatus) {
            alert('Fallo al guardar la Reinscripcion: ' + jqXHR);
        });
    }

    function ServicioContratado(IDExp, IDUser, descuento) {
        var total_colegiatura = 0.00;
        $('#listado_servicios input[type=checkbox]').each(function () {
            if (esServicoContratado(IDExp, IDUser, $(this).val()) === 'OK') {
                total_colegiatura = total_colegiatura + parseFloat($(this).attr('data-price'));
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
});