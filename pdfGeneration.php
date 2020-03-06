<?php
require_once __DIR__ . "/APIs/fpdf/invoice.php";
$array = ["yo","yo2","yo3"];

ob_start();
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(55, 5, 'Reference Code', 0, 0);
$pdf->Cell(58, 5, ': 026ETY', 0, 0);
$pdf->Cell(25, 5, 'Date', 0, 0);
$pdf->Cell(52, 5, ': 2018-12-24 11:47:10 AM', 0, 1);
$pdf->Cell(55, 5, 'Amount', 0, 0);
$pdf->Cell(58, 5, ":60.00 EUROS", 0, 0);
$pdf->Cell(25, 5, 'Channel', 0, 0);
$pdf->Cell(52, 5, ': WEB', 0, 1);
$pdf->Cell(55, 5, 'Status', 0, 0);
$pdf->Cell(58, 5, ': Complete', 0, 1);
$pdf->Line(10, 30, 200, 30);
$pdf->Ln(10);

//testing loop for when the actual array is used
foreach($array as $arr)
{
    $pdf->Cell(55, 5, 'Product Id', 0, 0);
    $pdf->Cell(58, 5, ": $arr", 0, 1);
    $pdf->Cell(55, 5, 'Tax Amount', 0, 0);
    $pdf->Cell(58, 5, ': 0', 0, 1);
    $pdf->Cell(55, 5, 'Product Name', 0, 0);
    $pdf->Cell(58, 5, ': BACK2BACK by NICKY ROMERO', 0, 1);
    $pdf->Cell(55, 5, 'Product Delivery Charge', 0, 0);
    $pdf->Cell(58, 5, ': 0', 0, 1);
    $pdf->Line(10, 60, 200, 60);
    $pdf->Ln(10);//Line break
}

$pdf->Cell(55, 5, 'Paid by', 0, 0);
$pdf->Cell(58, 5, ": Mumbo", 0, 1);
$pdf->Cell(55, 5, 'Email id', 0, 0);
$pdf->Cell(58, 5, ": 420 bruh", 0, 1);
$pdf->Line(155, 75, 195, 75);
$pdf->Ln(5);//Line break
$pdf->Cell(140, 5, '', 0, 0);
$pdf->Cell(50, 5, ': Signature', 0, 1, 'C');


$pdf->Output();
ob_end_flush();

?>