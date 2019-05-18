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
  <title>โปรแกรมขายหน้าร้าน</title>
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
      <?php require "menu/main_header.php"; ?>
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
            <div class="box-header with-border text-center">
              <font size="5">
                <B> สินค้าที่ต้องการแกะกล่อง </B>
              </font>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                <form action="algorithm/sr_product.php" method="post" autocomplete="off">
                  <table class="table table-bordered ">
                    <tbody>
                      <tr bgcolor="#99CCFF">
                        <th class="text-center" width="50%">สินค้า_หน่วย</th>
                        <th class="text-center" width="25%">จำนวนที่มี</th>
                        <th class="text-center" width="25%">จำนวนแกะกล่อง</th>
                      </tr>
                      <?php
                              $id_product2 = 0;
                              $id_numproduct = $_POST['id_numproduct'];
                              $list_product = "SELECT * FROM num_product
                                                  INNER JOIN product ON num_product.id_product = product.id_product
                                                  WHERE num_product.id_numproduct = $id_numproduct";
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
                              }
                              ?>
                          <tr>
                            <td>
                              <?php echo $objr_listproduct['name_product'] . '_' . $objr_listproduct['unit']; ?>
                              <input class="hidden" type="text" name="id_product" value="<?php echo $objr_listproduct['id_product']; ?>">
                              <input class="hidden" type="text" name="id_numproduct" value="<?php echo $objr_listproduct['id_numproduct']; ?>">
                              <input class="hidden" type="text" name="id_product2" value="<?php echo $id_product2; ?>">
                            </td>
                            <td class="text-center">
                              <?php echo $objr_listproduct['num']; ?>
                              <input class="hidden" type="text" name="num_befor" value="<?php echo $objr_listproduct['num']; ?>">
                            </td>
                            <td class="text-center">
                              <input type="text" name="num_after" class="form-control text-center col-md-2" placeholder="ระบุจำนวน">
                            </td>
                          </tr>
                    </tbody>
                  </table>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <div class="box-footer">
              <a type="block" href="../product.php" class="btn btn-success"><<= กลับสู่หน้าหลัก </i> </a> 
              <button type="submit" class="btn btn-success pull-right" onClick="return confirm('คุณต้องการที่จะบันทึกข้อมูลนี้หรือไม่ ?')";><i class="fa fa-calculator"> บันทึก </i></button>
            </div>
            <!-- /.box-footer -->
            </form>
          </div>
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