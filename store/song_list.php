<?php
  include("db_connect.php");
  $mysqli = connect();
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
                    <a type="button" href="store.php" class="btn button2"><< เมนูหลัก</a>
                  </div>
                  <div class="col-10 col-sm-10 col-xl-10 col-md-10 text-right">
                    <a type="button" href="song_listY.php" class="btn btn-success" style="color:black;">เพลงเปิดแล้ว</a>
                    <a type="button"href="#" data-toggle="modal" data-target="#myModal2" class="btn btn-success" style="color:black;">เพิ่มเพลง</a>
                  </div>
                </div>
                  
                </div>
                  <div class="box-body no-padding">
                    <div class="mailbox-read-message">
                      <div class="col-1 col-sm-1 col-lg-1 col-md-1 col-xl-1"></div>
                      <div class="col-10 col-sm-10 col-lg-10 col-md-10 col-xl-10">
                        <table id="example2" class="table">
                          <thead>
                            <tr>
                              <th class="text-center" width="5%">#</th>
                              <th class="text-center" width="4%">id</th>
                              <th class="text-center" width="23%">ศิลปิน</th>
                              <th class="text-center" width="23%">ชื่อเพลง</th>
                              <th class="text-center" width="20%">ยุค</th>
                              <th class="text-center" width="20%">ทำนอง</th>
                              <th class="text-center" width="5%">#</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                              $sql_addorder = "SELECT * FROM song_list WHERE status = 'N'";
                              $objq_addorder = mysqli_query($mysqli,$sql_addorder);
                              while($value = $objq_addorder->fetch_assoc()){
                                $id_song = $value['id_song'];
                            ?>
                            <tr>
                              <td class="text-center"><a href="algorithm/edit_StatusSong.php?id_song=<?php echo $value['id_song']; ?>" class="btn btn-success btn-xs" onClick="return confirm('คุณต้องการที่จะเปลี่ยนสถานะเป็นส่งแล้วหรือไม่ ?')";>N</a></td>             
                              <td class="text-center"><?php echo $value['id_song'];?></td>
                              <td class="text-center"><?php echo $value['artist'];?></td>
                              <td class="text-center"><?php echo $value['name_song']; ?></td>
                              <td class="text-center"><?php echo $value['age']; ?></td>
                              <td class="text-center"><?php echo $value['tune']; ?></td>
                              <td class="text-center" ><a href="song_edit.php?id_song=<?php echo $value['id_song']; ?>" class="fa fa-pencil" ></a></td>
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
          <div class="modal fade" id="myModal2" role="dialog">
            <div class="modal-dialog modal-lg">
              <form action="algorithm/add_song.php" method="post">
                <div class="modal-content">
                  <div class="modal-header text-center">
                      <font size="5"><B> เพิ่มเพลง </B></font>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <th class="text-center" width="30%"><font size="4">ชื่อเพลง</font></th>
                            <th class="text-center" width="70%"> 
                              <input name="name_song" class="form-control" style="width: 100%;">
                            </th>
                          </tr>
                          <tr>
                            <th class="text-center" width="30%"><font size="4">ศิลปิน</font></th>
                            <th class="text-center" width="70%"> 
                              <input name="artist" class="form-control" style="width: 100%;">
                            </th>
                          </tr>
                          <tr>
                            <th class="text-center" width="30%"><font size="4">ยุค</font></th>
                            <th class="text-center" width="70%"> 
                              <input name="age" class="form-control" style="width: 100%;">
                            </th>
                          </tr>
                          <tr>
                            <th class="text-center" width="30%"><font size="4">ทำนอง</font></th>
                            <th class="text-center" width="70%"> 
                              <input name="tune" class="form-control" style="width: 100%;">
                            </th>
                          </tr>
                        </tbody>
                      </table> 
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
          'ordering'    : false,
          'info'        : true,
          'autoWidth'   : false
        }
        )
      });
    </script>
</body>

</html>