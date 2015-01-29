<?php

/*
  Clase encargada del uso de APNs
  Ejemplo
  -----------------------
  $mensajero = new APNPushMessage();
  $mensajero->setDevices($dispositivos);
  $respuesta = $mensajero->send($mensaje);
  -----------------------
 */

class APNPushMessage {
    private $device = "";
    private $passphrase = "laMaria123";

    /*
      Constructor
      @param $apiKeyIn API key del servidor
     */

    function APNPushMessage() { 
    }

    /*
      Asigna el dispositivo a ser destinatario
      @param $dispositivosIds cadena token de dispositivo a ser destinatario
     */

    function setDevice($deviceIds) {
        $this->device= $deviceIds;
    }

    /*
      Envia el mensaje al dispositivo
      @param $message El mensaje a enviar
      @param $data Arreglo de información que acompaña el mensaje
     */

    function send($message) {
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', DIR_APP . "/aplicacion/libs/certificados/PushYaVoyKey.pem");
        stream_context_set_option($ctx, 'ssl', 'passphrase', $this->passphrase);

// Open a connection to the APNS server
        $fp = stream_socket_client(
                'ssl://gateway.sandbox.push.apple.com:2195', $this->err, $this->$errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

        if (!$fp) {
            exit("Failed to connect: $this->err $this->$errstr" . PHP_EOL);
        }

        //echo 'Connected to APNS' . PHP_EOL;

// Create the payload body
        $body['aps'] = array(
            'alert' => $message,
            'sound' => 'default'
        );

// Encode the payload as JSON
        $payload = json_encode($body);

// Build the binary notification
        $msg = chr(0) . pack('n', 32) . pack('H*', $this->device) . pack('n', strlen($payload)) . $payload;

// Send it to the server
        $this->result = fwrite($fp, $msg, strlen($msg));

// Close the connection to the server
        fclose($fp);
    }

    function error() {
        if (!$this->result) {
            echo 'Message not delivered' . PHP_EOL;
        } else {
            echo 'Message successfully delivered' . PHP_EOL;
        }
    }

}
