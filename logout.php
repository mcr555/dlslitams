<?php
  require_once('db.php');
session_start();
 date_default_timezone_set("Asia/Manila"); 
                $vd=date("Y-m-d h:i:a");
                $sql1 = "select * from users where idnumber = '".$_SESSION['idnumber']."'"; 
                 $result = $conn->query($sql1);

            $vn=$_SESSION["firstname"] ;
             $vn1=$_SESSION["middlename"] ;
            $vn2=$_SESSION["lastname"] ;
            $vn3=$_SESSION["accountType"] ;
           

            $sql3 = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','User','Log out','".$_SESSION['idnumber']."')";

            if (mysqli_query($conn, $sql3)){}
            else 
            echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);

session_destroy();
header("Location: login");
?> 
