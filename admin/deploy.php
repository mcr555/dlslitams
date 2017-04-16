<script>
    window.onunload = refreshParent;
    function refreshParent() {
        window.opener.location.reload();
        window.close();
    }
</script>

<?php
session_start();
require_once('../db.php');
if (isset($_POST['submit']))
{
  $idnumber=$_POST['custodian'];
  $location=$_POST['location'];
  $asset_id=$_POST['asset_id'];

  $sql="UPDATE hardware SET location = '$location',status=1,custodian='$idnumber' WHERE asset_id = '$asset_id'";
  if (mysqli_query($conn, $sql)){$_SESSION['notification']=1;}
  else 
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  date_default_timezone_set("Asia/Manila");
        $vd=date("Y-m-d h:i:a");

        $sql2 ="SELECT *,users.firstname,users.lastname FROM hardware LEFT JOIN users ON users.idnumber=hardware.custodian WHERE asset_id ='$asset_id'"; 
        $result1 = $conn->query($sql2);
        $row = $result1->fetch_array(MYSQLI_ASSOC);
        $sql1 = "select * from users where idnumber = '".$_SESSION['id']."'"; 
        $result = $conn->query($sql1);

        $vn=$_SESSION["firstname"] ;
        $vn1=$_SESSION["middlename"] ;
        $vn2=$_SESSION["lastname"] ;
        $vn3=$_SESSION["accountType"];
        $vn4=$row["barcode"];
        $vn5=$row["name"];
        $vn6=$row["firstname"];
        $vn7=$row["middlename"];
        $vn8=$row["lastname"];


        $sql3 = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','Hardware','deploy $vn5 to $location custody of $vn6 $vn7 $vn8','$vn4')";
        if (mysqli_query($conn, $sql3)){}
        else echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  
  exit();

}

if (isset($_POST['submit2']))
{
  if(isset($_POST['checkbox']))
  {
    
    foreach ($_POST["checkbox"] as $id)
    {
      $idnumber=$_POST['custodian'];
      $location=$_POST['location'];
      $asset_id=$_POST['asset_id'];
      $sql="UPDATE hardware SET location = '$location',status=1,custodian='$idnumber' WHERE asset_id = '$id'";
      if (mysqli_query($conn, $sql)){$_SESSION['notification']=1;}
      else
      {
        $_SESSION['notification']=2;
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        echo "<script>window.close();</script>";
      }
      date_default_timezone_set("Asia/Manila");
        $vd=date("Y-m-d h:i:a");

        $sql2 ="SELECT *,users.firstname,users.lastname FROM hardware LEFT JOIN users ON users.idnumber=hardware.custodian WHERE asset_id ='$asset_id'"; 
        $result1 = $conn->query($sql2);
        $row = $result1->fetch_array(MYSQLI_ASSOC);
        $sql1 = "select * from users where idnumber = '".$_SESSION['id']."'"; 
        $result = $conn->query($sql1);

        $vn=$_SESSION["firstname"] ;
        $vn1=$_SESSION["middlename"] ;
        $vn2=$_SESSION["lastname"] ;
        $vn3=$_SESSION["accountType"];
        $vn4=$row["barcode"];
        $vn5=$row["name"];
        $vn6=$row["firstname"];
        $vn7=$row["middlename"];
        $vn8=$row["lastname"];


        $sql3 = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','Hardware','deploy $vn5 to $location custody of $vn6 $vn7 $vn8','$vn4')";
        if (mysqli_query($conn, $sql3)){}
        else echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  
    }
    
  }
  
  exit();
} 
  



?>

<?php

if(isset($_POST['deploy']))
{
echo "<form method='post' action=''>";
echo "Transfer asset to: ";
  $sql = "SELECT * FROM dropdown_list WHERE dropdown_type='3' ";
  $result = $conn->query($sql);
  if ($result->num_rows > 0)
  {
      $select= '<select name="location">';
      while($row = $result->fetch_assoc()) 
          $select.='<option value="'.$row['dropdown_name'].'">'.$row['dropdown_name']  .'</option>';
  }
  $select.='</select>';
  echo $select;
echo "<BR>Custodian: ";
$sql = "SELECT * FROM users WHERE userStatus='0' ";
$result = $conn->query($sql);
if ($result->num_rows > 0)
{
    $select= '<select name="custodian">';
    while($row = $result->fetch_assoc()) 
        $select.='<option value="'.$row['idnumber'].'">'.$row['firstname'] .' ' .$row['lastname'] .'</option>';
}
$select.='</select>';
echo $select;

if(isset($_POST['checkbox']))
{
  foreach ($_POST["checkbox"] as $id)
  {
    echo "<input type='hidden' name='checkbox[]' value='$id'>";
  }
}
else echo "<script>window.close();</script>";
echo "<BR><input type='submit' value='Submit' name='submit2'></form>";
exit();
}
else
{
  $asset_id=$_GET['hid'];
  echo "<form method='post' action='deploy'>";
  echo "Transfer to: ";
  echo "<input type='hidden' name='asset_id' value='$asset_id'>";
  echo "<BR>Location: ";
  $sql = "SELECT * FROM dropdown_list WHERE dropdown_type='3' ";
  $result = $conn->query($sql);
  if ($result->num_rows > 0)
  {
      $select= '<select name="location">';
      while($row = $result->fetch_assoc()) 
          $select.='<option value="'.$row['dropdown_name'].'">'.$row['dropdown_name']  .'</option>';
  }
  $select.='</select>';
  echo $select;

  echo "<BR>Custodian: ";
  $sql = "SELECT * FROM users WHERE userStatus='0' ";
  $result = $conn->query($sql);
  if ($result->num_rows > 0)
  {
      $select= '<select name="custodian">';
      while($row = $result->fetch_assoc()) 
          $select.='<option value="'.$row['idnumber'].'">'.$row['firstname'] .' ' .$row['lastname'] .'</option>';
  }
  $select.='</select>';
  echo $select;
  echo "<BR><input type='submit' value='Submit' name='submit'>";
  echo "</form>";

}