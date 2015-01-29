<?php

include_once 'bd.php';
include_once 'login.php';
//include_once 'postData.php';
/**
 * Clase base controladores
 */
class Controlador {

    protected $login;
    private $oMySQL;

    function __construct() {
        $this->oMySQL = MySQL::getBD();
        /*$modelUsuario = $this->cargarModelo("RegistroUsuario");
        $this->login = new Login($modelUsuario);*/
    }

    /**
     * Carga el modelo según el nombre.
     * @param string $model_name El nombre del modelo
     * @return objeto del modelo
     */
    public function cargarModelo($nombreModelo) {
        $nombreModelo = 'modelo'.$nombreModelo;
        require_once 'aplicacion/modelo/' . strtolower($nombreModelo) . '.php';
        return new $nombreModelo($this->oMySQL);
    }
    
    /**
     * Carga una vista según el nombre.
     * @param string $nombreVista El nombre de la vista
     * @return objeto del modelo
     */
    public function cargarVista($nombreVista) {
        require_once 'aplicacion/vista/' . strtolower($nombreVista) . '.php';
    }

    /**
     * Esta conectado
     */
    public function estaConectado(){
        return !$this->login->esAnonimo();
    }
    
    public function getNombre() {
        return $this->login->getNombreUsuario();
    }
    
    public function esAdmin(){
        return $this->login->esAdmin();
    }
    
    public function getID(){
        return $this->login->getIDUsuario();
    }
    
    public function recuperarPost($cadena){
        return ;// $_POST['$cadena'];
    }
    public function enviarCorreo(/* Parametros */){
        return ;// ¿fue enviado?;
    }
    public function devolverJson(/* cadena ó  */){
        return ;// ¿fue enviado?;
    }
}
