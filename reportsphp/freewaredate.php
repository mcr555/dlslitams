<?php
require('reports/fpdf.php');
require_once('../db.php');

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



if($gen=='all')
{
	
   $sql = "SELECT * FROM software where type='0' ";
        $result = $conn->query($sql);

 if ($result->num_rows == 0){

		echo "<script>alert('No report found. Please try again'); location.href='../freewareRepdate.php';</script>";
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

            $sql = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','Software','Generate Freeware report ','')";
			if (mysqli_query($conn, $sql)){}
            else 
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);

		

		
		$pdf->Ln(25);
		$pdf->SetFont('arial','b',25);
		$pdf->Image("icon.png", 65,10,20);
		$pdf->setX(85);$pdf->Cell(0,0,' Dlsl IT Asset Management System',0,0,'L');
		
		
		$pdf->Ln(2);
		
		$pdf->Ln(25);
		$pdf->SetFont('arial','b',25);
		$pdf->Image("icon.png", 65,10,20);
		$pdf->setX(85);$pdf->Cell(0,0,' Dlsl IT Asset Management System',0,0,'L');
		
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
$pdf->Output('freewareall.pdf', 'F');
}
else if($gen == "1")
{
	
  $sql = "SELECT * FROM software where type='0' and asset_id >='1' ";
        $result = $conn->query($sql);

 if ($result->num_rows == 0){
		echo "<script>alert('No report found. Please try again'); location.href='../freewareRepdate.php';</script>";
		}
		  session_start();
		date_default_timezone_set("Asia/Manila"); 
                $vd=date("Y-m-d h:i:a");

		$sql1 = "select * from users where idnumber = '".$_SESSION['id']."'";
        $result1 = $conn->query($sql1);

 
 			 $sql = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','Software','Used freeware report ','')";
			if (mysqli_query($conn, $sql)){}
            else 
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);

		
		
		$pdf->Ln(25);
		$pdf->SetFont('arial','b',25);
		$pdf->Image("icon.png", 65,10,20);
		$pdf->setX(85);$pdf->Cell(0,0,' Dlsl IT Asset Management System',0,0,'L');
		
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
		while($row=$result->fetch_assoc())
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
$pdf->Output('Usedfreeware.pdf', 'F');
}
else if($gen == "0")
{
	
    $sql="SELECT * FROM software where type='0' and asset_id ='0'";
      $result = $conn->query($sql);

 if ($result->num_rows == 0){
		echo "<script>alert('No report found. Please try again'); location.href='../freewareRepdate.php';</script>";
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

$sql = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','Software','Unused freeware report ','')";
			if (mysqli_query($conn, $sql)){}
            else 
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);



		
		
		$pdf->Ln(25);
		$pdf->SetFont('arial','b',25);
		$pdf->Image("icon.png", 65,10,20);
		$pdf->setX(85);$pdf->Cell(0,0,' Dlsl IT Asset Management System',0,0,'L');
		
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
		while($row=$result->fetch_assoc())
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
$pdf->Output('Unusedfreeware.pdf', 'F');
}

			?>
