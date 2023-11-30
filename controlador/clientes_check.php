<?php
require_once("../modelo/class.cliente.php");

$action = $_POST['action'];
$json = array();
$clientes = new Clientes;
if($action == "mostrar"){
    $clientes->verClientes($json);
}

?>