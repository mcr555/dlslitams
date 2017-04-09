<?php
require_once('db.php');

if (isset($_POST['change']))
{
	$email=$_POST['email'];
	$newPassword=$_POST["newPassword"];
	$retypePassword=$_POST["retypePassword"];

	$sql = "SELECT * FROM users WHERE email='$email'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		if($retypePassword!=$newPassword) {echo "Retype and New Password does not match<input type='button' onclick='history.go(-1); 'value='Back'>";}
	    else
	    {
	      $newPass=md5($newPassword);
	      $sql="UPDATE users SET password = '$newPass' WHERE email = '$email'";
	      if (mysqli_query($conn, $sql)) 
	      {
	      	$sql="DELETE FROM changepassword WHERE email = '$email'";
	      	mysqli_query($conn, $sql);
	        echo "Successfully Changed Password. You will be redirected in 3 Seconds";
	        header( "refresh:3;url=login" );  
	        exit();
	      }

	      else 
	      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	      exit();
	    }
	}


}

if (isset($_GET['code']))
{
	$code=$_GET['code'];	
	$sql = "SELECT * FROM changepassword WHERE code='$code'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
      while($row = $result->fetch_assoc()) 
      {
      	$email=$row["email"];
      	?>
		<form method='POST' action='changePassword'>
		<label>New Password:</label><input type="password" required name="newPassword" ><br><br>
		<label>Retype Password:</label><input type="password" required name="retypePassword" ><br><br>
		<input type='hidden' value='<?php echo $email;?>' name='email'>
		<input type="submit" name="change"  value="Change Password">
      	<?php
      }
  	}
  else echo "No records found";
}
?>