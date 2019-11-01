<?php
 include("connection.php");
 error_reporting(0);
 session_start();
 if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1) {
 $email=$_SESSION['email'];
 $query="SELECT * FROM users where email like '$email'";
 $data= mysqli_query($conn,$query);
 $result=mysqli_fetch_assoc($data);
 $x=$result['fname']; 
$y=$result['lname'];
$res=$x." ".$y;
 ?>

<html>
<head>
<link
      href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
      type="text/css"
      rel="stylesheet"
    />    
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/settings.css">

</head>
<body>
<div class="container emp-profile">
<div id="snackbar"></div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img class="ppic" src="<?php echo $result['userPic']?>" alt=""/>
                            <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input type="file" class="file-upload" id= "file-upload" name="uploadfile" accept="image/*"/>
                            
                            </div>
                        </div>
                                 <input type="submit" name="submit" class="profile-edit-btn sub" id="save-button" value="Save your photo">
                                 </div>
                                </form>

                    
                    <div class="col-md-6" style="display:inline;">
                    <a href="main.php"><i class="material-icons" style="margin-left:120%;font-size:36px;">
keyboard_backspace
</i></a>
                        <div class="profile-head" style="display:inline;">
                                   <h2> <?php echo $res; ?>
                                     </h2>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                               
                            </ul>
                        </div>
                    </div>
                    
                </div>
               
                
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="rows">
                                            <div class="col-md-4">
                                                <label>First Name</label>
                                            </div>
                                            <div class="col-md-4">
                                                <p> <?php echo $x;  ?></p>
                                            </div>
                                            
                                        </div>
                                        <div class="rows">
                                            <div class="col-md-4">
                                                <label>Last Name</label>
                                            </div>
                                            <div class="col-md-4">
                                                <p> <?php echo $y;  ?></p></div>
                                                <div class="col-md-4">
                                         <a href="changeName.php"><input type="submit" class="profile-edit-btn" value="Edit Name"/></a>
                                             
                                            </div>
                                           
                                        </div>
                                        <div class="rows">
                                            <div class="col-md-4">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-4">
                                                <p> <?php echo $result['email'];  ?></p>
                                            </div>
                                            
                                        </div>
                                        <div class="rows">
                                            <div class="col-md-4">
                                                <label>Password</label>
                                            </div>
                                            <div class="col-md-4">
                                              <input class="pass" type="password" value="<?php echo $result['pwd']; ?>" style="color:blue !important;">
                                            </div>
                                            <div class="col-md-4">
                                         <a href="changePassword.php"><input type="submit" class="profile-edit-btn" value="Edit Password"/></a>
                                             </div>
                                        </div>
                                        
                                            
                                    </div>
                            </div>


                        </div>
                    </div>
                </div>
            </form>           
        </div>
    </body>
    
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="js/setting.js"></script>
</html>
<?php
}
else if(!isset($_SESSION['logged_in']) || (isset($_SESION['logged_in']) && $_SESSION['logged_in'] == 0)){
    header('Location: error.html');
} 
?>