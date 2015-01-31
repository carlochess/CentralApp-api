
<?php

class ModeloMenu {
    private $oMySQL;

    function __construct(MySQL $db) {
        $this->oMySQL = $db;
    }

    /**  */
    function /* array(stdObject) */ getMenuDia($dia) {
        return $this->oMySQL->seleccionar(
                'SELECT * FROM menu WHERE DATE(fecha) = DATE(?)', array($dia));
    }
    
    /**  */
    function /* array(stdObject) */ getMenuDias($qMarks,$dias) {
        return $this->oMySQL->seleccionar(
                "SELECT * FROM menu WHERE DATE(fecha) IN ($qMarks)", $dias);
    }
    
    /**  */
    function /* array(stdObject) */ getMenuSemana($dia) {
        return $this->oMySQL->seleccionar(
                ' ', array($dia));
    }

}
?>
