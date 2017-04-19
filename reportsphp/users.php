<?php
require('reports/fpdf.php');
require_once('../db.php');

$gen1 = $_POST["startdate"];
$gen2 = $_POST["enddate"];
$gen=$_POST['user'];



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




if($gen=="all")
{
	
   $sql = "SELECT * FROM users WHERE userStatus ='$gen' AND dateAdded >='$gen1' AND dateAdded <= '$gen2'";
        $result = $conn->query($sql);

 if ($result->num_rows == 0){
		echo "<script>alert('No report found. Please try again'); location.href='../Report1/ReportUserStat.php';</script>";
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

            $sql = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','Report','Generate report of $gen User date $gen1-$gen2','')";
			if (mysqli_query($conn, $sql)){}
            else 
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);

		
	
		
		$pdf->Ln(25);
		$pdf->SetFont('arial','b',25);
		$pdf->Image("icon.png", 65,10,20);
		$pdf->setX(85);$pdf->Cell(0,0,' Dlsl IT Asset Management System',0,0,'L');
		
		$pdf->Ln(30);
		$pdf->SetFont('arial','b',20);
		$pdf->setX(130);$pdf->Cell(0,0,'Users Report',0,0,'L');
		$pdf->Ln(10);

		$pdf->Ln(10);



	
		
		//$pdf->Ln(10);
		$pdf->SetFont('arial','b',10);
		$pdf->setX(10);$pdf->Cell(0,0,'Id Number',0,0,'L');
		$pdf->setX(40);$pdf->Cell(0,0,'Full Name',0,0,'L');
		$pdf->setX(70);$pdf->Cell(0,0,'Gender',0,0,'L');
		$pdf->setX(110);$pdf->Cell(0,0,'Email',0,0,'L');
		$pdf->setX(150);$pdf->Cell(0,0,'Department ',0,0,'L');
		$pdf->setX(180);$pdf->Cell(0,0,'Account Type',0,0,'L');
		$pdf->setX(232);$pdf->Cell(0,0,'Date Added',0,0,'L');
		$pdf->setX(270);$pdf->Cell(0,0,'Status',0,0,'L');




		//$pdf->Ln(6.0001);
		//$pdf->setX(20);$pdf->Cell(0,0,'Liquidating',0,0,'L');
		$pdf->Ln(3);
		$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
	while($row=$result->fetch_assoc())
		{
			 if ($row['userStatus'] == "0")
			$status = 'Activated';
		 if ($row['userStatus'] == "1")
			$status = 'Deactivated';

		
		
		$pdf->Ln(7);
		
		//$pdf->Image($row['picture'],9.5,8,13);
		
		

		$pdf->setX(13);$pdf->Cell(0,0,''.$row['idnumber'],0,0,'L');
		$pdf->setX(40);$pdf->Cell(0,0,''.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'],0,0,'L');
		$pdf->setX(70);$pdf->Cell(0,0,''.$row['gender'],0,0,'L');
		$pdf->setX(100);$pdf->Cell(0,0,''.$row['email'],0,0,'L');
		$pdf->setX(155);$pdf->Cell(0,0,''.$row['department'],0,0,'L');
		$pdf->setX(180);$pdf->Cell(0,0,''.$row['accountType'],0,0,'L');
		$pdf->setX(227);$pdf->Cell(0,0,''.$row['dateAdded'],0,0,'L');
		$pdf->setX(270);$pdf->Cell(0,0,''.$status,0,0,'L');



		}
				
	
		$pdf->Ln(7);
		$pdf->setX(7);$pdf->Cell(0,0,' ',0,0,'C');
		$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
$pdf->Output();
$pdf->Output('alluser.pdf', 'F');
}
if($gen=='0')
{
	
   $sql="SELECT * FROM users WHERE userStatus ='$gen' AND  dateAdded >='$gen1' AND dateAdded <= '$gen2'";
      $result = $conn->query($sql);

 if ($result->num_rows == 0){
		echo "<script>alert('No report found. Please try again'); location.href='../Report1/ReportUserStat.php';</script>";
		exit(0);


		}
			if ($gen == "0")
			$status = 'Activated';

  session_start();
		date_default_timezone_set("Asia/Manila"); 
                $vd=date("Y-m-d h:i:a");
                $sql1 = "select * from users where idnumber = '".$_SESSION['id']."'";
        $result1 = $conn->query($sql1);

 			$vn=$_SESSION["firstname"] ;
             $vn1=$_SESSION["middlename"] ;
            $vn2=$_SESSION["lastname"] ;
            $vn3=$_SESSION["accountType"] ;

$sql = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id)  VALUES ('$vn $vn1 $vn2','$vn3','$vd','Report','Generate report of $gen User date $gen1-$gen2','')";
			if (mysqli_query($conn, $sql)){}
            else 
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);



		
		
		
		$pdf->Ln(25);
		$pdf->SetFont('arial','b',25);
		$pdf->Image("icon.png", 65,10,20);
		$pdf->setX(85);$pdf->Cell(0,0,' Dlsl IT Asset Management System',0,0,'L');
		
		$pdf->Ln(30);
		$pdf->SetFont('arial','b',20);
		$pdf->setX(120);$pdf->Cell(0,0,'Users Report',0,0,'L');
		$pdf->Ln(10);

		$pdf->Ln(10);



	
		
		//$pdf->Ln(10);
		$pdf->SetFont('arial','b',10);
		$pdf->setX(10);$pdf->Cell(0,0,'Id Number',0,0,'L');
		$pdf->setX(40);$pdf->Cell(0,0,'Full Name',0,0,'L');
		$pdf->setX(70);$pdf->Cell(0,0,'Gender',0,0,'L');
		$pdf->setX(110);$pdf->Cell(0,0,'Email',0,0,'L');
		$pdf->setX(150);$pdf->Cell(0,0,'Department ',0,0,'L');
		$pdf->setX(180);$pdf->Cell(0,0,'Account Type',0,0,'L');
		$pdf->setX(232);$pdf->Cell(0,0,'Date Added',0,0,'L');
		$pdf->setX(270);$pdf->Cell(0,0,'Status',0,0,'L');




		//$pdf->Ln(6.0001);
		//$pdf->setX(20);$pdf->Cell(0,0,'Liquidating',0,0,'L');
		$pdf->Ln(3);
		$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
		while($row=$result->fetch_assoc())
		{

		
		
		$pdf->Ln(7);
		
		//$pdf->Image($row['picture'],9.5,8,13);
		
		

		$pdf->setX(13);$pdf->Cell(0,0,''.$row['idnumber'],0,0,'L');
		$pdf->setX(40);$pdf->Cell(0,0,''.$row['firstname'].''.$row['middlename'].''.$row['lastname'],0,0,'L');
		$pdf->setX(70);$pdf->Cell(0,0,''.$row['gender'],0,0,'L');
		$pdf->setX(100);$pdf->Cell(0,0,''.$row['email'],0,0,'L');
		$pdf->setX(155);$pdf->Cell(0,0,''.$row['department'],0,0,'L');
		$pdf->setX(180);$pdf->Cell(0,0,''.$row['accountType'],0,0,'L');
		$pdf->setX(227);$pdf->Cell(0,0,''.$row['dateAdded'],0,0,'L');
		$pdf->setX(270);$pdf->Cell(0,0,''.$status,0,0,'L');



		}
				
	
		$pdf->Ln(7);
		$pdf->setX(7);$pdf->Cell(0,0,' ',0,0,'C');
		$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
