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

  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class=" hold-transition skin-blue layout-top-nav ">
  <div class="wrapper" >
    <header class="main-header">
      <?php require('menu/header_logout.php');?>
    </header>
    <div class="content-wrapper">
      <section class="content-header">
      </section>
      <section class="content">
        <div class="row">
          <div class="box box-primary">
            <div class="box-header text-center with-border">
              <div align="right">
                <a href="admin.php" class="btn btn-success"><< เมนูหลัก</a>
              </div>
              <font size="5">
                <B> เงินขายสะสม <font color="red"><?php echo DateThai($aday);?></font> ถึง <font color="red"><?php echo DateThai($bday);?></font></B>
              </font>
            </div>
            <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <table class="table table-striped">
                  <thead>
                    <tr class="info">
                      <th class="text-center" width="12%">วันที่</th>
                      <th class="text-center" width="11%">เงินขาย</th>
                      <th class="text-center" width="11%">เงินขายสะสม</th>
                      <th class="text-center" width="11%">SOLE</th>
                      <th class="text-center" width="11%">กวาง</th>
                      <th class="text-center" width="11%">HD</th>
                      <th class="text-center" width="11%">SHD</th>
                      <th class="text-center" width="11%">VH</th>
                      <th class="text-center" width="11%">ปร</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $total_money = 0;
                        $total_profit2 = 0;
                        $i = 1;
                       
                        $sql_day_car = "SELECT SUM(money) as sum_money,DAY(datetime),MONTH(datetime),YEAR(datetime) FROM sale_car_history 
                                        WHERE (datetime between '$aday 00:00:00' and '$bday 23:59:59') GROUP BY DAY(datetime),MONTH(datetime),YEAR(datetime)";
                        $objq_day_car = mysqli_query($conn,$sql_day_car);
                        while ($value = $objq_day_car -> fetch_assoc() ) {
                          
                          $date = $value['DAY(datetime)'].'-'.$value['MONTH(datetime)'].'-'.$value['YEAR(datetime)'];

                          $time = strtotime($date);
                          $newformat = date('Y-m-d',$time);

                          $price_history = "SELECT SUM(money) FROM price_history WHERE DATE_FORMAT(datetime,'%Y-%m-%d')='$newformat'";
                          $objq_price_history = mysqli_query($conn,$price_history);
                          $objr_price_history = mysqli_fetch_array($objq_price_history);
                          $money_car = $value['sum_money'];
                          $money_store = $objr_price_history['SUM(money)'];
                          $all_money = $money_car + $money_store; 
                          $total_money = $total_money + $all_money;

                          $price_sole = "SELECT SUM(num) FROM sale_car_history WHERE DATE_FORMAT(datetime,'%Y-%m-%d')='$newformat' AND id_product = 11";
                          $objq_sole = mysqli_query($conn,$price_sole);
                          $objr_sole = mysqli_fetch_array($objq_sole);

                          $price_deer = "SELECT SUM(num) FROM sale_car_history WHERE DATE_FORMAT(datetime,'%Y-%m-%d')='$newformat' AND id_product = 34";
                          $objq_deer = mysqli_query($conn,$price_deer);
                          $objr_deer = mysqli_fetch_array($objq_deer);

                          $price_hd = "SELECT SUM(num) FROM sale_car_history WHERE DATE_FORMAT(datetime,'%Y-%m-%d')='$newformat' AND id_product = 3";
                          $objq_hd = mysqli_query($conn,$price_hd);
                          $objr_hd = mysqli_fetch_array($objq_hd);

                          $price_shd = "SELECT SUM(num) FROM sale_car_history WHERE DATE_FORMAT(datetime,'%Y-%m-%d')='$newformat' AND id_product = 1";
                          $objq_shd = mysqli_query($conn,$price_shd);
                          $objr_shd = mysqli_fetch_array($objq_shd);

                          $price_vh = "SELECT SUM(num) FROM sale_car_history WHERE DATE_FORMAT(datetime,'%Y-%m-%d')='$newformat' AND id_product = 5";
                          $objq_vh = mysqli_query($conn,$price_vh);
                          $objr_vh = mysqli_fetch_array($objq_vh);

                          $price_fish = "SELECT SUM(num) FROM sale_car_history WHERE DATE_FORMAT(datetime,'%Y-%m-%d')='$newformat' AND id_product = 32";
                          $objq_fish = mysqli_query($conn,$price_fish);
                          $objr_fish = mysqli_fetch_array($objq_fish);
                    ?>
                    <tr>
                      <td class="text-center"><?php echo DateThai3($date); ?></td>
                      <td class="text-center"><?php echo $all_money;?></td>
                      <td class="text-center"><?php echo $total_money;?></td>
                      <td class="text-center"><?php echo $objr_sole['SUM(num)'];?></td>
                      <td class="text-center"><?php echo $objr_deer['SUM(num)'];?></td>
                      <td class="text-center"><?php echo $objr_hd['SUM(num)'];?></td>
                      <td class="text-center"><?php echo $objr_shd['SUM(num)'];?></td>
                      <td class="text-center"><?php echo $objr_vh['SUM(num)'];?></td>
                      <td class="text-center"><?php echo $objr_fish['SUM(num)'];?></td>
                    </tr>
                    <?php $i++;}?>
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
  <script>
  $(function() {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging': true,
      'lengthChange': false,
      'searching': false,
      'ordering': true,
      'info': true,
      'autoWidth': false
    })
  })
  $(function() {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });
    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function() {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });
    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function(e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");
      //Switch states
      if (glyph) {
        $this.toggleClass("glyphicon-star");
        $this.toggleClass("glyphicon-star-empty");
      }
      if (fa) {
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
    });
  });
  </script>
</body>
</html>
