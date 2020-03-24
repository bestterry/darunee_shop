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
            <div class="form-group">
              <div class="box box-default">
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="container">
                      <?php 
                          $list_product = "SELECT * FROM product";
                          $query_product = mysqli_query($conn,$list_product);
                          $query_product2 = mysqli_query($conn,$list_product);
                          $day = $_POST['day'];
                        ?>
                      <!-- ------------------------------ยอดขายรวม---------------------------- -->
                      <div class="box-header text-center with-border">
                      <div align="right">
                        <a href="admin.php" class="btn btn-success"><<== กลับสู่เมนูหลัก</a>
                      </div>
                        <font size="5">
                          <B>ยอดขาย 
                            <font size="5" color="red">
                              <?php echo DateThai($day);?>
                            </font>
                        </font>
                        </B>
                      </div>
                      <B>
                        <font size="4">
                          ยอดขายรวม
                        </font>
                      </B>
                      <table class="table table-striped ">
                        <tbody>
                          <tr class="info" >
                            <th class="text-center" width="50%">สินค้า_หน่วย</th>
                            <th class="text-center" width="25%">จำนวน</th>
                            <th class="text-center" width="25%">เงินขาย(บ)</th>
                          </tr>
                          <?php #endregion
                              $total_money = 0;
                              $total_all_money = 0;
                              $date = "SELECT * FROM product ";
                              $objq = mysqli_query($conn,$date);
                              while($value = $objq ->fetch_assoc()){ 
                                $id_product = $value['id_product'];
                                $sql_num = "SELECT SUM(num),SUM(money) FROM price_history WHERE DATE_FORMAT(datetime,'%Y-%m-%d')='$day' AND id_product = $id_product AND status = 'sale'";
                                $objq_num = mysqli_query($conn,$sql_num);
                                $objr_num = mysqli_fetch_array($objq_num);
                                $num = $objr_num['SUM(num)'];
                                $num_money = $objr_num['SUM(money)'];

                                $sql_num_car = "SELECT SUM(num),SUM(money) FROM sale_car_history WHERE DATE_FORMAT(datetime,'%Y-%m-%d')='$day' AND id_product = $id_product AND status = 'sale'";
                                $objq_num_car = mysqli_query($conn,$sql_num_car);
                                $objr_num_car = mysqli_fetch_array($objq_num_car);
                                $num_car = $objr_num_car['SUM(num)'];
                                $num_money_car = $objr_num_car['SUM(money)'];

                                $total_num = $num + $num_car;
                                $total_money = $num_money + $num_money_car;

                                if($total_num==0) {

                                }else{
                          ?>
                          <tr>
                            <td>
                              <?php echo $value['name_product'].'_'.$value['unit']; ?>
                            </td>
                            <td class="text-center">
                              <?php echo $total_num;?>
                            </td>
                            <td class="text-center">
                              <?php echo $total_money; ?>
                            </td>
                          </tr>
                          <?php
                                      $total_all_money = $total_all_money + $total_money;
                                    }
                                  }
                          ?>
                          <tr>
                            <th bgcolor="#EAF4FF"></th>
                            <th bgcolor="#EAF4FF" class="text-center">รวมเงิน</th>
                            <th bgcolor="#EAF4FF" class="text-center"><?php echo $total_all_money; ?></th>
                          </tr>
                        </tbody>
                      </table>
                      <!-- ------------------------------//ยอดขายรวม---------------------------- -->

                    <!-- ------------------------------หน้าร้าน---------------------------- -->
                          <B>
                            <font size="4">
                              หน้าร้าน
                            </font>
                          </B>
                          <table class="table table-striped table-bordered">
                            <tbody>
                              <tr class="info" >
                                <th class="text-center" width="25%">สินค้า_หน่วย</th>
                                <th class="text-center" width="8%">จำนวน</th>
                                <th class="text-center" width="12%">บ/หน่วย</th>
                                <th class="text-center" width="13%">เงินขาย(บ)</th>
                                <th class="text-center" width="13%">ร้าน</th>
                                <th class="text-center" width="50%">รายละเอียด</th>
                              </tr>
                              <?php
                                                $total_money = 0;
                                                $date = " SELECT * FROM price_history 
                                                          INNER JOIN product ON product.id_product = price_history.id_product
                                                          INNER JOIN zone ON price_history.id_zone = zone.id_zone 
                                                          WHERE DATE_FORMAT(price_history.datetime,'%Y-%m-%d')='$day'";
                                                $objq = mysqli_query($conn,$date);
                                                while($value = $objq ->fetch_assoc()){ 
                                            ?>
                              <tr>
                                <td>
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
                                  <?php echo $value['name_zone']; ?>
                                </td>
                                <td class="text-center">
                                  <?php echo $value['note']; ?>
                                </td>
                              </tr>
                              <?php
                                                    $total_money = $total_money + $value['money'];
                                                  }
                                                ?>
                              <tr>
                                <th bgcolor="#EAF4FF" class="text-center"></th>
                                <th bgcolor="#EAF4FF" class="text-center"></th>
                                <th bgcolor="#EAF4FF" class="text-center"></th>
                                <th bgcolor="#EAF4FF" class="text-center">รวมเงิน</th>
                                <th bgcolor="#EAF4FF" class="text-center"><?php echo $total_money;?></th>
                                <td bgcolor="#EAF4FF"></td>
                              </tr>
                            </tbody>
                          </table>
                          <!-- ------------------------------//หน้าร้าน---------------------------- -->

                      <!-- ------------------------------//รถรวม---------------------------- -->
                      <?php for ($i=4; $i <= 18; $i++) { 
                                          $sql_member = "SELECT * FROM member WHERE id_member = $i";
                                          $objq_member = mysqli_query($conn,$sql_member);
                                          $objr_member = mysqli_fetch_array($objq_member);

                                          $check = " SELECT * FROM product INNER JOIN sale_car_history
                                                     ON product.id_product = sale_car_history.id_product WHERE sale_car_history.id_member = $i AND DATE_FORMAT(datetime,'%Y-%m-%d')='$day' AND sale_car_history.status = 'sale' ";
                                          $objq_check = mysqli_query($conn,$check);
                                          $objr_check = mysqli_fetch_array($objq_check);
                                          if(!isset($objr_check['num'])){

                                          }else{
                                        ?>
                      <B>
                        <font size="4">
                          <?php echo $objr_member['name']; ?>
                        </font>
                      </B>
                      <table class="table table-striped ">
                        <tbody>
                        <tr class="info" >
                          <th class="text-center" width="20%">สินค้า_หน่วย</th>
                          <th class="text-center" width="12%">จำนวน</th>
                          <th class="text-center" width="11%">บ/หน่วย</th>
                          <th class="text-center" width="11%">เงินขาย(บ)</th>
                          <th class="text-center" width="30%">รายละเอียด</th>
                          <th class="text-center" width="10%">เวลา</th>
                          <th class="text-center" width="6%">แก้ไข</th>
                        </tr>
                          <?php #endregion
                                  $total_money = 0;
                                        $SQL_product = "SELECT * FROM product INNER JOIN sale_car_history
                                                        ON product.id_product = sale_car_history.id_product 
                                                        WHERE sale_car_history.id_member = $i AND DATE_FORMAT(datetime,'%Y-%m-%d')='$day'";
                                        $objq_product = mysqli_query($conn,$SQL_product);
                                        while($product = $objq_product -> fetch_assoc()){
                                  ?>
                          <tr>
                            <td>
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
                              <a href="edit_sale_car.php?id_sale_history=<?php echo $product['id_sale_history']; ?>"><i class="fa fa-cog"></i></a>
                            </td>
                          </tr>
                          <?php 
                                        $total_money = $total_money + $product['money'];
                                      } 
                                  ?>
                          <tr>
                            <td bgcolor="#EAF4FF"></td>
                            <td bgcolor="#EAF4FF"></td>
                            <th bgcolor="#EAF4FF" class="text-center">รวมเงิน</th>
                            <th bgcolor="#EAF4FF" class="text-center"><?php echo $total_money;?></th>
                            <td bgcolor="#EAF4FF"></td>
                            <td bgcolor="#EAF4FF"></td>
                          </tr>
                        </tbody>
                      </table>
                      <?php
                                          } 
                                        }
                                  ?>
                      <!-- ------------------------------/รวมรถ------------------------------------- -->

                      <!-- --------------------------------ยอดแถมสินค้า-------------------------------- -->
                      <div class="box-header with-border">
                        <font size="4">
                          <B> ยอดแถม
                        </font>
                        </B>
                      </div>
                      <!-- /.box-header -->
                      <table class="table table-striped ">
                        <tbody>
                          <tr class="info" >
                            <th class="text-center" width="40%">สินค้า_หน่วย
                            </th>
                            <th class="text-center" width="20%">จำนวน
                            </th>
                          </tr>
                          <?php #endregion
                                          $sum_monny = 0;
                                          $sql_history = "SELECT * FROM product";
                                          $objq_history = mysqli_query($conn,$sql_history);
                                          while($history = $objq_history ->fetch_assoc()){
                                            $id_product = $history['id_product'];
                                            $total_sale = " SELECT SUM(sale_car_history.num),SUM(sale_car_history.money) FROM sale_car_history 
                                                            INNER JOIN product ON sale_car_history.id_product=product.id_product
                                                            WHERE product.id_product = '$id_product' AND DATE_FORMAT(sale_car_history.datetime,'%Y-%m-%d')='$day' AND sale_car_history.status= 'free'";
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
                            <td>
                              <?php echo $objr_NameProduct['name_product'].'_'.$objr_NameProduct['unit']; ?>
                            </td>
                            <td class="text-center">
                              <?php echo $num_product; ?>
                              <?php echo $objr_NameProduct['unit']; ?>
                            </td>
                          </tr>
                          <?php 
                                              }
                                            } 
                                          ?>
                        </tbody>
                      </table>
                      <!-- --------------------------------//ยอดแถมสินค้า-------------------------------- -->
                    </div>
                  </div>
                </div>
                <div class="box-footer" align="center">
                  <a href="../pdf_file/admin_saleday_history.php?day=<?php echo $day;?>" class="btn btn-success"
                    target="_blank"><i class="fa fa-print"> พิมพ์ </i></a>
                </div>
              </div>
            </div>
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