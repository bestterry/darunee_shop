<?php 
  require "../config_database/config.php";
  require "../session.php"; 
  $aday = $_POST['aday'];
  $bday = $_POST['bday'];
  function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}
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
    <div class="content-wrapper" style="height: 1000px;">
      <section class="content-header">
      </section>
      <section class="content">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <div class="box box-primary">
            <div class="box-header text-center with-border">
              <div align="right">
                <a href="admin.php" class="btn btn-success"><<== กลับสู่เมนูหลัก</a>
              </div>
              <font size="5">
                <B> เงินสะสม <font color="red"><?php echo DateThai($aday);?></font> ถึง <font color="red"><?php echo DateThai($bday);?></font></B>
              </font>
            </div>
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                <table class="table table-striped table-bordered">
                  <tbody>
                    <tr class="info" >
                    <th class="text-center" width="15%">วันที่</th>
                      <th class="text-center" width="25%">เงินได้</th>
                      <th class="text-center" width="13%">เงินได้สะสม</th>
                      <th class="text-center" width="15%">เงินได้เฉลี่ย</th>
                    </tr>
                    <?php
                        $total_money = 0;
                        $i = 1;
                        $sql_day_car = "SELECT SUM(money),datetime FROM sale_car_history WHERE (datetime between '$aday 00:00:00' and '$bday 23:59:59') GROUP BY DAY(datetime),MONTH(datetime),YEAR(datetime) ORDER BY datetime";
                        $objq_day_car = mysqli_query($conn,$sql_day_car);
                        while ($value = $objq_day_car-> fetch_assoc() ) {
                          $money_car = $value['SUM(money)'];
                          $date = $value['datetime'];
                          $total_money = $total_money + $money_car;
                        //  time
                        //  $d=strtotime($date);
                        //   echo date("Y-m-d", $d);
                    ?>
                    <tr>
                    <td class="text-center"><?php echo DateThai($date);?></td>
                      <td class="text-center"><?php echo $money_car;?></td>
                      <td class="text-center"><?php echo $total_money;?></td>
                      <td class="text-center"><?php echo round($total_money/$i);?></td>
                    </tr>
                      <?php $i++;}?>
                  </tbody>
                </table>
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
