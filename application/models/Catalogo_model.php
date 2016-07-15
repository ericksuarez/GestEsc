<?php

/**
 * Description of Catalogo_model
 *
 * @author Erick Suarez
 */
class Catalogo_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function Estudiantes($where = '') {
        $where = $where != '' ? 'and ' . $where : $where;
        $sql = "select *,concat(e.Nombre,' ',e.APaterno,' ',e.AMaterno) as NomCompleto, concat(gr.Grado,' - ',gr.Grupo) as GradoGrupo 
                from estudiante as e
                left join usuario as u on u.IdUsuario = e.Usuario_IdUsuario
                left join expediente as ex on ex.Usuario_IDUsuario = u.IdUsuario
                left join grupo as g on g.Estudiante_IDEstudiante = e.IDEstudiante
                left join grado as gr on gr.IDGrado = g.Grado_IDGrado
                where ex.Activo = 1 " . $where;
        return $this->getQuery($sql);
    }

    public function 
            Docentes($where = '') {
        $where = !empty($where) ? 'and ' . $where : $where;
        $sql = "select DISTINCT IDDocente,e.*,u.*,ex.*,
                SPACE(10) AS Materias,SPACE(10) AS Grupos,concat(e.Nombre,' ',e.APaterno,' ',e.AMaterno) as NomCompleto
                from docente as e
                left join usuario as u on u.IdUsuario = e.Usuario_IdUsuario
                left join expediente as ex on ex.Usuario_IDUsuario = u.IdUsuario
                left join grado_materia_docente as gmd on gmd.Docente_IDDocente = e.IDDocente
                left join docente_has_materia as dm on dm.Docente_IDDocente = e.IDDocente
                where ex.Activo = 1 " . $where;
        return $this->getQuery($sql);
    }

    public function Empleados($where = '') {
        $where = !empty($where) ? 'and ' . $where : $where;
        $sql = "select *,concat(e.Nombre,' ',e.APaterno,' ',e.AMaterno) as NomCompleto from empleado as e
                left join usuario as u on u.IdUsuario = e.Usuario_IdUsuario
                left join expediente as ex on ex.Usuario_IDUsuario = u.IdUsuario
                where ex.Activo = 1 " . $where;
        return $this->getQuery($sql);
    }

    public function CorreosEstudiantePadresFam($where = '') {
        $where = !empty($where) ? 'where ' . $where : $where;
        $sql = "select e.Correo,concat(e.Nombre,' ',e.APaterno,' ',e.AMaterno) as NomCompletoAlumno, 
                group_concat(concat(pf.Nombre,' ',pf.APaterno,' ',pf.AMaterno),'') as NomCompletoPadres,
                group_concat(concat(pf.Correo)) as Correos
                from estudiante as e
                left join padresfam as pf on pf.Estudiante_IDEstudiante=e.IDEstudiante
                left join grupo as g on g.Estudiante_IDEstudiante = e.IDEstudiante
                left join grado as gr on gr.IDGrado = g.Grado_IDGrado
                ".$where."
                group by e.IDEstudiante";
        return $this->getQuery($sql);
    }

    public function getPais($nombre) {
        $sql = "select IDPais as '#',Nombre from pais where Nombre like '%" . $nombre . "%'";
        return $this->getQuery($sql);
    }

    public function getEstado($nombre, $idPais) {
        $sql = "select IDEstado as '#',Nombre from estado where  Nombre like '%" . $nombre . "%' and Pais_IDPais = " . $idPais;
        return $this->getQuery($sql);
    }

    public function getCodPost($cp, $idPais, $idEdo) {
        $sql = "select colonia.*, delmun.Nombre as NomDelMun FROM colonia 
                        left join delmun on IDDelmun = DelMun_IDDelMun
                        WHERE CodPostal = '" . $cp . "' AND DelMun_Estado_IDEstado = " . $idEdo . " AND DelMun_Estado_Pais_IDPais = " . $idPais . "
                        AND Estado_IDEstado = " . $idEdo . " AND Estado_Pais_IDPais = " . $idPais . " 
                        order by nombre asc";
        return $this->getQuery($sql);
    }

    public function CatTurno() {
        $sql = "select IDTurno as 'index',Descripcion as opcion from turno where Estatus = 1";
        return $this->getQuery($sql);
    }

    public function CatGradoEsc() {
        $sql = "select GradoEsc as 'index',Descripcion as opcion from grado_escolar";
        return $this->getQuery($sql);
    }

    public function CatGrado($where = '') {
        $sql = "select IDGrado as 'index',CONCAT(Grado,' - ',Grupo) as opcion from grado " . $where;
        return $this->getQuery($sql);
    }

    public function CatGradoIndex($index = '', $where = '') {
        $index = !empty($index) ? $index : 'IDGrado';
        $sql = "select " . $index . " as 'index',CONCAT(Grado,' - ',Grupo) as opcion from grado " . $where;
        return $this->getQuery($sql);
    }

    public function CatMateria($where = '') {
        $sql = "select IDMateria as 'index',Nombre as opcion from materia " . $where;
        return $this->getQuery($sql);
    }

    public function CatDocentesPorMateria($IDTurno, $IDMateria) {
        $sql = "select d.IDDocente as 'index',concat(d.Nombre,' ',d.APaterno,' ',d.AMaterno) as opcion 
                from docente as d
                left join docente_has_materia as dm on dm.Docente_IDDocente = d.IDDocente
                where d.Turno_IDTurno = '" . $IDTurno . "' and dm.Materia_IDMateria = " . $IDMateria;
        return $this->getQuery($sql);
    }

    public function CatServicio() {
        $sql = "select IDServicio as 'index',Nombre as opcion,Precio from servicio";
        return $this->getQuery($sql);
    }

    public function ListaDocumentos($IDUsuario) {
        $sql = "select * from tipousuario_has_tipodocumento 
                    left join tipousuario on IDTipoUsuario = TipoUsuario_IDTipoUsuario
                    left join tipodocumento on IDTipoDoc = TipoDocumento_IDTipoDoc
                    where Activo=1 and IDTipoUsuario = " . $IDUsuario;
        return $this->getQuery($sql);
    }

    public function getTipoDoc($NomDoc) {
        $sql = "select IDTipoDoc,TipoUsuario_IDTipoUsuario from tipodocumento 
                left join tipousuario_has_tipodocumento on TipoDocumento_IDTipoDoc = IDTipoDoc
                where NomDoc = '" . str_replace("_", " ", $NomDoc) . "'";
        return $this->getOnlyRow($sql);
    }

    public function CatPeriodosEsc() {
        $sql = "select IDPeriodo as 'index',Descripcion as opcion from periodo";
        return $this->getQuery($sql);
    }

    public function CatTareas($where = '') {
        $sql = "select IDTareas as 'index',NomTarea as opcion from tareas " . $where;
        return $this->getQuery($sql);
    }

    public function CatTipoPlantilla($where = '') {
        $sql = "select IDTipoPlantilla as 'index',Descripcion as opcion from  tipo_plantilla " . $where;
        return $this->getQuery($sql);
    }
    
    public function CatTipoRespuestas($where = '') {
        $sql = "select IDTipoResp as 'index',Respuesta as opcion from  tipo_respuestas " . $where;
        return $this->getQuery($sql);
    }
    
    public function Docentes_x_Grupo($Grado_IDGrado) {
        $sql = "select *,concat(e.Nombre,' ',e.APaterno,' ',e.AMaterno) as NomCompleto
                from docente as e
                left join usuario as u on u.IdUsuario = e.Usuario_IdUsuario
                left join expediente as ex on ex.Usuario_IDUsuario = u.IdUsuario
                left join grado_materia_docente as gmd on gmd.Docente_IDDocente = e.IDDocente
                where ex.Activo = 1 and gmd.Grado_IDGrado= ".$Grado_IDGrado;
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
