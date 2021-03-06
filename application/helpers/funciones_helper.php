<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function FecFormato($fecForm) {
    $date = date_create($fecForm);
    return date_format($date, 'Y-m-d');
}

function FecFormatoView($fecForm) {
    $date = date_create($fecForm);
    return date_format($date, 'm/d/Y');
}

function getCatOpciones($CatNombre, $NomSelect, $valor = "") {
    $CI = & get_instance();
    $CI->load->model("Catalogo_model", "catalogo");

    $data = $CI->catalogo->$CatNombre();
    $html = '';
    foreach ($data as $key => $value) {
        $tmp = $valor == $value['index'] ? TRUE : FALSE;
        $html .= '<option value="' . $value['index'] . '"' . set_select($NomSelect, $value['index'], $tmp) . '>' . $value['opcion'] . '</option>';
    }

    return $html;
}

function getCatOpcionesWhere($CatNombre, $NomSelect, $valor = "", $where = "") {
    $CI = & get_instance();
    $CI->load->model("Catalogo_model", "catalogo");

    $data = $CI->catalogo->$CatNombre($where);
    $html = '';
    foreach ($data as $key => $value) {
        $tmp = $valor == $value['index'] ? TRUE : FALSE;
        $html .= '<option value="' . $value['index'] . '"' . set_select($NomSelect, $value['index'], $tmp) . '>' . $value['opcion'] . '</option>';
    }

    return $html;
}

function getCatOpcionesWhereText($CatNombre, $NomSelect, $valor = "", $where = "") {
    $CI = & get_instance();
    $CI->load->model("Catalogo_model", "catalogo");

    $data = $CI->catalogo->$CatNombre($where);
    $html = '';
    foreach ($data as $key => $value) {
        $tmp = $valor == $value['index'] ? $value['opcion'] : '';
        $html .= '<p class="text"><b>' . $tmp . '</b></p>';
    }

    return $html;
}

function getCatDocentesPorMateria($CatNombre, $NomSelect, $IDTurno, $IDMateria, $valor = array()) {
    $CI = & get_instance();
    $CI->load->model("Catalogo_model", "catalogo");

    $data = $CI->catalogo->$CatNombre($IDTurno, $IDMateria);
    $html = '';
    foreach ($data as $key => $value) {
        $tmp = FALSE;
        foreach ($valor as $k => $v) {
            if ($v == $value['index']) {
                $tmp = TRUE;
                break;
            }
        }
        $html .= '<option value="' . $value['index'] . '"' . set_select($NomSelect, $value['index'], $tmp) . '>' . $value['opcion'] . '</option>';
    }
    return $html;
}

function getCatOpcionesIndex($CatNombre, $NomSelect, $valor = "", $index = "") {
    $CI = & get_instance();
    $CI->load->model("Catalogo_model", "catalogo");

    $data = $CI->catalogo->$CatNombre($index);
    $html = '';
    foreach ($data as $key => $value) {
        $tmp = $valor == $value['index'] ? TRUE : FALSE;
        $html .= '<option value="' . $value['index'] . '"' . set_select($NomSelect, $value['index'], $tmp) . '>' . $value['opcion'] . '</option>';
    }

    return $html;
}

