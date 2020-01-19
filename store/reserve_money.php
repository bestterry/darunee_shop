<?php 
  require "db_connect.php";
  $mysqli = connect();
  require "session.php"; 
  require "menu/date.php";
  $strDate = date('d-m-Y');

  $rs_list = "SELECT * FROM rs_list ";
  $objq_rslist = mysqli_query($mysqli,$rs_list);

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
      if(document.form1.date.value == "")
      {
        alert('กรุณาเลือกวันที่');
        document.form1.date.focus();
        return false;
      }	
      if(document.form1.id_rs_list.value == "")
      {
        alert('กรุณาเลือกรายการ')
        document.form1.id_rs_list.focus();
        return false;
      }	
      if(document.form1.money.value == "")
      {
        alert('กรุณาระบุจำนวนเงิน');
        document.form1.money.focus();		
        return false;
      }	
      if(document.form1.note.value == "")
      {
        alert('กรุณาระบุหมายเหตุ');
        document.form1.note.focus();		
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
            <form action="algorithm/add_rc_history.php" class="form-horizontal" method="post" autocomplete="off" name="form1" onSubmit="JavaScript:return fncSubmit();">
              <div class="box-header with-border">
                <table class="table table-bordered" id="dynamic_field">
                  <tr>
                    <th width="30%" ><a type="block" href="store.php" class="btn btn-danger pull-left"><< เมนูหลัก</a> </th>
                    <td width="40%" class="text-center"><font size="5"><B align="center"> เงินสำรองจ่าย </B></font></td>
                    <td width="30%"> <button type="submit" class="btn btn-success pull-right"> <i class="fa fa-save"></i> บันทึกข้อมูล </button></td>
                  </tr>
                </table>
              </div>
              <!-- add_reserve_money  -->
              <table class="table table-bordered" id="dynamic_field">
                <tr>
                  <th width="20%" class="text-right" ><font size="4">ชื่อ &nbsp;&nbsp;:</font></th>
                  <td width="30%" >
                    <input type="text" class="form-control" value="<?php echo $username; ?>"  style="background-color: #e6f7ff;" readonly/>
                    <input type="hidden" name="id_member" value="<?php echo $id_member; ?>" >
                  </td>
                  <th width="20%" class="text-right" ><font size="4">วันที่ &nbsp;&nbsp;:</font></th>
                  <td width="30%"><input type="date" name="date" class="form-control text-center"></td>
                </tr>
                <tr>
                  <th width="20%" class="text-right"><font size="4" valign="middle">รายการ &nbsp;&nbsp;:</font></th>
                  <td width="30%" >
                    <select name="id_rs_list" class="form-control" style="width: 100%;">
                        <option value="">-- รายการ --</option>
                        <?php 
                          while ($value = $objq_rslist -> fetch_assoc() ) {
                        ?>
                        <option value="<?php echo $value['id_rs_list']; ?>"><?php echo $value['name_rs_list']; ?></option>
                        <?php
                          }
                        ?>
                    </select>
                  </td>
                  <th width="20%" class="text-right" ><font size="4">จำนวนเงิน &nbsp;&nbsp;:</font></th>
                  <td width="30%"><input type="number" name="money" class="form-control text-center"></td>
                </tr>
                <tr>
                  <th width="20%" class="text-right" ><font size="4">หมายเหตุ &nbsp;&nbsp;:</font></th>
                  <td colspan="3" ><input type="text" name="note" value="-" class="form-control"></td>
                </tr>
                <tr>
                  <th width="20%" class="text-right" ><font size="4" color="red">Note &nbsp;&nbsp;:</font></th>
                  <td colspan="3" ><font size="4" color="red">ติดปัญหา แจ้ง สนง.</font></td>
                </tr>
              </table>
            </form>
              <!-- //add_reserve_money  -->
              <div class="mailbox-read-message">
                <table class="table table-bordered" id="example1">
                  <thead>
                    <tr>
                      <th bgcolor="#99CCFF" class="text-center" width="5%">ID</th>
                      <th bgcolor="#99CCFF" class="text-center" width="20%">วันที่</th>
                      <th bgcolor="#99CCFF" class="text-center" width="35%">รายการ</th>
                      <th bgcolor="#99CCFF" class="text-center" width="10%">จำนวนเงิน</th>
                      <th bgcolor="#99CCFF" class="text-center" width="10%">เงินคงเหลือ</th>
                      <th bgcolor="#99CCFF" class="text-center" width="20%">หมายเหตุ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $sql_rs_history = "SELECT * FROM rs_history 
                                            INNER JOIN rs_list ON rs_history.id_rs_list = rs_list.id_rs_list
                                            WHERE rs_history.id_member = $id_member GROUP BY rs_history.id_rs_history DESC";
                        $objq_rs_history = mysqli_query($mysqli,$sql_rs_history);
                      while($value = $objq_rs_history->fetch_assoc()){
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $value['id_rs_history']; ?></td>
                      <td class="text-center"><?php echo Datethai($value['date']); ?></td>
                      <td class="text-center"><?php echo $value['name_rs_list']; ?></td>
                      <td class="text-center"><?php echo $value['money_rs']; ?></td>
                      <td class="text-center"><?php  ?></td>
                      <td class="text-center"><?php echo $value['note']; ?></td>
                    </tr>
                    <?php
                      }
                      ?>
                  </tbody>
                </table>
              </div>
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
