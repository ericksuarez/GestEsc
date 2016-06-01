/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    var URL = 'http://localhost:8080/controlEscolar/index.php/';

    $('#materia').change(function () {
        var IDMateria = $(this).val();
        var href = URL + "estudiante/tarea/";
        window.location.href = href + IDMateria;
    });


});

