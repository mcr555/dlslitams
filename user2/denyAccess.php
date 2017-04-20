<?php
if(!isset($_SESSION['accountType']))
{
    echo 'You are not logged in';
    header( "refresh:3;url=../index" );  
    exit();
}

if($_SESSION['accountType']=="Faculty1" ||$_SESSION['accountType']=="Faculty2" || $_SESSION['accountType']=="Staff" ||$_SESSION['accountType']=="Admin" )
{
    echo 'You are not allowed to access this module';
    header( "refresh:3;url=../index" );  
    exit();
}
?>