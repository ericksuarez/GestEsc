/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    var url = 'http://localhost:8080/controlEscolar/index.php/';
    var IVA_GLOBAL = 16;

    $('.REINSCRIPCION').click(function () {
        var MODO = $(this).attr('data-mood');
        var IDExp = $(this).attr('data-ID');
        var IDUser = $(this).attr('data-User');
        var descuento = $(this).attr('data-Descuento');
        $('#descuento').attr('data-por-desc',descuento);
        
        ServicioContratado(IDExp, IDUser, descuento);

        if (MODO == 'create') {
            $('#REguardar').attr('data-save-ID', IDExp);
        }
    });

    $('#REguardar').click(function () {
        var IDExp = $(this).attr('data-save-ID');
        var servicios = "";

        var reinscripcion = new Reinscripcion(url, IDExp);
        reinscripcion.init();
        $('#listado_servicios input[type=checkbox]').each(function () {
            if (this.checked) {
                servicios += $(this).val() + ',';
            }
        });
        reinscripcion.setServicios(servicios.slice(0, -1));
        CRUD_Reinscripcion('create', reinscripcion);

    });
    
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
        $("#descuento").text('-'+descontando);
        $("#total_a_apagar").text(total_colegiatura);
        $('#subtotal').text(subtotal);
        $('#IVA').text(IVA(total_colegiatura));
    });

    $('#REsalir').click(function () {
        location.reload();
    });

    $('#REgrupo').change(function () {
        var IDGrupo = $('#REgrupo').val();
        var request = $.ajax({
            url: url + 'ajax/docentes_escargados/',
            method: 'POST',
            data: {IDGrupo: IDGrupo},
            dataType: 'html'
        });

        request.done(function (msg) {
            //alert(msg);
            $('#docentes_encargados').html(msg);

        });

        request.fail(function (jqXHR, textStatus) {
            alert('Fallo al Traer los Docentes Encargados: ' + textStatus);
        });
    });

    function CRUD_Reinscripcion(MODO, reinscripcion) {

        var correcto = "<div class='alert alert-success alert-dismissible' role='alert' style='box-shadow: 5px 5px 7px #888888;'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Exito!</strong> La Reinscripción se realizo.</div>";
        var error_enc = "<div class='alert alert-danger alert-dismissible' role='alert' style='box-shadow: 5px 5px 7px #888888;'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Error!</strong>";
        var error_pie = "</div>";
        
        var descuento = $('#descuento').text();
        var total = $('#total_a_apagar').text();
        var subtotal = total - IVA(total);
        
        var request = $.ajax({
            url: url + 'ajax/reinscripcion/' + MODO,
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
            } else {
                $(this).prop('checked', false);
            }

        });
        var descontando = (total_colegiatura * descuento) / 100;
        total_colegiatura -= descontando;
        var subtotal = (total_colegiatura - descontando) - IVA(total_colegiatura);
        $("#descuento").text('-'+descontando);
        $("#total_a_apagar").text(total_colegiatura);
        $('#subtotal').text(subtotal);
        $('#IVA').text(IVA(total_colegiatura));
    }

    function esServicoContratado(IDExp, IDUser, ID) {
        var resp;
        var request = $.ajax({
            url: url + 'ajax/esServicoContratado/' + ID,
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
            alert('Fallo es Servicio Contratado: ' + textStatus);
        });
        return resp;
    }
    
    function IVA(total){
        var total_con_iva = (total * IVA_GLOBAL) / 100;
        return total_con_iva;
    }
});