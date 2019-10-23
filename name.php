<?php
include("connection.php");
session_start();
error_reporting(0);
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
                padding: 20px;
                background:black;
                color:white;
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
<p>First Name:</p>
<input type="text" class="box" placeholder="   Enter new first name" name="firstname" >
<p>Last Name:</p>
<input type="text" class="box" placeholder="   Enter new last name" name="lastname">
<p>Enter your password to confirm your identity:</p>
<input type="password" class="box" placeholder="   Enter password" name="password" required><br>
<input type="submit" value="UPDATE" id="upd" name="submit">
</form>
</div>
<?php
session_start();
$fname= $_GET['firstname'];
$lname= $_GET['lastname'];
$pwd= $_GET['password'];
if($_GET['submit'])
{
        $email=$_SESSION['email'];
        $query="SELECT * FROM users where email like '$email'";
$data= mysqli_query($conn,$query);
$result=mysqli_fetch_assoc($data);
        if($pwd==$result['pwd'])
        {
                  $query="UPDATE users SET fname='$fname',lname='$lname' where email like '$email'";
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
                echo "Please enter valid password";

}

?>
</body>
</html>



