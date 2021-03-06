<?php 
  require "db_connect.php";
  $mysqli = connect();
  require "session.php"; 
  require "menu/date.php";
  $strDate = date('d-m-Y');

  $practice = "SELECT * FROM rc_practice ";
  $objq_practice = mysqli_query($mysqli,$practice);

  $category = "SELECT * FROM rc_category ";
  $objq_category = mysqli_query($mysqli,$category);

  $receive_money = "SELECT * FROM rc_receive_money 
                    INNER JOIN rc_practice ON rc_receive_money.id_practice = rc_practice.id_practice
                    INNER JOIN rc_category ON rc_receive_money.id_category = rc_category.id_category
                    INNER JOIN member ON rc_receive_money.id_member = member.id_member
                    WHERE rc_receive_money.id_member = $id_member GROUP BY rc_receive_money.id_receive_money DESC
                    LIMIT 100";
  $objq_receive = mysqli_query($mysqli,$receive_money);
?>

<!DOCTYPE html>
<html>
<head>
<?php require('../font/font_style.php');?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ทีมงานคุณดารุณี</title>
    <link rel="icon" type="image/png" href="../images/favicon.ico"/>
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
      if(document.form1.id_practice.value == "")
      {
        alert('กรุณาเลือกปฏิบัติงาน');
        document.form1.id_practice.focus();
        return false;
      }	
      if(document.form1.area.value == "")
      {
        alert('กรุณาระบุพื้นที่ปฏิบัติงาน');
        document.form1.area.focus();
        return false;
      }	
      if(document.form1.money.value == "")
      {
        alert('กรุณาระบุเงินขาย');
        document.form1.money.focus();		
        return false;
      }	
      if(document.form1.id_category.value == "")
      {
        alert('กรุณาเลือกประเภทการรับเงิน');
        document.form1.id_category.focus();		
        return false;
      }	
      if(document.form1.date.value == "")
      {
        alert('กรุณาเลือกวันที่รับเงิน');
        document.form1.date.focus();		
        return false;
      }	
      if(document.form1.customer.value == "")
      {
        alert('กรุณาระบุลูกค้า');
        document.form1.customer.focus();		
        return false;
      }	
      document.form1.submit();
    }
  </script>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <style>
          #customers {
            width: 100%;
          }
          #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
          }
          #customers tr:nth-child(even){background-color: #f2f2f2;}
          #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #99CCFF;
          }
          select {
            text-align: center;
            text-align-last: center;
          }
          option {
            text-align: center;
            text-align-last: center;
          }
          input {
            text-align: center;
            text-align-last: center;
          }
        </style>
