<?php
require "../config_database/config.php";
require "../session.php";
  if($_POST){
      if(isset($_FILES['upload'])){
          $amphur_name = $_POST['amphur_name'];
          $province_name = $_POST['province_name'];



          if (empty($amphur_name)) {
            $amphur_id = 0;
          }else {
            $amphur_id = $amphur_name;
          }

          if (empty($province_name)) {
            $province_id = 0;
          }else{
            $province_id = $province_name;
          }

          $name_file =  $_FILES['upload']['name'];
          $tmp_name =  $_FILES['upload']['tmp_name'];
          $locate_img ="../images/map/";
          move_uploaded_file($tmp_name,$locate_img.$name_file);

          $sql = "INSERT INTO map (amphur_id, province_id, name_map)
                  VALUES ($amphur_id,  $province_id, '$name_file')";
          mysqli_query($conn,$sql);
      }
  }
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

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="box box-primary">
            <div class="box-header text-center with-border">
              <B align="center"> 
                <font size="5"> รูปภาพ </font>
              </B>
            </div>
            
            <div class="box-body">
            
            <div align="center">
              <div class="container">
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class="icon fa fa-check-circle"></i>บันทึกข้อมูลสำเร็จ</h4>
                </div>
              </div>
              <img src="../images/map/<?php echo "$name_file"?>" width="730" height="900">  
              <div>
                <B align="center"> 
                  <font size="5"> <?php echo $name_file; ?> </font>
                </B>
              </div>
            </div>
            </div>

            <div class="box-footer">
              <a href="map.php" class="btn btn-danger pull-left"> << เมนูหลัก </a>
            </div>
          </div>
          
      </div>
    </div>
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

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