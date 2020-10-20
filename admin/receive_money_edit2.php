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
<style>
  .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
  }

  .switch input { 
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked + .slider {
    background-color: #2196F3;
  }

  input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }
</style>
</head>
<body class=" hold-transition skin-blue layout-top-nav ">
<div class="wrapper">

  <header class="main-header">
  <?php require('menu/header_logout.php');?>
  </header>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
    <div class="row">
      <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header text-center with-border">
              <font size="5">
                <B align="center"> แก้ไขข้อมูล (เงินขายรายวัน) </B>
              </font>
            </div>
            <!-- add_receive_money  -->
            <form action="algorithm/receive_money_edit2.php" class="form-horizontal" method="post" autocomplete="off" name="form1" onSubmit="JavaScript:return fncSubmit();">
              <div class="mailbox-read-message">
                <div class="col-12 col-md-12 col-xs-12">
                  <div class="col-1 col-md-1 col-xs-1"></div>
                  <div class="col-10 col-md-10 col-xs-10">
                    <div class="row">
                      <div class="col-sm-6 col-md-6 col-xs-6">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">ชื่อ </label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control text-center" value=" <?php echo $objr_receive['name'];?>"  style="background-color: #e6f7ff;" readonly/>
                            <input type="hidden" name="id_receive_money" value="<?php echo $id_receive_money;?>">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label">งาน </label>
                          <div class="col-sm-8">
                            <select name="id_practice"  class="form-control" style="width: 100%;">
                              <option value="1"  <?php if($id_practice == 1){ echo "selected='selected'";} ?>>ส่ง</option>
                              <option value="2"  <?php if($id_practice == 2){ echo "selected='selected'";} ?>>ขน</option>
                              <option value="3"  <?php if($id_practice == 3){ echo "selected='selected'";} ?>>เยี่ยม</option>
                              <option value="4"  <?php if($id_practice == 4){ echo "selected='selected'";} ?>>ร้าน</option>
                              <option value="5"  <?php if($id_practice == 5){ echo "selected='selected'";} ?>>อื่นๆ</option>
                              <option value="6"  <?php if($id_practice == 6){ echo "selected='selected'";} ?>>ลา</option>
                              <option value="7"  <?php if($id_practice == 7){ echo "selected='selected'";} ?>>หยุด</option>
                              <option value="9"  <?php if($id_practice == 9){ echo "selected='selected'";} ?>>เช็ค</option>
                              <option value="10"  <?php if($id_practice == 10){ echo "selected='selected'";} ?>>เก็บเงิน</option>
                              <option value="11"  <?php if($id_practice == 11){ echo "selected='selected'";} ?>>ขายส่ง</option>
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label">ลูกค้า </label>
                          <div class="col-sm-8">
                            <input type="text" name="customer" value="<?php echo $objr_receive['customer']; ?>" class="form-control text-center">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label">หมายเหตุ </label>
                          <div class="col-sm-8">
                            <input type="text" name="note" value="<?php echo $objr_receive['note']; ?>" class="form-control text-center">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label">สนง (รับ) </label>
                          <div class="col-sm-8">
                            <label class="switch">
                              <input type="checkbox" name="status_office" <?php if($objr_receive['status_office'] == 'Y'){ echo "checked";}else{} ?>>
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label">รับเงิน </label>
                          <div class="col-sm-8">
                            <label class="switch">
                              <input type="checkbox" name="status_boss" <?php if($objr_receive['status_boss'] == 'Y'){ echo "checked";}else{} ?>>
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>

                      <div class="col-sm-6 col-md-6 col-xs-6">

                        <div class="form-group">
                          <label class="col-sm-4 control-label">เงินขาย </label>
                          <div class="col-sm-8">
                            <input type="number" name="money" class="form-control text-center" value="<?php echo $objr_receive['money']; ?>">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label">ประเภทเงิน </label>
                          <div class="col-sm-8">
                            <select name="id_category"  class="form-control" style="width: 100%;">
                              <option value="1"  <?php if($id_category == 1){ echo "selected='selected'";} ?>>สด</option>
                              <option value="2"  <?php if($id_category == 2){ echo "selected='selected'";} ?>>เช็ค</option>
                              <option value="3"  <?php if($id_category == 3){ echo "selected='selected'";} ?>>สกต.</option>
                              <option value="4"  <?php if($id_category == 4){ echo "selected='selected'";} ?>>เชื่อ</option>
                              <option value="5"  <?php if($id_category == 5){ echo "selected='selected'";} ?>>ฝากขาย</option>
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label">วันรับเงิน </label>
                          <div class="col-sm-8">
                            <input type="date" name="date" class="form-control text-center" value="<?php echo $objr_receive['date']; ?>">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label"></label>
                          <div class="col-sm-8">
                            
                          </div>
                        </div>

                      </div>

                    </div>
                  </div>
                  <div class="col-1 col-md-1 col-xs-1"></div>
                </div>
                <div class="box-footer">
                  <div class="col-12 col-md-12 col-xs-12">
                    <div class="col-4 col-md-4 col-xs-4">
                      <a type="block" href="receive_moneylist.php?id_category=<?php echo $objr_receive['id_category']; ?>" class="btn btn-danger pull-left"><< กลับ</a> 
                    </div>
                    <div class="col-4 col-md-4 col-xs-4 text-center">
                      <button type="submit" type="submit" class="btn btn-success "><i class="fa fa-save"></i> บันทึก </button>
                    </div>
                    <div class="col-4 col-md-4 col-xs-4 text-right">
                      <a href="algorithm/delete_receive_money.php?id_receive_money=<?php echo $objr_receive['id_receive_money']; ?>" class="btn btn-danger" 
                         onClick="return confirm('คุณต้องการที่จะลบข้อมูล <?php echo $objr_receive['name']; ?> หรือไม่ ?')";>ลบ</a>
                    </div>
                  </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
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
