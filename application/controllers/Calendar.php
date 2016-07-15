<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        Acceso::TieneSesionActiva();
    }

    public function index() {
        $this->load->view('common/header');
        $this->load->view('home_view');
        $this->load->view('common/footer');
    }

    public function agenda() {
        $this->load->view('calendar/calendar');
    }

}
