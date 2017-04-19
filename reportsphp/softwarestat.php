<?php
require('reports/fpdf.php');
require_once('../db.php');

$gen1 = $_POST["startdate"];
$gen2 = $_POST["enddate"];
$gen=$_POST['software'];




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
	
	$sql = "SELECT * FROM software WHERE date_added >='$gen1' AND date_added <= '$gen2'";
        $result = $conn->query($sql);

 if ($result->num_rows == 0){
		echo "<script>alert('No report found. Please try again'); location.href='../Report1/ReportSoftwareStat.php';
		</script>";
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

            $sql = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','Report','Generate report of $gen Software date $gen1-$gen2 ','')";
			if (mysqli_query($conn, $sql)){}
            else 
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);

		
		
		$pdf->Ln(25);
		$pdf->SetFont('arial','b',25);
		$pdf->Image("icon.png", 65,10,20);
		$pdf->setX(85);$pdf->Cell(0,0,' Dlsl IT Asset Management System',0,0,'L');
		
		
		$pdf->Ln(20);
		$pdf->SetFont('arial','b',20);
		$pdf->setX(100);$pdf->Cell(0,0,'Software status reports',0,0,'L');
		$pdf->Ln(10);

		$pdf->Ln(10);



		
		//$pdf->Ln(10);
		$pdf->SetFont('arial','b',10);
		$pdf->setX(20);$pdf->Cell(0,0,'Name',0,0,'L');
		$pdf->setX(55);$pdf->Cell(0,0,'Version',0,0,'L');
		$pdf->setX(90);$pdf->Cell(0,0,'Expiration Date',0,0,'L');
		$pdf->setX(130);$pdf->Cell(0,0,'Date bought',0,0,'L');
		$pdf->setX(168);$pdf->Cell(0,0,'Serial',0,0,'L');
		$pdf->setX(190);$pdf->Cell(0,0,'Date Added',0,0,'L');
		$pdf->setX(230);$pdf->Cell(0,0,'Date Warn',0,0,'L');
		$pdf->setX(265);$pdf->Cell(0,0,'Status',0,0,'L');



		//$pdf->Ln(6.0001);
		//$pdf->setX(20);$pdf->Cell(0,0,'Liquidating',0,0,'L');
		$pdf->Ln(3);
		$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
		while($row=$result->fetch_assoc())
		{

 if ($row['asset_id'] == "0" && $row['type'] == "1" ){
$status = 'Unused ';
}
else
{
	$status = 'Used ';
}


		
		
		$pdf->Ln(7);
		
		//$pdf->Image($row['picture'],9.5,8,13);
		

		$pdf->setX(20);$pdf->Cell(0,0,''.$row['name'],0,0,'L');
		$pdf->setX(55);$pdf->Cell(0,0,''.$row['version'],0,0,'L');
		$pdf->setX(90);$pdf->Cell(0,0,''.$row['expiration_date'],0,0,'L');
		$pdf->setX(130);$pdf->Cell(0,0,''.$row['date_bought'],0,0,'L');
		$pdf->setX(168);$pdf->Cell(0,0,''.$row['serial'],0,0,'L');
		$pdf->setX(190);$pdf->Cell(0,0,''.$row['date_added'],0,0,'L');
		$pdf->setX(230);$pdf->Cell(0,0,''.$row['date_warn'],0,0,'L');
		$pdf->setX(265);$pdf->Cell(0,0,''.$status,0,0,'L');


		}
				
	
		$pdf->Ln(7);
		$pdf->setX(7);$pdf->Cell(0,0,' ',0,0,'C');
