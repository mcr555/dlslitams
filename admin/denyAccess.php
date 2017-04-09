<?php
if(!isset($_SESSION['accountType']))
{
    echo 'You are not logged in';
    header( "refresh:3;url=../index" );  
    exit();
}

if($_SESSION['accountType']!="Admin")
{
    echo 'You are not an admin';
    header( "refresh:3;url=../index" );  
    exit();
}
?>