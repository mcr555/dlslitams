<?php
require('reports/fpdf.php');
require("include/conn.php");

$gen1 = $_POST["startdate"];
$gen2 = $_POST["enddate"];
$gen=$_POST['hardware'];




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
	
    $query = mysql_query("SELECT * FROM hardware supplier_id LEFT JOIN supplier supplier_name ON supplier_id.supplier_id=supplier_name.supplier_id WHERE dateBought >='$gen1' AND dateBought <= '$gen2'");
			
if(mysql_num_rows($query) == 0){
		echo "<script>alert('No report found. Please try again'); location.href='../Report1/ReportHardwareStat.php';</script>";
		}


		
		
		$pdf->Ln(2);
		//Image("image name", y, x, image size);
		$pdf->Ln(20);
		$pdf->SetFont('arial','b',50);
		$pdf->setX(25);$pdf->Cell(0,0,'IT Asset Management System',0,0,'L');
		
		$pdf->Ln(30);
		$pdf->SetFont('arial','b',20);
		$pdf->setX(120);$pdf->Cell(0,0,'Hardware Reports',0,0,'L');
		$pdf->Ln(10);

		$pdf->Ln(10);



		
		//$pdf->Ln(10);
		$pdf->SetFont('arial','b',10);
		$pdf->setX(10);$pdf->Cell(0,0,'Asset ID',0,0,'L');
		$pdf->setX(30);$pdf->Cell(0,0,'Barcode',0,0,'L');
		$pdf->setX(55);$pdf->Cell(0,0,'Name',0,0,'L');
		$pdf->setX(90);$pdf->Cell(0,0,'Date bought',0,0,'L');
		$pdf->setX(115);$pdf->Cell(0,0,'Waranty Expiration ',0,0,'L');
		$pdf->setX(155);$pdf->Cell(0,0,'Book Value',0,0,'L');
		$pdf->setX(182);$pdf->Cell(0,0,'Buying price',0,0,'L');
		$pdf->setX(211);$pdf->Cell(0,0,'Location',0,0,'L');
		$pdf->setX(240);$pdf->Cell(0,0,'Status',0,0,'L');
		$pdf->setX(270);$pdf->Cell(0,0,'Supplier',0,0,'L');


		//$pdf->Ln(6.0001);
		//$pdf->setX(20);$pdf->Cell(0,0,'Liquidating',0,0,'L');
		$pdf->Ln(3);
		$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
		while($row=mysql_fetch_array($query))
		{

 if ($row['status'] == "0")
$status = 'Undeployed ';

if ($row['status'] == "1")
	$status = 'Deployed ';

if ($row['status'] == "2")
	$status = 'Retired ';

if ($row['status'] == "3")
	$status = 'Decomissioned ';

if ($row['status'] == "4")
	$status = 'Repaired ';

if ($row['status'] == "5")
	$status = 'Donated ';
		
		
		$pdf->Ln(7);
		
		//$pdf->Image($row['picture'],9.5,8,13);
		
		
		$pdf->setX(13);$pdf->Cell(0,0,''.$row['asset_id'],0,0,'L');
		$pdf->setX(30);$pdf->Cell(0,0,''.$row['barcode'],0,0,'L');
		$pdf->setX(55);$pdf->Cell(0,0,''.$row['name'],0,0,'L');
		$pdf->setX(90);$pdf->Cell(0,0,''.$row['dateBought'],0,0,'L');
		$pdf->setX(120);$pdf->Cell(0,0,''.$row['warranty_expiration'],0,0,'L');
		$pdf->setX(159);$pdf->Cell(0,0,''.$row['book_value'],0,0,'L');
		$pdf->setX(186);$pdf->Cell(0,0,''.$row['buying_price'],0,0,'L');
		$pdf->setX(210);$pdf->Cell(0,0,''.$row['location'],0,0,'L');
		$pdf->setX(238);$pdf->Cell(0,0,''.$status,0,0,'L');
		$pdf->setX(267);$pdf->Cell(0,0,''.$row['supplier_name'],0,0,'L');


		}
				
	
		$pdf->Ln(7);
		$pdf->setX(7);$pdf->Cell(0,0,' ',0,0,'C');
