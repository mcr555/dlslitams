<?php
$con = mysql_connect("localhost","root","");
$con = mysql_connect();
	if (!$con)
	{
	  	die('Could not connect: ' . mysql_error());
  	}
	mysql_select_db("itams", $con);
?>