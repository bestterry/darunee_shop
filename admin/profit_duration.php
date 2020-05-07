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

  <!-- Google Font -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
      .button2 {
        background-color: #b35900;
        color : white;
        } /* Back & continue */
    </style>
</head>

<body class=" hold-transition skin-blue layout-top-nav ">
  <div class="wrapper">
    <header class="main-header">
    <?php require('menu/header_logout.php');?>
    </header>

    <div class="content-wrapper">
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <div class="box box-default">
                <div class="box-header text-center with-border">
                  <a href="profit.php" class="btn button2 pull-left" ><< ย้อนกลับ </a>
                  <font size="5"><B> ยอดจำหน่าย <font color="red"><?php echo DateThai($aday);?></font>  ถึง <font color="red"><?php echo DateThai($bday);?></font> </B></font>                        
                </div>

                <div class="box-body">
                  <div class="row">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th class="text-center" width="30%"> <font color="red">สินค้า_หน่วย</font> </th>
                          <th class="text-center" width="14%"> <font color="red">จำนวน</font> </th>
                          <th class="text-center" width="14%"> <font color="red">ทุน/หน่วย</font> </th>
                          <th class="text-center" width="14%"> <font color="red">ทุนซื้อ</font> </th>
                          <th class="text-center" width="14%"> <font color="red">เงินขาย</font> </th>
                          <th class="text-center" width="14%"> <font color="red">กำไรขาย</font> </th>
                        </tr>
                        <?php
                        $a = 0;
                        $b = 0;
                        $total_money = 0;
                          $sql_checkproduct = "SELECT * FROM product WHERE status_stock = 1";
                          $objq_checkprouct = mysqli_query($conn,$sql_checkproduct);
                          while($value = $objq_checkprouct-> fetch_assoc()){
                            $id_product = $value['id_product'];
                            $price_num = $value['price_num'];

                            $sql_salecar = "SELECT SUM(num),SUM(money) FROM sale_car_history 
                                            WHERE id_product = $id_product AND (datetime between '$aday 00:00:00' and '$bday 23:59:59')";
                            $objq_salecar = mysqli_query($conn,$sql_salecar);
                            $objr_salecar = mysqli_fetch_array($objq_salecar);
                            $num_salecar = $objr_salecar['SUM(num)'];
                            $money_salecar = $objr_salecar['SUM(money)'];

                            $sql_salestore = "SELECT SUM(num),SUM(money) FROM price_history 
                                              WHERE id_product = $id_product AND (datetime between '$aday 00:00:00' and '$bday 23:59:59')";
                            $objq_salestore = mysqli_query($conn,$sql_salestore);
                            $objr_salestore = mysqli_fetch_array($objq_salestore);
                            $num_salestore = $objr_salestore['SUM(num)'];
                            $money_salestore = $objr_salestore['SUM(money)'];

                            $total_num = $num_salecar + $num_salestore;
                            $total_salemoney = $money_salecar + $money_salestore;
                            $price_product = $total_num * $price_num;
                            $profit_sale = $total_salemoney - $price_product;
                        ?>
                        <tr>
                          <td class="text-center"><?php echo $value['name_product'].'_'.$value['unit'];?></td>
                          <td class="text-center"><?php if($total_num=="0"){ echo "-";}else{ echo $total_num; }  ?></td>
                          <td class="text-center"><?php if($price_num=="0"){ echo "-";}else{ echo $price_num; }  ?></td>
                          <td class="text-center"><?php if($price_product=="0"){ echo "-";}else{ echo $price_product; } ?></td>
                          <td class="text-center"><?php if($total_salemoney=="0"){ echo "-";}else{ echo $total_salemoney; } ?></td>
                          <td class="text-center"><?php if($profit_sale=="0"){ echo "-";}else{ echo $profit_sale; } ?></td>
                        </tr>
                        <?php 
                          $a = $a + $total_salemoney;
                          $b = $b + $price_product;
                          $total_money = $total_money + $profit_sale; 
                        }
                        ?>
                        <tr>
                          <th></th>
                          <th></th>
                          <th class="text-center"> <font color="red">รวมเงิน</font> </th>
                          <th class="text-center"> <font color="red"><?php echo round($b); ?></font></th>
                          <th class="text-center"> <font color="red"><?php echo round($a); ?></font></th>
                          <th class="text-center"> <font color="red"><?php echo round($total_money); ?></font></th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
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