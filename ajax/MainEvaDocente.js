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

        $('#docente-carga').val(nombre);
        $('#IDDocente').val(IDExp);
        $('#Eturno').val(turno);

        ID_EXP_DOCENTE = IDExp;
    });


});

