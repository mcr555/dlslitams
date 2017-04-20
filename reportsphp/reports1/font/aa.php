<?php
require('fpdf.php');

$pdf=new FPDF();
$pdf->AddFont('verdana','','verdana.php');
$pdf->AddPage();
$pdf->SetFont('verdana','',35);
$pdf->Cell(0,10,'Enjoy new fonts with FPDF!');
$pdf->Output();
?>