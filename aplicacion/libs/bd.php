<?php

class MySQL {

    static private $mysql;
    var $lastError; // El último error
    var $lastQuery; // Mantiene la última consulta
    var $filasAfectadas; // número de filas afectadas en un Ins
    var $hostname; // dirección BD
    var $username; // usuario BD
    var $password; // Clave BD
    var $database; // Nombre de la BD a conectar
    var $db;

    /* ******************
     * Constructor       *
     * ****************** */

    private function __construct() {
        $this->conectar();
        $this->db->exec("set names utf8");
    }

    /* ******************
     * Funciones privadas *
     * ****************** */

    // Conecta a la BD
    private function /* bool */ conectar() {
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        try {
            $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }

    /* *****************
     * Funciones públicas *
     * ***************** */

    public static function getBD() {
        if (self::$mysql == null) {
            self::$mysql = new MySQL();
        }
        return self::$mysql;
    }
    
    function /* array(stdClass) */ seleccionar($query, $parametros) {
        $query = $this->db->prepare($query);
        $query->execute($parametros);
        $this->filasAfectadas = $query->rowCount();
        return $query->fetchAll();
    }
    
   
    function /* void */ insertar($q, $arreglo) {
        try {
            $query = $this->db->prepare($q);
            $query->execute($arreglo);
            return $this->db->lastInsertId();
        } catch (PDOException $ex) {
            return -1;
        }
    }
    
    function /* void */ eliminar($q, $arreglo) {
        try {
            $query = $this->db->prepare($q);
            $query->execute($arreglo);
            $this->filasAfectadas = $query->rowCount();
        } catch (PDOException $ex) {
            return false;
        }
        return true;
    }
    
    function /* void */ actualizar($q, $arreglo) {
        try {
            $query = $this->db->prepare($q);
            $query->execute($arreglo);
            $this->filasAfectadas = $query->rowCount();
        } catch (PDOException $ex) {
            return false;
        }
        return true;
    }
    
    function /* void */ iniciarTransaccion(){
        $this->db->beginTransaction();
    }
    
    function /* void */ finalizarTransaccion(){
        $this->db->commit();
    }
    
    function /* void */ desecharTransaccion(){
        $this->db->rollBack();
    }

    // Retorna el número de filas del resultado de una
    // consulta.
    function /* int */ contarFilasAfectadas() {
        return $this->filasAfectadas;
    }

    // Retorna el id de la última inserción 
    // ver http://es.wikipedia.org/wiki/ACID
    function /* string */ getLastID() {
        return $this->db->lastInsertId();
    }
    
    // Retorna el id de la última inserción 
    // ver http://es.wikipedia.org/wiki/ACID
    function /* string */ obtenerUltimoId($nombreColumna) {
        return $this->db->lastInsertId($nombreColumna);
    }

    // Cierra la conexión
    function /* void */ cerrarConexion() {
        $this->db = null;
    }

}

?>