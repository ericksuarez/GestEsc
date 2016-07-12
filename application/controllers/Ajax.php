<?php

/**
 * Description of Ajax
 *
 * @author Erick Suarez
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ajax extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("ConsultaGral", "gral");
        $this->load->model("Catalogo_model", "catal");
        $this->load->model("Expediente_model", "expediente");
        $this->load->model("Estudiante_model", "study");
        $this->load->model("Docente_model", "docente");
        $this->load->model("Pago_model", "pago");
        $this->load->model("Cobranza_model", "cobranza");
    }

    public function getCatTipo() {
        $catnombre = $this->input->post('cattipo');
        $lista = $this->catal->CatDireccion($catnombre);
        $rows = '';

        foreach ($lista as $key => $value) {
            $rows .= '<tr><td>' . $value['#'] . '</td><td>' . $value['Nombre'] . '</td></tr>';
        }
        echo $this->html_table($rows);
    }

    public function getPais() {
        $nombre = $this->input->post('nombre');
        $lista = $this->catal->getPais($nombre);
        $rows = '';

        foreach ($lista as $key => $value) {
            $nom = "'" . $value['Nombre'] . "'";
            $rows .= '<tr><td>' . $value['#'] . '</td><td>' . $value['Nombre'] . '</td>'
                    . '<td><button type="button" class="btn btn-success" data-dismiss="modal" onclick="MiPais(' . $value['#'] . ',' . $nom . ')">'
                    . '<i class="fa fa-check"></i></button></td></tr>';
        }
        echo $this->html_table($rows);
    }

    public function getEstado() {
        $post = $this->input->post();
        $lista = $this->catal->getEstado($post['nombre'], $post['idPais']);
        $rows = '';

        foreach ($lista as $key => $value) {
            $nom = "'" . $value['Nombre'] . "'";
            $rows .= '<tr><td>' . $value['#'] . '</td><td>' . $value['Nombre'] . '</td>'
                    . '<td><button type="button" class="btn btn-success" data-dismiss="modal" onclick="MiEdo(' . $value['#'] . ',' . $nom . ')">'
                    . '<i class="fa fa-check"></i></button></td></tr>';
        }
        echo $this->html_table($rows);
    }

    public function getCodPost() {
        $post = $this->input->post();
        $lista = $this->catal->getCodPost($post['nombre'], $post['idPais'], $post['idEdo']);
        $rows = '';

        foreach ($lista as $key => $value) {
            $nom = "'" . $value['CodPostal'] . "',";
            $nom .= $value['DelMun_IDDelMun'] . ",";
            $nom .= "'" . $value['NomDelMun'] . "',";
            $nom .= $value['IDColonia'] . ",";
            $nom .= "'" . $value['Nombre'] . "'";
            $rows .= '<tr><td>' . $value['CodPostal'] . '</td><td>' . $value['NomDelMun'] . '</td><td>' . $value['Nombre'] . '</td>'
                    . '<td><button type="button" class="btn btn-success" data-dismiss="modal" onclick="MiCodPos(' . $value['CodPostal'] . ',' . $nom . ')">'
                    . '<i class="fa fa-check"></i></button></td></tr>';
        }
//        echo $this->db->last_query();
        echo $this->html_tableCodPost($rows);
    }

    private function html_table($rows) {
        $html = '<thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="responsive-table-body">'
                . $rows .
                '</tbody>';
        return $html;
    }

    private function html_tableCodPost($rows) {
        $html = '<thead>
                                <tr>
                                    <th>Cod. Postal</th>
                                    <th>Del / Mun</th>
                                    <th>Colonia</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="responsive-table-body">'
                . $rows .
                '</tbody>';
        return $html;
    }

    public function localidad() {

        $post = $this->input->post();
        $option = '<option value="0" >--- Seleciona una opcion ---</option>';
        $idEdo = $post["idEdo"];
        $idDelMun = $post["idDelMun"] > 0 ? $post["idDelMun"] : 0;


        if ($idDelMun == 0) {
            $lista = $this->gral->getDelMun($idEdo, $idDelMun);
            foreach ($lista as $key => $value) {
                $option .= '<option value="' . $value["ID_Del_Mun"] . '"> ' . $value["Desc_Del_Mun"] . '</option>';
            }
        } else {
//            print_r($post);
            $lista = $this->gral->getColonia($idEdo, $idDelMun, $post["idCP"]);
            foreach ($lista as $key => $value) {
                $option .= '<option value="' . $value["ID_Colonia"] . '"> ' . $value["Desc_Colonia"] . '</option>';
            }
        }

        echo $option;
    }

    public function reinscripcion($modo) {
        $post = $this->input->post();
        $html = "";
        switch ($modo) {
            case "create":

                $post["Einscrito"] = TRUE;
                $post["FecInscrito"] = date("Y-m-d H:i:s");

                if ($this->form_validation->run('reinscripcion') == FALSE) {
                    $html = '<div class="alert alert-danger alert-dismissible" role="alert" style="box-shadow: 5px 5px 7px #888888;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    ' . validation_errors() . '
                </div>';
                } else {
                    $PKs = $this->study->getInfoReinscripcion($post['IDExp']);
                    $this->study->UpdGrupo($post, $PKs['IDGrupo']);
                    $this->study->UpdExpediente($post, $post['IDExp'], $PKs['Usuario_IDUsuario']);
                    $this->pago->InsPago($post, $post['IDExp']);
                    $servicios = explode(',', $post['REservicio']);
                    if (!empty($servicios[0])) {
                        foreach ($servicios as $key => $value) {
                            $info = $this->study->Servicios($post['IDExp'], $PKs['Usuario_IDUsuario'], $value);
                            $post["Descuento"] = ($info[0]['Precio'] * $PKs['DescntoColegiatura']) / 100;
                            $IVA = (($info[0]['Precio'] - $post["Descuento"]) * 16) / 100;
                            $post["SubTotal"] = ($info[0]['Precio'] - $post["Descuento"]) - $IVA;
                            $post["Total"] = $info[0]['Precio'] - $post["Descuento"];
                            $this->pago->InsPagoDetalle($post, $post['IDExp'], $value, $info[0]['IDUnidad']);
                        }
                    }
                    $html = 'OK';
                }
                break;
        }

        echo $html;
    }

    public function pago_servicios($modo) {
        $post = $this->input->post();
        $html = "";
        switch ($modo) {
            case "create":

                $post["Einscrito"] = TRUE;
                $post["FecInscrito"] = date("Y-m-d H:i:s");

                if ($this->form_validation->run('pago_servicios') == FALSE) {
                    $html = '<div class="alert alert-danger alert-dismissible" role="alert" style="box-shadow: 5px 5px 7px #888888;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    ' . validation_errors() . '
                </div>';
                } else {
                    $PKs = $this->study->getInfoReinscripcion($post['IDExp']);
                    $this->study->UpdExpediente($post, $post['IDExp'], $PKs['Usuario_IDUsuario']);
                    $this->pago->InsPago($post, $post['IDExp']);
                    $servicios = explode(',', $post['REservicio']);
                    if (!empty($servicios[0])) {
                        foreach ($servicios as $key => $value) {
                            $info = $this->study->Servicios($post['IDExp'], $PKs['Usuario_IDUsuario'], $value);

                            $post["Descuento"] = ($info[0]['Precio'] * $PKs['DescntoColegiatura']) / 100;
                            $IVA = (($info[0]['Precio'] - $post["Descuento"]) * 16) / 100;
                            $post["SubTotal"] = ($info[0]['Precio'] - $post["Descuento"]) - $IVA;
                            $post["Total"] = $info[0]['Precio'] - $post["Descuento"];

                            switch ($PKs['FrecPago']) {
                                case 'SEMANAL':
                                    $precio_parcialidad = $info[0]['Precio'] / 4;
                                    $post["Descuento"] = 0;
                                    $IVA = (($precio_parcialidad - $post["Descuento"]) * 16) / 100;
                                    $post["SubTotal"] = ($precio_parcialidad - $post["Descuento"]) - $IVA;
                                    $post["Total"] = $precio_parcialidad - $post["Descuento"];
                                    break;
                                case 'QUINCENAL':
                                    $precio_parcialidad = $info[0]['Precio'] / 2;
                                    $post["Descuento"] = 0;
                                    $IVA = (($precio_parcialidad - $post["Descuento"]) * 16) / 100;
                                    $post["SubTotal"] = ($precio_parcialidad - $post["Descuento"]) - $IVA;
                                    $post["Total"] = $precio_parcialidad - $post["Descuento"];
                                    break;
                                case 'MENSUAL':
                                    $precio_parcialidad = $info[0]['Precio'];
                                    $post["Descuento"] = 0;
                                    $IVA = (($precio_parcialidad - $post["Descuento"]) * 16) / 100;
                                    $post["SubTotal"] = ($precio_parcialidad - $post["Descuento"]) - $IVA;
                                    $post["Total"] = $precio_parcialidad - $post["Descuento"];
                                    break;
                                default:
                                    break;
                            }

                            $this->pago->InsPagoDetalle($post, $post['IDExp'], $value, $info[0]['IDUnidad']);
                        }
                    }
                    $html = 'OK';
                }
                break;
        }

        echo $html;
    }

    function Grado_Grupo($post_string) {
        $this->form_validation->set_message('Grado_Grupo', 'El campo Grado/Grupo es requerido');
        return $post_string == '0' ? FALSE : TRUE;
    }

    function Docentes_Escargados_Materia() {
        $post = $this->input->post();
        $where = " gmd.Materia_IDMateria = " . $post['IDMateria'] . " 
                    and gmd.Turno_IDTurno = '" . $post['IDTurno'] . "' 
                    and gmd.Grado_IDGrado = " . $post['IDGrado'];
        $data = $this->catal->Docentes($where);
        $html = "";
        $rand = rand(0, 9999);
        if (!empty($data) && is_array($data)) {
            foreach ($data as $key => $value) {
                $imagen = getNombreDocumentoExp($value['IDExp'], 4);
                if ($imagen === '') {
                    $html .= '<img src="' . base_url() . 'images/dafault.jpg" width="50" alt="Docente">';
                } else {
                    $html .= '<img src="' . $imagen . '" width="50" alt="Docente">';
                }
            }
            foreach ($data as $key => $value) {
                $html .= '<input type="hidden" value="' . $post['Hrs'] . '" name="materia[' . $post['Dia'] . '][' . $rand . '][Hora]">';
                $html .= '<input type="hidden" value="' . $post['IDGrado'] . '" name="materia[' . $post['Dia'] . '][' . $rand . '][IDGrado]">';
                $html .= '<input type="hidden" value="' . $post['IDTurno'] . '" name="materia[' . $post['Dia'] . '][' . $rand . '][IDTurno]">';
                $html .= '<input type="hidden" value="' . $post['IDMateria'] . '" name="materia[' . $post['Dia'] . '][' . $rand . '][IDMateria]">';
                $html .= '<input type="hidden" value="' . $value['IDDocente'] . '" name="materia[' . $post['Dia'] . '][' . $rand . '][IDDocente][]">';
                $html .= '<li style="font-size: 10px;">' . $value['Nombre'] . ' ' . $value['APaterno'] . ' ' . $value['AMaterno'] . '</li>';
            }
        } else {
            $html .= '<input type="hidden" value="' . $post['Hrs'] . '" name="materia[' . $post['Dia'] . '][' . $rand . '][Hora]">';
            $html .= '<input type="hidden" value="' . $post['IDGrado'] . '" name="materia[' . $post['Dia'] . '][' . $rand . '][IDGrado]">';
            $html .= '<input type="hidden" value="' . $post['IDTurno'] . '" name="materia[' . $post['Dia'] . '][' . $rand . '][IDTurno]">';
            $html .= '<input type="hidden" value="' . $post['IDMateria'] . '" name="materia[' . $post['Dia'] . '][' . $rand . '][IDMateria]">';
            $html .= '<label style="font-size: 10px;">La materia no tiene asigados Docentes.</label>';
        }
        echo $html;
    }

    function docentes_escargados() {
        $post = $this->input->post();
        $data = $this->docente->getDocentesGrupo($post['IDGrupo']);
        $html = "";
        if (!empty($data) && is_array($data)) {
            foreach ($data as $key => $value) {
                $html .= '<li>' . $value['Nombre'] . ' ' . $value['APaterno'] . ' ' . $value['AMaterno'] . '</li>';
            }
        } else {
            $html = '<li>-- Sin Asignar --</li>';
        }
        echo $html;
    }

    function esServicoContratado() {
        $post = $this->input->post();
        $html = "";

        $sql = "SELECT * FROM serviciocontratado
                WHERE Expediente_IDExp = " . $post['IDExp'] . "
                AND Usuario_IDUsuario= " . $post['IDUser'] . "
                AND Servicio_IDServicio = " . $post['ID'];

        if (!empty($this->getQuery($sql))) {
            $html = 'OK';
        } else {
            $html = 'NO';
        }
        echo $html;
    }

    function MateriaAsignada() {
        $post = $this->input->post();
        $html = "";

        $sql = "SELECT * FROM docente_has_materia
                WHERE Docente_IDDocente = " . $post['IDExp'] . " AND 
                Materia_IDMateria = " . $post['IDMateria'] . "";

        if (!empty($this->getQuery($sql))) {
            $html = 'OK';
        } else {
            $html = 'NO';
        }
        echo $html;
    }

    function EliminaMateriaAsignada() {
        $post = $this->input->post();
        $html = "";

        $sql = "delete from docente_has_materia
                WHERE Docente_IDDocente = " . $post['IDExp'] . " AND 
                Materia_IDMateria = " . $post['IDMateria'];
        $this->db->query($sql);
        echo $sql;
    }

    function forma_pago() {
        $post = $this->input->post();
        $html = "";
        $error = "";

        $error .= $post["FrecPago"] == "0" ? "La Frecuencia de Pago es obligatoria.<br>" : "";
        $error .= $post["Dia"] == "0" ? "El Dia de Pago es obligatorio." : "";

        if ($error != "") {
            $html = '<div class="alert alert-danger alert-dismissible" role="alert" style="box-shadow: 5px 5px 7px #888888;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    ' . $error . '
                </div>';
        } else {
            $this->pago->UpdFormaPago($post);
            $html = 'OK';
        }

        echo $html;
    }

    function detallesPago($IDExp, $IDPago) {
        header('Content-Type: application/json');
        $datalles = $this->cobranza->detallesPago($IDExp, $IDPago);
        echo json_encode($datalles);
    }

    function getCorreos() {
        $nombre = $this->input->post('nombre');
        $tipo = $this->input->post('tipo');
        $func = $this->input->post('func');
        $grupo = $this->input->post('grupo');
        $titulos = '<th>#</th><th>Nombre</th><th>Correo</th>';
        $rows = "";
        $html = "";
        $correos = "";
        $where = "";
        switch ($tipo) {
            case "padresfam":
            case "estudiante":
                $titulos = '<th>#</th><th>Nom.Est.</th><th>Nom.Tutor</th><th>Correos</th>';
                if (!empty($nombre) || $grupo != "") {
                    $busqueda = new Busqueda();
                    $busqueda->setOperador("or");
                    $busqueda->WhereFullText("e", array('Nombre', 'APaterno', 'AMaterno'), $nombre);
                    $busqueda->setOperador("and");
                    $busqueda->WhereFullText("pf", array('Nombre', 'APaterno', 'AMaterno'), $nombre);
                    $busqueda->Where('gr', 'IDGrado', $grupo);
                    $where = $busqueda->getWhere();
                }
                $correos = $this->catal->CorreosEstudiantePadresFam($where);
                foreach ($correos as $key => $value) {
                    $email = "'" . str_replace(",", ";", $value['Correos']) . ";" . $value['Correo'] . ";" . "'";
                    $email = str_replace("N/A;", "", $email);
                    $rows .= '<tr><td><input  type="checkbox" value="' . $key . '" onclick="' . $func . '(' . $email . ')"></td>'
                            . '<td>' . $value['NomCompletoAlumno'] . '</td>'
                            . '<td>' . $value['NomCompletoPadres'] . '</td><td>' . $email . '</td></tr>';
                }
                break;
            case "docente":
                if (!empty($nombre)) {
                    $busqueda = new Busqueda();
                    $busqueda->WhereFullText("e", array('Nombre', 'APaterno', 'AMaterno'), $nombre);
                    $where = $busqueda->getWhere();
                }
                $correos = $this->catal->Docentes($where);
                foreach ($correos as $key => $value) {
                    $email = "'" . $value['Correo'] . ";'";
                    $email = str_replace("N/A;", "", $email);
                    $rows .= '<tr><td><input  type="checkbox" value="' . $key . '" onclick="' . $func . '(' . $email . ')"></td>'
                            . '<td>' . $value['NomCompleto'] . '</td><td>' . $value['Correo'] . '</td></tr>';
                }
                break;
            case "empleado":
                if (!empty($nombre)) {
                    $busqueda = new Busqueda();
                    $busqueda->WhereFullText("e", array('Nombre', 'APaterno', 'AMaterno'), $nombre);
                    $where = $busqueda->getWhere();
                }
                $correos = $this->catal->Empleados($where);
                foreach ($correos as $key => $value) {
                    $email = "'" . $value['Correo'] . ";'";
                    $email = str_replace("N/A;", "", $email);
                    $rows .= '<tr><td><input  type="checkbox" value="' . $key . '" onclick="' . $func . '(' . $email . ')"></td>'
                            . '<td>' . $value['NomCompleto'] . '</td><td>' . $value['Correo'] . '</td></tr>';
                }
                break;

            default:
                break;
        }
        $html = '<thead><tr>' . $titulos . '                                    
                        </tr>
                </thead>
                <tbody id="responsive-table-body">'
                . $rows .
                '</tbody>';
        echo $html;
    }

    function getCorreosSeleccionarTodos() {
        $nombre = $this->input->post('nombre');
        $tipo = $this->input->post('tipo');
        $func = $this->input->post('func');
        $grupo = $this->input->post('grupo');
        $correos = "";
        $all = "";
        $where = "";
        switch ($tipo) {
            case "padresfam":
            case "estudiante":
                if (!empty($nombre) || $grupo != "") {
                    $busqueda = new Busqueda();
                    $busqueda->setOperador("or");
                    $busqueda->WhereFullText("e", array('Nombre', 'APaterno', 'AMaterno'), $nombre);
                    $busqueda->setOperador("and");
                    $busqueda->WhereFullText("pf", array('Nombre', 'APaterno', 'AMaterno'), $nombre);
                    $busqueda->Where('gr', 'IDGrado', $grupo);
                    $where = $busqueda->getWhere();
                }
                $correos = $this->catal->CorreosEstudiantePadresFam($where);
                foreach ($correos as $key => $value) {
                    $all .= str_replace(",", ";", $value['Correos']) . ";" . $value['Correo'] . ";";
                }
                break;
            case "docente":
                if (!empty($nombre)) {
                    $busqueda = new Busqueda();
                    $busqueda->WhereFullText("e", array('Nombre', 'APaterno', 'AMaterno'), $nombre);
                    $where = $busqueda->getWhere();
                }
                $correos = $this->catal->Docentes($where);
                foreach ($correos as $key => $value) {
                    $all .= $value['Correo'] . ";";
                }
                break;
            case "empleado":
                if (!empty($nombre)) {
                    $busqueda = new Busqueda();
                    $busqueda->WhereFullText("e", array('Nombre', 'APaterno', 'AMaterno'), $nombre);
                    $where = $busqueda->getWhere();
                }
                $correos = $this->catal->Empleados($where);
                foreach ($correos as $key => $value) {
                    $all .= $value['Correo'] . ";";
                }
                break;

            default:
                break;
        }
        echo str_replace("N/A;", "", $all);
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

}
