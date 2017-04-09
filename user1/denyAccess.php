<?php
if(!isset($_SESSION['accountType']))
{
    echo 'You are not logged in';
    header( "refresh:3;url=../index" );  
    exit();
}

if($_SESSION['accountType']!="Regular Employee")
{
    echo 'You are not logged in';
    header( "refresh:3;url=../index" );  
    exit();
}
?>