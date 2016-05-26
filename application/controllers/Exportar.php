<?php

/**
 * Description of Exportar
 *
 * @author esuarez
 */
class Exportar extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function excel() {
        $PageWebtoExcel = $this->session->userdata('Export');;
        $NomArch = 'Listado';
        header("Content-type: application/vnd.ms-excel; name='excel'");
        header("Content-Disposition: filename=" . $NomArch . ".xls");
        header("Pragma: no-cache");
        echo $PageWebtoExcel;
    }
    
    public function pdf() {
        require_once(APPPATH . 'libraries/html2pdf.class.php');
        $data['table'] = $this->session->userdata('Export');
        $content = $this->load->view('imprimir/plantilla',$data,TRUE);
        $html2pdf = new HTML2PDF('P', 'A4');
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->WriteHTML($content);
        $html2pdf->Output('Listado.pdf');
    }
    
    public function impreso() {
        $data['table'] = $this->session->userdata('Export');
        $this->load->view('imprimir/plantilla',$data);
    }
    
    public function impreso_horario() {
        $data['table'] = $this->session->userdata('Export');
        $this->load->view('imprimir/horario',$data);
    }
    
    public function impreso_horario_individual() {
        $data['table'] = $this->session->userdata('Export');
//        $this->load->view('common/header');
        $this->load->view('imprimir/horario',$data);
//        $this->load->view('common/footer');
    }
    public function pdf_horario() {
        require_once(APPPATH . 'libraries/html2pdf.class.php');
        
        $data['table'] = $this->session->userdata('Export');
        $content = $this->load->view('imprimir/horario',$data,TRUE);
        echo $content;
//        $html2pdf = new HTML2PDF('P', 'A4');
//        $html2pdf->setDefaultFont('Arial');
//        $html2pdf->WriteHTML($content);
//        $html2pdf->Output('Horario.pdf');
    }

}
