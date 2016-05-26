/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    var url = 'http://localhost:8080/controlEscolar/index.php/';
    
    $('.horario').change(function () {
        var IDMateria = $(this).val();
        var DiaMateria = $(this).attr('id');
        var Dia = $(this).attr('data-dia');
        var Hrs = $(this).attr('data-hrs');
        var IDTurno = $('#turno').val();
        var IDGrado = $('#grupo').val();
        
        var request = $.ajax({
            url: url + 'ajax/Docentes_Escargados_Materia',
            method: 'POST',
            data: {IDMateria: IDMateria, 
                   IDTurno: IDTurno, 
                   IDGrado: IDGrado, 
                   Dia: Dia,
                   Hrs:  Hrs},
            dataType: 'html'
        });

        request.done(function (msg) {
//            alert(msg);
            $('#'+ DiaMateria +'_Doc').html(msg);
        });

        request.fail(function (jqXHR, textStatus) {
            alert('Fallo al Traer los Docentes Encargados: ' + textStatus);
        });
    });
    
});

