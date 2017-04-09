<?php
require('reports/fpdf.php');
require("include/conn.php");


$gen = $_POST["startdate"];
$gen1 = $_POST["enddate"];


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
	mysql_select_db("itams", $con);

$query = mysql_query("SELECT * FROM hardware WHERE dateBought >='$gen' AND dateBought <= '$gen1'");
	if(mysql_num_rows($query) == 0){
		echo "<script>alert('No report found. Please try again'); location.href='../hardwareRepdate.php';</script>";
		}
  
			



		
		
		$pdf->Ln(2);
		//Image("image name", y, x, image size);
		$pdf->Ln(20);
		$pdf->SetFont('arial','b',50);
		$pdf->setX(25);$pdf->Cell(0,0,'IT Asset Management System',0,0,'L');
		
		$pdf->Ln(30);
		$pdf->SetFont('arial','b',20);
		$pdf->setX(130);$pdf->Cell(0,0,'Hardware Report',0,0,'L');
		$pdf->Ln(10);
		$pdf->setX(100);$pdf->Cell(0,0,'From: '.$gen.' to '.$gen,0,0,'L');
		$pdf->Ln(10);

		$pdf->Ln(10);



		
		//$pdf->Ln(10);
		$pdf->SetFont('arial','b',10);
		$pdf->setX(10);$pdf->Cell(0,0,'Asset ID',0,0,'L');
		$pdf->setX(35);$pdf->Cell(0,0,'Barcode',0,0,'L');
		$pdf->setX(65);$pdf->Cell(0,0,'Name',0,0,'L');
		$pdf->setX(95);$pdf->Cell(0,0,'Date bought',0,0,'L');
		$pdf->setX(125);$pdf->Cell(0,0,'Waranty Expiration ',0,0,'L');
		$pdf->setX(165);$pdf->Cell(0,0,'Book Value',0,0,'L');
		$pdf->setX(190);$pdf->Cell(0,0,'Buying price',0,0,'L');
		$pdf->setX(221);$pdf->Cell(0,0,'Location',0,0,'L');
		$pdf->setX(250);$pdf->Cell(0,0,'Status',0,0,'L');
		$pdf->setX(270);$pdf->Cell(0,0,'Supplier',0,0,'L');


		//$pdf->Ln(6.0001);
		//$pdf->setX(20);$pdf->Cell(0,0,'Liquidating',0,0,'L');
		$pdf->Ln(3);
		$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
		while($row=mysql_fetch_array($query))
		{
		
		
		$pdf->Ln(7);
		
		//$pdf->Image($row['picture'],9.5,8,13);
		
		
		$pdf->setX(13);$pdf->Cell(0,0,''.$row['asset_id'],0,0,'L');
		$pdf->setX(35);$pdf->Cell(0,0,''.$row['barcode'],0,0,'L');
		$pdf->setX(65);$pdf->Cell(0,0,''.$row['name'],0,0,'L');
		$pdf->setX(95);$pdf->Cell(0,0,''.$row['dateBought'],0,0,'L');
		$pdf->setX(130);$pdf->Cell(0,0,''.$row['warranty_expiration'],0,0,'L');
		$pdf->setX(168);$pdf->Cell(0,0,''.$row['book_value'],0,0,'L');
		$pdf->setX(193);$pdf->Cell(0,0,''.$row['buying_price'],0,0,'L');
		$pdf->setX(220);$pdf->Cell(0,0,''.$row['location'],0,0,'L');
		$pdf->setX(253);$pdf->Cell(0,0,''.$row['status'],0,0,'L');


		}
				
	
		$pdf->Ln(7);
		$pdf->setX(7);$pdf->Cell(0,0,' ',0,0,'C');
$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
$pdf->Output();
$pdf->Output('Receipt.pdf', 'F');


			?>
