
<?php

class ModeloHistorial {
    private $oMySQL;

    function __construct(MySQL $db) {
        $this->oMySQL = $db;
    }

    /**  */
    function /* array(stdObject) */ getRegistrosDia($fecha) {
        return $this->oMySQL->seleccionar(
                '', array($fecha));
    }
    
    /**  */
    function /* array(stdObject) */ getRegistrosMes($fecha) {
        return $this->oMySQL->ejecutarConsultaSelect(
                '', array($fecha));
    }

}
?>
