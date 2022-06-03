<?php
    include "plantillas/encabezado.php";

    session_start();

    $subTotal = 0;
    $iva = 0;
    $tpagar = 0;

?>


<div class="container">
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Importe</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($_SESSION["CARRITO"] as $elemetos){
                        //print_r($elemetos);
                        //echo "<br>";
                ?>
                <tr>
                    <td><?php echo $elemetos["id"]; ?></td>
                    <td><?php echo $elemetos["nombre"]; ?></td>
                    <td><?php echo $elemetos["precio"]; ?></td>
                    <td><input type="number" id="cantidad" onchange="actualizarCantidad(<?php echo $elemetos['id'] ?>,this.value)" value="<?php echo $elemetos['cantidad']; ?>"></td>
                    <td><?php echo $elemetos["importe"]; ?></td>
                    <td>
                        <form action="carrito.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $elemetos["id"]; ?>">
                            <button type="submit" class="btn btn-danger" name="Eliminar" value="Eliminar"> -</button>
                        </form>
                    </td>
                </tr>
                <?php
                    $subTotal += $elemetos["importe"];
                    }
                    $iva = $elemetos["importe"] * 0.12;
                    $tpagar = $subTotal + $iva;
                ?>
            </tbody>
            <tfoot>
                <tr><th colspan="4" style="text-align: right;">Sub Total: </th><th style="text-align: right;"><?php echo $subTotal; ?></th></tr>
                <tr><th colspan="4"style="text-align: right;">IVA: </th><th style="text-align: right;"><?php echo $iva; ?></th></tr>
                <tr><th colspan="4" style="text-align: right;">Total a Pagar: </th><th style="text-align: right;"><?php echo $tpagar; ?></th></tr>
            </tfoot>
        </table>
        <div class="col-md-8">
        </div>
        <div class="col-md-1">   
            <a class="btn btn-success" href="pagar.php">Pagar</a>
        </div>
        <?php
            //print_r($_SESSION["CARRITO"]);

            if(empty($_SESSION["CARRITO"])){
                echo("<h5> <center>El carrito esta vacio porfavor ingrese un Producto primero </center></h5>");
            }else{
                $resultado=0;
                //---- Trae los datos del carrito y los pone con la variable valor
                foreach($_SESSION["CARRITO"] as $valor){
                    //-----Se necesita solo extraer los datos del apartado "importe"
                    $resultado=$resultado+$valor["importe"];
                }
            }

        ?>
    </div>
</div>


<script>

    function actualizarCantidad(id,cantidad){
        //let cantidad = document.getElementById("cantidad").value;
        //--crear una constante
        const http = new XMLHttpRequest();
        const url = "carrito.php?id="+id+"&cantidad"+cantidad+"&Accion=Actualizar";
        http.open("GET",url,true);
        http.send();

         
        location.reload();

    }

</script>





<?php
    include "plantillas/pie.php";
?>
