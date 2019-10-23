<?php

$hostname="localhost";
$username="root";
$password="";
$dbname="rhythm";

$conn=mysqli_connect($hostname,$username,$password,$dbname);
if(!$conn)
{
    die("Unable to connect to MySQL".mysqli_connect_error());
 }
// echo"Connected to MySql<br>";
?>