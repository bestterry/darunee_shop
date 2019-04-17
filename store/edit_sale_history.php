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
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class=" hold-transition skin-blue layout-top-nav ">
  <div class="wrapper">

    <header class="main-header">
    <nav class="navbar navbar-static-top">
    </header>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <div class="box box-primary">
            <div class="box-header text-center with-border">
              <font size="5">
                <B align="center"> แก้ไขสินค้า </B>
              </font>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                <form action="algorithm/edit_sale_history.php" method="post" autocomplete="off">
                  <table class="table table-bordered table-hover">
                    <tbody>
                      <tr bgcolor="#99CCFF">
                        <th class="text-center" width="35%">รายการ
                        </th>
                        <th class="text-center" width="15%">จำนวน
                        </th>
                        <th class="text-center" width="12%">บ/หน่วย
                        </th>
                        <th class="text-center" width="13%">เงินขาย(บาท)
                        </th>
                        <th class="text-center" width="20%">หมายเหตุ
                        </th>
                      </tr>
                      <?php
                              $id_sale = $_GET['id_sale'];
                                  $list_product = "SELECT * FROM product INNER JOIN sale_car_history ON product.id_product = sale_car_history.id_product 
                                                   WHERE sale_car_history.id_sale_history = $id_sale";
                                  $objq_listproduct = mysqli_query($conn,$list_product);
                                  $objr_listproduct = mysqli_fetch_array($objq_listproduct);
                          ?>
                      <tr>
                        <td class="text-center">
                           <input type="text" class="form-control text-center col-md-1" value="<?php echo $objr_listproduct['name_product'].' ('.$objr_listproduct['unit'].')'; ?>" readonly />
                           <input type="hidden" name="id_sale" class="form-control text-center col-md-1" value="<?php echo $id_sale; ?>">
                           <input type="hidden" name="id_product" class="form-control text-center col-md-1" value="<?php echo $objr_listproduct['id_product']; ?>">
                        </td>
                        <td>
                          <input  type="hidden" name="num_befor" class="form-control text-center col-md-1" value="<?php echo $objr_listproduct['num']; ?>">
                          <input  type="text" name="num_after" class="form-control text-center col-md-1" value="<?php echo $objr_listproduct['num']; ?>">
                        </td>
                        <td class="text-center"> 
                          <input type="text" name="price" class="form-control text-center col-md-1" value="<?php echo $objr_listproduct['price']; ?>">
                        </td>
                        <td>
                          <input  type="text" name="money" class="form-control text-center col-md-1" value="<?php echo $objr_listproduct['money']; ?>">
                        </td>
                        <td class="text-center"> 
                          <input type="text" name="note" class="form-control text-center col-md-1" value="<?php echo $objr_listproduct['note']; ?>">
                        </td>
                      </tr>
                    </tbody>
                  </table>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <div class="box-footer">
              <a type="block" href="sale_product_history.php" class="btn btn-success"><<= กลับ </i> </a> 
              <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"> บันทึก </i></button>
            </div>
            <!-- /.box-footer -->
            </form>
          </div>
          <!-- /. box -->
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