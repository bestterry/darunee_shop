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
    <title>โปรแกรมขายหน้าร้าน</title>
    <!-- Tell the browser to be responsive to screen width -->
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

  <body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
      <header class="main-header">
        <?php require "menu/main_header.php"; ?>
      </header>
      <div class="content-wrapper">
        <section class="content-header">
        </section>
        <section class="content">
          <div class="box box-primary">

            <div class="box-header with-border">
              <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                <div class="col-4 col-sm-4 col-md-4 col-xl-4 text-left">
                  <a type="block" href="../product.php" class="btn btn-danger"> << เมนูหลัก </i></a>
                </div>
                <div class="col-4 col-sm-4 col-md-4 col-xl-4 text-center">
                  <B>
                    <font size="5">
                      รายการขาย 
                        <font color="red">
                          <?php require"../menu/date.php";?>
                        </font>
                    </font>
                  </B>
                </div>
                <div class="col-4 col-sm-4 col-md-4 col-xl-4"></div>
              </div>
            </div>

            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th class="text-center" width="35%">สินค้า_หน่วย</th>
                        <th class="text-center" width="15%">จำนวน</th>
                        <th class="text-center" width="12%">บ/หน่วย</th>
                        <th class="text-center" width="13%">เงิน(บ)</th>
                        <th class="text-center" width="25%">หมายเหตุ</th>
                        <th class="text-center" width="10%">แก้ไข</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php #endregion
                        $date = "SELECT * FROM price_history INNER JOIN product ON product.id_product = price_history.id_product	
                                  WHERE DATE_FORMAT(price_history.datetime,'%d-%m-%Y')='$strDate' AND price_history.id_zone = $id_zone";
                        $objq = mysqli_query($conn,$date);
                        while($value = $objq ->fetch_assoc()){
                      ?>
                      <tr>
                        <td class="text-center">
                          <?php echo $value['name_product'].'_'.$value['unit']; ?>
                        </td>
                        <td class="text-center">
                          <?php echo $value['num']; ?>
                        </td>
                        <td class="text-center">
                          <?php echo $value['price']; ?>
                        </td>
                        <td class="text-center">
                          <?php echo $value['money']; ?>
                        </td>
                        <td class="text-center">
                          <?php echo $value['note']; ?>
                        </td>
                        <td class="text-center">
                          <a href="edit_sale_history.php?id_price_history=<?php echo $value['id_price_history'];?>"><i class="fa fa-cog"></i></a>
                        </td>
                      </tr>
                      <?php
                        }
                      ?>
                    </tbody>
                  </table>

                  <div class="text-center">
                    <font size="5">
                      <B> ยอดขาย
                    </font>
                    </B>
                  </div>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th class="text-center" width="40%">สินค้า_หน่วย</th>
                        <th class="text-center" width="20%">จำนวน</th>
                        <th class="text-center" width="20%">เงิน(บ)</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php #endregion
                                  $sum_monny = 0;
                                  $sql_history = "SELECT * FROM product";
                                  $objq_history = mysqli_query($conn,$sql_history);
                                  while($history = $objq_history ->fetch_assoc()){
                                    $id_product = $history['id_product'];
                                    $total_sale = "SELECT SUM(price_history.num),SUM(price_history.money),product.name_product,product.unit FROM price_history 
                                                    INNER JOIN product ON price_history.id_product=product.id_product
                                                    WHERE product.id_product = '$id_product' AND DATE_FORMAT(price_history.datetime,'%d-%m-%Y')='$strDate' AND price_history.id_zone='$id_zone' AND price_history.status = 'sale'";
                                    $objq_sale = mysqli_query($conn,$total_sale);
                                    $objr_sale = mysqli_fetch_array($objq_sale);
                                    $num_product = $objr_sale['SUM(price_history.num)'];
                                    $total_money = $objr_sale['SUM(price_history.money)'];
                                    $name_product = $objr_sale['name_product'];
                                    $unit = $objr_sale['unit'];
                                    if(isset($num_product)){ 
                                ?>

                      <tr>
                        <td class="text-center">
                          <?php echo $name_product.'_'.$unit; ?>
                        </td>
                        <td class="text-center">
                          <?php echo $num_product; ?>
                        </td>
                        <td class="text-center">
                          <?php echo $total_money; ?>
                        </td>
                      </tr>
                      <?php }
                                      $sum_monny = $sum_monny+$total_money;
                                } ?>
                      <tr>
                        <td style="visibility:collapse;"></td>
                        <th class="text-center">รวมเงิน(บ)</th>
                        <th class="text-center"><?php echo $sum_monny; ?></th>
                      </tr>
                    </tbody>
                  </table>

                  <div class="text-center">
                      <B><font size="5"> ยอดแถม</font></B>
                  </div>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th class="text-center" width="50%">สินค้า_หน่วย</th>
                        <th class="text-center" width="50%">จำนวน</th>
                      </tr>        
                    </thead>
                    <tbody>
                      <?php #endregion
                        $sum_monny = 0;
                        $sql_history = "SELECT * FROM product";
                        $objq_history = mysqli_query($conn,$sql_history);
                        while($history = $objq_history ->fetch_assoc()){
                          $id_product = $history['id_product'];
                          $total_sale = "SELECT SUM(price_history.num),SUM(price_history.money),product.name_product,product.unit FROM price_history 
                                          INNER JOIN product ON price_history.id_product=product.id_product
                                          WHERE product.id_product = '$id_product' AND DATE_FORMAT(price_history.datetime,'%d-%m-%Y')='$strDate' AND price_history.id_zone='$id_zone' AND price_history.status = 'free'";
                          $objq_sale = mysqli_query($conn,$total_sale);
                          $objr_sale = mysqli_fetch_array($objq_sale);
                          $num_product = $objr_sale['SUM(price_history.num)'];
                          $total_money = $objr_sale['SUM(price_history.money)'];
                          $name_product = $objr_sale['name_product'];
                          $unit = $objr_sale['unit'];
                          if(isset($num_product)){ 
                      ?>
                      <tr>
                        <td class="text-center">
                          <?php echo $name_product.'_'.$unit; ?>
                        </td>
                        <td class="text-center">
                          <?php echo $num_product; ?>
                        </td>
                      </tr>
                      <?php }
                            } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="box-footer" align="center">
              <a type="button" href="../pdf_file/sale_history.php" class="btn btn-success">
                <i class="fa fa-print"> พิมพ์ </i>
              </a>
            </div>

          </div>
        </section>
      </div>
      <?php require("../menu/footer.html"); ?>
    </div>

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