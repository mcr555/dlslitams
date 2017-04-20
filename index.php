<?php
session_start();
if (isset($_SESSION["accountType"]))
{
	if($_SESSION["accountType"]=="Admin")
	{
		header("Location: admin/home");
		die();
	}
	else if($_SESSION["accountType"]=="Faculty1")
	{
		header("Location: user1/home");
		die();
	}
	else if($_SESSION["accountType"]=="Faculty2")
	{
		header("Location: user1/home");
		die();
	}
	else if($_SESSION["accountType"]=="Staff")
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