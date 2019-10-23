<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rhythm";
if(isset($_POST['searchInput'])){
$value = $_POST['searchInput'];
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query="SELECT * from song_info WHERE song_name LIKE :input LIMIT 10";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':input', '%' . $value . '%');
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $fetch=$stmt->fetchAll();
    $data['searchItems'] = $fetch;
    echo json_encode($data);

}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
}
?>