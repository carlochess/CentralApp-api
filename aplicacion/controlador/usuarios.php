<?php

Class Users extends Controlador {

    private $modelUsuario;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        echo '{error: 404, log: "Acceso no permitido"}';
    }


    public function entrar() {
        if ((isset($_POST['login']) || isset($_POST['correo'])) && isset($_POST['password'])) {
            $nombreUsuario = (isset($_POST['login']) ? $_POST['login'] : "");
            $correoUsuario = (isset($_POST['correo']) ? $_POST['correo'] : "");
            $contrasenaUsuario = $_POST['password'];

            $this->modelUsuario = $this->loadModel("modeloRegistroUsuario");
            $datosUser = $this->modelUsuario->searchUserNombreCorreo($nombreUsuario, $correoUsuario);
            if (count($datosUser) == 1) {
                if (strcmp($datosUser[0]->password, $contrasenaUsuario) == 0) {
                    if (empty($datosUser[0]->token)) {
                        $token = md5(uniqid(mt_rand(), true));
                        $this->modelUsuario->asignarAccesstoken($datosUser[0]->id, $token);
                    }
                    $datosUser[0]->error = 0;
                    $datosUser[0]->log = "Datos válidos";
                    echo json_encode($datosUser[0]);
                    return;
                } else {
                    echo '{error: 1, log: "Datos invalidos"}';
                    return;
                }
            } else {
                echo '{error: 2, log: "Datos invalidos"}';
                return;
            }
        }
        echo '{error: 3, log: "Datos invalidos"}';
        return;
    }

    public function entrarWeb() {
        $nombreUsuario = (isset($_POST['login']) ? $_POST['login'] : "");
        $correoUsuario = (isset($_POST['correo']) ? $_POST['correo'] : "");
        $contrasenaUsuario = $_POST['password'];

        $this->modelUsuario = $this->loadModel("modeloRegistroUsuario");
        $datosUser = $this->modelUsuario->searchUserNombreCorreo($nombreUsuario, $correoUsuario);
        if (count($datosUser) == 1) {
            if (strcmp($datosUser[0]->password, $contrasenaUsuario) == 0) {
                $_SESSION['user_name'] = $datosUser[0]->nombre;
                $_SESSION['user_email'] = $datosUser[0]->correo;
                $_SESSION['user_login_status'] = $datosUser[0]->id;
                $_SESSION['user_id'] = $datosUser[0]->id;
                $_SESSION['user_rol'] = $datosUser[0]->rol;
                $_SESSION['user_image'] = URL . "public/imagenes/usuarios/" . $datosUser[0]->id . "x";
                if (strcmp($datosUser[0]->rol, "administrador") == 0) {
                    header("Location: " . URL . "/admin/index");
                    return;
                }
                header("Location: " . URL . "cuenta/index");
                return;
            } else {
                header("Location: " . URL . "home/login");
                return;
            }
        } else {
            header("Location: " . URL . "home/login");
            return;
        }
        header("Location: " . URL . "home/login");
        return;
    }
    
    public function perfil() {
        if ($this->login->esAnonimo()) {
            echo '{error: 404, log: "Acceso no permitido"}';
            return;
        }
        $idUsuario = $_POST["idUsuario"];
        $modelUsuario = $this->loadModel("modeloRegistroUsuario");
        $perfil = $modelUsuario->getPerfil($idUsuario);
        if (count($perfil) > 0) {
            echo json_encode($perfil);
        } else {
            echo '{error: 1, log: "Error al registrar"}';
        }
        return;
    }

    /**
     * sale
     */
    public function salir() {
        $_SESSION = array();
        session_destroy();
        header('Location: ' . URL . "home/login");
        return;
    }

}
