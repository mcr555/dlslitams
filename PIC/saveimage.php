<?php

include("../db.php");



?>
<?php
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
    $imagename=$_FILES["uploadedimage"]["name"];
    $temp_name=$_FILES["uploadedimage"]["tmp_name"];
    $imgtype=$_FILES["uploadedimage"]["type"];
    $ext= GetImageExtension($imgtype);
    // $imagename=date("d-m-Y")."-".time().$ext;
  
    


    

if (move_uploaded_file($temp_name, "../img/".$imagename)) {
 $query_upload="INSERT into images_tbl (images_path, submission_date) VALUES
('".$imagename."','".date("Y-m-d")."')";

      if (mysqli_query($conn, $query_upload)) 
      {
        
      }

      else 
      echo "Error: " . $query_upload . "<br>" . mysqli_error($conn);
      } 
   

?>
<form action="index1.php" method="post">
student id<input type="text" name="studid"><br>
<input type="submit">
</form>


<?php


}
?>