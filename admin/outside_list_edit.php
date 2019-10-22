<?php
  require "../config_database/config.php";
  require 'menu/date.php';
    $id_outside_buy = $_GET['id_outside_buy'];
    $sql_outside = "SELECT * FROM outside_buy_htr 
                    INNER JOIN product ON outside_buy_htr.id_product = product.id_product  
                    INNER JOIN outside ON outside_buy_htr.id_outside = outside.id_outside
                    WHERE outside_buy_htr.id_outside_buy = $id_outside_buy";
    $objq_outside = mysqli_query($conn,$sql_outside);
    $objr_outside = mysqli_fetch_array($objq_outside);

    $id_outside = $objr_outside['id_outside'];
    $id_product = $objr_outside['id_product'];
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

  <!-- <script language="javascript">
    function fncSubmit()
    {
      if(document.form1.pay_money.value == "")
      {
        alert('กรุณากรอกจำนวนเงิน');
        document.form1.pay_money.focus();
        return false;
      }	
      if(document.form1.account_rc.value == "")
      {
        alert('กรุณาระบุบัญชีรับโอน');
        document.form1.account_rc.focus();
        return false;
      }	
      document.form1.submit();
    }
  </script> -->
    <script language="javascript">
        function fncSum()
            {
              document.form1.purch_money.value = parseFloat(document.form1.num_pd.value) * parseFloat(document.form1.price_pd.value);
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
                    
                  </th>
                  <td width="50%" class="text-center"><font size="5"><B align="center"> แก้ไขข้อมูลชำระเงิน (นอกเขต) </B></font></td>
                  <td width="20%"></td>
                </tr>
              </table>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                  <form action="algorithm/edit_outside.php" class="form-horizontal" method="post" autocomplete="off" name="form1" onSubmit="JavaScript:return fncSubmit();">
                    <div class="col-md-12">
                      <div>
                        <table class="table table-bordered" id="dynamic_field">
                          <tr>
                            <th width="25%" class="text-right" ><font size="4">ชื่อลูกหนี้&nbsp;&nbsp;:</font></th>
                            <th width="25%">
                              <input type="text" class="form-control" value="<?php echo $objr_outside['name']; ?>" readonly/>
                              <input type="hidden" class="form-control" name="id_outside_buy" value="<?php echo $id_outside_buy; ?>">
                              <input type="hidden" class="form-control" name="id_outside" value="<?php echo $id_outside; ?>">
                            </th>
                            <th width="25%" class="text-right" >
                              <font size="4" valign="middle"></font>
                            </th>
                            <td width="25%"></td>
                          </tr>
                          <tr>
                            <th width="25%" class="text-right"><font size="4">สินค้า&nbsp;&nbsp;:</font></th>
                            <th width="25%">
                                <select name="id_product"  class="form-control" style="width: 100%;">
                                  <option value="1"  <?php if($id_product == 1){ echo "selected='selected'";} ?>>เครื่องดื่มสมุนไพร ซอฟท์ฮอมดี้ (Soft Homdy)</option>
                                  <option value="3"  <?php if($id_product == 3){ echo "selected='selected'";} ?>>เครื่องดื่มสมุนไพร ฮอมดี้ (Homdy)</option>
                                  <option value="5"  <?php if($id_product == 5){ echo "selected='selected'";} ?>>สบู่วีฮาร่า</option>
                                  <option value="9"  <?php if($id_product == 9){ echo "selected='selected'";} ?>>น้ำปลาร้าต้มสุก เด็มเด็ม (ขวดกลม)</option>
                                  <option value="11"  <?php if($id_product == 11){ echo "selected='selected'";} ?>>สารปรับปรุงดิน โซเล่</option>
                                  <option value="15"  <?php if($id_product == 15){ echo "selected='selected'";} ?>>30-12-6 กวางเหรียญทอง (แตกกอ)</option>
                                  <option value="16"  <?php if($id_product == 16){ echo "selected='selected'";} ?>>18-8-28 กวางเหรียญทอง (รับรวง)</option>
                                  <option value="17"  <?php if($id_product == 17){ echo "selected='selected'";} ?>>น่ำสมุนไพร เทียนหลง</option>
                                  <option value="18"  <?php if($id_product == 18){ echo "selected='selected'";} ?>>น้ำสมุนไพร อินทรา</option>
                                  <option value="30"  <?php if($id_product == 30){ echo "selected='selected'";} ?>>กรดหยอดยาง ต้นยางคู่ลูกโลก</option>
                                  <option value="32"  <?php if($id_product == 32){ echo "selected='selected'";} ?>>น้ำปลาร้าต้มสุก เด็มเด็ม (ขวดเหลี่ยม)</option>
                                  <option value="34"  <?php if($id_product == 34){ echo "selected='selected'";} ?>>ปุ๋ยอินทรีย์กวางเหรียญทอง (50กก.)</option>
                                  <option value="35"  <?php if($id_product == 35){ echo "selected='selected'";} ?>>ชำระเงิน</option>
                                </select>
                            </th>
                            <th width="25%" class="text-right"><font size="4">จำนวน&nbsp;&nbsp;:</font></th>
                            <td width="25%"><input type="text" name="num_pd" value="<?php echo $objr_outside['num_pd']; ?>" class="form-control" OnChange="fncSum();"></td>
                          </tr>
                          <tr>
                            <th width="25%" class="text-right"><font size="4">ราคา&nbsp;&nbsp;:</font></th>
                            <th width="25%"><input type="text" name="price_pd" value="<?php echo $objr_outside['price_pd']; ?>" class="form-control" OnChange="fncSum();"></th>
                            <th width="25%" class="text-right"><font size="4">เป็นเงิน&nbsp;&nbsp;:</font></th>
                            <td width="25%"><input type="text" name="purch_money" value="<?php echo $objr_outside['purch_money']; ?>" class="form-control" id="show"></td>
                          </tr>
                          <tr>
                            <th width="25%" class="text-right"><font size="4">ยอดชำระ&nbsp;&nbsp;:</font></th>
                            <th width="25%"><input type="text" name="pay_money" value="<?php echo $objr_outside['pay_money']; ?>" class="form-control"></th>
                            <th width="25%" class="text-right"><font size="4">&nbsp;&nbsp;:</font></th>
                            <td width="25%"></td>
                          </tr>
                          <tr>
                            <th width="25%" class="text-right"><font size="4">บัญชีรับโอน&nbsp;&nbsp;:</font></th>
                            <th width="25%"><input type="text" name="account_rc" value="<?php echo $objr_outside['account_rc']; ?>" class="form-control"></th>
                            <th width="25%" class="text-right"><font size="4">วันที่&nbsp;&nbsp;:</font></th>
                            <td width="25%"><input type="date" name="date_buy" value="<?php echo $objr_outside['date_buy']; ?>" class="form-control"></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <div class="box-footer">
                    <table class="table table-bordered" >
                      <tr>
                        <th width="30%"><a type="block" href="outside_list.php?id_outside=<?php echo $id_outside; ?>" class="btn btn-danger"><< กลับ</a></th>
                        <td class="text-center" width="40%"><button type="submit" class="btn btn-success" onClick="return confirm('คุณต้องการบันทึกข้อมูลหรือไม่?')";><i class="fa fa-save"></i> บันทึกข้อมูล </button></td>
                        <td class="text-center" width="30%"></td>
                      </tr>
                    </table>
                    </div>
                  </form>
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