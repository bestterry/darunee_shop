<?php
  require "../config_database/config.php";
  require "../session.php";
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
                <a href="song_setting.php"> เพลง </a>
                <a href="song_original.php"> ต้นฉบับ </a>
                <a href="song_old.php"> เก่า </a>
                <a href="song_middle.php"></i> กลาง </a>
                <a href="song_new.php"> ใหม่ </a>
                <a href="song_coeval.php"> ร่วมสมัย </a>
                <a href="song_forlife.php"> ลูกทุ่งเพื่อชีวิต </a>
                <a href="gradea.php"> A </a>
                <a href="gradeb.php"> B </a>
                <a href="gradec.php"> C </a>
                <a class="active" href="graded.php"> D </a>
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
          <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box box-primary">
              <div class="box-body no-padding">
                <div class="mailbox-read-message">
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#old" data-toggle="tab">เก่า</a></li>
                      <li><a href="#middle" data-toggle="tab">กลาง</a></li>
                      <li><a href="#new" data-toggle="tab">ใหม่</a></li>
                      <li><a href="#coevel" data-toggle="tab">ร่วมสมัย</a></li>
                      <li><a href="#forlife" data-toggle="tab">ลูกทุ่งเพื่อชีวิต</a></li>
                      <a class="btn btn-danger pull-right" href="algorithm/update_status2.php?grade=D"> เปลี่ยนสถานะเปิด </a>
                    </ul> 
                    <div class="tab-content">

                      <div class="tab-pane active" id="old">
                        <div align="center" class="box-footer">
                          <font size="5">
                            <B align="center"> นักร้องเก่า (D)</B>
                          </font>
                        </div>
                        <div class="box-body">
                          <div class="mailbox-read-message">
                            <div class="col-12">
                              <table id="example1" class="table">
                                <thead>
                                  <tr>
                                    <th class="text-center" width="24%">ชื่อเพลง</th>
                                    <th class="text-center" width="24%">นักร้อง</th>
                                    <th class="text-center" width="10%">ทำนอง</th>
                                    <th class="text-center" width="12%">ต้นฉบับ</th>
                                    <th class="text-center" width="10%">#</th>
                                    <th class="text-center" width="10%">#</th>
                                    <th class="text-center" width="10%">#</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                    $sql_songslow = "SELECT * FROM song_list
                                                     INNER JOIN song_artist ON song_list.id_artist = song_artist.id_artist
                                                     INNER JOIN song_tune ON song_list.id_tune = song_tune.id_tune
                                                     INNER JOIN member ON song_list.id_member = member.id_member
                                                     WHERE song_artist.id_ageartist = 1 AND song_list.melodic = 'D'
                                                     ORDER BY CONVERT (song_list.name_song USING tis620 ) ASC";
                                    $objq_songslow = mysqli_query($conn,$sql_songslow);
                                    while($value =  $objq_songslow->fetch_assoc()){
                                  ?>
                                  <tr> 
                                    <td class="text-center"><?php echo $value['name_song'];?></td>
                                    <td class="text-center"><?php echo $value['name_artist']; ?></td>
                                    <td class="text-center"><?php echo $value['name_tune']; ?></td> 
                                    <td class="text-center"><?php if($value['script']=='N'){echo "-";}else{echo "ต้นฉบับ";} ?></td>
                                    <td class="text-center">
                                      <?php
                                        if(!empty($value['ad_song'])){
                                      ?>
                                      <input type="button" name="ฟัง" value="ฟัง" id="<?php echo $value["id_song"]; ?>" class="btn btn-success btn-xs view_data" />
                                      <?php }else{}?>
                                    </td>
                                    <td class="text-center">
                                      <a href="song_edit.php?id_song=<?php echo $value['id_song']; ?>&&age=d" class="btn btn-success btn-xs">>></a>
                                    </td>
                                    <?php
                                      if($value['id_member']==54){
                                      ?>
                                      <td class="text-center">
                                        <a href="algorithm/song_editstatusopen.php?id_song=<?php echo $value['id_song']; ?>&&id_member=<?php echo $id_member;?>&&status=d" class="btn btn-success btn-xs">เปิด</a>
                                      </td>
                                      <?php
                                        }else{
                                      ?>
                                      <td class="text-center"><font><?php echo $value['name']; ?></font></td>
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

                      <div class="tab-pane" id="middle">
                        <div align="center" class="box-footer">
                          <font size="5">
                          <B align="center"> นักร้องยุคกลาง (D)</B>
                          </font>
                        </div>
                        <div class="box-body">
                          <div class="mailbox-read-message">
                            <div class="col-12">
                              <table id="example2" class="table">
                                <thead>
                                  <tr>
                                    <th class="text-center" width="24%">ชื่อเพลง</th>
                                    <th class="text-center" width="24%">นักร้อง</th>
                                    <th class="text-center" width="10%">ทำนอง</th>
                                    <th class="text-center" width="12%">ต้นฉบับ</th>
                                    <th class="text-center" width="10%">#</th>
                                    <th class="text-center" width="10%">#</th>
                                    <th class="text-center" width="10%">#</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                    $sql_songslow = "SELECT * FROM song_list
                                                     INNER JOIN song_artist ON song_list.id_artist = song_artist.id_artist
                                                     INNER JOIN song_tune ON song_list.id_tune = song_tune.id_tune
                                                     INNER JOIN member ON song_list.id_member = member.id_member
                                                     WHERE song_artist.id_ageartist = 2 AND song_list.melodic = 'D'
                                                     ORDER BY CONVERT (song_list.name_song USING tis620 ) ASC";
                                    $objq_songslow = mysqli_query($conn,$sql_songslow);
                                    while($value =  $objq_songslow->fetch_assoc()){
                                  ?>
                                  <tr> 
                                    <td class="text-center"><?php echo $value['name_song'];?></td>
                                    <td class="text-center"><?php echo $value['name_artist']; ?></td>
                                    <td class="text-center"><?php echo $value['name_tune']; ?></td> 
                                    <td class="text-center"><?php if($value['script']=='N'){echo "-";}else{echo "ต้นฉบับ";} ?></td>
                                    <td class="text-center">
                                      <?php
                                        if(!empty($value['ad_song'])){
                                      ?>
                                      <input type="button" name="ฟัง" value="ฟัง" id="<?php echo $value["id_song"]; ?>" class="btn btn-success btn-xs view_data" />
                                       <?php }else{}?>
                                    </td>
                                    <td class="text-center">
                                      <a href="song_edit.php?id_song=<?php echo $value['id_song']; ?>&&age=d" class="btn btn-success btn-xs">>></a>
                                    </td>
                                    <?php
                                      if($value['id_member']==54){
                                      ?>
                                      <td class="text-center">
                                        <a href="algorithm/song_editstatusopen.php?id_song=<?php echo $value['id_song']; ?>&&id_member=<?php echo $id_member;?>&&status=d" class="btn btn-success btn-xs">เปิด</a>
                                      </td>
                                      <?php
                                        }else{
                                      ?>
                                      <td class="text-center"><font><?php echo $value['name']; ?></font></td>
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

                      <div class="tab-pane" id="new">
                        <div align="center" class="box-footer">
                          <font size="5">
                            <B align="center">นักร้องใหม่ (D)</B>
                          </font>
                        </div>
                        <div class="box-body">
                          <div class="mailbox-read-message">
                            <div class="col-12">
                              <table id="example3" class="table">
                                <thead>
                                  <tr>
                                    <th class="text-center" width="24%">ชื่อเพลง</th>
                                    <th class="text-center" width="24%">นักร้อง</th>
                                    <th class="text-center" width="10%">ทำนอง</th>
                                    <th class="text-center" width="12%">ต้นฉบับ</th>
                                    <th class="text-center" width="10%">#</th>
                                    <th class="text-center" width="10%">#</th>
                                    <th class="text-center" width="10%">#</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                    $sql_songslow = "SELECT * FROM song_list
                                                     INNER JOIN song_artist ON song_list.id_artist = song_artist.id_artist
                                                     INNER JOIN song_tune ON song_list.id_tune = song_tune.id_tune
                                                     INNER JOIN member ON song_list.id_member = member.id_member
                                                     WHERE song_artist.id_ageartist = 3 AND song_list.melodic = 'D'
                                                     ORDER BY CONVERT (song_list.name_song USING tis620 ) ASC";
                                    $objq_songslow = mysqli_query($conn,$sql_songslow);
                                    while($value =  $objq_songslow->fetch_assoc()){
                                  ?>
                                  <tr> 
                                    <td class="text-center"><?php echo $value['name_song'];?></td>
                                    <td class="text-center"><?php echo $value['name_artist']; ?></td>
                                    <td class="text-center"><?php echo $value['name_tune']; ?></td> 
                                    <td class="text-center"><?php if($value['script']=='N'){echo "-";}else{echo "ต้นฉบับ";} ?></td>
                                    <td class="text-center">
                                      <?php
                                        if(!empty($value['ad_song'])){
                                      ?>
                                      <input type="button" name="ฟัง" value="ฟัง" id="<?php echo $value["id_song"]; ?>" class="btn btn-success btn-xs view_data" />
                                      <?php }else{}?>
                                    </td>
                                    <td class="text-center">
                                      <a href="song_edit.php?id_song=<?php echo $value['id_song']; ?>&&age=d" class="btn btn-success btn-xs">>></a>
                                    </td>
                                    <?php
                                      if($value['id_member']==54){
                                      ?>
                                      <td class="text-center">
                                        <a href="algorithm/song_editstatusopen.php?id_song=<?php echo $value['id_song']; ?>&&id_member=<?php echo $id_member;?>&&status=d" class="btn btn-success btn-xs">เปิด</a>
                                      </td>
                                      <?php
                                        }else{
                                      ?>
                                      <td class="text-center"><font><?php echo $value['name']; ?></font></td>
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

                      <div class="tab-pane" id="coevel">
                        <div align="center" class="box-footer">
                          <font size="5">
                            <B align="center">นักร้องร่วมสมัย (ฺD)</B>
                          </font>
                        </div>
                        <div class="box-body">
                          <div class="mailbox-read-message">
                            <div class="col-12">
                              <table id="example3" class="table">
                                <thead>
                                  <tr>
                                    <th class="text-center" width="24%">ชื่อเพลง</th>
                                    <th class="text-center" width="24%">นักร้อง</th>
                                    <th class="text-center" width="10%">ทำนอง</th>
                                    <th class="text-center" width="12%">ต้นฉบับ</th>
                                    <th class="text-center" width="10%">#</th>
                                    <th class="text-center" width="10%">#</th>
                                    <th class="text-center" width="10%">#</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                    $sql_songslow = "SELECT * FROM song_list
                                                     INNER JOIN song_artist ON song_list.id_artist = song_artist.id_artist
                                                     INNER JOIN song_tune ON song_list.id_tune = song_tune.id_tune
                                                     INNER JOIN member ON song_list.id_member = member.id_member
                                                     WHERE song_artist.id_ageartist = 4 AND song_list.melodic = 'D'
                                                     ORDER BY CONVERT (song_list.name_song USING tis620 ) ASC";
                                    $objq_songslow = mysqli_query($conn,$sql_songslow);
                                    while($value =  $objq_songslow->fetch_assoc()){
                                  ?>
                                  <tr> 
                                    <td class="text-center"><?php echo $value['name_song'];?></td>
                                    <td class="text-center"><?php echo $value['name_artist']; ?></td>
                                    <td class="text-center"><?php echo $value['name_tune']; ?></td> 
                                    <td class="text-center"><?php if($value['script']=='N'){echo "-";}else{echo "ต้นฉบับ";} ?></td>
                                    <td class="text-center">
                                      <?php
                                        if(!empty($value['ad_song'])){
                                      ?>
                                      <input type="button" name="ฟัง" value="ฟัง" id="<?php echo $value["id_song"]; ?>" class="btn btn-success btn-xs view_data" />
                                      <?php }else{}?>
                                    </td>
                                    <td class="text-center">
                                      <a href="song_edit.php?id_song=<?php echo $value['id_song']; ?>&&age=d" class="btn btn-success btn-xs">>></a>
                                    </td>
                                    <?php
                                      if($value['id_member']==54){
                                      ?>
                                      <td class="text-center">
                                        <a href="algorithm/song_editstatusopen.php?id_song=<?php echo $value['id_song']; ?>&&id_member=<?php echo $id_member;?>&&status=d" class="btn btn-success btn-xs">เปิด</a>
                                      </td>
                                      <?php
                                        }else{
                                      ?>
                                      <td class="text-center"><font><?php echo $value['name']; ?></font></td>
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

                      <div class="tab-pane" id="forlife">
                        <div align="center" class="box-footer">
                          <font size="5">
                            <B align="center">นักร้องลูกทุ่งเพื่อชีวิต (D)</B>
                          </font>
                        </div>
                        <div class="box-body">
                          <div class="mailbox-read-message">
                            <div class="col-12">
                              <table id="example3" class="table">
                                <thead>
                                  <tr>
                                    <th class="text-center" width="24%">ชื่อเพลง</th>
                                    <th class="text-center" width="24%">นักร้อง</th>
                                    <th class="text-center" width="10%">ทำนอง</th>
                                    <th class="text-center" width="12%">ต้นฉบับ</th>
                                    <th class="text-center" width="10%">#</th>
                                    <th class="text-center" width="10%">#</th>
                                    <th class="text-center" width="10%">#</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                    $sql_songslow = "SELECT * FROM song_list
                                                     INNER JOIN song_artist ON song_list.id_artist = song_artist.id_artist
                                                     INNER JOIN song_tune ON song_list.id_tune = song_tune.id_tune
                                                     INNER JOIN member ON song_list.id_member = member.id_member
                                                     WHERE song_artist.id_ageartist = 5 AND song_list.melodic = 'D'
                                                     ORDER BY CONVERT (song_list.name_song USING tis620 ) ASC";
                                    $objq_songslow = mysqli_query($conn,$sql_songslow);
                                    while($value =  $objq_songslow->fetch_assoc()){
                                  ?>
                                  <tr> 
                                    <td class="text-center"><?php echo $value['name_song'];?></td>
                                    <td class="text-center"><?php echo $value['name_artist']; ?></td>
                                    <td class="text-center"><?php echo $value['name_tune']; ?></td> 
                                    <td class="text-center"><?php if($value['script']=='N'){echo "-";}else{echo "ต้นฉบับ";} ?></td>
                                    <td class="text-center">
                                      <?php
                                        if(!empty($value['ad_song'])){
                                      ?>
                                      <input type="button" name="ฟัง" value="ฟัง" id="<?php echo $value["id_song"]; ?>" class="btn btn-success btn-xs view_data" />
                                      <?php }else{}?>
                                    </td>
                                    <td class="text-center">
                                      <a href="song_edit.php?id_song=<?php echo $value['id_song']; ?>&&age=d" class="btn btn-success btn-xs">>></a>
                                    </td>
                                    <?php
                                      if($value['id_member']==54){
                                      ?>
                                      <td class="text-center">
                                        <a href="algorithm/song_editstatusopen.php?id_song=<?php echo $value['id_song']; ?>&&id_member=<?php echo $id_member;?>&&status=d" class="btn btn-success btn-xs">เปิด</a>
                                      </td>
                                      <?php
                                        }else{
                                      ?>
                                      <td class="text-center"><font><?php echo $value['name']; ?></font></td>
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
  <div id="dataModal" class="modal fade">  
        <div class="modal-dialog">  
            <div class="modal-content">  
                  <div class="modal-header">  
                      <button type="button" class="close" data-dismiss="modal">&times;</button>  
                      <h4 class="modal-title"></h4>  
                  </div>  
                  <div class="modal-body" id="listen_music">  
                  </div>  
                  <div class="modal-footer">  
                      <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>  
                  </div>  
            </div>  
        </div>  
  </div>  
  <script>  
  $(document).ready(function(){  
        $('.view_data').click(function(){  
            var id_song = $(this).attr("id");  
            $.ajax({  
                  url:"select_song.php",  
                  method:"post",  
                  data:{id_song:id_song},  
                  success:function(data){  
                      $('#listen_music').html(data);  
                      $('#dataModal').modal("show");  
                  }  
            });  
        });  
  });  
  </script>