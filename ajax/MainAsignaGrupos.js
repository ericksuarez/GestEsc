/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    var url = 'http://localhost:8080/controlEscolar/index.php/';

    $('#turno').change(function () {
        var turno = $('#turno').val();
        $('#IDTurno').val(turno);
    });

    $('#grado').change(function () {
        var turno = $('#grado').val();
        $('#IDGrado').val(turno);
    });

    $('#docente_gral').change(function () {
        var val = $(this).val();
        if (val > 0) {
            $('.bootstrap-select').hide();
        } else {
            $('.bootstrap-select').show();
        }
    });
});

$(function () {
    var val = $('#grado').val();
    var turno = $('#turno').val();
    var grado = $('#grado').val();

    $('#grado > option[value="' + val + '"]').attr('selected', 'selected');
    var opcion = $('#grado > option[value="' + val + '"]').html()
    $('#grupo-carga').text('-- Grupo ' + opcion + ' asignar Docente(s) --');
    $('#IDTurno').val(turno);
    $('#IDGrado').val(grado);
})

