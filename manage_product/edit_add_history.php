<?php require "../config_database/config.php"; ?>

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

        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <font size="4"><B> แก้ไขประวัติรับเข้าสินค้า </font></B>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                <form action="algorithm/edit_add_history.php" method="post" autocomplete="off">
                  <table class="table table-bordered table-hover">
                    <tbody>
                      <tr bgcolor="#99CCFF">
                        <th class="text-center">ชื่อสินค้า</th>
                        <th class="text-center" width="15%">จำนวนสินค้า</th>
                        <th class="text-center" width="10%">หน่วยนับ</th>
                        <th class="text-center" width="15%">ชื่อผู้นำเข้า</th>
                      </tr>

                      <tr>
                        <?php
                            $id_add= $_GET['id_add']; 
                            $SQL_product = "SELECT * FROM product 
                            INNER JOIN add_history ON product.id_product = add_history.id_product 
                            INNER JOIN member ON add_history.id_member = member.id_member
                            WHERE add_history.id_add_history='$id_add'";
                            $objq_product = mysqli_query($conn,$SQL_product);
                            $objr_product = mysqli_fetch_array($objq_product);
                          ?>
                        <td class="text-center"><input type="text" name="name_product"
                            class="form-control text-center col-md-1"
                            value="<?php echo $objr_product['name_product'];?>" readonly /></td>
                        <td>
                          <input type="text" name="after_num" class="form-control text-center col-md-1"
                            value="<?php echo $objr_product['num_add'];?>">
                          <input type="hidden" name="befor_num" class="form-control text-center col-md-1"
                            value="<?php echo $objr_product['num_add'];?>">
                        </td>
                        <td class="text-center">
                          <input type="hidden" name="id_add_history" value="<?php echo $id_add;?>">
                          <input type="text" class="form-control text-center col-md-1"
                            value="<?php echo $objr_product['unit'];?>" readonly />
                        </td>
                        <td class="text-center">
                          <input type="text" name="name" class="form-control text-center col-md-1"
                            value="<?php echo $objr_product['name'];?>" readonly />
                        </td>
                      </tr>

                    </tbody>
                  </table>
                  <div class="col-md-8">
                  </div>
                  <div class="col-md-4">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-5">
                      <button type="submit" class="btn btn-success"><i class="fa fa-check-square"> บันทึก </i></button>
                      <a href="algorithm/delete_add_history.php?id=<?php echo $id_add;?>" class="btn btn-danger"><i
                          class="fa fa-minus-square"> ลบ </i></a>
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