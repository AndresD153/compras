<?php
include("conexion.php");

//--- Insertar ---
if(isset($_POST['Enviar']) and $_POST['Enviar'] === "Guardar"){

    $id = $_POST['id'];                         //Sirve para actualizar
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $usr = $_POST['usr'];
    $pwd = md5($_POST['pwd']);
    $pwd = hash('sha256',$pwd);

    //print_r($_POST);
    if(empty($id)){         //Si id esta vacio se insertara datos
        $sql = "insert into usuarios (nombres,apellidos,usr,pwd)
            values('$nombres','$apellidos','$usr','$pwd');";
    }else if(!empty($id)){  //Si ID esta lleno se actualizara los datos

        if(empty($nombreArvhivo)){  //Si el nombre del archivo esta vacio
            $sql = "update usuarios set nombres='$nombres', apellidos='$apellidos', usr='$usr',
            pwd='$pwd' where id_usu = $id ;";
        }
    }

    
    if($conn->query($sql)){
        echo "<script>
                    alert ('Dato insertado correctamente');
                    window.location.href = '../index.php';
                </script>";
    }else{
        echo "<script>
                alert ('Error al guardar');
                window.location.href = '../index.php';
            </script>";
        //echo $sql;
    }
    $conn->close();

//------- Si se quiere eliminar -------------------------
}else if(isset($_POST['Enviar']) and $_POST['Enviar'] === "Eliminar"){
    $id = $_POST['id'];
    $sql = "delete from usuarios where id_usu = $id; ";
    if($conn->query($sql)){
        echo "<script>
                    alert ('Dato eliminado correctamente');
                    window.location.href = '../index.php';
                </script>";
    }else{
        echo "Error al elimnar";
    }
}

?>