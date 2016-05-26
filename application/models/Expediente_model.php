<?php

/**
 * Description of Expediente_model
 *
 * @author esuarez
 */
class Expediente_model extends CI_Model {

    public function getExpInfoGral($IDExp, $Usuario_IDUsuario) {

        $data = $this->existeRegistro($Usuario_IDUsuario);

        $sql = "select * from expediente as exp
                left join usuario as usr on usr.IdUsuario = exp.Usuario_IDUsuario
                left join " . $data['tabla'] . " as tab on tab.Usuario_IDUsuario = exp.Usuario_IDUsuario
			  " . $data['extsql'] . "
                where exp.IDExp = " . $IDExp;
        return $this->getOnlyRow($sql);
    }

    public function getExpInfoGralPadFam($IDEstudiante) {

        $sql = "select * from padresfam where  Estudiante_IDEstudiante = " . $IDEstudiante;
        return $this->getQuery($sql);
    }

    private function existeRegistro($Usuario_IDUsuario) {

        $tables = array("docente", "estudiante", "empleado");
        $data['tabla'] = "";
        $data['extsql'] = "";
        $ExisteRegistro = TRUE;

        foreach ($tables as $key => $value) {
            $sql = "select * from " . $value . " where Usuario_IDUsuario = " . $Usuario_IDUsuario;
            $array = $this->getQuery($sql);
            if (isset($array[0]) && $ExisteRegistro) {
                $ExisteRegistro = FALSE;
                switch ($value) {
                    case $tables[0]:
                        $data['tabla'] = $value;
                        $data['extsql'] = "";
                        break;
                    case $tables[1]:
                        $data['tabla'] = $value;
                        $data['extsql'] = "left join grupo as g on g.Estudiante_IDEstudiante = tab.IDEstudiante
                                           left join grado as gr on gr.IDGrado = g.Grado_IDGrado";
                        break;
                    case $tables[2]:
                        $data['tabla'] = $value;
                        $data['extsql'] = "";
                        break;
                    default:
                        $data['tabla'] = "";
                        $data['extsql'] = "";
                        break;
                }
            }
        }
        return $data;
    }

    private function buscaUserDir($IDExp) {
        
        $tablasBusca = getParametrosGenerales('TABLA');
        $tabla = "";
        
        foreach ($tablasBusca as $key => $value) { 
            $sql = "select * from expediente as e 
                left join ".$value['Recurso']." as c on c.Usuario_IdUsuario = e.Usuario_IDUsuario
                left join direccion as di on di.IDDireccion = c.Direccion_IDDireccion
                where e.IDExp = ".$IDExp;
            $array = $this->getQuery($sql);
            if(isset($array[0]['IDDireccion'])){
                 $tabla = $value['Recurso'];
            }
        }
        return $tabla;
        
    }
    
    public function getExpDir($IDExp) {
        
        $TablaBusca = $this->buscaUserDir($IDExp);
        
        $sql = "select dir.*,p.Nombre as pais, e.Nombre as estado, dm.Nombre as delMuni,c.Nombre as colonia 
                from expediente as exp
                left join ".$TablaBusca." as est on est.Usuario_IdUsuario = exp.Usuario_IDUsuario
                left join direccion as dir on dir.IDDireccion = est.Direccion_IDDireccion
                left join pais as p on p.IDPais = dir.Pais_IDPais
                left join estado as e on 
                e.Pais_IDPais = p.IDPais and 
                e.IDEstado = dir.Estado_IDEstado
                left join delmun as dm on 
                dm.Estado_Pais_IDPais = e.Pais_IDPais and 
                dm.Estado_IDEstado = e.IDEstado and 
                dm.IDDelMun = dir.DelMun_IDDelMun
                left join colonia as c on 
                c.DelMun_Estado_Pais_IDPais = dm.Estado_Pais_IDPais and 
                c.DelMun_Estado_IDEstado = dm.Estado_IDEstado and  
                c.DelMun_IDDelMun = dir.DelMun_IDDelMun and 
                c.IDColonia = dir.Colonia_IDColonia
                where exp.IDExp = " . $IDExp;
        return $this->getOnlyRow($sql);
    }

    public function getExpDocs($IDExp) {
        $sql = "select td.IDTipoDoc, td.NomDoc, docs.IDDoc, docs.RutaDoc, docs.FecSubida
                from  expediente as exp
                left join usuario as usr on usr.IdUsuario = exp.Usuario_IDUsuario
                left join tipousuario_has_tipodocumento as tt on tt.TipoUsuario_IDTipoUsuario = usr.TipoUsuario_IDTipoUsuario
                left join tipousuario as tu on tu.IDTipoUsuario = tt.TipoUsuario_IDTipoUsuario
                left join tipodocumento as td on td.IDTipoDoc = tt.TipoDocumento_IDTipoDoc
                left join documentacion as docs on docs.Expediente_IDExp = exp.IDExp and docs.TipoDocumento_IDTipoDoc = tt.TipoDocumento_IDTipoDoc
                where td.Activo=1 and td.EsUpload=1 and exp.IDExp =" . $IDExp;
        return $this->getQuery($sql);
    }
    
    public function getExpComprobante($IDTipoUsuario) {
        $sql = "select * from tipousuario_has_tipodocumento as tt
                left join tipodocumento as td on td.IDTipoDoc = tt.TipoDocumento_IDTipoDoc
                where tt.EsComprobante = 1 and  td.EsUpload=0 and tt.TipoUsuario_IDTipoUsuario = " . $IDTipoUsuario;
        return $this->getQuery($sql);
    }

    public function eliminaExpediente($IDExp) {
        $data = array(
            "Activo" => 0
        );
        $this->db->where('IDExp', $IDExp);
        $this->db->update('expediente', $data);
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
