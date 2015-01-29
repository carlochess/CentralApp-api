<?php

include_once 'simple_html_dom.php';

function imprimir($elemento) {
    return ucfirst(strtolower(trim($elemento)));
}

function cogerHtmlDeWeb() {
//$html = file_get_html('http://cms.univalle.edu.co/vicebienestar/restaurante/');
    $html = str_get_html(file_get_contents('restaurante.html'));
    $tablas = $html->find('table');
    $tabla_menu = $tablas[0];
    $itemsYdias = $tabla_menu->find('tr');
    return $itemsYdias;
}

function htmlAobjetos($itemsYdias) {
    $items = $itemsYdias[0]->find('td');
    $dias = array_splice($itemsYdias, 1);
    $objDias = array();
    foreach ($dias as $dia) {
        $objDia = array();
        $diaDividido = $dia->find('td');
        sscanf($diaDividido[0]->plaintext, "%s %d", $objDia["nombreDia"], $objDia["numeroDia"]);
        if (count($diaDividido) > 2) {
            for ($i = 1; $i < count($diaDividido); $i++) {
                $objDia[strtolower(trim($items[$i]->plaintext))] = imprimir($diaDividido[$i]->plaintext);
            }
            $objDia["error"] = 0;
        } else {
            $objDia["error"] = 1;
            $objDia["anomalia"] = "No hay normalidad";
        }
        $objDias[] = $objDia;
    }
    return $objDias;
}

function insertarABd($objdia, $anomalia) {
    $hora = date('h:i:s');
    $fecha = date('Y-m-d');
    if ($anomalia) {
        $sql = 'INSERT INTO menu(fecha, diaNombre, horaConsulta, sopa, arroz, carne, principio, ensalada, jugo)
            VALUES ("%s","%s","%s","%s","%s","%s","%s","%s","%s")';
        echo sprintf($sql, $fecha, $objdia["nombreDia"], $hora, $objdia["sopa"], $objdia["arroz"], $objdia["carne"], $objdia["principio"], $objdia["ensalada"], $objdia["jugo"]);
    } else {
        $sql = 'INSERT INTO menu(fecha, diaNombre, horaConsulta, anomalia)
            VALUES ("%s","%s","%s","%s")';
        echo sprintf($sql, $fecha, $objdia["nombreDia"], $hora, $objdia["anomalia"]);
    }
}

function actualizarABd($objdia, $id) {

    $hora = date('h:i:s');
    $fecha = date('Y-m-d');
    if ($objdia["error"] == 0) {
        $sql = 'UPDATE menu SET fecha="%s",diaNombre= "%s",horaConsulta="%s",sopa="%s",arroz="%s",carne="%s",principio="%s",ensalada="%s",jugo="%s" WHERE idMenu="%s"';
        echo sprintf($sql, $fecha, $objdia["nombreDia"], $hora, $objdia["sopa"], $objdia["arroz"], $objdia["carne"], $objdia["principio"], $objdia["ensalada"], $objdia["jugo"], $id);
    } else {
        $sql = 'UPDATE menu SET anomalia="%s" WHERE idMenu="%s"")';
        echo sprintf($sql, $objdia["anomalia"],$id);
    }
}


function existe($objdia) {
    $hora = date('h:i:s');
    $fecha = date('Y-m-d');
    if ($objdia["error"] == 0) {
        $sql = 'UPDATE menu SET fecha="%s",diaNombre= "%s",horaConsulta="%s",sopa="%s",arroz="%s",carne="%s",principio="%s",ensalada="%s",jugo="%s" WHERE idMenu="%s"';
        echo sprintf($sql, $fecha, $objdia["nombreDia"], $hora, $objdia["sopa"], $objdia["arroz"], $objdia["carne"], $objdia["principio"], $objdia["ensalada"], $objdia["jugo"]);
    } else {
        $sql = 'INSERT INTO menu(fecha, diaNombre, horaConsulta, anomalia)
            VALUES ("%s","%s","%s","%s")';
        echo sprintf($sql, $fecha, $objdia["nombreDia"], $hora, $objdia["anomalia"]);
    }
}

function procesarDias($objDias){
    foreach ($objDias as $objdia) {
        $id = existe($objdia);
        if($id != null){
            actualizarABd($objDias, $id);
        }else{
            insertarABd($objDias, $id);
        }
    }
}
$itemsYdias = cogerHtmlDeWeb();
$objDias = htmlAobjetos($itemsYdias);
//print_r($objDias);
insertarABd($objDias);
//echo '<br/>';