<?php
include("conexion.php");

$ruta ="../../img/productos/";

//--- Insertar ---
if(isset($_POST['Enviar']) and $_POST['Enviar'] === "Guardar"){

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $detalle = $_POST['detalle'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $categoria = $_POST['cbx'];
    //var_dump($result);
    $nombreArvhivo = $_FILES["foto"]["name"];
    
    if(!empty($_FILES["foto"]["name"])){
        $nombreArvhivo = $_FILES["foto"]["name"];
    
        $ruta = $ruta.basename($_FILES["foto"]["name"]);
        if(!(move_uploaded_file($_FILES["foto"]["tmp_name"],$ruta))){
            echo "Error al cargar el foto";
            return false;
        }
    }

    //print_r($_POST);
    
    //--- En caso de que la variable de error con la secuencia SQL se le contatena con '.$.'
    if(empty($id)){
        $sql = "insert into productos (nombre,detalle,precio,stock,id_categoria,foto)
            values('$nombre','$detalle','$precio','$stock','$categoria','$nombreArvhivo')"; 
    }else if(!empty($id)){

        if(empty($nombreArvhivo)){  //Si el nombre del archivo esta vacio
            $sql = "update productos set nombre='$nombre', detalle='$detalle', precio='$precio',stock='$stock',
            id_categoria='$categoria' where id_prod = $id ;";

        }else if(!empty($nombreArvhivo)){   //Si el nombre del archivo esta escrito
            $sql = "update productos set nombre='$nombre', detalle='$detalle', precio='$precio',stock='$stock',
                id_categoria='$categoria', foto='$nombreArvhivo' where id_prod = $id ;";
                echo $sql;
        }
    }
       
    if($conn->query($sql)){
        echo "<script>
                    alert ('Dato correctamente guardados');
                    window.location.href = '../listaProd.php';
                </script>";
        //echo $sql;
    }else{
        echo "<script>
                alert ('Error al guardar');
                window.location.href = '../listaProd.php';
            </script>";
        //echo $sql;
    }

    $conn->close();

    
}else if(isset($_POST['Enviar']) and $_POST['Enviar'] === "Eliminar"){
    $id = $_POST['id'];

    $sql = "delete from productos where id_prod = $id; ";
    if($conn->query($sql)){
        echo "<script>
                alert ('Dato eliminado correctamente');
                window.location.href = '../listaProd.php';
            </script>";
    }else{
        echo "Error al elimnar";
    }
}

?>