</head>
<body class=" hold-transition skin-blue layout-top-nav ">
<div class="wrapper">

  <header class="main-header">
  <?php require('menu/header_logout.php');?>
  </header>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
          <form action="algorithm/receive_money.php" class="form-horizontal" method="post" autocomplete="off" name="form1" onSubmit="JavaScript:return fncSubmit();">
            <div class="box-header with-border">
              <table class="table table-bordered" id="dynamic_field">
                <tr>
                  <th width="30%" ><a type="block" href="store.php" class="btn btn-danger pull-left"><< เมนูหลัก</a> </th>
                  <td width="40%" class="text-center"><font size="5"><B align="center"> เงินขายรายวัน </B></font></td>
                  <td width="30%"> <button type="submit" type="submit" class="btn btn-success pull-right" name="add" id="add"> <i class="fa fa-save"></i> บันทึกข้อมูล </button></td>
                </tr>
              </table>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
            <!-- add_receive_money  -->
                <table class="table table-bordered" id="dynamic_field">
                  <tr>
                    <th width="20%" class="text-right" ><font size="4">ชื่อ &nbsp;&nbsp;:</font></th>
                    <td width="30%" >
                      <input type="text" class="form-control" value="<?php echo $username; ?>"  style="background-color: #e6f7ff;" readonly/>
                      <input type="hidden" name="id_member" value="<?php echo $id_member; ?>" >
                    </td>
                    <th width="20%" class="text-right" ><font size="4">เงินขาย &nbsp;&nbsp;:</font></th>
                    <td width="30%"><input type="number" name="money" class="form-control text-center"></td>
                  </tr>
                  <tr>
                    <th width="20%" class="text-right"><font size="4" valign="middle">งาน &nbsp;&nbsp;:</font></th>
                    <td width="30%" >
                    <select name="id_practice"  class="form-control" style="width: 100%;">
                        <option value="">-- ปฏิบัติงาน --</option>
                        <?php 
                          while ($value = $objq_practice -> fetch_assoc() ) {
                        ?>
                        <option value="<?php echo $value['id_practice']; ?>"><?php echo $value['name_practice']; ?></option>
                        <?php
                          }
                        ?>
                    </select>
                    </td>
                    <th width="20%" class="text-right" ><font size="4">การรับ &nbsp;&nbsp;:</font></th>
                    <td width="30%">
                      <select name="id_category"  class="form-control" style="width: 100%;">
                        <option value="">-- ประเภทเงิน --</option>
                        <?php 
                          while ($value = $objq_category -> fetch_assoc() ) {
                        ?>
                        <option value="<?php echo $value['id_category']; ?>"><?php echo $value['name_category']; ?></option>
                        <?php
                          }
                        ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <th width="20%" class="text-right" ><font size="4">พื้นที่ &nbsp;&nbsp;:</font></th>
                    <td width="30%" ><input type="text" name="area" class="form-control text-center"></td>
                    <th width="20%" class="text-right"><font size="4">วันรับ &nbsp;&nbsp;:</font></th>
                    <td width="30%" ><input type="date" name="date" class="form-control"></td>
                  </tr>
                  <tr>
                    <th width="20%" class="text-right"><font size="4">ลูกค้า &nbsp;&nbsp;:</font></th>
                    <td width="30%" ><input type="text" name="customer" class="form-control"></td>
                    <th width="20%" class="text-right" ><font size="4">หมายเหตุ &nbsp;&nbsp;:</font></th>
                    <td width="30%"><input type="text" name="note" value="-" class="form-control"></td>
                  </tr>
                  <tr>
                    <th width="20%" class="text-right" ><font size="4" color="red">Note &nbsp;&nbsp;:</font></th>
                    <td colspan="3" ><font size="4" color="red">ต้องการแก้ไข หรือลบข้อมูล แจ้งสำนักงาน</font></td>
                  </tr>
                </table>
            </form>
              <!-- //add_receive_money  -->
              <div class="mailbox-read-message">
              <table id="customers">
                <tbody>
                  <tr>
                    <th class="text-center" width="9%">ชื่อ</th>
                    <th class="text-center" width="9%">งาน</th>
                    <th class="text-center" width="12%">พื้นที่</th>
                    <th class="text-center" width="10%">เงินขาย</th>
                    <th class="text-center" width="10%">รับ</th>
                    <th class="text-center" width="10%">วันรับ</th>
                    <th class="text-center" width="15%">ชื่อลูกค้า</th>
                    <th class="text-center" width="15%">หมายเหตุ</th>
                    <th class="text-center" width="7%">รับแล้ว</th>
                  </tr>
                  <?php
                    while($value = $objq_receive -> fetch_assoc()){
                  ?>
                  <tr>
                    <td class="text-center" ><?php echo $value['name']; ?></td>
                    <td class="text-center" ><?php echo $value['name_practice']; ?></td>
                    <td class="text-center" ><?php echo $value['area']; ?></td>
                    <td class="text-center" ><?php echo $value['money']; ?></td>
                    <td class="text-center" ><?php echo $value['name_category']; ?></td>
                    <td class="text-center" ><?php echo Datethai($value['date']); ?></td>
                    <td class="text-center" ><?php echo $value['customer']; ?></td>
                    <td class="text-center" ><?php echo $value['note']; ?></td>
                    <td class="text-center" >
                      <?php 
                          $status = $value['status_office'];
                          if( $status == 'Y'){
                           ?>
                            <span class="label label-success pull-center"> Y </span>
                           <?php
                             }else{
                           ?>
                            <span class="label label-danger pull-center"> N </span>
                          <?php } ?> 
                    </td>
                  </tr>
                    <?php }?>
                </tbody>
              </table>
              </div>
            </div>
            <div class="box-footer">

            </div>
          </div>
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
