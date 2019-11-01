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

  <body class="dark">
    <div class="root">
      <ul class="sub-menu" style="display: none;" id="options-menu">
        <li>
          <a href="#">hello</a>
        </li>
        <li>
          <a href="#">lid</a>
        </li>
        <li>
          <a href="#">sids</a>
        </li>
      </ul>
      <header class="navbar-header">
        <div class="navbar-container">
          <div class="navbar-top">
            <div class="brand">
              <p class="brand-name">Rhythm</p>
            </div>
            <nav class="main-navigation" id="site-navigation">
              <div class="main-menu-container">
                <ul class="top-nav-link">
                  <li class="link-container"><a href="#" class="link">Home</a></li>
                  <li class="link-container"><a href="#" class="link">Library</a></li>
                  <li class="link-container"><a href="#" class="link">Browse</a></li>
                </ul>
              </div>
            </nav>
            <nav id="user-nav" class="main-navigation">
              <div class="menu-after-login-container">
                <ul id="menu-after-login" class="user-menu nav">
                  <li class="link-container"><a href="#" class="link">Search</a></li>
                  <li class="menu-item menu-item menu-avatar" style="justify-content:flex-end;">
                    <img
                      src="image/song.jpg"
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
              <button class="material-icons line-height" id="main-back-icon">arrow_forward</button>
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
                <li class="link-container"><a href="#" class="link"></a></li>
                <li class="link-container"><a href="#" class="link"></a></li>
                <li class="link-container"><a href="#" class="link"></a></li>
                <li class="link-container"><a href="#" class="link"></a></li>
                <li class="link-container"><a href="#" class="link"></a></li>
              </ul>
            </div>
          </nav>
          <div id="main-home">
            <section class="section">
              <div class="section-title">
                <h2>Title</h2>
              </div>
              <div class="section-card-list-holder">
                <div class="left-arrow-button-container">
                  <button class="left-arrow-button">
                    <i class="material-icons">
                      keyboard_arrow_left
                    </i>
                  </button>
                </div>
                <div class="section-stage-outer">
                  <ul class="section-stage">
                    <?php
                    include("connection.php");
                    $image_folder_path='\rhythm\images\\';
                    $query=mysqli_query($conn,"SELECT * FROM song_info LIMIT 10");
                    while($row=mysqli_fetch_array($query)){
                       ?>
                       <div class="card">
                                         <div class="container">
                                           <div class="content">
                                             <a href="" tabindex="-1">
                                               <div class="content-overlay"></div>
                                               <img class="content-image" src="<?php echo $image_folder_path.$row['profile_pic'];?>" />
                                               <div class="content-details fadeIn-bottom">
                                                 <div class="card-music-controls-container">
                                                   <div class="card-music-control-button-container card-favorite-button-container">
                                                     <button>
                                                       <i class="material-icons-round svg-icon controller-icons">favorite</i>
                                                     </button>
                                                   </div>
                                                   <div class="card-music-control-button-container card-play-button-container">
                                                     <button class="card-play-button">
                                                       <i class="material-icons-round svg-icon controller-icons">play_arrow</i>
                                                     </button>
                                                   </div>
                                                   <div class="card-music-control-button-container menu card-more-button-container">
                                                     <button>
                                                       <i class="material-icons-round svg-icon controller-icons">more_vert</i>
                                                     </button>
                                                   </div>
                                                 </div>
                                               </div>
                                             </a>
                                           </div>
                                         </div>
                                         <div class="card-basic-data">
                                           <a href="#" class="card-heading"><?php echo $row['song_name']?></a>
                                           <a href="#" class="card-subHeading"><?php echo $row['artist']?></a>
                                         </div>
                                       </div>
                    <?php
                    }
                    ?>
                  </ul>
                </div>
                <div class="right-arrow-button-container">
                  <button class="right-arrow-button">
                    <i class="material-icons">
                      keyboard_arrow_right
                    </i>
                  </button>
                </div>
              </div>
            </section>
          </div>
        </div>
        <div id="cover-page">
          <div class="cover-page-container">
          <div id="cover-header-top" class="cover-top">
            <div class="cover-header-top-container">
              <div class="cover-image-square-photo-container">
                <img src="images/high-on-life.jpg" />
              </div>
              <div class="cover-data-info-container">
                <div class="cover-data-info-extras-container">
                  <h2>Title</h2>
                  <div class="subtitle-style-scope">
                    <span dir="auto" class="style-scope yt-formatted-string">Playlist</span>
                    <span dir="auto" class="style-scope yt-formatted-string"></span>
                    <span dir="auto" class="style-scope yt-formatted-string"></span>
                    <span dir="auto" class="style-scope yt-formatted-string"></span>
                    <span dir="auto" class="style-scope yt-formatted-string"></span>
                  </div>
                  <div class="subtitle-style-scope">
                    <span dir="auto" class="style-scope yt-formatted-string"></span>
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
                        <a href="#"><span class="cover-card-song-item-artist">Arijit</span></a>
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
                <button type="button" class="controller-button material-icons-outlined" id="like" title="like
                " data-like="false"
                    role="switch"
                    aria-checked="false">
                  thumb_up
                </button>
                <button class="controller-button material-icons-outlined" id="dislike" title="dislike">
                  thumb_down
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
                  <button class="controller-button material-icons-round controller-icons">
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