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
    <?php require('menu/header_logout.php');?>
    </header>
    
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">

        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header text-center with-border">
            <table class="table table-bordered" >
                <tr>
                  <th width="30%" >
                    <a type="block" href="admin.php" class="btn btn-danger"><< เมนูหลัก</a>
                    <a href="#" data-toggle="modal" data-target="#cu" class="btn btn-success">PDF</a>
                      <div class="modal fade" id="cu" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <form action="../pdf_file/acc_list.php" method="post">
                                <div class="modal-content">
                                    <div class="modal-header text-center">
                                        <font size="5"><B> เงินขาย สกต. </B></font>
                                    </div>
                                    <div class="modal-body col-md-12 table-responsive mailbox-messages">
                                      <div class="table-responsive mailbox-messages">
                                        <div class="col-md-6">
                                            <div class="box-body">
                                                <strong><i class="fa fa-file-text-o margin-r-6"></i> การใช้ </strong>
                                                <p>&nbsp;&nbsp;&nbsp;&nbsp;-กรุณาเลือกวันที่ เพื่อดูข้อมูลเงินขาย สกต. ตามช่วงเวลา</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group text-center">
                                                <label>ตั้งเเต่ : </label>
                                                <input type="date" name="aday">
                                            </div>
                                            <div class="form-group text-center">
                                                <label>ถึง &nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                                <input type="date" name="bday">
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="submit"  class="btn btn-success pull-right">ถัดไป ==>></button>
                                      <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-close"> ปิดหน้าต่างนี้</i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                      </div>
                      <a type="block" href="acc_market_sale.php" class="btn btn-success"> ขาย สกต.</a>
                  </th>
                  <td width="40%" class="text-center"><font size="5"><B align="center"> เงินขาย สกต. </B></font></td>
                  <td width="30%"> </td>
                </tr>
              </table>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                  <div class="row">
                    <div class="col-md-12">
                      <table class="table table-bordered" id="dynamic_field">
                        <tr>
                          <th bgcolor="#66b3ff" class="text-center" width="10%">วันที่ขาย</th>
                          <th bgcolor="#66b3ff" class="text-center" width="20%">ชื่อลูกค้า</th>
                          <th bgcolor="#66b3ff" class="text-center" width="50%">ที่อยู่</th>
                          <th bgcolor="#66b3ff" class="text-center" width="10%">ข้อมูล</th>
                          <th bgcolor="#66b3ff" class="text-center" width="10%">แก้ไข</th>
                        </tr>
                        <?php 
                          $sql_acc = "SELECT * FROM acc_market INNER JOIN tbl_districts ON acc_market.district_id = tbl_districts.district_code
                                      INNER JOIN tbl_amphures  ON acc_market.amphur_id = tbl_amphures.amphur_id
                                      INNER JOIN tbl_provinces ON acc_market.province_id = tbl_provinces.province_id";
                          $objq_acc = mysqli_query($conn,$sql_acc);
                          while($value = $objq_acc->fetch_assoc()){
                        ?>
                        <tr> 
                          <td class="text-center"><?php echo $value['date_acc'];?></td>
                          <td class="text-center"><?php echo $value['name_customer'];?></td>
                          <td class="text-center"><?php echo $value['village'].'   ต.'.$value['district_name'].'  อ.'.$value['amphur_name'].'  จ.'.$value['province_name'];?></td>
                          <td class="text-center" ><a href="acc_market_list.php?id_acc_market=<?php echo $value['id_acc_market']; ?>"><i class="fa fa-search-plus"></i></a></td>
                          <td class="text-center" ><a href="acc_market_edit.php?id_acc_market=<?php echo $value['id_acc_market']; ?>"><i class="fa fa-cog"></i></a></td>
                        </tr>
                        <?php }?>
                      </table>
                     </div>
                  </div>
              </div>
              <div align="center" class="box-footer">
                
              </div>
            </div>
          </div>
        </div>
      </section>

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