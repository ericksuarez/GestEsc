/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    var URL = 'http://localhost:8080/controlEscolar/index.php/';
    $('#materia').change(function () {
        var pathname = window.location.pathname;
        var valores = pathname.split('/');
        if (valores.length == 6) {
            var IDMateria = $(this).val();
            var href = URL + "estudiante/tarea/";
            window.location.href = href + IDMateria;
        } else {
            var IDMateria = $(this).val();
            var href = URL + "estudiante/tarea/";
            window.location.href = href + IDMateria + '/' + valores[6];
        }
    });
    $('#materiaNotas').change(function () {
        var IDMateria = $(this).val();
        var href = URL + "mantenimiento/notas/";
        window.location.href = href + IDMateria;
    });
    $('#DocenteTareas').change(function () {
        var IDMateria = $(this).val();
        var href = URL + "mantenimiento/tareas/";
        window.location.href = href + IDMateria;
    });
});

