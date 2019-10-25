<?php
    include('connection.php');
    include('recommend.php');

    $query=mysqli_query($conn," select * from user_songs");
    $matrix= array();
    while($song=mysqli_fetch_array($query))
    {
        $users=mysqli_query($conn," select fname from users where email like '$song[email]'");
        if (!$users) {
            printf("Error: %s\n", mysqli_error($conn));
            exit();
        }
        $username=mysqli_fetch_array($users);
        $matrix[$username['fname']][$song['song_name']]=$song['rating'];
    }
    var_dump(getRecommendation($matrix,"dh"));

?>