function getCatOpcionesCheckBoxes($CatNombre, $NomSelect, $valor = "") {
    $CI = & get_instance();
    $CI->load->model("Catalogo_model", "catalogo");

    $data = $CI->catalogo->$CatNombre();
    $html = '<table style="width: 100%"">
                <tr class="row">
                    <td class="col-md-6">
                        <input  type="checkbox" value="1" disabled="" checked="" readonly=""
                            name="' . $NomSelect . '" id="1" data-price="' . $data[0]['Precio'] . '">
                          ' . $data[0]['opcion'] . ' 
                    </td>
                    <td class="col-md-6"><i class="fa fa-fw fa-dollar"></i><strong id="PriceText-1">' . $data[0]['Precio'] . '</strong></td>
                </tr>';
    foreach ($data as $key => $value) {
        if ($value['index'] > 1) {
            $tmp = $valor == $value['index'] ? TRUE : FALSE;
            $html .= '<tr class="row">'
                    . '<td class="col-md-6">';
            $html .= '<input type="checkbox" value="' . $value['index'] . '" data-price="' . $value['Precio'] . '"'
                    . 'name="' . $NomSelect . '" id="' . $value['index'] . '"' . set_select($NomSelect, $value['index'], $tmp) . '>'
                    . ' ' . $value['opcion'] . ' </td>'
                    . '<td class="col-md-6"><i class="fa fa-fw fa-dollar"></i><strong id="PriceText-' . $value['index'] . '">' . $value['Precio'] . '</strong></td>';
            $html .= '</td></tr>';
        }
    }
    $html .= '<tr class="row">
                <td class="col-md-6">
                    Descuento 
                </td>
                <td class="col-md-6">
                    <i class="fa fa-fw fa-dollar"></i>
                        <strong id="descuento" data-por-desc="">0.00</strong> 
                </td>
            </tr>
            <tr class="row">
                <td class="col-md-6">
                    Subtotal
                </td>
                <td class="col-md-6">
                    <i class="fa fa-fw fa-dollar"></i>
                        <strong id="subtotal">0.00</strong> 
                </td>
            </tr>
            <tr class="row">
                <td class="col-md-6">
                    IVA 
                </td>
                <td class="col-md-6">
                    <i class="fa fa-fw fa-dollar"></i>
                        <strong id="IVA">0.00</strong> 
                </td>
            </tr>
            <tr class="row alert-info">
                <td class="col-md-6">
                    Total
                </td>
                <td class="col-md-6">
                    <i class="fa fa-fw fa-dollar"></i>
                        <strong id="total_a_apagar">0.00</strong> 
                </td>
            </tr>';
    $html .= '</table>';
    return $html;
}

function getCatOpcionesCheckBoxesInLine($CatNombre, $NomSelect, $valor = "") {
    $CI = & get_instance();
    $CI->load->model("Catalogo_model", "catalogo");

    $data = $CI->catalogo->$CatNombre();
    $html = '';
    foreach ($data as $key => $value) {
        $html .= '<div  id="listado">';
        $tmp = $valor == $value['index'] ? TRUE : FALSE;
        $html .= '<input type="checkbox" value="' . $value['index'] . '"'
                . 'name="' . $NomSelect . '" id="' . $value['index'] . '"' . set_select($NomSelect, $value['index'], $tmp) . '>'
                . '<label for="' . $value['index'] . '">&nbsp; ' . $value['opcion'] . '</label>';
        $html .= '</div>';
    }
    return $html;
}

function getCatOpcionesCheckBoxesWhere($CatNombre, $NomSelect, $valor = "", $where) {
    $CI = & get_instance();
    $CI->load->model("Catalogo_model", "catalogo");

    $data = $CI->catalogo->$CatNombre($where);
    $html = '';
    foreach ($data as $key => $value) {
        $html .= '<div  id="listado">';
        $tmp = $valor == $value['index'] ? TRUE : FALSE;
        $html .= '<button type="button" class="btn btn-danger btn-xs borrarMat" style="display: none" id="EM_' . $value['index'] . '" data-id="' . $value['index'] . '">'
                . '<i class="fa fa-trash-o"></i></button>'
                . '<input type="checkbox" value="' . $value['index'] . '"'
                . 'name="' . $NomSelect . '" id="' . $value['index'] . '"' . set_select($NomSelect, $value['index'], $tmp) . '>'
                . '<label id="PriceText-' . $value['index'] . '" for="' . $value['index'] . '">&nbsp; ' . $value['opcion'] . '</label>';
        $html .= '</div>';
    }
    return $html;
}

function getCatOpcionesMultiples($CatNombre, $NomSelect, $valor = array()) {
    $CI = & get_instance();
    $CI->load->model("Catalogo_model", "catalogo");

    $data = $CI->catalogo->$CatNombre();
    $html = '';
    foreach ($data as $key => $value) {
        $tmp = FALSE;
        foreach ($valor as $k => $v) {
            if ($v == $value['index']) {
                $tmp = TRUE;
                break;
            }
        }
        $html .= '<option value="' . $value['index'] . '"' . set_select($NomSelect, $value['index'], $tmp) . '>' . $value['opcion'] . '</option>';
    }
    return $html;
}

