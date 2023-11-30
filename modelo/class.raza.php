<?php
    require_once("class.conexion.php");
    class Razas{
        public function verRaza($json, $id){
            try{
                $modelo = new Conexion;
                $db = $modelo->get_conexion();
                if($db){
                    $stmt = $db->prepare("SELECT * FROM razas WHERE `especie` = ?;");
                    $stmt->bindParam( 1 , $id, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT, 4000);
                    $stmt-> execute();
                    $count = $stmt->rowCount();
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if($data){
                        if($count){
                            $json['status'] = true;
                            $json['data'] = $data;
                        }else{
                            $json['status'] = false;
                            $json['data'] = $data;
                        } 
                    }else{
                        $json['status'] = false;
                        $json['msg'] = '<h1> No se encontraron razas</h1>';
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