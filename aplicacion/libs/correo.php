<?php

class Correo {

    /**
     * Esta función se encarga de recibir y comparar el token generado
     * durante la creación de la cuenta del usuario
     */
    public function confirmarCorreo($datos) {
        // Cargar el modelo de usuario
        $this->modelUsuario = $this->loadModel("modeloRegistroUsuario");
        // Validar email
        $token = $datos[0];
        // confirmar y borrartoken
        $user = $this->modelUsuario->coinciden($token);
        $nombreU = $user[0]->nombre;
        if (count($user) != 0) {
            $this->modelUsuario->habilitarCuenta($user[0]->nombre, $token);
            $datosUser = $this->modelUsuario->searchUser($nombreU);
            $this->confirmarCuenta($datosUser);
        }
    }

    public function reenviarCorreoConfirmacion($nombreU) {
        $this->modelUsuario = $this->loadModel("modeloRegistroUsuario");
        $datosUser = $this->modelUsuario->searchUser($nombreU[0]);
        enviarCorreoConfirmacion($datosUser[0]->nombre, $datosUser[0]->correo, $datosUser->tokenCorreo);
    }

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
            <img src="http://yavoy.co/public/imagenes/logo.png" alt="Logo" />
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
