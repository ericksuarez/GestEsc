<?php

/**
 * Description of ConsultaGral
 *
 * @author Erick Suarez Buendia 
 */
class ConsultaGral extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function InsUpdDocumentacion($IDExp, $full_path, $IDTipoDoc) {
        $data = array(
            "Expediente_IDExp" => $IDExp,
            "Entregado" => TRUE,
            "RutaDoc" => $full_path,
            "TipoDocumento_IDTipoDoc" => $IDTipoDoc
        );

        $sql = "select * from documentacion where Expediente_IDExp = " . $IDExp . " and TipoDocumento_IDTipoDoc = " . $IDTipoDoc;
        if (count($this->getOnlyRow($sql)) > 0) {
            $this->db->where(array('Expediente_IDExp'=>$IDExp,
                                   "TipoDocumento_IDTipoDoc" => $IDTipoDoc));
            $this->db->update('documentacion', $data);
        } else {
            $this->db->insert('documentacion', $data);
        }
    }

    public function getTipoUsuario($IDExp) {
        $sql = "select * from expediente
                left join usuario on IdUsuario = Usuario_IDUsuario
                left join tipousuario on IDTipoUsuario = TipoUsuario_IDTipoUsuario
                where IDExp =" . $IDExp;
        return $this->getOnlyRow($sql);
    }

    public function getIDsExp($IDExp) {
        $data['Estudiante'] = $this->getIDsEstudiante($IDExp);
        $data['Familia'] = $this->getIDsFamilia($data['Estudiante']['IDEstudiante']);
        return $data;
    }

    public function getIDsFamilia($IDEstudiante) {
        $sql = "select 
                u.TipoUsuario_IDTipoUsuario,p.IDFamPad,p.Direccion_IDDireccion,p.Usuario_IdUsuario 
                from padresfam as p
                left join  usuario as u on u.IdUsuario = p.Usuario_IdUsuario
                where  p.Estudiante_IDEstudiante = " . $IDEstudiante;
        return $this->getQuery($sql);
    }

    public function getIDsEstudiante($IDExp) {
        $sql = "select e.IDExp,e.Usuario_IDUsuario,u.TipoUsuario_IDTipoUsuario,es.IDEstudiante,es.Direccion_IDDireccion,g.IDGrupo,u.Contrasena 
                from expediente as e
                left join usuario as u on u.IdUsuario = e.Usuario_IDUsuario
                left join estudiante as es on es.Usuario_IdUsuario = u.IdUsuario
                left join grupo as g on g.Estudiante_IDEstudiante = es.IDEstudiante 
                where IDExp =" . $IDExp;
        return $this->getOnlyRow($sql);
    }

    public function getIDsDocente($IDExp) {
        $sql = "select e.IDExp,e.Usuario_IDUsuario,u.TipoUsuario_IDTipoUsuario,es.IDDocente,es.Direccion_IDDireccion,u.Contrasena 
                from expediente as e
                left join usuario as u on u.IdUsuario = e.Usuario_IDUsuario
                left join docente as es on es.Usuario_IdUsuario = u.IdUsuario
                where IDExp =" . $IDExp;
        return $this->getOnlyRow($sql);
    }

    public function getIDsEmpleado($IDExp) {
        $sql = "select e.IDExp,e.Usuario_IDUsuario,u.TipoUsuario_IDTipoUsuario,es.IDEmpleado,es.Direccion_IDDireccion,u.Contrasena 
                from expediente as e
                left join usuario as u on u.IdUsuario = e.Usuario_IDUsuario
                left join empleado as es on es.Usuario_IdUsuario = u.IdUsuario
                where IDExp =" . $IDExp;
        return $this->getOnlyRow($sql);
    }

    public function getIDsGrado($IDGrado = '') {
        $sql = "select * from grado as m where m.IDGrado = " . $IDGrado;
        return $this->getOnlyRow($sql);
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
