<?php 
  require "../config_database/config.php";
  require "../session.php"; 
  require "menu/date.php";

  $id_receive_money = $_GET['id_receive_money'];

  $receive_money = "SELECT * FROM rc_receive_money 
                    INNER JOIN rc_practice ON rc_receive_money.id_practice = rc_practice.id_practice
                    INNER JOIN rc_category ON rc_receive_money.id_category = rc_category.id_category
                    INNER JOIN member ON rc_receive_money.id_member = member.id_member
                    WHERE rc_receive_money.id_receive_money = $id_receive_money";
  $objq_receive = mysqli_query($conn,$receive_money);
  $objr_receive = mysqli_fetch_array($objq_receive);

  $id_practice = $objr_receive['id_practice'];
  $id_category = $objr_receive['id_category'];

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

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
        </style>
</head>
<body class=" hold-transition skin-blue layout-top-nav ">
<div class="wrapper">

  <header class="main-header">
  <?php require('menu/header_logout.php');?>
  </header>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="height: 500px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    

    <!-- Main content -->
    <section class="content">
      <div class="col-md-12">

          <div class="box box-primary">
            <div class="box-header text-center with-border">
              <font size="5">
                <B align="center"> แก้ไขรับเงินรายวัน 
                <font size="5" color="red">
                  
                 </font>
              </font>
              </B>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
            <!-- add_receive_money  -->
            <form action="algorithm/receive_money_edit.php" class="form-horizontal" method="post" autocomplete="off" name="form1" onSubmit="JavaScript:return fncSubmit();">
            <div class="mailbox-read-message">
              <table id="customers">
                <tbody>
                  <tr>
                    <th class="text-center" width="15%">ชื่อ</th>
                    <th class="text-center" width="15%">ปฏิบัติงาน</th>
                    <th class="text-center" width="20%">ปฏิบัติงาน</th>
                    <th class="text-center" width="15%">เงินขาย(บ)</th>
                    <th class="text-center" width="15%">ประเภทการรับเงิน</th>
                    <th class="text-center" width="20%">วันที่รับเงิน</th>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <?php echo $objr_receive['name'];?>
                      <input type="hidden" name="id_receive_money" value="<?php echo $id_receive_money;?>">
                    </td>
                    <td>
                    <select name="id_practice" class="form-control">
                      <option value ="1" <?php if($id_practice == 1){ echo "selected='selected'";} ?>>ส่งของ</option>
                      <option value="2"  <?php if($id_practice == 2){ echo "selected='selected'";}?>>ขนของ</option>
                      <option value="3"  <?php if($id_practice == 3){ echo "selected='selected'";} ?>>เยี่ยม</option>
                      <option value="4"  <?php if($id_practice == 4){ echo "selected='selected'";}?>>หน้าร้าน</option>
                      <option value="5"  <?php if($id_practice == 5){ echo "selected='selected'";}?>>อื่นๆ</option>
                    </select>
                    </td>
                    <td class="text-center" ><input type="text" name="area" class="form-control text-center" value="<?php echo $objr_receive['area']; ?>"></td>
                    <td class="text-center" ><input type="text" name="money" class="form-control text-center" value="<?php echo $objr_receive['money']; ?>"></td>
                    <td class="text-center" >
                      <select name="id_category" class="form-control text-center">
                        <option value ="1" <?php if($id_category == 1){ echo "selected='selected'";} ?>>สด</option>
                        <option value="2"  <?php if($id_category == 2){ echo "selected='selected'";}?>>เช็ค</option>
                        <option value="3"  <?php if($id_category == 3){ echo "selected='selected'";} ?>>สกต.</option>
                        <option value="4"  <?php if($id_category == 4){ echo "selected='selected'";}?>>เชื่อ</option>
                        <option value="5"  <?php if($id_category == 5){ echo "selected='selected'";}?>>ฝากขาย</option>
                      </select>
                    </td>
                    <td class="text-center" ><?php echo Datethai($objr_receive['date']); ?></td>
                  </tr>
                </tbody>
              </table>
              </div>
              <div class="box-footer">
                <a type="block" href="receive_money.php" class="btn btn-danger pull-left"><= กลับ</a> 
                <button type="submit" type="submit" class="btn btn-success pull-right"> <i class="fa fa-save"></i> บันทึก </button>
              </div>
              </form>
              <!-- //add_receive_money  -->

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
