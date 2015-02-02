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
    
    function /* void */ getHistorialSemana() {
        $diasPost = $_POST["dias"]; // En realidad es una fecha
        $dias = explode(",", $diasPost);
        $qMarks = str_repeat('?,', count($dias) - 1) . '?';
        $modeloHistorial = $this->cargarModelo("historial");
        $registros = $modeloHistorial->getRegistrosSemana($qMarks,$dias);
        echo json_encode(array("error"=> 0,"log"=> "Conseguido", "registros" => $registros));
    }
    
    function /* void */ getHistorialMes() {
        $fecha = $_POST["mes"]; // En realidad es una fecha con un día cualquiera
        $modeloHistorial = $this->cargarModelo("historial");
        $registros = $modeloHistorial->getRegistrosMes($fecha);
        echo json_encode(array("error"=> 0,"log"=> "Conseguido", "registros" => $registros));
    }
}
