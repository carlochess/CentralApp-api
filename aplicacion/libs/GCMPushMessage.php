<?php

/*
  Clase encargada del uso de Google Cloud Messaging 
  Ejemplo
  -----------------------
  $mensajero = new GCMPushMessage($apiKey);
  $mensajero->setDevices($dispositivos);
  $respuesta = $mensajero->send($mensaje);
  -----------------------
  $apiKey Api key de GCM
  $dispositivos Un arreglo o cadena de tokens de dispositivos registrados
  $mensaje El mensaje que se desea enviar
 */

class GCMPushMensaje {

    var $url = 'https://android.googleapis.com/gcm/send';
    var $serverApiKey = "AIzaSyCxBd8CnKcGdqnbB1NF72eapJaewnvc-8s";
    var $devices = array();

    /*
      Constructor
      @param $apiKeyIn API key del servidor
     */

    function GCMPushMensaje() {
    }

    /*
      Asigna los dispositivos a ser destinatarios
      @param $dispositivosIds arreglo de tokens de dispositivos a ser destinatarios
     */

    function setDevices($deviceIds) {
        if (is_array($deviceIds)) {
            $this->devices = $deviceIds;
        } else {
            $this->devices = array($deviceIds);
        }
    }

    /*
      Envia el mensaje al dispositivo
      @param $message El mensaje a enviar
      @param $data Arreglo de información que acompaña el mensaje
     */

    function send($message, $data = false) {
        if (!is_array($this->devices) || count($this->devices) == 0) {
            $this->error("No devices set");
        }
        if (strlen($this->serverApiKey) < 8) {
            $this->error("Server API Key not set");
        }
        $fields = array(
            'registration_ids' => $this->devices,
            'data' => array("message" => $message),
        );
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $fields['data'][$key] = $value;
            }
        }
        $headers = array(
            'Authorization: key=' . $this->serverApiKey,
            'Content-Type: application/json'
        );
// Abre la conexión
        $ch = curl_init();
// Indica la url, el número de variables POST, y el contenido en ella del POST 
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
// Evita el certificado https 
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Ejecuta la petición post
        $result = curl_exec($ch);
// Cierra la conexión
        curl_close($ch);
        return $result;
    }

    function error($msg) {
        echo "Error al enviar notificación:";
        echo "\t" . $msg;
        exit(1);
    }

}
