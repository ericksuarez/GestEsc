<?php

/**
 * Description of Curricular
 *
 * @author esuarez
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Curricular extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Curricular_model", "curricular");
        $this->load->model("Catalogo_model", "catalogo");
        $this->load->model("ConsultaGral", "gral");
        Acceso::TieneSesionActiva();
    }

    public function grupos() {
        $post = $this->input->post();
        $data["IDTurno"] = 'M';
        $data["IDGrado"] = '1';
        $where_materia = 'where GradoEsc_IDGradoEsc = ' . $data["IDGrado"];
        $where_docentes = '';

        if (!empty($post)) {
            foreach ($post as $key => $value) {
                $$key = $value;
            }
            if (isset($turno)) {
                $data["IDTurno"] = $turno;
                $busqueda = new Busqueda();
                $busqueda->Where('e', 'Turno_IDTurno', $turno);
                $where_docentes = $busqueda->getWhere();
            }
            if (isset($grado)) {
                $data["IDGrado"] = $this->gral->getIDsGrado($grado);
                $where_materia = 'where GradoEsc_IDGradoEsc = ' . $data["IDGrado"]["Grado"];
            }
        }
        $data["materias"] = $this->catalogo->CatMateria($where_materia);
        $data["docentes"] = $this->catalogo->Docentes($where_docentes);

        $data["add_js"] = array('ajax/MainAsignaGrupos.js');
        $this->load->view('common/header');
        $this->load->view('curricular/grupos', $data);
        $this->load->view('common/footer');
    }

    public function guardarDocenteGrupoMateria() {
        $post = $this->input->post();
        if (!empty($post)) {
            foreach ($post as $key => $value) {
                $$key = $value;
            }
            if ($docente_gral == 0) {
                foreach ($mapa as $key => $value) {
                    $this->curricular->eliminaRegistradas($grado, $value["materia"], $turno);
                    if (isset($value["docente"])) {
                        foreach ($value["docente"] as $k => $IDDocente) {
                            $asindaEsMateria = $this->curricular->isRegistrada($grado, $value["materia"], $IDDocente, $turno);
                            if ($asindaEsMateria) {
                                $this->curricular->UpdMapaCurricular($grado, $value["materia"], $IDDocente, $turno);
                            } else {
                                $this->curricular->InsMapaCurricular($grado, $value["materia"], $IDDocente, $turno);
                            }
                        }
                    }
                }
            } else {
                foreach ($mapa as $key => $value) {
                    $asindaEsMateria = $this->curricular->isRegistrada($grado, $value["materia"], $docente_gral, $turno);
                    if ($asindaEsMateria) {
                        $this->curricular->UpdMapaCurricular($grado, $value["materia"], $docente_gral, $turno);
                    } else {
                        $this->curricular->InsMapaCurricular($grado, $value["materia"], $docente_gral, $turno);
                    }
                }
            }
        }
        $this->session->set_flashdata('exito', 'Los Docente se asiganron correctamente.');
        redirect('curricular/grupos');
    }

    public function horario_grupal() {
        $post = $this->input->post();
        $data['IDTurno'] = 'M';
        $data["IDGrado"] = '1';
        $data["where_materias"] = 'where GradoEsc_IDGradoEsc = 1';
        $grupo = '1';

        if (!empty($post)) {
            foreach ($post as $key => $value) {
                $$key = $value;
            }
            $data['IDTurno'] = $turno;
            $tmp = $this->gral->getIDsGrado($grupo);
            $data["IDGrado"] = $tmp["Grado"];
            $data["where_materias"] = 'where GradoEsc_IDGradoEsc = ' . $data["IDGrado"];
        }

        $hrs = $this->getCreaHrsHorario($data);
        $data['horas'] = $hrs['horas'];
        $data['Receso'] = $hrs['Receso'];

        $tmp = $this->gral->getIDsGrado($grupo);
        $data['horarios'] = $this->curricular->getHorario($tmp["Grado"], $tmp["Grupo"], $data['IDTurno']);

        foreach ($data['horarios'] as $key => $value) {
            $splitDocentes = explode(',', $value['Docentes']);
            $data['horarios'][$key]['Docentes'] = '';
            foreach ($splitDocentes as $k => $val) {
                $data['horarios'][$key]['Docentes'] .= '<li style="font-size: 10px;">' . $val . '</li>';
            }
        }

        $data['export_buttons'] = Exportar::btnsPdfPrint();
        $this->session->set_userdata('Export', Exportar::html('curricular/tabla_horario', $data));

        $data["add_js"] = array('ajax/MainHorarioGrupal.js');
        $this->load->view('common/header');
        $this->load->view('curricular/horario_grupal', $data);
        $this->load->view('common/footer');
    }

    public function horario_individual($IDUsuario=0) {
        $where = 'u.IdUsuario = ' . (($IDUsuario == 0) ? $this->session->userdata('IdUsuario') : $IDUsuario);
        
        $data['estudiante'] = $this->catalogo->Estudiantes($where);
        $data['IDTurno'] = $data['estudiante'][0]['Turno_IDTurno'];
        $data["where_materias"] = 'where GradoEsc_IDGradoEsc = '.$data['estudiante'][0]["Grado"];

        $hrs = $this->getCreaHrsHorario($data);
        $data['horas'] = $hrs['horas'];
        $data['Receso'] = $hrs['Receso'];

        $data['horarios'] = $this->curricular->getHorario($data['estudiante'][0]["Grado"], $data['estudiante'][0]["Grupo"], $data['estudiante'][0]['Turno_IDTurno']);

        foreach ($data['horarios'] as $key => $value) {
            $splitDocentes = explode(',', $value['Docentes']);
            $data['horarios'][$key]['Docentes'] = '';
            foreach ($splitDocentes as $k => $val) {
                $data['horarios'][$key]['Docentes'] .= '<li style="font-size: 10px;">' . $val . '</li>';
            }
        }

        $this->session->set_userdata('Export', Exportar::html('estudiante/horario', $data));
        
        $data["add_js"] = array('ajax/MainHorarioGrupal.js');
        $this->load->view('common/header');
        $this->load->view('estudiante/horario', $data);
        $this->load->view('common/footer');
    }
    
    public function horario_docente($IDUsuario=0) {
        $where = 'u.IdUsuario = ' . (($IDUsuario == 0) ? $this->session->userdata('IdUsuario') : $IDUsuario);
        $data['docente'] = $this->catalogo->Docentes($where);
        $data['IDTurno'] = $data['docente'][0]['Turno_IDTurno'];

        $hrs = $this->getCreaHrsHorario($data);
        $data['horas'] = $hrs['horas'];
        $data['Receso'] = $hrs['Receso'];

        $data['horarios'] = $this->curricular->getHorarioDocente($data['docente'][0]['IDDocente']);

        foreach ($data['horarios'] as $key => $value) {
            $splitDocentes = explode(',', $value['Docentes']);
            $data['horarios'][$key]['Docentes'] = '';
            foreach ($splitDocentes as $k => $val) {
                $data['horarios'][$key]['Docentes'] .= '<li style="font-size: 10px;">' . $val . '</li>';
            }
        }

        $this->session->set_userdata('Export', Exportar::html('estudiante/horario', $data));
        
        $data["add_js"] = array('ajax/MainHorarioGrupal.js');
        $this->load->view('common/header');
        $this->load->view('docente/horario', $data);
        $this->load->view('common/footer');
    }

    public function guardarHorarioGrupal() {
        $post = $this->input->post();
        foreach (DiasSemana() as $key => $dia) {
            if (isset($post['materia'][$dia])) {
                foreach ($post['materia'][$dia] as $k => $value) {
                    $horario = $value['Hora'];
                    $materia = $value['IDMateria'];
                    $grado = $value['IDGrado'];
                    $turno = $value['IDTurno'];
                    $this->curricular->InsHorario($grado, $turno, $materia, $dia, $horario);
                }
            }
        }
        $this->session->set_flashdata('exito', 'El Horario se creó con éxito.');
        redirect('curricular/horario_grupal');
    }

    public function getCreaHrsHorario($data) {
        $info = $this->curricular->getTurnos($data['IDTurno']);
        $numClases = $this->curricular->getNumClasesPorTurno($data['IDTurno']); //5
        $acumulado = $info['HoraInicioClases'];
        $data['horas'] = array();
        $key = 0;
        $addReceso = ceil($numClases['NumClases'] / 2);
        for ($i = 0; $i <= $numClases['NumClases']; $i++) {
            if ($addReceso == $i) {
                $tmp = $acumulado . ' - ';
                $data['horas'][$key] = $this->curricular->getSumaHoras($acumulado, 'DuracionReceso', $data['IDTurno']);
                $acumulado = $data['horas'][$key]["Hora"];
                $data['horas'][$key]["Hora"] = $tmp . $data['horas'][$key]["Hora"];
                $data['Receso'] = $data['horas'][$key]["Hora"];
            } else {
                $tmp = $acumulado . ' - ';
                $data['horas'][$key] = $this->curricular->getSumaHoras($acumulado, 'DuracionClase', $data['IDTurno']);
                $acumulado = $data['horas'][$key]["Hora"];
                $data['horas'][$key]["Hora"] = $tmp . $data['horas'][$key]["Hora"];
            }
            $key++;
        }
        return $data;
    }

}
