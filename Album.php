<?php
class album{

  private $conn;
  private $id;
  private $title;
  private $artistId;
  private $genre;

public function __construct($conn,$id)
{
  $this->conn=$conn;
  $this->id=$id;
  $query=mysqli_query($this->con,"SELECT * FROM song_info where id='$this->id'");
    $album = mysqli_fetch_array($query);
    $this->title= $album['song_name'];
    $this->genre = $album['genre'];
    $this->profile_pic = $album['profile_pic'];
}  

public function getTitle()
{
  return $this->song_name;
}

  public function getArtistPic()
  {
    $query = mysqli_query($conn, "SELECT profile_pic from song_info where id='$this->id'");
    $album = mysqli_fetch_array($query);
    return $album['profile_pic'];
  }
 
  public function getArtistId()
  {
    return new Artist($this->conn,$this->artistId);
  } 
  public function getGenre()
  {
    return $this->genre;
  }
}
?>