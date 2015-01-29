<?php

date_default_timezone_set('America/Bogota');

// Carga la configuración, 
require 'aplicacion/cfg/config.php';

// Carga el controlador de la aplicación (CGI)
require 'aplicacion/libs/FrameWork.php';

// Carga el controlador 
require 'aplicacion/libs/controlador.php';

// Carga el controlador de la aplicación (CGI)
// require 'aplicacion/libs/vendor/autoload.php';
// configurar autoloading
//require 'aplicacion/libs/orm/vendor/autoload.php';
// configurar Propel
//require 'aplicacion/libs/orm/generated-conf/config.php';

if (DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('memory_limit', '-1');
}
// Inicia la app
$app = new FrameWork();
?>
