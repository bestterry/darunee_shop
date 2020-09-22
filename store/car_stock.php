<?php
  require "../config_database/config.php";
  require "../session.php";
  require "menu/date.php";

  $list_product = "SELECT * FROM product WHERE status_stock = 1 ";
  $query_product = mysqli_query($conn,$list_product);

  $sql_member = "SELECT id_member,name_sub FROM member WHERE status_car = 1 
                 AND NOT id_member = 3 AND NOT id_member = 8  AND NOT id_member = 45  AND NOT id_member = 46";
  $objq_member = mysqli_query($conn,$sql_member);
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
        <div class="box box-primary">
          <div class="box-header text-center with-border">
            <B align="center"> 
              <font size="5"> สินค้าคงเหลือบนรถ </font>
              <font size="5" color="red">  
                <?php 
                    $strDate = date('d-m-Y');
                    echo DateThai($strDate);
                ?>
              </font>
            </B>
          </div>
          <div class="box-body no-padding">
            <div class="mailbox-read-message">
              <div style="overflow-x:auto;">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="text-center" width="8%">สินค้า_หน่วย</th>
                      <?php 
                        while($value = $objq_member -> fetch_assoc()){
                      ?>
                      <th class="text-center" width="4%"><?php echo $value['name_sub'];?></th>
                      <?php 
                        }
                      ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      while ($product = $query_product->fetch_assoc()) {
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $product['name_product'].'_'.$product['unit']; ?></td>
                      <!-- -------------------------------รถ------------------------------------ -->
                      <?php
                        $objq_member2 = mysqli_query($conn,$sql_member);
                        while($value2 = $objq_member2 -> fetch_assoc()){
                          $id_member = $value2['id_member'];
                          $SQL_num = "SELECT * FROM numpd_car WHERE id_product = $product[id_product] AND id_member = $id_member";
                          $objq_num = mysqli_query($conn, $SQL_num);
                          $objr_num = mysqli_fetch_array($objq_num);
                          if((!isset($objr_num['num'])) || ($objr_num['num'] == 0)){
                      ?>
                        <td class="text-center">-</td>
                      <?php
                        } else {
                          $num_pd = $objr_num['num'];
                      ?>
                        <td class="text-center"><?php echo $num_pd; ?></td>
                      <?php
                          }
                        }
                      ?>
                    </tr>
                    <?php 
                      } 
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <a href="store.php" class="btn btn-danger pull-left"> << เมนูหลัก </a>
            <a href="../pdf_file/admin_car_stock.php" class="btn btn-success pull-right"><i class="fa fa-print"> พิมพ์ </i></a>
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
    });
  </script>
</body>

</html>