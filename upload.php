<?php
include("connection.php");
error_reporting(0);
?>
<html>
<head>
	<title></title>
	<style>
	body{
		/*background: black;*/
	}
	p{
		color: white;
	}
	.name{
		margin-top: 0px;
		padding-top: 0px;
		margin-bottom:20px;
		width:20%;
		
	}
	.upbutton{
		margin:15px;
	}
	a{
		text-decoration: none;

	}
	</style>
</head>
<body>
	<a href="enter.php">Your uploads</a><br>
	<p>Enter a song</p>
<form action="" method="GET" enctype="multipart/form-data">
	<p>Enter song name</p><br>
<input type="text" class="name" placeholder="Enter name of the song" name="name" required><br>
<input type="file" accept="audio/*" class="upbutton" name="file"><br>
<input type="submit" value="Upload" name="upload">
</form>
<?php
include("connection.php");
$id=rand(1,100000);
$name= $_GET['name'];
$file= $_GET['file'];
// $tname=
// $upd_dir=
// move_uploaded_file(filename, destination);

if($_GET['upload'])
{
                  $query="insert into uploads(song_id,release_date,song_src,song_name,profile_pic) values ($id,'1999-11-04','$file','$name','')";
                  $data= mysqli_query($conn,$query);
                 
                  if($data)
                  {
                  	echo "Song inserted succesfully";

                  
                  }
                  else
                  {
                  	echo "Error";
                  }
        
}
else
{
    echo "Error";
}


?>
</body>
</html>