$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
$pdf->Output();
$pdf->Output('allhardware.pdf', 'F');
}
else if($gen == "0" ||  $gen=="1" || $gen=="2"|| $gen=="3"|| $gen=="4"|| $gen=="5")
{
	
    $query = mysql_query("SELECT * FROM hardware supplier_id LEFT JOIN supplier supplier_name ON supplier_id.supplier_id=supplier_name.supplier_id where status ='$gen' And dateBought >='$gen1' AND dateBought <= '$gen2'");
    if(mysql_num_rows($query) == 0){
		echo "<script>alert('No report found. Please try again'); location.href='../Report1/ReportHardwareStat.php';</script>";
		}
			

if ($gen == "0")
	$status = 'Undeployed ';

if ($gen == "1")
	$status = 'Deployed ';

if ($gen == "2")
	$status = 'Retired ';

if ($gen == "3")
	$status = 'Decomissioned ';

if ($gen == "4")
	$status = 'Repaired ';

if ($gen == "5")
	$status = 'Donated ';



		
		
		$pdf->Ln(2);
		//Image("image name", y, x, image size);
		$pdf->Ln(20);
		$pdf->SetFont('arial','b',50);
		$pdf->setX(25);$pdf->Cell(0,0,'IT Asset Management System',0,0,'L');
		
		$pdf->Ln(30);
		$pdf->SetFont('arial','b',20);
		$pdf->setX(100);$pdf->Cell(0,0,$status.'Hardware Reports',0,0,'L');

		$pdf->Ln(10);

		$pdf->Ln(10);



		
		$pdf->SetFont('arial','b',10);
		$pdf->setX(10);$pdf->Cell(0,0,'Asset ID',0,0,'L');
		$pdf->setX(30);$pdf->Cell(0,0,'Barcode',0,0,'L');
		$pdf->setX(55);$pdf->Cell(0,0,'Name',0,0,'L');
		$pdf->setX(90);$pdf->Cell(0,0,'Date bought',0,0,'L');
		$pdf->setX(115);$pdf->Cell(0,0,'Waranty Expiration ',0,0,'L');
		$pdf->setX(155);$pdf->Cell(0,0,'Book Value',0,0,'L');
		$pdf->setX(182);$pdf->Cell(0,0,'Buying price',0,0,'L');
		$pdf->setX(211);$pdf->Cell(0,0,'Location',0,0,'L');
		$pdf->setX(240);$pdf->Cell(0,0,'Status',0,0,'L');
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
		$pdf->setX(30);$pdf->Cell(0,0,''.$row['barcode'],0,0,'L');
		$pdf->setX(55);$pdf->Cell(0,0,''.$row['name'],0,0,'L');
		$pdf->setX(90);$pdf->Cell(0,0,''.$row['dateBought'],0,0,'L');
		$pdf->setX(120);$pdf->Cell(0,0,''.$row['warranty_expiration'],0,0,'L');
		$pdf->setX(159);$pdf->Cell(0,0,''.$row['book_value'],0,0,'L');
		$pdf->setX(186);$pdf->Cell(0,0,''.$row['buying_price'],0,0,'L');
		$pdf->setX(210);$pdf->Cell(0,0,''.$row['location'],0,0,'L');
		$pdf->setX(240);$pdf->Cell(0,0,$status,0,0,'L');
		$pdf->setX(267);$pdf->Cell(0,0,''.$row['supplier_name'],0,0,'L');


		}
				
	
		$pdf->Ln(7);
		$pdf->setX(7);$pdf->Cell(0,0,' ',0,0,'C');
