<?php
/**
 * Description of Log_Bitacora_model
 *
 * @author Erick Suarez
 */
class Log_Bitacora_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function InsBitacora($post) {
        $data = array(
            "Usuario_IDUsuario" => $this->session->userdata('ClaveUsuario'),
            "Accion" => $post["Accion"],
            "Descripcion" => $post["Descripcion"],
            "Page" => $post["Page"],
            "DescError" => $post["DescError"],
            "DatoPHP" => $post,
        );
        $this->db->insert('bitacora', $data);
    }
    

    public function getQuery($sql) {
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $array = $query->result_array();
        } else {
            $array = array();
        }
        return $array;
    }

}


