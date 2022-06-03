<?php
    include "Admin/BDD/conexion.php";

    session_start();

    $verificar = true;



//----------Verifica que la solicitud sea POST y que la solicitud tenga el nombre de Agregar---------
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Agregar'])){
    
    $id = $_POST['id']; //Nombre del input del form index
    
    $sql = "select * from productos where id_prod = $id and stock > 3 "; 

    $result = $conn->query($sql);
    //Extraer lo que haya venido en el result
    $row = $result->fetch_assoc();
    //Iniciar secion
    if(!isset($_SESSION["CARRITO"])){
        $tempCarrito = array(
            "id"=>$row["id_prod"],      //1->Formulario -- 2->Base de Datos
            "nombre"=>$row["nombre"],
            "precio"=>$row["precio"],
            "cantidad"=>1,
            "importe"=>$row["precio"]
        );
        $_SESSION["CARRITO"][$row["id_prod"]] = $tempCarrito;
    }else{
        foreach($_SESSION["CARRITO"] as $elemento){
            if($elemento["id"] == $id){
                $_SESSION["CARRITO"][$id]["cantidad"]++;
                $_SESSION["CARRITO"][$id]["importe"] = $_SESSION["CARRITO"][$id]["cantidad"] * $_SESSION["CARRITO"][$id]["precio"];
                $verificar = false;
            }
        }
        if($verificar){
            //Sacar el total de elementos de carrito
            $totalElementos = count($_SESSION["CARRITO"]);
            $tempCarrito = array(
                "id"=>$row["id_prod"],      //1->Formulario -- 2->Base de Datos
                "nombre"=>$row["nombre"],
                "precio"=>$row["precio"],
                "cantidad"=>1,
                "importe"=>$row["precio"]
            );
            $_SESSION["CARRITO"][$row["id_prod"]] = $tempCarrito;
        }
    }
    header("location: carritoVista.php");
    //print_r($_SESSION);

//----------Verifica que la solicitud sea POST y que la solicitud tenga el nombre de Eliminar----------
}else if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Eliminar'])){
    
    $id = $_POST["id"];

    //--unset -> elimina un elemento de un array
    unset($_SESSION["CARRITO"][$id]);

    header("location: carritoVista.php");
//---------Verificar que la solicitud sea una GET y que tenga por nombre Accion ---------
}else if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["Accion"])){
    
    echo "Actualizar";

    $id = $_GET['id'];
    $cantidad = $_GET['cantidad'];
    //foreach($_SESSION["CARRITO"] as $elemento){
    //    if($elemento["id"] == $id){
            $_SESSION["CARRITO"][$id]["cantidad"] - $cantidad;
            $_SESSION["CARRITO"][$id]["importe"] = $_SESSION["CARRITO"][$id]["cantidad"] * $_SESSION["CARRITO"][$id]["precio"];
            //$verificar = false;
    //    }
    //}
}    
    
    
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
</head>
<body>

    <a href="carritoVista.php">Regresar</a>
    
</body>
</html>