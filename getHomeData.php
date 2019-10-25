<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Rhythm";
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $query = "SELECT * FROM Artist WHERE artist_id =1";
  $query1 = "SELECT * FROM Has WHERE artist_id =1";
  $stmt1 = $conn->prepare($query1);
  // $stmt->bindValue(':input', '%' . $value . '%');
  $stmt1->execute();
  // set the resulting array to associative
  $cardList = array();
  $result = $stmt1->setFetchMode(PDO::FETCH_ASSOC);
  $fetch = $stmt1->fetchAll();
  $album_id = array_column($fetch, 'album_id');
  $queryAlbums = "SELECT * FROM Playlist WHERE playlist_id = :album_id";
  $stmt2 = $conn->prepare($queryAlbums);
  $check = $stmt2->setFetchMode(PDO::FETCH_ASSOC);
  for ($i = 0; $i < count($album_id); $i++) {
    $value = $album_id[$i];
    $stmt2->bindParam(':album_id', $value, PDO::PARAM_INT);
    $stmt2->execute();
    $fetch_songs = $stmt2->fetchAll();
    // echo print_r($fetch_songs);
    array_push($cardList, $fetch_songs);
  }
  echo json_encode($cardList);
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
?>