<?php

class Historial extends Controlador {

    public function __construct() {
        parent::__construct();
    }
    
    function /* void */ index() {
        echo "Hola Mundo";
    }
    
    function /* void */ getHistorialDia() {
        $fecha = $_POST["dia"]; // En realidad es una fecha
        $modeloHistorial = $this->cargarModelo("historial");
        $registros = $modeloHistorial->getRegistrosDia($fecha);
        echo json_encode(array("error"=> 0,"log"=> "Conseguido", "registros" => $registros));
    }
    
    function /* void */ getHistorialMes() {
        $fecha = $_POST["mes"]; // En realidad es una fecha con un día cualquiera
        $modeloHistorial = $this->cargarModelo("historial");
        $registros = $modeloHistorial->getRegistrosMes($fecha);
        echo json_encode(array("error"=> 0,"log"=> "Conseguido", "registros" => $registros));
    }
}
