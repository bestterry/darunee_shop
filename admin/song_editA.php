<?php
  require "../config_database/config.php";
  $id_artist = $_GET['id_artist'];
  $sql = "SELECT * FROM song_artist
          INNER JOIN song_sexartist ON song_artist.id_sexartist = song_sexartist.id_sexartist
          INNER JOIN song_ageartist ON song_artist.id_ageartist = song_ageartist.id_ageartist 
          WHERE song_artist.id_artist = $id_artist";
    $objq = mysqli_query($conn,$sql);
    $objr = mysqli_fetch_array($objq);
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
    thead {
      color : red;
    }
    .button2 {
      background-color: #b35900;
      color : white;
      } /* Back & continue */
  </style>
</head>

<body class=" hold-transition skin-blue layout-top-nav">
  <div>
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
                      <a type="button" href="song_artist.php" class="btn button2"><< กลับ</a>
                    </div>
                    <div class="col-4 col-sm-4 col-xl-4 col-md-4">
                      <p align="center">
                        <font size="5">
                          <B>แก้ไขเพลง</B>
                        </font>
                      </p>
                    </div>
                    <div class="col-4 col-sm-4 col-xl-4 col-md-4">
                    </div>
                  </div>
                </div>

                <form action="algorithm\edit_artist.php" class="form-horizontal" method="post" autocomplete="off" name="form1">
                  <div class="box-body no-padding">
                    <div class="mailbox-read-message">
                      
                        <div class="row">
                          <div class="col-3 col-sm-3 col-md-3 col-xl-3"></div>
                          
                          <div class="col-5 col-sm-5 col-md-5 col-xl-5">

                            <div class="form-group">
                              <label class="col-sm-4 control-label">ชื่อนักร้อง :</label>
                              <div class="col-sm-8">
                                <input class="form-control" type="text" name="name_artist" value="<?php echo $objr['name_artist'];?>" >
                                <input class="form-control" type="hidden" name="id_artist" value="<?php echo $id_artist;?>" >
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-sm-4 control-label">ยุคนักร้อง :</label>
                              <div class="col-sm-4">
                                <select name="id_ageartist"  class="form-control" >
                                  <option value="<?php echo $objr['id_ageartist']; ?>">-- เลือกยุคนักร้อง --</option>
                                  <?php 
                                    $sql_ageartist = "SELECT id_ageartist,name_ageartist FROM song_ageartist";
                                    $objq_ageartist = mysqli_query($conn,$sql_ageartist);
                                    while($value = $objq_ageartist->fetch_assoc()){ 
                                  ?>
                                    <option value="<?php echo $value['id_ageartist'];?>"><?php echo $value['name_ageartist'];?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              <div class="col-sm-4">
                                <input class="form-control" value="<?php echo $objr['name_ageartist'];?>" disabled/>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-sm-4 control-label">เพศนักร้อง :</label>
                              <div class="col-sm-4">
                                <select name="id_sexartist"  class="form-control">
                                  <option value="<?php echo $objr['id_sexartist']; ?>">-- เลือกเพศนักร้อง --</option>
                                  <?php 
                                    $sql_sexartist = "SELECT id_sexartist,name_sexartist FROM song_sexartist";
                                    $objq_sexartist = mysqli_query($conn,$sql_sexartist);
                                    while($value = $objq_sexartist->fetch_assoc()){ 
                                  ?>
                                    <option value="<?php echo $value['id_sexartist'];?>"><?php echo $value['name_sexartist'];?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              <div class="col-sm-4">
                                <input class="form-control" value="<?php echo $objr['name_sexartist'];?>" disabled/>
                              </div>
                            </div>

                          </div>
                          <div class="col-3 col-sm-3 col-md-3 col-xl-3"></div>
                          <!-- /.row -->
                        </div>
                    </div>
                    <div class="box-footer text-center">
                      <button type="submit" class="btn btn-success" > บันทึก </button>
                    </div>
                  </div>
                </form>
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
    <script>
      $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
          'paging'      : false,
          'lengthChange': false,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : false
        }
        )
      });
    </script>
</body>

</html>