<?php 
error_reporting(0);
include("connection.php");

$query="SELECT * FROM uploads";
$data= mysqli_query($conn,$query);

$total= mysqli_num_rows($data);

if($total!=0)
{
	while($result=mysqli_fetch_assoc($data))
	{
		echo "<p>$result[song_name]</p>";
		// echo '<a href="insert.php" target="_self"<button>play</button></a><br>';
		echo "<audio controls loop>
  			<source src='$result[song_src]'></source>
  	  	  </audio>";
  		echo "<br>";
	
	}
}
 ?>