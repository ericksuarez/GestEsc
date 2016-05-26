/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    var url = 'http://localhost:8080/controlEscolar/index.php/';
    var ID_EXP_DOCENTE;

    $('.Docente').click(function () {

//        $('li:last').removeClass('active');
        $('.list-group-item').removeClass('active');

        var IDExp = $(this).attr('data-exp');
        var nombre = $(this).attr('data-nombre');
        var turno = $(this).attr('data-turno');

        $(this).parent().addClass('active');

        $('#docente-carga').text(nombre);
        $('#IDDocente').val(IDExp);
        $('#Eturno').val(turno);

        MateriasAsignadas(IDExp);

        ID_EXP_DOCENTE = IDExp;
    });

    $('.borrarMat').click(function () {
        var IDMateria = $(this).attr('data-id');
        eliminar(ID_EXP_DOCENTE, IDMateria);
        $('#EM_' + IDMateria).hide();
        $('#' + IDMateria).show();
    });

    function MateriasAsignadas(IDExp) {
        $('#listado input[type=checkbox]').each(function () {
            $(this).prop('checked', false);
            $(this).show();
            var id = $(this).attr('id');
            $('#EM_' + id).hide();
        });

        $('#listado input[type=checkbox]').each(function () {
            if (esAsignada(IDExp, $(this).val()) === 'OK') {
//                $(this).prop('checked', true);
                $(this).hide();
                var id = $(this).attr('id');
                $('#EM_' + id).show();
            } else {
                $(this).prop('checked', false);
            }

        });
    }

    function esAsignada(IDExp, IDMateria) {
        var resp;
        var request = $.ajax({
            url: url + 'ajax/MateriaAsignada/',
            method: 'POST',
            data: {IDExp: IDExp, IDMateria: IDMateria},
            dataType: 'html',
            async: false
        });
        request.done(function (msg) {
//            alert(msg)
            resp = msg;
        });
        request.fail(function (jqXHR, textStatus) {
            alert('Fallo al verificar la Materia: ' + textStatus);
        });
        return resp;
    }

    function eliminar(IDExp, IDMateria) {
        var resp;
        var request = $.ajax({
            url: url + 'ajax/EliminaMateriaAsignada/',
            method: 'POST',
            data: {IDExp: IDExp, IDMateria: IDMateria},
            dataType: 'html',
        });
        request.done(function (msg) {
//            alert(msg)
        });
        request.fail(function (jqXHR, textStatus) {
            alert('Fallo al Eliminar la Materia: ' + textStatus);
        });
        return resp;
    }

});

