<?php

include ("plantillas/encabezado.php");
include ("BDD/conexion.php");

  
    $sql = "select * from usuarios";
    $result = $conn->query($sql);
    


?>

<div class="container">
    <div class="row">
        <table class="table table-striped table-inverse table-responsive">
            <thead class="thead-inverse">
                <tr>
                    <th>Id</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Usuario</th>
                    <!--
                    <th>Password</th>
                    -->
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
                        <td><?php echo $row["id_usu"]; ?></td>
                        <td><?php echo $row["nombres"]; ?></td>
                        <td><?php echo $row["apellidos"]; ?></td>
                        <td><?php echo $row["usr"]; ?></td>
                        <!--<td><?php //echo $row["pwd"]; ?></td>-->
                        <td>
                            <form action="BDD/UsuariosCRUD.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $row["id_usu"]; ?>">
                                <button type="submit" class="btn btn-danger" name="Enviar" value="Eliminar">Eliminar</button>
                            </form>
                        </td>
                        <td>
                            <form action="formUsu.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $row["id_usu"]; ?>">
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