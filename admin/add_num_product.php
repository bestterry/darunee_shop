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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <div class="box box-primary">
            <div class="box-header with-border">
              <font size="6">
                <p align="center"> รายการสินค้าที่ต้องการเพิ่ม
              </font>
              </p>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                <form action="algorithm/add_num_product.php" method="post" autocomplete="off">
                <table class="table table-striped ">
                  <tbody>
                    <tr class="info" >
                        <th class="text-center" width="5%">ลำดับ</th>
                        <th class="text-center">ชื่อสินค้า</th>
                        <th class="text-center" width="25%">จำนวนสินค้าที่ต้องการเพิ่ม</th>
                      </tr>
                      <?php
                            for($i=0;$i<count($_POST["id_product"]);$i++)
                            {
                              if(trim($_POST["id_product"][$i]) != "")
                                {
                                  $id_product = $_POST['id_product'][$i];
                                  $list_product = "SELECT * FROM product WHERE id_product = $id_product";
                                  $objq_listproduct = mysqli_query($conn,$list_product);
                                  $objr_listproduct = mysqli_fetch_array($objq_listproduct);
                          ?>
                      <tr>
                        <td class="text-center"><?php echo $i+1; ?></td>
                        <td>
                          <?php echo $objr_listproduct['name_product'].' ('.$objr_listproduct['unit'].')'; ?>
                          <input class="hidden" type="text" name="id_product[]"
                            value="<?php echo $objr_listproduct['id_product']; ?>">
                        </td>
                        <td class="text-center">
                          <input type="text" name="num[]" class="form-control text-center col-md-2"
                            placeholder="ระบุจำนวน">
                        </td>
                      </tr>
                      <?php 
                                  }
                              }
                            ?>
                    </tbody>
                  </table>
                  <div class="col-md-8">
                  </div>
                  <div class="col-md-4">
                    <table class="table table-bordered">
                      <tbody>
                        <tr>
                          <th class="text-center">เพิ่มไปยังสต๊อก
                          </th>
                          <th bgcolor="#99CCFF" class="text-center" width="40%">
                            <select name="id_zone" class="form-control text-center select2" style="width: 100%;">
                              <?php #endregion
                                  $sql_member = "SELECT * FROM zone ";
                                  $objq_member = mysqli_query($conn,$sql_member);
                                  while($member = $objq_member -> fetch_assoc()){
                                  ?>
                              <option value="<?php echo $member['id_zone']; ?>"><?php echo $member['name_zone']; ?>
                              </option>
                              <?php } ?>
                            </select>
                          </th>
                        </tr>
                      </tbody>
                    </table>
                  </div>

              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <div class="box-footer">
              <a type="block" href="admin.php" class="btn btn-success"><<== กลับสู่เมนูหลัก </i></a> 
              <button type="submit" class="btn btn-success pull-right" onClick="return confirm('คุณต้องการที่จะบันทึกข้อมูลนี้หรือไม่ ?')";><i class="fa fa-calculator"> บันทึก </i></button>
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