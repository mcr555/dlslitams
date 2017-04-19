<?php
require('reports/fpdf.php');
require_once('../db.php');

$gen=$_POST['ticket'];




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

if($gen=='all')
{
$sql = "SELECT *,users.lastname,users.firstname FROM ticket LEFT JOIN users ON ticket.user_id=users.idnumber ";
        $result = $conn->query($sql);

 if ($result->num_rows == 0){
		echo "<script>alert('No report found. Please try again'); location.href='../ticketRep.php';</script>";
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

            $sql = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','Report','Generate Report of $gen Request','')";
			if (mysqli_query($conn, $sql)){}
            else 
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);



		
		
		$pdf->Ln(25);
		$pdf->SetFont('arial','b',25);
		$pdf->Image("icon.png", 65,10,20);
		$pdf->setX(85);$pdf->Cell(0,0,' Dlsl IT Asset Management System',0,0,'L');
		
		$pdf->Ln(30);
		$pdf->SetFont('arial','b',20);
		$pdf->setX(120);$pdf->Cell(0,0,'Ticket Report',0,0,'L');
		$pdf->Ln(10);

		$pdf->Ln(10);



	
		//$pdf->Ln(10);
		$pdf->SetFont('arial','b',10);
		$pdf->setX(30);$pdf->Cell(0,0,'Id',0,0,'L');
		$pdf->setX(61);$pdf->Cell(0,0,'Type',0,0,'L');
		$pdf->setX(90);$pdf->Cell(0,0,'Name ',0,0,'L');
		$pdf->setX(130);$pdf->Cell(0,0,'Date Requested',0,0,'L');
		$pdf->setX(175);$pdf->Cell(0,0,'Requested for ',0,0,'L');
		$pdf->setX(210);$pdf->Cell(0,0,'Date needed',0,0,'L');
		$pdf->setX(250);$pdf->Cell(0,0,'Status',0,0,'L');




		//$pdf->Ln(6.0001);
		//$pdf->setX(20);$pdf->Cell(0,0,'Liquidating',0,0,'L');
		$pdf->Ln(3);
		$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
		while($row=$result->fetch_assoc())
		{
			 if ($row['tstatus'] == "0")
			$status = 'Pending ';
		 if ($row['tstatus'] == "1")
			$status = 'Approved ';
		if ($row['tstatus'] == "2")
			$status = 'Rejected ';

		

		
		
		$pdf->Ln(7);
		
		//$pdf->Image($row['picture'],9.5,8,13);
		
		

		$pdf->setX(30);$pdf->Cell(0,0,''.$row['ticket_id'],0,0,'L');
		$pdf->setX(60);$pdf->Cell(0,0,''.$row['ticket_type'],0,0,'L');
		$pdf->setX(90);$pdf->Cell(0,0,''.$row['firstname'].''.$row['middlename'].''.$row['lastname'],0,0,'L');
		$pdf->setX(130);$pdf->Cell(0,0,''.$row['date_requested'],0,0,'L');
		$pdf->setX(175);$pdf->Cell(0,0,''.$row['requestedFor'],0,0,'L');
		$pdf->setX(210);$pdf->Cell(0,0,''.$row['dateNeeded'],0,0,'L');
		$pdf->setX(250);$pdf->Cell(0,0,$status,0,0,'L');




		}
				
	
		$pdf->Ln(7);
		$pdf->setX(7);$pdf->Cell(0,0,' ',0,0,'C');
		$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
$pdf->Output();
$pdf->Output('Allticket.pdf', 'F');
}
else if($gen == "0")
{
	$sql = "SELECT *,users.lastname,users.firstname FROM ticket LEFT JOIN users ON ticket.user_id=users.idnumber WHERE tstatus = $gen";
        $result = $conn->query($sql);

 if ($result->num_rows == 0){
		echo "<script>alert('No report found. Please try again'); location.href='../ticketRep.php';</script>";
			exit(0);

		}
			if ($gen == "0")
			$status = 'Pending ';

			 
			  session_start();
		date_default_timezone_set("Asia/Manila"); 
                $vd=date("Y-m-d h:i:a");

		$sql1 = "select * from users where idnumber = '".$_SESSION['id']."'";
        $result1 = $conn->query($sql1);

 
 			$vn=$_SESSION["firstname"] ;
             $vn1=$_SESSION["middlename"] ;
            $vn2=$_SESSION["lastname"] ;
            $vn3=$_SESSION["accountType"] ;

            $sql = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id)VALUES ('$vn $vn1 $vn2','$vn3','$vd','Report','Generate Report of $status Request','')";
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
		$pdf->setX(120);$pdf->Cell(0,0,'Ticket Report',0,0,'L');
		$pdf->Ln(10);

		$pdf->Ln(10);



	
		
		//$pdf->Ln(10);
		$pdf->SetFont('arial','b',10);
		$pdf->setX(30);$pdf->Cell(0,0,'Id',0,0,'L');
		$pdf->setX(61);$pdf->Cell(0,0,'Type',0,0,'L');
		$pdf->setX(90);$pdf->Cell(0,0,'Name ',0,0,'L');
		$pdf->setX(130);$pdf->Cell(0,0,'Date Requested',0,0,'L');
		$pdf->setX(175);$pdf->Cell(0,0,'Requested for ',0,0,'L');
		$pdf->setX(210);$pdf->Cell(0,0,'Date needed',0,0,'L');
		$pdf->setX(250);$pdf->Cell(0,0,'Status',0,0,'L');




		//$pdf->Ln(6.0001);
		//$pdf->setX(20);$pdf->Cell(0,0,'Liquidating',0,0,'L');
		$pdf->Ln(3);
		$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
		while($row=$result->fetch_assoc())
		{
			 if ($row['tstatus'] == "0")
			$status = 'Pending ';
		 if ($row['tstatus'] == "1")
			$status = 'Approved ';
		if ($row['tstatus'] == "3")
			$status = 'Rejected ';

		

		
		
		$pdf->Ln(7);
		
		//$pdf->Image($row['picture'],9.5,8,13);
		
		

		$pdf->setX(30);$pdf->Cell(0,0,''.$row['ticket_id'],0,0,'L');
		$pdf->setX(60);$pdf->Cell(0,0,''.$row['ticket_type'],0,0,'L');
		$pdf->setX(90);$pdf->Cell(0,0,''.$row['firstname'].''.$row['middlename'].''.$row['lastname'],0,0,'L');
		$pdf->setX(130);$pdf->Cell(0,0,''.$row['date_requested'],0,0,'L');
		$pdf->setX(175);$pdf->Cell(0,0,''.$row['requestedFor'],0,0,'L');
		$pdf->setX(210);$pdf->Cell(0,0,''.$row['dateNeeded'],0,0,'L');
		$pdf->setX(250);$pdf->Cell(0,0,$status,0,0,'L');



		}
				
	
		$pdf->Ln(7);
		$pdf->setX(7);$pdf->Cell(0,0,' ',0,0,'C');
		$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
