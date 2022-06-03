<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "tienda2022m";

//Manejar la conexion que nos devuelva la clase MySQLi
$conn = new mysqli($servername,$username,$password,$database);

//Verificar la conexion
if($conn->connect_error){
    die("Error al conectar: ".$conn->connect_error);
}

//echo "!!Coneccion Correcta!! <br>";