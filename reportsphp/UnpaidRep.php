<?php
require('reports/fpdf.php');
require("include/conn.php");


$gen = $_POST["servicedate"];
$gen1 = $_POST["servicedate1"];





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

		 $query = mysql_query("SELECT * FROM tblpatient1 WHERE Admissiondate >='$gen' AND Admissiondate <= '$gen1' AND Status = 'Unpaid' ");
		
		$pdf->Ln(2);
		//Image("image name", y, x, image size);
		$pdf->Ln(20);
		$pdf->SetFont('arial','b',50);
		$pdf->setX(25);$pdf->Cell(0,0,'Hospital Management System',0,0,'L');
		
		$pdf->Ln(30);
		$pdf->SetFont('arial','b',20);
		$pdf->setX(120);$pdf->Cell(0,0,'Daily Reports- Unpaid ',0,0,'L');
		$pdf->Ln(10);
		$pdf->setX(17);$pdf->Cell(0,0,'Date:',0,0,'L');
		$pdf->setX(40);$pdf->Cell(0,0,$gen.'-'.$gen1,0,0,'L');
		$pdf->Ln(10);




		
		//$pdf->Ln(10);
		$pdf->SetFont('arial','b',10);
		$pdf->setX(17);$pdf->Cell(0,0,'Patientno',0,0,'L');
		$pdf->setX(40);$pdf->Cell(0,0,'Fullname',0,0,'L');
		$pdf->setX(80);$pdf->Cell(0,0,'Birthdate',0,0,'L');
		$pdf->setX(110);$pdf->Cell(0,0,'Address',0,0,'L');
		$pdf->setX(150);$pdf->Cell(0,0,'Sex',0,0,'L');
		$pdf->setX(180);$pdf->Cell(0,0,'Age',0,0,'L');
		$pdf->setX(200);$pdf->Cell(0,0,'Diagnosis',0,0,'L');
		$pdf->setX(220);$pdf->Cell(0,0,'Room',0,0,'L');
		$pdf->setX(240);$pdf->Cell(0,0,'Admission Date',0,0,'L');
		$pdf->setX(280);$pdf->Cell(0,0,'Status',0,0,'L');
		//$pdf->Ln(6.0001);
		//$pdf->setX(20);$pdf->Cell(0,0,'Liquidating',0,0,'L');

		$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
		while($row=mysql_fetch_array($query))
		{
		
		
		$pdf->Ln(7);
		
		//$pdf->Image($row['picture'],9.5,8,13);
		
		
		$pdf->setX(17);$pdf->Cell(0,0,''.$row['Patientno'],0,0,'L');
		$pdf->setX(40);$pdf->Cell(0,0,''.$row['Firstname'].' '.$row['Middlename'].' '.$row['lastname'],0,0,'L');
		$pdf->setX(80);$pdf->Cell(0,0,''.$row['Birthdate'],0,0,'L');
		$pdf->setX(110);$pdf->Cell(0,0,''.$row['Address'],0,0,'L');
		$pdf->setX(150);$pdf->Cell(0,0,''.$row['Sex'],0,0,'L');
		$pdf->setX(180);$pdf->Cell(0,0,''.$row['Age'],0,0,'L');
		$pdf->setX(200);$pdf->Cell(0,0,''.$row['Diagnosis'],0,0,'L');
		$pdf->setX(220);$pdf->Cell(0,0,''.$row['Roomno'],0,0,'L');
		$pdf->setX(240);$pdf->Cell(0,0,''.$row['Admissiondate'],0,0,'L');
		$pdf->setX(280);$pdf->Cell(0,0,''.$row['Status'],0,0,'L');


		}
				
	
		$pdf->Ln(7);
		$pdf->setX(7);$pdf->Cell(0,0,' ',0,0,'C');
$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
$pdf->Output();
$pdf->Output('Receipt.pdf', 'F');
			?>
