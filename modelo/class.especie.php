<?php
    require_once("class.conexion.php");
    class Especies{
        public function verEspecies($json){
            try{
                $modelo = new Conexion;
                $db = $modelo->get_conexion();
                if($db){
                    $stmt = $db->prepare('SELECT * FROM especies');
                    $stmt-> execute();
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if($data){
                        $json['status'] = true;
                        $json['data'] = $data;
                    }else{
                        $json['status'] = true;
                        $json['msg'] = '<h1> No se encontraron especies</h1>';
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