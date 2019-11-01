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
  if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1) {
    $email=$_SESSION['email'];
  $query=mysqli_query($conn,"SELECT * from users where email like '$email'");
  $user=mysqli_fetch_assoc($query);
  $image=$user['userPic'];
  $fname=$user['fname'];
  $lname=$user['lname']; 
    ?>
  <body class="dark">
    <div class="bg-image"></div>
    <div class="root">
      <ul class="sub-menu" style="display: none;" id="options-menu">
        <li style="padding:0px 16px;margin:0;">
        <h4 style="padding:0px;margin:0;"><?php echo ' '.$fname.' '.$lname;?></h4>
          <p style="padding:0px;margin:0;"><?php echo $email;?></p>
        </li>
        <li>
        <a href="setting.php"><i class="material-icons" style="margin-right: 10px;
    margin-left: -20px;
    vertical-align: top;">settings_applications</i>Settings</a>
        </li>
        <li>
          <a href="about.php"><i class="material-icons" style="margin-right: 10px;
    margin-left: -20px;
    vertical-align: top;">account_box</i>About us</a>
        </li>
        <li>
          <a href="contact.php"><i class="material-icons" style="margin-right: 10px;
    margin-left: -20px;
    vertical-align: top;">contact_support</i>Contact us</a>
        </li>
        <li>
          <a href="logout.php"><i class="material-icons" style="margin-right: 10px;
    margin-left: -20px;
    vertical-align: top;">input</i>Log Out</a>
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
              ></<h4>
              <div class="dropdown-menu"></div>
            </span>
          </div>
        </div>
      </header>
      <div id="main-home-holder">
        <div id="main-home-container">
          <div id="main-home">
          </div>
        </div>
        </div>
        <div class="music-controller-container">
          <div id="music-controller">
            <div class="controller-1">
              <div class="song-image">
                <img src="image//song.jpg" alt="song" srcset="" />
              </div>
              <div class="data">
                <a href="#" class="card-heading"></a>
                <a href="#" class="card-subHeading"></a>
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
  <script>
  $(document).ready(function () {
                var imageFile = ["image1.jpg", "image3.jpg", "image2.jpg", "image5.jpg","image6.png", "image3.jpg", "image7.png"];
                var currentIndex = 0;
                setInterval(function () {
                    if (currentIndex == imageFile.length) {
                        currentIndex = 0;
                    }
                    $("#main-home").css({'background-image':'url("image/' + imageFile[currentIndex++] + '")',"background-repeat": "no-repeat",
    "background-size": "cover",
    "background-position": "center"});
                }, 10000);
            });
  </script>
  
  </script>
</html>

  <?php
  } else if(!isset($_SESSION['logged_in']) || (isset($_SESION['logged_in']) && $_SESSION['logged_in'] == 0)){
    header('Location: error.html');
} 
  ?>