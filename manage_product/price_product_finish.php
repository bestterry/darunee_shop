<?php require "../config_database/config.php"; ?>

<!DOCTYPE html>
<html>
<head>
<?php require('../font/font_style.php');?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>โปรแกรมขายหน้าร้าน</title>
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
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>ทีมงานดารุณี</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
  </aside>

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
                <font size="4"><B> รายการสินค้า </font></B>
            </div>
            <!-- /.box-header -->

            <div class="box-body no-padding">
                <div class="mailbox-read-message">
                  <form action="print_listproduct.php" method="post" autocomplete="off">
                    <table class="table table-bordered table-hover">
                        <tbody>
                          <tr bgcolor="#99CCFF">
                            <th class="text-center" width="5%">ลำดับ</th>
                            <th class="text-center" >ชื่อสินค้า</th>
                            <th class="text-center" width="15%" >จำนวนสินค้าที่ขาย</th>
                            <th class="text-center" width="10%" >หน่วยนับ</th>
                            <th class="text-center" width="15%">ราคา/หน่วย</th>
                            <th class="text-center" width="15%">รวมเป็นเงิน(บาท)</th>
                          </tr>

                          <?php //คำนวณสรายการสินค้า
                          $total_price_money = 0;
                           for($i=0;$i<count($_POST['id_product']);$i++){
                            $id_product = $_POST['id_product'][$i];
                            $num_product = $_POST['num_product'][$i];
                            $price_product = $_POST['price_product'][$i];
                            $total_price = $num_product*$price_product;

                            $num_product_instore="SELECT * FROM product WHERE id_product=$id_product";
                            $objq_num_product_instore = mysqli_query($conn,$num_product_instore);
                            $objr_num_product_instore = mysqli_fetch_array($objq_num_product_instore);
                            $total_num_product = $objr_num_product_instore['num_product']-$num_product;
                            $name_product = $objr_num_product_instore['name_product'];
                            if($total_num_product < 0){
                              echo "สินค้ามีจำนวนไม่เพียงพอ";
                            }else{
                              //Update NUM product in database
                              // $update_num_product = "UPDATE product SET num_product = $total_num_product WHERE id_product = $id_product";
                              // $objq_update = mysqli_query($conn,$update_num_product);
                              //INsert history buy product
                              // $insert_history = "INSERT INTO sale_history (id_product, num_sale, price, status_sale)
                              //                     VALUES ( $id_product, $num_product, $total_price, 'sale')";
                              // mysqli_query($conn,$insert_history);
                          ?>

                          <tr>
                            <td class="text-center" ><?php echo $i+1 ?></td>
                            <td ><?php echo $name_product; ?></td>
                            <td class="text-center" ><?php echo $num_product; ?></td>
                            <td><?php echo $objr_num_product_instore['unit'];?></td>
                            <td class="text-center" ><?php echo $price_product; ?> </td>
                            <input class ="hidden" type="text" name="name_product[]" value="<?php echo $name_product; ?>">
                            <input class ="hidden" type="text" name="num_product[]" value="<?php echo $num_product; ?>">
                            <input class ="hidden" type="text" name="price_product[]" value="<?php echo $price_product; ?>">
                            <td class="text-center" ><?php echo $total_price;?></td>
                          </tr>
                          <?php
                            }
                             $total_price_money = $total_price_money + $total_price;
                           }
                          ?>
                          <tr>
                            <td style="visibility:collapse;"></td>
                            <td style="visibility:collapse;"></td>
                            <td style="visibility:collapse;"></td>
                            <td style="visibility:collapse;"></td>
                            <th bgcolor="#EAF4FF" class="text-center">รวมเป็นเงิน</th>
                            <th class="text-center" bgcolor="#EAF4FF"><?php echo $total_price_money; ?></th>
                          </tr>
                        </tbody>
                    </table>
                    <div class="col-md-8">
                    </div>
                    <div class="col-md-4">
                      <table class="table table-bordered table-hover">
                        <tbody>
                        <tr>
                        <th class="text-center">จำนวนเงินที่รับมา</th>
                        <th class="text-center"> <input class="text-center" type="text" name="money_receive" placeholder="ระบุจำนวนเงิน"></th>
                        </tr>
                        </tbody>
                      </table>
                      <div class="col-md-4">
                      </div>
                      <div class="col-md-5">
                      
                      <button type="submit" class="btn btn-block btn-success" ><i class="fa fa-print"> พิมพ์ใบเสร็จ  </i></button>
                      </div>
                      <div class="col-md-3">
                      </div>
                    </div>
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
