<?php
include "connection.php";
error_reporting(0);
        display_artist();
              function display_artist()
             { 
                     $artist='%Selena%';
                $query="Select * FROM song_info WHERE artist like '$artist'";
                $rs=mysqli_query($GLOBALS['conn'],$query);
                $song_folder_path='\rhythm\songs\\';
                $image_folder_path='\rhythm\images\\';
                $row=mysqli_num_rows($rs);
                while($data=mysqli_fetch_assoc($rs))
                {
                        $song_file_path = $data['song_src'];
                        $song =$song_folder_path.$song_file_path."mp3";
                        $image_file_path= $data['profile_pic'];
                        $image =$image_folder_path.$image_file_path;
                        echo $data['song_name']." ".$data['artist']."<br>";
                        echo '<p><img src='.$image.'></img></p><br>';
                        echo '<p><audio controls><source src='.$song.'></source></audio></p><br>';
                }
           }     
    ?>