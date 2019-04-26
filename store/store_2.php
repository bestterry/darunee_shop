<?php 
  require "../config_database/config.php";
  require "../session.php";  
?>

<!DOCTYPE html>
<html>
<head>
<?php require('../font/font_style.php');?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ทีมงานคุณดารุณี</title>
    <link rel="icon" type="image/png" href="../images/favicon.ico"/>
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class=" hold-transition skin-blue layout-top-nav ">
<div class="wrapper">

  <header class="main-header">
  <?php require('menu/header_logout.php');?>
  </header>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <!-- Main content -->
    <section class="content">
  
      <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <font size="6"><p align = "center"> สต๊อกรถ </font></p>
                <font size="4"><b align = "left"> เจ้าของรถ : <?php echo $username; ?></font></b>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <div class="mailbox-read-message">
                    <table class="table table-bordered table-hover">
                        <tbody>
                          <tr bgcolor="#99CCFF">
                            <th class="text-center" width="5%" >ลำดับ</th>
                            <th class="text-center" >สินค้า</th>
                            <th class="text-center" width="6%">หน่วย</th>
                            <th class="text-center" width="9%">ยกมา(+)</th>
                            <th class="text-center" width="9%">รับเข้า(+)</th>
                            <th class="text-center" width="9%">เบิกออก(-)</th>
                            <th class="text-center" width="9%">ขาย(-)</th>
                            <th class="text-center" width="9%">อื่นๆ(-)</th>
                            <th class="text-center" width="9%">คืนร้าน</th>
                            <th class="text-center" width="9%">เหลือ</th>
                            <th class="text-center" width="9%">นับจริง</th>
                          </tr>
              <?php require('algorithm/cal_store.php'); ?>                
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box-footer">
             <a href="store.php" type="button" class="btn btn-success pull-left"> <<= กลับ </a>
             <a href="../pdf_file/store.php" type="button" class="btn btn-success pull-right"><i class="fa fa-print"></i> พิมพ์ </a>
            </div>
            <!-- /.box-footer -->
        </div>
        </form>
        <!-- /. box -->
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
