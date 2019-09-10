<?php
  include("db_connect.php");
  $mysqli = connect();
  require "session.php"; 
  $id_acc_market = $_GET['id_acc_market'];
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

  <script language="javascript">
    function fncSubmit()
    {
      if(document.form1.name_customer.value == "")
      {
        alert('กรุณาระบุชื่อลูกค้า');
        document.form1.name_customer.focus();
        return false;
      }	
      if(document.form1.village.value == "")
      {
        alert('กรุณาระบุหมู่บ้าน');
        document.form1.village.focus();		
        return false;
      }	
      if(document.form1.province_name.value == "")
      {
        alert('กรุณาระบุจังหวัด');
        document.form1.province_name.focus();
        return false;
      }	
      if(document.form1.amphur_name.value == "")
      {
        alert('กรุณาระบุอำเภอ');
        document.form1.amphur_name.focus();		
        return false;
      }	
      if(document.form1.district_name.value == "")
      {
        alert('กรุณาระบุตำบล');
        document.form1.district_name.focus();		
        return false;
      }	

      
      
      document.form1.submit();
    }
  </script>
  
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
          <form action=".php" class="form-horizontal" method="post" autocomplete="off" name="form1" onSubmit="JavaScript:return fncSubmit();">
            <div class="box-header text-center with-border">
            <table class="table table-bordered" >
                <tr>
                  <th width="30%" ><a type="block" href="acc_market.php" class="btn btn-danger pull-left"><< ย้อนกลับ</a></th>
                  <td width="40%" class="text-center"><font size="5"><B align="center"> เงิน สกต. </B></font></td>
                  <td width="30%"></td>
                </tr>
              </table>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                  <div class="row">
                    <div class="col-md-12">
                      <table class="table table-bordered">
                        <tr>
                          <th bgcolor="#66b3ff" class="text-center" width="20%">วันที่</th>
                          <th bgcolor="#66b3ff" class="text-center" width="20%">ชื่อลูกค้า</th>
                          <th bgcolor="#66b3ff" class="text-center" width="60%">ที่อยู่</th>
                        </tr>
                        <?php 
                          $sql_acc = "SELECT * FROM acc_market INNER JOIN tbl_districts ON acc_market.district_id = tbl_districts.district_code
                                      INNER JOIN tbl_amphures  ON acc_market.amphur_id = tbl_amphures.amphur_id
                                      INNER JOIN tbl_provinces ON acc_market.province_id = tbl_provinces.province_id WHERE acc_market.id_acc_market = $id_acc_market";
                          $objq_acc = mysqli_query($mysqli,$sql_acc);
                          while($value = $objq_acc->fetch_assoc()){
                        ?>
                        <tr> 
                          <td class="text-center"><?php echo $value['date_acc'];?></td>
                          <td class="text-center"><?php echo $value['name_customer'];?></td>
                          <td class="text-center"><?php echo $value['village'].'   ต.'.$value['district_name'].'  อ.'.$value['amphur_name'].'  จ.'.$value['province_name'];?></td>
                        </tr>
                        <?php }?>
                      </table>

                      <table class="table table-bordered">
                        <tr>
                          <th bgcolor="#66b3ff" class="text-center" width="20%">สินค้า_หน่วย</th>
                          <th bgcolor="#66b3ff" class="text-center" width="20%">จำนวน</th>
                          <th bgcolor="#66b3ff" class="text-center" width="20%">เงินขาย</th>
                          <th bgcolor="#66b3ff" class="text-center" width="20%">เงิน สกต.</th>
                          <th bgcolor="#66b3ff" class="text-center" width="20%">คืน.เพิ่มเติม</th>
                        </tr>
                        <?php 
                          $sql_acc = "SELECT * FROM acc_market_list INNER JOIN product ON acc_market_list.id_product = product.id_product where acc_market_list.id_acc_market = $id_acc_market";
                          $objq_acc = mysqli_query($mysqli,$sql_acc);
                          while($value2 = $objq_acc->fetch_assoc()){
                        ?>
                        <tr> 
                          <td class="text-center"><?php echo $value2['name_product'];?></td>
                          <td class="text-center"><?php echo $value2['num_product'];?></td>
                          <td class="text-center"><?php echo $value2['total_money'];?></td>
                          <td class="text-center"><?php echo $value2['acc_money'];?></td>
                          <td class="text-center"><?php echo $value2['setment'];?></td>
                        </tr>
                        <?php }?>
                      </table>
                    </div>
                  </div>
              </div>
              <div align="center" class="box-footer">
                
              </div>
            </div>
            </form>
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