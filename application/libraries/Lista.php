<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Lista
 *
 * @author esuarez
 */
class Lista {

    var $idButton = null;
    var $thead = "";
    var $tfoot;
    var $activeTfoot = TRUE;
    var $tbody;
    var $buttons;
    var $export;
    var $alertIndex;
    var $alertCondition;
    var $html = "";
    var $RealColumns;
    var $urlController;
    var $default = array(
        'consultar' => 'class="btn btn-info btn-stroke btn-circle btn-xs"><i class="fa fa-eye"></i>',
        'modificar' => 'class="btn btn-success btn-stroke btn-circle btn-xs"><i class="fa fa-pencil"></i>',
        'eliminar' => 'class="btn btn-danger btn-stroke btn-circle btn-xs"><i class="fa fa-trash"></i>'
    );
    var $icondefault = array('info' => 'eye', 'success' => 'pencil', 'danger' => 'trash');

    function configButtons($key, $controller) {
        $this->setIdButton($key);
        $this->setUrlController($controller);
    }

    function setThead() {
        $this->thead = func_get_args();

        if (isset($this->thead[0]) && is_array($this->thead[0])) {
            $this->thead = $this->thead[0];
        }
    }

    function getHTMLThead() {
        $thead = "<thead><tr>";
        foreach ($this->getThead() as $key => $value) {
            $thead .= "<th>" . $value . "</th>";
        }
        if (!is_null($this->getIdButton())) {
            $thead .= "<th>&nbsp;&nbsp;</th>";
        }
        $thead .= "</tr></thead>";
        $thead .= $this->getActiveTfoot() ? $this->setTfoot($this->getThead()) : '';
        return $thead;
    }

    function setTfoot($tfoot = array()) {
        $this->tfoot = '<tfoot><tr>';
        foreach ($tfoot as $key => $value) {
            $this->tfoot .= '<th>' . $value . '</th>';
        }
        if (!is_null($this->getIdButton())) {
            $this->tfoot .= "<th>&nbsp;&nbsp;</th>";
        }
        $this->tfoot .= '</tfoot></tr>';
    }

    function table() {
        $this->html = '<table id="example" class="table table-bordered table-hover table-condensed v-middle" cellspacing="0" width="100%">';
        $this->html .= $this->getHTMLThead();
        $this->html .= $this->getTfoot();
        $this->html .= $this->getTbody();
        $this->html .= '</table>';
        return $this->html;
    }
    
    function table_export() {
        $this->setActiveTfoot(FALSE);
        $this->setExport('export');
        $html = '<table id="example" class="table table-bordered table-hover table-condensed v-middle" cellspacing="0" width="100%">';
        $html .= $this->getHTMLThead();
        $html .= $this->getTfoot();
        $html .= $this->getTbody();
        $html .= '</table>';
        return $this->html;
    }

    function getRealColumns() {
        return $this->RealColumns;
    }

    function setRealColumns() {
        $args = func_get_args();

        if (isset($args[0]) && is_array($args[0])) {
            $args = $args[0];
        }

        $this->RealColumns = $args;

        return $this;
    }

    function getAlert($data) {
        if ($data[$this->getAlertIndex()] . $this->getAlertCondition()) {
            return 'class="alerta-warning"';
        } else {
            return '';
        }
    }

    function setEspecialButton($href, $texto, $id) {
        $this->setIdButton($id);
        $class = $texto == '' ? 'btn-circle' : '';
        $this->buttons = array(
            'href' => $href,
            'text' => '&nbsp; ' . $texto,
            'class' => $class,
        );
    }

    function createButtons($id = 0) {
        $htmlButton = '<td><p>';
        if (empty($this->getButtons())) {
            foreach ($this->default as $key => $value) {
                $htmlButton .= '<a href="' . site_url($this->getUrlController() . '/' . $key . '/' . $id) . '" ' . $value . '</a>';
            }
        } else {
            $htmlButton .= '<a href="' . $this->buttons['href'] . '/' . $id . '" '
                    . 'class="btn btn-primary btn-stroke ' . $this->buttons['class'] . ' btn-xs">'
                    . '<i class="fa fa-exclamation-circle"></i>' . $this->buttons['text'] . '</a>';
        }
        $htmlButton .= '</td></p>';

        return $htmlButton;
    }

    function setTbody($tbody) {
        $this->tbody = '<tbody>';

        foreach ($tbody as $k => $v) {
            if (!empty($this->getAlertIndex()) && !empty($this->getAlertCondition())) {
                $this->tbody .= '<tr ' . $this->getAlert($v) . '>';
            } else {
                $this->tbody .= '<tr>';
            }
            foreach ($this->getRealColumns() as $key => $value) {
                $this->tbody .= '<td>' . $v[$value] . '</td>';
            }
            if (!is_null($this->getIdButton()) && empty($this->getExport())) {
                $this->tbody .= $this->createButtons($v[$this->getIdButton()]);
            }
            $this->tbody .= '</tr>';
        }
        $this->tbody .= '</tbody>';
    }

    function addExtraButton($function,$style) {
        $this->default[$function] = $style;
    }
    
    function getUrlController() {
        return $this->urlController;
    }

    function setUrlController($urlController) {
        $this->urlController = $urlController;
    }

    function setExport($export) {
        $this->export = $export;
    }

    function setAlert($alertIndex, $alertCondition) {
        $this->setAlertIndex($alertIndex);
        $this->setAlertCondition($alertCondition);
    }

    function getAlertIndex() {
        return $this->alertIndex;
    }

    function getAlertCondition() {
        return $this->alertCondition;
    }

    function setAlertIndex($alertIndex) {
        $this->alertIndex = $alertIndex;
    }

    function setAlertCondition($alertCondition) {
        $this->alertCondition = $alertCondition;
    }

    function setHtml($html) {
        $this->html .= $html;
    }

    function getTbody() {
        return $this->tbody;
    }

    function getIdButton() {
        return $this->idButton;
    }

    function getDefault() {
        return $this->default;
    }

    function getIcondefault() {
        return $this->icondefault;
    }

    function setIdButton($idButton) {
        $this->idButton = $idButton;
    }

    function setDefault($default) {
        $this->default = $default;
    }

    function setIcondefault($icondefault) {
        $this->icondefault = $icondefault;
    }

    function getHtml() {
        return $this->html;
    }

    function getThead() {
        return $this->thead;
    }

    function getTfoot() {
        return $this->tfoot;
    }

    function getButtons() {
        return $this->buttons;
    }

    function getExport() {
        return $this->export;
    }

    function getActiveTfoot() {
        return $this->activeTfoot;
    }

    function setActiveTfoot($activeTfoot) {
        $this->activeTfoot = $activeTfoot;
    }

}
