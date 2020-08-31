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
                <a class="active" href="song_setting.php"> เพลง </a>
                <a href="artist_setting.php"> นักร้อง </a>
                <a  href="song_old.php"> เก่า </a>
                <a href="song_middle.php"></i> กลาง </a>
                <a href="song_new.php"> ใหม่ </a>
                <a href="gradea.php"> A </a>
                <a href="gradeb.php"> B </a>
                <a href="gradec.php"> C </a>
                <a href="graded.php"> D </a>
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
                  <div class="box-header">
                    <div class="col-12">
                      <div class="col-2 col-sm-2 col-xl-2 col-md-2">
                        
                      </div>
                      <div class="col-8 col-sm-8 col-xl-8 col-md-8 text-center">
                        <font size="5">
                          <B align="center">ตั้งค่าเพลง</B>
                        </font>
                      </div>
                      <div class="col-2 col-sm-2 col-xl-2 col-md-2 text-right">
                        <a type="button"href="#" data-toggle="modal" data-target="#add_song" class="btn btn-success" style="color:black;">เพิ่มเพลง</a>
                      </div>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="mailbox-read-message">
                      <div class="col-12">
                        <div class="row">
                          <table id="example2" class="table">
                            <thead>
                              <tr>
                                <!-- <th class="text-center" width="8%">#</th> -->
                                <th class="text-center" width="8%">ยุค</th>
                                <th class="text-center" width="27%">นักร้อง</th>
                                <th class="text-center" width="27%">ชื่อเพลง</th>
                                <th class="text-center" width="8%">เกรด</th>
                                <th class="text-center" width="8%">ทำนอง</th>
                                <th class="text-center" width="8%">ต้นฉบับ</th> 
                                <th class="text-center" width="6%">#</th>
                                <th class="text-center" width="8%">เปิด</th>
                                <!-- <th class="text-center" width="6%">#</th>  -->
                              </tr>
                            </thead>
                            <tbody>
                              <?php 
                                $sql_artist = "SELECT id_artist,name_artist,name_ageartist FROM song_artist 
                                                INNER JOIN song_ageartist ON song_artist.id_ageartist = song_ageartist.id_ageartist ";
                                $objq_artist = mysqli_query($conn,$sql_artist);
                                while($value =  $objq_artist->fetch_assoc()){
                                  $id_artist = $value['id_artist'];
                                  $name_artist = $value['name_artist'];
                                  $name_ageartist = $value['name_ageartist'];
                                  $sql_song = "SELECT * FROM  song_list
                                                  INNER JOIN song_tune ON song_list.id_tune = song_tune.id_tune
                                                  WHERE song_list.id_artist = $id_artist";
                                $objq_song = mysqli_query($conn,$sql_song);
                                while($value_song =  $objq_song->fetch_assoc()){
                              ?>
                              <tr> 
                                  
                                <td class="text-center"><?php echo $name_ageartist; ?></td>
                                <td class="text-center"><?php echo $name_artist; ?></td>
                                <td class="text-center"><?php echo $value_song['name_song']; ?></td>
                                <td class="text-center"><?php echo $value_song['melodic']; ?></td> 
                                <td class="text-center"><?php echo $value_song['name_tune'];?></td>
                                <td class="text-center"><?php if($value_song['script']=='N'){echo "-";}else{echo "ต้นฉบับ";} ?></td>
                                <td class="text-center">
                                  <a href="song_edit4.php?id_song=<?php echo $value_song['id_song'];?>&&id_age=<?php echo $value_song['id_age'];?>" class="btn  btn-success btn-xs" >แก้</a>
                                </td> 
                                <?php
                                  if($value_song['status']=='N'){
                                ?>
                                  <td class="text-center">-</td>
                                <?php
                                  }else{
                                ?>
                                <td class="text-center"><font>เปิด</font></td>
                                <?php 
                                  }
                                ?> 
                                <!-- <td class="text-center">
                                  <a href="algorithm/delete_song.php?id_song=<?php echo $value_song['id_song'];?>" class="btn  btn-danger btn-xs" OnClick="return confirm('ต้องการลบรายการเพลงหรือไม่ ?')";>ลบ</a>
                                </td>  -->
                              </tr>
                              <?php 
                                  }
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
                <div class="box-footer text-center">
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <div class="modal fade" id="add_song" role="dialog">
        <div class="modal-dialog modal-lg">
          <form action="algorithm/add_song.php" method="post">
            <div class="modal-content">
              <div class="modal-header text-center">
                  <font size="5"><B> เพิ่มเพลง </B></font>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-12">
                    <div class="col-3 col-sm-3 col-xl-3 col-md-3"></div>
                    <div class="col-6 col-sm-6 col-xl-6 col-md-6">
                      <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <th class="text-center" width="30%"><font size="4">ชื่อเพลง</font></th>
                            <th class="text-center" width="70%"> 
                              <input type="text" name="name_song" class="form-control" style="width: 100%;">
                            </th>
                          </tr>
                          <tr>  
                            <th class="text-center" width="30%"><font size="4">นักร้อง</font></th>
                            <th class="text-center" width="70%"> 
                              <select name="id_artist" class=" form-control" style="width: 100%;">
                                <option value="">-- เลือกศิลปิน --</option>
                                <?php 
                                  $sql_artist = "SELECT id_artist,name_artist FROM song_artist";
                                  $objq_artist = mysqli_query($conn,$sql_artist);
                                  while($value_artist = $objq_artist->fetch_assoc()){
                                ?>
                                <option value="<?php echo $value_artist['id_artist'];?>"><?php echo $value_artist['name_artist'];?></option>
                                <?php    
                                  }
                                ?>
                              </select>
                            </th>
                          </tr>
                          <tr>
                            <th class="text-center" width="30%"><font size="4">ทำนอง</font></th>
                            <th class="text-center" width="70%"> 
                            <select name="id_tune" class=" form-control" style="width: 100%;">
                                <option value="">-- เลือกทำนอง --</option>
                                <?php 
                                  $sql_tune = "SELECT id_tune,name_tune FROM song_tune";
                                  $objq_tune = mysqli_query($conn,$sql_tune);
                                  while($value_tune = $objq_tune->fetch_assoc()){
                                ?>
                                <option value="<?php echo $value_tune['id_tune'];?>"><?php echo $value_tune['name_tune'];?></option>
                                <?php    
                                  }
                                ?>
                              </select>
                            </th>
                          </tr>
                          <tr>
                            <th class="text-center" width="30%"><font size="4">ต้นฉบับ</font></th>
                            <th class="text-center" width="70%"> 
                            <select name="script" class=" form-control" style="width: 100%;">
                                <option value="">-- เลือกต้นฉบับ --</option>
                                <option value="Y">ใช่</option>
                                <option value="N">ไม่ใช่</option>
                              </select>
                            </th>
                          </tr>
                          <tr>
                            <th class="text-center" width="30%"><font size="4">เกรด</font></th>
                            <th class="text-center" width="70%"> 
                            <select name="melodic" class=" form-control" style="width: 100%;">
                                <option value="">-- เลือกเกรด --</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                              </select>
                            </th>
                          </tr>
                        </tbody>
                      </table> 
                    </div>
                    <div class="col-3 col-sm-3 col-xl-3 col-md-3"></div>
                    
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit"  class="btn btn-success pull-right" OnClick="return confirm('ต้องการบันทึกรายการเพลงหรือไม่ ?')";>บันทึก</button>
                <button type="button" class="btn button2 pull-left" data-dismiss="modal"><< กลับ</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  <?php require "menu/script.php"; ?>
  </body>

</html>