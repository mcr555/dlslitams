<?php
require('reports/fpdf.php');
require_once('../db.php');


$gen = $_POST['asset_id'];

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


$sql = "SELECT *,supplier.supplier_name FROM hardware LEFT JOIN supplier ON hardware.supplier_id=supplier.supplier_id where supplier_name = '$gen' ";
        $result = $conn->query($sql);

 if ($result->num_rows == 0){
		echo "<script>alert('No report found. Please try again'); location.href='../Report1/Reportsupplier.php';</script>";
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

            $sql = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','Report','Generate supplier report of $gen','')";
			if (mysqli_query($conn, $sql)){}
            else 
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);

		
		
		$pdf->Ln(25);
		$pdf->SetFont('arial','b',25);
		$pdf->Image("icon.png", 65,10,20);
		$pdf->setX(85);$pdf->Cell(0,0,' Dlsl IT Asset Management System',0,0,'L');
		
		$pdf->Ln(30);
		$pdf->SetFont('arial','b',20);
		$pdf->setX(120);$pdf->Cell(0,0,'Supplier Report',0,0,'L');
		$pdf->Ln(10);

		$pdf->Ln(10);



		
		//$pdf->Ln(10);
		$pdf->SetFont('arial','b',10);

		$pdf->setX(50);$pdf->Cell(0,0,'Name',0,0,'L');
		$pdf->setX(80);$pdf->Cell(0,0,'Supplier Representative',0,0,'L');
		$pdf->setX(135);$pdf->Cell(0,0,'Address',0,0,'L');
		$pdf->setX(170);$pdf->Cell(0,0,'Contact no.',0,0,'L');
		$pdf->setX(210);$pdf->Cell(0,0,'Email',0,0,'L');
		$pdf->setX(250);$pdf->Cell(0,0,'Asset Name',0,0,'L');






		//$pdf->Ln(6.0001);
		//$pdf->setX(20);$pdf->Cell(0,0,'Liquidating',0,0,'L');
		$pdf->Ln(3);
		$pdf->setX(30);$pdf->Cell(0,0,'_____________________________________________________________________________________________________________________________',0,0,'C');
		while($row=$result->fetch_assoc())
		{
		
		
		$pdf->Ln(7);
		
		//$pdf->Image($row['picture'],9.5,8,13);
		
		

		$pdf->setX(50);$pdf->Cell(0,0,''.$row['supplier_name'],0,0,'L');
		$pdf->setX(90);$pdf->Cell(0,0,''.$row['supplier_representative'],0,0,'L');	
		$pdf->setX(130);$pdf->Cell(0,0,''.$row['supplier_address'],0,0,'L');
		$pdf->setX(170);$pdf->Cell(0,0,''.$row['supplier_contact'],0,0,'L');
		$pdf->setX(205);$pdf->Cell(0,0,''.$row['supplier_email'],0,0,'L');
		$pdf->setX(250);$pdf->Cell(0,0,''.$row['name'],0,0,'L');	





		}
				
	
		$pdf->Ln(7);
		$pdf->setX(7);$pdf->Cell(0,0,' ',0,0,'C');
		$pdf->setX(30);$pdf->Cell(0,0,'_____________________________________________________________________________________________________________________________',0,0,'C');
$pdf->Output();
$pdf->Output('supplier.pdf', 'F');


			?>