$pdf->Output();
$pdf->Output('Pending.pdf', 'F');
}
else if($gen == "1")
{
$sql="SELECT *,users.lastname,users.firstname FROM ticket LEFT JOIN users ON ticket.user_id=users.idnumber WHERE  tstatus = $gen ";
      $result = $conn->query($sql);

 if ($result->num_rows == 0){
		echo "<script>alert('No report found. Please try again'); location.href='../ticketRep.php';</script>";
			exit(0);

		}
			if ($gen == "1")
				$status = 'Approved ';

			  session_start();
		date_default_timezone_set("Asia/Manila"); 
                $vd=date("Y-m-d h:i:a");
                $sql1 = "select * from users where idnumber = '".$_SESSION['id']."'";
        $result1 = $conn->query($sql1);

 			$vn=$_SESSION["firstname"] ;
             $vn1=$_SESSION["middlename"] ;
            $vn2=$_SESSION["lastname"] ;
            $vn3=$_SESSION["accountType"] ;

$sql = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id)  VALUES ('$vn $vn1 $vn2','$vn3','$vd','Report','Generate Report of $status Request','')";
			if (mysqli_query($conn, $sql)){}
            else 
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);	
  


		
		
		
		$pdf->Ln(25);
		$pdf->SetFont('arial','b',25);
		$pdf->Image("icon.png", 65,10,20);
		$pdf->setX(85);$pdf->Cell(0,0,' Dlsl IT Asset Management System',0,0,'L');
		
		$pdf->Ln(30);
		$pdf->SetFont('arial','b',20);
		$pdf->setX(120);$pdf->Cell(0,0,'Ticket Report',0,0,'L');
		$pdf->Ln(10);

		$pdf->Ln(10);



	
		//$pdf->Ln(10);
		$pdf->SetFont('arial','b',10);
		$pdf->setX(30);$pdf->Cell(0,0,'Id',0,0,'L');
		$pdf->setX(61);$pdf->Cell(0,0,'Type',0,0,'L');
		$pdf->setX(90);$pdf->Cell(0,0,'Name ',0,0,'L');
		$pdf->setX(130);$pdf->Cell(0,0,'Date Requested',0,0,'L');
		$pdf->setX(175);$pdf->Cell(0,0,'Requested for ',0,0,'L');
		$pdf->setX(210);$pdf->Cell(0,0,'Date needed',0,0,'L');
		$pdf->setX(250);$pdf->Cell(0,0,'Status',0,0,'L');




		//$pdf->Ln(6.0001);
		//$pdf->setX(20);$pdf->Cell(0,0,'Liquidating',0,0,'L');
		$pdf->Ln(3);
		$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
		while($row=$result->fetch_assoc())
		{
			 if ($row['tstatus'] == "0")
			$status = 'Pending ';
		 if ($row['tstatus'] == "1")
			$status = 'Approved ';
		if ($row['tstatus'] == "3")
			$status = 'Rejected ';

		

		
		
		$pdf->Ln(7);
		
		//$pdf->Image($row['picture'],9.5,8,13);
		
		

		$pdf->setX(30);$pdf->Cell(0,0,''.$row['ticket_id'],0,0,'L');
		$pdf->setX(60);$pdf->Cell(0,0,''.$row['ticket_type'],0,0,'L');
		$pdf->setX(90);$pdf->Cell(0,0,''.$row['firstname'].''.$row['middlename'].''.$row['lastname'],0,0,'L');
		$pdf->setX(130);$pdf->Cell(0,0,''.$row['date_requested'],0,0,'L');
		$pdf->setX(175);$pdf->Cell(0,0,''.$row['requestedFor'],0,0,'L');
		$pdf->setX(210);$pdf->Cell(0,0,''.$row['dateNeeded'],0,0,'L');
		$pdf->setX(250);$pdf->Cell(0,0,$status,0,0,'L');




		}
				
	
		$pdf->Ln(7);
		$pdf->setX(7);$pdf->Cell(0,0,' ',0,0,'C');
		$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
