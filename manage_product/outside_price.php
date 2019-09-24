<?php 
  require "../config_database/config.php"; 
  require "../session.php";
  //require "session.php"; 
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
    <?php require"menu/main_header.php";?>
    </header>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <div class="box box-primary">
            <div class="box-header text-center">
              <font size="5">
                <B>รายการขายสินค้า</B>
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
                        <th class="text-center">สินค้า_หน่วย</th>
                        <th class="text-center" width="15%">จำนวน</th>
                        <th class="text-center" width="15%">บ/หน่วย</th>
                        <th class="text-center" width="15%">รวมเงิน(บ)</th>
                      </tr>
                      <?php
                          for($i=0;$i<count($_POST["menu"]);$i++)
                          {
                            if(trim($_POST["menu"][$i]) != "")
                              {
                                $id_numproduct = $_POST['menu'][$i];
                                $list_product = "SELECT * FROM product INNER JOIN num_product ON product.id_product = num_product.id_product WHERE num_product.id_numproduct = $id_numproduct";
                                $objq_listproduct = mysqli_query($conn,$list_product);
                                $objr_listproduct = mysqli_fetch_array($objq_listproduct);
                      ?>
                      <tr>
                        <td class="text-center"><?php echo $i+1; ?></td>
                        <td><?php echo $objr_listproduct['name_product'].'_'.$objr_listproduct['unit']; ?></td>
                        <td>
                            <input class="hidden" type="text" name="id_numproduct[]" value="<?php echo $id_numproduct; ?>">
                            <input class="text-center" type="text" name="num_product[]" placeholder="<?php echo $objr_listproduct['unit'];?>">
                        </td>
                        <td class="text-center"><input class="text-center" type="text" name="price_product[]" placeholder="ราคา/หน่วย"> </td>
                        <td></td>
                      </tr>
                      <?php 
                              }
                          }
                      ?>
                        <td style="visibility:collapse;"></td>
                        <td style="visibility:collapse;"></td>
                        <td bgcolor="#99CCFF" class="text-center">ผู้เบิกนอกเขต</td>
                        <td colspan="2" bgcolor="#99CCFF" class="text-center">
                          <select name="id_member" class="form-control text-center select2" style="width: 100%;">
                          <option value="">------กรุณาเลือกผู้เบิก------</option>
                            <?php #endregion
                            $sql_outside = "SELECT * FROM outside";
                            $objq_outside = mysqli_query($conn, $sql_outside);
                            while ($outside = $objq_outside->fetch_assoc()) {
                              $id_outside = $outside['id_outside'];
                              
                              ?>
                              <option value="<?php echo $id_outside; ?>"><?php echo $outside['name'].'  '.$outside['province']; ?> </option>
                            <?php   
                              }
                            ?>
                          </select>
                        </td>
                    </tbody>
                  </table>
                
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
            <!-- /.box-footer -->
            <div class="box-footer">
              <a type="block" href="../product.php" class="btn btn-success pull-left"> <<= กลับสู่หน้าหลัก </i> </a> 
              <button type="submit" class="btn btn-success pull-right"><i class="fa fa-calculator"> คำนวณเงิน </i></button>
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