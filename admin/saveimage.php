<?php

include("../db.php");



?>
<?php
<<<<<<< HEAD
  session_start();
=======
session_start();
>>>>>>> origin/master
    function GetImageExtension($imagetype)
    {

       if(empty($imagetype)) return false;
       switch($imagetype)
       {
           case 'image/bmp': return '.bmp';
           case 'image/gif': return '.gif';
           case 'image/jpeg': return '.jpg';
           case 'image/png': return '.png';
           default: return false;

       }
 

     }

if (!empty($_FILES["uploadedimage"]["name"])) {
    $date = new DateTime();
    $x= $date->format('U');
    $imagename=$x.$_FILES["uploadedimage"]["name"];

    $temp_name=$_FILES["uploadedimage"]["tmp_name"];
    $imgtype=$_FILES["uploadedimage"]["type"];
    $ext= GetImageExtension($imgtype);
    // $imagename=date("d-m-Y")."-".time().$ext;
  
    

if (move_uploaded_file($temp_name, "../img/".$imagename)) {
 $query_upload="UPDATE users Set imagepath = '$imagename' where idnumber = '".$_SESSION['id']."' ";
    


      if (mysqli_query($conn, $query_upload)) 
      {
        header("Location: profile1");
      }

      else 
      echo "Error: " . $query_upload . "<br>" . mysqli_error($conn);
      } 
   }

?>





