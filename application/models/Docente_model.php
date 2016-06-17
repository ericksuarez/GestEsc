<?php

/**
 * Description of Docente_model
 *
 * @author Erick Suarez
 */
class Docente_model extends CI_Model {

    var $IDDireccion;
    var $IDDocenteUsuario;
    var $IDDocente;
    var $Documentacion_IDDoc;
    var $IDTipoUsuario;

    function __construct() {
        parent::__construct();
        $this->IDTipoUsuario = 2;
    }

    public function getMaterias($Docente_IDDocente) {
        $sql = "select * from docente_has_materia as dm
                left join materia as m on m.IDMateria = dm.Materia_IDMateria
                where dm.Docente_IDDocente =" . $Docente_IDDocente;
        return $this->getQuery($sql);
    }

    public function getGrupos($Docente_IDDocente) {
        $sql = "select distinct gmd.Grado_IDGrado,g.* from grado_materia_docente as gmd
                left join grado as g on g.IDGrado = gmd.Grado_IDGrado
                where gmd.Docente_IDDocente = " . $Docente_IDDocente;
        return $this->getQuery($sql);
    }

    public function getDocentesGrupo($IDGrupo) {
        $sql = "SELECT distinct g.Docente_IDDocente,d.* FROM grado_materia_docente as g
                left join docente as d on d.IDDocente = Docente_IDDocente 
                where Grado_IDGrado =  " . $IDGrupo;
        return $this->getQuery($sql);
    }

    public function getMateriasDocente($IDDocente) {
        $sql = "SELECT * FROM grado_materia_docente as gmd
                left join materia as m on m.IDMateria = gmd.Materia_IDMateria
                where gmd.Docente_IDDocente = " . $IDDocente;
        return $this->getQuery($sql);
    }

    /*     * **************************************************************************
     *  Fucniones para Insertar la informacion de un Docente en la DB.	*
     * ************************************************************************* */

    public function InsDireccion($post) {
        $data = array(
            "Calle" => $post["Ecalle"],
            "NumInt" => $post["Enumint"],
            "NumExt" => $post["Enumext"],
            "PTelefono" => $post["Doficina"],
            "PCelular" => $post["Dcel"],
            "MTelefono" => "",
            "MCelular" => "",
            "Colonia_IDColonia" => $post["idcol"],
            "Colonia_CodPostal" => $post["idcodpost"],
            "DelMun_IDDelMun" => $post["iddelmun"],
            "Estado_IDEstado" => $post["idEdo"],
            "Pais_IDPais" => $post["idPais"]
        );
        $this->db->insert('direccion', $data);
        $IDDireccion = $this->db->insert_id();
        $this->setIDDireccion($IDDireccion);
    }

    public function InsUsuarioDocente($post) {
        $data = array(
            "TipoUsuario_IDTipoUsuario" => $this->IDTipoUsuario,
            "ClaveUsuario" => $post["Ecurp"]
        );
        $this->db->insert('usuario', $data);
        $IDDocenteUsuario = $this->db->insert_id();
        $this->setIDDocenteUsuario($IDDocenteUsuario);
    }

    public function InsDocente($post) {
        $data = array(
            "Nombre" => $post["Enombre"],
            "APaterno" => $post["Eapaterno"],
            "AMaterno" => $post["Eamaterno"],
            "FecNac" => FecFormato($post["Efecnac"]),
            "CURP" => $post["Ecurp"],
            "Enfermedad" => $post["Edisca"],
            "Correo" => $post["Ecorreo"],
            "Sexo" => $post["Esexo"],
            "EscProcedencia" => $post["Eescprod"],
            "Direccion_IDDireccion" => $this->getIDDireccion(),
            "Usuario_IdUsuario" => $this->getIDDocenteUsuario(),
            "Turno_IDTurno" => $post["Eturno"],
            "Observacion" => $post["Eobserva"]
        );
        $this->db->insert('docente', $data);
        $IDDocente = $this->db->insert_id();
        $this->setIDDocente($IDDocente);
    }

    public function InsMateria($post, $IDMateria) {
        $data = array(
            "Docente_IDDocente" => $this->getIDDocente(),
            "Docente_Turno_IDTurno" => $post["Eturno"],
            "Materia_IDMateria" => $IDMateria,
        );
        $this->db->insert('docente_has_materia', $data);
    }

    public function InsExpediente($post) {
        $data = array(
            "Usuario_IDUsuario" => $this->getIDDocenteUsuario(),
            "DescntoColegiatura" => 0,
        );
        $this->db->insert('expediente', $data);
        $IDExp = $this->db->insert_id();
        return $IDExp;
    }

    /*     * **************************************************************************
     * Fucniones para Actualizar la informacion de un Docente en la DB.	*
     * ************************************************************************** */

