<?php

class Login_model extends CI_Model {

    public function VerificaUsr($user, $pass) {
        $user = false;
        $this->db->select('*');
        $q = $this->db->get_where('usuario', array('ClaveUsuario' => $user, 'Contrasena' => $pass));
        if ($q->num_rows() > 0) {
            $user = true;
        } else {
            $user = false;
        }
        return $user;
    }

    public function getUserInfo($user, $pass) {
        $this->db->select('*');
        $query = $this->db->get_where('usuario', array('ClaveUsuario' => $user, 'Contrasena' => $pass));
        if ($query->num_rows() > 0) {
            $array = $query->result_array();
        } else {
            $array = array();
        }
        return $array[0];
    }

    public function getNomUsuario($IdUsuario, $IDTipoUsuario) {

        if ($IDTipoUsuario == 1) {
            $estudiante = "select CONCAT(Nombre,' ',APaterno,' ',AMaterno) as nombre from estudiante as e where e.Usuario_IdUsuario = " . $IdUsuario;
            $array = $this->getQuery($estudiante);
        }
        if ($IDTipoUsuario == 2) {
            $docente = "select CONCAT(Nombre,' ',APaterno,' ',AMaterno) as nombre from docente as d where d.Usuario_IdUsuario = " . $IdUsuario;
            $array = $this->getQuery($docente);
        }
        if ($IDTipoUsuario == 3) {
            $padrefam = "select CONCAT(Nombre,' ',APaterno,' ',AMaterno) as nombre from padresfam as pd where pd.Usuario_IdUsuario = " . $IdUsuario;
            $array = $this->getQuery($padrefam);
        }
        if ($IDTipoUsuario > 3) {
            $empleado = "select CONCAT(Nombre,' ',APaterno,' ',AMaterno) as nombre from empleado as pd where pd.Usuario_IdUsuario = " . $IdUsuario;
            $array = $this->getQuery($empleado);
        }

        return $array[0]['nombre'];
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
