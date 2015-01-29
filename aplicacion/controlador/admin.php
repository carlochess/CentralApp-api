<?php

class Admin extends Controlador {

    public $categoria;

    public function __construct() {
        parent::__construct();
        if (!$this->esAdmin())
            header('Location: ' . URL);
    }

    /**
     * Función que despliega la página base del modulo de
     * administración.
     */
    function /* void */ index() {
        $this->categoria = "informacion";
        $modelranking = $this->loadModel("modelRanking");
        $ultimosUsuarios = $modelranking->ultimosUsuarios();
        $ultimosPagos = $modelranking->ultimosPagos();
        $pasajerosMasActivos= $modelranking->pasajerosMasActivos();
        $taxistasMasActivos = $modelranking->taxistasMasActivos();
        require('aplicacion/vista/Admin/header.php');
        require('aplicacion/vista/Admin/index.php');
        require('aplicacion/vista/Admin/footer.php');
    }

    function /* void */ perfil() {
        $modelprod = $this->loadModel("modeloRegistroUsuario");
        $idConductor = $this->login->getIDUsuario();
        $usuario = $modelprod->getPerfil($idConductor)[0];
        require('aplicacion/vista/Admin/header.php');
        require('aplicacion/vista/Admin/perfil.php');
        require('aplicacion/vista/Admin/footer.php');
    }

    /**
     * Función que despliega la página base del modulo de
     * administración.
     */
    function /* void */ exportar() {
        $this->categoria = "exportar";
        $modelExportar = $this->loadModel("modelExportar");
        $productosJson = $modelExportar->getProductos();
        require('aplicacion/vista/Admin/header.php');
        require('aplicacion/vista/Admin/exportar.php');
        require('aplicacion/vista/Base/footer.php');
    }

    /**
     * Función que despliega la página para la administración
     * de convocatorias.
     */
    function /* void */ agregarTaxista() {
        require('aplicacion/vista/Admin/header.php');
        require('aplicacion/vista/Admin/agregarTaxista.php');
        require('aplicacion/vista/Admin/footer.php');
    }

    /**
     * Función que despliega la página para la administración
     * de convocatorias.
     */
    function /* void */ cuenta() {
        $modelprod = $this->loadModel("modeloRegistroUsuario");
        $cuentas = $modelprod->getClientes();
        require('aplicacion/vista/Admin/header.php');
        require('aplicacion/vista/Admin/cuenta.php');
        require('aplicacion/vista/Admin/footer.php');
    }

    function tiempoReal() {
        require('aplicacion/vista/Admin/header.php');
        require('aplicacion/vista/Admin/tiempoReal_1.php');
        require('aplicacion/vista/Admin/footer.php');
    }

    /**
     * Función que despliega la página para la administración
     * de clientes.
     */
    function /* void */ clientes() {
        $this->categoria = "clientes";
        $modelprod = $this->loadModel("modeloRegistroUsuario");
        $clientes = $modelprod->getClientes();
        require('aplicacion/vista/Admin/header.php');
        require('aplicacion/vista/Admin/cliente.php');
        require('aplicacion/vista/Admin/footer.php');
    }
    
    function /* void */ taxistas() {
        $this->categoria = "clientes";
        $modelprod = $this->loadModel("modelTaxista");
        $clientes = $modelprod->getTaxistas();
        require('aplicacion/vista/Admin/header.php');
        require('aplicacion/vista/Admin/taxistas.php');
        require('aplicacion/vista/Admin/footer.php');
    }
    
    function /* void */ saldo() {
        $this->categoria = "clientes";
        $modelprod = $this->loadModel("modeloRegistroUsuario");
        $clientes = $modelprod->getClientes();
        require('aplicacion/vista/Admin/header.php');
        require('aplicacion/vista/Admin/saldo.php');
        require('aplicacion/vista/Admin/footer.php');
    }

    /**
     * Función encargada de desplegar la página de configuración de reportes
     */
    function /* void */ reportes() {
        $this->categoria = "reportes";
//$modelprod = $this->loadModel("modelProd");
//$productos = $modelprod->getProductos();
//$modelprod->terminarConexion();
        require('aplicacion/vista/Admin/header.php');
        require('aplicacion/vista/Admin/reportes.php');
        require('aplicacion/vista/Admin/footer.php');
    }

    function getTaxisActivos() {
        $rectangulo = $_POST['mensaje'];
        $puntos = explode(",", trim($rectangulo, '"'));
        $modelprod = $this->loadModel("modelAdmin");
        $taxistas = $modelprod->getTaxisEnPerimetro($rectangulo);
        echo json_encode($taxistas);
    }
    
    function getUsuarios() {
        $rectangulo = $_POST['mensaje'];
        $puntos = explode(",", trim($rectangulo, '"'));
        $modelprod = $this->loadModel("modelAdmin");
        $taxistas = $modelprod->getUsuarioEnPerimetro($rectangulo);
        echo json_encode($taxistas);
    }

    /**
     * Enviar el id de los taxistas junto con su nombre
     */
    function gerRecomendacionTaxistas() {
        $modelprod = $this->loadModel("modelAdmin");
        $taxistas = $modelprod->getTaxistas();
        echo json_encode($taxistas);
    }
    /**
     * Dado el id del taxista encontrar todos sus servicios
     */
    function getServiciosTaxista() {
        $modelprod = $this->loadModel("modelAdmin");
        $idTaxista = $_POST['mensaje'];
        $serviciosTaxista = $modelprod->getServiciosTaxista($idTaxista);
        echo json_encode($serviciosTaxista);
    }
    /**
     * Dado el id de un servicio, delvover todos los puntos
     */
    function encontrarRecorrido() {
        $modelprod = $this->loadModel("modelAdmin");
        $idTaxista = $_POST['idTaxista'];
        $idRecorrido = $_POST['idRecorrido'];
        $serviciosTaxista = $modelprod->getTaxistaRecorridoId($idTaxista,$idRecorrido);
        echo json_encode($serviciosTaxista);
    }
    
    //------------------ Sin emplementar
    function convertirEnAdministrador($usuarios) {
        $modelAdmin = $this->loadModel("modelAdmin");
        $idUsuario = $usuarios[0];
        $modelAdmin->cambiarRolAdmin($idUsuario);
    }
    function eliminarUsuario($usuarios) {
        $modelAdmin = $this->loadModel("modelAdmin");
        $idUsuario = $usuarios[0];
        $modelAdmin->eliminarUsuario($idUsuario);
    }
}
