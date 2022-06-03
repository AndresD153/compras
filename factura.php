<?php

    include "fpdf/fpdf.php";
    include "Admin/BDD/conexion.php";
    session_start();
    
    $subTotal = 0;
    $tpagar = 0;
    $iva = 0;

    
    //$user = $_GET['usuario'];
    //$pass = $_GET['password'];
    $idCli = $_GET['idCliente'];
    $idFac = $_GET['factura'];

    //$sql = "select * from clientes where usr = '$user' and pwd = '$pass'";
    $sql = "select * from clientes where id_cli = $idCli";
    //$sql = "select * from clientes";

    $result = $conn->query($sql);
    
    $pdf = new FPDF();
    $pdf->AddPage();
    
    while($row = $result->fetch_assoc()){
        $idCli = $row['id_cli'];
        $nombreCli = $row['nombres'];
        $apelliCli = $row['apellidos'];
        $cedulaCli = $row['cedula'];
    }
    
    $pdf->SetFont("Times","BI",20); 
    $pdf->SetTextColor(178,40,40);
    $pdf->Cell(150,20,"Datos del cliente:");
    
    $pdf->SetFont("Times","BI",10); 
    $pdf->SetTextColor(178,40,40);
    $pdf->Cell(0,20,"Factura N#:");
    
    $pdf->SetFont("Times","I",10); 
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(-20);
    $pdf->Cell(80,20,"000".$idFac);
    
    
    $pdf->Ln();

    //---- Datos del cliente ------------------

    $pdf->SetFont("Times","I",15);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(25,10,"Nombre: ");
    $pdf->SetTextColor(0,0,255);
    $pdf->Cell(10,10,$nombreCli ." ". $apelliCli);
    $pdf->Ln();
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(25,10,"Cedula: ");
    $pdf->SetTextColor(0,0,255);
    $pdf->Cell(10,10,$cedulaCli);
    
    $pdf->Ln();  
    
    //---- Encabezados de la Factura --------------

    $pdf->SetFont("Times","BI",25);    
    $pdf->SetTextColor(178,40,40);
    $pdf->Cell(58);
    $pdf->Cell(80,15,"Datos de la Factura");
    $pdf->Ln();

    $pdf->SetFont("Times","I",15);
    $pdf->SetTextColor(33,101,144);
    $pdf->Cell(25,10,"Codigo",true);
    $pdf->Cell(40,10,"Nombres",true);
    $pdf->Cell(40,10,"Precio U.",true);
    $pdf->Cell(45,10,"Cantidad",true);
    $pdf->Cell(0,10,"Precio Total",true);
    $pdf->Ln();

    //---- Datos de la Factura ---------------- 

    $pdf->SetTextColor(0,0,0);
    foreach($_SESSION["CARRITO"] as $ele){
        $pdf->Cell(25,10,$ele["id"],true);
        $pdf->Cell(40,10,$ele['nombre'],true);
        $pdf->Cell(40,10,$ele['precio'],true);
        $pdf->Cell(45,10,$ele['cantidad'],true);
        $pdf->Cell(0,10,$ele['importe'],true);
        $pdf->Ln();
    }

    foreach($_SESSION["CARRITO"] as $elementos){
        $subTotal += $elementos["importe"];
    }
    $iva = $subTotal * 0.12;
    $tpagar = $subTotal + $iva;

    //---- Resultados de la Factura --------
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(120);
    $pdf->Cell(30,10,"Sub Total:");
    $pdf->SetTextColor(0,0,255);
    $pdf->Cell(0,10,$subTotal,true);
    $pdf->Ln();
    
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(132);
    $pdf->Cell(18,10,"IVA:");
    $pdf->SetTextColor(0,0,255);
    $pdf->Cell(0,10,$iva,true);
    $pdf->Ln();

    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(129);
    $pdf->Cell(21,10,"Total:");
    $pdf->SetTextColor(0,0,255);
    $pdf->Cell(0,10,$tpagar,true);
    $pdf->Ln();
    
    //---- Pie de Pagina ------------------------
    $pdf->SetTextColor(0,0,0);
    $pdf->SetY(270);
    //Arial italic 8
    $pdf->SetFont('Arial','I',8);
    //Numero de paginas
    $pdf->Cell(0,0,'Pagina '.$pdf->PageNo(),0,0,'C');

    $pdf->Output();

    //session_destroy();
?>