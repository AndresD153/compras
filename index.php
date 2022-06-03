<?php
    include "plantillas/encabezado.php";
    include "Admin/BDD/conexion.php";

    $sql = "select * from productos where stock > 3; ";

    $result = $conn->query($sql);
?>

<div class="container">
    <div class="row">
        <?php 
            while($row = $result->fetch_assoc()){
        ?>
        <div class="col-md-3">
            <div class="card text-left">
              <img class="card-img-top" src="img/productos/<?php echo $row['foto']; ?>" alt="">
              <div class="card-body">
                <h4 class="card-title"><?php echo $row['nombre']; ?></h4>
                <p class="card-text"><?php echo $row['detalle']; ?></p>
                <p class="card-text"><?php echo $row['precio']; ?> $</p>
                <form action="carrito.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['id_prod']; ?>">
                    <button type="submit" class="btn btn-success" name="Agregar" value="Agregar">Agregar</button>
                </form>
            </div>
        </div>
    </div>
        <?php
            }
            $conn->close();
        ?>
    </div>
</div>



<?php
    include "plantillas/pie.php";
?>