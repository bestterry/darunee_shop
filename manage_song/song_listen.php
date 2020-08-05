<?php
  require "../config_database/config.php";
  $id_song = $_GET['id_song'];
  $sql_song = "SELECT ad_song FROM song_list WHERE id_song = $id_song";
  $objq_song = mysqli_query($conn,$sql_song);
  $objr_song = mysqli_fetch_array($objq_song);
  $name_song = $objr_song['ad_song'];
?>
<!DOCTYPE html>
<html>

<?php require 'menu/header.php'; ?>

  <body class=" hold-transition skin-blue layout-top-nav">

    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
          </ul>
        </div>
      </nav>
    </header>

    <div class="content-wrapper">
      <section class="content">
        <div class="row">
          <div class="box box-primary">
            <div class="box-header with-border">
              <div class="col-12">
                <div class="col-2 col-sm-2 col-xl-2 col-md-2">
                <?php 
                  if($_GET['id_age']==1){
                ?>
                  <a type="button" href="song_old.php" class="btn button2"><< กลับ</a>
                <?php 
                  }
                  if($_GET['id_age']==2){
                ?>
                <a type="button" href="song_middle.php" class="btn button2"><< กลับ</a>
                <?php 
                  }
                  if($_GET['id_age']==3){
                ?>
                <a type="button" href="song_middle.php" class="btn button2"><< กลับ</a>
                <?php 
                  }
                  if($_GET['id_age']=='all'){
                ?>
                <a type="button" href="all_song.php" class="btn button2"><< กลับ</a>
                <?php } ?>
                </div>
                <div class="col-8 col-sm-8 col-xl-8 col-md-8">
                  <p align="center"><font size="5"><B><?php echo $name_song; ?></B></font></p>
                </div>
                <div class="col-2 col-sm-2 col-xl-2 col-md-2">
                  
                </div>
              </div>
            </div>
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                <div class="col-1 col-sm-1 col-lg-1 col-md-1 col-xl-1"></div>
                <div class="col-10 col-sm-10 col-lg-10 col-md-10 col-xl-10 text-center">

                  <audio controls="autoplay">
                    <source src="../song/<?php echo $name_song;?>" type="audio/ogg" />
                    <source src="../song/<?php echo $name_song;?>" type="audio/mpeg" />
                      Your browser does not support the audio element.
                  </audio> 
                </div>
                <div class="col-1 col-sm-1 col-lg-1 col-md-1 col-xl-1"></div>
              </div>
            </div>
            <div class="box-footer text-center">
            </div>
          </div>
        </div>
      </section>
    </div>
  <?php require "menu/script.php"; ?>
  </body>

</html>