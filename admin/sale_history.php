<?php 

  require "../config_database/config.php";
  require "../session.php"; 
  require "menu/date.php";

  $member = "SELECT * FROM member 
             WHERE status = 'employee' AND NOT id_member = 28 AND NOT id_member = 32";
  $objq_member5 = mysqli_query($conn,$member);

  $list_product = "SELECT * FROM product";
  $query_product = mysqli_query($conn,$list_product);
  $query_product2 = mysqli_query($conn,$list_product);
  $query_product3 = mysqli_query($conn,$list_product);
  $objq_profit = mysqli_query($conn,$list_product);
  $day = date('Y-m-d');

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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?=Sarabun">
  
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
                <li class="active"><a href="#today" data-toggle="tab">วันนี้</a></li>
                <li><a href="#lastday" data-toggle="tab">รายวัน</a></li>

                <div align="right">
                  <a href="admin.php" class="btn button2"> << เมนูหลัก </a>
                </div>
              </ul>
              <div class="tab-content">

                <!-- tab-pane -->
                <div class="active tab-pane" id="today">
                  <div class="box box-default">
                    <div class="box-header text-center with-border">
                        <font size="5" color="blue">
                          <B> รายการขาย (วันนี้) </B>
                        </font>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="col-md-12">
                        <div class="row">
                          <!-- ------------------------------รวมเงินขาย---------------------------- -->
                            <table class="table">
                              <thead>
                                <tr >
                                  <th class="text-right" width="50%"> <font color="red">หน่วยขาย &nbsp;:</font></th>
                                  <th class="text-left" width="50%"><font color="red">เงินขาย</font></th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                  $sql_wp = "SELECT SUM(money) FROM price_history WHERE DATE_FORMAT(datetime,'%Y-%m-%d')='$day'";
                                  $objq_wp = mysqli_query($conn,$sql_wp);
                                  $objr_wp = mysqli_fetch_array($objq_wp);
                                  $sum_wp = $objr_wp['SUM(money)'];

                                ?>
                                <tr>
                                  <td class="text-right" >หน้าร้าน &nbsp;: </td>
                                  <td class="text-left" ><?php echo $sum_wp;?></td>
                                </tr>
                                <?php 
                                  $total_money = 0;
                                  $total_numsoft1 = 0;
                                  $total_numsoft2 = 0;
                                    $sql_idmember = "SELECT * FROM member 
                                                    WHERE status = 'employee' AND status_car = 1";
                                    $objq_member = mysqli_query($conn,$sql_idmember);
                                    while($value = $objq_member->fetch_assoc()){
                                      $id_member = $value['id_member'];
                                      $sql_sum_money = "SELECT SUM(money),name FROM sale_car_history INNER JOIN member ON sale_car_history.id_member = member.id_member 
                                                  WHERE sale_car_history.id_member = $id_member AND DATE_FORMAT(datetime,'%Y-%m-%d')='$day'";
                                      $objq_sum_money = mysqli_query($conn,$sql_sum_money);
                                      $objr_sum_money = mysqli_fetch_array($objq_sum_money);

                                      $name = $objr_sum_money['name'];
                                      $sum_money = $objr_sum_money['SUM(money)'];
                                      if (isset($sum_money) && !$sum_money == 0) {
                                ?> 
                                <tr>
                                  <td class="text-right"><?php echo $name;?>&nbsp; : </td>
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
                                  <th class=" text-right"><font color="red">เงินรวม &nbsp;:</font></th>
                                  <th class=" text-left"><font color="red"><?php echo $total_money+$sum_wp;?></font></th>
                              </tbody>
                            </table>
                            <br>
                          <!-- ------------------------------//รวมเงินขาย---------------------------- -->
                          <!-- ------------------------------หน้าร้าน---------------------------- -->
                            <div class="text-center">
                              <B>
                                <font size="5" color="blue">
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
                                  <th class="text-center" width="8%"><font color="red">เงินขาย</font></th>
                                  <th class="text-center" width="10%"><font color="red">ร้าน</font></th>
                                  <th class="text-center" width="30%"><font color="red">รายละเอียด</font></th>
                                  <th class="text-center" width="8%"><font color="red">เวลา</font></th>
                                  <th class="text-center" width="5%"><font color="red">แก้</font></th>
                                </tr>
                              </thead>
                              <tbody>
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
                                  <td class="text-center"><?php echo $value['name_product'].'_'.$value['unit']; ?></td>
                                  <td class="text-center"><?php echo $value['num'];?> </td>
                                  <td class="text-center"><?php echo $value['price']; ?></td>
                                  <td class="text-center"><?php echo $value['money']; ?></td>
                                  <td class="text-center"><?php echo $value['name_zone']; ?></td>
                                  <td class="text-center"><?php echo $value['note']; ?></td>
                                  <td class="text-center"><?php echo DateThai2($value['datetime']); ?> </td>
                                  <td class="text-center" ><a href="edit_sale_shop.php?id_price_history=<?php echo $value['id_price_history']; ?>" >>></a> </td>
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
                            <?php  
                              $sql_member = "SELECT * FROM member";
                              $objq_member = mysqli_query($conn,$sql_member);
                              while($value_member = $objq_member -> fetch_assoc()){
                                $id_member = $value_member['id_member'];
                              $check = " SELECT * FROM product INNER JOIN sale_car_history
                                        ON product.id_product = sale_car_history.id_product 
                                        WHERE sale_car_history.id_member = $id_member AND DATE_FORMAT(datetime,'%Y-%m-%d')='$day' ";
                              $objq_check = mysqli_query($conn,$check);
                              $objr_check = mysqli_fetch_array($objq_check);
                              if(!isset($objr_check['num'])){

                              }else{
                            ?>
                            <div class="text-center">
                              <B>
                                <font size="5" color="blue">
                                  <?php echo $value_member['name']; ?>
                                </font>
                              </B>
                            </div>
                            <table class="table">
                              <thead>
                                <tr>
                                  <th class="text-center" width="17%"><font color="red">สินค้า_หน่วย</font></th>
                                  <th class="text-center" width="8%"><font color="red">จำนวน</font></th>
                                  <th class="text-center" width="10%"><font color="red">บ/หน่วย</font></th>
                                  <th class="text-center" width="10%"><font color="red">เงินขาย</font></th>
                                  <th class="text-center" width="18%"><font color="red">ลูกค้า</font></th>
                                  <th class="text-center" width="21%"><font color="red">รายละเอียด</font></th>
                                  <th class="text-center" width="8%"><font color="red">เวลา</font></th>
                                  <th class="text-center" width="8%"><font color="red">#</font></th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php #endregion
                                $total_money = 0;
                                      $SQL_product = "SELECT * FROM product INNER JOIN sale_car_history
                                                      ON product.id_product = sale_car_history.id_product 
                                                      WHERE sale_car_history.id_member = $id_member AND DATE_FORMAT(datetime,'%Y-%m-%d')='$day' ";
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
                                    <?php echo $product['customer']; ?>
                                  </td>
                                  <td class="text-center">
                                    <?php echo $product['note']; ?>
                                  </td>
                                  <td class="text-center">
                                    <?php echo DateThai2($product['datetime']); ?>
                                  </td>
                                  <td class="text-center" >
                                    <a href="edit_sale_car.php?id_sale_history=<?php echo $product['id_sale_history']; ?>" > >> </a>
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
                  </div>
                </div>
                <!-- /.tab-pane -->

                <!-- tab-pane -->
                <div class="tab-pane" id="lastday">
                  <div class="box box-default">
                  <div class="box-header text-center with-border">
                      <font size="5">
                        <B> รายการขาย (รายวัน) </B>
                      </font>
                    </div>
                    <!-- /.box-header -->
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