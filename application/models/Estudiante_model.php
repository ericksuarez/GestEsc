<?php

/**
 * Description of Estudiante_model
 *
 * @author Erick Suarez
 */
class Estudiante_model extends CI_Model {

    var $IDDireccion;
    var $IDEstudianteUsuario;
    var $IDEstudiante;
    var $IDPadreUsuario;
    var $IDMadreUsuario;
    var $Documentacion_IDDoc;

    function __construct() {
        parent::__construct();
    }

    /*     * **************************************************************************
     *  Fucniones para Insertar la informacion de un estudiante en la DB.	*
     * ************************************************************************* */

    public function InsDireccion($post) {
        $data = array(
            "Calle" => $post["Ecalle"],
            "NumInt" => $post["Enumint"],
            "NumExt" => $post["Enumext"],
            "PTelefono" => $post["Poficina"],
            "PCelular" => $post["Pcel"],
            "MTelefono" => $post["Moficina"],
            "MCelular" => $post["Mcel"],
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

    public function InsUsuarioEstudiante($post) {
        $data = array(
            "TipoUsuario_IDTipoUsuario" => 1,
            "ClaveUsuario" => $post["Ematricula"]
        );
        $this->db->insert('usuario', $data);
        $IDEstudianteUsuario = $this->db->insert_id();
        $this->setIDEstudianteUsuario($IDEstudianteUsuario);
        return $IDEstudianteUsuario;
    }

    public function InsEstudiante($post) {
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
            "Promedio" => $post["Epromedio"],
            "Matricula" => $post["Ematricula"],
            "Direccion_IDDireccion" => $this->getIDDireccion(),
            "Usuario_IdUsuario" => $this->getIDEstudianteUsuario(),
            "Turno_IDTurno" => $post["Eturno"],
            "Observacion" => $post["Eobserva"]
        );
        $this->db->insert('estudiante', $data);
        $IDEstudiante = $this->db->insert_id();
        $this->setIDEstudiante($IDEstudiante);
        return $IDEstudiante;
    }

    public function InsGrupo($post) {
        $data = array(
            "Grado_IDGrado" => $post["Egrupo"],
            "Estudiante_IDEstudiante" => $this->getIDEstudiante()
        );
        $this->db->insert('grupo', $data);
    }

    public function InsUsuarioPadre($post) {
        $data = array(
            "TipoUsuario_IDTipoUsuario" => 3,
            "ClaveUsuario" => $post["Pcurp"]
        );
        $this->db->insert('usuario', $data);
        $IDPadreUsuario = $this->db->insert_id();
        $this->setIDPadreUsuario($IDPadreUsuario);
    }

    public function InsPadreFam($post) {
        $data = array(
            "Nombre" => $post["Pnombre"],
            "APaterno" => $post["Papaterno"],
            "AMaterno" => $post["Pamaterno"],
            "FecNac" => FecFormato($post["Pfecnac"]),
            "CURP" => $post["Pcurp"],
            "Enfermedad" => $post["Pdisca"],
            "Correo" => $post["Pcorreo"],
            "Sexo" => $post["Psexo"],
            "Trabaja" => isset($post["Ptrabaja"]) ? 1 : 0,
            "IngMensual" => $post["Pingreso"],
            "Profesion" => $post["Pprofesion"],
            "EsTutor" => isset($post["Ptutor"]) ? 1 : 0,
            "Estudiante_IDEstudiante" => $this->getIDEstudiante(),
            "Direccion_IDDireccion" => $this->getIDDireccion(),
            "Usuario_IdUsuario" => $this->getIDPadreUsuario(),
            "Observacion" => $post["Pobserva"]
        );
        $this->db->insert('padresfam', $data);
        $IDPadFam = $this->db->insert_id();
        return $IDPadFam;
    }

    public function InsUsuarioMadre($post) {
        $data = array(
            "TipoUsuario_IDTipoUsuario" => 3,
            "ClaveUsuario" => $post["Mcurp"]
        );
        $this->db->insert('usuario', $data);
        $IDMadreUsuario = $this->db->insert_id();
        $this->setIDMadreUsuario($IDMadreUsuario);
        return $IDMadreUsuario;
    }

    public function InsMadreFam($post) {
        $data = array(
            "Nombre" => $post["Mnombre"],
            "APaterno" => $post["Mapaterno"],
            "AMaterno" => $post["Mamaterno"],
            "FecNac" => FecFormato($post["Mfecnac"]),
            "CURP" => $post["Mcurp"],
            "Enfermedad" => $post["Mdisca"],
            "Correo" => $post["Mcorreo"],
            "Sexo" => $post["Msexo"],
            "Trabaja" => isset($post["Mtrabaja"]) ? 1 : 0,
            "IngMensual" => $post["Mingreso"],
            "Profesion" => $post["Mprofesion"],
            "EsTutor" => isset($post["Mtutor"]) ? 1 : 0,
            "Estudiante_IDEstudiante" => $this->getIDEstudiante(),
            "Direccion_IDDireccion" => $this->getIDDireccion(),
            "Usuario_IdUsuario" => $this->getIDMadreUsuario(),
            "Observacion" => $post["Mobserva"]
        );
        $this->db->insert('padresfam', $data);
        $IDMadFam = $this->db->insert_id();
        return $IDMadFam;
    }

    public function InsExpediente($post) {
        $data = array(
            "Usuario_IDUsuario" => $this->getIDEstudianteUsuario(),
            "DescntoColegiatura" => $post["Edescuento"],
        );
        $this->db->insert('expediente', $data);
        $IDExp = $this->db->insert_id();
        return $IDExp;
    }

    /*     * **************************************************************************
     * Fucniones para Actualizar la informacion de un estudiante en la DB.	*
     * ************************************************************************** */

    public function UpdDireccion($post, $IDDireccion) {
        $data = array(
            "Calle" => $post["Ecalle"],
            "NumInt" => $post["Enumint"],
            "NumExt" => $post["Enumext"],
            "PTelefono" => $post["Poficina"],
            "PCelular" => $post["Pcel"],
            "MTelefono" => $post["Moficina"],
            "MCelular" => $post["Mcel"],
            "Colonia_IDColonia" => $post["idcol"],
            "Colonia_CodPostal" => $post["idcodpost"],
            "DelMun_IDDelMun" => $post["iddelmun"],
            "Estado_IDEstado" => $post["idEdo"],
            "Pais_IDPais" => $post["idPais"]
        );
        $this->db->where('IDDireccion', $IDDireccion);
        $this->db->update('direccion', $data);
    }

    public function UpdUsuarioEstudiante($post, $IdUsuario) {
        $data = array(
            "ClaveUsuario" => $post["Ematricula"],
            "Contrasena" => $post["Econtrasena"]
        );
        $this->db->where('IdUsuario', $IdUsuario);
        $this->db->update('usuario', $data);
    }

    public function UpdEstudiante($post, $IDEstudiante, $IDDireccion, $IDUsuario) {
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
            "Promedio" => $post["Epromedio"],
            "Matricula" => $post["Ematricula"],
            "Direccion_IDDireccion" => $IDDireccion,
            "Usuario_IdUsuario" => $IDUsuario,
            "Turno_IDTurno" => $post["Eturno"],
            "Observacion" => $post["Eobserva"]
        );
        $this->db->where('IDEstudiante', $IDEstudiante);
        $this->db->update('estudiante', $data);
    }

