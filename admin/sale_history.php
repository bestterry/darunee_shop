<?php 

  require "../config_database/config.php";
  require "../session.php"; 
  require "menu/date.php";

  $list_product = "SELECT * FROM product";
  $query_product = mysqli_query($conn,$list_product);
  $query_product2 = mysqli_query($conn,$list_product);
  $objq_profit = mysqli_query($conn,$list_product);
  $strDate = date('d-m-Y');

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
                <li class="active"><a href="#timeline" data-toggle="tab">ยอดขายวันนี้</a></li>
                <li><a href="#checkday" data-toggle="tab">ยอดขายย้อนหลัง</a></li>
                <li><a href="#settings" data-toggle="tab">ยอดขายตามช่วงเวลา</a></li>
                <div align="right">
                  <a href="admin.php" class="btn button2"> << เมนูหลัก </a>
                </div>
              </ul>
              <div class="tab-content">
                <!-- /.tab-pane -->
                <div class="tab-pane active" id="timeline">
                  <div class="form-group">
                    <div class="box box-default">
                      <!-- /.box-header -->
                      <div class="box-body">
                        <div class="row">
                          <div class="container">
                            <div class="box-header text-center with-border">
                              <font size="5">
                                <B>ยอดขาย 
                                  <font size="5" color="red">
                                    <?php 
                                        $strDate = date('d-m-Y');
                                        echo DateThai($strDate);
                                    ?>
                                  </font>
                              </font>
                              </B>
                            </div>

                            <!-- ------------------------------ยอดขาย---------------------------- -->
                            <table class="table">
                              <thead>
                                <tr >
                                  <th class="text-right" width="50%"> <font color="red">หน่วยขาย</font></th>
                                  <th class="text-left" width="50%"><font color="red">เงินขาย</font></th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                  $sql_wp = "SELECT SUM(money) FROM price_history WHERE DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate'";
                                  $objq_wp = mysqli_query($conn,$sql_wp);
                                  $objr_wp = mysqli_fetch_array($objq_wp);
                                  $sum_wp = $objr_wp['SUM(money)'];

                                ?>
                                <tr>
                                  <td class="text-right" >หน้าร้าน</td>
                                  <td class="text-left" ><?php echo $sum_wp;?></td>
                                </tr>
                                <?php 
                                  $total_money = 0;
                                  $total_numsoft1 = 0;
                                  $total_numsoft2 = 0;
                                    $sql_idmember = "SELECT * FROM member 
                                                    WHERE status = 'employee' 
                                                    AND NOT id_member = 3
                                                    AND NOT id_member = 8
                                                    AND NOT id_member = 19
                                                    AND NOT id_member = 28 
                                                    AND NOT id_member = 32";
                                    $objq_member = mysqli_query($conn,$sql_idmember);
                                    while($value = $objq_member->fetch_assoc()){
                                      $id_member = $value['id_member'];
                                      $sql_sum_money = "SELECT SUM(money),name FROM sale_car_history INNER JOIN member ON sale_car_history.id_member = member.id_member 
                                                  WHERE sale_car_history.id_member = $id_member AND DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate'";
                                      $objq_sum_money = mysqli_query($conn,$sql_sum_money);
                                      $objr_sum_money = mysqli_fetch_array($objq_sum_money);

                                      $name = $objr_sum_money['name'];
                                      $sum_money = $objr_sum_money['SUM(money)'];
                                      if (isset($sum_money) && !$sum_money == 0) {
                                ?> 
                                <tr>
                                  <td class="text-right"><?php echo $name;?></td>
                                  <td class="text-left"><?php echo $sum_money;?></td>
                                </tr>
                                <?php 
                                      }else{
                                           
                                      }
                                      $total_money = $total_money + $sum_money;
                                ?>
                               
                                <?php 
                                    }
                                ?>
                                  <th class=" text-right"><font color="red">เงินรวม</font></th>
                                  <th class=" text-left"><font color="red"><?php echo $total_money+$sum_wp;?></font></th>
                              </tbody>
                            </table>
                            <!-- ------------------------------ยอดขาย---------------------------- -->

                            <!-- ------------------------------กำไร---------------------------- -->

                           
                            <!-- <table class="table table-striped table-bordered">
                              <thead>
                                <tr class="info" >
                                  <th class="text-center" width="30%">สินค้า_หน่วย</th>
                                  <th class="text-center" width="14%">จำนวน</th>
                                  <th class="text-center" width="14%">ทุน/หน่วย</th>
                                  <th class="text-center" width="14%">ทุนซื้อ</th>
                                  <th class="text-center" width="14%">เงินขาย</th>
                                  <th class="text-center" width="14%">กำไรขาย</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $a = 0;
                                $b = 0;
                                $total_money = 0;
                                 
                                  while($value = $objq_profit-> fetch_assoc()){
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
                                  <td class="text-center"><?php echo $value['name_product'].'_'.$value['unit'];?></td>
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
                                  <th bgcolor="#EAF4FF" class="text-center">รวมเงิน</th>
                                  <th bgcolor="#EAF4FF" class="text-center"><?php echo round($b); ?></th>
                                  <th bgcolor="#EAF4FF" class="text-center"><?php echo round($a); ?></th>
                                  <th bgcolor="#EAF4FF" class="text-center"><?php echo round($total_money); ?></th>
                                </tr>
                              </tbody>
                            </table> -->
                            <!-- ------------------------------//กำไร---------------------------- -->


                            <!-- ------------------------------หน้าร้าน---------------------------- -->
                            <div class="text-center">
                              <B>
                                <font size="5">
                                  หน้าร้าน
                                </font>
                              </B>
                            </div>
                            <table class="table">
                              <thead>
                                <tr>
                                  <th class="text-center" width="20%"> <font color="red">สินค้า_หน่วย</font></th>
                                  <th class="text-center" width="8%"><font color="red">จำนวน</font></th>
                                  <th class="text-center" width="10%"><font color="red">บ/หน่วย</font></th>
                                  <th class="text-center" width="10%"><font color="red">เงินขาย</font></th>
                                  <th class="text-center" width="36%"><font color="red">รายละเอียด</font></th>
                                  <th class="text-center" width="16%"><font color="red">ร้าน</font></th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                                  $total_money = 0;
                                                  $date = " SELECT * FROM price_history 
                                                            INNER JOIN product ON product.id_product = price_history.id_product
                                                            INNER JOIN zone ON price_history.id_zone = zone.id_zone 
                                                            WHERE DATE_FORMAT(price_history.datetime,'%d-%m-%Y')='$strDate'";
                                                  $objq = mysqli_query($conn,$date);
                                                  while($value = $objq ->fetch_assoc()){ 
                                              ?>
                                <tr>
                                  <td class="text-center">
                                    <?php echo $value['name_product'].'_'.$value['unit']; ?>
                                  </td>
                                  <td class="text-center">
                                    <?php echo $value['num'];?>
                                  </td>
                                  <td class="text-center">
                                    <?php echo $value['price']; ?>
                                  </td>
                                  <td class="text-center">
                                    <?php echo $value['money']; ?>
                                  </td>
                                  <td class="text-center">
                                    <?php echo $value['note']; ?>
                                  </td>
                                  <td class="text-center">
                                    <?php echo $value['name_zone']; ?>
                                  </td>
                                </tr>
                                <?php
                                                      $total_money = $total_money + $value['money'];
                                                    }
                                                  ?>
                                <tr>
                                  <th class="text-center"></th>
                                  <th class="text-center"></th>
                                  <th class="text-center"><font color="red">รวมเงิน</font></th>
                                  <th class="text-center"><font color="red"><?php echo $total_money;?></font></th>
                                  <th class="text-center"></th>
                                  <th></th>
                                </tr>
                              </tbody>
                            </table>
                            <!-- ------------------------------//หน้าร้าน---------------------------- -->

                            <!-- ------------------------------//รถรวม---------------------------- -->

                            <?php for ($i=3; $i <= 19; $i++) { 
                                                      $sql_member = "SELECT * FROM member WHERE id_member = $i";
                                                      $objq_member = mysqli_query($conn,$sql_member);
                                                      $objr_member = mysqli_fetch_array($objq_member);

                                                      $check = " SELECT * FROM product INNER JOIN sale_car_history
                                                                ON product.id_product = sale_car_history.id_product 
                                                                WHERE sale_car_history.id_member = $i AND DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate' ";
                                                      $objq_check = mysqli_query($conn,$check);
                                                      $objr_check = mysqli_fetch_array($objq_check);
                                                      if(!isset($objr_check['num'])){

                                                      }else{
                                                    ?>
                            <div class="text-center">
                              <B>
                                <font size="5">
                                  <?php echo $objr_member['name']; ?>
                                </font>
                              </B>
                            </div>
                            <table class="table">
                              <thead>
                                <tr>
                                  <th class="text-center" width="20%"><font color="red">สินค้า_หน่วย</font></th>
                                  <th class="text-center" width="8%"><font color="red">จำนวน</font></th>
                                  <th class="text-center" width="10%"><font color="red">บ/หน่วย</font></th>
                                  <th class="text-center" width="10%"><font color="red">เงินขาย</font></th>
                                  <th class="text-center" width="36%"><font color="red">รายละเอียด</font></th>
                                  <th class="text-center" width="8%"><font color="red">เวลา</font></th>
                                  <th class="text-center" width="8%"><font color="red">#</font></th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php #endregion
                                              $total_money = 0;
                                                    $SQL_product = "SELECT * FROM product INNER JOIN sale_car_history
                                                                    ON product.id_product = sale_car_history.id_product 
                                                                    WHERE sale_car_history.id_member = $i AND DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate' ";
                                                    $objq_product = mysqli_query($conn,$SQL_product);
                                                    while($product = $objq_product -> fetch_assoc()){
                                              ?>
                                <tr>
                                  <td class="text-center">
                                    <?php echo $product['name_product'].'_'.$product['unit']; ?>
                                  </td>
                                  <td class="text-center">
                                    <?php echo $product['num'];?>
                                  </td>
                                  <td class="text-center">
                                    <?php echo $product['price']; ?>
                                  </td>
                                  <td class="text-center">
                                    <?php echo $product['money']; ?>
                                  </td>
                                  <td class="text-center">
                                    <?php echo $product['note']; ?>
                                  </td>
                                  <td class="text-center">
                                    <?php echo DateThai2($product['datetime']); ?>
                                  </td>
                                  <td class="text-center" >
                                    <a href="edit_sale_car.php?id_sale_history=<?php echo $product['id_sale_history']; ?>" > <i class="fa fa-pencil"></i> </a>
                                  </td>
                                </tr>
                                <?php 
                                                    $total_money = $total_money + $product['money'];
                                                  } 
                                              ?>
                                <tr>
                                  <td ></td>
                                  <td ></td>
                                  <th class="text-center"><font color="red">รวมเงิน</font></th>
                                  <th class="text-center"><font color="red"><?php echo $total_money;?></font></th>
                                  <td ></td>
                                  <td ></td>
                                  <td ></td>
                                </tr>
                              </tbody>
                            </table>
                            <?php
                                                      } 
                                                    }
                                              ?>
                            <!-- ------------------------------/รวมรถ------------------------------------- -->

                          </div>
                        </div>
                      </div>
                      <div class="box-footer" align="center">
                        <a href="../pdf_file/admin_sale_history.php" class="btn btn-success"><i class="fa fa-print"> พิมพ์ </i></a>
                      </div>
                    </div>
                  </div>

                </div>
                <!-- /.tab-pane -->

                <!-- tab-pane -->
                <div class="tab-pane" id="checkday">
                  <div class="box box-default">
                    <div class="box-header with-border">
                    </div>
                    <!-- /.box-header -->
                    <form action="checkday_sale_history.php" method="post">
                      <div class="row">
                        <div class="container">
                          <div class="col-md-12">
                            <div class="box-body">
                              <div class="form-group">
                                <label class="col-sm-4 control-label text-right"> <font size="5"> ข้อมูลยอดขายวันที่ :</font></label>
                                <div class="col-sm-4">
                                  <input class="form-control" type="date" name="day">
                                </div>
                                <div class="col-sm-4"></div>
                              </div>
                            </div>

                            <div class="box-footer text-center">
                              <div align="center" >
                                <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> ดูข้อมูลยอดขาย </button>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <!-- /.tab-pane -->

                <!-- tab-pane -->
                <div class="tab-pane" id="settings">
                  <div class="box box-default">
                    <div class="box-header text-center with-border">
                      <font size="5">
                        <B> ข้อมูลยอดขาย </B>
                      </font>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="row">
                        <div class="container">
                          <form action="check_sale_history.php" method="post">
                            <div class="row">
                              <div class="container">
                                <div class="col-md-12">
                                  <div class="box-body">
                                    <div class="form-group">
                                      <label class="col-sm-2 control-label text-right"><font size="5"> ตั้งแต่วันที :</font></label>
                                      <div class="col-sm-4">
                                        <input class="form-control" type="date" name="aday">
                                      </div>
                                      <label class="col-sm-2 control-label text-right"><font size="5"> ถึงวันที :</font></label>
                                      <div class="col-sm-4">
                                        <input class="form-control" type="date" name="bday">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="box-footer text-center">
                                    <div align="center" >
                                      <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> ดูข้อมูลยอดขาย </button>
                                    </div>
                                  </div>
                                </div>
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