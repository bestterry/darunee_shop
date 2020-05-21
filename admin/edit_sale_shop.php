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

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <!-- form start -->
          <div class="col-md-12">
              <div class="tab-content">
              
                  <div class="box box-default">
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="row">
                        <div class="container">
                          <form action="algorithm/edit_price_history.php" method="post" autocomplete="off">
                            <div class="box-header with-border text-center">
                              <font size="5" >
                                <B>
                                  แก้ไขรายการขาย
                                </B>
                              </font>
                            </div>
                            <table class="table table-bordered">
                              <tbody>
                                <tr bgcolor="#99CCFF">
                                  <th class="text-center" width="21%">สินค้า_หน่วย</th>
                                  <th class="text-center" width="13%">จำนวน</th>
                                  <th class="text-center" width="11%">บ/หน่วย</th>
                                  <th class="text-center" width="11%">เงินขาย(บ)</th>
                                  <th class="text-center" width="24%">รายละเอียด</th>
                                  <th class="text-center" width="10%">ผู้ขาย</th>
                                  <th class="text-center" width="10%">เวลา</th>
                                </tr>
                                <?php #endregion
                                    $id_price = $_GET['id_price_history'];
                                    $data = "SELECT * FROM price_history 
                                             INNER JOIN product ON price_history.id_product = product.id_product 
                                             INNER JOIN zone ON price_history.id_zone = zone.id_zone
                                             WHERE price_history.id_price_history = $id_price";  
                                            
                                    $objq = mysqli_query($conn,$data);
                                    $objr = mysqli_fetch_array($objq);
                                ?>
                                <tr>
                                  <input  type="hidden" name="id_price_history" class="form-control text-center" value="<?php echo $objr['id_price_history'];?>">
                                  <td class="text-center"><?php echo $objr['name_product'].'_'.$objr['unit']; ?></td>
                                  <td><input type="number" name="num" class="form-control text-center" value="<?php echo $objr['num'];?>"></td>
                                  <td><input type="number" name="price" class="form-control text-center" value="<?php echo $objr['price'];?>"></td>
                                  <td><input type="number" name="money" class="form-control text-center" value="<?php echo $objr['money'];?>"></td>
                                  <td><input type="text" name="note"  class="form-control text-center" value="<?php echo $objr['note'];?>"></td>
                                  <td class="text-center"><?php echo $objr['name_zone']; ?></td>
                                  <td class="text-center"> <?php echo DateThai2($objr['datetime']); ?></td>
                                </tr>
                              </tbody>
                            </table>
                            <div class="box-footer" align="center">
                              <button type="submit" class="btn btn-success" onClick="return confirm('คุณต้องการที่จะบันทึกข้อมูลนี้หรือไม่ ?')";><i class="fa fa-save"></i> บันทึก </button>
                              <a href="algorithm/delete_price_history.php?id_price_history=<?php echo $id_price_history;?>" class="btn btn-danger" onClick="return confirm('คุณต้องการที่จะลบข้อมูลนี้หรือไม่ ?')";> ลบ </a>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                <!-- /เเก้ไขสินค้า -->
              </div>
              <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
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