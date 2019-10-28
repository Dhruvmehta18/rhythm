<?php
    include("connection.php");
    session_start();
    $em=$_SESSION["email"];
    $song_id=$_POST['song_id'];
    if(isset($_POST['liked']))
    {
        $s=$_POST['liked']=='false'?1:0;
    mysqli_query($conn,"delete from user_songs where email like '$em' and song_id ='$song_id'");
    $query=mysqli_query($conn,"insert into user_songs values ('$em','$song_id',$s)");
        echo $s;
    }
?>