/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
        var html_table = $('#example').html();
        var linkExcel = $('#ToExcel').attr('href');
        var linkPdf = $('#ToPdf').attr('href');
        var linkPrint = $('#ToPrint').attr('href');

        $('#ToExcel').attr('href', linkExcel + '/' + html_table);
        $('#ToPdf').attr('href', linkPdf + '/' + html_table);
        $('#ToPrint').attr('href', linkPrint + '/' + html_table);
        
//        alert(linkExcel+ '/' + encodeURI(html_table));
//        alert(linkPdf+ '/' + encodeURI(html_table));
//        alert(linkPrint+ '/' + encodeURI(html_table));
//        alert(html_table);
    });


