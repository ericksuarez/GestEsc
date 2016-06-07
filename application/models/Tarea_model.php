<?php

/**
 * Description of Estudiante_model
 *
 * @author Erick Suarez
 */
class Tarea_model extends CI_Model {

    var $IDEvaCont;

    function __construct() {
        parent::__construct();
    }

    public function InsTareaEvaCont($post) {
        $data = array(
            "Tareas_IDTareas" => IsNotDefault($post, "IDTareas"),
            "Materia_IDMateria" => IsNotDefault($post, "IDMateria"),
            "Docente_IDDocente" => IsNotDefault($post, "IDDocente"),
            "Estudiante_IDEstudiante" => IsNotDefault($post, "IDEstudiante"),
            "Periodo_IDPeriodo" => IsNotDefault($post, "IDPeriodo"),
            "Calificacion" => IsNotDefault($post, "Calificacion"),
            "FecEntregada" => IsNotDefault($post, "FecEntregada"),
            "Archivo" => IsNotDefault($post, "Archivo")
        );
        $this->db->insert('evaluacioncont', ToCleanData($data));
        $IDEvaCont = $this->db->insert_id();
        $this->setIDEvaCont($IDEvaCont);
        return $IDEvaCont;
    }

    public function UpdTareaEvaCont($post) {
        $data = array(
            "Tareas_IDTareas" => IsNotDefault($post, "IDTareas"),
            "Materia_IDMateria" => IsNotDefault($post, "IDMateria"),
            "Docente_IDDocente" => IsNotDefault($post, "IDDocente"),
            "Estudiante_IDEstudiante" => IsNotDefault($post, "IDEstudiante"),
            "Periodo_IDPeriodo" => IsNotDefault($post, "IDPeriodo"),
            "Calificacion" => IsNotDefault($post, "Calificacion"),
            "FecEntregada" => IsNotDefault($post, "FecEntregada"),
            "Archivo" => IsNotDefault($post, "Archivo")
        );
        $this->db->where(array(
            "Tareas_IDTareas" => IsNotDefault($post, "IDTareas"),
            "Materia_IDMateria" => IsNotDefault($post, "IDMateria"),
            "Docente_IDDocente" => IsNotDefault($post, "IDDocente"),
            "Estudiante_IDEstudiante" => IsNotDefault($post, "IDEstudiante"),
            "Periodo_IDPeriodo" => IsNotDefault($post, "IDPeriodo"),
        ));
        $this->db->update('evaluacioncont', $data);
    }

    public function InsUpdTareaEvaCont($post, $full_path) {
        $data = array(
            "Tareas_IDTareas" => IsNotDefault($post, "IDTareas"),
            "Materia_IDMateria" => IsNotDefault($post, "IDMateria"),
            "Docente_IDDocente" => IsNotDefault($post, "IDDocente"),
            "Estudiante_IDEstudiante" => IsNotDefault($post, "IDEstudiante"),
            "Periodo_IDPeriodo" => IsNotDefault($post, "IDPeriodo"),
            "Calificacion" => IsNotDefault($post, "Calificacion"),
            "FecEntregada" => IsNotDefault($post, "FecEntregada"),
            "Archivo" => IsNotDefault($post, "Archivo")
        );

        $sql = "SELECT *  FROM evaluacioncont
                WHERE Tareas_IDTareas = " . IsNotDefault($post, "IDTareas") . "
                AND Materia_IDMateria = " . IsNotDefault($post, "IDMateria") . " 
                AND Docente_IDDocente = " . IsNotDefault($post, "IDDocente") . " 
                AND Estudiante_IDEstudiante = " . IsNotDefault($post, "IDEstudiante") . " 
                AND Periodo_IDPeriodo = " . IsNotDefault($post, "IDPeriodo");

        if (count($this->getOnlyRow($sql)) > 0) {
            $this->db->where(array(
                "Tareas_IDTareas" => IsNotDefault($post, "IDTareas"),
                "Materia_IDMateria" => IsNotDefault($post, "IDMateria"),
                "Docente_IDDocente" => IsNotDefault($post, "IDDocente"),
                "Estudiante_IDEstudiante" => IsNotDefault($post, "IDEstudiante"),
                "Periodo_IDPeriodo" => IsNotDefault($post, "IDPeriodo"),
            ));
            $this->db->update('evaluacioncont', ToCleanData($data));
        } else {
            $this->db->insert('evaluacioncont', ToCleanData($data));
            $IDEvaCont = $this->db->insert_id();
            $this->setIDEvaCont($IDEvaCont);
            return $IDEvaCont;
        }
    }

    public function getTareasMateria($IDMateria, $IDTareas = 0) {
        $IDTarea = $IDTareas == 0 ? "" : "and t.IDTareas = " . $IDTareas;
        $sql = "SELECT *  FROM tareas as t
                LEFT JOIN recursotarea as rt on rt.Tareas_IDTareas=t.IDTareas
                left join materia as m on m.IDMateria=t.Materia_IDMateria
                left join grado as g on g.IDGrado=m.GradoEsc_IDGradoEsc
                WHERE t.Materia_IDMateria = " . $IDMateria . " " . $IDTarea . "
                order by t.FecEntrega asc";
        return $this->getQuery($sql);
    }

    public function getArchivoTarea($IDTareas, $IDMateria, $IDEstudiante, $IDPeriodo) {
        $archivo = "";
        $sql = "SELECT Archivo  FROM evaluacioncont
                WHERE Tareas_IDTareas = " . $IDTareas . "
                AND Materia_IDMateria = " . $IDMateria . " 
                AND Estudiante_IDEstudiante = " . $IDEstudiante . " 
                AND Periodo_IDPeriodo = " . $IDPeriodo;
        
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $array = $query->result_array();
            $archivo = $array[0]["Archivo"];
        } else {
            $archivo = "";
        }
        return $archivo;
    }

    public function notas($IDMateria,$IDGrado) {
        $sql = "SELECT * FROM notas as n
                left join materia as m on m.IDMateria=n.Materia_IDMateria
                left join grado_escolar as ge on ge.IDGradoEsc=n.Grado_IDGrado
                WHERE n.Materia_IDMateria= ".$IDMateria." and n.Grado_IDGrado= ".$IDGrado."
                order by n.Titulo";
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

    /*     * **************************************************************************
     * Fucniones Getter y Setter de la clase.                                   *					     *
     * ************************************************************************** */

    function getIDEvaCont() {
        return $this->IDEvaCont;
    }

    function setIDEvaCont($IDEvaCont) {
        $this->IDEvaCont = $IDEvaCont;
    }

}
