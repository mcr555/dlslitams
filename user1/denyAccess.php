<?php
if(!isset($_SESSION['accountType']))
{
    echo 'You are not logged in';
    header( "refresh:3;url=../index" );  
    exit();
}
$accountType=$_SESSION['accountType'];
if($accountType=="Faculty1"||$accountType=="Faculty2"||$accountType=="Staff")
{}
else
{echo 'You are not a Regular Employee';
header( "refresh:3;url=../index" );  }
?>