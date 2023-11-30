<?php
require_once("../modelo/class.raza.php");

$action = $_POST['action'];
$json = array();
$razas = new Razas;
if($action == "mostrar"){
    $id = $_POST['id'];
    if($id > 0){
        $razas->verRaza($json, $id);
    }else{
        $json['status'] = true;
        $json['msg'] = '<h1> Error interno </h1>';
        echo json_encode($json);
    }   
}

?>