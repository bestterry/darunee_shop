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
        <div class="row">
          <div class="col-12 col-sm-12 col-md-12 col-xl-12">
            <?php require 'menu/menu.php'; ?>

            <div class="col-10 col-sm-10 col-md-10 col-xl-10">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <div class="text-center">
                    <font size="5">
                      <B align="center"> เพลงยุคเก่า <font color="red"> </font></B>
                    </font>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <div class="mailbox-read-message">
                    <div class="nav-tabs-custom">
                      <ul class="nav nav-tabs">
                        <li class="active"><a href="#slow" data-toggle="tab">ช้า</a></li>
                        <li><a href="#middle" data-toggle="tab">เพลิน</a></li>
                        <li><a href="#fast" data-toggle="tab">เร็ว</a></li>
                      </ul> 
                      <div class="tab-content">

                        <div class="tab-pane active" id="slow">
                          <div align="center" class="box-footer">
                            <font size="5">
                              <B align="center">ทำนองช้า</B>
                            </font>
                          </div>
                          <div class="box-body">
                            <div class="mailbox-read-message">
                              <div class="col-12">
                                <table id="example1" class="table">
                                  <thead>
                                    <tr>
                                      <th class="text-center" width="5%">สถานะ</th>
                                      <th class="text-center" width="5%">ฟัง</th>
                                      <th class="text-center" width="21%">นักร้อง</th>
                                      <th class="text-center" width="20%">ชื่อเพลง</th>
                                      <th class="text-center" width="11%">ยุค</th>
                                      <th class="text-center" width="11%">ทำนอง</th>
                                      <th class="text-center" width="11%">ต้นฉบับ</th>
                                      <th class="text-center" width="11%">เกรด</th>
                                      <th class="text-center" width="5%">แก้ไข</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php 
                                      $sql_songslow = "SELECT * FROM song_list
                                                    INNER JOIN song_artist ON song_list.id_artist = song_artist.id_artist
                                                    INNER JOIN song_tune ON song_list.id_tune = song_tune.id_tune
                                                    INNER JOIN song_age ON song_list.id_age = song_age.id_age
                                                    WHERE song_list.id_age = 1 AND song_list.id_tune = 1";
                                      $objq_songslow = mysqli_query($conn,$sql_songslow);
                                      while($value =  $objq_songslow->fetch_assoc()){
                                    ?>
                                    <tr> 
                                      <?php
                                        if($value['status']=='N'){
                                      ?>
                                        <td class="text-center"></td>
                                      <?php
                                        }else{
                                      ?>
                                      <td class="text-center"><font>เปิด</font></td>
                                      <?php 
                                        }
                                      ?>
                                      <td class="text-center">
                                        <?php
                                          if(!empty($value['ad_song'])){
                                        ?>
                                        <a href="song_listen.php?id_song=<?php echo $value['id_song'];?>&&id_age=<?php echo $value['id_age'];; ?>" class="btn  btn-success btn-xs" target="_blank">ฟัง</a>
                                        <?php }else{}?>
                                      </td>
                                      <td class="text-center"><?php echo $value['name_artist'];?></td>
                                      <td class="text-center"><?php echo $value['name_song']; ?></td>
                                      <td class="text-center"><?php echo $value['name_age']; ?></td>
                                      <td class="text-center"><?php echo $value['name_tune']; ?></td>
                                      <td class="text-center"><?php if($value['script']=='N'){echo " ";}else{echo "Y";} ?></td>
                                      <td class="text-center"><?php echo $value['melodic']; ?></td> 
                                      <td class="text-center">
                                        <a href="song_edit.php?id_song=<?php echo $value['id_song']; ?>&&id_age=<?php echo $value['id_age'];?>" class="btn  btn-success btn-xs" >แก้</a>
                                      </td>   
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

                        <div class="tab-pane" id="middle">
                          <div align="center" class="box-footer">
                            <font size="5">
                              <B align="center">ทำนองเพลิน</B>
                            </font>
                          </div>
                          <div class="box-body">
                            <div class="mailbox-read-message">
                              <div class="col-12">
                                <div class="row">
                                  <table id="example2" class="table">
                                    <thead>
                                      <tr>
                                        <th class="text-center" width="5%">สถานะ</th>
                                        <th class="text-center" width="5%">ฟัง</th>
                                        <th class="text-center" width="21%">นักร้อง</th>
                                        <th class="text-center" width="20%">ชื่อเพลง</th>
                                        <th class="text-center" width="11%">ยุค</th>
                                        <th class="text-center" width="11%">ทำนอง</th>
                                        <th class="text-center" width="11%">ต้นฉบับ</th>
                                        <th class="text-center" width="11%">เกรด</th>
                                        <th class="text-center" width="5%">แก้ไข</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                        $sql_songslow = "SELECT * FROM song_list
                                                      INNER JOIN song_artist ON song_list.id_artist = song_artist.id_artist
                                                      INNER JOIN song_tune ON song_list.id_tune = song_tune.id_tune
                                                      INNER JOIN song_age ON song_list.id_age = song_age.id_age
                                                      WHERE song_list.id_age = 1 AND song_list.id_tune = 2";
                                        $objq_songslow = mysqli_query($conn,$sql_songslow);
                                        while($value =  $objq_songslow->fetch_assoc()){
                                      ?>
                                      <tr> 
                                        <?php
                                          if($value['status']=='N'){
                                        ?>
                                          <td class="text-center"></td>
                                        <?php
                                          }else{
                                        ?>
                                        <td class="text-center"><font>เปิด</font></td>
                                        <?php 
                                          }
                                        ?>
                                        <td class="text-center">
                                          <?php
                                            if(!empty($value['ad_song'])){
                                          ?>
                                          <a href="song_listen.php?id_song=<?php echo $value['id_song'];?>&&id_age=<?php echo $value['id_age'];; ?>" class="btn  btn-success btn-xs" target="_blank">ฟัง</a>
                                          <?php }else{}?>
                                        </td>
                                        <td class="text-center"><?php echo $value['name_artist'];?></td>
                                        <td class="text-center"><?php echo $value['name_song']; ?></td>
                                        <td class="text-center"><?php echo $value['name_age']; ?></td>
                                        <td class="text-center"><?php echo $value['name_tune']; ?></td>
                                        <td class="text-center"><?php if($value['script']=='N'){echo " ";}else{echo "Y";} ?></td>
                                        <td class="text-center"><?php echo $value['melodic']; ?></td> 
                                        <td class="text-center">
                                          <a href="song_edit.php?id_song=<?php echo $value['id_song']; ?>&&id_age=<?php echo $value['id_age'];?>" class="btn  btn-success btn-xs" >แก้</a>
                                        </td>   
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
                          <div align="center" class="box-footer">
                          </div>
                        </div>

                        <div class="tab-pane" id="fast">
                          <div align="center" class="box-footer">
                            <font size="5">
                              <B align="center">ทำนองเร็ว</B>
                            </font>
                          </div>
                          <div class="box-body">
                            <div class="mailbox-read-message">
                              <div class="col-12">
                                <div class="row">
                                  <table id="example3" class="table">
                                    <thead>
                                      <tr>
                                        <th class="text-center" width="5%">สถานะ</th>
                                        <th class="text-center" width="5%">ฟัง</th>
                                        <th class="text-center" width="21%">นักร้อง</th>
                                        <th class="text-center" width="20%">ชื่อเพลง</th>
                                        <th class="text-center" width="11%">ยุค</th>
                                        <th class="text-center" width="11%">ทำนอง</th>
                                        <th class="text-center" width="11%">ต้นฉบับ</th>
                                        <th class="text-center" width="11%">เกรด</th>
                                        <th class="text-center" width="5%">แก้ไข</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                        $sql_songslow = "SELECT * FROM song_list
                                                      INNER JOIN song_artist ON song_list.id_artist = song_artist.id_artist
                                                      INNER JOIN song_tune ON song_list.id_tune = song_tune.id_tune
                                                      INNER JOIN song_age ON song_list.id_age = song_age.id_age
                                                      WHERE song_list.id_age = 1 AND song_list.id_tune = 3";
                                        $objq_songslow = mysqli_query($conn,$sql_songslow);
                                        while($value =  $objq_songslow->fetch_assoc()){
                                      ?>
                                      <tr> 
                                        <?php
                                          if($value['status']=='N'){
                                        ?>
                                          <td class="text-center"></td>
                                        <?php
                                          }else{
                                        ?>
                                        <td class="text-center"><font>เปิด</font></td>
                                        <?php 
                                          }
                                        ?>
                                        <td class="text-center">
                                          <?php
                                            if(!empty($value['ad_song'])){
                                          ?>
                                          <a href="song_listen.php?id_song=<?php echo $value['id_song'];?>&&id_age=<?php echo $value['id_age'];; ?>" class="btn  btn-success btn-xs" target="_blank">ฟัง</a>
                                          <?php }else{}?>
                                        </td>
                                        <td class="text-center"><?php echo $value['name_artist'];?></td>
                                        <td class="text-center"><?php echo $value['name_song']; ?></td>
                                        <td class="text-center"><?php echo $value['name_age']; ?></td>
                                        <td class="text-center"><?php echo $value['name_tune']; ?></td>
                                        <td class="text-center"><?php if($value['script']=='N'){echo " ";}else{echo "Y";} ?></td>
                                        <td class="text-center"><?php echo $value['melodic']; ?></td> 
                                        <td class="text-center">
                                          <a href="song_edit.php?id_song=<?php echo $value['id_song']; ?>&&id_age=<?php echo $value['id_age'];?>" class="btn  btn-success btn-xs" >แก้</a>
                                        </td>   
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
        </div>
      </section>
    </div>
  <?php require "menu/script.php"; ?>
  </body>

</html>