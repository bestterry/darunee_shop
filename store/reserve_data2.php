<?php 
  require "../config_database/config.php";
  require "../session.php";
  require "menu/date.php";
  $strDate = date('d-m-Y');

  $reserve_money = "SELECT money FROM reserve_money WHERE id_member = $id_member";
  $objq_money = mysqli_query($conn,$reserve_money);
  $objr_money = mysqli_fetch_array($objq_money);
  $money = $objr_money['money'];

  $reserve_reserve = "SELECT * FROM reserve_list WHERE status = 4";
  $objq_reservelist = mysqli_query($conn,$reserve_reserve);

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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class=" hold-transition skin-blue layout-top-nav ">
 <div class="wrapper">
  <header class="main-header">
  <?php require('menu/header_logout.php');?>
  </header>

  <div class="content-wrapper">
    <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <div class="col-12">
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
              <a type="block" href="reserve_data.php" class="btn btn-danger pull-left"><< กลับ</a> 
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4">
              <div class="text-center">
                <font size="5">
                  <B align="center"> ข้อมูลใช้เงินรายวัน <font color="red"> </font></B>
                </font>
              </div>
            </div>
            <div class="col-4 col-sm-4 col-md-4 col-xl-4 text-right"></div>
          </div>
        </div>
        <div class="box-body no-padding">
          <div class="mailbox-read-message">
            <div class="col-12">
              <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                <table id="example1" class="table">
                  <thead>
                    <tr>
                      <th class="text-center" width="20%">วันที่</th>
                      <th class="text-center" width="16%">ค่าเช่ารถ</th>
                      <th class="text-center" width="16%">ค่าน้ำมัน</th>
                      <th class="text-center" width="16%">ค่าเบี้ยเลี้ยง</th>
                      <th class="text-center" width="16%">ค่าที่พัก</th>
                      <th class="text-center" width="16%">ค่าใช้จ่ายอื่นๆ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $aday = $_POST['aday'];
                      $bday = $_POST['bday'];
                      while(strtotime($bday) >= strtotime($aday)) { 
                    ?>
                    <tr>
                      <td class="text-center"><?php echo Datethai($bday);?></td> 
                      <?php
                          $sql_resevelist = "SELECT id_list FROM reserve_list WHERE status = 4";
                          $objq_reservelist = mysqli_query($conn,$sql_resevelist);
                          while($value_reservelist = $objq_reservelist->fetch_assoc()){
                            $id_list = $value_reservelist['id_list'];
                            $sql_history = "SELECT SUM(money) FROM reserve_history 
                                            WHERE id_list = $id_list AND id_member = $id_member AND DATE_FORMAT(date,'%Y-%m-%d')='$bday'";
                          $objq_history = mysqli_query($conn,$sql_history);
                          while($value_history = $objq_history->fetch_assoc()){
                      ?>
                      <td class="text-center"><?php echo $value_history['SUM(money)'];?></td>
                      <?php 
                          }
                          }
                      ?>
                    </tr>
                    <?php 
                        $bday = date ("Y-m-d", strtotime("-1 day", strtotime($bday)));
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="box-footer text-right">
          <a class="btn btn-success" href="../pdf_file/reserve_list.php"></i> PDF </a>
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
    <script>
       $(function () {
          $('#example1').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : false,
            'info'        : true,
            'autoWidth'   : false
            });
       });
      $(document).ready( function() {
          var now = new Date();
      
          var day = ("0" + now.getDate()).slice(-2);
          var month = ("0" + (now.getMonth() + 1)).slice(-2);

          var today = now.getFullYear()+"-"+(month)+"-"+(day) ;


        $('#datePicker').val(today);
      });
    </script>
</body>
</html>
