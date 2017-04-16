<?php
session_start();
include_once('denyAccess.php');
require_once('../db.php');
if(isset($_GET['id']))
{
  $id=$_GET['id'];
  $sql = "DELETE FROM software WHERE software_id=$id";
  
	
  if (mysqli_query($conn, $sql)){$_SESSION['notification']=1;}
  else echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  date_default_timezone_set("Asia/Manila"); 
                $vd=date("Y-m-d h:i:a");
                $sql2 ="select * from software WHERE software_id=$id"; 
                $result1 = $conn->query($sql2);
                $row = $result1->fetch_array(MYSQLI_ASSOC);
                 $sql1 = "select * from users where idnumber = '".$_SESSION['id']."'"; 
           $result = $conn->query($sql1);

             $vn=$_SESSION["firstname"] ;
             $vn1=$_SESSION["middlename"] ;
            $vn2=$_SESSION["lastname"] ;
            $vn3=$_SESSION["accountType"] ;
            $vn4=$id;
            $vn5=$row["name"];
           

            $sql3 = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','Software','add a $vn5','$vn4')";

            if (mysqli_query($conn, $sql3)){}
            else 
            echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);
}
?>