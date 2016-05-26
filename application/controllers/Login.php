<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('login_model', 'login');
    }

    public function index() {

        $post = $this->input->post();

        if ($this->form_validation->run('login') == FALSE) {
            $this->load->view('login');
        } else {
            if ($this->login->VerificaUsr($post['user'],$post['pass'])) {
                $this->getUserInfo($post);
                $this->session->set_flashdata('exito', 'Inicio de sesión, exitosa.');
                redirect('expediente');
            } else {
                $this->session->set_flashdata('error', 'El usuario y/o contraseña son incorrectos');
                $this->load->view('login');
            }
        }
    }
    
    private function getUserInfo($post) { 
        $data = $this->login->getUserInfo($post['user'],$post['pass']);
        $this->CargaDatosSesion($data);
    }
    
    private function CargaDatosSesion($data) {
        $nombre = $this->login->getNomUsuario($data['IdUsuario'],$data['TipoUsuario_IDTipoUsuario']);
        $usuario_data = array(
               'IdUsuario' => $data['IdUsuario'],
               'IDTipoUsuario' => $data['TipoUsuario_IDTipoUsuario'],
               'ClaveUsuario' => $data['ClaveUsuario'],
               'Contrasena' => $data['Contrasena'],
               'NomUsuario' => $nombre,
               'SesActiva' => TRUE,
               'Export' => ""
            );
            $this->session->set_userdata($usuario_data);
    }
    
    public function cerrar_sesion() {
      $usuario_data = array(
         'SesActiva' => FALSE
      );
      $this->session->set_userdata($usuario_data);
      $this->session->sess_destroy();
      redirect(base_url());
   }

}
