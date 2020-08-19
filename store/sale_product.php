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
    <link rel="icon" type="image/png" href="../images/favicon.ico"/>
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
  <script language="javascript">
    function fncSubmit()
    {
      if(document.sale_product.customer.value == "")
      {
        alert('กรุณาระบุชื่อลูกค้า');
        document.sale_product.customer.focus();
        return false;
      }	
      if(document.sale_product.note.value == "")
      {
        alert('กรุณาระบุหมายเหตุ');
        document.sale_product.note.focus();		
        return false;
      }
      document.sale_product.submit();
    }
  </script>
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
      <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <font size="5"><p align = "center"> <B>รายการขายสินค้า<B> </font></p>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <div class="mailbox-read-message">
                  <form action="sale_product_finish.php" method="post" autocomplete="off" name="sale_product" onSubmit="JavaScript:return fncSubmit();">
                    <table class="table table-bordered">
                        <tbody>
                          <tr bgcolor="#99CCFF">
                            <th class="text-center">สินค้า_หน่วย</th>
                            <th class="text-center" width="17%">คงเหลือ</th>
                            <th class="text-center" width="17%">จำนวน</th>
                            <th class="text-center" width="17%">บ/หน่วย</th>
                            <th class="text-center" width="17%">เงินขาย(บ)</th>
                          </tr>
                          <?php
                            for($i=0;$i<count($_POST["id_numPD"]);$i++)
                            {
                              if(trim($_POST["id_numPD"][$i]) != "")
                                {
                                  $id_numPD=$_POST['id_numPD'][$i];
                                  $list_product = "SELECT * FROM numpd_car
                                                  INNER JOIN product ON numpd_car.id_product = product.id_product
                                                  WHERE numpd_car.id_numPD_car = $id_numPD";
                                  $objq_listproduct = mysqli_query($conn,$list_product);
                                  $objr_listproduct = mysqli_fetch_array($objq_listproduct);
                          ?>
                          <tr>
                            <td class="text-center">
                              <?php echo $objr_listproduct['name_product'].'_'.$objr_listproduct['unit']; ?>
                              <input class = "hidden" type="text" name="name_product[]" value="<?php echo $objr_listproduct['name_product']; ?>">
                              <input class = "hidden" type="text" name="id_product[]" value="<?php echo $objr_listproduct['id_product']; ?>">
                              <input class = "hidden" type="text" name="unit[]" value="<?php echo $objr_listproduct['unit']; ?>">
                            </td>
                            <td class="text-center"> <?php echo $objr_listproduct['num']; ?></td>
                            <td class="text-center" >
                              <input class = "hidden" type="text" name="id_numPD[]" value="<?php echo $id_numPD; ?>">
                              <input class="form-control text-center" type="number" name="num_product[]"   placeholder="<?php echo $objr_listproduct['unit'];?>">
                            </td>
                            <td class="text-center">
                              <input class="form-control text-center" type="number" step="0.01" name="price_product[]" value="0">
                            </td>
                            <td></td>
                          </tr>
                            <?php 
                                  }
                              }
                            ?>
                        </tbody>
                    </table>
                    <div class="col-md-12">
                      <table class="table table-bordered">
                        <tbody>
                        <tr bgcolor="#99CCFF">
                          <th class="text-center" width="15%">ลูกค้า : </th>
                          <th class="text-center" width="35%"> <input class="text-center form-control" type="text" name="customer" value="" placeholder="กรุณาระบุชื่อลูกค้า"></th>
                          <th class="text-center" width="15%">รายละเอียด : </th>
                          <th class="text-center" width="35%"> <input class="text-center form-control" type="text" value="" name="note"></th>
                        </tr>
                        </tbody>
                      </table>
                    </div>
                </div>
                <!-- /.mailbox-read-message -->
            </div>
            <div class="box-footer">
            <a type="block" href="store.php" class="btn btn-danger"><< เมนูหลัก </i></a>
            <button type="submit" class="btn btn-success pull-right" name="add" id="add" onClick="return confirm('คุณต้องการที่จะบันทึกข้อมูลนี้หรือไม่ ?')";><i class="fa fa-calculator"> บันทึก </i></button>
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
