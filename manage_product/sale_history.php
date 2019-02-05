<?php require "../config_database/config.php"; ?>

<!DOCTYPE html>
<html>
<head>
<?php require('../font/font_style.php');?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
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
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
    </nav>
  </header>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
      </div>
      <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <font size="4"><B> ประวัติการขายสินค้า ประจำวันที่(<font size="4" color="red"><?php echo $strDate = date('d-m-Y');?></font>) </font></B>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <div class="mailbox-read-message">
                  <form action="price_product_finish.php" method="post" autocomplete="off">
                    <table class="table table-hover table-striped table-bordered">
                        <tbody>
                          <tr bgcolor="#99CCFF">
                            <th class="text-center" width="40%">ชื่อสินค้า</th>
                            <th class="text-center" width="20%">จำนวนสินค้าที่ขาย</th>
                            <th class="text-center" width="10%">หน่วยนับ</th>
                            <th class="text-center" width="30%">รวมเป็นเงิน(บาท)</th>
                          </tr>
                          <?php #endregion
                           $date = "SELECT * FROM sale_history
                                     WHERE DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate'";
                           $objq = mysqli_query($conn,$date);
                           foreach($objq as $data){
                              $id_sale = $data['id_sale_history'];
                             $SQL_product = "SELECT * FROM product INNER JOIN sale_history 
                             ON product.id_product = sale_history.id_product 
                             WHERE sale_history.id_sale_history='$id_sale'";
                             $objq_product = mysqli_query($conn,$SQL_product);
                             $objr_product = mysqli_fetch_array($objq_product);
    
                            // $sql_history = "SELECT * FROM product";
                            // $objq_history = mysqli_query($conn,$sql_history);
                            // foreach($objq_history as $history ){
                            //   $id_product = $history['id_product'];
                            //   $total_sale = "SELECT SUM(sale_history.num_sale),SUM(sale_history.price) FROM sale_history 
                            //                   INNER JOIN product ON sale_history.id_product=product.id_product
                            //                   WHERE product.id_product = '$id_product'";
                            //   $objq_sale = mysqli_query($conn,$total_sale);
                            //   $objr_sale = mysqli_fetch_array($objq_sale);
                            //   $num_product = $objr_sale['SUM(sale_history.num_sale)'];
                            //   $total_money = $objr_sale['SUM(sale_history.price)'];
                            //   $sql_NameProduct = "SELECT * FROM product WHERE id_product = '$id_product'";
                            //   $objq_NameProduct = mysqli_query($conn,$sql_NameProduct);
                            //   $objr_NameProduct = mysqli_fetch_array($objq_NameProduct);
                            //   if(isset($num_product)){ 
                          ?>
                          <tr>
                            <td><?php echo $objr_product['name_product']; ?></td>
                            <td class="text-center"><?php echo $objr_product['num_sale'];  ?></td>
                            <td class="text-center"><?php echo $objr_product['unit']; ?></td>
                            <td class="text-center"><?php echo $objr_product['price']; ?></td>
                          </tr>
                            <?php }
                         // } ?>
                        </tbody>
                    </table>
                    
                  </form>
                </div>
                <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->

            <!-- /.box-footer -->
            <div class="box-footer">

            </div>
            <!-- /.box-footer -->
        </div>
        <!-- /. box -->
    </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php require("../menu/footer.html"); ?>

</div>
<!-- ./wrapper -->

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
