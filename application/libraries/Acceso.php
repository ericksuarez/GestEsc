<?php

/**
 * Description of Permisos
 *
 * @author Erick Suarez
 */
class Acceso {

    var $CI;
    var $activo = "";
    var $inactivo = 'style="display: none"';

    public function __construct() {
        $this->CI = & get_instance();
    }

    public static function PermiteGrupo() {
        
        $permite = new Acceso();
        $resp = "";
        $args = func_get_args();
        $tipo = $permite->CI->session->userdata('IDTipoUsuario');

        if (isset($args[0]) && is_array($args[0])) {
            $args = $args[0];
        }
        
        foreach ($args as $key => $value) {
            if($value == $tipo){
                $resp = $permite->activo;
                break;
            }  else {
                $resp = $permite->inactivo;
            }
        }
        return $resp;
    }

    public static function DenegaGrupo() {
        
        $denega = new Acceso();
        $resp = "";
        $args = func_get_args();
        $tipo = $denega->CI->session->userdata('IDTipoUsuario');

        if (isset($args[0]) && is_array($args[0])) {
            $args = $args[0];
        }
        
        foreach ($args as $key => $value) {
            if($value == $tipo){
                 $resp = $denega->inactivo;
            }  else {
                 $resp = $denega->activo;
                 break;
            }
        }
        return $resp;
    }
    
    public static function PermisoUsuario() {
        
    }
    
    public static function TieneSesionActiva() {
        $sesion = new Acceso();
        if(!$sesion->CI->session->userdata('SesActiva')){
            redirect("login/cerrar_sesion");
        }
    }

}

class Grupo {

    const ESTUDIANTE = 1;
    const DOCENTE = 2;
    const PADRES_FAMILIA = 3;
    const EMPLEADO = 4;
    const DIRECTIVO = 5;
    const ADMIN = 6;

}
