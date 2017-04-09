<?php
session_start();
include_once('denyAccess.php');
require_once('../db.php');
if(isset($_GET['id']))
{
  $id=$_GET['id'];
  $sql = "DELETE FROM software WHERE software_id=$id";
  date_default_timezone_set("Asia/Manila"); 
                $vd=date("Y-m-d h:i:a");
                $sql2 ="select * from software ORDER BY $id DESC LIMIT 1"; 
                $result1 = $conn->query($sql2);

                 $sql1 = "select * from users where idnumber = '".$_SESSION['id']."'"; 
           $result = $conn->query($sql1);

            $vn=$_SESSION["firstname"] ;
             $vn1=$_SESSION["middlename"] ;	
            $vn2=$_SESSION["lastname"] ;
            $vn3=$_SESSION["accountType"] ;
            $vn4=$row["asset_id"];
            

                  $sql3 = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time, Log_Function) VALUES ('$vn $vn1 $vn2','$vn3','$vd','deleted a freeware($id)')";

            if (mysqli_query($conn, $sql3)){}
            else 
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	
  if (mysqli_query($conn, $sql)){$_SESSION['notification']=1;}
  else echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>