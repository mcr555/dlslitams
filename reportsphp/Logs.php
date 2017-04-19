<?php
require('reports/fpdf.php');
require_once('../db.php');

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
	$pdf=new PDF('L','mm','A3');
	$pdf->AliasNbPages();
	$pdf->AddPage();


	// Adds image to beginning of d


$sql = "SELECT * FROM tbl_log WHERE Log_Date_Time >='$gen' AND Log_Date_Time <= '$gen1'";
        $result = $conn->query($sql);

 if ($result->num_rows == 0){
		echo "<script>alert('No report found. Please try again'); location.href='../ReportLogs.php';</script>";
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

            $sql = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','Report','Generate report of Logs date $gen-$gen1 ','')";
			if (mysqli_query($conn, $sql)){}
            else 
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  
			



		
		
		$pdf->Ln(25);
		$pdf->SetFont('arial','b',25);
		$pdf->Image("icon.png", 127,10,20);
		$pdf->setX(145);$pdf->Cell(0,0,' Dlsl IT Asset Management System',0,0,'L');


		$pdf->Ln(20);
		$pdf->SetFont('arial','b',20);
		$pdf->setX(150);$pdf->Cell(0,0,'Log Report',0,0,'L');
		$pdf->Ln(10);
		$pdf->setX(100);$pdf->Cell(0,0,'From: '.$gen.' to '.$gen,0,0,'L');
		$pdf->Ln(10);

		$pdf->Ln(10);



	//$pdf->Ln(10);
		$pdf->SetFont('arial','b',12);
		$pdf->setX(20);$pdf->Cell(0,0,'Time',0,0,'L');
		$pdf->setX(70);$pdf->Cell(0,0,'Name',0,0,'L');
		$pdf->setX(120);$pdf->Cell(0,0,'Category',0,0,'L');
		$pdf->setX(155);$pdf->Cell(0,0,'Account Type',0,0,'L');
		$pdf->setX(210);$pdf->Cell(0,0,'Reference id',0,0,'L');
		$pdf->setX(260);$pdf->Cell(0,0,'Function',0,0,'L');



		//$pdf->Ln(6.0001);
		//$pdf->setX(20);$pdf->Cell(0,0,'Liquidating',0,0,'L');
		$pdf->Ln(3);
		$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
		while($row=$result->fetch_assoc())
		{
		
		
		$pdf->Ln(7);
		
		//$pdf->Image($row['picture'],9.5,8,13);
		
		
		
		$pdf->setX(10);$pdf->Cell(0,0,''.$row['Log_Date_Time'],0,0,'L');
		$pdf->setX(70);$pdf->Cell(0,0,''.$row['Log_Name'],0,0,'L');
		$pdf->setX(120);$pdf->Cell(0,0,''.$row['category'],0,0,'L');
		$pdf->setX(160);$pdf->Cell(0,0,''.$row['Log_LOP'],0,0,'L');
		$pdf->setX(210);$pdf->Cell(0,0,''.$row['id'],0,0,'L');
		$pdf->setX(260);$pdf->Cell(0,0,''.$row['Log_Function'],0,0,'L');
		


		}
				
	
		$pdf->Ln(7);
		$pdf->setX(7);$pdf->Cell(0,0,' ',0,0,'C');
$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
$pdf->Output();
$pdf->Output('Logs.pdf', 'F');


			?>
