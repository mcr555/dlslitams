<?php
require('reports/fpdf.php');
require_once('../db.php');


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
	$pdf=new PDF('L','mm','A3');
	$pdf->AliasNbPages();
	$pdf->AddPage();


	// Adds image to beginning of d

	

if($gen=='all')
{
	$sql = "SELECT * FROM hardware supplier_id LEFT JOIN supplier supplier_name ON supplier_id.supplier_id=supplier_name.supplier_id WHERE dateBought >='$gen1' AND dateBought <= '$gen2'";
        $result = $conn->query($sql);

 if ($result->num_rows == 0){
		echo "<script>alert('No report found. Please try again'); location.href='../Report1/ReportHardwareStat.php';</script>";
		exit(0);


		}

			  session_start();
		date_default_timezone_set("Asia/Manila"); 
                $vd=date("Y-m-d h:i:a");

		$sql1 = "select * from users where idnumber = '".$_SESSION['id']."'";
        $result1 = $conn->query($sql1);

 
 			$vn=$_SESSION["firstname"] ;
             $vn1=$_SESSION["middlename"] ;
            $vn2=$_SESSION["lastname"] ;
            $vn3=$_SESSION["accountType"] ;

            $sql = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','Hardware','Generate hardware report ','')";
			if (mysqli_query($conn, $sql)){}
            else 
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);

		
		
		$pdf->Ln(25);
		$pdf->SetFont('arial','b',25);
		$pdf->Image("icon.png", 127,10,20);
		$pdf->setX(145);$pdf->Cell(0,0,' Dlsl IT Asset Management System',0,0,'L');
		
		$pdf->Ln(20);
		$pdf->SetFont('arial','b',20);
		$pdf->setX(168);$pdf->Cell(0,0,'Hardware Reports',0,0,'L');
		$pdf->Ln(10);

		$pdf->Ln(10);



		
		//$pdf->Ln(10);
		$pdf->SetFont('arial','b',12);
		$pdf->setX(5);$pdf->Cell(0,0,'Barcode',0,0,'L');
		$pdf->setX(30);$pdf->Cell(0,0,'Name',0,0,'L');
		$pdf->setX(65);$pdf->Cell(0,0,'Category',0,0,'L');
		$pdf->setX(95);$pdf->Cell(0,0,'Date bought',0,0,'L');
		$pdf->setX(135);$pdf->Cell(0,0,'Lifespan end',0,0,'L');
		$pdf->setX(175);$pdf->Cell(0,0,'Warranty Expiration',0,0,'L');
		$pdf->setX(225);$pdf->Cell(0,0,'Book Value',0,0,'L');
		$pdf->setX(265);$pdf->Cell(0,0,'Buying price',0,0,'L');
		$pdf->setX(300);$pdf->Cell(0,0,'Location',0,0,'L');
		$pdf->setX(340);$pdf->Cell(0,0,'Status',0,0,'L');
		$pdf->setX(380);$pdf->Cell(0,0,'Supplier',0,0,'L');


		//$pdf->Ln(6.0001);
		//$pdf->setX(20);$pdf->Cell(0,0,'Liquidating',0,0,'L');
		$pdf->Ln(3);
		$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');		
while($row=$result->fetch_assoc())
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
	$status = 'Borrowed ';
		
		
		$pdf->Ln(7);
		
		//$pdf->Image($row['picture'],9.5,8,13);
		

		$pdf->setX(5);$pdf->Cell(0,0,''.$row['barcode'],0,0,'L');
		$pdf->setX(30);$pdf->Cell(0,0,''.$row['name'],0,0,'L');
		$pdf->setX(65);$pdf->Cell(0,0,''.$row['hardware_category'],0,0,'L');
		$pdf->setX(95);$pdf->Cell(0,0,''.$row['dateBought'],0,0,'L');
		$pdf->setX(135);$pdf->Cell(0,0,''.$row['lifespanEnd'],0,0,'L');
		$pdf->setX(175);$pdf->Cell(0,0,''.$row['warranty_expiration'],0,0,'L');
		$pdf->setX(225);$pdf->Cell(0,0,''.$row['book_value'],0,0,'L');
		$pdf->setX(265);$pdf->Cell(0,0,''.$row['buying_price'],0,0,'L');
		$pdf->setX(300);$pdf->Cell(0,0,''.$row['location'],0,0,'L');
		$pdf->setX(340);$pdf->Cell(0,0,''.$status,0,0,'L');
		$pdf->setX(380);$pdf->Cell(0,0,''.$row['supplier_name'],0,0,'L');


		}
				
	
		$pdf->Ln(7);
		$pdf->setX(7);$pdf->Cell(0,0,' ',0,0,'C');
