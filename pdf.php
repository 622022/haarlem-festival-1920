<?php
    require_once(__DIR__ . "/service/cart-service.php");
    require_once __DIR__ . "/APIs/fpdf/invoice.php";
    require_once __DIR__ . "/APIs/fpdf/qrcode/qrcode.class.php";
    session_start();

    //$items=[];
    $items = $_SESSION["cart"]["items"]; 
    // EXAMPLE: //$_SESSION["cart"]["items"][$i]["count"] $_SESSION["cart"]["items"][$i]["event"]->price
    $totalPrice = $_SESSION["cart"]["totalPrice"];
    $today = date("Y-m-d H:i:s"); 
    $customerName= $_SESSION["fullName"];
    $customerEmail = $_SESSION["email"];
    $uid=array();
    $uid=$_SESSION["uid"];
    $qrcode = new QRcode ("$customerName", 'H'); // error level: L, M, Q, H

    // $id=array();
    // $id=$_SESSION["id"];
    
    if(isset($_SESSION["cart"])) {
        ob_start();
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(55, 5, 'Reference Code', 0, 0);
        $pdf->Cell(58, 5, ': 026ETY', 0, 0);
        $pdf->Cell(25, 5, 'Date', 0, 0);
        $pdf->Cell(52, 5, ": $today ", 0, 1);
        $pdf->Cell(55, 5, 'Total Price', 0, 0);
        $pdf->Cell(58, 5, ":$totalPrice Euros", 0, 0);
        $pdf->Cell(25, 5, 'Channel', 0, 0);
        $pdf->Cell(52, 5, ': WEB', 0, 1);
        $pdf->Cell(55, 5, 'Status', 0, 0);
        $pdf->Cell(58, 5, ': Complete', 0, 1);
        $pdf->Line(10, 30, 200, 30);
        $pdf->Ln(10);
        

        for ($i=0; $i < count($items); $i++) { 

            $events = $_SESSION["cart"]["items"][$i]["event"];
            $event = cartService::getInstance()->getEvent($events->id);
            //echo $event->getName();
            $eventName= $event->getName();
            $count= $_SESSION["cart"]["items"][$i]["count"];
            
            
            $pdf->Cell(55, 5, 'Product Id', 0, 0);
            $pdf->Cell(58, 5, ": $event->id ", 0, 1);
            $pdf->Cell(55, 5, 'Amount', 0, 0);
            $pdf->Cell(58, 5, ": $count ", 0, 1);
            $pdf->Cell(55, 5, 'Product Name', 0, 0);
            $pdf->Cell(58, 5, ": $eventName ", 0, 1);
            $pdf->Cell(55, 5, 'Product Price', 0, 0);
            $pdf->Cell(58, 5, ": $event->price Euros", 0, 1);
            $pdf->Cell(55, 5, 'UID/Barcode', 0, 0);
            $pdf->Cell(58, 5, ": $uid[$i] ", 0, 1);
            // $pdf->Cell(58, 5, ": $id[$i] ", 0, 1);
            $pdf->Line(10, 60, 200, 60);
            $pdf->Ln(10);//Line break
            
        }
        
        
        $pdf->Cell(55, 5, 'Paid by', 0, 0);
        $pdf->Cell(58, 5, ": $customerName", 0, 1);
        $pdf->Cell(55, 5, 'Email id', 0, 0);
        $pdf->Cell(58, 5, ": $customerEmail", 0, 1);
        $pdf->Line(155, 75, 195, 75);
        $pdf->Ln(5);//Line break
        $pdf->Cell(140, 5, '', 0, 0);
        $pdf->Cell(50, 5, ': Signature', 0, 1, 'C');
        
        $qrcode->displayFPDF($pdf, 159, 150, 50);
        $pdf->Output();
        ob_end_flush();
    }else
    {
        echo "Nothing to display.The cart is empty and/or not paid for.";
    }
?>