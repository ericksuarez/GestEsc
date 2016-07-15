<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Events extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Events_model", "evento");
        $this->load->library('form_validation');
        Acceso::TieneSesionActiva();
    }

    public function index() {
        $this->load->view('calendar/header_calendar');
        $this->load->view("calendar/add_event");
    }

    public function save() {
        $this->form_validation->set_rules('from', 'Fecha Desde', 'trim|required');
        $this->form_validation->set_rules('to', 'Fecha Hasta', 'trim|required');
//        $this->form_validation->set_rules('url', 'Url', 'trim|required');
        $this->form_validation->set_rules('title', 'Título Cita', 'trim|required');
        $this->form_validation->set_rules('event', 'Evento', 'trim|required');
        $this->form_validation->set_rules('class', 'Tipo de evento', 'trim|required');
        $this->form_validation->set_message('required', 'El  %s es requerido');
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $result = $this->evento->last_IDEvent();
            $result['ultimo'] = empty($result['ultimo']) ? 1 : $result['ultimo'];
            $_POST['url'] = base_url() . 'index.php/events/render/' . $result['ultimo'];
            $id = $this->evento->add();
            redirect("calendar/agenda");
        }
    }

    public function getAll() {
        if ($this->input->is_ajax_request()) {
            $events = $this->evento->getAll();
            echo json_encode(
                    array(
                        "success" => 1,
                        "result" => $events
                    )
            );
        }
    }

    public function render($id = 0) {
        if ($id != 0) {
            $data['info'] = $this->evento->getDescripcion($id);
            $this->load->view("calendar/ver_event", $data);
        }
    }

    public function editar() {
        $post = $this->input->post();
        $this->evento->editar($post);
        $data['info'] = $this->evento->getDescripcion($post['ID']);
        $this->load->view("calendar/ver_event", $data);
    }

    public function eliminar() {
        $post = $this->input->post();
        $this->evento->eliminar($post);
        echo '<div style=" border:1px="" solid="" #990000;padding-left:20px;margin:0="" 0="" 10px="" 0;"="">
                <h4>El EVENTO se elimino correctamente.</h4>
                <p>Sugerencia: Para seguir trabajando, por favor cierra esta ventana.</p>
              </div>';
    }

}
