<?php

    include "Admin/BDD/conexion.php";

    session_start();

    $subTotal = 0;
    $tpagar = 0;
    $iva = 0;   

    header("Content-type:application/vnd.ms-excel;charset=UTF-8");
    
    header('Content-Disposition:attachment;filename=nombre_archivo.xls');

    echo "<table border='1' cellpadding='0' cellsapciong='0' width='100%'>
            <tr>
                <td>CODIGO</td>
                <td>NOMBRE</td>
                <td>PRECIO</td>
                <td>CANTIDAD</td>
                <td>IMPORTE</td>
            </tr>";
            
            foreach($_SESSION["CARRITO"] as $ele){
                $id=$ele["id"];
                $nombre=$ele['nombre'];
                $precio=$ele['precio'];
                $cantidad=$ele['cantidad'];
                $importe=$ele['importe'];
            
                echo "<tr>
                        <td>$id</td>
                        <td>$nombre</td>
                        <td>$precio</td>
                        <td>$cantidad</td>
                        <td>$importe</td>
                    </tr>";
            };
        "</table>";
        
        //------------------ DATOS FINALES ------------

        echo "<table>";
            foreach($_SESSION["CARRITO"] as $elementos){
                $subTotal += $elementos["importe"];
            }
            $iva = $subTotal * 0.12;
            $tpagar = $subTotal + $iva;

            echo "
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>subTotal:</td>
                <td>$subTotal</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>IVA:</td>
                <td>$iva</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Total a Pagar:</td>
                <td>$tpagar</td>
            </tr>
        </table>";
    
?>