$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
$pdf->Output();
$pdf->Output('allsoftware.pdf', 'F');
}
else if($gen == "0")
{


	
     $sql="SELECT * FROM software WHERE asset_id='$gen' and type ='1' and  date_bought >='$gen1' AND date_bought <= '$gen2'";
      $result = $conn->query($sql);

 if ($result->num_rows == 0){
		echo "<script>alert('No report found. Please try again'); location.href='../Report1/ReportSoftwareStat.php';</script>";
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

$sql = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','Report','Generate report of Unused Software date $gen1-$gen2 ','')";

			if (mysqli_query($conn, $sql)){}
            else 
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);







		$pdf->Ln(25);
		$pdf->SetFont('arial','b',25);
		$pdf->Image("icon.png", 65,10,20);
		$pdf->setX(85);$pdf->Cell(0,0,' Dlsl IT Asset Management System',0,0,'L');
		
		$pdf->Ln(30);
		$pdf->SetFont('arial','b',20);
		$pdf->setX(100);$pdf->Cell(0,0,'Unused Software reports',0,0,'L');

		$pdf->Ln(10);

		$pdf->Ln(10);



		
		//$pdf->Ln(10);
		$pdf->SetFont('arial','b',10);
		$pdf->setX(5);$pdf->Cell(0,0,'Software ID',0,0,'L');
		$pdf->setX(30);$pdf->Cell(0,0,'Asset ID',0,0,'L');
		$pdf->setX(60);$pdf->Cell(0,0,'Name',0,0,'L');
		$pdf->setX(86);$pdf->Cell(0,0,'Version',0,0,'L');
		$pdf->setX(108);$pdf->Cell(0,0,'Expiration Date',0,0,'L');
		$pdf->setX(140);$pdf->Cell(0,0,'Date bought',0,0,'L');
		$pdf->setX(172);$pdf->Cell(0,0,'Serial',0,0,'L');
		$pdf->setX(200);$pdf->Cell(0,0,'Date Added',0,0,'L');
		$pdf->setX(240);$pdf->Cell(0,0,'Date Warn',0,0,'L');
		$pdf->setX(270);$pdf->Cell(0,0,'Status',0,0,'L');

		//$pdf->Ln(6.0001);
		//$pdf->setX(20);$pdf->Cell(0,0,'Liquidating',0,0,'L');
		$pdf->Ln(3);
		$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
		while($row=$result->fetch_assoc())
		{


		
		
		$pdf->Ln(7);
		
		//$pdf->Image($row['picture'],9.5,8,13);
		
		
		$pdf->setX(10);$pdf->Cell(0,0,''.$row['software_id'],0,0,'L');
		$pdf->setX(33);$pdf->Cell(0,0,''.$row['asset_id'],0,0,'L');
		$pdf->setX(50);$pdf->Cell(0,0,''.$row['name'],0,0,'L');
		$pdf->setX(90);$pdf->Cell(0,0,''.$row['version'],0,0,'L');
		$pdf->setX(110);$pdf->Cell(0,0,''.$row['expiration_date'],0,0,'L');
		$pdf->setX(140);$pdf->Cell(0,0,''.$row['date_bought'],0,0,'L');
		$pdf->setX(172);$pdf->Cell(0,0,''.$row['serial'],0,0,'L');
		$pdf->setX(200);$pdf->Cell(0,0,''.$row['date_added'],0,0,'L');
		$pdf->setX(240);$pdf->Cell(0,0,''.$row['date_warn'],0,0,'L');
		$pdf->setX(270);$pdf->Cell(0,0,'Unused',0,0,'L');


		}
				
	
		$pdf->Ln(7);
		$pdf->setX(7);$pdf->Cell(0,0,' ',0,0,'C');
$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
$pdf->Output();
$pdf->Output('Unused.pdf', 'F');
}
else if($gen == "1")
{



   $sql = "SELECT * FROM software WHERE asset_id >='$gen' and type ='1' and date_bought >='$gen1' AND date_bought <= '$gen2'";
    $result = $conn->query($sql);

 if ($result->num_rows == 0){
		echo "<script>alert('No report found. Please try again'); location.href='../Report1/ReportSoftwareStat.php';</script>";
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

$sql = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','Report','Generate report of Used Software date $gen1-$gen2 ','')";
			if (mysqli_query($conn, $sql)){}
            else 
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);






		
		$pdf->Ln(25);
		$pdf->SetFont('arial','b',25);
		$pdf->Image("icon.png", 65,10,20);
		$pdf->setX(85);$pdf->Cell(0,0,' Dlsl IT Asset Management System',0,0,'L');
		
		$pdf->Ln(30);	
		$pdf->SetFont('arial','b',20);
		$pdf->setX(100);$pdf->Cell(0,0,'Used Software reports',0,0,'L');

		$pdf->Ln(10);

		$pdf->Ln(10);



		
		//$pdf->Ln(10);
		$pdf->SetFont('arial','b',10);
		$pdf->setX(5);$pdf->Cell(0,0,'Software ID',0,0,'L');
		$pdf->setX(30);$pdf->Cell(0,0,'Asset ID',0,0,'L');
		$pdf->setX(60);$pdf->Cell(0,0,'Name',0,0,'L');
		$pdf->setX(86);$pdf->Cell(0,0,'Version',0,0,'L');
		$pdf->setX(108);$pdf->Cell(0,0,'Expiration Date',0,0,'L');
		$pdf->setX(140);$pdf->Cell(0,0,'Date bought',0,0,'L');
		$pdf->setX(172);$pdf->Cell(0,0,'Serial',0,0,'L');
		$pdf->setX(200);$pdf->Cell(0,0,'Date Added',0,0,'L');
		$pdf->setX(240);$pdf->Cell(0,0,'Date Warn',0,0,'L');
		$pdf->setX(270);$pdf->Cell(0,0,'Status',0,0,'L');

		//$pdf->Ln(6.0001);
		//$pdf->setX(20);$pdf->Cell(0,0,'Liquidating',0,0,'L');
		$pdf->Ln(3);
		$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
		while($row=$result->fetch_assoc())
		{


		
		
		$pdf->Ln(7);
		
		//$pdf->Image($row['picture'],9.5,8,13);
		
		
		$pdf->setX(10);$pdf->Cell(0,0,''.$row['software_id'],0,0,'L');
		$pdf->setX(33);$pdf->Cell(0,0,''.$row['asset_id'],0,0,'L');
		$pdf->setX(50);$pdf->Cell(0,0,''.$row['name'],0,0,'L');
		$pdf->setX(90);$pdf->Cell(0,0,''.$row['version'],0,0,'L');
		$pdf->setX(110);$pdf->Cell(0,0,''.$row['expiration_date'],0,0,'L');
		$pdf->setX(140);$pdf->Cell(0,0,''.$row['date_bought'],0,0,'L');
		$pdf->setX(172);$pdf->Cell(0,0,''.$row['serial'],0,0,'L');
		$pdf->setX(200);$pdf->Cell(0,0,''.$row['date_added'],0,0,'L');
		$pdf->setX(240);$pdf->Cell(0,0,''.$row['date_warn'],0,0,'L');
		$pdf->setX(270);$pdf->Cell(0,0,'Used',0,0,'L');


		}
				
	
		$pdf->Ln(7);
		$pdf->setX(7);$pdf->Cell(0,0,' ',0,0,'C');
$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
$pdf->Output();
$pdf->Output('Used.pdf', 'F');
}
else if($gen == "2")
{

	
    $sql="SELECT * FROM software where WHERE type ='1' and expiration_date >='$gen1' AND expiration_date <='$gen2' ORDER BY  expiration_date ASC";
    $result = $conn->query($sql);

 if ($result->num_rows == 0){
		echo "<script>alert('No report found. Please try again'); location.href='../Report1/ReportSoftwareStat.php';</script>";
				exit(0);




		}
		$status1 = 'Expired ';

			
			  session_start();
		date_default_timezone_set("Asia/Manila"); 
                $vd=date("Y-m-d h:i:a");
                $sql1 = "select * from users where idnumber = '".$_SESSION['id']."'";
        $result1 = $conn->query($sql1);


 			$vn=$_SESSION["firstname"] ;
             $vn1=$_SESSION["middlename"] ;
            $vn2=$_SESSION["lastname"] ;
            $vn3=$_SESSION["accountType"] ;

$sql = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id)VALUES ('$vn $vn1 $vn2','$vn3','$vd','Report','Generate report of $status Software date $gen1-$gen2 ','')";
			if (mysqli_query($conn, $sql)){}
            else 
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);

		
			
		$pdf->Ln(25);
		$pdf->SetFont('arial','b',25);
		$pdf->Image("icon.png", 65,10,20);
		$pdf->setX(85);$pdf->Cell(0,0,' Dlsl IT Asset Management System',0,0,'L');
		
		$pdf->Ln(30);
		$pdf->SetFont('arial','b',20);
		$pdf->setX(100);$pdf->Cell(0,0,'Expired software',0,0,'L');

		$pdf->Ln(10);

		$pdf->Ln(10);



		
		//$pdf->Ln(10);
		$pdf->SetFont('arial','b',10);
		$pdf->setX(5);$pdf->Cell(0,0,'Software ID',0,0,'L');
		$pdf->setX(30);$pdf->Cell(0,0,'Asset ID',0,0,'L');
		$pdf->setX(60);$pdf->Cell(0,0,'Name',0,0,'L');
		$pdf->setX(86);$pdf->Cell(0,0,'Version',0,0,'L');
		$pdf->setX(108);$pdf->Cell(0,0,'Expiration Date',0,0,'L');
		$pdf->setX(140);$pdf->Cell(0,0,'Date bought',0,0,'L');
		$pdf->setX(172);$pdf->Cell(0,0,'Serial',0,0,'L');
		$pdf->setX(200);$pdf->Cell(0,0,'Date Added',0,0,'L');
		$pdf->setX(240);$pdf->Cell(0,0,'Date Warn',0,0,'L');
		$pdf->setX(270);$pdf->Cell(0,0,'Status',0,0,'L');

		//$pdf->Ln(6.0001);
		//$pdf->setX(20);$pdf->Cell(0,0,'Liquidating',0,0,'L');
		$pdf->Ln(3);
		$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
		while($row=$result->fetch_assoc())
		{


		
		
		$pdf->Ln(7);
		
		//$pdf->Image($row['picture'],9.5,8,13);
		
		
		$pdf->setX(10);$pdf->Cell(0,0,''.$row['software_id'],0,0,'L');
		$pdf->setX(33);$pdf->Cell(0,0,''.$row['asset_id'],0,0,'L');
		$pdf->setX(50);$pdf->Cell(0,0,''.$row['name'],0,0,'L');
		$pdf->setX(90);$pdf->Cell(0,0,''.$row['version'],0,0,'L');
		$pdf->setX(110);$pdf->Cell(0,0,''.$row['expiration_date'],0,0,'L');
		$pdf->setX(140);$pdf->Cell(0,0,''.$row['date_bought'],0,0,'L');
		$pdf->setX(172);$pdf->Cell(0,0,''.$row['serial'],0,0,'L');
		$pdf->setX(200);$pdf->Cell(0,0,''.$row['date_added'],0,0,'L');
		$pdf->setX(240);$pdf->Cell(0,0,''.$row['date_warn'],0,0,'L');
		$pdf->setX(270);$pdf->Cell(0,0,$status1,0,0,'L');


		}
				
	
		$pdf->Ln(7);
		$pdf->setX(7);$pdf->Cell(0,0,' ',0,0,'C');
$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
$pdf->Output();
$pdf->Output('Receipt.pdf', 'F');
}
			?>
