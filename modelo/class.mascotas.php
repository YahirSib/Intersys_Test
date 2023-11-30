<?php
    require_once("class.conexion.php");
    class Mascotas{
        public function verMascotas($json){
            try{
                $modelo = new Conexion;
                $db = $modelo->get_conexion();
                if($db){
                    $stmt = $db->prepare("CALL ver_mascotas ();");
                    $stmt-> execute();
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if($data){
                        $json['status'] = true;
                        $json['data'] = $data;
                    }else{
                        $json['status'] = true;
                        $json['msg'] = '<h1> No se encontraron mascotas</h1>';
                    }
                }else{
                    $json['status'] = false;
                    $json['msg'] = '<h1> Error db </h1>';
                }
                echo json_encode($json);
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }

        public function agregarMascota($json, $nombre, $edad, $raza, $especie, $encargado){
            try{
                $modelo = new Conexion;
                $db = $modelo->get_conexion();
                if($db){
                    $stmt = $db->prepare("CALL agregar_mascota(?,?,?,?,?);");
                    $stmt->bindParam( 1 , $nombre, PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 4000);
                    $stmt->bindParam( 2 , $edad, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT, 4000);
                    $stmt->bindParam( 3 , $especie, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT, 4000);
                    $stmt->bindParam( 4 , $raza, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT, 4000);
                    $stmt->bindParam( 5 , $encargado, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT, 4000);
                    $stmt-> execute();
                    $count = $stmt->rowCount();
                    if($count){ 
                        $json['status'] = true;
                        $json['msg'] = "Agregado correctamente";
                    }else{
                        $json['status'] = false;
                        $json['msg'] = 'No se encontraron mascotas';
                    }
                    
                }else{
                    $json['status'] = false;
                    $json['msg'] = '<h1> Error db </h1>';
                }
                echo json_encode($json);
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }

        public function eliminarMascota($json, $id){
            $modelo = new Conexion;
            $db = $modelo->get_conexion();
            if($db){ 
                $stmt = $db->prepare( "DELETE FROM `mascotas` WHERE `id_mascota` = ?");
                $stmt->bindParam( 1 , $id, PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 4000);
                $stmt->execute();
                $count = $stmt->rowCount();
                if($count > 0){
                    $json['status'] = true;
                }else{
                    $json['status'] = false;
                }
            }else{
                $json['status'] = false;
            }
            echo json_encode($json);
        }

        public function fichaMascota($json, $id){
            $modelo = new Conexion;
            $db = $modelo->get_conexion();
            if($db){ 
                $stmt = $db->prepare( "SELECT * FROM mascotas WHERE `id_mascota` = ?");
                $stmt->bindParam( 1 , $id, PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 4000);
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if($data){
                    $json['status'] = true;
                    $json['data'] = $data;
                }else{
                    $json['status'] = true;
                    $json['msg'] = '<h1> No se encontraron mascotas</h1>';
                }
            }else{
                $json['status'] = false;
            }
            echo json_encode($json);
        }


        public function editarMascota($json, $id,$nombre, $edad, $raza, $especie, $encargado){
            try{
                $modelo = new Conexion;
                $db = $modelo->get_conexion();
                if($db){
                    $stmt = $db->prepare("CALL editar_mascota(?,?,?,?,?,?);");
                    $stmt->bindParam( 1 , $nombre, PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 4000);
                    $stmt->bindParam( 2 , $edad, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT, 4000);
                    $stmt->bindParam( 3 , $especie, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT, 4000);
                    $stmt->bindParam( 4 , $raza, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT, 4000);
                    $stmt->bindParam( 5 , $encargado, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT, 4000);
                    $stmt->bindParam( 6 , $id, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT, 4000);
                    $stmt-> execute();
                    $count = $stmt->rowCount();
                    if($count){ 
                        $json['status'] = true;
                        $json['msg'] = "Editado correctamente";
                    }else{
                        $json['status'] = false;
                        $json['msg'] = 'No se encontraron mascotas';
                    }
                    
                }else{
                    $json['status'] = false;
                    $json['msg'] = '<h1> Error db </h1>';
                }
                echo json_encode($json);
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }

    }
?>