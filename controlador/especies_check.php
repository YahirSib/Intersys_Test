<?php
require_once("../modelo/class.especie.php");

$action = $_POST['action'];
$json = array();
$especies = new Especies;
if($action == "mostrar"){
    $especies->verEspecies($json);
}

?>