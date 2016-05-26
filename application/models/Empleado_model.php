<?php

/**
 * Description of Empleado_model
 *
 * @author Erick Suarez
 */
class Empleado_model extends CI_Model {

    var $IDDireccion;
    var $IDEmpleadoUsuario;
    var $IDEmpleado;
    var $Documentacion_IDDoc;
    var $IDTipoUsuario;

    function __construct() {
        parent::__construct();
        $this->IDTipoUsuario = 4;
    }


    /*     * **************************************************************************
     *  Fucniones para Insertar la informacion de un Empleado en la DB.	*
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

    public function InsUsuarioEmpleado($post) {
        $data = array(
            "TipoUsuario_IDTipoUsuario" => $this->IDTipoUsuario,
            "ClaveUsuario" => $post["Ecurp"]
        );
        $this->db->insert('usuario', $data);
        $IDEmpleadoUsuario = $this->db->insert_id();
        $this->setIDEmpleadoUsuario($IDEmpleadoUsuario);
    }

    public function InsEmpleado($post) {
        $data = array(
            "Nombre" => $post["Enombre"],
            "APaterno" => $post["Eapaterno"],
            "AMaterno" => $post["Eamaterno"],
            "FecNac" => FecFormato($post["Efecnac"]),
            "CURP" => $post["Ecurp"],
            "Correo" => $post["Ecorreo"],
            "Sexo" => $post["Esexo"],
            "Puesto" => $post["Epuesto"],
            "Direccion_IDDireccion" => $this->getIDDireccion(),
            "Usuario_IdUsuario" => $this->getIDEmpleadoUsuario(),
            "Turno_IDTurno" => $post["Eturno"],
            "Observacion" => $post["Eobserva"]
        );
        $this->db->insert('empleado', $data);
        $IDEmpleado = $this->db->insert_id();
        $this->setIDEmpleado($IDEmpleado);
    }

    public function InsExpediente($post) {
        $data = array(
            "Usuario_IDUsuario" => $this->getIDEmpleadoUsuario(),
            "DescntoColegiatura" => 0,
        );
        $this->db->insert('expediente', $data);
        $IDExp = $this->db->insert_id();
        return $IDExp;
    }

    /*     * **************************************************************************
     * Fucniones para Actualizar la informacion de un Empleado en la DB.	*
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

    public function UpdUsuarioEmpleado($post, $IdUsuario) {
        $data = array(
            "ClaveUsuario" => $post["Ecurp"],
            "Contrasena" => $post["Econtrasena"]
        );
        $this->db->where('IdUsuario', $IdUsuario);
        $this->db->update('usuario', $data);
    }

    public function UpdEmpleado($post, $IDEmpleado, $IDDireccion, $IDUsuario) {
        $data = array(
            "Nombre" => $post["Enombre"],
            "APaterno" => $post["Eapaterno"],
            "AMaterno" => $post["Eamaterno"],
            "FecNac" => FecFormato($post["Efecnac"]),
            "CURP" => $post["Ecurp"],
            "Correo" => $post["Ecorreo"],
            "Sexo" => $post["Esexo"],
            "Puesto" => $post["Epuesto"],
            "Direccion_IDDireccion" => $IDDireccion,
            "Usuario_IdUsuario" => $IDUsuario,
            "Turno_IDTurno" => $post["Eturno"],
            "Observacion" => $post["Eobserva"]
        );
        $this->db->where('IDEmpleado', $IDEmpleado);
        $this->db->update('empleado', $data);
    }

    public function UpdGrupo($post, $IDGrupo) {
        $data = array(
            "Grado_IDGrado" => $post["Egrupo"]
        );
        $this->db->where('IDGrupo', $IDGrupo);
        $this->db->update('grupo', $data);
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

    /*     * **************************************************************************
     * Fucniones Getter y Setter de la clase.                                   *					     *
     * ************************************************************************** */

    function getIDDireccion() {
        return $this->IDDireccion;
    }

    function getIDEmpleadoUsuario() {
        return $this->IDEmpleadoUsuario;
    }

    function getIDEmpleado() {
        return $this->IDEmpleado;
    }

    function getDocumentacion_IDDoc() {
        return $this->Documentacion_IDDoc;
    }

    function getIDTipoUsuario() {
        return $this->IDTipoUsuario;
    }

    function setIDDireccion($IDDireccion) {
        $this->IDDireccion = $IDDireccion;
    }

    function setIDEmpleadoUsuario($IDEmpleadoUsuario) {
        $this->IDEmpleadoUsuario = $IDEmpleadoUsuario;
    }

    function setIDEmpleado($IDEmpleado) {
        $this->IDEmpleado = $IDEmpleado;
    }

    function setDocumentacion_IDDoc($Documentacion_IDDoc) {
        $this->Documentacion_IDDoc = $Documentacion_IDDoc;
    }

    function setIDTipoUsuario($IDTipoUsuario) {
        $this->IDTipoUsuario = $IDTipoUsuario;
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
