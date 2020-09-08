<?php
  require "../config_database/config.php";
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
        <div class="box box-primary">
          <div class="row">
            <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg86">
              <div class="topnav">
                <a href="song_old.php"> เพลงเก่า </a>
                <a href="song_middle.php"></i> เพลงยุคกลาง </a>
                <a href="song_new.php"> เพลงใหม่ </a>
                <a href="artist.php"> ค้นหาเพลง </a>
                <a class="active" href="all_song.php"> เพลงทั้งหมด </a>
                <a href="song_setting.php"> ตั้งค่า </a>
                <a href="gradea.php"> A </a>
                <a href="gradeb.php"> B </a>
                <a href="gradec.php"> C </a>
                <a href="graded.php"> D </a>
                <a href="song_setting2.php"> แก้ไข </a>
              </div>
            </div>
            <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <a class="btn button2 pull-right" href="../admin/admin.php"> << เมนูหลัก </a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-sm-12 col-md-12 col-xl-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <div class="text-center">
                  <font size="5">
                    <B align="center"> เพลงทั้งหมด <font color="red"> </font></B>
                  </font>
                </div>
              </div>
              <div class="box-body no-padding">
                <div class="mailbox-read-message">
                  <div class="box-body">
                    <div class="mailbox-read-message">
                      <div class="col-12">
                        <div class="row">
                          <table id="example1" class="table">
                            <thead>
                              <tr>
                                <th class="text-center" width="10%">#</th>
                                <th class="text-center" width="10%">เกรด</th>
                                <th class="text-center" width="27%">นักร้อง</th>
                                <th class="text-center" width="27%">ชื่อเพลง</th>
                                <th class="text-center" width="10%">ต้นฉบับ</th>
                                <th class="text-center" width="6%">#</th> 
                                <th class="text-center" width="10%">เปิด</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php 
                                $sql_songslow = "SELECT * FROM song_list
                                              INNER JOIN song_artist ON song_list.id_artist = song_artist.id_artist
                                              INNER JOIN song_tune ON song_list.id_tune = song_tune.id_tune";
                                $objq_songslow = mysqli_query($conn,$sql_songslow);
                                while($value =  $objq_songslow->fetch_assoc()){
                              ?>
                              <tr> 
                                <td class="text-center">
                                  <?php
                                    if(!empty($value['ad_song'])){
                                  ?>
                                  <a href="song_listen.php?id_song=<?php echo $value['id_song'];?>&&id_age=all" class="btn  btn-success btn-xs" target="_blank">ฟัง</a>
                                  <?php }else{}?>
                                </td>
                                <td class="text-center"><?php echo $value['melodic']; ?></td> 
                                <td class="text-center"><?php echo $value['name_artist'];?></td>
                                <td class="text-center"><?php echo $value['name_song']; ?></td>
                                <td class="text-center"><?php if($value['script']=='N'){echo "-";}else{echo "Y";} ?></td>
                                <td class="text-center">
                                  <a href="song_edit3.php?id_song=<?php echo $value['id_song']; ?>" class="btn  btn-success btn-xs" >แก้</a>
                                </td> 
                                <?php
                                  if($value['status']=='N'){
                                ?>
                                  <td class="text-center">-</td>
                                <?php
                                  }else{
                                ?>
                                <td class="text-center"><font>เปิด</font></td>
                                <?php 
                                  }
                                ?>  
                              </tr>
                              <?php 
                                }
                              ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  <?php require "menu/script.php"; ?>
  </body>

</html>