$pdf->Output();
$pdf->Output('activeuser.pdf', 'F');
}
else if($gen =='1')		
{							
	    $sql="SELECT * FROM users WHERE str_to_date(dateDeactivated,'%Y/%m/%d %H:%i:%s') >=str_to_date('$gen1','%Y-%m-%d') AND str_to_date(dateDeactivated,'%Y/%m/%d %H:%i:%s') <=str_to_date('$gen2','%Y-%m-%d')";
    $result = $conn->query($sql);

 if ($result->num_rows == 0){
		echo "<script>alert('No report found. Please try again'); location.href='../Report1/ReportUserStat.php';</script>";
				exit(0);


		}
			 if ($gen == "1")
			$status = 'Deactivated';


			  session_start();
		date_default_timezone_set("Asia/Manila"); 
                $vd=date("Y-m-d h:i:a");
                $sql1 = "select * from users where idnumber = '".$_SESSION['id']."'";
        $result1 = $conn->query($sql1);


 			$vn=$_SESSION["firstname"] ;
             $vn1=$_SESSION["middlename"] ;
            $vn2=$_SESSION["lastname"] ;
            $vn3=$_SESSION["accountType"] ;

$sql = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','Report','Generate report of $gen User date $gen1-$gen2','')";
			if (mysqli_query($conn, $sql)){}
            else 
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);

		
		
		$pdf->Ln(2);
		//Image("image name", y, x, image size);
		$pdf->Ln(20);
		$pdf->SetFont('arial','b',50);
		$pdf->setX(25);$pdf->Cell(0,0,'IT Asset Management System',0,0,'L');
		
		$pdf->Ln(30);
		$pdf->SetFont('arial','b',20);
		$pdf->setX(120);$pdf->Cell(0,0,'Users Report',0,0,'L');
		$pdf->Ln(10);

		$pdf->Ln(10);



	
		
		//$pdf->Ln(10);
		$pdf->SetFont('arial','b',10);
		$pdf->setX(10);$pdf->Cell(0,0,'Id Number',0,0,'L');
		$pdf->setX(40);$pdf->Cell(0,0,'Full Name',0,0,'L');
		$pdf->setX(70);$pdf->Cell(0,0,'Gender',0,0,'L');
		$pdf->setX(110);$pdf->Cell(0,0,'Email',0,0,'L');
		$pdf->setX(150);$pdf->Cell(0,0,'Department ',0,0,'L');
		$pdf->setX(180);$pdf->Cell(0,0,'Account Type',0,0,'L');
		$pdf->setX(232);$pdf->Cell(0,0,'Date Added',0,0,'L');
		$pdf->setX(270);$pdf->Cell(0,0,'Status',0,0,'L');




		//$pdf->Ln(6.0001);
		//$pdf->setX(20);$pdf->Cell(0,0,'Liquidating',0,0,'L');
		$pdf->Ln(3);
		$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
		while($row=$result->fetch_assoc())
		{
		

		
		
		$pdf->Ln(7);
		
		//$pdf->Image($row['picture'],9.5,8,13);
		
		

		$pdf->setX(13);$pdf->Cell(0,0,''.$row['idnumber'],0,0,'L');
		$pdf->setX(40);$pdf->Cell(0,0,''.$row['firstname'].''.$row['middlename'].''.$row['lastname'],0,0,'L');
		$pdf->setX(70);$pdf->Cell(0,0,''.$row['gender'],0,0,'L');
		$pdf->setX(100);$pdf->Cell(0,0,''.$row['email'],0,0,'L');
		$pdf->setX(155);$pdf->Cell(0,0,''.$row['department'],0,0,'L');
		$pdf->setX(180);$pdf->Cell(0,0,''.$row['accountType'],0,0,'L');
		$pdf->setX(227);$pdf->Cell(0,0,''.$row['dateAdded'],0,0,'L');
		$pdf->setX(270);$pdf->Cell(0,0,''.$status,0,0,'L');



		}
				
	
		$pdf->Ln(7);
		$pdf->setX(7);$pdf->Cell(0,0,' ',0,0,'C');
		$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
$pdf->Output();
$pdf->Output('deactivateduser.pdf', 'F');
}
			?>
