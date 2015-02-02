
<?php

class ModeloPortal {
    private $oMySQL;

    function __construct(MySQL $db) {
        $this->oMySQL = $db;
    }

    /**  */
    function /* array(stdObject) */ getMenuDia($dia) {
        return $this->oMySQL->seleccionar(
                'SELECT * FROM menu WHERE fecha = date(?)', array($dia));
    }
    
    /**  */
    function /* array(stdObject) */ estadoRestaurante($dia) {
        return $this->oMySQL->seleccionar(
                'SELECT calificacion FROM estadotemprestaurante ORDER BY hora DESC LIMIT 1', array());
    }
    
    /**  */
    function /* array(stdObject) */ estadoTickets($dia) {
        return $this->oMySQL->seleccionar(
                'SELECT calificacion FROM estadotemptickets ORDER BY hora DESC LIMIT 1', array());
    }

    function /* void */ insertarVotoRestaurante($fecha, $hora, $valorVoto){
        return $this->oMySQL->insertar("INSERT INTO votosrestaurante(fecha,hora,calificacion) VALUES (?,?,?)", array($fecha, $hora, $valorVoto));
    }
    
    function /* boolean */ insertarVotoTickets($fecha, $hora, $valorVoto){
        return $this->oMySQL->insertar("INSERT INTO votostickets(fecha, hora, calificacion) VALUES (?,?,?)", array($fecha, $hora, $valorVoto));
    }
    
    function /* boolean */ insertarImagenRestaurante($fecha, $hora){
        return $this->oMySQL->insertar("INSERT INTO imagenrestaurante(fecha, hora) VALUES (?,?)", 
                array($fecha, $hora));
    }
    
    function /* boolean */ insertarImagenTickets($fecha, $hora){
        return $this->oMySQL->insertar("INSERT INTO imagenticket(fecha, hora) VALUES (?,?)", array($fecha, $hora));
    }
    
    function /* int */ ultimoId($columna){
        $this->oMySQL->obtenerUltimoId($columna);
    }
    
    function /* void */ iniciarTransaccion(){
        $this->oMySQL->iniciarTransaccion();
    }
    
    function /* void */ rollBack(){
        $this->oMySQL->desecharTransaccion();
    }
    
    function /* void */ finalizarTransaccion(){
        $this->oMySQL->finalizarTransaccion();
    }
    
}
