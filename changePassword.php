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
                color: white;
        }
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
    background: -webkit-linear-gradient(left, #3931af, #bb99ff);

        }
        input::placeholder {
  color: #fff;
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
                margin-left:34%;
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
        </style>
</head>
<body>
<div class="container">
        <h1 >Change Password:</h1>
        <form action="" method="GET">
            <h3>Old Password:</h3>
<input type="password" class="box" placeholder="   Enter previous password" name="old_pass" >
<div class="divider">
    <div class="fname">
<h3>Enter your password:</h3>
<input type="password" class="box" style="width:110%;" placeholder="   Enter new password" name="new_pass" required></div>
<div class="lname">
<h3 style="margin-left:110px;">Re-enter new password:</h3>
<input type="password" class="box" style="width:70%; margin-left:110px;" placeholder="   Enter new password" name="new_pass1" required><br>
</div></div>
<input type="submit" value="UPDATE" id="upd" name="submit">
</div></form>
<?php
include("connection.php");
error_reporting(0);
session_start();
$email=$_SESSION['email'];
$pass1= $_GET['old_pass'];
$pass2= $_GET['new_pass'];
$confirmpass= $_GET['new_pass1'];
if($_GET['submit'])
{
        $query="SELECT * FROM users where email like '$email'";
        $data=mysqli_query($conn,$query);
$result=mysqli_fetch_assoc($data);
if($pass1==$result['pwd'] && $pass2==$confirmpass)
{
                  $query="UPDATE users SET pwd='$pass2' where email like '$email'";
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
{
    echo "Enter valid password";
}


}

?>
</body>
</html>