<?php

/**
 * Description of Exportar
 *
 * @author esuarez
 */
class Exportar extends Lista {

    public static function run($lista, $data) {
        $export = new Lista();
        $export->setThead($lista->getThead());
        $export->setActiveTfoot(FALSE);
        $export->setRealColumns($lista->getRealColumns());
        $export->setExport('export');
        $export->setTbody($data);
        return $export->table();
    }

    public static function buttons() {
        $buttons = '<div class="pull-right">
                <a id="ToExcel" class="btn btn-primary" href="' . site_url('exportar/excel') . '">
                    <i class="fa fa-file-excel-o floatL t3"></i>
                    <span class="hidden-xs floatL l5">
                        <b>&nbsp; Excel</b>
                    </span>
                    <div class="clear"></div>
                </a>
                <a id="ToPdf" class="btn btn-primary" href="' . site_url('exportar/pdf') . '" target="_new">
                    <i class="fa fa-file-pdf-o floatL t3"></i>
                    <span class="hidden-xs floatL l5">
                        <b>&nbsp; PDF</b>
                    </span>
                    <div class="clear"></div>
                </a>
                <a id="ToPrint" class="btn btn-primary btnPrint" href="' . site_url('exportar/impreso') . '">
                    <i class="fa fa-print floatL t3"></i>
                    <span class="hidden-xs floatL l5">
                        <b>&nbsp; Imprimir</b>
                    </span>
                    <div class="clear"></div>
                </a>
            </div>';
        return $buttons;
    }
    public static function btnsPdfPrint() {
        $buttons = '<div class="pull-right">
                <a id="ToPdf" class="btn btn-primary" href="' . site_url('exportar/pdf') . '" target="_new">
                    <i class="fa fa-file-pdf-o floatL t3"></i>
                    <span class="hidden-xs floatL l5">
                        <b>&nbsp; PDF</b>
                    </span>
                    <div class="clear"></div>
                </a>
                <a id="ToPrint" class="btn btn-primary btnPrint" href="' . site_url('exportar/impreso') . '">
                    <i class="fa fa-print floatL t3"></i>
                    <span class="hidden-xs floatL l5">
                        <b>&nbsp; Imprimir</b>
                    </span>
                    <div class="clear"></div>
                </a>
            </div>';
        return $buttons;
    }

    public static function html($view, $data) {
        $ci = &get_instance();
        return $ci->load->view($view, $data, TRUE);
    }

}
