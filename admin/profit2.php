<?php 

  require "../config_database/config.php";
  require "../session.php"; 
  require "menu/date.php";

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
    <?php 
      require('menu/header_logout.php');
      
      ?>
    </header>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <!-- form start -->
          <div class="col-md-12">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#profit_today" data-toggle="tab">กำไรขายวันนี้</a></li>
                <li><a href="#profit_back" data-toggle="tab">กำไรขายย้อนหลัง</a></li>
                <li><a href="#profit_duration" data-toggle="tab">กำไรขายตามช่วงเวลา</a></li>
                <div align="right">
                  <a href="admin.php" class="btn button2"><< เมนูหลัก</a>
                </div>
              </ul>
              <div class="tab-content">

              
                  <!-- tab-pane -->
                  <div class="active tab-pane" id="profit_today">
                  <div class="box box-default">
                    <div class="box-header text-center with-border">
                      <font size="5">
                        <B>กำไรขายสินค้า 
                          <font size="5" color="red">
                            <?php 
                                $strDate = date('d-m-Y');
                                echo DateThai($strDate);
                            ?>
                          </font>
                         </B>  
                      </font>                        
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                      <div class="row">
                        <table class="table table-striped table-bordered">
                          <thead>
                            <tr class="info" >
                              <th class="text-center" width="30%">สินค้า_หน่วย</th>
                              <th class="text-center" width="14%">จำนวน</th>
                              <th class="text-center" width="14%">บ/หน่วย</th>
                              <th class="text-center" width="14%">ทุนซื้อ(บ)</th>
                              <th class="text-center" width="14%">เงินขาย(บ)</th>
                              <th class="text-center" width="14%">กำไรขาย(บ)</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $a = 0;
                            $b = 0;
                            $total_money = 0;
                              $sql_checkproduct = "SELECT * FROM product";
                              $objq_checkprouct = mysqli_query($conn,$sql_checkproduct);
                              while($value = $objq_checkprouct-> fetch_assoc()){
                                $id_product = $value['id_product'];
                                $price_num = $value['price_num'];

                                $sql_salecar = "SELECT SUM(num),SUM(money) FROM sale_car_history WHERE id_product = $id_product AND DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate'";
                                $objq_salecar = mysqli_query($conn,$sql_salecar);
                                $objr_salecar = mysqli_fetch_array($objq_salecar);
                                $num_salecar = $objr_salecar['SUM(num)'];
                                $money_salecar = $objr_salecar['SUM(money)'];

                                $sql_salestore = "SELECT SUM(num),SUM(money) FROM price_history WHERE id_product = $id_product AND DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate'";
                                $objq_salestore = mysqli_query($conn,$sql_salestore);
                                $objr_salestore = mysqli_fetch_array($objq_salestore);
                                $num_salestore = $objr_salestore['SUM(num)'];
                                $money_salestore = $objr_salestore['SUM(money)'];

                                $total_num = $num_salecar + $num_salestore;
                                $total_salemoney = $money_salecar + $money_salestore;
                                $price_product = $total_num * $price_num;
                                $profit_sale = $total_salemoney - $price_product;

                                if($total_salemoney == 0){

                                }else{
                            ?>
                            <tr>
                              <td><?php echo $value['name_product'].'_'.$value['unit'];?></td>
                              <td class="text-center"><?php echo $total_num; ?></td>
                              <td class="text-center"><?php echo $price_num; ?></td>
                              <td class="text-center"><?php echo round($price_product); ?></td>
                              <td class="text-center"><?php echo round($total_salemoney); ?></td>
                              <td class="text-center"><?php echo round($profit_sale); ?></td>
                            </tr>
                            <?php 
                                }
                                $a = $a + $total_salemoney;
                                $b = $b + $price_product;
                                $total_money = $total_money + $profit_sale; 
                            }
                            ?>
                            <tr>
                              <th bgcolor="#EAF4FF"></th>
                              <th bgcolor="#EAF4FF" ></th>
                              <th bgcolor="#EAF4FF" class="text-right">รวมเงิน</th>
                              <th bgcolor="#EAF4FF" class="text-center"><?php echo round($b); ?></th>
                              <th bgcolor="#EAF4FF" class="text-center"><?php echo round($a); ?></th>
                              <th bgcolor="#EAF4FF" class="text-center"><?php echo round($total_money); ?></th>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.tab-pane -->

                <!-- tab-pane -->
                <div class="tab-pane" id="profit_back">
                  <div class="box box-default">
                    <div class="box-header with-border text-center">
                      
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="row">
                        <div class="container">
                          <form action="profit_back.php" method="post">
                            <div class="col-md-5">
                              <div class="box-body">
                                <strong><i class="fa fa-file-text-o margin-r-5"></i> การใช้</strong>
                                <p> -กรุณาเลือกวันที่ เพื่อตรวจสอบกำไรขายย้อนหลัง</p>
                              </div>
                            </div>
                            <div class="col-md-5">
                              <div class="form-group">
                                <label>วันที่ : </label>
                                <input type="date" name="day">
                              </div>
                              <div class="box-footer">
                                <button type="submit" class="btn btn-success pull-left"><i
                                    class="fa fa-check-square-o"></i> ตกลง</button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.tab-pane -->

                <!-- tab-pane -->
                <div class="tab-pane" id="profit_duration">
                  <div class="box box-default">
                    <div class="box-header with-border">

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="row">
                        <div class="container">
                          <form action="profit_duration.php" method="post">
                            <div class="col-md-5">
                              <div class="box-body">
                                <strong><i class="fa fa-file-text-o margin-r-5"></i> การใช้ </strong>
                                <p> -กรุณาเลือกวันที่ เพื่อตรวจสอบกำไรขายย้อนหลัง</p>
                              </div>
                            </div>
                            <div class="col-md-5">
                              <div class="form-group">
                                <label>ตั้งเเต่ : </label>
                                <input type="date" name="aday">
                              </div>
                              <div class="form-group">
                                <label>ถึง &nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                <input type="date" name="bday">
                              </div>
                              <div class="box-footer">
                                <button type="submit" class="btn btn-success pull-left"><i
                                    class="fa fa-check-square-o"></i> ตกลง</button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.tab-pane -->
                
              </div>
              <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
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