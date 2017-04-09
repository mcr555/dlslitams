<?php
require('reports/fpdf.php');
require("include/conn.php");

$pno = $_REQUEST["patientno"];
$paid = $_REQUEST["payment"];

$subtotal = 0;
$total = 0;



date_default_timezone_set("Asia/Manila");
//date_default_timezone_set('Hongkong');
$vd=date("F d Y");
$vsd1=date("F d Y");
$ved1=date("F d Y");
//echo $vd;
class PDF extends FPDF
{

	//Page header
	function Header()
	{
		
	}

	//Page footer
	function Footer()
	{
		
	}
}

		
/////////////////////////////////////////////////////////////////////////export database to pdf format


	//Instanciation of inherited class
	//Instanciation of inherited class
	$pdf=new PDF('L','mm','A4');
	$pdf->AliasNbPages();
	$pdf->AddPage();


	// Adds image to beginning of d

	$con = mysql_connect("localhost","root","");
	mysql_select_db("hpbs", $con);

		 $query = mysql_query("SELECT * FROM tblbill1 WHERE patientno ='$pno' ");
		
		$pdf->Ln(2);
		//Image("image name", y, x, image size);
		$pdf->Ln(20);
		$pdf->SetFont('arial','b',50);
		$pdf->setX(25);$pdf->Cell(0,0,'Hospital Management System',0,0,'L');
		
		$pdf->Ln(30);
		$pdf->SetFont('arial','b',25);
		$pdf->setX(130);$pdf->Cell(0,0,'Receipt ',0,0,'L');
		$pdf->Ln(10);
		$pdf->setX(17);$pdf->Cell(0,0,'Patient No',0,0,'L');
		$pdf->setX(70);$pdf->Cell(0,0,''.$pno,0,0,'L');
		$pdf->Ln(10);



		
		//$pdf->Ln(10);
		$pdf->SetFont('arial','b',17);
		$pdf->setX(17);$pdf->Cell(0,0,'Transaction no',0,0,'L');
		$pdf->setX(70);$pdf->Cell(0,0,'Service Date',0,0,'L');
		$pdf->setX(130);$pdf->Cell(0,0,'Description',0,0,'L');
		$pdf->setX(200);$pdf->Cell(0,0,'Quantity',0,0,'L');
		$pdf->setX(235);$pdf->Cell(0,0,'Price',0,0,'L');
		$pdf->setX(260);$pdf->Cell(0,0,'Amount',0,0,'L');
		//$pdf->Ln(6.0001);
		//$pdf->setX(20);$pdf->Cell(0,0,'Liquidating',0,0,'L');

		$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
		while($row=mysql_fetch_array($query))
		{
		
		
		$pdf->Ln(7);
		
		//$pdf->Image($row['picture'],9.5,8,13);
		
		  $subtotal= $row['Quantity'] * $row['Amount'] ;



   $total =  $total + $subtotal;
    $total1=$paid - $total ;
		
		$pdf->setX(17);$pdf->Cell(0,0,''.$row['Transactionno'],0,0,'L');
		$pdf->setX(70);$pdf->Cell(0,0,''.$row['Servicedate'],0,0,'L');
		$pdf->setX(140);$pdf->Cell(0,0,''.$row['Description'],0,0,'L');
		$pdf->setX(200);$pdf->Cell(0,0,''.$row['Quantity'],0,0,'L');
		$pdf->setX(235);$pdf->Cell(0,0,''.$row['Amount'],0,0,'L');
		$pdf->setX(260);$pdf->Cell(0,0,''.$subtotal,0,0,'L');

		}
				
		$pdf->Ln(2);
		$pdf->setX(7);$pdf->Cell(0,0,'_____________________________________________________________________________________',0,0,'L');
		$pdf->Ln(10);	
		$pdf->setX(200);$pdf->Cell(0,0,'Total Amount',0,0,'L');
		$pdf->setX(260);$pdf->Cell(0,0,''.$total,0,0,'L');
		$pdf->Ln(10);	
		$pdf->setX(200);$pdf->Cell(0,0,'Amount Paid',0,0,'L');
		$pdf->setX(260);$pdf->Cell(0,0,''.$paid,0,0,'L');
		$pdf->Ln(10);	
		$pdf->setX(200);$pdf->Cell(0,0,'Change',0,0,'L');
		if($total1>0) 
  {
  	$pdf->setX(260);$pdf->Cell(0,0,''.$total1,0,0,'L');
   }
  else if ($total1<0)
  {
   $pdf->setX(260);$pdf->Cell(0,0,''.'0',0,0,'L');
  }
		

		$pdf->Ln(7);
		$pdf->setX(7);$pdf->Cell(0,0,' ',0,0,'C');
$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
$pdf->Output();
$pdf->Output('Receipt.pdf', 'F');
			?>
