<?php

/**
 * Descripción de la clase Cobranza
 * 
 * @version 1.0
 * @author Erick Suarez
 * @package Controller
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cobranza extends CI_Controller {
    /*
     * Contructor de la clase y donde se cargan los modelos o utilerias necesarias. 
     * @access private
     */

    public function __construct() {
        parent::__construct();
        $this->load->model('Cobranza_model', 'cobranza');
        $this->load->model('Catalogo_model', 'catalogo');
    }

    public function mi_cuenta($IDExp) {
        $post = $this->input->post();
        $where = "";

        if (!empty($post)) {
            $fechas = explode("-", $post['FecsPago']);
            $where = "and p.FecPago between '" . FecFormato($fechas[0]) . "' and '" . FecFormato($fechas[1])."'";
        }

        $data['servicios'] = $this->cobranza->serviciosContratados($IDExp);
        $data['movimientos'] = $this->cobranza->allMovimientos($IDExp, $where);

        $data["add_js"] = array('MainCobranza');
        $this->load->view('common/header');
        $this->load->view('cobranza/mi_cuenta', $data);
        $this->load->view("modal/cobranza/detalle_pago");
        $this->load->view('common/footer');
    }

//Cuenta esta formado por el IDExp,IDUsuario,IDEstudiante
    public function cuentas() {
        $post = $this->input->post();
        $where = "";

        if (!empty($post)) {
            foreach ($post as $key => $value) {
                $$key = $value;
            }
            $busqueda = new Busqueda();
            $busqueda->WhereFullText("e", array('Nombre', 'APaterno', 'AMaterno'), $nombre);
            $busqueda->WhereFullText("pf", array('Nombre', 'APaterno', 'AMaterno'), $nombreTutor);
            $busqueda->Where('e', 'Matricula', $matricula);
            $busqueda->Where('e', 'Turno_IDTurno', $turno);
            $busqueda->Where('gr', 'IDGrado', $grupo);
            $busqueda->Where('c', 'IDCuenta', $cuenta);
            $where = $busqueda->getWhere();
        }

        $data['cuentas'] = $this->cobranza->cuentas($where);

        foreach ($data['cuentas'] as $key => $value) {
            $tmp = $this->cobranza->debe($value['IDExp']);
            $data['cuentas'][$key]['Debe'] = $tmp[0]['Debe'];
        }

        $data["add_js"] = array('MainCobranza', 'Reinscripcion');
        $this->load->view('common/header');
        $this->load->view('cobranza/cuentas', $data);
        $this->load->view("modal/cobranza/pagar");
        $this->load->view("modal/cobranza/forma_pago");
        $this->load->view('common/footer');
    }

    public function GeneraFechaPago($FrecPago, $Dia) {
        echo GeneraFechaPago($FrecPago, $Dia);
    }

    public function pagar() {
        $this->load->view('common/header');
        $this->load->view('cobranza/pagar');
        $this->load->view('common/footer');
    }

    public function forma_pago($IDExp) {
        $where = "ex.IDExp = " . $IDExp;
        $data['estudiante'] = $this->catalogo->Estudiantes($where);

        $data["add_js"] = array('MainCobranza');
        $this->load->view('common/header');
        $this->load->view('cobranza/forma_pago', $data);
        $this->load->view("modal/estudiante/wizard_reinscripcion");
        $this->load->view('common/footer');
    }

    public function reportes() {
        $this->load->view('common/header');
        $this->load->view('cobranza/reportes');
        $this->load->view('common/footer');
    }

}
