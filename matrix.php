<?php
    include('connection.php');
    session_start();
    if(isset( $_SESSION['email'])){
        include('recommend.php');
        $user_email = $_SESSION['email'];
        $query=mysqli_query($conn," select * from user_songs");
        $matrix= array();
        $flag=0;
        while($song=mysqli_fetch_array($query))
        {
            $users=mysqli_query($conn," select email from users where email like '$song[email]'");
            
            if (!$users) {
                printf("Error: %s\n", mysqli_error($conn));
                exit();
            }
            $username=mysqli_fetch_array($users);
            
            if($flag==0&&$username['email']==$user_email){
                $flag=1;
            }      
            $songp=strval($song['song_id']);
            $matrix[$username['email']][$songp.' ']=$song['rating'];
        }
        
        $recommended="";
        if($flag==1){
            $recommended=json_encode(getRecommendation($matrix,$user_email));
        }
        // print_r( $recommended);
        // echo $recommended;
        // $conn=null;
    }
?>