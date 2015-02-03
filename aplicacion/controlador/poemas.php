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
    
    function /* void */ agregarPoema() {
        $titulo = $_POST["titulo"];
        $contenido = $_POST["contenido"];
        $fecha = $_POST["fecha"];
        $cuenta = $_POST["cuenta"];
        $idTelefono = $_POST["idTelefono"];
        echo $titulo." ".$contenido." ".$fecha." ".$cuenta." ".$idTelefono;
        $modeloPoema = $this->cargarModelo("poema");
        $idImagenPoema = $modeloPoema->insertarPoema($titulo,$contenido,$fecha,$cuenta,$idTelefono);
        if(!isset($_FILES) || count($_FILES)==0){
            echo json_encode(array("error"=> 0,"log"=> "Conseguido, sin imagen"));
            return;
        }
        // empezar transacción
        require_once  LIBRERIAS."bulletproof.php";
        $image = new ImageUploader\BulletProof;
        try{
            $image->fileTypes(["png", "jpeg"]) 
            ->uploadDir(DIR_APP."public/imagenes/poemas") 
            ->limitSize(["min"=>1000, "max"=>400000])  
            ->limitDimension(["height"=>10000, "width"=>10000])
            ->upload($_FILES[0],$idImagenPoema);
        }  catch (Exception $e){
            // roll back
            echo json_encode(array("error"=> 1,"log"=> $e->getMessage(), "idImagen" => ""));
            return;
        }
        // commit 
        echo json_encode(array("error"=> 0,"log"=> "Conseguido"));
    }
}
