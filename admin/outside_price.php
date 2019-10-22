<?php 
  require "../config_database/config.php"; 
  require "../session.php";
  require "menu/date.php";
?>

<!DOCTYPE html>
<html>

<head>
  <?php require('../font/font_style.php');?>
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
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class=" hold-transition skin-blue layout-top-nav ">
  <div class="wrapper">

    <header class="main-header">
    <?php require('menu/header_logout.php');?>
    </header>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="box box-primary">
            <div class="box-header text-center">
              <font size="5">
                <B>ใบแจ้งหนี้</B>
              </font>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                <form action="outside_price2.php" method="post" autocomplete="off">
                <table class="table table-bordered">
                    <tbody>
                      <tr bgcolor="#99CCFF">
                        <th class="text-center" width="5%">ลำดับ</th>
                        <th class="text-center" width="45%">สินค้า</th>
                        <th class="text-center" width="5%">หน่วย</th>
                        <th class="text-center" width="12%">คงเหลือ</th>
                        <th class="text-center" width="9%">จำนวนขาย</th>
                        <th class="text-center" width="9%">บ/หน่วย</th>
                        <th class="text-center" width="15%">เป็นเงิน</th>
                      </tr>
                      
                      <?php
                        $date_buy = $_POST['date_buy'];
                        $id_outside = $_POST['id_outside'];
                        $id_zone = $_POST['id_zone'];
                            for($i=0;$i<count($_POST["id_product"]);$i++)
                            {
                              if(trim($_POST["id_product"][$i]) != "")
                                {
                                  $id_product = $_POST['id_product'][$i];
                                  $list_product = "SELECT * FROM num_product INNER JOIN product ON product.id_product = num_product.id_product 
                                                    WHERE num_product.id_product = $id_product AND num_product.id_zone = $id_zone";
                                  $objq_listproduct = mysqli_query($conn,$list_product);
                                  $objr_listproduct = mysqli_fetch_array($objq_listproduct);
                      ?>
                      <tr>
                        <td class="text-center"><?php echo $i+1; ?></td>
                        <td>
                          <?php echo $objr_listproduct['full_name']; ?>
                          <input class="hidden" type="text" name="name_pd[]" value="<?php echo $objr_listproduct['full_name']; ?>">
                          <input class="hidden" type="text" name="unit[]" value="<?php echo $objr_listproduct['unit']; ?>">
                          <input class="hidden" type="text" name="id_product[]" value="<?php echo $objr_listproduct['id_product']; ?>">
                        </td>
                        <td class="text-center"><?php echo $objr_listproduct['unit']; ?></td>
                        <td class="text-center"><?php echo $objr_listproduct['num']; ?></td>
                        <td class="text-center">
                          <input class="hidden" type="text" name="id_numproduct[]" value="<?php echo $objr_listproduct['id_numproduct']; ?>">
                          <input class="text-center" size="8" type="text" name="num_pd[]" placeholder="<?php echo $objr_listproduct['unit'];?>">
                        </td>
                        <td class="text-center"><input class="text-center" size="8" type="text" name="price_pd[]" value="<?php echo $objr_listproduct['price_outside'];?>"> </td>
                        <td></td>
                      </tr>
                      <?php 
                              }
                          }
                      ?>
                      <input class="hidden" type="text" name="date_buy" value="<?php echo $date_buy; ?>">
                      <input class="hidden" type="text" name="id_zone" value="<?php echo $id_zone; ?>">
                      <input class="hidden" type="text" name="id_outside" value="<?php echo $id_outside; ?>">
                      <tr bgcolor="#99CCFF">
                        <td style="visibility:collapse;"></td>
                        <td style="visibility:collapse;"></td>
                        <td style="visibility:collapse;"></td>
                        <td style="visibility:collapse;"></td>
                        <td style="visibility:collapse;"></td>
                        <th  class="text-center">รวมเงิน</th>
                        <th class="text-center"></th>
                      </tr>
                      <tr>
                        <td style="visibility:collapse;"></td>
                        <td style="visibility:collapse;"></td>
                        <td style="visibility:collapse;"></td>
                        <td style="visibility:collapse;"></td>
                        <td style="visibility:collapse;"></td>
                        <td style="visibility:collapse;"></td>
                      </tr>
                      <tr>
                        <td style="visibility:collapse;"></td>
                        <td style="visibility:collapse;"></td>
                        <td style="visibility:collapse;"></td>
                        <td style="visibility:collapse;"></td>
                        <td class="text-right">ผู้เบิก &nbsp;:</td>
                        <td colspan="2" class="text-left">
                            <?php #endregion
                              $sql_outside = "SELECT * FROM outside WHERE id_outside = $id_outside";
                              $objq_outside = mysqli_query($conn, $sql_outside);
                              $objr_outside = mysqli_fetch_array($objq_outside);
                              echo $objr_outside['name'];
                            ?>
                        </td>
                      </tr>
                      <tr>
                        <td style="visibility:collapse;"></td>
                        <td style="visibility:collapse;"></td>
                        <td style="visibility:collapse;"></td>
                        <td style="visibility:collapse;"></td>
                        <td class="text-right">เบิกจาก &nbsp;:</td>
                        <td colspan="2" class="text-left">
                        <?php #endregion
                              $sql_zone = "SELECT * FROM zone WHERE id_zone = $id_zone";
                              $objq_zone = mysqli_query($conn, $sql_zone);
                              $objr_zone = mysqli_fetch_array($objq_zone);
                              echo $objr_zone['name_zone'];
                        ?>
                        </td>
                      </tr>
                      <tr>
                        <td style="visibility:collapse;"></td>
                        <td style="visibility:collapse;"></td>
                        <td style="visibility:collapse;"></td>
                        <td style="visibility:collapse;"></td>
                        <td class="text-right">วันที่ซื้อ &nbsp;:</td>
                        <td colspan="2" class="text-left">
                        <?php #endregion
                             echo DateThai($date_buy);
                        ?>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
            <!-- /.box-footer -->
            <div class="box-footer">
              <a type="block" href="outside.php" class="btn btn-success pull-left"><< กลับ</i></a> 
              <button type="submit" class="btn btn-success pull-right" ><i class="fa fa-calculator"> คำนวณเงิน </i></button>
            </div>
            </form>
            <!-- /.box-footer -->
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