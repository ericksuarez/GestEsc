<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Events_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set("Europe/Madrid");
    }

    /**
     * @desc - añade un nuevo evento
     * @access public
     * @author Iparra
     * @return bool
     */
    public function add() {
        $this->db->set("start", $this->_formatDate($this->input->post("from")));
        $this->db->set("fechaIni", $this->input->post("from"));
        $this->db->set("end", $this->_formatDate($this->input->post("to")));
        $this->db->set("fechaFin", $this->input->post("to"));
        $this->db->set("url", $this->input->post("url"));
        $this->db->set("title", $this->input->post("title"));
        $this->db->set("body", $this->input->post("event"));
        $this->db->set("class", $this->input->post("class"));
        if ($this->db->insert("events")) {
            return $this->db->insert_id();
        }
        return FALSE;
    }

    /**
     * @desc - obtiene todos los registros de events
     * @access public
     * @author Iparra
     * @return object
     */
    public function getAll() {
        $query = $this->db->get('events');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return object();
    }

    /**
     * @desc - formatea una fecha a microtime para añadir al evento tipo 1401517498985
     * @access private
     * @author Iparra
     * @return strtotime
     */
    private function _formatDate($date) {
        return strtotime(substr($date, 6, 4) . "-" . substr($date, 3, 2) . "-" . substr($date, 0, 2) . " " . substr($date, 10, 6)) * 1000;
    }
    
    public function getDescripcion($id) {
        $sql = 'select * from events where id ='.$id;
        return $this->getOnlyRow($sql);
    }
    
    public function editar($post) {
        $sql = "UPDATE events SET 
                id='".$post['ID']."',
                title='".$post['title']."',
                body='".$post['event']."',
                url='".$post['url']."',
                class='".$post['class']."',
                start='".$this->_formatDate($post['from'])."',
                end='".$this->_formatDate($post['to'])."',
                fechaIni='".$post['fechaIni']."',
                fechaFin='".$post['fechaFin']."' 
                WHERE id=".$post['ID'];
        $this->db->query($sql);
        return true;
    }
    
    public function eliminar($post) {
        $sql = "DELETE FROM events WHERE id=".$post['ID'];
        $this->db->query($sql);
        return true;
    }
    
    public function last_IDEvent() {
        $sql = "select (id + 1) as ultimo from events order by id desc limit 1";
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
            $array = array(0);
        }
        return $array[0];
    }

}
