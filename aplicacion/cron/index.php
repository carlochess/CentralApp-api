<?php
date_default_timezone_set('America/Bogota');
setlocale(LC_ALL,"es_ES");
include_once 'simple_html_dom.php';

function imprimir($elemento) {
	$string = htmlentities($elemento, null, 'utf-8');
	$string = str_replace("&nbsp;", " ", $string);
    $string =  preg_replace('/\s\s+/', ' ', ucfirst(strtolower(trim(html_entity_decode(htmlentities($string))))));
	return $string;
}


function cogerHtmlDeWeb() {
	$html = file_get_html('http://cms.univalle.edu.co/vicebienestar/restaurante/');
    //$html = str_get_html(file_get_contents('restaurante.html'));
    $tablas = $html->find('table');
    $tabla_menu = $tablas[0];
    $itemsYdias = $tabla_menu->find('tr');
    return $itemsYdias;
}

function htmlAobjetos($itemsYdias) {
    $items = $itemsYdias[0]->find('td');
    $dias = array_splice($itemsYdias, 1);
    $objDias = array();
	$semana = getActualWeek();
	$diasSemana = daysInWeek($semana);
	foreach ($dias as $dia) {
        $objDia = array();
        $diaDividido = $dia->find('td');
        //sscanf($diaDividido[0]->plaintext, "%s %d", $objDia["nombreDia"], $objDia["numeroDia"]);
		$objDia["nombreDia"] = imprimir($diaDividido[0]->plaintext);
		$objDia["numDia"] = end(explode(" ",$objDia["nombreDia"]));
		$objDia["fecha"] = $diasSemana[substr($objDia["nombreDia"],0,2)." ".$objDia["numDia"]];
		$objDia["semana"] = $semana;
        if (count($diaDividido) > 2) {
            for ($i = 1; $i < count($diaDividido); $i++) {
                $objDia[strtolower(trim($items[$i]->plaintext))] = imprimir($diaDividido[$i]->plaintext);
            }
            $objDia["error"] = 0;
			$objDia["anomalia"] = "";
        } else {
            $objDia["error"] = 1;
            $objDia["anomalia"] = "No hay normalidad";
        }
        $objDias[] = $objDia;
    }
    return $objDias;
}

function insertarABd($objdia) {
    $hora = date('Y-m-d h:i:s');
    if ($objdia["error"] == 0) {
        $sql = 'INSERT INTO menu(fecha, diaNombre, horaConsulta, sopa, arroz, carne, principio, ensalada, jugo, semana)
            VALUES ("%s","%s","%s","%s","%s","%s","%s","%s","%s", "%s") 
			ON DUPLICATE KEY UPDATE fecha=fecha, diaNombre=diaNombre, horaConsulta=horaConsulta, sopa=sopa, arroz=arroz, carne=carne, principio=principio, ensalada=ensalada, jugo=jugo, semana=semana';
        return sprintf($sql, $objdia["fecha"], $objdia["nombreDia"], $hora, $objdia["sopa"], $objdia["arroz"], $objdia["carne"], $objdia["principio"], $objdia["ensalada"], $objdia["jugo"], $objdia["semana"]);
    } else {
        $sql = 'INSERT INTO menu(fecha, diaNombre, horaConsulta, anomalia)
            VALUES ("%s","%s","%s","%s")';
        return sprintf($sql, $objdia["fecha"], $objdia["nombreDia"], $hora, $objdia["anomalia"]);
    }
}

function procesarDias($objDias,$conn){
    foreach ($objDias as $objdia) {
        $str = insertarABd($objdia);
		echo $str . '<br/>';
		insertar($str, $conn);
    }
}



/*** Fechas **/
function daysInWeek($weekNum)
{
	$diasNombres = array("Lu","Ma","Mi","Ju","Vi","Sa","Do");
    $result = array();
    $datetime = new DateTime('00:00:00');
    $datetime->setISODate((int)$datetime->format('o'), $weekNum, 1);
    $interval = new DateInterval('P1D');
    $week = new DatePeriod($datetime, $interval, 6);
	$i =0;
    foreach($week as $day){
        $result[$diasNombres[$i]." ".$day->format('d')] = $day->format('Y-m-d');
		$i++;
    }
    return $result;
}

function getActualWeek(){
	$ddate = date("Y-m-d");
	$date = new DateTime($ddate);
	$week = $date->format("W");
	return $week;
}

function entrada(){
	$servername = "localhost";
	$username = "root";
	$password = "Univalle";
	$dbname = "centralapp";
	
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $conn; 
		
	}
	catch(PDOException $e)
	{
		echo "<br>" . $e->getMessage();
		return null;
	}
}

function insertar($str, $conn){
	$conn->exec($str);
}

$connexion = entrada();
$itemsYdias = cogerHtmlDeWeb();
$objDias = htmlAobjetos($itemsYdias);
procesarDias($objDias,$connexion);
