 <?php
 include("connection.php");
 $query=mysqli_query($conn,"SELECT * FROM song_info LIMIT 10");
 while($row=mysqli_fetch_array($query)){
    ?>
    <div class="card">
                      <div class="container">
                        <div class="content">
                          <a href="" tabindex="-1">
                            <div class="content-overlay"></div>
                            <img class="content-image" src="<?php echo $row['profile_pic'];?>" />
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

 