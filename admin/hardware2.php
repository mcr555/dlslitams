<?php
session_start();
require_once('../db.php');


if(isset($_POST['donate']))
{
echo "<form method='post' action='hardware2'>";
echo "Donate Asset to: ";
echo "<input type='text' required name='location'>";

if(isset($_POST['checkbox']))
{
  foreach ($_POST["checkbox"] as $id)
  {
    echo "<input type='hidden' name='checkbox[]' value='$id'>";
  }
}
else header('Location: ' . $_SERVER['HTTP_REFERER']);
echo "<input type='submit' value='Submit' name='donate2'></form>";
exit();
}


if(isset($_POST['donate2']))
{
	if(isset($_POST['checkbox']))
	{
		foreach ($_POST["checkbox"] as $id)
		{
			$location=$_POST['location'];
			echo $location;
			$sql = "SELECT * FROM hardware WHERE asset_id='$id'";
			$result = $conn->query($sql);

			
			if ($result->num_rows > 0)
			{
				while($row = $result->fetch_assoc()) 
			    {
			    	$name=$row['name'];
			    	$vn4=$row["barcode"];


			    	$sql2 = "INSERT INTO donated_assets (dasset_id,name,location)
			    	VALUES ($id,'$name','$location')";
			    	mysqli_query($conn, $sql2);


			    	$sql2 = "DELETE FROM hardware WHERE asset_id ='$id'";
			    	mysqli_query($conn, $sql2);

			    	


			    }
			 	$_SESSION['notification']=1;

			 	date_default_timezone_set("Asia/Manila"); 
                $vd=date("Y-m-d h:i:a");
                 $sql1 = "select * from users where idnumber = '".$_SESSION['id']."'"; 
                $result1 = $conn->query($sql1);
                $sql3 ="select * from donated_assets ORDER BY donated_id DESC LIMIT 1"; 
                $result1 = $conn->query($sql3);
                $row = $result1->fetch_array(MYSQLI_ASSOC);

                


            $vn=$_SESSION["firstname"] ;
             $vn1=$_SESSION["middlename"] ;
            $vn2=$_SESSION["lastname"] ;
            $vn3=$_SESSION["accountType"] ;
            $vn5=$row["location"];

            
           

            $sql3 = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','Hardware','donate $name to $vn5','$vn4')";

            if (mysqli_query($conn, $sql3)){}
            else 
            echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);
			 	
			}
		} 
	}
	header("Location: hardware"); 
	exit();
}

if(isset($_POST['retire']))
{
	if(isset($_POST['checkbox']))
	{
		foreach ($_POST["checkbox"] as $id)
		{
			$sql = "SELECT * FROM hardware WHERE asset_id='$id'";
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0)
			{
				while($row = $result->fetch_assoc()) 
			    {
			    	$sql="UPDATE hardware SET status = '2',book_value='0' WHERE asset_id = '$id'";
			    	if (mysqli_query($conn, $sql)){}
			    	else 
				    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				date_default_timezone_set("Asia/Manila"); 
                $vd=date("Y-m-d h:i:a");
                 $sql1 = "select * from users where idnumber = '".$_SESSION['id']."'"; 
                $result1 = $conn->query($sql1);


            $vn=$_SESSION["firstname"] ;
             $vn1=$_SESSION["middlename"] ;
            $vn2=$_SESSION["lastname"] ;
            $vn3=$_SESSION["accountType"] ;
            $vn4=$row["barcode"];
            $vn5=$row["name"];

            
           

            $sql3 = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','Hardware','retired a $vn5','$vn4')";

            if (mysqli_query($conn, $sql3)){}
            else 
            echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);

				  

			    }
			    $_SESSION['notification']=1;
			  
			}
		}
	}
	header("Location: hardware"); 
	exit();
}

if(isset($_POST['decommission']))
{
	if(isset($_POST['checkbox']))
	{
		foreach ($_POST["checkbox"] as $id)
		{
			$sql = "SELECT * FROM hardware WHERE asset_id='$id'";
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0)
			{
				while($row = $result->fetch_assoc()) 
			    {
			    	$sql="UPDATE hardware SET status = '3',book_value='1',location='warehouse' WHERE asset_id = '$id'";
			    	if (mysqli_query($conn, $sql)){}
			    	else 
				    echo "Error: " . $sql . "<br>" . mysqli_error($conn);

								date_default_timezone_set("Asia/Manila"); 
                $vd=date("Y-m-d h:i:a");
                 $sql1 = "select * from users where idnumber = '".$_SESSION['id']."'"; 
                $result1 = $conn->query($sql1);


            $vn=$_SESSION["firstname"] ;
             $vn1=$_SESSION["middlename"] ;
            $vn2=$_SESSION["lastname"] ;
            $vn3=$_SESSION["accountType"] ;
            $vn4=$row["barcode"];
            $vn5=$row["name"];

            
           

            $sql3 = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','Hardware','decommission a $vn5','$vn4')";

            if (mysqli_query($conn, $sql3)){}
            else 
            echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);
				  

			    }
			    $_SESSION['notification']=1;
			   

			}
		}
	}
	header("Location: hardware"); 
	exit();
}

?>