<?php 

  require "../config_database/config.php";
  require "../session.php"; 
  require "menu/date.php";
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
    #customers {
      
      width: 100%;
    }

    #customers td, #customers th {
      border: 1px solid #ddd;
      padding: 8px;
    }

    #customers tr:nth-child(even){background-color: #f2f2f2;}

    #customers tr:hover {background-color: #ddd;}

    #customers th {
      padding-top: 12px;
      padding-bottom: 12px;
      background-color: #99CCFF;
    
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
                <li class="active"><a href="#timeline" data-toggle="tab">ข้อมูลขายวันนี้</a></li>
                <li><a href="#checkday" data-toggle="tab">ข้อมูลขายย้อนหลัง</a></li>
                <a type="block" href="store.php" class="btn btn-danger pull-right"><< เมนูหลัก </i></a>
              </ul>
              <div class="tab-content">
                <!-- /.tab-pane -->
                <div class="active tab-pane" id="timeline">
                  <div class="form-group">
                    <div class="box box-default">
                      <div class="box-body">
                        <?php 
                          $list_product = "SELECT * FROM product";
                          $query_product = mysqli_query($conn,$list_product);
                          $query_product2 = mysqli_query($conn,$list_product);
                          $strDate = date('d-m-Y');
                        ?>
                          <!-- --------------------------------ประวัติรับเข้าสินค้า-------------------------------- -->
                            <?php
                              $date = "SELECT * FROM draw_history 
                              INNER JOIN member ON draw_history.id_member = member.id_member 
                              INNER JOIN product ON draw_history.id_product = product.id_product
                              INNER JOIN zone ON draw_history.id_zone = zone.id_zone
                              WHERE DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate' AND draw_history.id_member = '$id_member' ";
                              $objq = mysqli_query($conn,$date);
                              if(mysqli_num_rows($objq)==0) {} else{
                              ?>
                            <div class="box-header with-border text-center">
                              <font size="5">
                                <B> ประวัติเบิกสินค้า 
                                  <font color="red">
                                    <?php echo DateThai($strDate);?>
                                  </font>
                              </font>
                              </B>
                            </div>
                            <!-- /.box-header -->
                            <table class="table table-bordered">
                              <thead>
                                <tr bgcolor="#99CCFF">
                                  <th class="text-center" width="33%">สินค้า_หน่วย</th>
                                  <th class="text-center" width="33%">จำนวน</th>
                                  <th class="text-center" width="33%">เบิกจาก</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php #endregion
                                  while($value = $objq ->fetch_assoc()){
                                ?>
                                <tr>
                                  <td class="text-center"><?php echo $value['name_product'].'_'.$value['unit']; ?></td>
                                  <td class="text-center"><?php echo $value['num_draw'];?></td>
                                  <td class="text-center"><?php echo $value['name_zone']; ?></td>
                                </tr>
                                <?php
                                  }
                                ?>
                              </tbody>
                            </table>
                            <?php }?>
                          <!-- --------------------------------//ประวัติรับเข้าสินค้า-------------------------------- -->
                          
                          <!-- --------------------------------ประวัติรับโอนสินค้า-------------------------------- -->
                            <?php
                              $change_bwt_car = "SELECT * FROM change_bwt_car 
                              INNER JOIN member ON change_bwt_car.id_member_receive = member.id_member 
                              INNER JOIN product ON change_bwt_car.id_product = product.id_product
                              WHERE DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate' AND change_bwt_car.id_member_send = '$id_member' ";
                              $objq_change = mysqli_query($conn,$change_bwt_car);
                              if(mysqli_num_rows($objq_change)==0) {} else{
                            ?>
                            <div class="box-header with-border text-center">
                              <font size="5">
                                <B> ประวัติโอนสินค้าระหว่างรถ 
                                  <font color="red">
                                    <?php echo DateThai($strDate);?>
                                  </font>
                                </B>
                              </font>
                            </div>
                            <!-- /.box-header -->
                            <table class="table table-bordered">
                              <thead>
                                <tr bgcolor="#99CCFF">
                                  <th class="text-center" width="33%">สินค้า_หน่วย</th>
                                  <th class="text-center" width="33%">จำนวน</th>
                                  <th class="text-center" width="33%">โอนให้</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                  while($value = $objq_change ->fetch_assoc()){
                                ?>
                                <tr>
                                  <td class="text-center"><?php echo $value['name_product'].'_'.$value['unit']; ?></td>
                                  <td class="text-center"><?php echo $value['num'];?></td>
                                  <td class="text-center"><?php echo $value['name']; ?></td>
                                </tr>
                                <?php
                                  }
                                ?>
                              </tbody>
                            </table>
                            <?php }?>
                          <!-- --------------------------------//ประวัติโอนสินค้า-------------------------------- -->

                          <!-- --------------------------------ประวัติรับเข้าสินค้าระหว่างรถ-------------------------------- -->
                            <?php
                              $change_bwt_car = "SELECT * FROM change_bwt_car 
                              INNER JOIN member ON change_bwt_car.id_member_send = member.id_member 
                              INNER JOIN product ON change_bwt_car.id_product = product.id_product
                              WHERE DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate' AND change_bwt_car.id_member_receive = '$id_member' ";
                              $objq_change = mysqli_query($conn,$change_bwt_car);
                              if(mysqli_num_rows($objq_change)==0) {} else{
                            ?>
                            <div class="box-header with-border text-center">
                              <font size="5">
                                <B> ประวัติรับสินค้าระหว่างรถ 
                                  <font size="4" color="red">
                                    <?php echo DateThai($strDate);?>
                                  </font>
                              </font>
                              </B>
                            </div>
                            <!-- /.box-header -->
                            <table class="table table-bordered">
                              <tbody>
                                <tr bgcolor="#99CCFF">
                                  <th class="text-center" width="33%">สินค้า_หน่วย</th>
                                  <th class="text-center" width="33%">จำนวน</th>
                                  <th class="text-center" width="33%">รับจาก</th>
                                </tr>
                                <?php
                                  while($value = $objq_change ->fetch_assoc()){
                                ?>
                                <tr>
                                  <td class="text-center"><?php echo $value['name_product'].'_'.$value['unit']; ?></td>
                                  <td class="text-center"><?php echo $value['num'];?></td>
                                  <td class="text-center"><?php echo $value['name']; ?></td>
                                </tr>
                                <?php
                                  }
                                ?>
                              </tbody>
                            </table>
                            <?php }?>
                          <!-- --------------------------------//ประวัติรับเข้าสินค้าระหว่างรถ-------------------------------- -->

                          <!-- --------------------------------ประวัติการขายสินค้า-------------------------------- -->
                            <div class="box-header with-border text-center">
                              <font size="5">
                                <B> ข้อมูลการขาย 
                                  <font color="red">
                                    <?php echo DateThai($strDate);?>
                                  </font>
                              </font>
                              </B>
                            </div>
                            <table class="table table-bordered">
                              <thead>
                                <tr bgcolor="#99CCFF">
                                  <th class="text-center" width="20%">สินค้า_หน่วย</th>
                                  <th class="text-center" width="10%">จำนวน</th>
                                  <th class="text-center" width="10%">บ/หน่วย</th>
                                  <th class="text-center" width="10%">เงิน(บ)</th>
                                  <th class="text-center" width="20%">ลูกค้า </th>
                                  <th class="text-center" width="25%">รายละเอียด </th>
                                  <th class="text-center" width="5%">ลบ</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php #endregion
                                      $SQL_product = "SELECT * FROM product INNER JOIN sale_car_history 
                                                      ON product.id_product = sale_car_history.id_product 
                                                      WHERE DATE_FORMAT(sale_car_history.datetime,'%d-%m-%Y')='$strDate' AND sale_car_history.id_member = '$id_member'";
                                      $objq_product = mysqli_query($conn,$SQL_product);
                                      while($value_pd = $objq_product -> fetch_assoc()){
                                  ?>
                                <tr>
                                  <td class="text-center">
                                    <?php echo $value_pd['name_product'].'_'. $value_pd['unit']; ?>
                                  </td>
                                  <td class="text-center">
                                    <?php echo $value_pd['num'];?>
                                  </td>
                                  <td class="text-center">
                                    <?php echo $value_pd['price']; ?>
                                  </td>
                                  <td class="text-center">
                                    <?php echo $value_pd['money']; ?>
                                  </td>
                                  <td class="text-center">
                                    <?php echo $value_pd['customer']; ?>
                                  </td>
                                  <td class="text-center">
                                    <?php echo $value_pd['note']; ?>
                                  </td>
                                  <td class="text-center">
                                    <a onClick="return confirm('คุณต้องการที่จะลบข้อมูลนี้หรือไม่ ?')" href="algorithm/delete_sale.php?id_sale=<?php echo $value_pd['id_sale_history'];?>"
                                      <span class="glyphicon glyphicon-remove-circle"> </span>
                                    </a>
                                  </td>
                                </tr>
                                <?php
                                    }
                                ?>
                              </tbody>
                            </table>
                          <!-- --------------------------------//ประวัติการขายสินค้า------------------------- -->
                          
                          <!-- --------------------------------ยอดขายสินค้า-------------------------------- -->
                            <div class="box-header with-border text-center">
                              <font size="5">
                                <B> ยอดขาย 
                                  <font color="red">
                                    <?php echo DateThai($strDate);?>
                                  </font>
                              </font>
                              </B>
                            </div>
                            <table class="table table-bordered">
                              <thead>
                                <tr bgcolor="#99CCFF">
                                  <th class="text-center" width="33%">สินค้า_หน่วย
                                  </th>
                                  <th class="text-center" width="33%">จำนวน
                                  </th>
                                  <th class="text-center" width="33%">เงิน(บ)
                                  </th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  $sum_monny = 0;
                                  $sql_history = "SELECT * FROM product";
                                  $objq_history = mysqli_query($conn,$sql_history);
                                  while($history = $objq_history ->fetch_assoc()){
                                      $id_product = $history['id_product'];
                                      $total_sale = "SELECT SUM(sale_car_history.num),SUM(sale_car_history.money) FROM sale_car_history 
                                                      INNER JOIN product ON sale_car_history.id_product=product.id_product
                                                      WHERE product.id_product = '$id_product' AND DATE_FORMAT(sale_car_history.datetime,'%d-%m-%Y')='$strDate' AND sale_car_history.id_member = '$id_member' AND sale_car_history.status= 'sale'";
                                      $objq_sale = mysqli_query($conn,$total_sale);
                                      $objr_sale = mysqli_fetch_array($objq_sale);
                                      $num_product = $objr_sale['SUM(sale_car_history.num)'];
                                      $total_money = $objr_sale['SUM(sale_car_history.money)'];
                                      $sql_NameProduct = "SELECT * FROM product WHERE id_product = '$id_product'";
                                      $objq_NameProduct = mysqli_query($conn,$sql_NameProduct);
                                      $objr_NameProduct = mysqli_fetch_array($objq_NameProduct);
                                      if(isset($num_product)){ 
                                  ?>
                                <tr>
                                  <td class="text-center">
                                    <?php echo $objr_NameProduct['name_product'].'_'.$objr_NameProduct['unit']; ?>
                                  </td>
                                  <td class="text-center">
                                    <?php echo $num_product; ?>
                                  </td>
                                  <td class="text-center">
                                    <?php echo $total_money; ?>
                                  </td>
                                </tr>
                                <?php 
                                    }
                                  $sum_monny = $sum_monny+$total_money;
                                  } 
                                ?>
                                <tr>
                                  <th></th>
                                  <th class="text-right">รวมเงิน</th>
                                  <th class="text-center"> <?php echo $sum_monny; ?></th>
                                </tr>
                              </tbody>
                            </table>
                          <!-- --------------------------------//ยอดขายสินค้า-------------------------------- -->
                      </div>
                    </div>
                  </div>

                </div>
                <!-- /.tab-pane -->

                <!-- tab-pane -->
                <div class="tab-pane" id="checkday">
                  <div class="box box-default">
                    <div class="box-header with-border text-center">
                      <font size="5">
                        <B> ข้อมูลขายย้อนหลัง </B>
                      </font>
                    </div>
                    <div class="box-body">
                      <form action="checkday_sale_history.php" method="post">
                        <div class="row">
                          <div class="container">
                            <div class="col-md-12">
                              <div class="box-body">
                                <div class="form-group">
                                  <label class="col-sm-4 control-label text-right"></label>
                                  <div class="col-sm-4">
                                    <input class="form-control text-center" type="date" name="day" id="datePicker">
                                  </div>
                                  <div class="col-sm-4"></div>
                                </div>
                              </div>

                              <div class="box-footer text-center">
                                <div align="center" >
                                  <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> ตกลง </button>
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>
                      </form>
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