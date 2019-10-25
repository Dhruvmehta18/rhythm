<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Rhythm";
try {
  if (isset($_POST['playlist_id'])) {
    $value = $_POST['playlist_id'];
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT * FROM Song WHERE album_id =:album_id";
    $stmt = $conn->prepare($query);
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->bindValue(':album_id', $value);
    $stmt->execute();
    $fetch = $stmt->fetchAll();
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
