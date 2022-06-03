<?php

include ("plantillas/encabezado.php");
include ("BDD/conexion.php");

  
    $sql = "select * from categorias ";
    //SELECT p.id_prod, p.nombre, p.detalle, p.precio, p.stock, p.foto, c.nombre as categoria FROM productos
    //p, categorias c WHERE p.id_categoria = c.id_categoria
    $result = $conn->query($sql);
    


?>

<div class="container">
    <div class="row">
        <table class="table table-striped table-inverse table-responsive">
            <thead class="thead-inverse">
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        //devuelve un dato asociativo de una fila de datos de una consulta
                        while($row = $result->fetch_assoc()){
                    ?>
                    <tr>
                        <!-- Deben de escribir como son en la Base de Datos -->
                        <td><?php echo $row["id_categoria"]; ?></td>
                        <td><?php echo $row["nombre"]; ?></td>
                        <td>
                            <form action="BDD/CategoriaCRUD.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $row["id_categoria"]; ?>">
                                <button type="submit" class="btn btn-danger" name="Enviar" value="Eliminar">Eliminar</button>
                            </form>
                        </td>
                        <td>
                            <form action="formCat.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $row["id_categoria"]; ?>">
                            <button type="submit" class="btn btn-success" name="Enviar" value="Actualizar">Editar</button>
                            </form>
                        </td>
                    </tr>
                    <?php 
                        }
                        //Siempre que se abre una conexion se debe de cerrar
                        $conn->close();
                    ?>
                </tbody>
        </table>
    </div>
</div>


<?php
include "plantillas/pie.php";
?>