function getCatOpcionesMultiplesHTML($CatNombre, $NomSelect, $IDSelect, $valor = array()) {
    $CI = & get_instance();
    $CI->load->model("Catalogo_model", "catalogo");

    $ExtHtml = '';
    $ExtHtml .= '<select style="display: none;" class="selectpicker" multiple="" data-style="btn-white" title="Selecciona una opción" id="' . $IDSelect . '" name="' . $NomSelect . '">';
    $ExtHtml .= getCatOpcionesMultiples($CatNombre, $NomSelect, $valor);
    $ExtHtml .= '</select>';

    $data = $CI->catalogo->$CatNombre();
    $ExtHtml .= '<div style="width: 100%;" class="btn-group bootstrap-select show-tick">
			<button title="Selecciona una opción" data-id="' . $NomSelect . '" type="button" class="btn dropdown-toggle btn-white" data-toggle="dropdown">
			<span class="filter-option pull-left">Selecciona una opción</span>&nbsp;<span class="caret"></span></button>
			<div class="dropdown-menu open">
			<ul class="dropdown-menu inner" role="menu">';

    foreach ($data as $key => $value) {
        $tmp = $value['index'] - 1;
        $ExtHtml .= '<li data-original-index="' . $tmp . '">
								<a tabindex="0" class="" data-normalized-text="<span class=&quot;text&quot;>' . $value['opcion'] . '</span>" data-tokens="null">
								<span class="text">' . $value['opcion'] . '</span><span class="glyphicon glyphicon-ok check-mark"></span>
								</a></li>';
    }

    $ExtHtml .= '</ul></div></div>';

    return $ExtHtml;
}

function getParametrosGenerales($Tipo) {
    $CI = & get_instance();

    $sql = "select * from parametrosgenerales where Tipo = '" . $Tipo . "'";
    $query = $CI->db->query($sql);

    if ($query->num_rows() > 0) {
        $array = $query->result_array();
    } else {
        $array = array();
    }

    foreach ($array as $key => $value) {
        $data[$key] = $value;
    }

    return $data;
}

function regresa_URL() {
    $CI = & get_instance();
    return base_url() . 'index.php/' . $CI->uri->segment(1) . '/' . $CI->uri->segment(2);
}

function CalculaRecargo($IDExp, $IDUsuario) {
    $hoy = date('Y-m-d');
    $CI = & get_instance();
    $recargo = 0;

    $sql = "select * from serviciocontratado as sc
            left join tiene_recargo as tr on tr.Servicio_IDServicio = sc.Servicio_IDServicio
            left join pago_has_servicio as ps on ps.Expediente_IDExp = sc.Expediente_IDExp and ps.Servicio_IDServicio = tr.Servicio_IDServicio
            where sc.Expediente_IDExp = " . $IDExp . " and sc.Usuario_IDUsuario = " . $IDUsuario;
    $query = $CI->db->query($sql);

    if ($query->num_rows() > 0) {
        $array = $query->result_array();
        $recargo = $array[0]["Penalizacion"];
    } else {
        $array = array();
    }
    return $recargo;
}

function getDocentesAsignadosMateria($IDMateria) {
    $CI = & get_instance();

    $sql = "SELECT Docente_IDDocente FROM grado_materia_docente WHERE Materia_IDMateria = " . $IDMateria;
    $query = $CI->db->query($sql);

    if ($query->num_rows() > 0) {
        $array = $query->result_array();
        foreach ($array as $key => $value) {
            $array[$key] = $value['Docente_IDDocente'];
        }
    } else {
        $array = array();
    }
    return $array;
}

function getNombreDocumentoExp($IDExp, $IDTipoDoc) {
    $CI = & get_instance();

    $NomDoc = "";
    $sql = "select * from documentacion where Expediente_IDExp = " . $IDExp . " and TipoDocumento_IDTipoDoc = " . $IDTipoDoc;
    $query = $CI->db->query($sql);

    if ($query->num_rows() > 0) {
        $array = $query->result_array();
        $NomDoc = $array[0]['RutaDoc'];
    } else {
        $array = array();
    }
    return $NomDoc;
}

