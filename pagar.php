<?php
    include "Admin/BDD/conexion.php";
    include "plantillas/encabezado.php";

    session_start();
    $verificar = true;

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $user = $_POST['usr'];
        $pass = $_POST['pwd'];
    
        $sql = "select * from clientes where usr = '$user' and pwd = '$pass'; ";

        $res = $conn->query($sql);
        
        if($res->num_rows == 1){
            $row = $res->fetch_assoc();
            //Variables para insertar
            $id = $row["id_cli"];
            $subTotal = 0;
            $iva = 0;
            $tpagar = 0;

            foreach($_SESSION["CARRITO"] as $elementos){
                $subTotal += $elementos["importe"];
            }
            $iva = $subTotal * 0.12;
            $tpagar = $subTotal + $iva;
            
            $sql = "insert into facturas values (null,CURDATE(),$subTotal,$iva,$tpagar,$id);";
            $idFac = 0;

            if(!$conn->query($sql)){
                $verificar = false;
            }else{
                $idFac = $conn->insert_id;
            }

            //-- Insertar el detalle de los productos
            foreach($_SESSION["CARRITO"] as $elementos){
                
                $idP = $elementos['id'];
                $cantidad = $elementos["cantidad"];
                $precio = $elementos["precio"];
                $importe = $elementos['importe'];
            
                $sql ="insert into detalles values (null,$cantidad,$precio,$importe,$idFac,$idP);";
                if(!$conn->query($sql)){
                    $verificar = false;
                }                
            }
            //--Cuadno todo los datos se terminen de insertar

            if($verificar){
                //session_destroy();
                echo "<script> 
                        alert ('Compra realizada, un total de: $tpagar')
                        window.location.href = 'factura.php?idCliente=$id&factura=$idFac';
                    </script>";
                //echo $sql;
            }else{
                echo "<script> 
                    alert ('Error al comprar')
                    window.location.href = 'index.php';
                </script>";
                //echo $sql;
            }
        }else{
            echo "<script> alert ('Error usuario no encontrado')</script>";
            //echo $sql;
        }
        
    }
?>

<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Llene los datos para poder pagar
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="col-md">
                            <label for="email" class="form-label">Usuario:</label>
                            <input type="text" class="form-control" id="usr" name="usr">
                        </div>
                        <div class="col-md">
                            <label for="pwd" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="pwd" name="pwd">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary" >Pagar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
    include "plantillas/pie.php";
?>