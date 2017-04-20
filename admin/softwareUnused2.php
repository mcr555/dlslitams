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
  $software_id=$_POST['software_id'];
  $asset_id=$_POST['asset_id'];
  $_SESSION['notification']=1;
  $sql="UPDATE software SET asset_id = '$asset_id' WHERE software_id = '$software_id'";
 
  
  if (mysqli_query($conn, $sql)){}
  else 
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  date_default_timezone_set("Asia/Manila"); 
                $vd=date("Y-m-d h:i:a");
                $sql= "SELECT software.asset_id,software.name as sname,serial,hardware.name as hname FROM software LEFT JOIN hardware ON hardware.asset_id=software.asset_id WHERE software_id = '$software_id'";
            $result = $conn->query($sql);
                $row = $result->fetch_array(MYSQLI_ASSOC);
                 $sql1 = "select * from users where idnumber = '".$_SESSION['id']."'"; 
           $result = $conn->query($sql1);

             $vn=$_SESSION["firstname"] ;
             $vn1=$_SESSION["middlename"] ;
            $vn2=$_SESSION["lastname"] ;
            $vn3=$_SESSION["accountType"] ;
            $vn5=$row["sname"];
            $vn6=$row["hname"];
            $vn7=$row["serial"];
           

            $sql3 = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time,category, Log_Function,id) VALUES ('$vn $vn1 $vn2','$vn3','$vd','Software','use $vn5 to $vn6','$vn7')";

            if (mysqli_query($conn, $sql3)){}
            else 
            echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);
  exit();

}
?>
<form method='post' action='softwareUnused2'>
<?php
$software_id=$_GET['sid'];
echo "Save software to: ";
$sql = "SELECT * FROM hardware WHERE asset_type=2";
$result = $conn->query($sql);
if ($result->num_rows > 0)
{
    $select= '<select name="asset_id">';
    while($row = $result->fetch_assoc()) 
        $select.='<option value="'.$row['asset_id'].'">'.$row['name'].'</option>';
}
$select.='</select>';
echo $select;
?>
<input type='hidden' name='software_id' value="<?php echo $software_id;?>">
<input type='submit' value='Submit' name='submit'>
</form>