/* * **************************************************************************
 * FUNCIONES GENERALES DE VALORES FIJOS			            			     *
 * ************************************************************************** */

function DiasSemana() {
    $data = array(
        "Lun" => "Lunes",
        "Mar" => "Martes",
        "Mie" => "Miercoles",
        "Jue" => "Jueves",
        "Vie" => "Viernes");
    return $data;
}

function NumDiasSemana() {
    $data = array(
        1 => "Lunes",
        2 => "Martes",
        3 => "Miercoles",
        4 => "Jueves",
        5 => "Viernes",
        6 => "Sabado",
        7 => "Domingo");
    return $data;
}

function Meses() {
    $data = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto",
        "Septiembre", "Octubre", "Noviembre", "Diciembre");
    return $data;
}

function PeriodosPago() {
    $data = array(
        "SEMANAL" => "SEMANAL",
        "QUINCENAL" => "QUINCENAL",
        "MENSUAL" => "MENSUAL");
    return $data;
}

function GeneraFechaPago($FrecPago, $Dia) {
    $hoy = date('Y-m-d');
    $fecha_pago = null;
    $days = array(
        1 => "Monday",
        2 => "Tuesday",
        3 => "Wednesday",
        4 => "Thursday",
        5 => "Friday",
        6 => "Saturday",
        7 => "Sunday");
    $dias = NumDiasSemana();

    switch ($FrecPago) {
        case "SEMANAL":
            $date = new DateTime($hoy);
            if ($date->format('N') != $Dia) {
                $date->modify('Next ' . $days[$Dia]);
            }
            $fecha_pago = 'Sem. ' . $dias[$Dia] . ', ' . $date->format('d/m/Y');
            break;
        case "QUINCENAL":
            $dia = date('d');
            $tmp = date('Y-m');
            $numdias = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));

            if ($dia <= 15) {
                $date = new DateTime($tmp . '-15');
                $fecha_pago = 'Quincenal, ' . $date->format('d/m/Y');
            } else {
                $quina = $numdias == 30 ? $numdias == 29 ? 92 : 30 : 31;
                $date = new DateTime($tmp . '-' . $quina);
                $fecha_pago = 'Quincenal, ' . $date->format('d/m/Y');
            }
            break;
        case "MENSUAL":
            $tmp = date('Y-m') . '-' . str_pad($Dia, 2, "0", STR_PAD_LEFT);
            $date = new DateTime($tmp);
            $date->modify('Next Month');
            $fecha_pago = 'Mensual, ' . $date->format('d/m/Y');
            break;

        default:
            break;
    }

    return $fecha_pago;
}

function FechaUltimoPago($IDExp) {
    $CI = & get_instance();

    $fecha = "";
    $sql = "select FecPago from pago where Expediente_IDExp = " . $IDExp . " order by FecPago desc";
    $query = $CI->db->query($sql);

    if ($query->num_rows() > 0) {
        $array = $query->result_array();
        $fecha = $array[0]['FecPago'];
    } else {
        $fecha = "1901-01-01 00:00:01";
    }
    return $fecha;
}

function getHijos($IDUsuario) {
    $CI = & get_instance();
    $CI->load->model("PadresFam_model", "padres");
    return $CI->padres->getHijos($IDUsuario);
}

function TieneEvaluacion($IDDocente) {
    $CI = & get_instance();
    $sql = "select * from encuesta_resuelta 
                where IDDocente = " . $IDDocente.
                " and IDUsuario = ".$CI->session->userdata('IdUsuario');
    $query = $CI->db->query($sql);

    if ($query->num_rows() > 0) {
        return "display: none";
    } else {
        return "";
    }
}

/* * **************************************************************************
 * FUNCIONES GENERALES PARA USO DE DBs			            			     *
 * ************************************************************************** */

function IsNotDefault($post, $clave) {
    return isset($post[$clave]) ? $post[$clave] : NULL;
}

function ToCleanData($data) {
    foreach ($data as $key => $value) {
        if ($value == NULL) {
            unset($data[$key]);
        }
    }
    return $data;
}
