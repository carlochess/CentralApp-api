<?php

/**
 * maneja el log-in y el log-out del usuario
 */
class Login {

    var $rol;
    var $id;
    var $nombre;

    public function __construct($modelUsuario) {
        if (isset($_POST['token'])) {
            $retultado = $modelUsuario->getRol($_POST['token']);
            if (count($retultado) > 0) {
                $this->rol = $retultado[0]->rol;
                $this->id = $retultado[0]->id;
                $this->nombre = $retultado[0]->nombre;
            }else{
                $this->rol = "anonimo";
            }
        } else {
            $this->rol = "anonimo";
            if(isset($_SESSION) && isset($_SESSION['user_rol'])){
                if(strcmp($_SESSION['user_rol'], 'administrador') == 0){
                    $this->rol = "admin";
                }else{
                    $this->rol = "normal";
                }
                $this->id = $_SESSION['user_id'];
                $this->nombre = $_SESSION['user_name'];
            }
        }
    }

    public function estaConectado() {
        return $this->rol;
    }

    public function getNombreUsuario() {
        return $_SESSION['user_name'];
    }

    public function getIDUsuario() {
        return $this->id;
    }

    public function esAdmin() {
        return strcmp($this->rol, "admin") == 0;
    }

    public function esAnonimo() {
        if (isset($this->rol))
            return strcmp($this->rol, "anonimo") == 0;
        return false;
    }

}
