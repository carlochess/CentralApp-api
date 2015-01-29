<?php

class Galeria extends Controlador {

    public function __construct() {
        parent::__construct();
    }

    function /* void */ index() {
        echo "Hola Mundo";
    }

    //
    function /* void */ getUltimasimagenes() {
        $ultimoId = $_POST["idUltimaImagen"];
        $modeloGaleria = $this->cargarModelo("galeria");
        $imagenes = $modeloGaleria->getUltimasImagenes($ultimoId);
        echo json_encode(array("ultimoId"=> $ultimoId, "error"=> 0,"log"=> "Conseguido", "imagenes" => $imagenes));
    }
    
    function /* void */ getImagenes() {
        $primerId = $_POST["idImagenInicial"];
        $ultimoId = $_POST["idImagenFinal"];
        $modeloGaleria = $this->cargarModelo("galeria");
        $imagenes = $modeloGaleria->getImagenes($primerId,$ultimoId);
        echo json_encode(array("ultimoId"=> $ultimoId, "error"=> 0,"log"=> "Conseguido", "poemas" => $imagenes));
    }
    
    // aumentar riesgo imagen
    function /* void */ denunciarFoto() {
        $idImagen = $_POST["idImagen"];
        $modeloGaleria = $this->cargarModelo("galeria");
        $modeloGaleria->denunciarFoto($idImagen);
        echo json_encode(array("error"=> 0,"log"=> "Denunciada"));
    }
}
