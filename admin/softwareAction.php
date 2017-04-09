<?php
session_start();
require_once('../db.php');

if(isset($_POST['delete']))
{
	if(isset($_POST['checkbox']))
	{
		foreach ($_POST["checkbox"] as $id)
		{
			$sql = "DELETE FROM software WHERE software_id='$id'";
			if (mysqli_query($conn, $sql)){}
			    	else 
				    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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
            

                  $sql3 = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time, Log_Function) VALUES ('$vn $vn1 $vn2','$vn3','$vd','deleted a software($id)')";

            if (mysqli_query($conn, $sql3)){}
            else 
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	$_SESSION['notification']=1;
	}
	$link=$_POST['link'];
	header("Location: $link"); 
	exit();
}

if(isset($_POST['use']))
{

echo "<form method='post' action='softwareAction'>";
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

if(isset($_POST['checkbox']))
{
  foreach ($_POST["checkbox"] as $id)
  {
    echo "<input type='hidden' name='checkbox[]' value='$id'>";
  }
}
echo "<input type='submit' value='Submit' name='use2'></form>";
exit();
}

if (isset($_POST['use2']))
{
	$asset_id=$_POST['asset_id'];
	if(isset($_POST['checkbox']))
	{
		foreach ($_POST["checkbox"] as $id)
	    {
	    	$sql="UPDATE software SET asset_id = '$asset_id' WHERE software_id = '$id'";
	    	if (mysqli_query($conn, $sql)){}
	    	else echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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
            

                  $sql3 = "INSERT INTO tbl_log(Log_Name, Log_LOP, Log_Date_Time, Log_Function) VALUES ('$vn $vn1 $vn2','$vn3','$vd','used a software($id)')";
                  if (mysqli_query($conn, $sql3)){}
            else 
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
$_SESSION['notification']=1;
header("Location: freewareUnused"); 
exit();
}
