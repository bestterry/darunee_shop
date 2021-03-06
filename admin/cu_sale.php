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

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
    .button2 {
      background-color: #b35900;
      color : white;
      } /* Back & continue */
    </style>
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
              <div align="left">
                <a href="admin.php" class="btn button2"><< เมนูหลัก</a>
              </div>
              <font size="5">
                <B> ยอดสะสม <font color="red"><?php echo DateThai($aday);?></font> ถึง <font color="red"><?php echo DateThai($bday);?></font></B>
              </font>
            </div>
            <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <table class="table table-striped">
                  <thead>
                    <tr class="info">
                      <th class="text-center" width="9%">วันที่</th>
                      <th class="text-center" width="9%">เงินขาย</th>
                      <th class="text-center" width="9%">เงินสะสม</th>
                      <th class="text-center" width="9%">SOLE</th>
                      <th class="text-center" width="9%">SOLEสะสม</th>
                      <th class="text-center" width="9%">กวาง</th>
                      <th class="text-center" width="9%">กวางสะสม</th>
                      <th class="text-center" width="9%">HD</th>
                      <th class="text-center" width="9%">SHD</th>
                      <th class="text-center" width="9%">VH</th>
                      <th class="text-center" width="9%">ปร</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                       $total_money = 0;
                       $total_sole = 0;
                       $total_deer = 0;
                      // $total_profit2 = 0;
                      // $i = 1;
                      while (strtotime($aday) <= strtotime($bday)) { 

                        $store_sale = "SELECT SUM(money) FROM price_history WHERE DATE_FORMAT(datetime,'%Y-%m-%d')='$aday'";
                        $objq_store_sale = mysqli_query($conn,$store_sale);
                        $objr_store_sale = mysqli_fetch_array($objq_store_sale);

                        $car_sale = "SELECT SUM(money) FROM sale_car_history WHERE DATE_FORMAT(datetime,'%Y-%m-%d')='$aday'";
                        $objq_car_sale = mysqli_query($conn,$car_sale);
                        $objr_car_sale = mysqli_fetch_array($objq_car_sale);

                        $money_store = $objr_store_sale['SUM(money)'];
                        $money_car = $objr_car_sale['SUM(money)'];
                        $all_money = $money_store + $money_car; 
                        $total_money = $total_money + $all_money;

                        $price_sole = "SELECT SUM(num) FROM sale_car_history WHERE DATE_FORMAT(datetime,'%Y-%m-%d')='$aday' AND id_product = 11";
                        $objq_sole = mysqli_query($conn,$price_sole);
                        $objr_sole = mysqli_fetch_array($objq_sole);
                        $priceS_sole = "SELECT SUM(num) FROM price_history WHERE DATE_FORMAT(datetime,'%Y-%m-%d')='$aday' AND id_product = 11";
                        $objqS_sole = mysqli_query($conn,$priceS_sole);
                        $objrS_sole = mysqli_fetch_array($objqS_sole);
                        $num_sole = $objr_sole['SUM(num)']+$objrS_sole['SUM(num)'];
                        $total_sole = $total_sole+$num_sole;

                        $price_deer = "SELECT SUM(num) FROM sale_car_history WHERE DATE_FORMAT(datetime,'%Y-%m-%d')='$aday' AND id_product = 34";
                        $objq_deer = mysqli_query($conn,$price_deer);
                        $objr_deer = mysqli_fetch_array($objq_deer);
                        $priceS_deer = "SELECT SUM(num) FROM price_history WHERE DATE_FORMAT(datetime,'%Y-%m-%d')='$aday' AND id_product = 34";
                        $objqS_deer = mysqli_query($conn,$priceS_deer);
                        $objrS_deer = mysqli_fetch_array($objqS_deer);
                        $num_deer = $objr_deer['SUM(num)']+$objrS_deer['SUM(num)'];
                        $total_deer = $total_deer+$num_deer;

                        $price_hd = "SELECT SUM(num) FROM sale_car_history WHERE DATE_FORMAT(datetime,'%Y-%m-%d')='$aday' AND id_product = 3";
                        $objq_hd = mysqli_query($conn,$price_hd);
                        $objr_hd = mysqli_fetch_array($objq_hd);
                        $priceS_hd = "SELECT SUM(num) FROM price_history WHERE DATE_FORMAT(datetime,'%Y-%m-%d')='$aday' AND id_product = 3";
                        $objqS_hd = mysqli_query($conn,$priceS_hd);
                        $objrS_hd = mysqli_fetch_array($objqS_hd);

                        $price_shd = "SELECT SUM(num) FROM sale_car_history WHERE DATE_FORMAT(datetime,'%Y-%m-%d')='$aday' AND id_product = 1";
                        $objq_shd = mysqli_query($conn,$price_shd);
                        $objr_shd = mysqli_fetch_array($objq_shd);
                        $priceS_shd = "SELECT SUM(num) FROM price_history WHERE DATE_FORMAT(datetime,'%Y-%m-%d')='$aday' AND id_product = 1";
                        $objqS_shd = mysqli_query($conn,$priceS_shd);
                        $objrS_shd = mysqli_fetch_array($objqS_shd);

                        $price_vh = "SELECT SUM(num) FROM sale_car_history WHERE DATE_FORMAT(datetime,'%Y-%m-%d')='$aday' AND id_product = 5";
                        $objq_vh = mysqli_query($conn,$price_vh);
                        $objr_vh = mysqli_fetch_array($objq_vh);
                        $priceS_vh = "SELECT SUM(num) FROM price_history WHERE DATE_FORMAT(datetime,'%Y-%m-%d')='$aday' AND id_product = 5";
                        $objqS_vh = mysqli_query($conn,$priceS_vh);
                        $objrS_vh = mysqli_fetch_array($objqS_vh);

                        $price_fish = "SELECT SUM(num) FROM sale_car_history WHERE DATE_FORMAT(datetime,'%Y-%m-%d')='$aday' AND id_product = 32";
                        $objq_fish = mysqli_query($conn,$price_fish);
                        $objr_fish = mysqli_fetch_array($objq_fish);
                        $priceS_fish = "SELECT SUM(num) FROM price_history WHERE DATE_FORMAT(datetime,'%Y-%m-%d')='$aday' AND id_product = 32";
                        $objqS_fish = mysqli_query($conn,$priceS_fish);
                        $objrS_fish = mysqli_fetch_array($objqS_fish);
                      
                    ?>
                    <tr>
                      <td class="text-center"><?php echo DateThai3($aday); ?></td>
                      <td class="text-center"><?php echo $all_money;?></td>
                      <td class="text-center"><?php echo $total_money;?></td>
                      <td class="text-center"><?php echo $objr_sole['SUM(num)']+$objrS_sole['SUM(num)'];?></td>
                      <td class="text-center"><?php echo $total_sole;?></td>
                      <td class="text-center"><?php echo $objr_deer['SUM(num)']+$objrS_deer['SUM(num)'];?></td>
                      <td class="text-center"><?php echo $total_deer;?></td>
                      <td class="text-center"><?php echo $objr_hd['SUM(num)']+$objrS_hd['SUM(num)'];?></td>
                      <td class="text-center"><?php echo $objr_shd['SUM(num)']+$objrS_shd['SUM(num)'];?></td>
                      <td class="text-center"><?php echo $objr_vh['SUM(num)']+$objrS_vh['SUM(num)'];?></td>
                      <td class="text-center"><?php echo $objr_fish['SUM(num)']+$objrS_fish['SUM(num)'];?></td>
                    </tr>
                    
                    <?php
                    $aday = date ("Y-m-d", strtotime("+1 day", strtotime($aday)));
                      } //$i++;}
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
