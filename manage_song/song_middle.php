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
            <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8">
              <div class="topnav">
                <a href="artist.php"> ค้นหา </a>
                <a href="song_old.php"> เก่า </a>
                <a class="active" href="song_middle.php"></i> กลาง </a>
                <a href="song_new.php"> ใหม่ </a>
                <a href="gradea.php"> A </a>
                <a href="gradeb.php"> B </a>
                <a href="gradec.php"> C </a>
                <a href="graded.php"> D </a>
                <a href="song_setting.php"> เพลง </a>
                <a href="artist_setting.php"> นักร้อง </a>
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
              <div class="box-body no-padding">
                <div class="mailbox-read-message">
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#A" data-toggle="tab">A</a></li>
                      <li><a href="#B" data-toggle="tab">B</a></li>
                      <li><a href="#C" data-toggle="tab">C</a></li>
                      <li><a href="#D" data-toggle="tab">D</a></li>
                    </ul> 
                    <div class="tab-content">

                      <div class="tab-pane active" id="A">
                        <div align="center" class="box-footer">
                          <font size="5">
                            <B align="center">นักร้องยุคกลาง (A)</B>
                          </font>
                        </div>
                        <div class="box-body">
                          <div class="mailbox-read-message">
                            <div class="col-12">
                              <table id="example1" class="table">
                                <thead>
                                  <tr>
                                    <th class="text-center" width="10%">#</th>
                                    <th class="text-center" width="27%">นักร้อง</th>
                                    <th class="text-center" width="27%">ชื่อเพลง</th>
                                    <th class="text-center" width="10%">ทำนอง</th>
                                    <th class="text-center" width="13%">ต้นฉบับ</th>
                                    <th class="text-center" width="13%">เปิด</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                    $sql_songslow = "SELECT * FROM song_list
                                                  INNER JOIN song_artist ON song_list.id_artist = song_artist.id_artist
                                                  INNER JOIN song_tune ON song_list.id_tune = song_tune.id_tune
                                                  WHERE song_artist.id_ageartist = 2 AND song_list.melodic = 'A'";
                                    $objq_songslow = mysqli_query($conn,$sql_songslow);
                                    while($value =  $objq_songslow->fetch_assoc()){
                                  ?>
                                  <tr> 
                                    <td class="text-center">
                                      <?php
                                        if(!empty($value['ad_song'])){
                                      ?>
                                      <a href="song_listen.php?id_song=<?php echo $value['id_song'];?>&&id_age=<?php echo $value['id_age']; ?>&&status=old" class="btn  btn-success btn-xs">ฟัง</a>
                                      <?php }else{}?>
                                    </td>
                                    <td class="text-center"><?php echo $value['name_artist'];?></td>
                                    <td class="text-center"><?php echo $value['name_song']; ?></td>
                                    <td class="text-center"><?php echo $value['name_tune']; ?></td> 
                                    <td class="text-center"><?php if($value['script']=='N'){echo "-";}else{echo "ต้นฉบับ";} ?></td>
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
                        <div align="center" class="box-footer">
                          
                        </div>
                      </div>

                      <div class="tab-pane" id="B">
                        <div align="center" class="box-footer">
                          <font size="5">
                          <B align="center">นักร้องยุคกลาง (B)</B>
                          </font>
                        </div>
                        <div class="box-body">
                          <div class="mailbox-read-message">
                            <div class="col-12">
                              <table id="example2" class="table">
                                <thead>
                                  <tr>
                                    <th class="text-center" width="10%">#</th>
                                    <th class="text-center" width="27%">นักร้อง</th>
                                    <th class="text-center" width="27%">ชื่อเพลง</th>
                                    <th class="text-center" width="10%">ทำนอง</th>
                                    <th class="text-center" width="13%">ต้นฉบับ</th>
                                    <th class="text-center" width="13%">เปิด</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                    $sql_songslow = "SELECT * FROM song_list
                                                  INNER JOIN song_artist ON song_list.id_artist = song_artist.id_artist
                                                  INNER JOIN song_tune ON song_list.id_tune = song_tune.id_tune
                                                  WHERE song_artist.id_ageartist = 2 AND song_list.melodic = 'B'";
                                    $objq_songslow = mysqli_query($conn,$sql_songslow);
                                    while($value =  $objq_songslow->fetch_assoc()){
                                  ?>
                                  <tr> 
                                    <td class="text-center">
                                      <?php
                                        if(!empty($value['ad_song'])){
                                      ?>
                                     <a href="song_listen.php?id_song=<?php echo $value['id_song'];?>&&id_age=<?php echo $value['id_age']; ?>&&status=old" class="btn  btn-success btn-xs">ฟัง</a>
                                      <?php }else{}?>
                                    </td>
                                    <td class="text-center"><?php echo $value['name_artist'];?></td>
                                    <td class="text-center"><?php echo $value['name_song']; ?></td>
                                    <td class="text-center"><?php echo $value['name_tune']; ?></td> 
                                    <td class="text-center"><?php if($value['script']=='N'){echo "-";}else{echo "ต้นฉบับ";} ?></td>
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
                        <div align="center" class="box-footer">
                        </div>
                      </div>

                      <div class="tab-pane" id="C">
                        <div align="center" class="box-footer">
                          <font size="5">
                            <B align="center">นักร้องยุคกลาง (C)</B>
                          </font>
                        </div>
                        <div class="box-body">
                          <div class="mailbox-read-message">
                            <div class="col-12">
                              <table id="example3" class="table">
                                <thead>
                                  <tr>
                                    <th class="text-center" width="10%">#</th>
                                    <th class="text-center" width="27%">นักร้อง</th>
                                    <th class="text-center" width="27%">ชื่อเพลง</th>
                                    <th class="text-center" width="10%">ทำนอง</th>
                                    <th class="text-center" width="13%">ต้นฉบับ</th>
                                    <th class="text-center" width="13%">เปิด</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                    $sql_songslow = "SELECT * FROM song_list
                                                  INNER JOIN song_artist ON song_list.id_artist = song_artist.id_artist
                                                  INNER JOIN song_tune ON song_list.id_tune = song_tune.id_tune
                                                  WHERE song_artist.id_ageartist = 2 AND song_list.melodic='C'";
                                    $objq_songslow = mysqli_query($conn,$sql_songslow);
                                    while($value =  $objq_songslow->fetch_assoc()){
                                  ?>
                                  <tr> 
                                    <td class="text-center">
                                      <?php
                                        if(!empty($value['ad_song'])){
                                      ?>
                                      <a href="song_listen.php?id_song=<?php echo $value['id_song'];?>&&id_age=<?php echo $value['id_age']; ?>&&status=old" class="btn  btn-success btn-xs">ฟัง</a>
                                      <?php }else{}?>
                                    </td>
                                    <td class="text-center"><?php echo $value['name_artist'];?></td>
                                    <td class="text-center"><?php echo $value['name_song']; ?></td>
                                    <td class="text-center"><?php echo $value['name_tune']; ?></td> 
                                    <td class="text-center"><?php if($value['script']=='N'){echo "-";}else{echo "ต้นฉบับ";} ?></td>
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
                        <div align="center" class="box-footer">
                        </div>
                      </div>

                      <div class="tab-pane" id="D">
                        <div align="center" class="box-footer">
                          <font size="5">
                            <B align="center">นักร้องยุคกลาง (D)</B>
                          </font>
                        </div>
                        <div class="box-body">
                          <div class="mailbox-read-message">
                            <div class="col-12">
                              <table id="example4" class="table">
                                <thead>
                                  <tr>
                                    <th class="text-center" width="10%">#</th>
                                    <th class="text-center" width="27%">นักร้อง</th>
                                    <th class="text-center" width="27%">ชื่อเพลง</th>
                                    <th class="text-center" width="10%">ทำนอง</th>
                                    <th class="text-center" width="13%">ต้นฉบับ</th>
                                    <th class="text-center" width="13%">เปิด</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                    $sql_songslow = "SELECT * FROM song_list
                                                  INNER JOIN song_artist ON song_list.id_artist = song_artist.id_artist
                                                  INNER JOIN song_tune ON song_list.id_tune = song_tune.id_tune
                                                  WHERE song_artist.id_ageartist = 2 AND song_list.melodic='D'";
                                    $objq_songslow = mysqli_query($conn,$sql_songslow);
                                    while($value =  $objq_songslow->fetch_assoc()){
                                  ?>
                                  <tr> 
                                    <td class="text-center">
                                      <?php
                                        if(!empty($value['ad_song'])){
                                      ?>
                                      <a href="song_listen.php?id_song=<?php echo $value['id_song'];?>&&id_age=<?php echo $value['id_age']; ?>&&status=old" class="btn  btn-success btn-xs">ฟัง</a>
                                      <?php }else{}?>
                                    </td>
                                    <td class="text-center"><?php echo $value['name_artist'];?></td>
                                    <td class="text-center"><?php echo $value['name_song']; ?></td>
                                    <td class="text-center"><?php echo $value['name_tune']; ?></td> 
                                    <td class="text-center"><?php if($value['script']=='N'){echo "-";}else{echo "ต้นฉบับ";} ?></td>
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
                        <div align="center" class="box-footer">
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="box-footer text-center">
                  
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