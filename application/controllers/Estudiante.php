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
        $this->load->model("Pago_model", "pago");
        $this->load->model("Tarea_model", "tarea");
        $this->load->model("Docente_model", "docente");
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
        $lista->configButtons('IDExp', 'expediente');
        $lista->setThead('Nombre', 'Grupo', 'Turno', 'Promedio Gral.', 'Desc.Col.');
        $lista->setRealColumns('NomCompleto', 'GradoGrupo', 'Turno_IDTurno', 'PromedioGral', 'DescntoColegiatura');
        $lista->setTbody($data['estudiante']);
        $data['table'] = $lista->table();

        $data['export_buttons'] = Exportar::buttons();
        $this->session->set_userdata('Export', Exportar::run($lista, $data['estudiante']));

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
            $IDUsuario = $this->study->InsUsuarioEstudiante($post);
            $IDEstudiante = $this->study->InsEstudiante($post);
            $this->study->InsGrupo($post);
            $this->study->InsUsuarioPadre($post);
            $IDPadFam = $this->study->InsPadreFam($post);
            $this->study->InsUsuarioMadre($post);
            $IDMadFam = $this->study->InsMadreFam($post);
            $IDExp = $this->study->InsExpediente($post);
            $this->study->Servicios($IDExp, $this->study->getIDEstudianteUsuario(), 1);
            //IDCuenta esta formado por el IDExp,IDUsuario,IDEstudiante
            $post = array(
                "Cuenta" => str_pad($IDExp . $IDUsuario . $IDEstudiante, 12, "0", STR_PAD_LEFT),
                "IDEstudiante" => $IDEstudiante,
                "IDTutor" => isset($post["Mtutor"]) ? $IDMadFam : $IDPadFam,
            );
            $this->pago->InsFormaPago($post);

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
        $lista->setThead('Matricula', 'Nombre Completo', 'Grupo', 'Turno');
        $lista->setActiveTfoot(FALSE);
        $lista->setRealColumns('Matricula', 'NomCompleto', 'GradoGrupo', 'Turno_IDTurno');
        $lista->setExport('export');
        $lista->setTbody($data['estudiante']);

        $data['export_buttons'] = Exportar::buttons();
        $this->session->set_userdata('Export', Exportar::run($lista, $data['estudiante']));

        $data["add_js"] = array('ajax/MainReinscripcion.js', 'ajax/Reinscripcion.js');
        $this->load->view('common/header');
        $this->load->view('estudiante/reinscripcion', $data);
        $this->load->view("modal/estudiante/wizard_reinscripcion");
        $this->load->view('common/footer');
    }

    /*
     * Funcion para ver las calificaciones de los alumnos
     */

    public function calificaciones($IDUsuario = 0) {
        $where = $IDUsuario == 0 ? "u.IdUsuario = " . $this->session->userdata('IdUsuario') : "u.IdUsuario = " . $IDUsuario;
        $data['estudiante'] = $this->catalogo->Estudiantes($where);
        $data['calificaciones'] = $this->study->getCalificaciones($data['estudiante'][0]['IDEstudiante'], $data['estudiante'][0]['Grado']);
        $this->load->view('common/header');
        $this->load->view('estudiante/calificaciones', $data);
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

    public function kardex($IDUsuario = 0) {
        $where = $IDUsuario == 0 ? "u.IdUsuario = " . $this->session->userdata('IdUsuario') : "u.IdUsuario = " . $IDUsuario;
        $data['estudiante'] = $this->catalogo->Estudiantes($where);

        $data['export_buttons'] = Exportar::btnsPdfPrint();
        $this->session->set_userdata('Export', $this->load->view('estudiante/kardex', $data, true));

        $this->load->view('common/header');
        $this->load->view('estudiante/kardex', $data);
        $this->load->view('common/footer');
    }

    public function agenda_escolar() {
        redirect('calendar');
    }

    public function tarea($IDMateria = 0, $IDUsuario = 0) {
        $where = $IDUsuario == 0 ? "u.IdUsuario = " . $this->session->userdata('IdUsuario') : "u.IdUsuario = " . $IDUsuario;
        $data['estudiante'] = $this->catalogo->Estudiantes($where);
        $data["where"] = "where GradoEsc_IDGradoEsc = " . $data['estudiante'][0]['Grado'];
        $data["tareas"] = array();
        $data["materia"] = "";

        if ($IDMateria > 0) {
            $data["tareas"] = $this->tarea->getTareasMateria($IDMateria);
            $data["materia"] = $IDMateria;
        }

        $data["add_js"] = array('ajax/MainEstudianteTarea.js');
        $this->load->view('common/header');
        $this->load->view('estudiante/tareas', $data);
        $this->load->view('common/footer');
    }

    public function documentoTarea($IDExp, $IDMateria, $IDTareas) {
        $this->load->library('Upload_TipoDocs');

        $where = "u.IdUsuario = " . $this->session->userdata('IdUsuario');
        $data['estudiante'] = $this->catalogo->Estudiantes($where);
        $info = $this->tarea->getTareasMateria($IDMateria, $IDTareas);

        $post = array(
            "IDTareas" => $IDTareas,
            "IDMateria" => $IDMateria,
            "IDDocente" => $info[0]['Docente_IDDocente'],
            "IDEstudiante" => $data['estudiante'][0]["IDEstudiante"],
            "IDPeriodo" => $info[0]['Periodo_IDPeriodo'],
            "FecEntregada" => date('Y-m-d H:i:s'),
            "Calificacion" => 0,
            "Archivo" => ""
        );

        $data = $this->upload_tipodocs->cargarTarea($IDExp, $post);

        if (is_array($data)) {
            $this->session->set_flashdata('error', 'Se produjo un error al subir los documentos!!!<br>' . $data);
            redirect('estudiante/tarea/' . $IDMateria);
        } else {
            $this->session->set_flashdata('exito', 'La tarea se subieron con éxito.');
            redirect('estudiante/tarea/' . $IDMateria);
        }
    }

    public function descarga($IDMateria, $IDTarea) {
        $this->load->library('Upload_TipoDocs');
        $this->upload_tipodocs->descargaTarea($IDMateria, $IDTarea);
    }

    public function defautlDescarga($IDTareas, $materia, $IDEstudiante, $IDPeriodo) {
        $this->load->library('Upload_TipoDocs');
        $this->upload_tipodocs->defautlDescarga($IDTareas, $materia, $IDEstudiante, $IDPeriodo);
    }

    public function nota($IDMateria = "") {
        $where = "u.IdUsuario = " . $this->session->userdata('IdUsuario');
        $data['estudiante'] = $this->catalogo->Estudiantes($where);
        $data["where"] = "where GradoEsc_IDGradoEsc = " . $data['estudiante'][0]['Grado'];
        $data["tareas"] = array();
        $data["materia"] = "";

        if ($IDMateria != "") {
            $data["tareas"] = $this->tarea->notas($IDMateria, $data['estudiante'][0]['Grado']);
            $data["materia"] = $IDMateria;
        }

        $data["add_js"] = array('ajax/MainEstudianteTarea.js');
        $this->load->view('common/header');
        $this->load->view('estudiante/consulta_notas', $data);
        $this->load->view('common/footer');
    }

    public function evaluacion_docente($IDUsuario = 0) {
        $post = $this->input->post();        
        $where = ($IDUsuario == 0) ? "e.Usuario_IdUsuario = " . $this->session->userdata('IdUsuario') : "e.Usuario_IdUsuario = " . $IDUsuario;;
        $data["estudiante"] = $this->catalogo->Estudiantes($where);
        $data["docente"] = $this->catalogo->Docentes_x_Grupo($data["estudiante"][0]['Grado_IDGrado']);
        $data["encuesta"] = $this->docente->encuesta();
        $this->form_validation->set_rules('docente-carga', 'Profesor', 'trim|required');
        if (!empty($post)) {
            foreach ($post['encuesta'] as $key => $value) {
                $this->form_validation->set_rules('encuesta[' . $key . '][respuesta]', 'Pregunta ' . ($key + 1), 'trim|required');
            }
        }
        if ($this->form_validation->run() == FALSE) {
            $data["add_js"] = array('ajax/MainEvaDocente.js');
            $this->load->view('common/header');
            $this->load->view('estudiante/evaluacion_profesor', $data);
            $this->load->view('common/footer');
        } else {
            foreach ($post['encuesta'] as $key => $value) {
                $this->docente->InsEncuestaResuelta($post['IDDocente'], 
                                                        $value['pregunta'], 
                                                        $value['respuesta'], 
                                                        $post['comentario']);
            }
            $this->session->set_flashdata('exito', 'La evaluación se guardo con éxito. Gracias!!!');
            redirect(current_url());
        }
    }

}
