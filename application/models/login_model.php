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
            $docente = "select CONCAT(Nombre,' ',APaterno,' ',AMaterno) as nombre,ex.IDExp 
                        from docente as d 
                        left join expediente as ex on ex.Usuario_IDUsuario=d.Usuario_IdUsuario
                        where d.Usuario_IdUsuario =" . $IdUsuario;
            $array = $this->getQuery($docente);
        }
        if ($IDTipoUsuario == 3) {
            $padrefam = "select CONCAT(pd.Nombre,' ',pd.APaterno,' ',pd.AMaterno) as nombre,ex.IDExp 
                        from padresfam as pd 
                        left join estudiante as es on es.IDEstudiante=pd.Estudiante_IDEstudiante
                        left join expediente as ex on ex.Usuario_IDUsuario=es.Usuario_IdUsuario
                        where pd.Usuario_IdUsuario = " . $IdUsuario;
            $array = $this->getQuery($padrefam);
        }
        if ($IDTipoUsuario > 3) {
            $empleado = "select CONCAT(Nombre,' ',APaterno,' ',AMaterno) as nombre from empleado as pd where pd.Usuario_IdUsuario = " . $IdUsuario;
            $array = $this->getQuery($empleado);
        }

        return $array[0];
    }

    public function getUserPassword($correo) {
        $sql_1 = "SELECT * FROM docente
                  left join usuario on usuario.IdUsuario = docente.Usuario_IdUsuario WHERE Correo='" . $correo . "'";
        $docente = $this->getOnlyRow($sql_1);

        $sql_2 = "SELECT * FROM estudiante 
                  left join usuario on usuario.IdUsuario = estudiante.Usuario_IdUsuario WHERE Correo='" . $correo . "'";
        $estudiante = $this->getOnlyRow($sql_2);

        $sql_3 = "SELECT * FROM empleado 
                  left join usuario on usuario.IdUsuario = empleado.Usuario_IdUsuario WHERE Correo='" . $correo . "'";
        $empleado = $this->getOnlyRow($sql_3);

        if (count($docente) > 0) {
            $query = $docente;
        }
        if (count($estudiante) > 0) {
            $query = $estudiante;
        }
        if (count($empleado) > 0) {
            $query = $empleado;
        }
        
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
