<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
        public function __construct() {
            parent::__construct();
            $this->load->library('correo');
            $this->load->model("ConsultaGral", "gral");
            $this->load->model("login_model", "login");
        }


        public function index()
	{
//             $this->load->view('common/header');
//		$this->load->view('welcome_message');
		$this->load->view('login');
//        $this->load->view('common/footer');
	}
        
        public function restablecer_contrasena() {
            
            $data['correo'] = $this->input->post('correo_restore');
            $info = $this->login->getUserPassword($data['correo']);
            $data['usuario'] = $info['ClaveUsuario'];
            $data['contrasena'] = $info['Contrasena'];
            
            $restorePass = new Correo();
            $restorePass->setPara($data['correo']);
            $restorePass->setAsunto("Solicitud de recuperación de contraseña.");
            $restorePass->setMensaje($this->load->view('recuperacion_password',$data,TRUE));
            $restorePass->enviar();
            
            $this->session->set_flashdata('exito', 'Se ha enviado la contraseña a su correo, '.$data['correo'].' favor de revisarlo.');
            redirect('login');
        
        }
}
