<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Home
 *
 * @author erick
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Expediente extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Catalogo_model", "catalogo");
        $this->load->model("Expediente_model", "expediente");
        $this->load->model("Docente_model", "docente");
        $this->load->model("ConsultaGral", "gral");
        $this->load->model("Curricular_model", "curricular");
    }

    public function index() {
        $post = $this->input->post();
        $where = "";

        if (!empty($post)) {
            foreach ($post as $key => $value) {
                $$key = $value;
            }
            $busqueda = new Busqueda();
            $busqueda->WhereFullText("e", array('Nombre', 'APaterno', 'AMaterno'), $nombre);
            $busqueda->Where("e", 'matricula', $matricula);
            $busqueda->Where('e', 'Turno_IDTurno', $turno);
            $busqueda->Where('gr', 'IDGrado', $grupo);
            $where = $busqueda->getWhere();
        }

        $data['estudiante'] = $this->catalogo->Estudiantes($where);

        $lista = new Lista();
        $lista->setThead('Matricula', 'Nombre Completo', 'Grupo', 'Turno');
        $lista->setActiveTfoot(FALSE);
        $lista->setRealColumns('Matricula', 'NomCompleto', 'GradoGrupo', 'Turno_IDTurno');
        $lista->setExport('export');
        $lista->setTbody($data['estudiante']);

        $data['export_buttons'] = Exportar::buttons();
        $this->session->set_userdata('Export', Exportar::run($lista, $data['estudiante']));

        $this->load->view('common/header');
        $this->load->view('lista_expediente', $data);
        $this->load->view('common/footer');
        ;
    }

    public function consultar($IDExp) {

        $Exp = $this->gral->getTipoUsuario($IDExp);
        $data["gral"] = $this->expediente->getExpInfoGral($IDExp, $Exp["Usuario_IDUsuario"]);

        if (isset($data["gral"]["IDEstudiante"])) {
            $data["gralPadFam"] = $this->expediente->getExpInfoGralPadFam($data["gral"]["IDEstudiante"]);
        }

        if (isset($data["gral"]["IDDocente"])) {

            $data["Materias"] = "";
            $data["Grupos"] = "";

            $materias = $this->docente->getMaterias($data["gral"]['IDDocente']);
            $grupos = $this->docente->getGrupos($data["gral"]['IDDocente']);
            foreach ($materias as $key => $val) {
                $data["Materias"] .= $val['Nombre'] . ',';
            }
            foreach ($grupos as $key => $va) {
                $data["Grupos"] .= $va['Grado'] . '-' . $va['Grupo'] . ',';
            }
        }

        if (isset($data["gral"]["IDEmpleado"])) {
            
        }

        $data["dire"] = $this->expediente->getExpDir($IDExp);
        $data["docsExp"] = $this->expediente->getExpDocs($IDExp);
        $data["comprobante"] = $this->expediente->getExpComprobante($Exp['TipoUsuario_IDTipoUsuario']);

        $this->load->view('common/header');
        $this->load->view(strtolower($Exp["Descripcion"]) . '/consultar', $data);
        $this->load->view('common/footer');
    }

    public function modificar($IDExp) {

        $Exp = $this->gral->getTipoUsuario($IDExp);
        $data["gral"] = $this->expediente->getExpInfoGral($IDExp, $Exp["Usuario_IDUsuario"]);

        if (isset($data["gral"]["IDEstudiante"])) {
            $data["gralPadFam"] = $this->expediente->getExpInfoGralPadFam($data["gral"]["IDEstudiante"]);
        }

        if (isset($data["gral"]["IDDocente"])) {
            $tmp = $this->docente->getMaterias($data["gral"]["IDDocente"]);
            foreach ($tmp as $key => $value) {
                $data["Materias"][$value["Materia_IDMateria"]] = $value["Materia_IDMateria"];
            }
        }
        if (isset($data["gral"]["IDEmpleado"])) {
            
        }

        $data["dire"] = $this->expediente->getExpDir($IDExp);
        $data["docsExp"] = $this->expediente->getExpDocs($IDExp);
        $data["comprobante"] = $this->expediente->getExpComprobante($Exp['TipoUsuario_IDTipoUsuario']);

        $this->load->view('common/header');
        $this->load->view(strtolower($Exp["Descripcion"]) . '/modificar_infoDB', $data);
        $this->load->view('common/footer');
    }

    public function eliminar($IDExp) {
        $Exp = $this->gral->getTipoUsuario($IDExp);
        $this->expediente->eliminaExpediente($IDExp);
        $this->session->set_flashdata('exito', 'El Expediente de borro correctamente.');
        redirect(strtolower($Exp["Descripcion"]) . '/lista');
    }

    public function evaluacion_docente($IDExp) {
        $res = array();
        $Docente = $this->catalogo->Docentes("ex.IDExp=" . $IDExp);
        $res['NomDocente'] = $Docente[0]['NomCompleto'];

        foreach ($this->config->item('TipoEncuesta') as $porcentaje => $tipo) {
            $cnt = 0;
            $res[$porcentaje] = $this->curricular->getEncuestaPesoPercentual($Docente[0]['IDDocente'], $porcentaje, $tipo);
            $res['PP' . $porcentaje] = 0;
            foreach ($res[$porcentaje] as $key => $value) {
                $res['PP' . $porcentaje] += $value['PP'];
                $res['comentarios'][$key] = $value['Comentario'];
                $cnt++;
            }
            if ($res['PP' . $porcentaje] > 0) {
                $res['PP' . $porcentaje] /= $cnt;
            } else {
                $res['PP' . $porcentaje] = 1;
            }
        }

        $this->load->view('common/header');
        $this->load->view('docente/ver_evaluacion', $res);
        $this->load->view('common/footer');
    }
    
    public function modulos($IDExp) {
        $info = $this->gral->getTipoUsuario($IDExp);
        $data['IDExp'] = $IDExp;
        $data['IDUsuario'] = $info["Usuario_IDUsuario"];
        $this->load->view('common/header');
        $this->load->view('modulos_expediente',$data);
        $this->load->view('common/footer');
    }

}
