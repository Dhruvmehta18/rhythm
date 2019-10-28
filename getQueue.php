<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Rhythm";
try {
  
  session_start();
  $email=$_SESSION['email'];
  if (isset($_POST['playlist_id'])) {
{
    $value = $_POST['playlist_id'];
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT * FROM song_info WHERE album_id =:album_id";
    $stmt = $conn->prepare($query);
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->bindValue(':album_id', $value);
    $stmt->execute();
    $fetch = $stmt->fetchAll();}
    $song_ids=array_column($fetch,"song_id");
    for ($i=0; $i < count($song_ids); $i++) { 
      $song_id = $song_ids[$i];
      $query1 = "SELECT rating FROM user_songs WHERE email=:user_email AND song_id =:song_id";
      $stmt2 = $conn->prepare($query1);
      $result = $stmt2->setFetchMode(PDO::FETCH_ASSOC);
      $stmt2->bindParam(':song_id', $song_id);
      $stmt2->bindValue(':user_email',$email);
      $stmt2->execute();
      $fetch1 = $stmt2->fetchAll();
      if(count($fetch1)>0){
      $like = $fetch1[0]['rating'];
      $fetch[$i]['rating']=$like;
      }
      else{
      $fetch[$i]['rating']=0;
      }

    }
    $arr['queue'] = $fetch;
    $query = "SELECT * FROM Playlist WHERE playlist_id =:playlist_id";
    $stmt = $conn->prepare($query);
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->bindValue(':playlist_id', $value);
    $stmt->execute();
    $fetch = $stmt->fetchAll();
    $arr['playlist_info']=$fetch;
    echo json_encode($arr);
  }
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
