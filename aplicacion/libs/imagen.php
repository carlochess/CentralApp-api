	
<?php

class Imagen  extends Controlador {

    var $nombreImagen;
    var $extensionImagen;
    var $tamaño;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        header('Location: ' . URL);
    }
    
    function hacerMiniatura($src, $nombre, $longitud, $desired_width) {//$extension
        $extension = 'jpg';
        $thumb = new easyphpthumbnail;
        $thumb->Thumbheight = $desired_width;
        $thumb->Thumbwidth = $desired_width;
        $thumb->Thumblocation = 'imagenes/';
        $thumb->Thumbprefix = '';
        $thumb->Thumbsaveas = $extension;
        $thumb->Thumbfilename = $nombre . $longitud . $extension;
        $thumb->Createthumb($src, 'file');
    }

    private function guardarImagen($idPropietario, $subRuta="") {
        $allowedExts = array("jpeg", "jpg", "gif", "png");
        $allowedTypes = array("image/jpeg", "image/jpg", "image/pjpeg", "image/gif", "image/x-png", "image/png");
        if (isset($_FILES) && isset($_FILES['file']) && $_FILES['file']['size'] > 0) {
            $temp = explode(".", $_FILES["file"]["name"]);
            $extension = strtolower(end($temp));
            $type = strtolower($_FILES["file"]["type"]);
            if (in_array($type, $allowedTypes) && ($_FILES["file"]["size"] < 10000000) && in_array($extension, $allowedExts)) {
                if ($_FILES["file"]["error"] > 0) {
                    return FALSE;
                } else {
                    $carpeta = DIR_APP."public/imagenes/".$subRuta;
                    $nombreIMG = $idPropietario . '.' . $extension;
                    $v = $carpeta . $nombreIMG;
                    $path_parts = pathinfo($v);
                    $nombre = $path_parts['dirname'] . '/' . $path_parts['filename'];
                    if (file_exists($carpeta . $_FILES["file"]["name"])) {
                        unlink($carpeta . $_FILES["file"]["name"]);
                        /*unlink($carpeta . $path_parts['filename'] . 'x400.' . $path_parts['extension']);
                        unlink($carpeta . $path_parts['filename'] . 'x200.' . $path_parts['extension']);
                        unlink($carpeta . $path_parts['filename'] . 'x50.' . $path_parts['extension']);*/
                    }
                    move_uploaded_file($_FILES["file"]["tmp_name"], $v);
                    /*$this->hacerMiniatura($v, $codigoProd, 'x400.', 400);
                    $this->hacerMiniatura($v, $codigoProd, 'x200.', 200);
                    $this->hacerMiniatura($v, $codigoProd, 'x50.', 50);*/
                    $this->nombreImagen = $nombreIMG;
                    $this->extensionImagen = $extension;
                    $this->tamaño = $_FILES["file"]["size"];
                    return true;
                }
            } else {
                return FALSE;
            }
        }
        return FALSE;
    }
    
    public function guardarImagenUsuario() {
        if($this->login->esAnonimo()){
            echo '{error: 404, log: "Acceso no permitido"}';
            return ;
        }
        //--------------------------
        $model_img_usuario = $this->loadModel("modelImagen");
        
        $idPropietario = $this->login->getIDUsuario();        
        
        if($this->guardarImagen($idPropietario)){
            $model_img_usuario->guardarImgUsuario($idPropietario,$this->nombreImagen, $this->extensionImagen, $this->tamaño);
            echo '{error : 0, log : "imagen agregada exitosamente"}';
        }
        else{
            echo '{error : 1, log : "Error al guardar imagen"}';
        }
    }
    
    public function guardarImagenAuto() {
        if($this->login->esAnonimo()){
            echo '{error: 404, log: "Acceso no permitido"}';
            return ;
        }
        //--------------------------
        $model_img_usuario = $this->loadModel("modelImagen");
        
        $id_auto = $_POST["idauto"];
        
        $idPropietario = $this->login->getIDUsuario()."_".$id_auto;
        
        if($this->guardarImagen($idPropietario, "autos/")){
            $model_img_usuario->guardarImgAuto($id_auto,$this->nombreImagen, $this->extensionImagen, $this->tamaño);
            echo '{error : 0, log : "imagen agregada exitosamente"}';
        }
        else{
            echo '{error : 1, log : "Error al guardar imagen"}';
        }
    }
    
    public function getImagenUsuario() {
        if($this->login->esAnonimo()){
            echo '{error: 404, log: "Acceso no permitido"}';
            return ;
        }
        //--------------------------
        $model_img_usuario = $this->loadModel("modelImagen");
        
        $idUsuario = $_POST["idUsuario"];
        $imagen = $model_img_usuario->getImagenUsuario($idUsuario);
        if(count($imagen)){
            echo json_encode(array("error"=> "0", "log" => "Imagen encontrada", "imagen" => $imagen[0]));
        }else{
            echo '{error : 1, log : "Error imagen no encontrada"}';
        }
    }

    public function getImagenAuto() {
        if($this->login->esAnonimo()){
            echo '{error: 404, log: "Acceso no permitido"}';
            return ;
        }
        //--------------------------
        $model_img_usuario = $this->loadModel("modelImagen");
        $idPropietario = $this->login->getIDUsuario();
        $id_auto = $_POST["idAuto"];
        $imagen = $model_img_usuario->getImagenAuto($idPropietario, $id_auto);
        if(count($imagen)){
            echo json_encode(array("error"=> "0", "log" => "Imagen encontrada", 'imagen' => $imagen[0]));
        }else{
            echo '{error : 1, log : "Error imagen no encontrada"}';
        }
    }

}
