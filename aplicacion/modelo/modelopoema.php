
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

    function /* array(stdObject) */ insertarPoema($titulo,$contenido,$fecha,$cuenta,$idTelefono) {
        return $this->oMySQL->insertar(
                'INSERT INTO poema(autor, contenido,fecha, cuenta, idTelefono) VALUES (?,?,?,?,?)', array($titulo,$contenido,$fecha,$cuenta,$idTelefono));
    }
    
}
?>
