
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

    function /* array(stdObject) */ insertarPoema($autor,$contenido,$fecha,$idTelefono, $titulo) {
        return $this->oMySQL->insertar(
                'INSERT INTO poema(autor, contenido,fecha, idTelefono, titulo) VALUES (?,?,?,?,?)', array($autor,$contenido,$fecha,$idTelefono, $titulo));
    }
    
}
?>
