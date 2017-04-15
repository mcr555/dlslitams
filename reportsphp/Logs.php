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

$query = mysql_query("SELECT * FROM tbl_log WHERE Log_Date_Time >='$gen' AND Log_Date_Time <= '$gen1'");
	if(mysql_num_rows($query) == 0){
		echo "<script>alert('No report found. Please try again'); location.href='../ReportLogs.php';</script>";
		}
  
			



		
		
		$pdf->Ln(2);
		//Image("image name", y, x, image size);
		$pdf->Ln(20);
		$pdf->SetFont('arial','b',50);
		$pdf->setX(25);$pdf->Cell(0,0,'IT Asset Management System',0,0,'L');
		
		$pdf->Ln(30);
		$pdf->SetFont('arial','b',20);
		$pdf->setX(130);$pdf->Cell(0,0,'Log Report',0,0,'L');
		$pdf->Ln(10);
		$pdf->setX(100);$pdf->Cell(0,0,'From: '.$gen.' to '.$gen,0,0,'L');
		$pdf->Ln(10);

		$pdf->Ln(10);



	//$pdf->Ln(10);
		$pdf->SetFont('arial','b',10);
		$pdf->setX(60);$pdf->Cell(0,0,'Time',0,0,'L');
		$pdf->setX(100);$pdf->Cell(0,0,'Category',0,0,'L');
		$pdf->setX(130);$pdf->Cell(0,0,'Account Type',0,0,'L');
		$pdf->setX(180);$pdf->Cell(0,0,'Function',0,0,'L');
		$pdf->setX(235);$pdf->Cell(0,0,'Reference id',0,0,'L');


		//$pdf->Ln(6.0001);
		//$pdf->setX(20);$pdf->Cell(0,0,'Liquidating',0,0,'L');
		$pdf->Ln(3);
		$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
		while($row=mysql_fetch_array($query))
		{
		
		
		$pdf->Ln(7);
		
		//$pdf->Image($row['picture'],9.5,8,13);
		
		
		
		$pdf->setX(50);$pdf->Cell(0,0,''.$row['Log_Date_Time'],0,0,'L');
		$pdf->setX(100);$pdf->Cell(0,0,''.$row['category'],0,0,'L');
		$pdf->setX(135);$pdf->Cell(0,0,''.$row['Log_LOP'],0,0,'L');
		$pdf->setX(170);$pdf->Cell(0,0,''.$row['Log_Name'].' '.$row['Log_Function'],0,0,'L');
		$pdf->setX(245);$pdf->Cell(0,0,''.$row['id'],0,0,'L');


		}
				
	
		$pdf->Ln(7);
		$pdf->setX(7);$pdf->Cell(0,0,' ',0,0,'C');
$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
$pdf->Output();
$pdf->Output('Receipt.pdf', 'F');


			?>
