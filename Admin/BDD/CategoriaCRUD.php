<?php
include("conexion.php");


//--- Insertar ---
if(isset($_POST['Enviar']) and $_POST['Enviar'] === "Guardar"){

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    

    //print_r($_POST);
    
    //--- En caso de que la variable de error con la secuencia SQL se le contatena con '.$.'
    if(empty($id)){
        $sql = "insert into categorias (nombre)
            values('$nombre')"; 
    }else if(!empty($id)){

            $sql = "update categorias set nombre='$nombre' where id_categoria = $id ;";
                echo $sql;
        }
    
       
    if($conn->query($sql)){
        echo "<script>
                    alert ('Dato correctamente guardados');
                    window.location.href = '../listaCat.php';
                </script>";
        //echo $sql;
    }else{
        echo "<script>
                alert ('Error al guardar');
                window.location.href = '../listaCat.php';
            </script>";
        //echo $sql;
    }

    $conn->close();

    
}else if(isset($_POST['Enviar']) and $_POST['Enviar'] === "Eliminar"){
    $id = $_POST['id'];

    $sql = "delete from categorias where id_categoria = $id; ";
    if($conn->query($sql)){
        echo "<script>
                alert ('Dato eliminado correctamente');
                window.location.href = '../listaCat.php';
            </script>";
    }else{
        //echo "Error al elimnar";
        echo $sql;
    }
}

?>