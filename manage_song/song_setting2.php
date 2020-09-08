<?php
    require "../config_database/config.php";
    $sql_song = " SELECT * FROM song_list
                  INNER JOIN song_artist ON song_list.id_artist = song_artist.id_artist
                  INNER JOIN song_ageartist ON song_ageartist.id_ageartist = song_artist.id_ageartist
                  INNER JOIN song_tune ON song_list.id_tune = song_tune.id_tune
                  INNER JOIN song_sexartist ON song_artist.id_sexartist = song_sexartist.id_sexartist
                  WHERE song_list.edit = 'Y'";
    $objq_song = mysqli_query($conn,$sql_song);
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
                <a href="song_new.php"> ใหม่ </a>
                <a href="gradea.php"> A </a>
                <a href="gradeb.php"> B </a>
                <a href="gradec.php"> C </a>
                <a href="graded.php"> D </a>
                <a href="song_setting.php"> เพลง </a>
                <a href="artist_setting.php"> นักร้อง </a>
                <a class="active" href="song_setting2.php"> แก้ไข </a>
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
              <div class="box-header with-border">
                <div class="col-12">
                  <div class="col-2 col-sm-2 col-xl-2 col-md-2">
                  </div>
                  <div class="col-8 col-sm-8 col-xl-8 col-md-8 text-center">
                    <font size="5"><B>แก้ไข</B></font>
                  </div>
                  <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
                </div>
              </div>
              <div class="box-body no-padding">
                <div class="mailbox-read-message">
                  <table id="example2" class="table">
                    <thead>
                      <tr>
                        <th class="text-center" width="8%">#</th>
                        <th class="text-center" width="15%">นักร้อง</th>
                        <th class="text-center" width="14%">ชื่อเพลง</th>
                        <th class="text-center" width="7%">ทำนอง</th>
                        <th class="text-center" width="7%">เกรด</th>
                        <th class="text-center" width="9%">ต้นฉบับ</th>
                        <th class="text-center" width="8%">#</th>
                        <th class="text-center" width="8%">แก้ไข</th>
                        <th class="text-center" width="24%">หมายเหตุ</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        while($value =  $objq_song->fetch_assoc()){
                      ?>
                      <tr> 
                        <td class="text-center">
                          <?php
                            if(!empty($value['ad_song'])){
                          ?>
                          <a href="song_listen.php?id_song=<?php echo $value['id_song'];?>&&status=setting2" class="btn  btn-success btn-xs" >ฟัง</a>
                          <?php }else{}?>
                        </td>
                        <td class="text-center"><?php echo $value['name_artist']; ?></td>
                        <td class="text-center"><?php echo $value['name_song']; ?></td>
                        <td class="text-center"><?php echo $value['name_tune']; ?></td>
                        <td class="text-center"><?php echo $value['melodic']; ?></td>
                        <td class="text-center"><?php if($value['script']=='N'){echo "-";}else{echo "ต้นฉบับ";} ?></td>
                        
                        <td class="text-center">
                          <a href="song_edit5.php?id_song=<?php echo $value['id_song']; ?>" class="btn btn-success btn-xs">แก้</a>
                        </td> 
                        <?php
                        if($value['edit']=='N'){
                        ?>
                        <td class="text-center">-</td>
                        <?php
                          }else{
                        ?>
                        <td class="text-center"><font>แก้ไข</font></td>
                        <?php
                          }
                        ?> 
                        <td class="text-center"><?php echo $value['note']; ?></td>
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
      </section>
    </div>
    <script src="../bower_components/jquery/dist/jquery.min.js">
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js">
    </script>
    <!-- DataTables -->
    <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js">
    </script>
    <script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js">
    </script>
    <!-- SlimScroll -->
    <script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js">
    </script>
    <!-- FastClick -->
    <script src="../bower_components/fastclick/lib/fastclick.js">
    </script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js">
    </script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js">
    </script>
    <script src="../plugins/iCheck/icheck.min.js">
    </script>
  </body>

</html>