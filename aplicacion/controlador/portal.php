<?php

class Portal extends Controlador {

    public function __construct() {
        parent::__construct();
    }

    function /* void */ index() {
        echo "Hola Mundo";
    }
    
    function pruebagcm() {
        $str = $_POST["mensaje"];
        include LIBRERIAS."GCMPushMessage.php";
        $objGCM = new GCMPushMensaje();
        $objGCM->setDevices('APA91bEgrhktnhqrm1mqIUDFw53AM-cG-eZVRoni_aSTDuYQlGygi3Zpsp8aJse_XfgiKIyyk7GSDJFJ9P3HcIJCRvA665AOuMvIqk1fe_l_iJGGh3ATJZ_j20zqU0qXfJsZ4qb9LNXE4n-pwSNRQax1L6S9EiCs6HoTetSOynLOfOXDXNMM6-Y');
        $objGCM->send($str);
    }
    
    /*
     * Retorna el:
     *   Estado fila restaurantes
     *   Estado fila tickets
     *   Menú del día
     */
    function /* void */ actualidad() {
        $modeloPortal = $this->cargarModelo("Portal");
        $dia = date('Y-m-d H:i:s');
        $menuDia = array(new stdClass());//$modeloPortal->getMenuDia($dia);
        $estadoRestaurantes = $modeloPortal->estadoRestaurante($dia);
        $estadoTickets = $modeloPortal->estadoTickets($dia);
        echo json_encode(
              array("error"=> 0,"log"=> "Conseguido", "menu" => $menuDia[0],
                  "estadoRestaurantes"=> $estadoRestaurantes[0]->calificacion,"estadoTickets"=> $estadoTickets[0]->calificacion));
    }
    
    /**
     * Agrega un voto al sistema sobre el estado de los tickets
     */
    function /* void */ votarRestaurante() {
        /*echo "Imprimiendo post\n";
        print_r($_POST);
        echo "Imprimiendo file\n";
        print_r($_FILES);*/
        
        $fecha = date('Y-m-d');
        $hora = date('H:i:s');
        $valorVoto = floatval($_POST["voto"]);
        $modeloPortal = $this->cargarModelo("portal");
        $modeloPortal->insertarVotoRestaurante($fecha,$hora,$valorVoto);       
        
        if(!isset($_FILES) || count($_FILES)==0){
            echo json_encode(array("error"=> 0,"log"=> "Sin imagen"));
            return;
        }
        // empezar transacción
        //$modeloPortal->iniciarTransaccion();
        $idImagen = $modeloPortal->insertarImagenRestaurante($fecha,$hora);
        require_once  LIBRERIAS."bulletproof.php";
        $image = new ImageUploader\BulletProof;
        try{
            $image->fileTypes(["png", "jpeg"]) 
            ->uploadDir(DIR_APP."public/imagenes/restaurante") 
            ->limitSize(["min"=>1000, "max"=>400000])  
            ->limitDimension(["height"=>10000, "width"=>10000])
            ->upload($_FILES[0],$idImagen);
        }  catch (Exception $e){
            // roll back
            //$modeloPortal->rollBack();
            echo json_encode(array("error"=> 1,"log"=> $e->getMessage(), "idImagen" => ""));
            return;
        }
        // commit 
        //$modeloPortal->finalizarTransaccion();
        echo json_encode(array("error"=> 0,"log"=> "Conseguido", "idImagen" => $idImagen));
    }
    
    /**
     * Agrega un voto al sistema sobre el estado de los tickets
     */
    function /* void */ votarTickets() {
        $fecha = date('Y-m-d');
        $hora = date('H:i:s');
        $valorVoto = floatval($_POST["voto"]);
        $modeloPortal = $this->cargarModelo("portal");
        $modeloPortal->insertarVotoTickets($fecha,$hora,$valorVoto);
        if(!isset($_FILES) || count($_FILES)==0){
            echo json_encode(array("error"=> 0,"log"=> "Sin imagen"));
            return;
        }
        // empezar transacción
        // $modeloPortal->iniciarTransaccion();
        $idImagen = $modeloPortal->insertarImagenTickets($fecha,$hora );
        
        require_once  LIBRERIAS."bulletproof.php";
        $image = new ImageUploader\BulletProof;
        try{
            $image->fileTypes(["png", "jpeg"]) 
            ->uploadDir(DIR_APP."public/imagenes/tickets") 
            ->limitSize(["min"=>1000, "max"=>400000])  
            ->limitDimension(["height"=>10000, "width"=>10000])
            ->upload($_FILES[0],$idImagen);
        }  catch (Exception $e){
            // roll back
            //$modeloPortal->rollBack();
            echo json_encode(array("error"=> 1,"log"=> $e->getMessage(), "idImagen" => ""));
            return;
        }
        // commit 
        //$modeloPortal->finalizarTransaccion();
        echo json_encode(array("error"=> 0,"log"=> "Conseguido", "idImagen" => $idImagen));
    }

}
