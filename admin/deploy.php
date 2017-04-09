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
  if (mysqli_query($conn, $sql)){}
  else 
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  $_SESSION['notification']=1;
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
      if (mysqli_query($conn, $sql)){}
      else echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    $_SESSION['notification']=1;
  }
  header("Location: assetsDeployed"); 
  exit();
} 
  



?>

<?php

if(isset($_POST['deploy']))
{
echo "<form method='post' action=''>";
echo "Transfer asset to: ";
echo "<input type='text' required name='location'>";
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
else header('Location: ' . $_SERVER['HTTP_REFERER']);
echo "<BR><input type='submit' value='Submit' name='submit2'></form>";
exit();
}
else
{
  $asset_id=$_GET['hid'];
  echo "<form method='post' action='deploy'>";
  echo "Transfer to: ";
  echo "<input type='hidden' name='asset_id' value='$asset_id'>";
  echo "<input type='text' required name='location'>";
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