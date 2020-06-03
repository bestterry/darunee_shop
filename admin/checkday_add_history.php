<?php
require "../config_database/config.php";
require "../session.php";
require "menu/date.php";
$list_product = "SELECT * FROM product WHERE status_stock = 1";
$objq_product = mysqli_query($conn,$list_product);
$objq_product2 = mysqli_query($conn, $list_product);

$member = "SELECT * FROM member 
WHERE status = 'employee' AND NOT id_member = 28 AND NOT id_member = 32";
$objq_member = mysqli_query($conn,$member);

$day = $_POST['day'];
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

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- form start -->
            <div class="col-md-12">
              <div class="form-group">
                <div class="box box-default">
                  
                  <div align="left">
                    <a href="admin.php" class="btn button2"><< เมนูหลัก</a>
                  </div>
                  <!-- ------------------------------ยอดขายรวม---------------------------- -->
                  <div class="box-header with-border">
                    <p align="center">
                      <font size="5"> <B>ประวัติการรับสินค้า <font color="red"> <?php echo DateThai($day); ?></font></B></font>
                    </p>
                  </div>
                  <div class="box-body">
                    <table class="table table-striped ">
                      <thead>
                        <tr>
                          <td class="text-center" width="5%"> <font color="red">ลำดับ</font> </td>
                          <td class="text-center" width="25%"> <font color="red">สินค้า_หน่วย</font> </td>
                          <td class="text-center" width="10%"> <font color="red">จำนวน</font> </td>
                          <td class="text-center" width="10%"> <font color="red">ผู้ส่ง</font> </td>
                          <td class="text-center" width="10%"> <font color="red">รับเข้า</font> </td>
                          <td class="text-center" width="35%"> <font color="red">หมายเหตุ</font> </td>
                          <td class="text-center" width="5%"> <font color="red">เวลา</font> </td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php #endregion
                        $i = 1;
                        $date = "SELECT * FROM add_history 
                                  INNER JOIN product ON add_history.id_product = product.id_product 
                                  INNER JOIN member ON add_history.id_member = member.id_member
                                  INNER JOIN zone ON add_history.id_zone = zone.id_zone
                                  WHERE DATE_FORMAT(datetime,'%Y-%m-%d')='$day'";
                        $objq = mysqli_query($conn, $date);
                        while ($value = $objq->fetch_assoc()) {
                          ?>
                          <tr>
                            <td class="text-center">
                              <?php echo $i; ?>
                            </td>
                            <td class="text-center">
                              <?php echo $value['name_product'] . '_' . $value['unit']; ?>
                            </td>
                            <td class="text-center">
                              <?php echo $value['num_add']; ?>
                            </td>
                            <td class="text-center">
                              <?php echo $value['name']; ?>
                            </td>
                            <td class="text-center">
                              <?php echo $value['name_zone']; ?>
                            </td>
                            <td class="text-center">
                              <?php echo $value['note']; ?>
                            </td>
                            <td class="text-center">
                              <?php echo Datethai2($value['datetime']); ?>
                            </td>
                          </tr>
                          <?php
                          $i++;
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="box-footer" align="center">
                    <!-- <a href="../pdf_file/admin_saleday_history.php?day=<?php echo $day; ?>" class="btn btn-success" target="_blank"><i class="fa fa-print"> พิมพ์ </i></a> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
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