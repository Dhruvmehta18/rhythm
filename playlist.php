 <div id="cover-page" style="display:block;">
   <div class="cover-page-container">
     <div id="cover-header-top" class="cover-top">
       <div class="cover-header-top-container">
         <div class="cover-image-square-photo-container">
           <img src="image/song.jpg" />
         </div>
         <div class="cover-data-info-container">
           <div class="cover-data-info-extras-container">
             <h2>Title</h2>
             <div class="subtitle-style-scope">
               <span dir="auto" class="style-scope yt-formatted-string">Playlist</span>
               <span dir="auto" class="style-scope yt-formatted-string">•</span>
               <span dir="auto" class="style-scope yt-formatted-string">Rhythm</span>
               <span dir="auto" class="style-scope yt-formatted-string">•</span>
               <span dir="auto" class="style-scope yt-formatted-string"></span>
             </div>
             <div class="subtitle-style-scope">
               <span dir="auto" class="style-scope yt-formatted-string">58 songs</span>
               <span dir="auto" class="style-scope yt-formatted-string">•</span>
               <span dir="auto" class="style-scope yt-formatted-string">3 hours, 48 minutes</span>
             </div>
             <div class="destcription subtitle-style-scope">
               <span dir="auto" class="style-scope yt-formatted-string">
                 Listen to songs from Sheeran and other likeminded artists who represent a new vanguard of
                 guitar-slinging troubadours.</span>
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
             <div class="top-level-button-container">
               <button tabindex="-1" class="top-level-button" id="cover-library-button">
                 <span class="top-level-button-icon">
                   <i class="material-icons">
                     library_add
                   </i>
                 </span>
                 <span>Add To Library</span>
               </button>
             </div>
             <div class="top-level-button-container">
               <button tabindex="-1" class="top-level-button menu" id="cover-more-button">
                 <span class="top-level-button-icon">
                   <i class="material-icons">
                     more_vert
                   </i>
                 </span>
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
             <li class="cover-card-song-item">
               <div class="cover-card-song-item-container">
                 <div class="cover-card-song-item-image-container cover-card-song-item-general-container">
                   <img src="image/song.jpg" />
                   <div class="cover-card-song-item-image-container-overlay">
                     <div class="cover-card-song-item-image-container-overlay-button">
                       <i class="material-icons-round">play_arrow</i>
                     </div>
                   </div>
                 </div>
                 <div class="container-flex-list cover-card-song-item-general-container">
                   <div class="cover-card-song-item-name-container responsive-list-item-renderer ">
                     <a href="#"><span class="cover-card-song-item-name">Slow Down</span></a>
                   </div>
                   <div class="cover-card-song-item-artist-container responsive-list-item-renderer">
                     <a href="#"><span class="cover-card-song-item-artist">Arijit Singh</span></a>
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
                 <div class="cover-card-song-item-duration-container  cover-card-song-item-general-container">
                   <span class="cover-card-song-item-duration">0:00</span>
                 </div>
               </div>
             </li>

         </div>
       </div>
     </div>
   </div>
 </div>
 <?php
  include('connection.php');
  $artist = $_GET['id'];
  if (isset($artist)) {
    $query = "select * from song_info where artist_id='$artist'";
    $album_query = mysqli_query($conn, $query);
    $album = mysqli_fetch_array($album_query);
    echo $album['song_name'] . "<br>";
    echo $album['artist'];
  } else {
    header('location:index.html');
  }
  ?>