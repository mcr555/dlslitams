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

if($_GET['accept']==0)
{
	$ticket_id=$_GET['id'];
	$user_id=$_SESSION["idnumber"];

	$sql="UPDATE ticket_view SET tistatus = '2' WHERE ticket_id = '$ticket_id' AND tuser_id = '$user_id'";
	if (mysqli_query($conn, $sql)){}
	else echo "Error: " . $sql . "<br>" . mysqli_error($conn);

	$sql="UPDATE ticket SET tstatus = '2' WHERE ticket_id = '$ticket_id'";
	if (mysqli_query($conn, $sql)){}
	else echo "Error: " . $sql . "<br>" . mysqli_error($conn);

	echo "<script>window.close();</script>";

}

else if($_GET['accept']==1)
{
	$step=$_GET['step'];
	$department=$_GET['department'];
	$ticket_id=$_GET['id'];
	$user_id=$_SESSION["idnumber"];
	$idnumber='';
	if($step==1) $next='ICT Manager';
	if($step==2) $next='ICT Staff';
	if($step==3) $next='Admin';

	if (isset($next)){
	$sql = "SELECT * FROM users WHERE accountType='$next'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
      while($row = $result->fetch_assoc()) 
      {
      	$idnumber=$row['idnumber'];
      }
  	}
  	else
  	{
  		echo 'Next Department unavailable';
  		exit();
  	}
  }
  	$step=$step+1;

	$sql="UPDATE ticket_view SET tistatus = '1' WHERE ticket_id = '$ticket_id' AND tuser_id = '$user_id'";
	if (mysqli_query($conn, $sql)){}
	else echo "Error: " . $sql . "<br>" . mysqli_error($conn);

	if($step!=5)
	{
	$sql = "INSERT INTO ticket_view (position,step,tistatus,ticket_id,tuser_id)
        VALUES ('$next','$step',0,'$ticket_id',$idnumber)";
    if (mysqli_query($conn, $sql)){}
    else echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
	}
	if($step==5)
	{
		$sql="UPDATE ticket SET tstatus = '1' WHERE ticket_id = '$ticket_id'";
	if (mysqli_query($conn, $sql)){}
	else echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	echo "<script>window.close();</script>";
}
?>