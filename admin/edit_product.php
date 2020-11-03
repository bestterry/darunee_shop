<?php 
  require "../config_database/config.php";
  require "../session.php"; 

  $id_product = $_GET['id_product'];
  $list_product = "SELECT * FROM product WHERE id_product = $id_product";
  $objq_listproduct = mysqli_query($conn,$list_product);
  $objr_listproduct = mysqli_fetch_array($objq_listproduct);
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
      <?php require('menu/header_logout.php');?>
    </header>

    <div class="content-wrapper">
      <section class="content-header">
      </section>

      <section class="content">
        <form action="algorithm/edit_product.php" method="post" class="form-horizontal" autocomplete="off">
          <div class="box box-primary">
            <div class="box-header text-center with-border">
              <font size="5">
                <B align="center"> แก้ไขข้อมูลสินค้า </B>
              </font>
            </div>

            <div class="box-body with-border">
              <div class="row">
                <div class="col-md-3 col-sm-3 col-lg-3"></div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                  <div class="row">
                    <div class="form-group">
                      <label class="col-sm-3 col-md-3 col-6 control-label">ชื่อย่อ</label>
                      <div class="col-sm-6 col-md-6 col-6">
                        <input type="hidden" name="id_product" class="form-control text-center " value="<?php echo $objr_listproduct['id_product']; ?>">
                        <input type="text" name="name_product" class="form-control text-center " value="<?php echo $objr_listproduct['name_product']; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group">
                      <label class="col-sm-3 col-md-3 col-6 control-label">ชื่อเต็ม</label>
                      <div class="col-sm-6 col-md-6 col-6">
                        <input type="text" name="full_name" class="form-control text-center" value="<?php echo $objr_listproduct['full_name']; ?>">  
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group">
                      <label class="col-sm-3 col-md-3 col-6 control-label">หน่วย</label>
                      <div class="col-sm-6 col-md-6 col-6">
                        <input type="text" name="unit" class="form-control text-center" value="<?php echo $objr_listproduct['unit']; ?>">  
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group">
                      <label class="col-sm-3 col-md-3 col-6 control-label">ราคาซื้อมา(บ)</label>
                      <div class="col-sm-6 col-md-6 col-6">
                        <input type="number" name="price_num" class="form-control text-center " value="<?php echo $objr_listproduct['price_num']; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group">
                      <label class="col-sm-3 col-md-3 col-6 control-label">ราคาขาย(บ)</label>
                      <div class="col-sm-6 col-md-6 col-6">
                        <input type="number" name="price_outside" class="form-control text-center " value="<?php echo $objr_listproduct['price_outside']; ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-3 col-lg-3"></div>
              </div>
            </div>

            <div class="box-footer">
              <a type="block" href="add_data.php" class="btn btn-danger"><< กลับ </i> </a> 
              <button type="submit" class="btn btn-success pull-right" onClick="return confirm('คุณต้องการที่จะบันทึกข้อมูลหรือไม่ ?')";><i class="fa fa-save" > บันทึก </i></button>
            </div>
          </div>
        </form>
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