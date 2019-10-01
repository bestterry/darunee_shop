<?php
  require "../config_database/config.php";
  require 'menu/date.php';
  $id_outside = $_GET['id_outside'];
   $sql_noutside = "SELECT * FROM outside WHERE id_outside = $id_outside";
   $objq_noutside = mysqli_query($conn,$sql_noutside);
   $objr_noutside = mysqli_fetch_array($objq_noutside);
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
      if(document.form1.pay_money.value == "")
      {
        alert('กรุณากรอกจำนวนเงิน');
        document.form1.pay_money.focus();
        return false;
      }	
      document.form1.submit();
    }
  </script>
  
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
                    <a href="../pdf_file/outside_list.php?id_outside=<?php echo $id_outside;?>" class="btn btn-success">เอกสารส่ง(PDF)</a>
                  </th>
                  <td width="40%" class="text-center"><font size="5"><B align="center"> ข้อมูลการสั่งของและชำระเงินนอกเขต </B></font></td>
                  <td width="30%"></td>
                </tr>
              </table>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                <div class="row">
                  <form action="algorithm/update_outside.php" class="form-horizontal" method="post" autocomplete="off" name="form1" onSubmit="JavaScript:return fncSubmit();">
                    <div class="col-md-12">
                      <div>
                        <table class="table table-bordered" id="dynamic_field">
                          <tr>
                            <th width="25%" class="text-right" ><font size="4">ชื่อ&nbsp;&nbsp;:</font></th>
                            <td width="25%" >
                              <input type="text" class="form-control" value="<?php echo $objr_noutside['name'].' '.$objr_noutside['province'];?>"  style="background-color: #e6f7ff;" readonly/>
                              </td>
                            <th width="25%" class="text-right" ><font size="4" valign="middle">จำนวนเงินชำระ &nbsp;&nbsp;:</font></th>
                            <td width="25%">
                              <input type="number" name="pay_money" class="form-control" style="background-color: #e6f7ff;">
                              <input type="hidden" name="id_outside" value="<?php echo $id_outside; ?>">
                            </td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <div align="center" class="box-footer">
                      <button type="submit" class="btn btn-success" onClick="return confirm('คุณต้องการบันทึกข้อมูลหรือไม่?')";><i class="fa fa-save"></i> บันทึกข้อมูล </button>
                    </div>
                  </form>
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="dynamic_field">
                          <tr>
                            <th bgcolor="#66b3ff" class="text-center" width="20%">สินค้า_หน่วย</th>
                            <th bgcolor="#66b3ff" class="text-center" width="10%">จำนวน</th>
                            <th bgcolor="#66b3ff" class="text-center" width="10%">ราคา/น.</th>
                            <th bgcolor="#66b3ff" class="text-center" width="10%">เงินซื้อ</th>
                            <th bgcolor="#66b3ff" class="text-center" width="10%">เงินจ่าย</th>
                            <th bgcolor="#66b3ff" class="text-center" width="15%">หนี้คงเหลือ</th>
                            <th bgcolor="#66b3ff" class="text-center" width="10%">วันที่</th>
                          </tr>
                          <?php 
                            $sql_outside = "SELECT * FROM outside_buy_htr 
                                            INNER JOIN product ON outside_buy_htr.id_product = product.id_product  
                                            WHERE outside_buy_htr.id_outside = $id_outside";
                            $objq_outside = mysqli_query($conn,$sql_outside);
                            while($value = $objq_outside->fetch_assoc()){
                          ?>
                          <tr>
                            <td class="text-center"><?php echo $value['name_product']; ?></td>
                            <td class="text-center"><?php echo $value['num_pd']; ?></td>
                            <td class="text-center"><?php echo $value['price_pd']; ?></td>
                            <td class="text-center"><?php echo $value['purch_money']; ?></td>
                            <td class="text-center"><?php echo $value['pay_money']; ?></td>
                            <td class="text-center"><?php echo $value['balance']; ?></td>
                            <td class="text-center"><?php echo Datethai($value['date_buy']); ?></td>
                          </tr>
                            <?php } ?>
                        </table>
                      </div>
                    </div>
                    <!-- /.row -->
                  </div>
                
              </div>
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