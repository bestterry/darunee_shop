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
        <div class="col-md-12">
          <div class="box box-primary">
            <form action="algorithm/sr_product.php" method="post" autocomplete="off">
              <div class="box-header with-border text-center">
                <font size="5">
                  <B> แกะกล่องสินค้า</B>
                </font>
              </div>
              <div class="box-body no-padding">
                <div class="mailbox-read-message">
                  <table class="table table-bordered ">
                    <tbody>
                      <tr bgcolor="#99CCFF">
                        <th class="text-center" width="50%">สินค้า_หน่วย</th>
                        <th class="text-center" width="25%">จำนวนที่มี</th>
                        <th class="text-center" width="25%">จำนวนแกะกล่อง</th>
                      </tr>
                      <?php
                              $id_product2 = 0;
                              $id_numPD = $_POST['id_numPD'];
                              $list_product = " SELECT * FROM numpd_car
                                                INNER JOIN product ON numpd_car.id_product = product.id_product
                                                WHERE numpd_car.id_numPD_car = $id_numPD";
                              $objq_listproduct = mysqli_query($conn, $list_product);
                              $objr_listproduct = mysqli_fetch_array($objq_listproduct);
                              $id_product = $objr_listproduct['id_product'];
                              if ($id_product==1) {
                                $id_product2 = 2;
                              }elseif ($id_product==3) {
                                $id_product2 = 4;
                              }elseif ($id_product==5) {
                                $id_product2 = 6;
                              }elseif ($id_product==9) {
                                $id_product2 = 10;
                              }elseif ($id_product==32) {
                                $id_product2 = 33;
                              }elseif ($id_product==37) {
                                $id_product2 = 38;
                              }elseif ($id_product==39) {
                                $id_product2 = 40;
                              }elseif ($id_product==57) {
                                $id_product2 = 59;
                              }
                              
                      ?>
                      <tr>
                        <td class="text-center">
                          <?php echo $objr_listproduct['name_product'] . '_' . $objr_listproduct['unit']; ?>
                          <input class="hidden" type="text" name="id_product" value="<?php echo $objr_listproduct['id_product']; ?>">
                          <input class="hidden" type="text" name="id_numPD_car" value="<?php echo $objr_listproduct['id_numPD_car']; ?>">
                          <input class="hidden" type="text" name="id_product2" value="<?php echo $id_product2; ?>">
                        </td>
                        <td class="text-center">
                          <?php echo $objr_listproduct['num']; ?>
                          <input class="hidden" type="text" name="num_befor" value="<?php echo $objr_listproduct['num']; ?>">
                        </td>
                        <td class="text-center">
                          <input type="number" name="num_after" class="form-control text-center col-md-2" placeholder="ระบุจำนวน">
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="box-footer">
                <a type="block" href="store.php" class="btn btn-danger"><< เมนูหลัก </i> </a> 
                <button type="submit" class="btn btn-success pull-right" onClick="return confirm('คุณต้องการที่จะบันทึกข้อมูลนี้หรือไม่ ?')";><i class="fa fa-calculator"> บันทึก </i></button>
              </div>
            </form>
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