$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
$pdf->Output();
$pdf->Output('hardwarestatus.pdf', 'F');	
}
else if($gen == "6")
{
	
    $query = mysql_query("SELECT * FROM hardware supplier_id LEFT JOIN supplier supplier_name ON supplier_id.supplier_id=supplier_name.supplier_id where  warranty_expiration >='$gen1' AND warranty_expiration <= '$gen2' ORDER BY  warranty_expiration ASC");
    if(mysql_num_rows($query) == 0){
		echo "<script>alert('No report found. Please try again'); location.href='../Report1/ReportHardwareStat.php';</script>";
		}
			

if ($gen == "0")
	$status = 'Undeployed ';

if ($gen == "1")
	$status = 'Deployed ';

if ($gen == "2")
	$status = 'Retired ';

if ($gen == "3")
	$status = 'Decomissioned ';

if ($gen == "4")
	$status = 'Repaired ';

if ($gen == "5")
	$status = 'Donated ';



		
		
		$pdf->Ln(2);
		//Image("image name", y, x, image size);
		$pdf->Ln(20);
		$pdf->SetFont('arial','b',50);
		$pdf->setX(25);$pdf->Cell(0,0,'IT Asset Management System',0,0,'L');
		
		$pdf->Ln(30);
		$pdf->SetFont('arial','b',20);
		$pdf->setX(100);$pdf->Cell(0,0,'Expired Hardware Reports',0,0,'L');

		$pdf->Ln(10);

		$pdf->Ln(10);



		
		$pdf->SetFont('arial','b',10);
		$pdf->setX(10);$pdf->Cell(0,0,'Asset ID',0,0,'L');
		$pdf->setX(30);$pdf->Cell(0,0,'Barcode',0,0,'L');
		$pdf->setX(55);$pdf->Cell(0,0,'Name',0,0,'L');
		$pdf->setX(90);$pdf->Cell(0,0,'Date bought',0,0,'L');
		$pdf->setX(115);$pdf->Cell(0,0,'Waranty Expiration ',0,0,'L');
		$pdf->setX(155);$pdf->Cell(0,0,'Book Value',0,0,'L');
		$pdf->setX(182);$pdf->Cell(0,0,'Buying price',0,0,'L');
		$pdf->setX(211);$pdf->Cell(0,0,'Location',0,0,'L');
		$pdf->setX(240);$pdf->Cell(0,0,'Status',0,0,'L');
		$pdf->setX(270);$pdf->Cell(0,0,'Supplier',0,0,'L');

		//$pdf->Ln(6.0001);
		//$pdf->setX(20);$pdf->Cell(0,0,'Liquidating',0,0,'L');
		$pdf->Ln(3);
		$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
		while($row=mysql_fetch_array($query))
		{

			if ($row['status'] == "0")
$status = 'Undeployed ';

if ($row['status'] == "1")
	$status = 'Deployed ';

if ($row['status'] == "2")
	$status = 'Retired ';

if ($row['status'] == "3")
	$status = 'Decomissioned ';

if ($row['status'] == "4")
	$status = 'Repaired ';

if ($row['status'] == "5")
	$status = 'Donated ';


		
		
		$pdf->Ln(7);
		
		//$pdf->Image($row['picture'],9.5,8,13);
		
		
		$pdf->setX(13);$pdf->Cell(0,0,''.$row['asset_id'],0,0,'L');
		$pdf->setX(30);$pdf->Cell(0,0,''.$row['barcode'],0,0,'L');
		$pdf->setX(55);$pdf->Cell(0,0,''.$row['name'],0,0,'L');
		$pdf->setX(90);$pdf->Cell(0,0,''.$row['dateBought'],0,0,'L');
		$pdf->setX(120);$pdf->Cell(0,0,''.$row['warranty_expiration'],0,0,'L');
		$pdf->setX(159);$pdf->Cell(0,0,''.$row['book_value'],0,0,'L');
		$pdf->setX(186);$pdf->Cell(0,0,''.$row['buying_price'],0,0,'L');
		$pdf->setX(210);$pdf->Cell(0,0,''.$row['location'],0,0,'L');
		$pdf->setX(240);$pdf->Cell(0,0,$status,0,0,'L');
		$pdf->setX(267);$pdf->Cell(0,0,''.$row['supplier_name'],0,0,'L');


		}
				
	
		$pdf->Ln(7);
		$pdf->setX(7);$pdf->Cell(0,0,' ',0,0,'C');
$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
$pdf->Output();
$pdf->Output('warrantyexpiry.pdf', 'F');	
}



?>