$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
$pdf->Output();
$pdf->Output('allhardware.pdf', 'F');
}
else if($gen == "0" ||  $gen=="1" || $gen=="2"|| $gen=="3"|| $gen=="4"|| $gen=="5")
{
	
   	 $sql="SELECT * FROM hardware supplier_id LEFT JOIN supplier supplier_name ON supplier_id.supplier_id=supplier_name.supplier_id where status ='$gen' And dateBought >='$gen1' AND dateBought <= '$gen2'";	
      $result = $conn->query($sql);

 if ($result->num_rows == 0){
		echo "<script>alert('No report found. Please try again'); location.href='../Report1/ReportHardwareStat.php';</script>";
				exit(0);


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
	$status = 'Borrowed ';

			  session_start();
		date_default_timezone_set("Asia/Manila"); 
                $vd=date("Y-m-d h:i:a");
                $sql1 = "select * from users where idnumber = '".$_SESSION['id']."'";
        $result1 = $conn->query($sql1);

 			$vn=$_SESSION["firstname"] ;
             $vn1=$_SESSION["middlename"] ;
            $vn2=$_SESSION["lastname"] ;
            $vn3=$_SESSION["accountType"] ;

$sql = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','Hardware','Generate hardware report ','')";
			if (mysqli_query($conn, $sql)){}
            else 
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);



		
		
		
		
		$pdf->Ln(25);
		$pdf->SetFont('arial','b',25);
		$pdf->Image("icon.png", 127,10,20);
		$pdf->setX(145);$pdf->Cell(0,0,' Dlsl IT Asset Management System',0,0,'L');
		
		$pdf->Ln(20);
		$pdf->SetFont('arial','b',20);
		$pdf->setX(164);$pdf->Cell(0,0,$status.'Hardware Reports',0,0,'L');

		$pdf->Ln(10);

		$pdf->Ln(10);



		
		$pdf->SetFont('arial','b',12);
		$pdf->setX(5);$pdf->Cell(0,0,'Barcode',0,0,'L');
		$pdf->setX(30);$pdf->Cell(0,0,'Name',0,0,'L');
		$pdf->setX(65);$pdf->Cell(0,0,'Category',0,0,'L');
		$pdf->setX(95);$pdf->Cell(0,0,'Date bought',0,0,'L');
		$pdf->setX(135);$pdf->Cell(0,0,'Lifespan end',0,0,'L');
		$pdf->setX(175);$pdf->Cell(0,0,'Warranty Expiration',0,0,'L');
		$pdf->setX(225);$pdf->Cell(0,0,'Book Value',0,0,'L');
		$pdf->setX(265);$pdf->Cell(0,0,'Buying price',0,0,'L');
		$pdf->setX(300);$pdf->Cell(0,0,'Location',0,0,'L');
		$pdf->setX(340);$pdf->Cell(0,0,'Status',0,0,'L');
		$pdf->setX(380);$pdf->Cell(0,0,'Supplier',0,0,'L');


		//$pdf->Ln(6.0001);
		//$pdf->setX(20);$pdf->Cell(0,0,'Liquidating',0,0,'L');
		$pdf->Ln(3);
		$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
		while($row=$result->fetch_assoc())
		{


		
		
		$pdf->Ln(7);
		
		//$pdf->Image($row['picture'],9.5,8,13);
		
		

		$pdf->setX(5);$pdf->Cell(0,0,''.$row['barcode'],0,0,'L');
		$pdf->setX(30);$pdf->Cell(0,0,''.$row['name'],0,0,'L');
		$pdf->setX(65);$pdf->Cell(0,0,''.$row['hardware_category'],0,0,'L');
		$pdf->setX(95);$pdf->Cell(0,0,''.$row['dateBought'],0,0,'L');
		$pdf->setX(135);$pdf->Cell(0,0,''.$row['lifespanEnd'],0,0,'L');
		$pdf->setX(175);$pdf->Cell(0,0,''.$row['warranty_expiration'],0,0,'L');
		$pdf->setX(225);$pdf->Cell(0,0,''.$row['book_value'],0,0,'L');
		$pdf->setX(265);$pdf->Cell(0,0,''.$row['buying_price'],0,0,'L');
		$pdf->setX(300);$pdf->Cell(0,0,''.$row['location'],0,0,'L');
		$pdf->setX(340);$pdf->Cell(0,0,''.$status,0,0,'L');
		$pdf->setX(380);$pdf->Cell(0,0,''.$row['supplier_name'],0,0,'L');

		}
				
	
		$pdf->Ln(7);
		$pdf->setX(7);$pdf->Cell(0,0,' ',0,0,'C');
$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
$pdf->Output();
$pdf->Output('hardwarestatus.pdf', 'F');	
}
else if($gen == "6")
{
	
    $sql="SELECT * FROM hardware supplier_id LEFT JOIN supplier supplier_name ON supplier_id.supplier_id=supplier_name.supplier_id where  warranty_expiration >='$gen1' AND warranty_expiration <= '$gen2' ORDER BY  warranty_expiration ASC";
    $result = $conn->query($sql);

 if ($result->num_rows == 0){
		echo "<script>alert('No report found. Please try again'); location.href='../Report1/ReportHardwareStat.php';</script>";
				exit(0);


		}


			  session_start();
		date_default_timezone_set("Asia/Manila"); 
                $vd=date("Y-m-d h:i:a");
                $sql1 = "select * from users where idnumber = '".$_SESSION['id']."'";
        $result1 = $conn->query($sql1);


 			$vn=$_SESSION["firstname"] ;
             $vn1=$_SESSION["middlename"] ;
            $vn2=$_SESSION["lastname"] ;
            $vn3=$_SESSION["accountType"] ;

$sql = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','Hardware','Generate hardware report ','')";
			if (mysqli_query($conn, $sql)){}
            else 
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);


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
	$status = 'Borrowed ';


		
		
		
		$pdf->Ln(25);
		$pdf->SetFont('arial','b',25);
		$pdf->Image("icon.png", 127,10,20);
		$pdf->setX(145);$pdf->Cell(0,0,' Dlsl IT Asset Management System',0,0,'L');
		
		$pdf->Ln(30);
		$pdf->SetFont('arial','b',20);
		$pdf->setX(100);$pdf->Cell(0,0,'Expired Hardware Reports',0,0,'L');

		$pdf->Ln(10);

		$pdf->Ln(10);



		$pdf->SetFont('arial','b',12);
		$pdf->setX(5);$pdf->Cell(0,0,'Barcode',0,0,'L');
		$pdf->setX(30);$pdf->Cell(0,0,'Name',0,0,'L');
		$pdf->setX(65);$pdf->Cell(0,0,'Category',0,0,'L');
		$pdf->setX(95);$pdf->Cell(0,0,'Date bought',0,0,'L');
		$pdf->setX(135);$pdf->Cell(0,0,'Lifespan end',0,0,'L');
		$pdf->setX(175);$pdf->Cell(0,0,'Warranty Expiration',0,0,'L');
		$pdf->setX(225);$pdf->Cell(0,0,'Book Value',0,0,'L');
		$pdf->setX(265);$pdf->Cell(0,0,'Buying price',0,0,'L');
		$pdf->setX(300);$pdf->Cell(0,0,'Location',0,0,'L');
		$pdf->setX(340);$pdf->Cell(0,0,'Status',0,0,'L');
		$pdf->setX(390);$pdf->Cell(0,0,'Supplier',0,0,'L');

		//$pdf->Ln(6.0001);
		//$pdf->setX(20);$pdf->Cell(0,0,'Liquidating',0,0,'L');
		$pdf->Ln(3);
		$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
		while($row=$result->fetch_assoc())
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
	$status = 'Borrowed ';


		
		
		$pdf->Ln(7);
		
		//$pdf->Image($row['picture'],9.5,8,13);
		
		

		$pdf->setX(5);$pdf->Cell(0,0,''.$row['barcode'],0,0,'L');
		$pdf->setX(30);$pdf->Cell(0,0,''.$row['name'],0,0,'L');
		$pdf->setX(65);$pdf->Cell(0,0,''.$row['hardware_category'],0,0,'L');
		$pdf->setX(95);$pdf->Cell(0,0,''.$row['dateBought'],0,0,'L');
		$pdf->setX(135);$pdf->Cell(0,0,''.$row['lifespanEnd'],0,0,'L');
		$pdf->setX(175);$pdf->Cell(0,0,''.$row['warranty_expiration'],0,0,'L');
		$pdf->setX(225);$pdf->Cell(0,0,''.$row['book_value'],0,0,'L');
		$pdf->setX(265);$pdf->Cell(0,0,''.$row['buying_price'],0,0,'L');
		$pdf->setX(300);$pdf->Cell(0,0,''.$row['location'],0,0,'L');
		$pdf->setX(340);$pdf->Cell(0,0,''.$status,0,0,'L');
		$pdf->setX(380);$pdf->Cell(0,0,''.$row['supplier_name'],0,0,'L');

		}
				
	
		$pdf->Ln(7);
		$pdf->setX(7);$pdf->Cell(0,0,' ',0,0,'C');
$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
$pdf->Output();
$pdf->Output('warrantyexpiry.pdf', 'F');	
}



?>