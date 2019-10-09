<?php
  require "../config_database/config.php";
  require 'menu/date.php';
  $month = $_POST['month'];
  $year = $_POST['year'];
?>
<!DOCTYPE html>
<html>

<head>
  <?php require('../font/font_style.php'); ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>เพิ่ม ORDER ใหม่</title>
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
</head>

<body class=" hold-transition skin-blue layout-top-nav">
  <div class="wrapper">
    <header class="main-header">
    <?php //require('menu/header_logout.php');?>
    </header>
    
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
          
            <div class="box-header text-center with-border">
            <table class="table table-bordered" >
                <tr>
                  <th width="30%" >
                    <a type="block" href="outside.php" class="btn btn-danger"><< กลับ</a>
                  </th>
                  <td width="40%" class="text-center"><font size="5"><B align="center"> ยอดสั่งรายเดือน (นอกเขต) </B></font></td>
                  <td width="30%"> 
                    <a href="../pdf_file/outside_list2.php?month=<?php echo $month;?>&&year=<?php echo $year;?>" class="btn btn-success">ยอดสั่งรายเดือน (PDF)</a>
                  </td>
                </tr>
              </table>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dynamic_field">
                      <tr>
                        <th bgcolor="#99CCFF" class="text-center" width="20%">สินค้า_หน่วย</th>
                        <th bgcolor="#99CCFF" class="text-center" width="14%">เขตแพร่</th>
                        <th bgcolor="#99CCFF" class="text-center" width="14%">เขตน่าน</th>
                        <th bgcolor="#99CCFF" class="text-center" width="14%">เขตเชียงใหม่</th>
                        <th bgcolor="#99CCFF" class="text-center" width="14%">เขตลำพูน</th>
                        <th bgcolor="#99CCFF" class="text-center" width="14%">เขตเชียงราย</th>
                        <th bgcolor="#99CCFF" class="text-center" width="10%">รวม</th>
                      </tr>
                    <?php 
                      
                      $sql_product = "SELECT * FROM product WHERE NOT id_product = 2 AND NOT id_product = 4 AND NOT id_product = 6 AND NOT id_product = 10
                      AND NOT id_product = 33 AND NOT id_product = 35 AND NOT id_product = 12";
                      $objq_product = mysqli_query($conn,$sql_product);
                      while($value = $objq_product->fetch_assoc()){
                        $id_product = $value['id_product'];
                    ?>
                      <tr>    
                        <td class="text-center"><?php echo $value['name_product'].'_'.$value['unit']; ?></td>
                      <?php 
                       $total_num = 0;
                        for ($i=1; $i <=5 ; $i++) { 
                        $sql_num = "SELECT SUM(num_pd) FROM outside_buy_htr WHERE id_outside = $i AND id_product = $id_product AND (date_buy between '$year-$month-01 00:00:00' and '$year-$month-31 23:59:59')";
                        $objq_num = mysqli_query($conn,$sql_num);
                        $objr_num = mysqli_fetch_array($objq_num);
                        $sum_num = $objr_num['SUM(num_pd)'];
                        
                      ?>
                        <td class="text-center"><?php echo $sum_num;?></td>
                      <?php 
                      $total_num = $total_num + $sum_num;
                          }  
                      ?>
                      <td class="text-center"><?php echo $total_num; ?></td>
                      </tr>
                    <?php  
                      }
                    ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>
        </div>
      </section>
      </div>
    <!-- /.content-wrapper -->
        <?php require("../menu/footer.html"); ?>
      </div>

      <!-- jQuery 3 -->
      <script src="../bower_components/jquery/dist/jquery.min.js">
      </script>
      <!-- Bootstrap 3.3.7 -->
      <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js">
      </script>
      <!-- DataTables -->
      <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js">
      </script>
      <script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js">
      </script>
      <!-- SlimScroll -->
      <script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js">
      </script>
      <!-- FastClick -->
      <script src="../bower_components/fastclick/lib/fastclick.js">
      </script>
      <!-- AdminLTE App -->
      <script src="../dist/js/adminlte.min.js">
      </script>
      <!-- AdminLTE for demo purposes -->
      <script src="../dist/js/demo.js">
      </script>
      <script src="../plugins/iCheck/icheck.min.js">
      </script>

</body>

</html>