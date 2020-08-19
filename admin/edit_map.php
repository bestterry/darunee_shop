<?php
  require "../config_database/config.php";
  require "../session.php";

  $id_map = $_GET['id_map'];
  $sql = "SELECT name_map FROM map WHERE id_map = $id_map";
  $objq = mysqli_query($conn,$sql);
  $objr = mysqli_fetch_array($objq);
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
</head>

<body class=" hold-transition skin-blue layout-top-nav ">
  <div class="wrapper">
    <header class="main-header">
      <?php require('menu/header_logout.php'); ?>
    </header>

    <div class="content-wrapper">
      <section class="content-header">
      </section>
      <section class="content">
        <form action="algorithm/edit_map.php" method="post" class="form-horizontal" enctype="multipart/form-data">
          <div class="box box-default">
            <div class="box-header text-center">
              <B><font size="5">แก้ไขรูปแผนที่</font></B> 
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="col-sm-2 control-label">จังหวัด </label>
                        <div class="col-sm-10">
                          <input type="text" class=" form-control" style="width: 100%;" value="<?php echo $_GET['province'];?>" disabled>
                        </div>
                      </div>

                      <div class="form-group">
                        <label  class="col-sm-2 control-label">อำเภอ </label>
                        <div class="col-sm-10">
                          <input type="text" class=" form-control" value="<?php echo $_GET['amphur'];?>" style="width: 100%;" disabled>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">รูปภาพ </label>
                        <div class="col-sm-10">
                          <input name="upload" type="file" class=" form-control" style="width: 100%;">
                          <input name="name_map" type="hidden" class=" form-control" style="width: 100%;" value="<?php echo $_GET['name_map'];?>">
                          <input name="id_map" type="hidden" class=" form-control" style="width: 100%;" value="<?php echo $_GET['id_map'];?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="box-footer text-center">
                <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> บันทึก </button>
            </div>
          </div>
        </form>
      </section>
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
</body>

</html>
