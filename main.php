<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link
      href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
      type="text/css"
      rel="stylesheet"
    />
    <link rel="stylesheet" type="text/css" href="css/index.css" />
    <title>Rhythm</title>
  </head>
  <?php
  include("connection.php");
  session_start(); 
  $email=$_SESSION['email'];
  $query=mysqli_query($conn,"SELECT * from users where email like '$email'");
  $user=mysqli_fetch_assoc($query);
  $image=$user['userPic'];
  $fname=$user['fname'];
  $lname=$user['lname'];  
  ?>
  <body class="dark">
    <div class="root">
      <ul class="sub-menu" style="display: none;" id="options-menu">
        <li style="padding:0px 16px;margin:0;">
          <h4 style="padding:0px;margin:0;"><?php echo ' '.$fname.' '.$lname;?></h4>
          <p style="padding:0px;margin:0;"><?php echo $email;?></p>
        </li>
        <li>
          <a href="setting.php">Settings</a>
        </li>
        <li>
          <a href="about.php">About us</a>
        </li>
        <li>
          <a href="contact.php">Contact us</a>
        </li>
      </ul>
      <header class="navbar-header">
        <div class="navbar-container">
          <div class="navbar-top">
            <div class="brand">
              <p class="brand-name">Rhythm</p>
            </div>
            <nav id="user-nav" class="main-navigation">
              <div class="menu-after-login-container">
                <ul id="menu-after-login" class="user-menu nav">
                  <li class="link-container"><a href="#" class="link">Search</a></li>
                  <li class="menu-item menu-item menu-avatar" style="justify-content:flex-end;">
                    <img
                      src="<?php echo $image;?>"
                      alt="profile image"
                      class="avatar menu"
                      style="width: 36px;height: 36px;"
                    />
                  </li>
                </ul>
              </div>
            </nav>
          </div>
        </div>
        <div id="search-block-text">
          Search
        </div>
        <div class="search-form-container">
          <div id="header-search-form">
            <span id="search-form">
              <button class="material-icons line-height" id="main-back-icon">arrow_back</button>
              <input
                type="text"
                name="search-hint"
                id="input-search-hint"
                value=""
                placeholder=""
                readonly
                autocomplete="off"
                spellcheck="false"
                tabindex="-1"
                dir="auto"
              />
              <input
                type="search"
                value=""
                class="input"
                id="header-search-input"
                placeholder="Search"
                autocomplete="off"
                spellcheck="false"
                dir="auto"
              />
              <pre
                aria-hidden="true"
                style="position: absolute;
                            visibility: hidden;
                            white-space: pre;
                            font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Ubuntu, Helvetica Neue, sans-serif;
                            font-size: 14px;
                            font-style: normal;
                            font-variant: normal;
                            font-weight: 700;
                            word-spacing: 0px;
                            letter-spacing: 0px;
                            text-indent: 0px;
                            text-rendering: auto;
                            text-transform: none;"
              ></pre>
              <div class="dropdown-menu"></div>
            </span>
          </div>
        </div>
      </header>
      <div id="main-home-holder">
        <div id="main-home-container">
          <nav class="page-header" id="navbar-bottom">
            <div class="bottom-nav-container">
              <ul class="bottom-nav-link">
                <li class="link-container"><a href="#" class="link">Featured</a></li>
                <li class="link-container"><a href="#" class="link">Library</a></li>
                <li class="link-container"><a href="#" class="link">Discover</a></li>
                <li class="link-container"><a href="#" class="link">Genre</a></li>
              </ul>
            </div>
          </nav>
          <div id="main-home">
            
          </div>
        </div>
         <!-- <div id="cover-page" >
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
                      guitar-slinging troubadours.</span
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
          </div>  -->
        </div>
        <div class="music-controller-container">
          <div id="music-controller">
            <div class="controller-1">
              <div class="song-image">
                <img src="image//song.jpg" alt="song" srcset="" />
              </div>
              <div class="data">
                <a href="#" class="card-heading">Slow down</a>
                <a href="#" class="card-subHeading">Arijit singh</a>
              </div>
              <div class="song-feedback">
                <button class="controller-button material-icons-round" title="like" id="like" data-like="false"
                role="switch"
                aria-checked="false">
                  favorite
                </button>
              </div>
            </div>
            <div class="controller-2">
              <div class="player-controller">
                <div class="player-control-button">
                  <button class="controller-button material-icons-round" id="shuffleButton">
                    shuffle
                  </button>
                </div>
                <div class="player-control-button">
                  <button class="controller-button material-icons-round" id="prev-button">
                    skip_previous
                  </button>
                </div>
                <div class="player-control-button" style="font-size:36px;width:46px;height:46px;">
                  <button
                    class="controller-button material-icons-round"
                    id="play-button"
                    data-playing="false"
                    role="switch"
                    aria-checked="false"
                    style="font-size:36px;width:46px;height:46px;"
                  >
                    play_arrow
                  </button>
                </div>
                <div class="player-control-button">
                  <button class="controller-button material-icons-round" id="next-button">
                    skip_next
                  </button>
                </div>
                <div class="player-control-button">
                  <button class="controller-button material-icons-round" id="repeat-button" title="repeat off">
                    repeat
                  </button>
                </div>
              </div>
              <div class="time-controller">
                <audio id="music_player" crossorigin="anonymous" src=""></audio>
                <div id="time-controller-container">
                  <div class="audio-time">
                    <p id="start-time">0:00</p>
                  </div>
                  <div id="time-progress">
                    <div id="time-progress-bar"></div>
                  </div>
                  <div class="audio-time">
                    <p id="end-time">0:00</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="controller-3">
              <div class="music-settings">
                <div class="volume-container">
                  <div id="volume-slider-container">
                    <div id="volume"></div>
                  </div>
                  <div class="player-control-button settings-container">
                    <button class="controller-button material-icons-round">volume_up</button>
                  </div>
                </div>
                <div class="player-control-button">
                  <button class="controller-button material-icons-round controller-icons" id="playlist_controller_button"
                  data-open="false"
                    role="switch"
                    aria-checked="false">
                    queue_music
                  </button>
                </div>
              </div>
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
