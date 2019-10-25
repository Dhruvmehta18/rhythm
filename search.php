<?php
  
if(isset($_POST['search_value'])){
  $conn = new mysqli("localhost","dhruv","1234","Rhythm");
  $query ='SELECT song_name from SongInfo WHERE song_name="Seven"';
  $arr = mysqli_query($conn,$query);
  echo json_encode($arr);
}
$conn = new mysqli("localhost", "dhruv", "1234", "Rhythm");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$query = 'SELECT TOP 10 * from SongInfo';
echo $query;
$result = $conn->query("SELECT * FROM SongInfo");
if ($result->num_rows > 0) {
  // output data of each row
  $arr=[];
  while ($row = $result->fetch_assoc()) {
    // echo $row['song_name'];
    $temp=[
      'name'=> $row['song_name']
    ];
    array_push($arr,$temp);
  }
  echo json_encode($arr, JSON_FORCE_OBJECT);
} else {
  echo "0 results";
}
$conn->close();
?>