<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rhythm";
try {
  $conn1 = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $cardList = array();
  $temp=array();
  include('matrix.php');
  if(!empty($recommended)){
    $recommend=array('info'=>array('title'=>'Recommended For You'),'cards'=>array());
    $recommended=json_decode($recommended,true);
    $query_song="SELECT album_id FROM song_info WHERE song_id=:song_id";
    $stmt2 = $conn1->prepare($query_song);
    $check = $stmt2->setFetchMode(PDO::FETCH_ASSOC);
    foreach ($recommended as $key => $value) {
      $value1=intval(trim($key));
      $stmt2->bindParam(':song_id', $value1, PDO::PARAM_INT);
      $stmt2->execute();
      $fetch_songs = $stmt2->fetchAll();
      $value = array_column($fetch_songs,'album_id');
      $queryAlbums = "SELECT * FROM Playlist WHERE playlist_id = :album_id";
      $stmt3 = $conn1->prepare($queryAlbums);
      $check1 = $stmt3->setFetchMode(PDO::FETCH_ASSOC);
      $stmt3->bindParam(':album_id', intval($value[0]), PDO::PARAM_INT);
      $stmt3->execute();
      $fetch_playlist = $stmt3->fetchAll();
      $pl=$fetch_playlist[0]['playlist_id'];
      // echo "p1"."$pl";
      $flag=0;
      for ($i=0; $i <count($temp) ; $i++) { 
        if($temp[$i]==$pl){
          $flag=1;
        }
      }
      if($flag!=1){
      array_push($temp, $pl);
      array_push($recommend['cards'], $fetch_playlist[0]);
      }
      // array_values($temp);
    }
    array_push($cardList,$recommend);
  }
  $newReleases=array('info'=>array('title'=>'New Releases'),'cards'=>array());
  $queryAlbums = "SELECT * FROM Playlist WHERE release_date>'2018-01-01' ORDER BY release_date DESC LIMIT 10";
  $stmt3 = $conn1->prepare($queryAlbums);
  $check1 = $stmt3->setFetchMode(PDO::FETCH_ASSOC);
  $stmt3->execute();
  $fetch_playlist = $stmt3->fetchAll();
  $newReleases['cards'] = $fetch_playlist;
  array_push($cardList,$newReleases);

  $topAlbums=array('info'=>array('title'=>'Top Albums'),'cards'=>array());
  $queryTop = "SELECT * FROM Playlist WHERE popularity>0.7 ORDER BY popularity DESC LIMIT 10";
  $stmt4 = $conn1->prepare($queryTop);
  $check1 = $stmt4->setFetchMode(PDO::FETCH_ASSOC);
  $stmt4->execute();
  $fetch_playlist = $stmt4->fetchAll();
  $topAlbums['cards'] = $fetch_playlist;
  array_push($cardList,$topAlbums);
  echo json_encode($cardList);

} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
?>