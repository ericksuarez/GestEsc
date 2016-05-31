<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cobranza_model
 *
 * @author esuarez
 */
class Cobranza_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    public function cuentas($where = '') {
        $where = $where!='' ? 'and ' . $where : $where;
        $sql = "select *,sum(p.Total) as Saldo,concat(e.Nombre,' ',e.APaterno,' ',e.AMaterno) as NomEstudiante,
                concat(pf.Nombre,' ',pf.APaterno,' ',pf.AMaterno) as NomTutor
                from expediente as ex 
                left join estudiante as e on e.Usuario_IdUsuario = ex.Usuario_IDUsuario
                left join padresfam as pf on pf.Estudiante_IDEstudiante = e.IDEstudiante 
                left join pago as p on p.Expediente_IDExp = ex.IDExp
                left join grupo as g on g.Estudiante_IDEstudiante = e.IDEstudiante
                left join grado as gr on gr.IDGrado = g.Grado_IDGrado
                left join cuenta as c on c.IDEstudiante = e.IDEstudiante
                where ex.Activo=1 and pf.EsTutor = 1 ".$where."
                group by ex.IDExp";
        return $this->getQuery($sql);
    }
    
    public function debe($IDExp) {
        $sql = "select *,(sum(s.Precio) - ((sum(s.Precio) * ex.DescntoColegiatura) / 100)) as Debe 
                from serviciocontratado as sc 
                left join servicio as s on s.IDServicio = sc.Servicio_IDServicio
                left join expediente as ex on ex.IDExp = sc.Expediente_IDExp
                where sc.Expediente_IDExp = $IDExp";
        return $this->getQuery($sql);
    }
    
    public function detallesCuenta($IDExp) {
        $sql = "SELECT *,sum(s.Precio) as Debe FROM serviciocontratado as sc 
                left join servicio as s on s.IDServicio = sc.Servicio_IDServicio
                where sc.Expediente_IDExp = $IDExp";
        return $this->getQuery($sql);
    }
    
    public function allMovimientos($IDExp,$where='') {
        $sql = "SELECT *,(p.Total*0.16) as IVA FROM pago as p 
                where p.Expediente_IDExp = ". $IDExp ." ".$where." order by p.FecPago desc";
        return $this->getQuery($sql);
    }
    
    public function serviciosContratados($IDExp) {
        $sql = "SELECT *  FROM serviciocontratado as sc
                left join servicio as s on s.IDServicio = sc.Servicio_IDServicio
                WHERE sc.Expediente_IDExp = ". $IDExp;
        return $this->getQuery($sql);
    }
    
    public function detallesPago($IDExp,$IDPago) {
        $sql = "SELECT ps.*,se.*,u.*,(ps.Total*0.16) as IVA FROM pago as p 
                left join pago_has_servicio as ps on ps.Pago_IDPago = p.IDPago and ps.Expediente_IDExp = p.Expediente_IDExp
                left join servicio as se on se.IDServicio = ps.Servicio_IDServicio
                left join unidades as u on u.IDUnidad = ps.Unidad_IDUnidad
                where p.Expediente_IDExp = ".$IDExp."  and ps.Pago_IDPago = ".$IDPago;
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
