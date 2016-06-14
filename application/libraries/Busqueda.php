<?php

/**
 * Description of Busqueda
 *
 * @author Erick Suarez Buendia
 */
class Busqueda {

    var $where;
    var $operador;
    var $cntOpe;

    public function Busqueda() {
        $this->operador = 'and';
    }

    public function Where($table, $columna, $valor, $operador = '=', $isFull = false) {
        if ($isFull) {
            $this->setWhere("where ");
        }
        if (!empty($valor) && strtolower($operador) != "like") {
            $this->setWhere($table . '.' . $columna . ' ' . $operador . ' ' . "'$valor'");
            $this->Operador();
        }
        if (!empty($valor) && strtolower($operador) == "like") {
            $this->setWhere($table . "." . $columna . " " . $operador . " '%" . "'$valor'" . "%'");
            $this->Operador();
        }
    }

    public function WhereFullText($table, $columna, $valor, $isFull = false) {
        $campos = "";
        if ($isFull) {
            $this->setWhere("where ");
        }
        if (!empty($valor)) {
            foreach ($columna as $key => $value) {
                $campos .= $table . '.' . $value . ',';
            }
            $campos = substr($campos, 0, -1);
            $this->setWhere("MATCH(" . $campos . ") AGAINST  ('" . $valor . "')");
            $this->Operador($this->getOperador());
        }
    }

    public function Operador($Cnd = 'and') {
        if (!empty($this->getWhere())) {
            $this->setWhere(' ' . $Cnd . ' ');
        }
    }

    public function IsNotDefault($post, $clave) {
        return isset($post[$clave]) ? $post[$clave] : NULL;
    }

    public function ToCleanData($data) {
        foreach ($data as $key => $value) {
            if ($value == NULL) {
                unset($data[$key]);
            }
        }
        return $data;
    }

    public function getWhere() {
        $len = strlen(trim($this->where));
        $tmp = substr(trim($this->where), $len - 3);
        if ($tmp == "and") {
            $this->where = substr(trim($this->where), 0, -3);
        }
        return $this->where;
    }

    private function setWhere($where) {
        $this->where .= $where;
    }

    public function getOperador() {
        return $this->operador;
    }

    public function setOperador($operador) {
        $this->operador = $operador;
    }

}
