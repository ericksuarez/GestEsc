<?php

/**
 * Description of Curricular_model
 *
 * @author esuarez
 */
class Curricular_model extends CI_Model {
    
    var $IDHorario;

    function __construct() {
        parent::__construct();
    }
    
    public function getHorario($grado,$grupo,$turno) {
        $sql = "select concat(g.Grado,' - ',g.Grupo) as Grado,t.IDTurno,h.Dia,h.Hora,m.IDMateria,m.Nombre,m.EsExtra ,
                group_concat(concat(d.Nombre,' ',d.APaterno,' ',d.AMaterno),'') as Docentes,
                group_concat(e.IDExp,'') as Expedientes 
                from horario as h
                left join grado as g on g.IDGrado = h.Grado_IDGrado
                left join turno as t on t.IDTurno = h.Turno_IDTurno
                left join materia as m on m.IDMateria = h.IDMateria
                left join grado_materia_docente as gmd on gmd.Materia_IDMateria = h.IDMateria and gmd.Turno_IDTurno = h.Turno_IDTurno
                left join docente as d on d.IDDocente = gmd.Docente_IDDocente
                left join expediente as e on e.Usuario_IDUsuario = d.Usuario_IdUsuario
                where g.Grado = ".$grado." and g.Grupo = '".$grupo."' and t.IDTurno = '".$turno."'
                group by  h.Dia,h.Hora,m.Nombre
                order by h.Dia, h.Hora asc";
        return $this->getQuery($sql);
    }

    /*
     * Inserta el Grupo las Maeria el Docente que las imparte y el Turno
     */

    public function InsMapaCurricular($IDGrado, $IDMateria, $IDDocente, $IDTurno) {
        $data = array(
            "Grado_IDGrado" => $IDGrado,
            "Materia_IDMateria" => $IDMateria,
            "Docente_IDDocente" => $IDDocente,
            "Turno_IDTurno" => $IDTurno
        );
        $this->db->insert('grado_materia_docente', $data);
    }
    
     public function InsHorario($IDGrado,$IDTurno,$IDMateria,$Dia,$Hora) {
        $data = array(
            "Grado_IDGrado" => $IDGrado,
            "Turno_IDTurno" => $IDTurno,
            "IDMateria" => $IDMateria,
            "Dia" => $Dia,
            "Hora" => $Hora
        );
        $this->db->insert('horario', $data);
        $this->setIDHorario($this->db->insert_id());
    }

    /*
     * Actualiza el Grupo las Maeria el Docente que las imparte y el Turno
     */

    public function UpdMapaCurricular($IDGrado, $IDMateria, $IDDocente, $IDTurno) {
        $data = array(
            "Grado_IDGrado" => $IDGrado,
            "Materia_IDMateria" => $IDMateria,
            "Docente_IDDocente" => $IDDocente,
            "Turno_IDTurno" => $IDTurno
        );
        $this->db->where(array(
            "Grado_IDGrado" => $IDGrado,
            "Materia_IDMateria" => $IDMateria,
            "Docente_IDDocente" => $IDDocente,
            "Turno_IDTurno" => $IDTurno
        ));
        $this->db->update('grado_materia_docente', $data);
    }
    
    public function UpdHorario($IDGrado,$IDTurno,$IDMateria,$Hora,$dia) {
        $data = array(
            "IDHorario" => $this->getIDHorario(),
            "Grado_IDGrado" => $IDGrado,
            "Turno_IDTurno" => $IDTurno,
            $dia."Mat" => $IDMateria,
            $dia."Hrs" => $Hora
        );
        $this->db->where(array(
            "IDHorario" => $this->getIDHorario(),
            "Grado_IDGrado" => $IDGrado,
            "Turno_IDTurno" => $IDTurno,
        ));
        $this->db->update('horario', $data);
    }

/*
 * Funciones especiales para le mapa curricular
 */
    public function isRegistrada($IDGrado, $IDMateria, $IDDocente, $IDTurno) {
        $sql = "select * from grado_materia_docente where 
                Grado_IDGrado= " . $IDGrado .
                " and Materia_IDMateria = " . $IDMateria .
                " and Docente_IDDocente= " . $IDDocente .
                " and Turno_IDTurno = '" . $IDTurno . "'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function eliminaRegistradas($IDGrado, $IDMateria, $IDTurno) {
        $sql = "delete from grado_materia_docente where 
                Grado_IDGrado= " . $IDGrado .
                " and Materia_IDMateria = " . $IDMateria .
                " and Turno_IDTurno = '" . $IDTurno . "'";
        $query = $this->db->query($sql);
    }

    public function getTurnos($IDTurno) {
        $sql = "select * from turno where IDTurno = '" . $IDTurno . "'";
        return $this->getOnlyRow($sql);
    }
    
    public function getSumaHoras($Hora,$Campo_Valor='DuracionClase',$IDTurno) {
        $sql = "SELECT ADDTIME('".$Hora."', ".$Campo_Valor.") as Hora FROM turno WHERE IDTurno = '".$IDTurno."'";
        return $this->getOnlyRow($sql);
    }
    
    public function getNumClasesPorTurno($IDTurno) {
        $sql = "SELECT (TIME_TO_SEC(SEC_TO_TIME( TIME_TO_SEC(HoraFinClases) - TIME_TO_SEC(HoraInicioClases) - TIME_TO_SEC(`DuracionReceso`))) / 60) / (TIME_TO_SEC(DuracionClase) / 60) as NumClases FROM `turno` WHERE IDTurno ='".$IDTurno."'";
        return $this->getOnlyRow($sql);
    }
    
    public function getNumClases($HoraIni,$HoraFin) {
        $sql = "SELECT HOUR(SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF('".$HoraIni."','".$HoraFin."'))))) AS numClases";
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

    function getIDHorario() {
        return $this->IDHorario;
    }

    function setIDHorario($IDHorario) {
        $this->IDHorario = $IDHorario;
    }

    public function getEncuestaPesoPercentual($IDDocente,$porcentaje,$tipo) {
        $sql = "select (SUM(er.Respuesta) * (".$porcentaje."/(COUNT(er.IDEncRes)*4))) as PP,er.Comentario 
                from encuesta_resuelta as er
                left join encuesta as e on e.IDEncuesta=er.Pregunta
                where e.Tipo='".$tipo."' and er.IDDocente= ".$IDDocente.
                " group by er.IDUsuario";
        return $this->getQuery($sql);
    }
}
