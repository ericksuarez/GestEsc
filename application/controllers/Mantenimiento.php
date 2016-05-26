<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mantenimiento extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
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

        $crud->required_fields('Nombre', 'EsExtra','GradoEsc_IDGradoEsc');

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
//            $crud->columns('IDTipoDoc', 'NomDoc','Activo','RutaDoc','EsUpload');
        $crud->display_as('NomDoc', 'Nombre Documento')
                ->display_as('RutaDoc', 'Ruta Documento')
                ->display_as('EsUpload', 'Cargado por Usuario');

        $crud->fields('NomDoc', 'Activo', 'RutaDoc', 'EsUpload');
        $crud->required_fields('NomDoc', 'Activo', 'RutaDoc', 'EsUpload');

        $crud->set_field_upload('RutaDoc', 'assets/uploads/files');

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
        $crud->columns('TipoUsuario_IDTipoUsuario', 'TipoDocumento_IDTipoDoc','EsComprobante');
        $crud->set_relation('TipoUsuario_IDTipoUsuario', 'tipousuario', 'Descripcion');
        $crud->set_relation('TipoDocumento_IDTipoDoc', 'tipodocumento', 'NomDoc');
        $crud->display_as('TipoUsuario_IDTipoUsuario', 'Perfil')
             ->display_as('TipoDocumento_IDTipoDoc', 'Nom. Documento')
             ->display_as('EsComprobante', 'Comprobante');

        $crud->required_fields('TipoDocumento_IDTipoDoc', 'EsComprobante');

        $output = $crud->render();
        $this->_example_output($output);
    }


}
