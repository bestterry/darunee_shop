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
    <?php require"menu/main_header.php";?>
    </header>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="height: 1500px;">
      <!-- Content Header (Page header) -->
      <section class="content-header">
      </section>

      <!-- Main content -->
      <section class="content">
       <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="box box-primary">
            <div class="box-header with-border">
              <font size="5">
                <B> รายการรับเข้าสินค้า <font color="red"><?php require"../menu/date.php";?></font> </B>
              </font>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
              <table class="table table-striped table-bordered">
                <tbody>
                  <tr class="info">
                    <th class="text-center" width="40%">สินค้า_หน่วย</th>
                    <th class="text-center" width="15%">จำนวนรับเข้า</th>
                    <th class="text-center" width="15%">ผู้ส่ง</th>
                    <th class="text-center" width="35%">หมายเหตุ</th>
                    <!-- <th class="text-center" width="10%">แก้ไข</th> -->
                  </tr>
                  <?php #endregion
                      $date = "SELECT * FROM add_history INNER JOIN product ON add_history.id_product = product.id_product INNER JOIN member ON add_history.id_member = member.id_member
                                WHERE DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate' AND add_history.id_zone = $id_zone";
                      $objq = mysqli_query($conn,$date);
                      while($value = $objq ->fetch_assoc()){
                  ?>
                  <tr>
                    <td>
                      <?php echo $value['name_product'].'_'.$value['unit']; ?>
                    </td>
                    <td class="text-center">
                      <?php echo $value['num_add'];?> 
                    </td>
                    <td class="text-center">
                      <?php echo $value['name'];?>
                    </td>
                    <td class="text-center">
                      <?php echo $value['note'];?>
                    </td>
                    <!-- <td class="text-center">
                      <a href="edit_add_history.php?id_add=<?php echo $value['id_add_history']; ?>"><span
                          class="glyphicon glyphicon-cog"></span></a>
                    </td> -->
                  </tr>
                  <?php
                                  }
                                ?>
                </tbody>
              </table>
</div>
<!-- /.mailbox-read-message -->
<div class="box-header with-border">
  <font size="5">
    <B> ยอดรับเข้า
      <font  color="red">
        <?php ?>
      </font>
  </font>
  </B>
</div>
<!-- /.box-header -->
<div class="box-body no-padding">
  <div class="mailbox-read-message">
    <table class="table table-striped table-bordered">
      <tbody>
        <tr class="info">
          <th class="text-center" width="40%">สินค้า_หน่วย</th>
          <th class="text-center" width="20%">จำนวน</th>
        </tr>
        <?php #endregion
                    $sql_history = "SELECT * FROM product";
                    $objq_history = mysqli_query($conn,$sql_history);
                    while($history = $objq_history ->fetch_assoc()){
                      $id_product = $history['id_product'];
                      $total_sale = "SELECT SUM(add_history.num_add) FROM add_history 
                                      INNER JOIN product ON add_history.id_product=product.id_product
                                      WHERE add_history.id_product = '$id_product' AND DATE_FORMAT(add_history.datetime,'%d-%m-%Y')='$strDate' AND add_history.id_zone=$id_zone";
                      $objq_sale = mysqli_query($conn,$total_sale);
                      $objr_sale = mysqli_fetch_array($objq_sale);
                      $num_product = $objr_sale['SUM(add_history.num_add)'];
                      if(isset($num_product)){ 
                  ?>
        <tr>
          <td>
            <?php echo $history['name_product'].'_'.$history['unit']; ?>
          </td>
          <td class="text-center">
            <?php echo$num_product; ?> 
          </td>
        </tr>
        <?php }
                        
                  } ?>
      </tbody>
    </table>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <div class="box-footer">
              <a type="block" href="../product.php" class="btn btn-success"><<= กลับสู่หน้าหลัก </i> </a> 
              <a type="button" href="../pdf_file/add_history.php" class="btn btn-success pull-right"> <i class="fa fa-print"> พิมพ์ </i></a>
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