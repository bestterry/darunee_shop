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
                <a href="song_middle.php"></i> กลาง </a>
                <a href="song_new.php" > ใหม่ </a>
                <a href="gradea.php"> A </a>
                <a href="gradeb.php"> B </a>
                <a href="gradec.php"> C </a>
                <a href="graded.php"> D </a>
                <a href="song_setting.php"> เพลง </a>
                <a class="active" href="artist_setting.php"> นักร้อง </a>
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
                  <div class="box-header">
                    <div class="col-12">
                      <div class="col-2 col-sm-2 col-xl-2 col-md-2">
                        
                      </div>
                      <div class="col-8 col-sm-8 col-xl-8 col-md-8 text-center">
                        <font size="5">
                          <B align="center">ตั้งค่านักร้อง</B>
                        </font>
                      </div>
                      <div class="col-2 col-sm-2 col-xl-2 col-md-2 text-right">
                      <a type="button"href="#" data-toggle="modal" data-target="#add_artist" class="btn btn-success" style="color:black;">เพิ่มนักร้อง</a>
                      </div>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="mailbox-read-message">
                      <div class="col-12">
                      <table id="example1" class="table">
                        <thead>
                          <tr>
                            <th class="text-center" width="25%">ชื่อนักร้อง</th>
                            <th class="text-center" width="25%">เพศ</th>
                            <th class="text-center" width="25%">ยุค</th>
                            <th class="text-center" width="12%">แก้ไข</th>
                            <th class="text-center" width="13%">ลบ</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                          $sql = "SELECT * FROM song_artist
                                  INNER JOIN song_sexartist ON song_artist.id_sexartist = song_sexartist.id_sexartist
                                  INNER JOIN song_ageartist ON song_artist.id_ageartist = song_ageartist.id_ageartist ";
                          $objq = mysqli_query($conn,$sql);
                          while ($value = $objq->fetch_assoc()) {
                        ?>
                          <tr>
                            <td class="text-center"><?php echo $value['name_artist']; ?></td>
                            <td class="text-center"><?php echo $value['name_sexartist']; ?></td>   
                            <td class="text-center"><?php echo $value['name_ageartist']; ?></td>
                            <td class="text-center">
                              <a href="edit_artist.php?id_artist=<?php echo $value['id_artist']; ?>" class="btn btn-success btn-xs" >แก้</a>
                            </td>
                            <td class="text-center">
                              <a href="algorithm/delete_artist.php?id_artist=<?php echo $value['id_artist']; ?>" class="btn btn-danger btn-xs" >ลบ</a>
                            </td>   
                          </tr>
                        <?php } ?>
                        </tbody>
                      </table>
                      </div>
                    </div>
                  </div>
                  <div align="center" class="box-footer"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
          <div class="modal fade" id="add_artist" role="dialog">
            <div class="modal-dialog modal-lg">
              <form action="algorithm/add_artist.php" method="post">
                <div class="modal-content">
                  <div class="modal-header text-center">
                      <font size="5"><B> เพิ่มนักร้อง </B></font>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-12">
                        <div class="col-3 col-sm-3 col-xl-3 col-md-3"></div>
                        <div class="col-6 col-sm-6 col-xl-6 col-md-6">
                          <table class="table table-bordered">
                            <tbody>
                              <tr>
                                <th class="text-center" width="30%"><font size="4">ชื่อ</font></th>
                                <th class="text-center" width="70%"> 
                                  <input name="name_artist" class="form-control" style="width: 100%;">
                                </th>
                              </tr>
                              <tr>
                                <th class="text-center" width="30%"><font size="4">ยุค</font></th>
                                <th class="text-center" width="70%"> 
                                  <select name="id_ageartist" class="form-control" style="width: 100%;">
                                    <option value="">-- เลือกยุคนักร้อง --</option>
                                    <?php 
                                      $sql_ageartist = "SELECT id_ageartist,name_ageartist FROM song_ageartist";
                                      $objq_ageartist = mysqli_query($conn,$sql_ageartist);
                                      while($value = $objq_ageartist->fetch_assoc()){
                                    ?>
                                    <option value="<?php echo $value['id_ageartist'];?>"><?php echo $value['name_ageartist'];?></option>
                                    <?php    
                                      }
                                    ?>
                                  </select>
                                </th>
                              </tr>
                              <tr>
                                <th class="text-center" width="30%"><font size="4">ชายหญิง</font></th>
                                <th class="text-center" width="70%"> 
                                  <select name="id_sexartist" class="form-control" style="width: 100%;">
                                    <option value="">-- เลือกเพศนักร้อง --</option>
                                    <?php 
                                      $sql_sexartist = "SELECT id_sexartist,name_sexartist FROM song_sexartist";
                                      $objq_sexartist = mysqli_query($conn,$sql_sexartist);
                                      while($value = $objq_sexartist->fetch_assoc()){
                                    ?>
                                    <option value="<?php echo $value['id_sexartist'];?>"><?php echo $value['name_sexartist'];?></option>
                                    <?php    
                                      }
                                    ?>
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
      </section>
    </div>
  <?php require "menu/script.php"; ?>
  </body>

</html>