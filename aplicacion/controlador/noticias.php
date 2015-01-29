<?php

class Noticias extends Controlador {

    public function __construct() {
        parent::__construct();
    }

    function /* void */ index() {
        echo "Hola Mundo";
    }
    
    function /* void */ getNoticiasDia() {
        $dia = $_POST["dia"]; // En realidad es una fecha
        $modeloNoticias = $this->cargarModelo("noticia");
        $noticia = $modeloNoticias->getNoticiasDia($dia);
        echo json_encode(array("error"=> 0,"log"=> "Conseguido", "noticias" => $noticia));
    }
}
