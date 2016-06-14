<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mantenimiento extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
        $this->load->model("Catalogo_model", "catalogo");
        $this->load->model("Docente_model", "docente");
        $this->load->model("Tarea_model", "tarea");
        $this->load->model("ConsultaGral", "gral");
    }

    public function index() {
        $this->_example_output((object) array('output' => '', 'js_files' => array(), 'css_files' => array()));
    }

    public function _example_output($output = null) {
        $this->load->view('common/header.php');
        $this->load->view('example.php', $output);
    }

    public function pais() {
        $crud = new grocery_CRUD();
        $crud->set_table('pais');
        $crud->set_subject('Pais');
        $crud->columns('IDPais', 'Nombre');
        $crud->display_as('IDPais', 'Pais');

        $crud->fields('IDPais', 'Nombre');
        $crud->required_fields('IDPais', 'Nombre');

        $output = $crud->render();
        $this->_example_output($output);
    }

    public function estado() {
        $crud = new grocery_CRUD();

        $crud->set_table('estado');
        $crud->set_subject('Estado');
        $crud->set_relation('Pais_IDPais', 'pais', 'Nombre');
        $crud->columns('IDEstado', 'Pais_IDPais', 'Nombre');
        $crud->display_as('Pais_IDPais', 'Pais')
                ->display_as('Nombre', 'Estado');

        $crud->required_fields('IDEstado', 'Pais_IDPais');

        $output = $crud->render();
        $this->_example_output($output);
    }

    public function delegacion() {
        $crud = new grocery_CRUD();

        $crud->set_table('delmun');
        $crud->set_subject('Delegación / Municipio');
        $crud->columns('IDDelMun', 'Estado_IDEstado', 'Estado_Pais_IDPais', 'Nombre');
        $crud->set_relation('Estado_IDEstado', 'estado', 'Nombre');
        $crud->set_relation('Estado_Pais_IDPais', 'pais', 'Nombre');
        $crud->display_as('Estado_IDEstado', 'Estado')
                ->display_as('Estado_Pais_IDPais', 'Pais')
                ->display_as('Nombre', 'Del / Mun');

        $crud->required_fields('IDDelMun', 'Estado_IDEstado', 'Estado_Pais_IDPais');

        $output = $crud->render();
        $this->_example_output($output);
    }

    public function grado() {
        $crud = new grocery_CRUD();
        $crud->set_table('grado');
        $crud->set_subject('Grado');
        $crud->columns('IDGrado', 'Grado', 'Grupo');
        $crud->set_relation('Grado', 'grado_escolar', 'Descripcion');
        $crud->display_as('IDGrado', '# ')
                ->display_as('GradoEsc', 'Grado Esc.');

        $crud->required_fields('Grado', 'Grupo');

        $output = $crud->render();
        $this->_example_output($output);
    }

    public function grado_escolar() {
        $crud = new grocery_CRUD();
        $crud->set_table('grado_escolar');
        $crud->set_subject('Grados Escolares');
        $crud->columns('IDGradoEsc', 'GradoEsc', 'Descripcion');
        $crud->display_as('IDGradoEsc', '# ')
                ->display_as('GradoEsc', 'Grado Esc. ');

        $crud->fields('GradoEsc', 'Descripcion');
        $crud->required_fields('GradoEsc');

        $output = $crud->render();
        $this->_example_output($output);
    }

    public function materia() {
        $crud = new grocery_CRUD();
        $crud->set_table('materia');
        $crud->set_subject('Materia');
        $crud->columns('IDMateria', 'Nombre', 'NumHoras', 'EsExtra', 'GradoEsc_IDGradoEsc');
        $crud->set_relation('GradoEsc_IDGradoEsc', 'grado_escolar', 'Descripcion');
        $crud->display_as('Nombre', 'Nombre Materia')
                ->display_as('EsExtra', 'Extra Clase')
                ->display_as('GradoEsc_IDGradoEsc', 'Grado');

        $crud->required_fields('Nombre', 'EsExtra', 'GradoEsc_IDGradoEsc');

        $output = $crud->render();
        $this->_example_output($output);
    }

    public function servicio() {
        $crud = new grocery_CRUD();
        $crud->set_table('servicio');
        $crud->set_subject('Servicio');
        $crud->columns('IDServicio', 'Nombre', 'IDUnidad', 'Precio');
        $crud->set_relation('IDUnidad', 'unidades', 'Descripcion');
        $crud->display_as('Nombre', 'Nombre Servicio')
                ->display_as('IDUnidad', 'Unidad');

        $crud->required_fields('Nombre', 'IDUnidad', 'Precio');

        $output = $crud->render();
        $this->_example_output($output);
    }

    public function tipousuario() {
        $crud = new grocery_CRUD();
        $crud->set_table('tipousuario');
        $crud->set_subject('Tipo Usuario');
        $crud->columns('IDTipoUsuario', 'Descripcion');

        $crud->fields('Descripcion');
        $crud->required_fields('Descripcion');

        $output = $crud->render();
        $this->_example_output($output);
    }

    public function turno() {
        $crud = new grocery_CRUD();
        $crud->set_table('turno');
        $crud->set_subject('Turno');
        $crud->columns('IDTurno', 'Descripcion', 'HoraInicioClases', 'HoraFinClases', 'DuracionClase', 'Estatus');
        $crud->display_as('IDTurno', 'Clave Periodo')
                ->display_as('HoraInicioClases', 'Hora de Entrada')
                ->display_as('HoraFinClases', 'Hora de Salida')
                ->display_as('DuracionClase', 'Tiempo de Clase');

        $crud->required_fields('Descripcion', 'Estatus', 'HoraInicoClases', 'HoraFinClases', 'DuracionClase');

        $output = $crud->render();
        $this->_example_output($output);
    }

    public function periodo() {
        $crud = new grocery_CRUD();
        $crud->set_table('periodo');
        $crud->set_subject('Periodo Escolar');
        $crud->columns('IDPeriodo', 'Clave', 'Descripcion', 'EnCurso', 'FecInicio', 'FecFin');
        $crud->display_as('Clave', 'Clave Periodo')
                ->display_as('EnCurso', 'Vigente')
                ->display_as('FecInicio', 'Fecha de Inicio')
                ->display_as('FecFin', 'Fecha de Termino');

        $crud->fields('Clave', 'Descripcion', 'EnCurso', 'FecInicio', 'FecFin');
        $crud->required_fields('Clave', 'Descripcion', 'EnCurso', 'FecInicio', 'FecFin');

        $output = $crud->render();
        $this->_example_output($output);
    }

    public function tipodocumento() {
        $crud = new grocery_CRUD();
        $crud->set_table('tipodocumento');
        $crud->set_subject('Tipo de Documento');
        $crud->columns('NomDoc', 'Activo', 'EsUpload');
        $crud->display_as('NomDoc', 'Nombre Documento')
                ->display_as('EsUpload', 'Cargado por Usuario');

        $crud->fields('NomDoc', 'Activo', 'EsUpload');
        $crud->required_fields('NomDoc', 'Activo', 'EsUpload');

        $output = $crud->render();
        $this->_example_output($output);
    }

    public function unidades() {
        $crud = new grocery_CRUD();
        $crud->set_table('unidades');
        $crud->set_subject('Unidades');
        $crud->columns('IDUnidad', 'Descripcion');
        $crud->display_as('IDUnidad', 'Unidad');

        $crud->required_fields('IDUnidad', 'Descripcion');

        $output = $crud->render();
        $this->_example_output($output);
    }

    public function recargo() {
        $crud = new grocery_CRUD();
        $crud->set_table('tiene_recargo');
        $crud->set_subject('Recargo');
        $crud->columns('IDRecargo', 'Servicio_IDServicio', 'FecLimite', 'Penalizacion', 'Descripcion', 'FecsPago');
        $crud->set_relation('Servicio_IDServicio', 'servicio', 'Nombre');
        $crud->display_as('IDRecargo', '#Recargo')
                ->display_as('Servicio_IDServicio', 'Servicio')
                ->display_as('FecsPago', 'Frec. de Pago')
                ->display_as('FecLimite', 'Fec.Limite Pago');

        $crud->required_fields('Servicio_IDServicio', 'FecLimite', 'Penalizacion', 'Descripcion', 'FecsPago');

        $output = $crud->render();
        $this->_example_output($output);
    }

    public function documento_usuario() {
        $crud = new grocery_CRUD();
        $crud->set_table('tipousuario_has_tipodocumento');
        $crud->set_subject('Documentos por Usuario');
        $crud->columns('TipoUsuario_IDTipoUsuario', 'TipoDocumento_IDTipoDoc', 'EsComprobante');
        $crud->set_relation('TipoUsuario_IDTipoUsuario', 'tipousuario', 'Descripcion');
        $crud->set_relation('TipoDocumento_IDTipoDoc', 'tipodocumento', 'NomDoc');
        $crud->display_as('TipoUsuario_IDTipoUsuario', 'Perfil')
                ->display_as('TipoDocumento_IDTipoDoc', 'Nom. Documento')
                ->display_as('EsComprobante', 'Comprobante');

        $crud->required_fields('TipoDocumento_IDTipoDoc', 'EsComprobante');

        $output = $crud->render();
        $this->_example_output($output);
    }

    public function notas($IDMateria = 0) {
        $crud = new grocery_CRUD();
        $where = "u.IdUsuario = " . $this->session->userdata('IdUsuario');
        $data['estudiante'] = $this->catalogo->Estudiantes($where);
        $data["tareas"] = array();
        $data["materia"] = "";
        $where_grado = array();

        if (!empty($data['estudiante'])) {
            $data["where"] = "where GradoEsc_IDGradoEsc = " . $data['estudiante'][0]['Grado'];
            $grado = $data['estudiante'][0]['Grado'];
            $crud->unset_operations();
            $where_grado = array('GradoEsc_IDGradoEsc' => $grado);
        }

        if ($IDMateria > 0) {
            $data["materia"] = $IDMateria;
            $crud->where('Materia_IDMateria', $IDMateria);
        }

        $crud->set_table('notas');
        $crud->set_subject('Notas de las Materias');
        $crud->columns('IDNota', 'Materia_IDMateria', 'Grado_IDGrado', 'Titulo', 'Archivo');
        $crud->set_relation('Grado_IDGrado', 'grado_escolar', 'Descripcion');
        $crud->set_relation('Materia_IDMateria', 'materia', 'Nombre', $where_grado);
        $crud->display_as('Grado_IDGrado', 'Grado')
                ->display_as('IDNota', '#')
                ->display_as('Materia_IDMateria', 'Materia');

        $crud->required_fields('Materia_IDMateria', 'Grado_IDGrado', 'Titulo', 'Archivo');
        $crud->set_field_upload('Archivo', $this->config->item('RutaNota'));

        $output = $crud->render();
        array_push($output->js_files, base_url() . "ajax/MainEstudianteTarea.js");
        $this->load->view('common/header.php');
        $this->load->view('estudiante/consulta_notas', $data);
        $this->load->view('example.php', $output);
    }

    public function tareas($IDMateria = 0) {
        $crud = new grocery_CRUD();
        $where = "u.IdUsuario = " . $this->session->userdata('IdUsuario');
        $docente = $this->catalogo->Docentes($where);
        $data["materia"] = $this->docente->getMaterias($docente[0]['IDDocente']);
        $data["IDMateria"] = 0;
        $where_materia = array();

        if ($IDMateria > 0) {
            $data["IDMateria"] = $IDMateria;
            $crud->where('Materia_IDMateria', $IDMateria);
            $where_materia = array('IDMateria' => $IDMateria);
        }
        $crud->set_table('tareas');
        $crud->set_subject('Tareas para las Materias');
        $crud->columns('IDTareas', 'Periodo_IDPeriodo', 'NomTarea', 'Descripcion', 'FecEntrega', 'Ext.Recurso');
        $crud->where('Docente_IDDocente', $docente[0]['IDDocente']);
        $crud->set_relation('Materia_IDMateria', 'materia', 'Nombre', $where_materia);
        $crud->set_relation('Periodo_IDPeriodo', 'periodo', 'Descripcion');
        $crud->set_relation('Docente_IDDocente', 'docente', '{Nombre} {APaterno} {AMaterno}', array('IDDocente' => $docente[0]['IDDocente']));
        $crud->display_as('IDTareas', '#')
                ->display_as('Periodo_IDPeriodo', 'Periodo')
                ->display_as('NomTarea', 'Nom.Tarea')
                ->display_as('FecEntrega', 'Fecha Entrega')
                ->display_as('Materia_IDMateria', 'Materia')
                ->display_as('Docente_IDDocente', 'Docente')
                ->display_as('Periodo_IDPeriodo', 'Periodo');
        $crud->required_fields('Materia_IDMateria', 'Docente_IDDocente', 'Periodo_IDPeriodo', 'NomTarea', 'FecEntrega');
        $crud->callback_column('Ext.Recurso', array($this, '_extraRecurso'));
        $output = $crud->render();
        
        array_push($output->js_files, base_url() . "ajax/MainEstudianteTarea.js");
        $this->load->view('common/header.php');
        $this->load->view('docente/tareas', $data);
        $this->load->view('example.php', $output);
    }

    function _extraRecurso($primary_key, $row) {
        return '<a href="' . site_url('mantenimiento/recurso_tarea') . '/' . $row->Materia_IDMateria . '/' . $row->IDTareas . '"
            class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" role="button">
                    <span class="ui-button-icon-primary ui-icon ui-icon-folder-open"></span>
                    <span class="ui-button-text">&nbsp;Cargar</span>
            </a>';
    }

    public function recurso_tarea($IDMateria, $IDTareas = 0) {

        $data["tarea"] = $this->tarea->getTareasMateria($IDMateria, $IDTareas);

        $crud = new grocery_CRUD();
        $crud->set_table('recursotarea');
        $crud->set_subject('Información extra para la tarea.');
        $crud->columns('IDRecursoTarea', 'Tareas_IDTareas', 'Archivo', 'PagConsulta');
        $crud->where('Tareas_IDTareas', $IDTareas);
        $crud->set_relation('Tareas_IDTareas', 'tareas', 'NomTarea', array('IDTareas' => $IDTareas));

        $crud->display_as('IDRecursoTarea', '#')
                ->display_as('Tareas_IDTareas', 'Nom.Tarea')
                ->display_as('PagConsulta', 'Pagina Web');

        $crud->required_fields('Materia_IDMateria', 'Grado_IDGrado', 'Titulo', 'Archivo');
        $crud->set_field_upload('Archivo', $this->config->item('RutaTarea'));

        $output = $crud->render();
        $this->load->view('common/header.php');
        $this->load->view('docente/recurso_tarea', $data);
        $this->load->view('example.php', $output);
    }

    public function evaluacion_continua() {
        $crud = new grocery_CRUD();
        $post = $this->input->post();
        $where = "u.IdUsuario = " . $this->session->userdata('IdUsuario');

        $data['docente'] = $this->catalogo->Docentes($where);
        $data['materias'] = $this->docente->getMaterias($data['docente'][0]['IDDocente']);
        $data['grupos'] = $this->docente->getGrupos($data['docente'][0]['IDDocente']);
        $data["IDMateria"] = 0;
        $data["where_tarea"] = "where Docente_IDDocente = " . $data['docente'][0]['IDDocente'];
        $where_materia = array();

        if (!empty($post)) {
            if (!empty($post['Materia'])) {
                $where_materia = array('IDMateria' => $post['Materia']);
                $data["IDMateria"] = 0;
                $crud->where('evaluacioncont.Materia_IDMateria', $post['Materia']);
            }
        }

        $crud->set_table('evaluacioncont');
        $crud->set_subject('Evaluación Continua');
        $crud->columns('Estudiante_IDEstudiante', 'Tareas_IDTareas', 'Calificacion', 'FecEntregada','Doc.Tarea');
        $crud->where('evaluacioncont.Docente_IDDocente', $data['docente'][0]['IDDocente']);
        $crud->set_relation('Tareas_IDTareas', 'tareas', 'NomTarea');
        $crud->set_relation('Materia_IDMateria', 'materia', 'Nombre', $where_materia);
        $crud->set_relation('Docente_IDDocente', 'docente', '{Nombre} {APaterno} {AMaterno}', 
                            array('IDDocente' => $data['docente'][0]['IDDocente']));
        $crud->set_relation('Periodo_IDPeriodo', 'periodo', 'Descripcion');
        $crud->set_relation('Estudiante_IDEstudiante', 'estudiante', '{Nombre} {APaterno} {AMaterno}');

        $crud->display_as('IDEvalCont', '#')
                ->display_as('Tareas_IDTareas', 'Nom.Tarea')
                ->display_as('Materia_IDMateria', 'Materia')
                ->display_as('Docente_IDDocente', 'Docente')
                ->display_as('Periodo_IDPeriodo', 'Periodo')
                ->display_as('Estudiante_IDEstudiante', 'Alumno')
                ->display_as('FecEntregada', 'Fecha Entregada');

        $crud->required_fields('Calificacion', 'FecEntregada');
        $crud->callback_column('Doc.Tarea', array($this, '_verDocTarea'));
        $crud->edit_fields('Calificacion', 'FecEntregada');
        
        $crud->unset_read();
        $crud->unset_delete();

        $output = $crud->render();
        $this->load->view('common/header.php');
        $this->load->view('docente/acentar_calificaciones', $data);
        $this->load->view('example.php', $output);
    }
    
    function _verDocTarea($primary_key, $row) {
        return '<a href="'.$row->Archivo.'" target="_new"
            class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" role="button">
                    <span class="ui-button-icon-primary ui-icon ui-icon-document"></span>
                    <span class="ui-button-text">&nbsp;Leer</span>
            </a>';
    }
    
    public function plantilla_correo() {
        $crud = new grocery_CRUD();
        $crud->set_table('plantilla');
        $crud->set_subject('Plantilla Correos');
        $crud->columns('IDPlantilla', 'IDTipoPlantilla', 'Descripcion');
        $crud->set_relation('IDTipoPlantilla', 'tipo_plantilla', 'Descripcion');
        $crud->display_as('IDPlantilla', '#')
             ->display_as('IDTipoPlantilla', 'Tipo');

        $crud->required_fields('IDPlantilla', '	IDTipoPlantilla', 'Descripcion');
        
        $output = $crud->render();
        
        $this->_example_output($output);
    }
}
