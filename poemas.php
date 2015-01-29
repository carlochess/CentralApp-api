<?php 
$obj = array();
//if($_POST["ultimoId"]==1){
$obj = array(array("titulo"=>"Carlos", "fecha"=>"2014/08/15","autor"=>"Carlos","contenido"=>"Carlos es genial"));
//}
echo json_encode(array("ultimoId"=> $_POST["ultimoId"], "error"=> 0,"log"=> "Conseguido",
 "poemas" => $obj));

?>