<?php
    include("connection.php");
    session_start();
    $em=$_SESSION["email"];
    if(isset($_POST['liked']))
    {
        $s=$_POST['liked']=='false'?1:0;
    mysqli_query($conn,"delete from user_songs where email like '$em' and song_id =1");
    $query=mysqli_query($conn,"insert into user_songs values ('$em',1,'high',$s)");
        echo $s;
    }
?>