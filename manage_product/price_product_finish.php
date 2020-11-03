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

  <body class=" hold-transition skin-blue layout-top-nav ">
    <div class="wrapper">
      <header class="main-header">
        <?php require "menu/main_header.php"; ?>
      </header>
      <div class="content-wrapper">
        <section class="content-header">
        </section>
        <section class="content">
          <div class="box box-primary">
            <form action="show_price.php" method="post" autocomplete="off">
              <div class="box-header text-center with-border">
                <font size="5"><B> รายการขายสินค้า </font></B>
              </div>
              <div class="box-body no-padding">
                <div class="mailbox-read-message">
                  <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th class="text-center">สินค้า_หน่วย</th>
                          <th class="text-center" width="15%">จำนวน</th>
                          <th class="text-center" width="15%">บ/หน่วย</th>
                          <th class="text-center" width="15%">รวมเงิน(บ)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php //คำนวณสรายการสินค้า
                          $note = $_POST['note'];
                            $total_price_money = 0;
                            for($i=0;$i<count($_POST['id_numproduct']);$i++){
                              $id_numproduct = $_POST['id_numproduct'][$i];
                              $num_product = $_POST['num_product'][$i];
                              $price_product = $_POST['price_product'][$i];
                              $total_price = $num_product*$price_product;

                              $num_product_instore="SELECT * FROM product INNER JOIN num_product ON product.id_product = num_product.id_product WHERE num_product.id_numproduct = $id_numproduct";
                              $objq_num_product_instore = mysqli_query($conn,$num_product_instore);
                              $objr_num_product_instore = mysqli_fetch_array($objq_num_product_instore);
                              $total_num_product = $objr_num_product_instore['num']-$num_product;
                              $name_product = $objr_num_product_instore['name_product'];
                              $unit = $objr_num_product_instore['unit'];
                              $id_product = $objr_num_product_instore['id_product'];
                              if($total_num_product < 0){
                                echo "สินค้ามีจำนวนไม่เพียงพอ";
                              }else{
                                //Update NUM product in database
                                $update_num_product = "UPDATE num_product SET num = $total_num_product WHERE id_numproduct = $id_numproduct";
                                $objq_update = mysqli_query($conn,$update_num_product);
                                //INsert history buy product
                                if($price_product == 0){
                                  $status = "free";
                                }else{
                                  $status = "sale";
                                }
                                $insert_history = "INSERT INTO price_history (num, price, money, id_product, status, id_zone, note)
                                                   VALUES ($num_product, $price_product, $total_price, $id_product, '$status', $id_zone, '$note')";
                                mysqli_query($conn,$insert_history);
                                
                        ?>
                        <tr>
                          <td class="text-center"><?php echo $name_product.'_'.$objr_num_product_instore['unit']; ?></td>
                          <td class="text-center"><?php echo $num_product; ?></td>
                          <td class="text-center"><?php echo $price_product; ?> </td>
                          <input class="hidden" type="text" name="name_product[]" value="<?php echo $name_product; ?>">
                          <input class="hidden" type="text" name="unit[]" value="<?php echo $unit; ?>">
                          <input class="hidden" type="text" name="num_product[]" value="<?php echo $num_product; ?>">
                          <input class="hidden" type="text" name="price_product[]" value="<?php echo $price_product; ?>">
                          <td class="text-center"><?php echo $total_price;?></td>
                        </tr>
                        <?php
                              }
                              $total_price_money = $total_price_money + $total_price;
                            }
                        ?>
                        <tr>
                          <td style="visibility:collapse;"></td>
                          <td style="visibility:collapse;"></td>
                          <th bgcolor="#EAF4FF" class="text-center">รวมเป็นเงิน</th>
                          <th class="text-center" bgcolor="#EAF4FF"><?php echo $total_price_money; ?></th>
                        </tr>
                      </tbody>
                    </table>

                    <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                      <table class="table table-bordered ">
                        <tbody>
                          <tr>
                            <th class="text-center" width="25%">หมายเหตุ</th>
                            <th width="75%"><input class="text-center form-control" type="text" value="<?php echo $note;?>" disabled></th>
                          </tr>
                        </tbody>
                      </table> 
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                      <table class="table table-bordered">
                        <tbody>
                          <tr bgcolor="#99CCFF">
                            <th class="text-center">จำนวนเงินที่รับมา</th>
                            <th> <input class="text-center form-control" type="text" name="money_receive" placeholder="ระบุจำนวนเงิน" ></th>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div align="center" class="box-footer">
                <a type="block" href="../product.php" class="btn btn-danger pull-left"> << กลับ</a> 
                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-calculator"> คำนวณเงิน </i></button>
              </div>
            </form>
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