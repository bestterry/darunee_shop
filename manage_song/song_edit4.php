<?php
  require "../config_database/config.php";
  $id_song = $_GET['id_song'];

  $sql_song = "SELECT * FROM song_list
                INNER JOIN song_artist ON song_list.id_artist = song_artist.id_artist
                INNER JOIN song_tune ON song_list.id_tune = song_tune.id_tune
                INNER JOIN song_sexartist ON song_artist.id_sexartist = song_sexartist.id_sexartist
                WHERE song_list.id_song = $id_song";
  $objq_song = mysqli_query($conn,$sql_song);
  $objr_song = mysqli_fetch_array($objq_song);
?>
<!DOCTYPE html>
<html>

<head>
  <?php require('../font/font_style.php'); ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>เพลง</title>
  <!-- Tell the browser to be responsive to screen width -->
  <link rel="icon" type="image/png" href="../images/favicon.ico" />
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../plugins/iCheck/all.css">
  <style>
      .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
      }

      .switch input { 
        opacity: 0;
        width: 0;
        height: 0;
      }

      .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
      }

      .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
      }

      input:checked + .slider {
        background-color: #2196F3;
      }

      input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
      }

      input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
      }

      /* Rounded sliders */
      .slider.round {
        border-radius: 34px;
      }

      .slider.round:before {
        border-radius: 50%;
      }


      .button2 {
        background-color: #b35900;
        color : white;
        } /* Back & continue */
  </style>

</head>

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
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <div class="col-12">
                  <div class="col-4 col-sm-4 col-xl-4 col-md-4">
                    <a type="button" href="song_setting.php" class="btn button2"><< กลับ</a>
                    
                  </div>
                  <div class="col-4 col-sm-4 col-xl-4 col-md-4">
                    <p align="center">
                      <font size="5">
                        <B>แก้ไขข้อมูล (เพลง)</B>
                      </font>
                    </p>
                  </div>
                  <div class="col-4 col-sm-4 col-xl-4 col-md-4 text-right">
                    <a href="song_listen.php?id_song=<?php echo $id_song;?>&&id_age=setting" class="btn  btn-success" target="_blank">ฟัง</a>
                  </div>
                </div>
              </div>

              <form action="algorithm\edit_song4.php" class="form-horizontal" method="post" autocomplete="off" name="form1">
                <div class="box-body no-padding">
                  <div class="mailbox-read-message">
                    <div class="row">
                      <div class="col-3 col-sm-3 col-md-3 col-xl-3"></div>
                      
                      <div class="col-5 col-sm-5 col-md-5 col-xl-5">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">นักร้อง </label>
                          <div class="col-sm-4">
                            <select name="id_artist"  class="form-control" >
                              <option value="<?php echo $objr_song['id_artist']; ?>">-- เลือกนักร้อง --</option>
                              <?php 
                                $sql_artist = "SELECT id_artist,name_artist FROM song_artist";
                                $objq_artist = mysqli_query($conn,$sql_artist);
                                while($value = $objq_artist->fetch_assoc()){ 
                              ?>
                                <option value="<?php echo $value['id_artist'];?>"><?php echo $value['name_artist'];?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="col-sm-4">
                            <input class="form-control" value="<?php echo $objr_song['name_artist'];?>" disabled/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label">ชื่อเพลง </label>
                          <div class="col-sm-8">
                            <input type="text" name="name_song" class="form-control" value="<?php echo $objr_song['name_song']; ?>">
                            <input type="hidden" name="id_song" class="form-control" value="<?php echo $id_song; ?>">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label">ทำนอง </label>
                          <div class="col-sm-4">
                            <select name="id_tune"  class="form-control" >
                              <option value="<?php echo $objr_song['id_tune']; ?>">-- เลือกทำนอง --</option>
                              <?php 
                                $sql_tune = "SELECT id_tune,name_tune FROM song_tune";
                                $objq_tune = mysqli_query($conn,$sql_tune);
                                while($value = $objq_tune->fetch_assoc()){ 
                              ?>
                                <option value="<?php echo $value['id_tune'];?>"><?php echo $value['name_tune'];?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="col-sm-4">
                            <input class="form-control" value="<?php echo $objr_song['name_tune'];?>" disabled/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label">เกรด </label>
                          <div class="col-sm-4">
                            <select name="melodic"  class="form-control" >
                              <option value="<?php echo $objr_song['melodic']; ?>">-- เลือกความเพราะ --</option>
                              <option value="A">A</option>
                              <option value="B">B</option>
                              <option value="C">C</option>
                              <option value="D">D</option>
                            </select>
                          </div>
                          <div class="col-sm-4">
                            <input class="form-control" value="<?php echo $objr_song['melodic'];?>" disabled/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label">ต้นฉบับ </label>
                          <div class="col-sm-8">
                            <label class="switch">
                              <input type="checkbox" name="script" <?php if($objr_song['script']=="Y"){ echo "checked"; }else{} ?>>
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label">เปิดแล้ว </label>
                          <div class="col-sm-8">
                            <label class="switch">
                              <input type="checkbox" name="status" <?php if($objr_song['status']=="Y"){ echo "checked"; }else{} ?>>
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>

                      </div>
                      <div class="col-3 col-sm-3 col-md-3 col-xl-3"></div>
                      <!-- /.row -->
                    </div>
                  </div>
                  <div class="box-footer text-center">
                    <button type="submit" class="btn btn-success"> บันทึก </button>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                    <a href="algorithm/delete_song.php?id_song=<?php echo $id_song;?>" class="btn btn-danger" OnClick="return confirm('ต้องการลบรายการเพลงหรือไม่ ?')";>ลบ</a>
                  </div>
                </div>
              </form>
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