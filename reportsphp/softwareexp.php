<?php
require('reports/fpdf.php');
require("include/conn.php");



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

$query = mysql_query("SELECT * FROM software WHERE expiration_date >='$vd'");
	if(mysql_num_rows($query) == 0){
		echo "<script>alert('No report found. Please try again'); location.href='../Report1/ReportSoftwareExp.php';</script>";
				exit(0);




		}

			  session_start();
		date_default_timezone_set("Asia/Manila"); 
                $vd=date("Y-m-d h:i:a");
                 $sql1=mysql_query("select * from users where idnumber = '".$_SESSION['id']."'");
               $row = mysql_fetch_assoc($sql1);



$queryy = mysql_query("INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$row[firstname] $row[middlename] $row[lastname]','$row[accountType]','$vd','Report','Generate report of expired software ','')") or die(mysql_error());	
			



		
		
		$pdf->Ln(2);
		//Image("image name", y, x, image size);
		$pdf->Ln(20);
		$pdf->SetFont('arial','b',50);
		$pdf->setX(25);$pdf->Cell(0,0,'IT Asset Management System',0,0,'L');
		
		$pdf->Ln(30);
		$pdf->SetFont('arial','b',20);
		$pdf->setX(110);$pdf->Cell(0,0,'Expired Software Report',0,0,'L');
		$pdf->Ln(10);


		$pdf->Ln(10);



	//$pdf->Ln(10);
		$pdf->SetFont('arial','b',10);
		$pdf->setX(5);$pdf->Cell(0,0,'Software ID',0,0,'L');
		$pdf->setX(30);$pdf->Cell(0,0,'Asset ID',0,0,'L');
		$pdf->setX(50);$pdf->Cell(0,0,'Name',0,0,'L');
		$pdf->setX(86);$pdf->Cell(0,0,'Version',0,0,'L');
		$pdf->setX(108);$pdf->Cell(0,0,'Status',0,0,'L');
		$pdf->setX(140);$pdf->Cell(0,0,'Date bought',0,0,'L');
		$pdf->setX(172);$pdf->Cell(0,0,'Serial',0,0,'L');
		$pdf->setX(200);$pdf->Cell(0,0,'Date Added',0,0,'L');
		$pdf->setX(240);$pdf->Cell(0,0,'Date Warn',0,0,'L');
		$pdf->setX(270);$pdf->Cell(0,0,'Status',0,0,'L');


		//$pdf->Ln(6.0001);
		//$pdf->setX(20);$pdf->Cell(0,0,'Liquidating',0,0,'L');
		$pdf->Ln(3);
		$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
		while($row=mysql_fetch_array($query))
		{
		
		
		$pdf->Ln(7);
		
		//$pdf->Image($row['picture'],9.5,8,13);
		
		
		
		$pdf->setX(10);$pdf->Cell(0,0,''.$row['software_id'],0,0,'L');
		$pdf->setX(33);$pdf->Cell(0,0,''.$row['asset_id'],0,0,'L');
		$pdf->setX(50);$pdf->Cell(0,0,''.$row['name'],0,0,'L');
		$pdf->setX(90);$pdf->Cell(0,0,''.$row['version'],0,0,'L');
		$pdf->setX(107);$pdf->Cell(0,0,''.'Expired',0,0,'L');
		$pdf->setX(140);$pdf->Cell(0,0,''.$row['date_bought'],0,0,'L');
		$pdf->setX(172);$pdf->Cell(0,0,''.$row['serial'],0,0,'L');
		$pdf->setX(200);$pdf->Cell(0,0,''.$row['date_added'],0,0,'L');
		$pdf->setX(240);$pdf->Cell(0,0,''.$row['date_warn'],0,0,'L');
		$pdf->setX(270);$pdf->Cell(0,0,''.$row['type'],0,0,'L');


		}
				
	
		$pdf->Ln(7);
		$pdf->setX(7);$pdf->Cell(0,0,' ',0,0,'C');
$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
$pdf->Output();
$pdf->Output('Receipt.pdf', 'F');


			?>
