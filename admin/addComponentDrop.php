<?php
session_start();
require_once('../db.php');
if (isset($_POST['submit']))
{
  $category=$_POST['category'];
  $type=$_POST['type'];

  $sql = "SELECT * FROM dropdown_list WHERE dropdown_name='$category' AND dropdown_type='$type'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0)
  {
    while($row = $result->fetch_assoc()) 
    {
      echo "Record already exist<BR>";
      $_SESSION['notification']=2;
      exit();
    }
  } 
  else
  {
    $sql = "INSERT INTO dropdown_list (dropdown_name,dropdown_type)
    VALUES ('$category','$type')";
  
    if (mysqli_query($conn, $sql)){}
    else
    { 
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      exit();
    }
    $_SESSION['notification']=1;
     date_default_timezone_set("Asia/Manila"); 
                $vd=date("Y-m-d h:i:a");
                $sql2 ="select * from components ORDER BY component_id DESC LIMIT 1"; 
                $result1 = $conn->query($sql2);
                $row = $result1->fetch_array(MYSQLI_ASSOC);
                $sql1 = "select * from users where idnumber = '".$_SESSION['idnumber']."'"; 
        $result = $conn->query($sql1);

            $vn=$_SESSION["firstname"] ;
             $vn1=$_SESSION["middlename"] ;
            $vn2=$_SESSION["lastname"] ;
            $vn3=$_SESSION["accountType"] ;
            $vn4=$row["component_id"];
            $vn6=$vn4+1;
            $vn5=$category;
           

            $sql3 = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','Category','add component $vn5','$vn6')";

            if (mysqli_query($conn, $sql3)){}
            else 
            echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);
    echo '<script>window.close();</script>';
    exit();
  }
}
  echo "<form method='post' action=''>";
  echo 'Add Hardware Category: ';
  echo "<input type='hidden' name='type' value='2'>";
  echo "<input type='text' required name='category'>";
  
  echo "<BR><input type='submit' value='Submit' name='submit'>";
  echo "</form>";