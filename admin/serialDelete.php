<script>
    window.onunload = refreshParent;
    function refreshParent() {
        window.opener.location.reload();
        window.close();
    }
</script>
<?php
session_start();
include_once('denyAccess.php');
require_once('../db.php');
if(isset($_GET['id']))
{
  $id=$_GET['id'];
  $sql="UPDATE software SET asset_id = 0 WHERE software_id = '$id'";
 
  if (mysqli_query($conn, $sql)){$_SESSION['notification']=1;}
  else echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  echo "<script>window.close();</script>";
}
?>