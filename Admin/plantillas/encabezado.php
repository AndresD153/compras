<?php
    
    session_start();

    if(!isset($_SESSION['PERMISO']) and $_SESSION['PERMISO'] == false){
        echo "<script> 
                    alert ('Porfavor inicie seseion primero')
                    window.location.href = 'login.php';
                </script>";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">        <!--Referenciar una hoja de tipop css-->
    <script src="../js/bootstrap.bundle.js"></script>              <!--referenciar una hoja tipo JS-->
    <title>Administrador de Tienda</title>
</head>
<body>
<!---Barra de navegacion o Menu-->
    <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #015780;">
        <a class="navbar-brand" >Usr:
            <?php                
                echo $_SESSION["nombres"] ." ". $_SESSION["apellidos"];
            ?>
        </a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Usuarios
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="index.php">Lista Usuarios</a></li>
                        <li><a class="dropdown-item" href="formUsu.php">Nuevo Usuario</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">????</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Productos
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="listaProd.php">Lista de Productos</a></li>
                        <li><a class="dropdown-item" href="formProd.php">Nuevos Productos</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">????</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categorias
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="listaCat.php">Lista de Categorias</a></li>
                        <li><a class="dropdown-item" href="formCat.php">Nueva Categoria</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">????</a></li>
                    </ul>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="salir.php">Salir</a>
                </li>
                <li class="nav-item">
                
                </li>
                
            </ul>
    </nav>