    public function UpdGrupo($post, $IDGrupo) {
        $data = array(
            "Grado_IDGrado" => $post["Egrupo"]
        );
        $this->db->where('IDGrupo', $IDGrupo);
        $this->db->update('grupo', $data);
    }

    public function UpdUsuarioPadre($post, $IdUsuario) {
        $data = array(
            "ClaveUsuario" => $post["Ecurp"],
            "Contrasena" => $post["Econtrasena"]
        );
        $this->db->where('IdUsuario', $IdUsuario);
        $this->db->update('usuario', $data);
    }

    public function UpdPadreFam($post, $IDFamPad, $IDEstudiante, $IDDireccion, $IDUsuario) {
        $data = array(
            "Nombre" => $post["Pnombre"],
            "APaterno" => $post["Papaterno"],
            "AMaterno" => $post["Pamaterno"],
            "FecNac" => FecFormato($post["Pfecnac"]),
            "CURP" => $post["Pcurp"],
            "Enfermedad" => $post["Pdisca"],
            "Correo" => $post["Pcorreo"],
            "Sexo" => $post["Psexo"],
            "Trabaja" => isset($post["Ptrabaja"]) ? 1 : 0,
            "IngMensual" => $post["Pingreso"],
            "Profesion" => $post["Pprofesion"],
            "EsTutor" => isset($post["Ptutor"]) ? 1 : 0,
            "Estudiante_IDEstudiante" => $IDEstudiante,
            "Direccion_IDDireccion" => $IDDireccion,
            "Usuario_IdUsuario" => $IDUsuario,
            "Observacion" => $post["Pobserva"]
        );
        $this->db->where('IDFamPad', $IDFamPad);
        $this->db->update('padresfam', $data);
    }

