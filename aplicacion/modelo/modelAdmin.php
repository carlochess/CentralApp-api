<?php

class modelAdmin {

    public $oMySQL;

    function __construct(MySQL $db = null) {

        $this->oMySQL = $db;
    }

    function getTaxisEnPerimetro($rectangulo) {
        $sqlSelect = 'select AsText(puntoActual)  as posicion, idUsuario from servicio where estado = 0 AND st_contains(PolygonFromText("POLYGON((' . $rectangulo . '))"), puntoActual)';
        return $this->oMySQL->ejecutarConsultaSelect($sqlSelect);
    }

    function getTaxistas() {
        $sqlSelect = 'select usuario.id  as id, nombre from usuario INNER JOIN taxista ON usuario.id = taxista.idUsuario';
        return $this->oMySQL->ejecutarConsultaSelect($sqlSelect);
    }

    function getUsuarioEnPerimetro($rectangulo) {
        $sqlSelect = 'select AsText(puntoRecogida)  as posicion, idPasajero from solicitudviaje where estado = 0 AND st_contains(PolygonFromText("POLYGON((' . $rectangulo . '))"), puntoRecogida)';
        return $this->oMySQL->ejecutarConsultaSelect($sqlSelect);
    }

    function getTaxistasActivos() {
        $sqlSelect = 'select nombre, idUsuario from servicio INNER JOIN usuario ON usuario.id = servicio.idUsuario WHERE estado = 0 LIMIT 15';
        return $this->oMySQL->ejecutarConsultaSelect($sqlSelect);
    }

    function getServiciosTaxista($idTaxista) {
        $sqlSelect = 'select fechaInicial as nombre, idServicio as id from servicio WHERE idUsuario = "' . $idTaxista . '" LIMIT 15';
        return $this->oMySQL->ejecutarConsultaSelect($sqlSelect);
    }

    function getTaxistaRecorridoId($idTaxista, $idServicio) {
        $m = new MongoClient();

        // seleccionar una base de datos
        $bd = $m->yavoy;

        // seleccionar una colección
        $colección = $bd->posicion;
        $cursor = $colección->find(array("idConductor" => $idTaxista, "idServicio" => $idServicio),
                array("_id"=> false));
        return iterator_to_array($cursor);
    }
    
    function cambiarRolAdmin($idUsuario) {
        $sql = 'UPDATE usuario SET rol="administrador" WHERE id='.$idUsuario;
        $this->oMySQL->ejecutarConsultaI($sql);
    }
    
    function eliminarUsuario($idUsuario) {
        $sql = 'DELETE FROM usuario WHERE id="' . $idUsuario . '"';
        return $this->oMySQL->ejecutarConsultaI($sql);
    }

    /**
     * Función que termina la conexión con la base de datos
     */
    function terminarConexion() {
        $this->oMySQL->cerrarConexion();
    }

}

?>
