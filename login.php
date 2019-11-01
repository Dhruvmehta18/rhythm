<?php
include("connection.php");
error_reporting(0);
session_start();
$em=$_POST['email'];
$result=mysqli_query($GLOBALS['conn'],"SELECT * FROM users where email = '$em'");
$row=mysqli_num_rows($result);
 $_SESSION['logged_in']=0;
if($row==0){
    echo "User does not exist.";
    header("location: index.php");
}
else{
    $user=mysqli_fetch_assoc($result);
    if(strcmp($_POST['pwd'],$user['pwd'])==0){
        $_SESSION['email']=$_POST['email'];
        $_SESSION['fname']=$_POST['fname'];
        $_SESSION['lname']=$_POST['lname'];
        $_SESSION['pwd']=$_POST['pwd'];
        $_SESSION['logged_in']=1;

        $_SESSION['logged_in']=true;
        header("location: main.php");
    }
    else{
        echo "You have entered wrong password, try again!";
        header("location: index.php");
    }
}