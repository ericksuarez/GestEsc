<?php

/**
 * Description of Empleado
 *
 * @author Erick Suarez Buendia
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Empleado extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Empleado_model", "empleado");
        $this->load->model("Expediente_model", "expediente");
        $this->load->model("Catalogo_model", "catalogo");
        $this->load->model("ConsultaGral", "gral");
        $this->load->model("Log_Bitacora_model", "bitacora");
        Acceso::TieneSesionActiva();
    }

    public function alta() {
        $data["comprobante"] = $this->expediente->getExpComprobante(4); //IDTipo Empleado
        $this->load->view('common/header');
        $this->load->view('empleado/alta', $data);
        $this->load->view('common/footer');
    }

    public function lista() {
        $post = $this->input->post();
        $where = "";

        if (!empty($post)) {
            foreach ($post as $key => $value) {
                $$key = $value;
            }
            $busqueda = new Busqueda();
            $busqueda->WhereFullText("e", array('Nombre', 'APaterno', 'AMaterno'), $nombre);
            $busqueda->Where('e', 'Turno_IDTurno', $turno);
            $where = $busqueda->getWhere();
        }
        
        $data["empleado"] = $this->catalogo->Empleados($where);

        $lista = new Lista();
        $lista->configButtons('IDExp', 'expediente');
        $lista->setThead('Nombre', 'Turno', 'Fec.Alta');
        $lista->setRealColumns('NomCompleto', 'Turno_IDTurno', 'FecInscripcion');
        $lista->setTbody($data['empleado']);
        $data['table'] = $lista->table();

        $data['export_buttons'] = Exportar::buttons();
        $this->session->set_userdata('Export', Exportar::run($lista, $data['empleado']));
        
        $this->load->view('common/header');
        $this->load->view('empleado/lista', $data);
        $this->load->view('common/footer');
    }

    public function modificar($IDExp) {

        $data["docsExp"] = $this->expediente->getExpDocs($IDExp);
        $data["comprobante"] = $this->expediente->getExpComprobante(4); //IDTipo Empleado
        $post = $this->input->post();
        $post["Einscrito"] = 1; //Por que viene de una consulta del Exp.

        if ($this->form_validation->run('empleado') == FALSE) {
            $this->load->view('common/header');
            $this->load->view('empleado/modificar_infoUsr', $data);
            $this->load->view('common/footer');
        } else {
            $PKs = $this->gral->getIDsEmpleado($IDExp);
            $post["Econtrasena"] = $PKs['Contrasena'];

            $this->empleado->UpdDireccion($post,$PKs['Direccion_IDDireccion']);
            $this->empleado->UpdUsuarioEmpleado($post,$PKs['Usuario_IDUsuario']);
            $this->empleado->UpdEmpleado($post,$PKs['IDEmpleado'],$PKs['Direccion_IDDireccion'],$PKs['Usuario_IDUsuario']);
            $this->empleado->UpdExpediente($post,$PKs['IDExp'],$PKs['Usuario_IDUsuario']);
            $this->session->set_flashdata('exito', 'La información se modifico con éxito.');
            redirect('expediente/modificar/' . $IDExp);
        }
    }

    public function guardar() {
        $post = $this->input->post();
        if ($this->form_validation->run('empleado') == FALSE) {

            $data["documentos"] = $this->catalogo->ListaDocumentos(2); //IDTipo Empleado

            $this->load->view('common/header');
            $this->load->view('empleado/alta', $data);
            $this->load->view('common/footer');
        } else {
            $this->empleado->InsDireccion($post);
            $this->empleado->InsUsuarioEmpleado($post);
            $this->empleado->InsEmpleado($post);
            $IDExp = $this->empleado->InsExpediente($post);

            redirect('expediente/modificar/' . $IDExp);
        }
    }

    public function documentos($IDExp) {

        $this->load->library('Upload_TipoDocs');

        $data = $this->upload_tipodocs->cargar($IDExp);

        if (is_array($data)) {
            $this->session->set_flashdata('error', 'Se produjo un error al subir los documentos!!!<br>' . $data);
            redirect('expediente/consulta/' . $IDExp);
        } else {
            $this->session->set_flashdata('exito', 'Los documentos se subieron con éxito.');
            redirect('expediente/consulta/' . $IDExp);
        }
    }

    function Turno($post_string) {
        $this->form_validation->set_message('Turno', 'El campo Turno es requerido');
        return $post_string == '0' ? FALSE : TRUE;
    }

    function Materia($post_string) {
        $this->form_validation->set_message('Materia', 'El campo Materias es requerido' . $post_string);
        return $post_string == '' ? FALSE : TRUE;
    }

}
