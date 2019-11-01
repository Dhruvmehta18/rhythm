<?php
include("connection.php");
error_reporting(0);
?>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
        h1{
                text-align: center;
                color: purple;
        }
        .container{
                margin-left: 20%;
                padding:30px;  
            margin-top:7%;
            width: 60%;
            height: 62%;
            background: white;
            border-radius: 30px;
        }
        body{
   background: -webkit-linear-gradient(left, #020202, #535353);

        }
        .box{
                border-radius: 50px;
                height: 30px;
                width: 40%;
                outline:none;
                margin: 15px;
                padding: 20px;
                background:#5500ff;
                color:white;
        }
        #upd{
                margin-left:30%;
                border: none;
                height: 40px;
                border-radius: 1.5rem;
                width:120px;
                background: #6c757d;
        }
        h3,h5{
            color: purple;
        }
        .divider{
            display: flex;
        }
        input::placeholder {
  color: #fff;
}

        .upper1{
            width:120%;
        }
        .upper{
            width:90%;
        }
        </style>
</head>
<body>
<div class="container">
        <h1>Change Account details:</h1>
        <form action="" method="GET">
            <h3>Change the details you want to change</h3>
<div class="divider">
    <div class="fname">
    <h5 style="margin-left:35px;">First Name:</h5>
<input type="text" class="box upper1" placeholder="   Enter new first name" name="firstname" ></div><div class="lname">
<h5 style="margin-left:120px;">Last Name:</h5>
<input type="text" class="box upper" style="margin-left:100px;" placeholder="   Enter new last name" name="lastname">
</div></div>
<h5>Enter your password to confirm your identity:</h5>
<input type="password" style="width:50%;" class="box" placeholder="   Enter password" name="password" required><br>
<input type="submit" value="UPDATE" id="upd" name="submit">
</form>
</div>
<?php
include("connection.php");
error_reporting(0);
session_start();
$fname= $_GET['firstname'];
$lname= $_GET['lastname'];
$pwd= $_GET['password'];
$email=$_SESSION['email'];
if($_GET['submit'])
{
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
                        header('location:setting.php');
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