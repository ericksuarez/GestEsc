<?php

/**
 * Description of Empleado_model
 *
 * @author Erick Suarez
 */
class PadresFam_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }


    public function getHijos($IdUsuario) {
        $sql = "select *,es.Nombre as NomEstudiante from padresfam as pd
                left join estudiante as es on es.IDEstudiante=pd.Estudiante_IDEstudiante
                where pd.Usuario_IdUsuario= ".$IdUsuario;
        return $this->getQuery($sql);
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

    public function getOnlyRow($sql) {
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $array = $query->result_array();
        } else {
            $array = array();
        }
        return $array[0];
    }

}
