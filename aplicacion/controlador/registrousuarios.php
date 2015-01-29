<?php

Class Users extends Controlador {

    private $modelUsuario;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        echo '{error: 404, log: "Acceso no permitido"}';
    }

    public function eliminar($id) {
        $this->modelUsuario = $this->loadModel("modeloRegistroUsuario");
        //$this->modelUsuario->deleteUser($id[0]);
    }

    public function registrarse() {
        try {
            $nombreU = $_POST['nombre'];
            $correoU = $_POST['correoUsuario'];
            $sexo = $_POST['sexo'];
            $pass = $_POST['password'];
            $activo = TRUE;

            $this->modelUsuario = $this->loadModel("modeloRegistroUsuario");
            $flag = $this->modelUsuario->existsUser($nombreU, $correoU);
            if (count($flag) == 0) {
                if ($this->modelUsuario->createUser($nombreU, $correoU, $sexo, $pass, $activo, date('Y-m-d H:i:s'))) {
                    $idUsuario = $this->modelUsuario->getLastId();
                    $this->enviarCorreoConfirmacion($nombreU, $correoU, md5($nombreU . $correoU));
                    $this->verificarReferido($correoU);
                    $this->modelUsuario->agregarPreferencias($idUsuario);
                    echo '{error: 0, log: "Registrado exitosamente"}';
                }
            } else {
                echo '{error: 1, log: "Login existente"}';
            }
        } catch (Exception $ex) {
            echo '{error: 1, log: "Error al registrar"}';
        }
    }

    private function verificarReferido($correoU) {
        $modelReferido = $this->loadModel("modelreferido");
        $referidos = $modelReferido->getQuienesMeHanReferido($correoU);
        if (count($referidos) > 0) {
            $modelReferido->asignarReferido($referidos[0]->id);
        }
    }

    public function editarPerfil() {
        if ($this->login->esAnonimo()) {
            echo '{error: 404, log: "Acceso no permitido"}';
            return;
        }
        $idUsuario = $_POST['idUsuario'];
        $this->modelUsuario = $this->loadModel("modeloRegistroUsuario");
        $flag = $this->modelUsuario->existsUserByID($idUsuario);
        if (count($flag) == 1) {
            $nombreU = $_POST['nombre'];
            $correoU = $_POST['correoUsuario'];
            $sexo = $_POST['sexo'];
            $pass = $_POST['password'];
            $esConductor = (isset($_POST['esConductor'])) ? $_POST['esConductor'] : "";
            if ($this->modelUsuario->editUser($idUsuario, $nombreU, $correoU, $sexo, $pass)) {
                echo '{error: 0, log: "Exito"}';
            } else {
                echo '{error: 1, log: "No fue posible editar el perfil"}';
            }
        } else {
            echo '{error: 1, log: "No fue posible editar el perfil"}';
        }
    }

    public function confirmarCorreo($tokens) {
        if (count($tokens) > 0) {
            $token = $tokens[0];
            $this->modelUsuario = $this->loadModel("modeloRegistroUsuario");
            $this->modelUsuario->borrarToken($token);
        }
    }

    //-------------------- Correos ------------------------//
    public function enviarCorreoConfirmacion($nombreU, $correoU, $token) {
        $mensaje = 'Hola <strong>' . $nombreU . '</strong> gracias por acceder a esta plataforma. Haz click en el siguiente vínculo para poder confirmar tu cuenta:';
        $titulo = "Activar cuenta";
        $asunto = "Activar cuenta";
        $callback = URL . "users/confirmarCorreo/" . $token;
        // Enviar email
        $this->enviarCorreo($correoU, $asunto, $mensaje, $titulo, $callback);
    }

    /**
     * Use esta función de manera limitada (los cazadores de spam estan con los
     * ojos puestos en mi humilde servidor :( )
     */
    private function enviarCorreo($email, $asunto, $mensajeU, $titulo, $callback) {
        $mensaje = '<html><body>';
        $mensaje .= '<center>
            <img src="http://yavoy.co/public/imagenes/aaserver/1.png" alt="Logo" />
            <table rules="all" style="border-color: #666;" cellpadding="10">
                <tr style="background: #eee;">
                    <td><strong>' . $titulo . '</strong> 
                    </td>
                </tr>
                <tr>
                    <td>
                        ' . $mensajeU . ' 
                    </td>
                </tr>
                <tr>
                    <td>
                        <center>
                    <a href="' . $callback . '">
                        Haz click aquí
                    </a>
                        </center>
                    </td>
                </tr>
            </table>
        </center>';
        $mensaje .= '</body></html>';
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        mail($email, $asunto, $mensaje, $headers);
    }

}
