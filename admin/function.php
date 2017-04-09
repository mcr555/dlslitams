<?php

function deleteSerial($conn,$id){
	session_start();
	$sql = "DELETE FROM software WHERE software_id=$id";
	if (mysqli_query($conn, $sql)){$_SESSION['notification']=1;}
	else echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>