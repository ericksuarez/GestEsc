<?php

/**
 * Description of PDF
 *
 * @author Erick Suarez
 */
//require_once(APPPATH . 'libraries/html2pdf.class.php');
require_once('./html2pdf.class.php');

class PDF {

    var $ruta_destino;
    var $carpeta;
    var $archivo;
    var $route_full;
    var $folder;
    var $html2pdf;

    function PDF() {
        $this->CI = & get_instance();
        $this->ruta_destino = "./assets/uploads/files/pdfs/";
    }

    public function inicializate($P = 'P', $A4 = 'A4', $fr = 'fr', $font = 'Arial') {
        $this->html2pdf = new HTML2PDF($P, $A4, $fr);
        $this->html2pdf->setDefaultFont($font);
    }

    public function plantilla($html, $data = array()) {
        $this->html2pdf->writeHTML($this->CI->load->view($html, $data, true));
    }
    
    public function ver_online($archivo='default.pdf') {
        $this->html2pdf->Output($archivo);
    }

//
//    public function PDF_config($id = "00", $nombre = "SN") {
//        $this->carpeta = $id;
//        $this->archivo = $nombre . ".pdf";
//        $this->folder = $this->ruta_destino . $this->carpeta . "/";
//        $this->route_full = $this->folder . "/" . $this->archivo;
//    }
//
//    public function PDF_nuevo() {
//        $this->html2pdf = new Html2pdf();
//        $this->createFolder();
//        $this->html2pdf->folder($this->folder);
//        $this->html2pdf->filename($this->archivo);
//        $this->html2pdf->paper('a4', 'portrait');
//    }
//
//    public function PDF_plantilla($html, $data = array()) {
//        $this->html2pdf->html(
//                utf8_decode(
//                        $this->CI->load->view($html, $data, true)
//                )
//        );
//    }
//
//    public function PDF_muestra() {
//        if (is_dir($this->folder)) {
//            $route = base_url($this->route_full);
//            if (file_exists($this->route_full)) {
//                header('Content-type: application/pdf');
//                readfile($route);
//            }
//        }
//    }
//
//    public function PDF_browser($route) {
//        $this->html2pdf = new Html2pdf();
//        $this->html2pdf->Output($route.".pdf");
//    }
//
//    public function PDF_guarda() {
//        return $this->html2pdf->create('save');
//    }
//
//    public function PDF_descarga() {
//        if (is_dir($this->folder)) {
//            $route = base_url($this->route_full);
//            if (file_exists($this->folder . $this->archivo)) {
//                header("Cache-Control: public");
//                header("Content-Description: File Transfer");
//                header('Content-disposition: attachment; filename=' . basename($this->archivo));
//                header("Content-Type: application/pdf");
//                header("Content-Transfer-Encoding: binary");
//                header('Content-Length: ' . filesize($this->archivo));
//                readfile($route);
//            }
//        }
//    }
//    public function PDF_enviar($html, $data) {
//        $this->createFolder();
//        $this->html2pdf->folder('./files/pdfs/');
//        $this->html2pdf->filename('test.pdf');
//        $this->html2pdf->paper('a4', 'portrait');
//        $this->PDF_plantilla($html, $data);
//
//        if ($path = $this->PDF_guarda()) {
//            $this->load->library('email');
//            $this->email->from('your@example.com', 'Your Name');
//            $this->email->to('israel965@yahoo.es');
//            $this->email->subject('Email PDF Test');
//            $this->email->message('Testing the email a freshly created PDF');
//            $this->email->attach($path);
//            $this->email->send();
//            echo "El email ha sido enviado correctamente";
//        }
//    }



    private function createFolder() {
        if (!is_dir($this->ruta_destino)) {
            mkdir($this->ruta_destino, 0777); //Carpeta gral
        }
        if (!is_dir($this->ruta_destino . $this->carpeta)) {
            mkdir($this->ruta_destino . $this->carpeta, 0777); //Carpeta por usuario
        }
    }

}
