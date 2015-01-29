
<?php

class RegistroUsuario {
    private $oMySQL;

    function __construct(MySQL $db) {
        $this->oMySQL = $db;
    }

    /**  */
    function /* array(stdObject) */ getUltimosPoemas($idUltimoPoema) {
        return $this->oMySQL->ejecutarConsultaSelect(
                'SELECT * FROM poema WHERE idPoema > ? LIMIT 10 ORDER BY idPoema DESC', array($idUltimoPoema));
    }
    
    /**  */
    function /* array(stdObject) */ getPoemas($idPoemaInicial, $idPoemaFinal) {
        return $this->oMySQL->ejecutarConsultaSelect(
                'SELECT * FROM poema WHERE idPoema > ? AND idPoema < ? LIMIT 10 ORDER BY idPoema DESC', array($idPoemaInicial, $idPoemaFinal));
    }

}
?>