    public function UpdDireccion($post, $IDDireccion) {
        $data = array(
            "Calle" => $post["Ecalle"],
            "NumInt" => $post["Enumint"],
            "NumExt" => $post["Enumext"],
            "PTelefono" => $post["Doficina"],
            "PCelular" => $post["Dcel"],
            "MTelefono" => "",
            "MCelular" => "",
            "Colonia_IDColonia" => $post["idcol"],
            "Colonia_CodPostal" => $post["idcodpost"],
            "DelMun_IDDelMun" => $post["iddelmun"],
            "Estado_IDEstado" => $post["idEdo"],
            "Pais_IDPais" => $post["idPais"]
        );
        $this->db->where('IDDireccion', $IDDireccion);
        $this->db->update('direccion', $data);
    }

    public function UpdUsuarioDocente($post, $IdUsuario) {
        $data = array(
            "ClaveUsuario" => $post["Ecurp"],
            "Contrasena" => $post["Econtrasena"]
        );
        $this->db->where('IdUsuario', $IdUsuario);
        $this->db->update('usuario', $data);
    }

    public function UpdDocente($post, $IDDocente, $IDDireccion, $IDUsuario) {
        $data = array(
            "Nombre" => $post["Enombre"],
            "APaterno" => $post["Eapaterno"],
            "AMaterno" => $post["Eamaterno"],
            "FecNac" => FecFormato($post["Efecnac"]),
            "CURP" => $post["Ecurp"],
            "Enfermedad" => $post["Edisca"],
            "Correo" => $post["Ecorreo"],
            "Sexo" => $post["Esexo"],
            "EscProcedencia" => $post["Eescprod"],
            "Direccion_IDDireccion" => $IDDireccion,
            "Usuario_IdUsuario" => $IDUsuario,
            "Turno_IDTurno" => $post["Eturno"],
            "Observacion" => $post["Eobserva"]
        );
        $this->db->where('IDDocente', $IDDocente);
        $this->db->update('docente', $data);
    }

    public function UpdGrupo($post, $IDGrupo) {
        $data = array(
            "Grado_IDGrado" => $post["Egrupo"]
        );
        $this->db->where('IDGrupo', $IDGrupo);
        $this->db->update('grupo', $data);
    }

    public function UpdMateria($post, $IDDocente, $IDMateria) {
        $data = array(
            "Docente_IDDocente" => $IDDocente,
            "Docente_Turno_IDTurno" => $post["Eturno"],
            "Materia_IDMateria" => $IDMateria,
        );
        $this->db->where(array('Docente_IDDocente' => $IDDocente,
            "Docente_Turno_IDTurno" => $post["Eturno"],
            "Materia_IDMateria" => $IDMateria));
        $this->db->update('docente_has_materia', $data);
    }

    public function UpdExpediente($post, $IDExp, $Usuario_IDUsuario) {
        $data = array(
            "Inscrito" => 1, //
            "PromedioGral" => 0,
        );
        $this->db->update('expediente', $data, array(
            'IDExp' => $IDExp,
            'Usuario_IDUsuario' => $Usuario_IDUsuario));
    }

    public function ExisteMateria($IDDocente, $IDMateria) {
        $sql = "SELECT * FROM docente_has_materia 
                WHERE Docente_IDDocente = " . $IDDocente . "
                AND Materia_IDMateria = " . $IDMateria;
        $array = $this->getOnlyRow($sql);
        return count($array) > 1 ? TRUE : FALSE;
    }

    public function encuesta() {
        $sql = "select * from encuesta";
        return $this->getQuery($sql);
    }

    public function InsEncuestaResuelta($IDDocente, $Pregunta, $Respuesta, $Comentario) {
        $data = array(
            "IDDocente" => $IDDocente,
            "IDUsuario" => $this->session->userdata('IdUsuario'),
            "Pregunta" => $Pregunta,
            "Respuesta" => $Respuesta,
            "Comentario" => $Comentario,
        );
        $this->db->insert('encuesta_resuelta', $data);
        return $this->db->insert_id();
    }

    /*     * **************************************************************************
     * Fucniones Getter y Setter de la clase.                                   *					     *
     * ************************************************************************** */

    function getIDDireccion() {
        return $this->IDDireccion;
    }

    function getIDDocenteUsuario() {
        return $this->IDDocenteUsuario;
    }

    function getIDDocente() {
        return $this->IDDocente;
    }

    function getDocumentacion_IDDoc() {
        return $this->Documentacion_IDDoc;
    }

    function setIDDireccion($IDDireccion) {
        $this->IDDireccion = $IDDireccion;
    }

    function setIDDocenteUsuario($IDDocenteUsuario) {
        $this->IDDocenteUsuario = $IDDocenteUsuario;
    }

    function setIDDocente($IDDocente) {
        $this->IDDocente = $IDDocente;
    }

    function setDocumentacion_IDDoc($Documentacion_IDDoc) {
        $this->Documentacion_IDDoc = $Documentacion_IDDoc;
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
            $array = array(0);
        }
        return $array[0];
    }

}
