<?php
require('reports/fpdf.php');
require("include/conn.php");


$gen=$_POST['freeware'];






date_default_timezone_set("Asia/Manila");

//date_default_timezone_set('Hongkong');
$vd=date("Y/m/d");
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

if($gen=='all')
{
	
    $query = mysql_query("SELECT * FROM software where type='0' ");
			
if(mysql_num_rows($query) == 0){
		echo "<script>alert('No report found. Please try again'); location.href='../freewareRepdate.php';</script>";
		}


		
		
		$pdf->Ln(2);
		//Image("image name", y, x, image size);
		$pdf->Ln(20);
		$pdf->SetFont('arial','b',50);
		$pdf->setX(25);$pdf->Cell(0,0,'IT Asset Management System',0,0,'L');
		
		$pdf->Ln(30);
		$pdf->SetFont('arial','b',20);
		$pdf->setX(120);$pdf->Cell(0,0,'Freeware Reports',0,0,'L');
		$pdf->Ln(10);

		$pdf->Ln(10);



		
		//$pdf->Ln(10);
		$pdf->SetFont('arial','b',10);
		$pdf->setX(100);$pdf->Cell(0,0,'Software ID',0,0,'L');
		$pdf->setX(130);$pdf->Cell(0,0,'Name',0,0,'L');
		$pdf->setX(160);$pdf->Cell(0,0,'Version ',0,0,'L');
		$pdf->setX(189);$pdf->Cell(0,0,'Status',0,0,'L');


		//$pdf->Ln(6.0001);
		//$pdf->setX(20);$pdf->Cell(0,0,'Liquidating',0,0,'L');
		$pdf->Ln(3);
		$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
		while($row=mysql_fetch_array($query))
		{

		if($row['asset_id'] >= '1')
		$status = 'Used';
		if($row['asset_id'] =='0')
		$status = 'Unused';




		$pdf->Ln(7);
		
		//$pdf->Image($row['picture'],9.5,8,13);
		
		
		$pdf->setX(106);$pdf->Cell(0,0,''.$row['software_id'],0,0,'L');
		$pdf->setX(130);$pdf->Cell(0,0,''.$row['name'],0,0,'L');
		$pdf->setX(165);$pdf->Cell(0,0,''.$row['version'],0,0,'L');
		$pdf->setX(188);$pdf->Cell(0,0,$status,0,0,'L');



		}
				
	
		$pdf->Ln(7);
		$pdf->setX(7);$pdf->Cell(0,0,' ',0,0,'C');
$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
$pdf->Output();
$pdf->Output('Receipt.pdf', 'F');
}
else if($gen == "1")
{
	
   $query = mysql_query("SELECT * FROM software where type='0' and asset_id >='1' ");

   if(mysql_num_rows($query) == 0){
		echo "<script>alert('No report found. Please try again'); location.href='../freewareRepdate.php';</script>";
		}

		$pdf->Ln(2);
		//Image("image name", y, x, image size);
		$pdf->Ln(20);
		$pdf->SetFont('arial','b',50);
		$pdf->setX(25);$pdf->Cell(0,0,'IT Asset Management System',0,0,'L');
		
		$pdf->Ln(30);
		$pdf->SetFont('arial','b',20);
		$pdf->setX(120);$pdf->Cell(0,0,'Freeware Reports',0,0,'L');
		$pdf->Ln(10);

		$pdf->Ln(10);



		
		
		//$pdf->Ln(10);
		$pdf->SetFont('arial','b',10);
		$pdf->setX(100);$pdf->Cell(0,0,'Software ID',0,0,'L');
		$pdf->setX(130);$pdf->Cell(0,0,'Name',0,0,'L');
		$pdf->setX(160);$pdf->Cell(0,0,'Version ',0,0,'L');
		$pdf->setX(189);$pdf->Cell(0,0,'Status',0,0,'L');


		//$pdf->Ln(6.0001);
		//$pdf->setX(20);$pdf->Cell(0,0,'Liquidating',0,0,'L');
		$pdf->Ln(3);
		$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
		while($row=mysql_fetch_array($query))
		{

		if($row['asset_id'] >= '1')
		$status = 'Used';
		
		$pdf->Ln(7);
		
		//$pdf->Image($row['picture'],9.5,8,13);
		
		
		$pdf->setX(106);$pdf->Cell(0,0,''.$row['software_id'],0,0,'L');
		$pdf->setX(130);$pdf->Cell(0,0,''.$row['name'],0,0,'L');
		$pdf->setX(165);$pdf->Cell(0,0,''.$row['version'],0,0,'L');
		$pdf->setX(188);$pdf->Cell(0,0,$status,0,0,'L');




		}
				
	
		$pdf->Ln(7);
		$pdf->setX(7);$pdf->Cell(0,0,' ',0,0,'C');
$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
$pdf->Output();
$pdf->Output('Receipt.pdf', 'F');
}
else if($gen == "0")
{
	
   $query = mysql_query("SELECT * FROM software where type='0' and asset_id ='0' ");



   if(mysql_num_rows($query) == 0){
		echo "<script>alert('No report found. Please try again'); location.href='../freewareRepdate.php';</script>";
		}

		$pdf->Ln(2);
		//Image("image name", y, x, image size);
		$pdf->Ln(20);
		$pdf->SetFont('arial','b',50);
		$pdf->setX(25);$pdf->Cell(0,0,'IT Asset Management System',0,0,'L');
		
		$pdf->Ln(30);
		$pdf->SetFont('arial','b',20);
		$pdf->setX(120);$pdf->Cell(0,0,'Freeware Reports',0,0,'L');
		$pdf->Ln(10);

		$pdf->Ln(10);



		
		//$pdf->Ln(10);
		$pdf->SetFont('arial','b',10);
		$pdf->setX(100);$pdf->Cell(0,0,'Software ID',0,0,'L');
		$pdf->setX(130);$pdf->Cell(0,0,'Name',0,0,'L');
		$pdf->setX(160);$pdf->Cell(0,0,'Version ',0,0,'L');
		$pdf->setX(189);$pdf->Cell(0,0,'Status',0,0,'L');



		//$pdf->Ln(6.0001);
		//$pdf->setX(20);$pdf->Cell(0,0,'Liquidating',0,0,'L');
		$pdf->Ln(3);
		$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
		while($row=mysql_fetch_array($query))
		{
	if($row['asset_id'] =='0')
		$status = 'Unused';


		
		$pdf->Ln(7);
		
		//$pdf->Image($row['picture'],9.5,8,13);
		

		

		$pdf->setX(106);$pdf->Cell(0,0,''.$row['software_id'],0,0,'L');
		$pdf->setX(130);$pdf->Cell(0,0,''.$row['name'],0,0,'L');
		$pdf->setX(165);$pdf->Cell(0,0,''.$row['version'],0,0,'L');
		$pdf->setX(188);$pdf->Cell(0,0,$status,0,0,'L');



		}
				
	
		$pdf->Ln(7);
		$pdf->setX(7);$pdf->Cell(0,0,' ',0,0,'C');
$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
$pdf->Output();
$pdf->Output('Receipt.pdf', 'F');
}

			?>
