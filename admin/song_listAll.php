<?php
  require "../config_database/config.php";
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
                <!-- /.box-header -->
                <div class="box-header with-border">
                  <div class="col-12">
                    <div class="col-2 col-sm-2 col-xl-2 col-md-2">
                      <a type="button" href="song_search.php" class="btn button2"><< กลับ</a>
                    </div>
                    <div class="col-10 col-sm-10 col-xl-10 col-md-10 text-right">
                    </div>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <div class="mailbox-read-message">
                    <div class="text-center">
                      <font size="5" >
                        <B>
                          เพลงคัด ทั้งหมด
                        </B>
                      </font>
                    </div>
                    <div class="col-1 col-sm-1 col-lg-1 col-md-1 col-xl-1"></div>
                    <div class="col-10 col-sm-10 col-lg-10 col-md-10 col-xl-10">
                      <table id="example2" class="table">
                        <thead>
                          <tr>
                            <th class="text-center" width="5%">สถานะ</th>
                            <th class="text-center" width="21%">นักร้อง</th>
                            <th class="text-center" width="21%">ชื่อเพลง</th>
                            <th class="text-center" width="12%">ยุค</th>
                            <th class="text-center" width="12%">ทำนอง</th>
                            <th class="text-center" width="12%">ต้นฉบับ</th>
                            <th class="text-center" width="12%">เกรด</th>
                            <th class="text-center" width="5%">แก้</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $sql_song = " SELECT * FROM song_list
                                          INNER JOIN song_artist ON song_list.id_artist = song_artist.id_artist
                                          INNER JOIN song_tune ON song_list.id_tune = song_tune.id_tune
                                          INNER JOIN song_age ON song_list.id_age = song_age.id_age
                                          INNER JOIN song_sexartist ON song_artist.id_sexartist = song_sexartist.id_sexartist";
                            $objq_song = mysqli_query($conn,$sql_song);
                            while($value =  $objq_song->fetch_assoc()){
                          ?>
                          <tr> 
                          <?php
                            if($value['status']=='N'){
                          ?>
                            <td class="text-center"> </td>
                          <?php
                            }else{
                          ?>
                           <td class="text-center"><font>เปิด</font></td>
                          <?php 
                            }
                          ?>
                            <td class="text-center"><?php echo $value['name_artist'];?></td>
                            <td class="text-center"><?php echo $value['name_song']; ?></td>
                            <td class="text-center"><?php echo $value['name_age']; ?></td>
                            <td class="text-center"><?php echo $value['name_tune']; ?></td> 
                            <td class="text-center"><?php if($value['script']=='N'){echo " ";}else{echo "Y";} ?></td>
                            <td class="text-center"><?php echo $value['melodic']; ?></td> 
                            <td class="text-center">
                              <a href="song_edit3.php?id_song=<?php echo $value['id_song'];?>" class="btn  btn-success btn-xs" >แก้</a>
                            </td>
                          </tr>
                          <?php 
                            }
                          ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-1 col-sm-1 col-lg-1 col-md-1 col-xl-1"></div>
                  </div>
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
    <script>
      $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
          'paging'      : false,
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : false,
          'info'        : true,
          'autoWidth'   : false
        }
        )
      });
    </script>
</body>

</html>