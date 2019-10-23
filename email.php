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
                padding: 20px;
                background: black;
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
<p>First Name:</p>
<input type="text" class="box" placeholder="   Enter new email" name="email" >
<p>Enter your password to confirm your identity:</p>
<input type="password" class="box" placeholder="   Enter password" name="password" required><br>
<input type="submit" value="UPDATE" id="upd" name="submit">
</form>
</div>
<?php
include("connection.php");
error_reporting(0);
$email= $_GET['email'];
$pwd= $_GET['password'];
if($_GET['submit'])
{
        $query="SELECT * FROM users";
        $query1="SELECT * FROM users where fname like 'sober'";
        $data1=mysqli_query($conn,$query1);
$data= mysqli_query($conn,$query);
$result=mysqli_fetch_assoc($data1);
$result1=mysqli_fetch_assoc($data);
if($email!=$result1['email'])
{
    
        if($pwd==$result['password'])
        {
                  $query="UPDATE SONG SET email='$email' where firstname like 'sober'";
                  $data= mysqli_query($conn,$query);

                 if($data)
                 {
                        echo "updated";
                 }
                 else{
                        echo "error";
                 }
        }
        else
                echo "Please enter valid password";
}
else
{
    echo "Email already exists";
}


}

?>
</body>
</html>