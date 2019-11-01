<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rhythm";
try {
  $conn1 = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  if(isset($_POST['playlist_id'])){
    $playlist_id = $_POST['playlist_id'];
    $playlist_image_folder_path='/rhythm/playlist/';
$song_folder_path = '/rhythm/songs/';
$image_folder_path = '/rhythm/images/';
  $queryAlbums = "SELECT * FROM Playlist WHERE playlist_id = :album_id";
  $stmt3 = $conn1->prepare($queryAlbums);
  $check1 = $stmt3->setFetchMode(PDO::FETCH_ASSOC);
    // var_dump($value);
    // var_dump($value[0]);
    $stmt3->bindParam(':album_id', intval($playlist_id), PDO::PARAM_INT);
    $stmt3->execute();
    $fetch_playlists = $stmt3->fetchAll();
  $playlist = $fetch_playlists[0];
  
  $value = $playlist_id;
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $query = "SELECT * FROM song_info WHERE album_id =:album_id";
  $stmt = $conn->prepare($query);
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  $stmt->bindValue(':album_id', $value);
  $stmt->execute();
  $fetch = $stmt->fetchAll();
  $date=date_create($playlist["release_date"]);
  // echo date_format($date,"d F, Y");
  echo '<div id="cover-page" style="display:block;" data-coverPlaylistID=';
  echo '"'. $playlist_id .'"';
  echo '>
  <div class="cover-page-container">
  <div id="cover-header-top" class="cover-top">
    <div class="cover-header-top-container">
      <div class="cover-image-square-photo-container">';
      echo  "<img src=".$playlist_image_folder_path.$playlist['playlist_photo_url'].">";
      echo '</div>
      <div class="cover-data-info-container">
        <div class="cover-data-info-extras-container">
          <h2 style="font-size:32px;"> ';
          echo $playlist["playlist_name"]; 
          echo '</h2>
          <div class="subtitle-style-scope">
            <span dir="auto" class="style-scope yt-formatted-string">';
            echo 'Released on '.date_format($date,"d F, Y");;
            echo '</span>
            <span dir="auto" class="style-scope yt-formatted-string"></span>
            <span dir="auto" class="style-scope yt-formatted-string"></span>
          </div>
          <div class="subtitle-style-scope">
            <span dir="auto" class="style-scope yt-formatted-string">';
            echo count($fetch);
            echo ' songs</span>
            <span dir="auto" class="style-scope yt-formatted-string"></span>
            <span dir="auto" class="style-scope yt-formatted-string"></span>
          </div>
          <div class="destcription subtitle-style-scope">
            <span dir="auto" class="style-scope yt-formatted-string">
              </span
            >
          </div>
        </div>
      </div>
      <div class="cover-data-info-controller-buttons-container">
        <div class="cover-top-level-buttons">
          <div class="top-level-button-container">
            <button tabindex="-1" class="top-level-button" id="cover-play-button">
              <span class="top-level-button-icon">
                <i class="material-icons">
                  play_arrow
                </i>
              </span>
              <span>Play</span>
            </button>
          </div>
          <div class="top-level-button-container">
            <button tabindex="-1" class="top-level-button" id="cover-shuffle-button">
              <span class="top-level-button-icon">
                <i class="material-icons">
                  shuffle
                </i>
              </span>
              <span>Shuffle</span>
            </button>
          </div>
          
        </div>
      </div>
    </div>
  </div>
  <div class="cover-card-list" id="cover-body-top">
    <div class="cover-card-list-container-holder">
      <div class="cover-card-list-container">
        <ul class="cover-card-song-list">';
    foreach($fetch as $value)
    {
          echo '<li class="cover-card-song-item">
            <div class="cover-card-song-item-container">
              <div class="cover-card-song-item-image-container cover-card-song-item-general-container">
                <img src="'.$image_folder_path.$value['profile_pic'].'"/>
                <div class="cover-card-song-item-image-container-overlay">
                  <div class="cover-card-song-item-image-container-overlay-button" data-coversongid="';
                  echo $value['song_id'];
                  echo '" >
                    <i class="material-icons-round">play_arrow</i>
                  </div>
                </div>
              </div>
              <div class="container-flex-list cover-card-song-item-general-container">
              <div class="cover-card-song-item-name-container responsive-list-item-renderer ">
                <a href="#"><span class="cover-card-song-item-name">';
               echo  $value['song_name'];
                echo '</span></a>
              </div>
              <div class="cover-card-song-item-artist-container responsive-list-item-renderer">
                <a href="#"><span class="cover-card-song-item-artist">';
                echo $value['artist'];
                echo '</span></a>
              </div>
              </div>
              <div class="cover-card-song-item-controller-container  cover-card-song-item-general-container">
                <div class="cover-card-song-item-more-button-container">
                  <a href="';
                  echo $song_folder_path.$value['song_src'];
                  echo '" class="downloadButton" download>
                  <i class="material-icons-round">
                  vertical_align_bottom
                </i>
              </a>
                </div>
              </div>
              
            </div>
          </li>';
    }
    echo'    </div>
      </div>
    </div>
    </div>
  </div>';
  }
}
  catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
  $conn = null;
?>