$pdf->Output();
$pdf->Output('Approved.pdf', 'F');
}
else if($gen=="2")
{
$sql="SELECT *,users.lastname,users.firstname FROM ticket LEFT JOIN users ON ticket.user_id=users.idnumber where  tstatus = $gen ";
    $result = $conn->query($sql);

 if ($result->num_rows == 0){
		echo "<script>alert('No report found. Please try again'); location.href='../ticketRep.php';</script>";
				exit(0);

		}
	if ($gen == "2")
	$status = 'Rejected ';


			  session_start();
		date_default_timezone_set("Asia/Manila"); 
                $vd=date("Y-m-d h:i:a");
                $sql1 = "select * from users where idnumber = '".$_SESSION['id']."'";
        $result1 = $conn->query($sql1);


 			$vn=$_SESSION["firstname"] ;
             $vn1=$_SESSION["middlename"] ;
            $vn2=$_SESSION["lastname"] ;
            $vn3=$_SESSION["accountType"] ;

$sql = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','Report','Generate Report of $status Request','')";
			if (mysqli_query($conn, $sql)){}
            else 
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);



		
		
		$pdf->Ln(25);
		$pdf->SetFont('arial','b',25);
		$pdf->Image("icon.png", 65,10,20);
		$pdf->setX(85);$pdf->Cell(0,0,' Dlsl IT Asset Management System',0,0,'L');
		
		$pdf->Ln(30);
		$pdf->SetFont('arial','b',20);
		$pdf->setX(120);$pdf->Cell(0,0,'Ticket Report',0,0,'L');
		$pdf->Ln(10);

		$pdf->Ln(10);



	
		
		//$pdf->Ln(10);
		$pdf->SetFont('arial','b',10);
		$pdf->setX(30);$pdf->Cell(0,0,'Id',0,0,'L');
		$pdf->setX(61);$pdf->Cell(0,0,'Type',0,0,'L');
		$pdf->setX(90);$pdf->Cell(0,0,'Name ',0,0,'L');
		$pdf->setX(130);$pdf->Cell(0,0,'Date Requested',0,0,'L');
		$pdf->setX(175);$pdf->Cell(0,0,'Requested for ',0,0,'L');
		$pdf->setX(210);$pdf->Cell(0,0,'Date needed',0,0,'L');
		$pdf->setX(250);$pdf->Cell(0,0,'Status',0,0,'L');




		//$pdf->Ln(6.0001);
		//$pdf->setX(20);$pdf->Cell(0,0,'Liquidating',0,0,'L');
		$pdf->Ln(3);
		$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
		while($row=$result->fetch_assoc())
		{
			 if ($row['tstatus'] == "0")
			$status = 'Pending ';
		 if ($row['tstatus'] == "1")
			$status = 'Approved ';
		if ($row['tstatus'] == "3")
			$status = 'Rejected ';

		

		
		
		$pdf->Ln(7);
		
		//$pdf->Image($row['picture'],9.5,8,13);
		
		

		$pdf->setX(30);$pdf->Cell(0,0,''.$row['ticket_id'],0,0,'L');
		$pdf->setX(60);$pdf->Cell(0,0,''.$row['ticket_type'],0,0,'L');
		$pdf->setX(90);$pdf->Cell(0,0,''.$row['firstname'].''.$row['middlename'].''.$row['lastname'],0,0,'L');
		$pdf->setX(130);$pdf->Cell(0,0,''.$row['date_requested'],0,0,'L');
		$pdf->setX(175);$pdf->Cell(0,0,''.$row['requestedFor'],0,0,'L');
		$pdf->setX(210);$pdf->Cell(0,0,''.$row['dateNeeded'],0,0,'L');
		$pdf->setX(250);$pdf->Cell(0,0,$status,0,0,'L');




		}
				
	
		$pdf->Ln(7);
		$pdf->setX(7);$pdf->Cell(0,0,' ',0,0,'C');
		$pdf->setX(7);$pdf->Cell(0,0,'_______________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'C');
$pdf->Output();
$pdf->Output('Rejected.pdf', 'F');
}
			?>
