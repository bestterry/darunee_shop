<?php
    require "../config_database/config.php";
    require "../session.php";
    $id_artist = $_GET['id_artist'];
    $sql_song = " SELECT * FROM song_list
                  INNER JOIN song_artist ON song_list.id_artist = song_artist.id_artist
                  INNER JOIN song_ageartist ON song_ageartist.id_ageartist = song_artist.id_ageartist
                  INNER JOIN song_tune ON song_list.id_tune = song_tune.id_tune
                  INNER JOIN song_sexartist ON song_artist.id_sexartist = song_sexartist.id_sexartist
                  INNER JOIN member ON song_list.id_member = member.id_member
                  WHERE song_artist.id_artist = $id_artist
                  ORDER BY CONVERT (song_list.name_song USING tis620) ASC";
    $objq_song = mysqli_query($conn,$sql_song);
    $objq_song2 = mysqli_query($conn,$sql_song);
    $objr_song2 = mysqli_fetch_array($objq_song2);
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
                <a class="active" href="artist.php"> ค้นหา </a>
                <a href="song_setting.php"> เพลง </a>
                <a href="song_original.php"> ต้นฉบับ </a>
                <a href="song_old.php"> เก่า </a>
                <a href="song_middle.php"></i> กลาง </a>
                <a href="song_new.php"> ใหม่ </a>
                <a href="gradea.php"> A </a>
                <a href="gradeb.php"> B </a>
                <a href="gradec.php"> C </a>
                <a href="graded.php"> D </a>
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
              <div class="box-header with-border">
                <div class="col-12">
                  <div class="col-2 col-sm-2 col-xl-2 col-md-2">
                    <a type="button" href="artist.php" class="btn button2"><< กลับ</a>
                  </div>
                  <div class="col-8 col-sm-8 col-xl-8 col-md-8 text-center">
                      <font size="5">
                        <B>  
                          <?php 
                            echo $objr_song2['name_artist'] .' ('.$objr_song2['name_ageartist'].')';       
                          ?>
                        </B>
                      </font>
                  </div>
                  <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
                </div>
              </div>
              <div class="box-body no-padding">
                <div class="mailbox-read-message">
                  <table id="example2" class="table">
                    <thead>
                      <tr>
                        <th class="text-center" width="20%">ชื่อเพลง</th>
                        <th class="text-center" width="6%">ทำนอง</th>
                        <th class="text-center" width="8%">ต้นฉบับ</th>
                        <th class="text-center" width="6%">เกรด</th>
                        <th class="text-center" width="8%">#</th>
                        <th class="text-center" width="7%">#</th>
                        <th class="text-center" width="7%">#</th>
                        <th class="text-center" width="5%">ตรวจ</th>
                        <th class="text-center" width="33%">หมายเหตุ</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        while($value =  $objq_song->fetch_assoc()){
                      ?>
                      <tr> 
                        <td class="text-center"><?php echo $value['name_song']; ?></td>
                        <td class="text-center"><?php echo $value['name_tune']; ?></td>
                        <td class="text-center"><?php if($value['script']=='N'){echo "-";}else{echo "ต้นฉบับ";} ?></td>
                        <td class="text-center"><?php echo $value['melodic']; ?></td>
                        <td class="text-center">
                          <?php
                            if(!empty($value['ad_song'])){
                          ?>
                          <input type="button" name="ฟัง" value="ฟัง" id="<?php echo $value["id_song"]; ?>" class="btn btn-success btn-xs view_data" />
                          <?php }else{}?>
                        </td>
                        <td class="text-center">
                          <a href="song_edit2.php?id_song=<?php echo $value['id_song']; ?>&&id_artist=<?php echo $id_artist; ?>" class="btn  btn-success btn-xs" >>></a>
                        </td> 
                        <?php
                          if($value['id_member']==54){
                        ?>
                        <td class="text-center">
                          <a href="algorithm/song_editstatusopen2.php?id_song=<?php echo $value['id_song'];?>&&id_member=<?php echo $id_member;?>&&id_artist=<?php echo $id_artist;?>" class="btn  btn-success btn-xs">เปิด</a>
                        </td>
                        <?php
                          }else{
                        ?>
                        <td class="text-center"><font><?php echo $value['name']; ?></font></td>
                        <?php 
                          }
                        ?> 
                        
                        <?php
                        if($value['check_edit']=='N'){
                        ?>
                        <td class="text-center">-</td>
                        <?php
                          }else{
                        ?>
                        <td class="text-center"><font>ตรวจ</font></td>
                        <?php
                          }
                        ?> 
                        <td class="text-center">
                          <?php 
                            if($value['edit']=='N'){
                              $check = "";
                            }else {
                              $check = "(แก้ไข)";
                            }
                            echo $check.' '.$value['note']; 
                          ?>
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