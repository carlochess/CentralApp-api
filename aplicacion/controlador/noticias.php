<?php

class Noticias extends Controlador {

    public function __construct() {
        parent::__construct();
    }

    function /* void */ index() {
        echo "Hola Mundo";
    }
    
    function /* void */ getNoticiasDia() {
        $idUltimaNoticia = $_POST["idUltimaNoticia"];
        $modeloNoticias = $this->cargarModelo("noticia");
        $noticia = $modeloNoticias->getNoticiasDia($idUltimaNoticia);
        echo json_encode(array("error"=> 0,"log"=> "Conseguido", "noticias" => $noticia));
    }
}
