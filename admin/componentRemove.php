<?php

session_start();
require_once('../db.php');
$id=$_GET['id'];
$hid=$_GET['hid'];
echo "$id <BR> $hid";
$sql="UPDATE components SET asset_id =0,component_status=0 WHERE component_id = '$id'";
  if (mysqli_query($conn, $sql)){header("Location: hardwareDetails?hid=$hid");}
  else 
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  

?>