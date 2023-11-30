<?php
require_once("../modelo/class.mascotas.php");

$action = $_POST['action'];
$json = array();
$mascota = new Mascotas;
if($action == "mostrar"){
    $mascota->verMascotas($json);
}

if($action == "agregar"){
    $nombre = $_POST["nombre"];
    $edad = $_POST["edad"];
    $raza = $_POST["raza"];
    $especie = $_POST["especie"];
    $encargado = $_POST["encargado"];

    $nombre_check = preg_match('~^[a-zA-zÁáÉéÍíÓóÚú\s]{3,}$~', $nombre);
    $edad_check = preg_match('~^[0-9]{1,}$~', $edad);
    $raza_check = preg_match('~^[0-9]{1,}$~', $raza);
    $especie_check = preg_match('~^[0-9]{1,}$~', $especie);
    $encargado_check = preg_match('~^[0-9]{1,}$~', $encargado);

    if($nombre_check && $edad_check && $raza_check && $especie_check && $encargado_check){
        $mascota->agregarMascota($json, $nombre, $edad, $raza, $especie, $encargado);
    }else{
        $json['status'] = false;
        $json['msg'] = '<h1> No se encontraron mascotas</h1>';
        echo json_encode($json);
    }

}

if($action == "eliminar"){
    $id = $_POST['id'];
    if($id > 0){
        $mascota->eliminarMascota($json, $id);
    }else{
        $json['status'] = true;
        $json['msg'] = '<h1> Error interno </h1>';
        echo json_encode($json);
    }   
}

if($action == "ficha"){
    $id = $_POST['id'];
    if($id > 0){
        $mascota->fichaMascota($json, $id);
    }else{
        $json['status'] = true;
        $json['msg'] = '<h1> Error interno </h1>';
        echo json_encode($json);
    }   
}

if($action == "editar"){
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $edad = $_POST["edad"];
    $raza = $_POST["raza"];
    $especie = $_POST["especie"];
    $encargado = $_POST["encargado"];

    $nombre_check = preg_match('~^[a-zA-zÁáÉéÍíÓóÚú\s]{3,}$~', $nombre);
    $edad_check = preg_match('~^[0-9]{1,}$~', $edad);
    $raza_check = preg_match('~^[0-9]{1,}$~', $raza);
    $especie_check = preg_match('~^[0-9]{1,}$~', $especie);
    $encargado_check = preg_match('~^[0-9]{1,}$~', $encargado);

    if($nombre_check && $edad_check && $raza_check && $especie_check && $encargado_check){
        $mascota->editarMascota($json, $id ,$nombre, $edad, $raza, $especie, $encargado);
    }else{
        $json['status'] = false;
        $json['msg'] = '<h1> No se encontraron mascotas</h1>';
        echo json_encode($json);
    }

}
?>