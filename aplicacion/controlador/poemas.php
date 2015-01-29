<?php

class Poemas extends Controlador {

    public function __construct() {
        parent::__construct();
    }

    function /* void */ index() {
        echo "Hola Mundo";
    }

    // 
    function /* void */ getUltimosPoemas() {
        $ultimoId = $_POST["idUltimoPoema"];
        $modeloPoema = $this->cargarModelo("poema");
        $poemas = $modeloPoema->getUltimosPoemas($ultimoId);
        echo json_encode(array("ultimoId"=> $ultimoId, "error"=> 0,"log"=> "Conseguido", "poemas" => $poemas));
    }
    
    // 
    function /* void */ getPoemas() {
        $primerId = $_POST["idPoemaInicial"];
        $ultimoId = $_POST["idPoemaFinal"];
        $modeloPoema = $this->cargarModelo("poema");
        $poemas = $modeloPoema->getPoemas($primerId,$ultimoId);
        echo json_encode(array("ultimoId"=> $ultimoId, "error"=> 0,"log"=> "Conseguido", "poemas" => $poemas));
    }
    
}
