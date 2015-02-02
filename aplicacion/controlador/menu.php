<?php

class Menu extends Controlador {

    public function __construct() {
        parent::__construct();
    }
    
    function /* void */ index() {
        echo "Hola Mundo";
    }

    
    function /* void */ getMenuDia() {
        $dia = $_POST["dia"]; // En realidad es una fecha
        $modeloMenu = $this->cargarModelo("menu");
        $menu = $modeloMenu->getMenuDia($dia);
        echo json_encode(array("error"=> 0,"log"=> "Conseguido", "menu" => $menu));
    }
    
    function /* void */ getMenuDias() {
        $diasPost = $_POST["dias"]; // En realidad es una fecha
        $dias = explode(",", $diasPost);
        $qMarks = str_repeat('?,', count($dias) - 1) . '?';
        $modeloMenu = $this->cargarModelo("menu");
        $menu = $modeloMenu->getMenuDias($qMarks,$dias);
        echo json_encode(array("error"=> 0,"log"=> "Conseguido", "menu" => $menu));
    }
    
    function /* void */ getMenuSemana() {
        $semana = $_POST["semana"]; // El número de la semana
        $modeloMenu = $this->cargarModelo("menu");
        $menu = $modeloMenu->getMenuSemana($semana);
        echo json_encode(array("error"=> 0,"log"=> "Conseguido", "menu" => $menu)); // Esto deberia ser un arreglo de...
    }
}