    public function UpdUsuarioMadre($post, $IdUsuario) {
        $data = array(
            "TipoUsuario_IDTipoUsuario" => 3,
            "ClaveUsuario" => $post["Mcurp"]
        );
        $this->db->where('IdUsuario', $IdUsuario);
        $this->db->update('usuario', $data);
    }

    public function UpdMadreFam($post, $IDFamPad, $IDEstudiante, $IDDireccion, $IDUsuario) {
        $data = array(
            "Nombre" => $post["Mnombre"],
            "APaterno" => $post["Mapaterno"],
            "AMaterno" => $post["Mamaterno"],
            "FecNac" => FecFormato($post["Mfecnac"]),
            "CURP" => $post["Mcurp"],
            "Enfermedad" => $post["Mdisca"],
            "Correo" => $post["Mcorreo"],
            "Sexo" => $post["Msexo"],
            "Trabaja" => isset($post["Mtrabaja"]) ? 1 : 0,
            "IngMensual" => $post["Mingreso"],
            "Profesion" => $post["Mprofesion"],
            "EsTutor" => isset($post["Mtutor"]) ? 1 : 0,
            "Estudiante_IDEstudiante" => $IDEstudiante,
            "Direccion_IDDireccion" => $IDDireccion,
            "Usuario_IdUsuario" => $IDUsuario,
            "Observacion" => $post["Mobserva"]
        );
        $this->db->where('IDFamPad', $IDFamPad);
        $this->db->update('padresfam', $data);
    }

    public function UpdExpediente($post, $IDExp, $Usuario_IDUsuario) {
        $data = array(
            "Inscrito" => IsNotDefault($post, "Einscrito"),
            "FecInscripcion" => IsNotDefault($post, "FecInscrito"),
            "DescBaja" => IsNotDefault($post, "DescBaja"),
            "DescntoColegiatura" => IsNotDefault($post, "DescntoColegiatura"),
            "PromedioGral" => IsNotDefault($post, "PromedioGral"),
        );
        $this->db->update('expediente', ToCleanData($data), array(
            'IDExp' => $IDExp,
            'Usuario_IDUsuario' => $Usuario_IDUsuario));
    }

    /*     * **************************************************************************
     * Fucniones de busqueda para los estudinates.                                   *					     *
     * ************************************************************************** */

    public function getInfoReinscripcion($IDExp) {
        $sql = "select * from expediente as ex
                left join usuario as u on u.IdUsuario = ex.Usuario_IDUsuario
                left join estudiante as es on es.Usuario_IdUsuario = u.IdUsuario
                left join grupo as g on g.Estudiante_IDEstudiante = es.IDEstudiante
                left join cuenta as c on c.IDEstudiante = es.IDEstudiante
                where ex.IDExp = " . $IDExp;
        return $this->getOnlyRow($sql);
    }

