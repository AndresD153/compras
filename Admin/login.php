<?php

include ("BDD/conexion.php");

session_start();
$_SESSION ['PERMISO'] = false;
if($_SESSION['PERMISO'] === true){
    echo "<script> 
                alert ('Bienvenido')
                window.location.href = 'index.php';
            </script>";
}

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $user = $_POST['usr'];
    $pass = md5($_POST['pwd']);     //--Encriptacion con MD5
    $pass = hash('sha256',$pass);   //--Encriptacion con Sha256 despues de una MD5

    $sql = "select * from usuarios where usr = '$user' and pwd = '$pass'; ";
    //Ejecuta la consulta y la guarda en variable $res
    $res = $conn->query($sql);
    //Imprime el Array que trae $res
    //print_r($res);
    
    if($res->num_rows == 1){
        //Variables para inisiar secion
        $row = $res->fetch_assoc();
        $_SESSION['PERMISO'] = true;
        $_SESSION['nombres'] = $row['nombres'];
        $_SESSION['apellidos'] = $row['apellidos'];

        echo "<script> 
                alert ('Bienvenido')
                window.location.href = 'index.php';
            </script>";
    }else{
        echo "<script> alert ('Error usuario no encontrado')</script>";
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.bundle.js"></script>
    <title>Login</title>
</head>
<body>

    <div class="container">
        <div class="row d-flex justify-content-center"> <!--Para poder centrar el contenido-->
            <div class="col-md-4"><br>                  <!--Numero de columnas que utilizara el Bootstrap-->
                <div class="card">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">
                        <form method="POST">
                        <div class = "form-group">
                            <label for="exampleInputEmail1">Ingrese Usuario</label>
                            <input type="text" class="form-control" id="usr" name="usr" placeholder="Ingrese su usuario">
                        </div>
                    <br>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Ingrese la contraseña">
                        </div>
                    <br>
                        <button type="submit" class="btn btn-primary" name="Enviar" value="Enviar">Ingresar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    


</body>
</html>