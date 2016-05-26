<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * Description of Upload_TipoDocs sube multiples archivos pero seleccionando uno
 * por uno dependiendo el tipo de archivo deseado. Sube un array de docs.
 *
 * @author esuarez
 */
class Upload_TipoDocs {
    
    var  $RutaGuardaArchivo;
    var $CI;

    public function __construct() {
        $this->CI =& get_instance();
        $this->setRutaGuardaArchivo($this->CI->config->item('RutaFTP'));
        $this->CI->load->model("Catalogo_model", "catalogo");
        $this->CI->load->model("ConsultaGral", "gral");
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
                    $full_path = base_url().str_replace('./', '', $this->getRutaGuardaArchivo()).'Exp_' . $IDExp . '/'.$_FILES["userfile"]["name"];
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
        $config['allowed_types'] = 'gif|jpg|png|tif|pdf';
        $config['max_size'] = '2048';
        $config['max_width'] = '2048';
        $config['max_height'] = '2048';

        $this->CI->load->library('upload', $config);
    }

    function getRutaGuardaArchivo() {
        return $this->RutaGuardaArchivo;
    }

    function setRutaGuardaArchivo($RutaGuardaArchivo) {
        $this->RutaGuardaArchivo = $RutaGuardaArchivo;
    }
}