    public function Servicios($IDExp, $IDEstudiante, $IDServicio) {
        $data = array(
            "Expediente_IDExp" => $IDExp,
            "Usuario_IDUsuario" => $IDEstudiante,
            "Servicio_IDServicio" => $IDServicio
        );

        $sql = "SELECT * FROM serviciocontratado as sc
                LEFT join servicio as s on s.IDServicio = sc.Servicio_IDServicio
                WHERE Expediente_IDExp = " . $IDExp . "
                AND Usuario_IDUsuario= " . $IDEstudiante . "
                AND Servicio_IDServicio = " . $IDServicio;
        
        $query = $this->getQuery($sql);

        if (!empty($query)) {
            $this->db->update('serviciocontratado', $data, array(
                "Expediente_IDExp" => $IDExp,
                "Usuario_IDUsuario" => $IDEstudiante,
                "Servicio_IDServicio" => $IDServicio
            ));
        } else {
            $this->db->insert('serviciocontratado', $data);
            $query = $this->getQuery($sql);
        }
        
        return $query;
    }

    public function getKardex($IDEstudiante,$IDMateria) {
        $sql = "select *,TRUNCATE((sum(ec.Calificacion) / count(ec.Periodo_IDPeriodo)), 2) as Promedio 
                from grado_escolar as ge
                left join materia as m on m.GradoEsc_IDGradoEsc = ge.IDGradoEsc
                left join evaluacioncont as ec on ec.Materia_IDMateria = m.IDMateria
                where ec.Estudiante_IDEstudiante = ".$IDEstudiante." and ec.Materia_IDMateria = ".$IDMateria."
                group by ge.IDGradoEsc,ec.Materia_IDMateria
                order by ge.IDGradoEsc,ec.Periodo_IDPeriodo,m.Nombre";
        return $this->getQuery($sql);
    }
    
    public function getCalificaciones($IDEstudiante,$IDGradoEsc) {
        $sql = "SELECT * FROM evaluacioncont as ec
                left join materia as m on m.IDMateria = ec.Materia_IDMateria
                left join tareas as t on t.IDTareas = ec.Tareas_IDTareas
                left join periodo as p on p.IDPeriodo = ec.Periodo_IDPeriodo
                where ec.Estudiante_IDEstudiante = ".$IDEstudiante." and m.GradoEsc_IDGradoEsc = ".$IDGradoEsc."
                group by ec.Periodo_IDPeriodo,ec.Tareas_IDTareas
                order by ec.Periodo_IDPeriodo,ec.Tareas_IDTareas";
        return $this->getQuery($sql);
    }
    
    public function getMateriasGradoEsc($GradoEsc) {
        $sql = "select * from grado_escolar as gc
                left join materia as m on m.GradoEsc_IDGradoEsc=gc.IDGradoEsc
                where gc.GradoEsc = ".$GradoEsc."
                order by gc.IDGradoEsc,m.Nombre";
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

    function getIDDireccion() {
        return $this->IDDireccion;
    }

    function getIDEstudianteUsuario() {
        return $this->IDEstudianteUsuario;
    }

    function getIDEstudiante() {
        return $this->IDEstudiante;
    }

    function getIDPadreUsuario() {
        return $this->IDPadreUsuario;
    }

    function getIDMadreUsuario() {
        return $this->IDMadreUsuario;
    }

    function setIDDireccion($IDDireccion) {
        $this->IDDireccion = $IDDireccion;
    }

    function setIDEstudianteUsuario($IDEstudianteUsuario) {
        $this->IDEstudianteUsuario = $IDEstudianteUsuario;
    }

    function setIDEstudiante($IDEstudiante) {
        $this->IDEstudiante = $IDEstudiante;
    }

    function setIDPadreUsuario($IDPadreUsuario) {
        $this->IDPadreUsuario = $IDPadreUsuario;
    }

    function setIDMadreUsuario($IDMadreUsuario) {
        $this->IDMadreUsuario = $IDMadreUsuario;
    }

    function getDocumentacion_IDDoc() {
        return $this->Documentacion_IDDoc;
    }

    function setDocumentacion_IDDoc($Documentacion_IDDoc) {
        $this->Documentacion_IDDoc = $Documentacion_IDDoc;
    }

}
