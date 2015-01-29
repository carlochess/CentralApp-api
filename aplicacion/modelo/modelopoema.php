
<?php

class ModeloPoema {
    private $oMySQL;

    function __construct(MySQL $db) {
        $this->oMySQL = $db;
    }

    /**  */
    function /* array(stdObject) */ getUltimosPoemas($idUltimoPoema) {
        return $this->oMySQL->seleccionar(
                'SELECT * FROM poema WHERE idPoema > ? ORDER BY idPoema DESC  LIMIT 10', array($idUltimoPoema));
    }
    
    /**  */
    function /* array(stdObject) */ getPoemas($idPoemaInicial, $idPoemaFinal) {
        return $this->oMySQL->seleccionar(
                'SELECT * FROM poema WHERE idPoema > ? AND idPoema < ? ORDER BY idPoema DESC  LIMIT 10', array($idPoemaInicial, $idPoemaFinal));
    }

}
?>
