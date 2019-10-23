<?php
include("connection.php");
error_reporting(0);
session_start();
?>
<html>
<head>
        <title></title>
        <style>
        h1{
                text-align: center;
                color: white;
        }
        .container{
                margin-left: 15%;
                padding:30px;
        }
        body{
        background:black;
        }
        p{
                color: white;
        }
        .box{
                border-radius: 50px;
                height: 30px;
                width: 45%;
                outline-color: black;
                margin: 10px;
                background: black;
                padding: 20px;
                color: white;
        }
        #upd{
                margin:50px;
        }
        </style>
</head>
<body>
<div class="container">
        <h1>Change Account details:</h1>
        <form action="" method="GET">
            <p>Change the details you want to change</p>
<input type="password" class="box" placeholder="   Enter previous password" name="old_pass" >
<p>Enter your password:</p>
<input type="password" class="box" placeholder="   Enter new password" name="new_pass" required><br>
<input type="submit" value="UPDATE" id="upd" name="submit">
</form>
</div>
<?php
session_start();
$pass1= $_GET['old_pass'];
$pass2= $_GET['new_pass'];
if($_GET['submit'])
{
        $email=$_SESSION['email'];
        $query="SELECT * FROM users where email like '$email'";
        $data=mysqli_query($conn,$query);
$result=mysqli_fetch_assoc($data);
if($pass1==$result['pwd'])
{
        $query="UPDATE users SET pwd='$pass2' where email like '$email'";
                  $data= mysqli_query($conn,$query);
                  $data= mysqli_query($conn,$query);

                 if($data)
                 {
                        echo "updated";
                        header('location:insert.php');
                 }
                 else{
                        echo "error";
                 }
        
}
else
{
    echo "Enter valid password";
}


}

?>
</body>
</html>