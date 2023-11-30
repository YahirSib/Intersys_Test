<?php
    define("BASE_URL", "http://localhost/veterinaria/");
    class Conexion{
		public function get_conexion(){
			$user = "root";
			$pass = "";
			$host = "localhost";
			$db = "veterinaria";
			$conexion = new PDO("mysql:host=$host;dbname=$db;",$user, $pass);
			return $conexion;
		}
	}
?>