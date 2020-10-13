<?php 
  require "../config_database/config.php";
  require "../session.php";
  require "menu/date.php";
  $aday = $_POST['aday'];
  $bday = $_POST['bday'];
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
  <style>
   .button2 {
        background-color: #b35900;
        color : white;
        } /* Back & continue */
        .topnav {
          background-color: while;
          overflow: hidden;
        }
  </style>
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
            <div class="col-2 col-sm-2 col-md-2 col-xl-2">
              <a type="block" href="car_rental.php" class="btn btn-danger pull-left"><< กลับ</a> 
            </div>
            <div class="col-8 col-sm-8 col-md-8 col-xl-8">
              <div class="text-center">
                <font size="5">
                  <B align="center"> ข้อมูลปฏิบัติงานและค่าเช่ารถ : <?php echo $username; ?></B>
                </font>
              </div>
              <div class="text-center">
                <font size="5">
                  <B align="center"> วันที่ <font color="red"> <?php echo Datethai($aday);?> </font>  ถึง  <font color="red"> <?php echo Datethai($bday);?> </font></B>
                </font>
              </div>
            </div>
            <div class="col-2 col-sm-2 col-md-2 col-xl-2 text-right">
            </div>
          </div>
        </div>
        <div class="box-body no-padding">
          <div class="mailbox-read-message">
            <br>
            <div class="col-12">
              <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                <table class="table" id="example2">
                  <thead>
                    <tr>
                      <th class="text-center" width="20%">วันที่</th>
                      <th class="text-center" width="15%">ปฏิบัติงาน</th>
                      <th class="text-center" width="15%">รถ</th>
                      <th class="text-center" width="15%">ค่าเช่ารถ</th>
                      <th class="text-center" width="35%">หมายเหตุ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $total_money = 0;
                      $sql_rs_history = "SELECT * FROM car_rental 
                                          INNER JOIN rc_practice ON car_rental.id_practice = rc_practice.id_practice
                                          WHERE car_rental.id_member = $id_member AND (car_rental.date BETWEEN '$aday' AND '$bday')
                                          GROUP BY car_rental.id_carrental DESC";
                      $objq_rs_history = mysqli_query($conn,$sql_rs_history);
                      while($value = $objq_rs_history->fetch_assoc()){ 
                        $member_car = $value['member_car'];
                        if ($member_car == $id_member) {
                          $money = $value['money'];
                        }else {
                          $money = 0;
                        }
                        
                        $member_car = $value['member_car'];
                        $sql_member = "SELECT name FROM member WHERE id_member = $member_car";
                        $objq_member = mysqli_query($conn,$sql_member);
                        $objr_member = mysqli_fetch_array($objq_member);
                    ?>
                      <tr>
                        <td class="text-center"><?php echo Datethai($value['date']); ?></td>
                        <td class="text-center"><?php echo $value['name_practice']; ?></td>
                        <td class="text-center"><?php echo $objr_member['name']; ?></td>
                        <td class="text-center"><?php echo $money; ?></td>
                        <td class="text-center"><?php echo $value['note']; ?></td>
                      </tr>
                    <?php
                        $total_money = $total_money + $money;
                      }
                    ?>
                      <tr>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        <th class="text-center">รวมเงิน</th>
                        <th class="text-center"><?php echo $total_money; ?></th>
                        <th class="text-center"></th>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="box-footer text-right">
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
          'lengthChange': true,
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
