<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Upload_TipoDocs sube multiples archivos pero seleccionando uno
 * por uno dependiendo el tipo de archivo deseado. Sube un array de docs.
 *
 * @author esuarez
 */
class Upload_TipoDocs {

    var $RutaGuardaArchivo;
    var $CI;

    public function __construct() {
        $this->CI = & get_instance();
        $this->setRutaGuardaArchivo($this->CI->config->item('RutaFTP'));
        $this->CI->load->model("Catalogo_model", "catalogo");
        $this->CI->load->model("ConsultaGral", "gral");
        $this->CI->load->model("Tarea_model", "tarea");
        $this->CI->load->helper('download');
    }

    public function cargar($IDExp) {

        $this->EstructuraCarpetas($IDExp);
        $this->loadConfig($IDExp);

        $files = $_FILES;
        $_FILES = array();
//        Obtenermos los nombres de los archivos por usuario que se van a subir y creamos un array
        $cnt = 1;
        $NomArchSubido = array();
        foreach ($files["userfile"]["name"] as $key => $value) {
//            $NomArchSubido[$cnt++] = $key;
            $NomArchSubido[key($value)] = $key;
        }
//        LLenados el array $_FILES con los datos de cada archivo que se va a subir
        foreach ($NomArchSubido as $key => $value) {
            $_FILES = $this->array_Files($files, $value, $key);
            if (!empty($_FILES["userfile"]["name"])) {
                if (!$this->CI->upload->do_upload()) {
                    $error = array('error' => $this->CI->upload->display_errors());
                    return $error;
                } else {
                    $data = array('upload_data' => $this->CI->upload->data());
                    $info = $this->CI->catalogo->getTipoDoc($value);
//                    $this->CI->gral->InsDocumentacion($IDExp, $data["upload_data"]["full_path"], $info["IDTipoDoc"]);
                    $full_path = base_url() . str_replace('./', '', $this->getRutaGuardaArchivo()) . 'Exp_' . $IDExp . '/' . $_FILES["userfile"]["name"];
                    $this->CI->gral->InsUpdDocumentacion($IDExp, $full_path, $info["IDTipoDoc"]);
                    return true;
                }
            }
        }
    }

    private function array_Files($files, $value, $key) {
        $data = array(
            "userfile" => array(
                "name" => $files["userfile"]["name"][$value][$key],
                "type" => $files["userfile"]["type"][$value][$key],
                "tmp_name" => $files["userfile"]["tmp_name"][$value][$key],
                "error" => $files["userfile"]["error"][$value][$key],
                "size" => $files["userfile"]["size"][$value][$key]
            )
        );
        return $data;
    }

    private function EstructuraCarpetas($IDExp) {

        $estructura = $this->getRutaGuardaArchivo() . '/Exp_' . $IDExp . '/';
        if (!is_dir($estructura)) {
            if (!mkdir($estructura, 0777, true)) {
                die('Fallo al crear las carpetas...');
            }
        }
    }

    private function loadConfig($IDExp) {
        $config['upload_path'] = $this->getRutaGuardaArchivo() . '/Exp_' . $IDExp . '/';
//        $config['allowed_types'] = 'gif|jpg|png|tif|pdf';
        $config['allowed_types'] = 'gif|jpg|png|tif|pdf|doc';
        $config['max_size'] = '2048';
        $config['max_width'] = '2048';
        $config['max_height'] = '2048';

        $this->CI->load->library('upload', $config);
    }

    private function loadConfigTarea($IDExp, $IDMateria) {
        $config['upload_path'] = $this->getRutaGuardaArchivo() . '/Exp_' . $IDExp . '/Tareas/' . $IDMateria;
        $config['allowed_types'] = 'gif|jpg|png|tif|pdf|doc';
        $config['max_size'] = '2048';
        $config['max_width'] = '2048';
        $config['max_height'] = '2048';

        $this->CI->load->library('upload', $config);
    }

    public function cargarTarea($IDExp, $post) {

        $this->EstructuraCarpetasTarea($IDExp, $post['IDMateria']);
        $this->loadConfigTarea($IDExp, $post['IDMateria']);

        $files = $_FILES;
        $_FILES = array();
//        Obtenermos los nombres de los archivos por usuario que se van a subir y creamos un array
        $cnt = 1;
        $NomArchSubido = array();
        foreach ($files["userfile"]["name"] as $key => $value) {
//            $NomArchSubido[$cnt++] = $key;
            $NomArchSubido[key($value)] = $key;
        }
//        LLenados el array $_FILES con los datos de cada archivo que se va a subir
        foreach ($NomArchSubido as $key => $value) {
            $_FILES = $this->array_Files($files, $value, $key);
            if (!empty($_FILES["userfile"]["name"])) {
                if (!$this->CI->upload->do_upload()) {
                    $error = array('error' => $this->CI->upload->display_errors());
                    return $error;
                } else {
                    $data = array('upload_data' => $this->CI->upload->data());
                    $info = $this->CI->catalogo->getTipoDoc($value);
                    $full_path = base_url() . str_replace('./', '', $this->getRutaGuardaArchivo()) . 'Exp_' . $IDExp . '/Tareas/' . $post['IDMateria'] .'/'. str_replace(' ','_',$_FILES["userfile"]["name"]);
                    $post['Archivo'] = $full_path;
                    $this->CI->tarea->InsUpdTareaEvaCont($post, $full_path);
                    return true;
                }
            }
        }
    }

    private function EstructuraCarpetasTarea($IDExp, $IDMateria) {

        $estructura = $this->getRutaGuardaArchivo() . '/Exp_' . $IDExp . '/Tareas/' . $IDMateria;
        if (!is_dir($estructura)) {
            if (!mkdir($estructura, 0777, true)) {
                die('Fallo al crear las carpetas...');
            }
        }
    }

    public function descargaTarea($IDMateria,$IDTarea) {
        $info = $this->CI->tarea->getTareasMateria($IDMateria, $IDTarea);
        $data = file_get_contents($info[0]['Archivo']); // Read the file's contents
        $name = str_replace(" ", "_", $info[0]['NomTarea'].substr($info[0]['Archivo'],(strlen($info[0]['Archivo']-5)),(strlen($info[0]['Archivo'])-1)));
        force_download($name, $data);
    }
    
    public function defautlDescarga($IDTareas, $materia, $IDEstudiante, $IDPeriodo) {
        $Archivo = $this->CI->tarea->getArchivoTarea($IDTareas, $materia, $IDEstudiante, $IDPeriodo);
        $tmp = explode('/', $Archivo);
        $data = file_get_contents($Archivo); // Read the file's contents
        $name = str_replace(" ", "_", end($tmp));
        force_download($name, $data);
    }

    function getRutaGuardaArchivo() {
        return $this->RutaGuardaArchivo;
    }

    function setRutaGuardaArchivo($RutaGuardaArchivo) {
        $this->RutaGuardaArchivo = $RutaGuardaArchivo;
    }

}
