<?php

/**
 * Description of Docente
 *
 * @author Erick Suarez Buendia
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Docente extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Docente_model", "docente");
        $this->load->model("Expediente_model", "expediente");
        $this->load->model("Catalogo_model", "catalogo");
        $this->load->model("ConsultaGral", "gral");
        $this->load->model("Log_Bitacora_model", "bitacora");
    }

    public function alta() {
        $data["comprobante"] = $this->expediente->getExpComprobante(2); //IDTipo Docente
        $this->load->view('common/header');
        $this->load->view('docente/alta', $data);
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
            $busqueda->Where('gmd', 'Grado_IDGrado', $grupo);
            $busqueda->Where('dm', 'Materia_IDMateria', $materia);
            $where = $busqueda->getWhere();
        }
        $data["docente"] = $this->catalogo->Docentes($where);

        foreach ($data["docente"] as $key => $value) {
            $materias = $this->docente->getMaterias($value['IDDocente']);
            $grupos = $this->docente->getGrupos($value['IDDocente']);
            foreach ($materias as $k => $val) {
                $data["docente"][$key]["Materias"] .= '- '.$val['Nombre'] . '.<br>';
            }
            $data["docente"][$key]["Materias"] = substr($data["docente"][$key]["Materias"], 0, -1);
            foreach ($grupos as $k => $va) {
                $data["docente"][$key]["Grupos"] .= $va['Grado'] . '-' . $va['Grupo'] . ',';
            }
            $data["docente"][$key]["Grupos"] = substr($data["docente"][$key]["Grupos"], 0, -1);
        }
        $lista = new Lista();
        $lista->configButtons('IDExp', 'expediente');
        $lista->setThead('Nombre', 'Turno', 'Grupos', 'Materias', 'Fec.Alta');
        $lista->setRealColumns('NomCompleto', 'Turno_IDTurno', 'Grupos', 'Materias', 'FecInscripcion');
        $lista->setTbody($data['docente']);
        $data['table'] = $lista->table();

        $data['export_buttons'] = Exportar::buttons();
        $this->session->set_userdata('Export', Exportar::run($lista, $data['docente']));

        $this->load->view('common/header');
        $this->load->view('docente/lista', $data);
        $this->load->view('common/footer');
    }

    public function modificar($IDExp) {

        $data["docsExp"] = $this->expediente->getExpDocs($IDExp);
        $data["comprobante"] = $this->expediente->getExpComprobante(2); //IDTipo Docente
        $post = $this->input->post();
        $post["Einscrito"] = 1; //Por que viene de una consulta del Exp.

        if ($this->form_validation->run('docente') == FALSE) {
            $this->load->view('common/header');
            $this->load->view('docente/modificar_infoUsr', $data);
            $this->load->view('common/footer');
        } else {
            $PKs = $this->gral->getIDsDocente($IDExp);
            $post["Econtrasena"] = $PKs['Contrasena'];

            $this->docente->UpdDireccion($post, $PKs['Direccion_IDDireccion']);
            $this->docente->UpdUsuarioDocente($post, $PKs['Usuario_IDUsuario']);
            $this->docente->UpdDocente($post, $PKs['IDDocente'], $PKs['Direccion_IDDireccion'], $PKs['Usuario_IDUsuario']);
            foreach ($post['Emateria'] as $key => $value) {
                $ExisteMateria = $this->docente->ExisteMateria($PKs['IDDocente'], $value);
                if ($ExisteMateria) {
                    $this->docente->UpdMateria($post, $PKs['IDDocente'], $value);
                } else {
                    $this->docente->setIDDocente($PKs['IDDocente']);
                    $this->docente->InsMateria($post, $value);
                }
            }
            $this->docente->UpdExpediente($post, $PKs['IDExp'], $PKs['Usuario_IDUsuario']);
            $this->session->set_flashdata('exito', 'La información se modifico con éxito.');
            redirect('expediente/modificar/' . $IDExp);
        }
    }

    public function guardar() {
        $post = $this->input->post();
        if ($this->form_validation->run('docente') == FALSE) {
            $data["documentos"] = $this->catalogo->ListaDocumentos(2); //IDTipo Docente
            $this->load->view('common/header');
            $this->load->view('docente/alta', $data);
            $this->load->view('common/footer');
        } else {
            $this->docente->InsDireccion($post);
            $this->docente->InsUsuarioDocente($post);
            $this->docente->InsDocente($post);
            foreach ($post['Emateria'] as $key => $value) {
                $this->docente->InsMateria($post, $value);
            }
            $IDExp = $this->docente->InsExpediente($post);

            redirect('expediente/modificar/' . $IDExp);
        }
    }

    public function documentos($IDExp) {

        $this->load->library('Upload_TipoDocs');
        
        $data = $this->upload_tipodocs->cargar($IDExp);

        if (is_array($data)) {
            $this->session->set_flashdata('error', 'Se produjo un error al subir los documentos!!!<br>' . $data);
            redirect('expediente/modificar/' . $IDExp);
        } else {
            $this->session->set_flashdata('exito', 'Los documentos se subieron con éxito.');
            redirect('expediente/modificar/' . $IDExp);
        }
    }

    public function carga_materia() {
        $post = $this->input->post();
        $where = "";
        $data["where"] = '';

        if (!empty($post)) {
            foreach ($post as $key => $value) {
                $$key = $value;
            }
            if (isset($nombre)) {
                $busqueda = new Busqueda();
                $busqueda->WhereFullText("e", array('Nombre', 'APaterno', 'AMaterno'), $nombre);
                if (isset($turno)) {
                    $busqueda->Where('e', 'Turno_IDTurno', $turno);
                }
                $where = $busqueda->getWhere();
            }
            if (isset($grupo)) {
                $data["where"] = 'where GradoEsc_IDGradoEsc = ' . $grupo;
            }
            if (isset($Materias)) {
                foreach ($Materias as $key => $value) {
                    $ExisteMateria = $this->docente->ExisteMateria($IDDocente, $value);
                    if ($ExisteMateria) {
                        $this->docente->UpdMateria($post, $IDDocente, $value);
                    } else {
                        $this->docente->setIDDocente($IDDocente);
                        $this->docente->InsMateria($post, $value);
                    }
                }
                $this->session->set_flashdata('exito', 'Las Materias se cargaron correctamente.');
                redirect(current_url());
            }
        }
        $data["docente"] = $this->catalogo->Docentes($where);

        $data["add_js"] = array('MainCargaMaterias');
        $this->load->view('common/header');
        $this->load->view('docente/carga_materias', $data);
        $this->load->view('common/footer');
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
