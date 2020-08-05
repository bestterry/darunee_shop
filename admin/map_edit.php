<?php
  require "../config_database/config.php";
  require "../session.php";
?>
<!DOCTYPE html>
<html>

  <head>
    <?php require('../font/font_style.php'); ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ทีมงานคุณดารุณี</title>
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
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
    .button2 {
      background-color: #b35900;
      color : white;
      } /* Back & continue */
  </style>
  </head>

  <body class=" hold-transition skin-blue layout-top-nav ">
    <div class="wrapper">
      <header class="main-header">
        <?php require('menu/header_logout.php'); ?>
      </header>
      <div class="content-wrapper">
        <section class="content">
          <div class="box box-default">
            <div class="box-header">
              <div class="col-12">
                <div class="col-4 col-sm-4 col-lg-4 col-md-4 col-xl-4">
                  <a href="map.php" class="btn button2"><< กลับ </a>
                </div>
                <div class="col-4 col-sm-4 col-lg-4 col-md-4 col-xl-4 text-center">
                  <B><font size="5">จัดการแผนที่</font></B> 
                </div>
                <div class="col-4 col-sm-4 col-lg-4 col-md-4 col-xl-4 text-right">
                </div>
              </div> 
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="col-2 col-sm-2 col-lg-2 col-md-2 col-xl-2"></div>
                  <div class="col-8 col-sm-8 col-lg-8 col-md-8 col-xl-8">
                    <table id="example2" class="table">
                      <thead>
                        <tr>
                          <th class="text-center" width="90%">ข้อมูล</th>
                          <th class="text-center" width="5%">ดู</th>
                          <th class="text-center" width="5%">ลบ</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                        $sql_map = "SELECT id_map,name_map FROM map";
                        $objq_map = mysqli_query($conn,$sql_map);
                        while($value = $objq_map->fetch_assoc()){
                      ?>
                        <tr>
                          <td class="text-center"><?php echo $value['name_map']; ?></td>
                          <td class="text-center"><a href="map_show2.php?id_map=<?php echo $value['id_map']; ?>" class="btn btn-success btn-xs">ดู</a></td>
                          <td class="text-center"><a href="algorithm/delete_map.php?id_map=<?php echo $value['id_map']; ?>&&name_map=<?php echo $value['name_map'];?>" class="btn  btn-danger btn-xs" >ลบ</a> </td>   
                        </tr>
                      <?php 
                        }
                      ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="col-2 col-sm-2 col-lg-2 col-md-2 col-xl-2"></div>
                </div>
              </div>
            </div>
            <div class="box-footer text-center">
            </div>
          </div>
        </section>
      </div>
    </div>

    <?php require("../menu/footer.html"); ?>
    </div>
    <!-- jQuery 3 -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <script src="../plugins/iCheck/icheck.min.js"></script>
    <script type="text/javascript">
      $(function () {
          $('#example1').DataTable()
          $('#example2').DataTable({
            'paging'      : true,
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
