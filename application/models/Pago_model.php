<?php
/**
 * Description of Pago_model
 *
 * @author esuarez
 */
class Pago_model extends CI_Model {
    
    var $IDPago;
    
     function __construct() {
        parent::__construct();
    }
    
    public function InsPago($post,$IDExp) {
        $data = array(
            "Expediente_IDExp" => $IDExp,
            "Descuento" => IsNotDefault($post,"Descuento"),
            "Recargo" => IsNotDefault($post,"Recargo"),
            "SubTotal" => IsNotDefault($post,"SubTotal"),
            "Total" => IsNotDefault($post,"Total")
        );
        $this->db->insert('pago', ToCleanData($data));
        $IDExpe = $this->db->insert_id();
        $this->setIDPago($IDExpe);
    }
    
    public function InsPagoDetalle($post,$IDExp,$IDServicio,$IDUnidad) {
        $data = array(
            "Pago_IDPago" => $this->getIDPago(),
            "Expediente_IDExp" => $IDExp,
            "Servicio_IDServicio" => $IDServicio,
            "Unidad_IDUnidad" => $IDUnidad,
            "Descuento" => IsNotDefault($post,"Descuento"),
            "Recargo" => IsNotDefault($post,"Recargo"),
            "SubTotal" => IsNotDefault($post,"SubTotal"),
            "Total" => IsNotDefault($post,"Total")
        );
        $this->db->insert('pago_has_servicio', ToCleanData($data));
        $IDExpe = $this->db->insert_id();
        return $IDExpe;
    }
    
    function getIDPago() {
        return $this->IDPago;
    }

    function setIDPago($IDPago) {
        $this->IDPago = $IDPago;
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
