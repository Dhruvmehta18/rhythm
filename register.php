<?php
include("connection.php");
error_reporting(0);

$_SESSION['email']=$_POST['email'];
$_SESSION['fname']=$_POST['fname'];
$_SESSION['lname']=$_POST['lname'];
$_SESSION['pwd']=$_POST['pwd'];

$fn=$_POST['fname'];
$ln=$_POST['lname'];
$em=$_POST['email'];
$pw=$_POST['pwd'];

$result=mysqli_query($GLOBALS['conn'],"SELECT * FROM users where email like '$em'");
$row=mysqli_num_rows($result);
if($row>0){
    header("location: index.php");
    echo "User with this email id already exists";
}
else{
    $query="INSERT INTO users values('$fn','$ln','$em','$pw')";
    $rs=mysqli_query($conn,$query);

     $_SESSION['logged_in']=true;
    
    console.log("You've successfully registered now");
    header("location: insert.php");
}
?>