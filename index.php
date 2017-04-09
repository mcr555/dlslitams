<?php
session_start();
if (isset($_SESSION["accountType"]))
{
	if($_SESSION["accountType"]=="Admin")
	{
		header("Location: admin/home");
		die();
	}
	else if($_SESSION["accountType"]=="Regular Employee")
	{
		header("Location: user1/home");
		die();
	}
    else{
        header("Location: user2/home");
        die();}
}
else
{
	header("Location: login");
	die();
}

?> 