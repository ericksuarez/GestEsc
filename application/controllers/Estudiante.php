<?php

/**
 * Description of Estudiante
 *
 * @author Erick Suarez Buendia
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Estudiante extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Estudiante_model", "study");
        $this->load->model("Expediente_model", "expediente");
        $this->load->model("Catalogo_model", "catalogo");
        $this->load->model("ConsultaGral", "gral");
        $this->load->model("Curricular_model", "curricular");
    }

    public function alta() {
        $data["comprobante"] = $this->expediente->getExpComprobante(1); //IDTipo Estudiante
        $this->load->view('common/header');
        $this->load->view('estudiante/alta', $data);
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
            $busqueda->Where("e", 'matricula', $matricula);
            $busqueda->Where('e', 'Turno_IDTurno', $turno);
            $busqueda->Where('gr', 'IDGrado', $grupo);
            $where = $busqueda->getWhere();
        }
        $data['estudiante'] = $this->catalogo->Estudiantes($where);

        $lista = new Lista();
        $lista->configButtons('IDExp','expediente');
        $lista->setThead('Nombre','Grupo','Turno','Promedio Gral.','Desc.Col.');
        $lista->setRealColumns('NomCompleto','GradoGrupo','Turno_IDTurno','PromedioGral','DescntoColegiatura');
        $lista->setTbody($data['estudiante']);
        $data['table'] = $lista->table();
        
        $data['export_buttons'] = Exportar::buttons();
        $this->session->set_userdata('Export',  Exportar::run($lista, $data['estudiante']));
        
        $this->load->view('common/header');
        $this->load->view('estudiante/lista', $data);
        $this->load->view('common/footer');
    }

    public function modificar($IDExp) {

        $data["docsExp"] = $this->expediente->getExpDocs($IDExp);
        $data["comprobante"] = $this->expediente->getExpComprobante(1); //IDTipo Estudiante
        $post = $this->input->post();
        $post["Einscrito"] = 1; //Por que viene de una consulta del Exp.

        if ($this->form_validation->run('estudiante/guardar') == FALSE) {
            $this->load->view('common/header');
            $this->load->view('estudiante/modificar_infoUsr', $data);
            $this->load->view('common/footer');
        } else {
            $PKs = $this->gral->getIDsExp($IDExp);
            $post["Econtrasena"] = $PKs['Estudiante']['Contrasena'];

            $this->study->UpdDireccion($post, $PKs['Estudiante']['Direccion_IDDireccion']);
            $this->study->UpdUsuarioEstudiante($post, $PKs['Estudiante']['Usuario_IDUsuario']);
            $this->study->UpdEstudiante($post, $PKs['Estudiante']['IDEstudiante'], $PKs['Estudiante']['Direccion_IDDireccion'], $PKs['Estudiante']['Usuario_IDUsuario']);
            $this->study->UpdGrupo($post, $PKs['Estudiante']['IDGrupo']);
            $this->study->UpdUsuarioPadre($post, $PKs['Familia'][0]['Usuario_IdUsuario']);
            $this->study->UpdPadreFam($post, $PKs['Familia'][0]['IDFamPad'], $PKs['Estudiante']['IDEstudiante'], $PKs['Familia'][0]['Direccion_IDDireccion'], $PKs['Familia'][0]['Usuario_IdUsuario']);
            $this->study->UpdUsuarioMadre($post, $PKs['Familia'][1]['Usuario_IdUsuario']);
            $this->study->UpdMadreFam($post, $PKs['Familia'][1]['IDFamPad'], $PKs['Estudiante']['IDEstudiante'], $PKs['Familia'][1]['Direccion_IDDireccion'], $PKs['Familia'][1]['Usuario_IdUsuario']);
            $this->study->UpdExpediente($post, $IDExp, $PKs['Estudiante']['Usuario_IDUsuario']);

            $this->session->set_flashdata('exito', 'La información se modifico con éxito.');
            redirect('expediente/modificar/' . $IDExp);
        }
    }

    public function guardar() {
        $post = $this->input->post();
        if ($this->form_validation->run() == FALSE) {

            $data["documentos"] = $this->catalogo->ListaDocumentos(1); //IDTipo Estudiante

            $this->load->view('common/header');
            $this->load->view('estudiante/alta', $data);
            $this->load->view('common/footer');
        } else {
            $this->study->InsDireccion($post);
            $this->study->InsUsuarioEstudiante($post);
            $this->study->InsEstudiante($post);
            $this->study->InsGrupo($post);
            $this->study->InsUsuarioPadre($post);
            $this->study->InsPadreFam($post);
            $this->study->InsUsuarioMadre($post);
            $this->study->InsMadreFam($post);
            $IDExp = $this->study->InsExpediente($post);
            $this->study->Servicios($IDExp, $this->study->getIDEstudianteUsuario(), 1);

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

    function Grado_Grupo($post_string) {
        $this->form_validation->set_message('Grado_Grupo', 'El campo Grado/Grupo es requerido');
        return $post_string == '0' ? FALSE : TRUE;
    }

    public function reinscripcion() {
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
        $lista->setThead('Matricula','Nombre Completo','Grupo','Turno');
        $lista->setActiveTfoot(FALSE);
        $lista->setRealColumns('Matricula','NomCompleto','GradoGrupo','Turno_IDTurno');
        $lista->setExport('export');
        $lista->setTbody($data['estudiante']);
        
        $data['export_buttons'] = Exportar::buttons();
        $this->session->set_userdata('Export',  Exportar::run($lista, $data['estudiante']));
        
        $data["add_js"] = array('MainReinscripcion', 'Reinscripcion');
        $this->load->view('common/header');
        $this->load->view('estudiante/reinscripcion', $data);
        $this->load->view("modal/estudiante/wizard_reinscripcion");
        $this->load->view('common/footer');
    }

    /*
     * Funcion para ver las calificaciones de los alumnos
     */

    public function calificaciones($IDUsuario=0) {
        $where = $IDUsuario == 0 ? "u.IdUsuario = ".$this->session->userdata('IdUsuario') : "u.IdUsuario = ".$IDUsuario;
        $data['estudiante'] = $this->catalogo->Estudiantes($where);
        
        $this->load->view('common/header');
        $this->load->view('estudiante/calificaciones',$data);
        $this->load->view('common/footer');
    }

    /*
     * Funcion para ver la trayectoria academica de los alumnos
     */

    public function trayectoria_escolar() {
        $data["docs"] = $this->config->item('documentos');
        $this->load->view('common/header');
        $this->load->view('trayectoria_escolar_view', $data);
        $this->load->view('common/footer');
    }


    public function kardex($IDUsuario=0) {
        $where = $IDUsuario == 0 ? "u.IdUsuario = ".$this->session->userdata('IdUsuario') : "u.IdUsuario = ".$IDUsuario;
        $data['estudiante'] = $this->catalogo->Estudiantes($where);
        $data['grados_escolares'] = $this->catalogo->CatGradoEsc();
        
        $this->load->view('common/header');
        $this->load->view('estudiante/kardex',$data);
        $this->load->view('common/footer');
    }

    public function agenda_escolar() {
        $this->load->view('common/header');
        $this->load->view('estudiante/agenda_escolar');
        $this->load->view('common/footer');
    }

    public function tarea() {
        $this->load->view('common/header');
        $this->load->view('estudiante/tareas');
        $this->load->view('common/footer');
    }

    public function nota() {
        $this->load->view('common/header');
        $this->load->view('estudiante/consulta_notas');
        $this->load->view('common/footer');
    }

    public function evaluacion_docente() {
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
        
        $data["add_js"] = array('MainEvaDocente');
        $this->load->view('common/header');
        $this->load->view('estudiante/evaluacion_profesor',$data);
        $this->load->view('common/footer');
    }

}
