<?php

/**
 * Description of Imprimir
 *
 * @author esuarez
 */
class Imprimir extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function recibo_reinscripcion() {
        $this->load->view('imprimir/recibo_reinscripcion');
    }

}
