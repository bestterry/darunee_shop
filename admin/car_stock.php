<?php
require "../config_database/config.php";
require "../session.php";
require "menu/date.php";
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
        <?php
        $list_product = "SELECT * FROM product";
        $query_product = mysqli_query($conn, $list_product);
        $query_product2 = mysqli_query($conn, $list_product);
        ?>
        <div class="box box-primary">
        <div class="box-header text-center with-border">
            <B align="center"> 
              <font size="5"> สต๊อกรถ </font>
              <font size="5" color="red">  
                <?php 
                    $strDate = date('d-m-Y');
                    echo DateThai($strDate);
                ?>
              </font>
            </B>
          </div>
          
          <!-- /.box-header -->
          <div class="box-body no-padding">
            <div class="mailbox-read-message">
              <table class="table table-striped table-bordered">
                <tbody>
                  <tr class="info">
                    <th class="text-center" width="3%">ที่</th>
                    <th class="text-center" width="18%">สินค้า_หน่วย</th>
                    <th class="text-center" width="5%">ยุทธ</th>
                    <th class="text-center" width="5%">ลิน</th>
                    <th class="text-center" width="5%">เอ</th>
                    <th class="text-center" width="5%">รงค์</th>
                    <th class="text-center" width="5%">เอ๋</th>
                    <th class="text-center" width="5%">เกีติ</th>
                    <th class="text-center" width="5%">เดี่ว</th>
                    <th class="text-center" width="5%">อั๋น</th>
                    <th class="text-center" width="5%">เบส</th>
                    <th class="text-center" width="5%">หนึ่ง</th>
                    <th class="text-center" width="5%">บอย</th>
                    <th class="text-center" width="5%">เอี่ว</th>
                    <th class="text-center" width="5%">เค</th>
                    <th class="text-center" width="5%">เอ็กซ์</th>
                    <th class="text-center" width="5%">รอน</th>
                    <th class="text-center" width="8%">รวม</th>
                  </tr>
                  <?php
                  $a = 1;
                  while ($product = $query_product->fetch_assoc()) {

                    ?>
                    <tr>
                      <td class="text-center">
                        <?php echo $a; ?>
                      </td>
                      <td class="text-center">
                        <?php echo $product['name_product'].'_'.$product['unit']; ?>
                      </td>
                      <!-- -------------------------------รถ------------------------------------ -->
                      <?php
                      $total_num = 0;
                      for ($i = 4; $i <= 18; $i++) {

                        $SQL_num = "SELECT * FROM numpd_car WHERE id_product = $product[id_product] AND id_member = $i";
                        $objq_num = mysqli_query($conn, $SQL_num);
                        $objr_num = mysqli_fetch_array($objq_num);
                        if (!isset($objr_num['num'])) {
                          ?>
                          <td></td>
                        <?php
                      } else {
                        ?>
                          <td class="text-center"><?php echo $objr_num['num']; ?></td>
                        <?php
                      }
                      $total_num = $total_num + $objr_num['num'];
                    }
                    ?>
                      <!-- -------------------------------//รถ------------------------------------ -->

                      <!-- -------------------------------รวมทั้งหมด------------------------------------ -->
                        
                        <td class="text-center"><?php echo $total_num; ?></td>
                      
                      <!-- -------------------------------//รวมทั้งหมด------------------------------------ -->
                    </tr>
                    <?php $a++;
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="box-footer">
            <a href="admin.php" class="btn btn-success pull-left"> <<== กลับสู่เมนูหลัก </a>
            <a href="../pdf_file/admin_car_stock.php" class="btn btn-success pull-right"> PDF </a>
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
  <script>
    $(function() {
      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging': true,
        'lengthChange': false,
        'searching': false,
        'ordering': true,
        'info': true,
        'autoWidth': false
      })
    })
    $(function() {
      //Enable iCheck plugin for checkboxes
      //iCheck for checkbox and radio inputs
      $('.mailbox-messages input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
      });
      //Enable check and uncheck all functionality
      $(".checkbox-toggle").click(function() {
        var clicks = $(this).data('clicks');
        if (clicks) {
          //Uncheck all checkboxes
          $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
          $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
        } else {
          //Check all checkboxes
          $(".mailbox-messages input[type='checkbox']").iCheck("check");
          $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
        }
        $(this).data("clicks", !clicks);
      });
      //Handle starring for glyphicon and font awesome
      $(".mailbox-star").click(function(e) {
        e.preventDefault();
        //detect type
        var $this = $(this).find("a > i");
        var glyph = $this.hasClass("glyphicon");
        var fa = $this.hasClass("fa");
        //Switch states
        if (glyph) {
          $this.toggleClass("glyphicon-star");
          $this.toggleClass("glyphicon-star-empty");
        }
        if (fa) {
          $this.toggleClass("fa-star");
          $this.toggleClass("fa-star-o");
        }
      });
    });
  </script>
</body>

</html>