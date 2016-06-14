<?php

/**
 * Description of Correo
 *
 * @author Erick Suarez Buendia
 */
class Correo {

    var $para;
    var $cc;
    var $asunto;
    var $mensaje;
    var $rechazados;
    var $enviados;
    var $error;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->library('email');
    }

    public function enviar() {
        $this->Setting_Email_Preferences();
        
        $this->CI->email->from($this->CI->config->item('CorreoGral'), $this->CI->config->item('NomEscuela'));
        $this->CI->email->to($this->getPara());
        $this->CI->email->cc($this->getCc());

        $this->CI->email->subject($this->getAsunto());
        $this->CI->email->message($this->getMensaje());

        if (!$this->CI->email->send()) {
            $this->setError($this->CI->email->print_debugger());
        }
    }

    private function Setting_Email_Preferences() {
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;

        $this->CI->email->initialize($config);
    }

    function getPara() {
        return $this->para;
    }

    function getCc() {
        return $this->cc;
    }

    function getAsunto() {
        return $this->asunto;
    }

    function getMensaje() {
        return $this->mensaje;
    }

    function getRechazados() {
        return $this->rechazados;
    }

    function getEnviados() {
        return $this->enviados;
    }

    function setPara($para) {
        $this->para = $para;
    }

    function setCc($cc) {
        $this->cc = $cc;
    }

    function setAsunto($asunto) {
        $this->asunto = $asunto;
    }

    function setMensaje($mensaje) {
        $this->mensaje = $mensaje;
    }

    function setRechazados($rechazados) {
        $this->rechazados = $rechazados;
    }

    function setEnviados($enviados) {
        $this->enviados = $enviados;
    }

    function getError() {
        return $this->error;
    }

    function setError($error) {
        $this->error = $error;
    }

}
