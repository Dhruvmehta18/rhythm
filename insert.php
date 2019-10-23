<html>
<head>
	<title>Account</title>
        <style>
        body {
  font-family: Arial;
  color: white;
      background: url('map.jpg');

}

.user {
  padding-left: 100px;
  background: black;
  width: 60%;
  height:80%;
  padding-top: 1px;
  padding-bottom: 10px;
  margin-top: 5%;
  margin-left: 20%;
  background:rgba(0,0,0,0.8); 
}


.user .field {
  margin: 15px;
}


.user .name {
  margin: 20px;
  color: white;
  margin-left: 25%;
}

.user .last-name {
  color: white;
  margin-left: 15%;
 
}

.user .box {
  height: 40px;
  width: 45%;
  border-radius: 10px;
  color: white;
  border-color: #999292;
  background: black;
  margin: 15px;
  margin-left: 25%;
}

.user .name-box {
  width: 20%;
}

.user .pos {
  margin-left: 5px;
}
.user .email{
	width:30px;
}
a{
  text-decoration: none;
  color: white;
}
h1{
  padding-left: 30%;
  margin-top: 10%;
}
        </style>
</head>
<body>
<div class="user">
        <h1>Account Info</h1>
<form action="" method=""> 
        <label class="name" for="firstname">First Name:</label>
        <label class="last-name" for="lastname">Last Name:</label><br>
        <input class="box name-box" type="text" name="firstname" 
        value=" <?php
include("connection.php");
error_reporting(0);
session_start();
$email=$_SESSION['email'];
$query="SELECT fname FROM users where email like '$email'";
$data= mysqli_query($conn,$query);
$result=mysqli_fetch_assoc($data);
$total= mysqli_num_rows($data);
echo $result['fname'];
?>"id="firstname">
        <input class="pos box name-box" type="text" name="lastname" id="lastname" value=" <?php
$email=$_SESSION['email'];
$query="SELECT lname FROM users where email like '$email'";
$data= mysqli_query($conn,$query);
$result=mysqli_fetch_assoc($data);
$total= mysqli_num_rows($data);
echo $result['lname'];
?>">
<a href="name.php">Edit</a>
<br>
        <label class="name" for="email">Email:</label><br>
        <input class="box" type="text" name="email" id="email" value=" <?php
$email=$_SESSION['email'];
$query="SELECT email FROM users where email like '$email'";
$data= mysqli_query($conn,$query);
$result=mysqli_fetch_assoc($data);
$total= mysqli_num_rows($data);
echo $result['email'];

?>">
<!-- <a href="email.php">Edit</a> -->
<br>
        <label class="name" for="password">Password:</label><br>
        <input class="box" type="password" name="password" id="password" value=" <?php
$email=$_SESSION['email'];
$query="SELECT * FROM users where email like '$email'";
$data= mysqli_query($conn,$query);
$result=mysqli_fetch_assoc($data);
$total= mysqli_num_rows($data);
echo $result['pwd'];

?>">
<a href="pass.php">Edit</a>
<br>
  
</form>
</div>
</body>
</html>