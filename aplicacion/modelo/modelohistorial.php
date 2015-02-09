
<?php

class ModeloHistorial {
    private $oMySQL;

    function __construct(MySQL $db) {
        $this->oMySQL = $db;
    }

    /**  */
    function /* array(stdObject) */ getRegistrosDia($fecha) {
        return $this->oMySQL->seleccionar(
                'SELECT * FROM estadotemprestaurante WHERE DATE(hora) = DATE( ? ) AND TIME(hora)> TIME( ? ) ORDER BY hora DESC', array($fecha,$fecha));
    }
    
    /**  */
    function /* array(stdObject) */ getRegistrosSemana($qMarks, $dias) {
        return $this->oMySQL->ejecutarConsultaSelect(
                "SELECT * FROM estadotemprestaurante WHERE DATE(hora) IN ($qMarks)", array($dias));
    }
    
    /**  */
    function /* array(stdObject) */ getRegistrosMes($fecha) {
        return $this->oMySQL->ejecutarConsultaSelect(
                'SELECT * FROM estadotemprestaurante WHERE YEAR(hora) = YEAR(?) AND MONTH(hora) = MONTH(?)', array($fecha,$fecha));
    }

}
?>
