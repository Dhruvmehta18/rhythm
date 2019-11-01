<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rhythm";
try {
  $conn1 = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    $playlist_id = $_POST['playlist_id'];
    // $playlist_image_folder_path='/rhythm/playlist/';
    $title = 'Liked Music';
    session_start();
$song_folder_path = '/rhythm/songs/';
$image_folder_path = '/rhythm/images/';
$email=$_SESSION['email'];
  $queryLikes = "SELECT s.song_id,song_name,artist,song_src,profile_pic FROM user_songs u,song_info s WHERE email='$email' AND u.song_id=s.song_id AND rating=1 ORDER BY tim DESC";
  $stmt3 = $conn1->prepare($queryLikes);
  $check1 = $stmt3->setFetchMode(PDO::FETCH_ASSOC);
    // var_dump($value);
    // var_dump($value[0]);
    $stmt3->bindParam(':email', $email, PDO::PARAM_INT);
    $stmt3->execute();
    $fetch_liked = $stmt3->fetchAll();
?>
<html>
    <head>
    <link
      href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
      type="text/css"
      rel="stylesheet"
    />
    <link rel="stylesheet" type="text/css" href="css/index.css" />
    </head>
    <body>
   <div id="cover-page" style="display:block;">
     <div class="cover-page-container">
  <div id="cover-header-top" class="cover-top">
    <div class="cover-header-top-container">
      <div class="cover-image-square-photo-container">
        <img src='like.jpg'>
       </div>
      <div class="cover-data-info-container">
        <div class="cover-data-info-extras-container">
          <h2></h2>
          <div class="subtitle-style-scope">
            <span dir="auto" class="style-scope yt-formatted-string">Playlist</span>
            <span dir="auto" class="style-scope yt-formatted-string">•</span>
            <span dir="auto" class="style-scope yt-formatted-string"></span>
          </div>
          <div class="subtitle-style-scope">
            <span dir="auto" class="style-scope yt-formatted-string">
            <?php echo count($fetch_liked); ?>
             songs</span>
            <span dir="auto" class="style-scope yt-formatted-string"></span>
            <span dir="auto" class="style-scope yt-formatted-string"></span>
          </div>
          <div class="destcription subtitle-style-scope">
            <span dir="auto" class="style-scope yt-formatted-string">
            </span>
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
        <ul class="cover-card-song-list">
    <?php
    foreach($fetch_liked as $value)
    {
    ?>
          <li class="cover-card-song-item">
            <div class="cover-card-song-item-container">
              <div class="cover-card-song-item-image-container cover-card-song-item-general-container">
                <img src="<?php echo $image_folder_path.$value['profile_pic'];?>"/>
                <div class="cover-card-song-item-image-container-overlay">
                  <div class="cover-card-song-item-image-container-overlay-button" data-coversongid="<?php echo $value['song_id'];?>" >
                    <i class="material-icons-round">play_arrow</i>
                  </div>
                </div>
              </div>
              <div class="container-flex-list cover-card-song-item-general-container">
              <div class="cover-card-song-item-name-container responsive-list-item-renderer ">
                <a href="#"><span class="cover-card-song-item-name">
               <?php echo  $value['song_name'];?>
                </span></a>
              </div>
              <div class="cover-card-song-item-artist-container responsive-list-item-renderer">
                <a href="#"><span class="cover-card-song-item-artist">
                <?php echo $value['artist'];?>
            </span></a>
              </div>
              </div>
              <div class="cover-card-song-item-controller-container  cover-card-song-item-general-container">
                <div class="cover-card-song-item-more-button-container menu">
                  <button>
                  <i class="material-icons-round">
                  more_vert
                </i>
              </button>
                </div>
              </div>
              
            </div>
          </li>
          <?php
    }
    ?>
        </div>
      </div>
    </div>
    </div>
  </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
  <script type="text/javascript" src="js/index.js"></script>
  <script type="text/javascript" src="js/index1.js"></script>
</html>
  <?php
  }
  catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
  $conn = null;
?>