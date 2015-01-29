<?php

/**
 * Clase encargada de el control de la página principal
 */
class Home extends Controlador {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Función encargada de desplegar la página
     * Principal de la aplicación
     */
    function /* void */ index() {
        echo "Estas en la casa";
    }

}
