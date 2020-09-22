<?php 
  require "../config_database/config.php"; 
  $output = '';  
  $id_song = $_POST['id_song'];
  
  $query = "SELECT * FROM song_list WHERE id_song = $id_song";  
  $result = mysqli_query($conn, $query);
  $objr = mysqli_fetch_array($result);
  $ad_song = $objr['ad_song'];
          $output .= '  
          <div class="table-responsive">
            <div class="col-12 col-sm-12 col-xl-12 col-md-12">
              <p align="center"><font size="5"><B>'.$ad_song.'</B></font></p>
            </div>
            <br>
            <div class="mailbox-read-message">
            <div class="col-1 col-sm-1 col-lg-1 col-md-1 col-xl-1"></div>
            <div class="col-10 col-sm-10 col-lg-10 col-md-10 col-xl-10 text-center">

              <audio controls="autoplay">
                <source src="../song/'.$ad_song.'" type="audio/ogg" />
                <source src="../song/'.$ad_song.'" type="audio/mpeg" />
                  Your browser does not support the audio element.
              </audio> 
            </div>
            <div class="col-1 col-sm-1 col-lg-1 col-md-1 col-xl-1"></div>
          </div>
        </div>
                ';   
      echo $output;  
 
 ?>