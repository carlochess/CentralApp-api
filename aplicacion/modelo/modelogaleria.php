
<?php

class ModeloGaleria {
    private $oMySQL;

    function __construct(MySQL $db) {
        $this->oMySQL = $db;
    }

    /**  */
    function /* array(stdObject) */ getUltimasImagenes($ultimoId) {
        return $this->oMySQL->seleccionar(
                'SELECT idImagen,fecha,calificacion FROM imagenrestaurante WHERE idImagen > ? AND calificacion < 5 ORDER BY idImagen DESC LIMIT 10', array($ultimoId));
    }
    
    /**  */
    function /* array(stdObject) */ getImagenes($primerId,$ultimoId) {
        return $this->oMySQL->seleccionar(
                'SELECT idImagen,fecha,calificacion FROM imagenrestaurante WHERE idImagen > ? AND idImagen < ? ORDER BY idImagen DESC LIMIT 10', array($primerId, $ultimoId));
    }
    
    /**  */
    function /* array(stdObject) */ denunciarFoto($idImagen) {
        return $this->oMySQL->actualizar(
                'UPDATE imagenrestaurante SET calificacion=calificacion+1 WHERE idImagen = ?', array($idImagen));
    }
}
?>
