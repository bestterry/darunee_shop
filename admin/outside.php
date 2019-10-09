<?php 
  require "../config_database/config.php";
  require "../session.php"; 
  require "menu/date.php";
    $list_product = "SELECT * FROM product";
    $query_product = mysqli_query($conn,$list_product);
    $query_product2 = mysqli_query($conn,$list_product);

    $sql_outside = "SELECT * FROM outside";
    $objq_outside = mysqli_query($conn, $sql_outside);
    $objq_outside3 = mysqli_query($conn, $sql_outside);
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
                <li class="active"><a href="#saleoutside" data-toggle="tab">เบิกนอกเขต</a></li>
                <li><a href="#timeline" data-toggle="tab">ประวัติเบิก</a></li>
                <li><a href="#checkday" data-toggle="tab">ข้อมูลชำระเงิน</a></li>
                <li><a href="#checkoutside" data-toggle="tab">ยอดสั่งรายเดือน</a></li>
                <li><a href="#totalsale" data-toggle="tab">ยอดหนี้</a></li>
                <div align="right">
                  <a href="admin.php" class="btn btn-success"><< เมนูหลัก</a>
                </div>
              </ul>
              <div class="tab-content">
               <!-- /.tab-pane -->
               <div class="tab-pane active" id="saleoutside">
                  <?php 
                          $list_producto = "SELECT * FROM product WHERE NOT id_product = 2 AND NOT id_product = 4 AND NOT id_product = 6 AND NOT id_product = 10
                                          AND NOT id_product = 33 AND NOT id_product = 35 AND NOT id_product = 12";
                          $query_product3 = mysqli_query($conn,$list_producto);
                  ?>
                  <!-- ------------------------------เบิกนอกเขต---------------------------- -->
                 <form action="outside_price.php" method="post" >
                  <div class="modal-content">
                   
                    <div class="modal-body col-md-12 table-responsive mailbox-messages">
                      <div class="table-responsive">
                       <div class="col-md-6">
                        <table class="table table-striped">
                          <tbody>
                            <tr>
                              <th bgcolor="#99CCFF" class="text-center" width="15%">เลือก</th>
                              <th bgcolor="#99CCFF" class="text-center" width="70%">สินค้า</th>
                              <th bgcolor="#99CCFF" class="text-center" width="15%">หน่วย</th>
                              <?php
                                while ($product = $query_product3->fetch_assoc()) {
                              ?>
                              <tr>
                                <td class="text-center">
                                  <input type="checkbox" name="id_product[]" value="<?php echo $product['id_product']; ?>">
                                </td>
                                <td><?php echo $product['full_name']; ?></td>
                                <td class="text-center"><?php echo $product['unit']; ?></td>
                              <?php } ?>
                            </tr>
                          </tbody>
                         </table>
                        </div>

                        <div class="col-md-6">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th bgcolor="#99CCFF" class="text-center" width="50%">ผู้เบิก (เขตการขาย)</th>
                                <th bgcolor="#99CCFF" class="text-center" width="50%">เบิกจาก (ทีมงาน)</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                  <td class="text-center" width="15%">
                                    <select name="id_outside" class="form-control text-center select2" style="width: 100%;">
                                      <option value="">------กรุณาเลือกเขตการขาย------</option>
                                      <?php #endregion
                                          while ($outside = $objq_outside->fetch_assoc()) {
                                            $id_outside = $outside['id_outside'];
                                      ?>
                                      <option value="<?php echo $id_outside; ?>"><?php echo $outside['name'].'  '.$outside['province']; ?> </option>
                                      <?php   
                                          }
                                      ?>
                                    </select>
                                  </td>
                                  <td>
                                    <select name="id_zone" class="form-control text-center select2" style="width: 100%;">
                                      <option value="">------กรุณาเลือกสต๊อก------</option>
                                      <?php #endregion
                                          $list_stock = "SELECT * FROM zone WHERE NOT id_zone = 8 AND NOT id_zone = 9";
                                          $query_stock = mysqli_query($conn,$list_stock);
                                          while ($value = $query_stock->fetch_assoc()) {
                                            $id_zone = $value['id_zone'];
                                      ?>
                                      <option value="<?php echo $id_zone; ?>"><?php echo $value['name_zone']; ?> </option>
                                      <?php   
                                          }
                                      ?>
                                    </select>
                                  </td>
                                </tr>
                            </tbody>
                          </table>
                        </div>
                       </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-success pull-right">ถัดไป >></button>
                    </div>
                  </div>
                </form>
                </div>
                <!-- /.tab-pane -->

                <!-- /.tab-pane -->
                <div class="tab-pane" id="timeline">
                  <div class="form-group">
                    <div class="box box-default">
                      <!-- /.box-header -->
                      <div class="modal-body col-md-12 table-responsive mailbox-messages">
                        <div class="row">
                          <div class="container">

                            <!-- ------------------------------ประวัติเบิกนอกเขตประวัติเบิกนอกเขต---------------------------- -->

                            <div class="box-header text-center with-border">
                              <font size="5"> <B> ประวัติเบิก (นอกเขต) </B></font>
                            </div>
                           
                            <table id="example1" class="table table-striped table-bordered">
                              <thead>
                                <tr class="info" >
                                <th class="text-center" width="5%">ID</th>
                                  <th class="text-center" width="20%">สินค้า_หน่วย</th>
                                  <th class="text-center" width="10%">จำนวน</th>
                                  <th class="text-center" width="10%">เป็นเงิน</th>
                                  <th class="text-center" width="25%">ผู้เบิก</th>
                                  <th class="text-center" width="18%">เบิกจาก</th>
                                  <th class="text-center" width="13%">วันที่เบิก</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php 
                                $sql_outside = "SELECT * FROM outside_buy_htr 
                                                INNER JOIN product ON outside_buy_htr.id_product = product.id_product
                                                INNER JOIN outside ON outside_buy_htr.id_outside = outside.id_outside
                                                INNER JOIN zone ON outside_buy_htr.id_zone = zone.id_zone
                                                ORDER BY outside_buy_htr.id_outside_buy DESC";
                                $objq_outside = mysqli_query($conn,$sql_outside);
                                while($value1 = $objq_outside->fetch_assoc()){
                              ?>
                                <tr>
                                  <td class="text-center"><?php echo $value1['id_outside_buy'];?></td>
                                  <td class="text-center"><?php echo $value1['name_product'].'_'.$value1['unit'];?></td>
                                  <td class="text-center"><?php echo $value1['num_pd'];?></td>
                                  <td class="text-center"><?php echo $value1['num_pd']*$value1['price_pd'];?></td>
                                  <td class="text-center"><?php echo $value1['nick_name'];?></td>
                                  <td class="text-center"><?php echo $value1['name_zone'];?></td>
                                  <td class="text-center"><?php echo Datethai($value1['date_buy']);?></td>
                                </tr>
                               <?php 
                                 }
                               ?> 
                              </tbody>
                            </table>

                            <!-- ------------------------------//ประวัติเบิกนอกเขตประวัติเบิกนอกเขต---------------------------- -->
                          </div>
                        </div>
                      </div>
                      <div class="box-footer" align="center">
                        <!-- <i href="../pdf_file/admin_sale_history.php" class="btn btn-success"><i class="fa fa-print"> พิมพ์ </i></a> -->
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
                    <div class="box-body">
                      <div class="row">
                        <div class="container">
                          <form action="outside_list.php" method="get">
                            <div class="col-md-5">
                              <div class="box-body">
                                <strong><i class="fa fa-file-text-o margin-r-5"></i> การใช้</strong>
                                <p> -กรุณาเลือกเขตการขาย เพื่อตรวจสอบข้อมูลการสั่งของและชำระเงิน</p>
                              </div>
                            </div>
                            <div class="col-md-5">
                              <div class="form-group">
                                <select name="id_outside" class="form-control text-center select2" style="width: 100%;">
                                  <option value="">------กรุณาเลือกเขตการขาย------</option>
                                  <?php #endregion
                                      while ($outside = $objq_outside3->fetch_assoc()) {
                                        $id_outside = $outside['id_outside'];
                                  ?>
                                  <option value="<?php echo $id_outside; ?>"><?php echo $outside['name'].'  '.$outside['province']; ?> </option>
                                  <?php   
                                      }
                                  ?>
                                </select>
                              </div>
                              <div class="box-footer">
                                <button type="submit" class="btn btn-success pull-left"><i class="fa fa-check-square-o"></i> ตกลง</button>
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
                 <div class="tab-pane" id="checkoutside">
                  <div class="box box-default">
                    <div class="box-header with-border">

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="row">
                        <div class="container">
                          <form action="outside_list2.php" method="post">
                            <div class="col-md-4">
                              <div class="box-body">
                                <strong><i class="fa fa-file-text-o margin-r-5"></i> การใช้</strong>
                                <p> -กรุณาเลือกเดือน และ พ.ศ. เพื่อตรวจข้อมูลการสั่งสินค้านอกเขตแต่ล่ะเดือน </p>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <select name="month" class="form-control text-center select2" style="width: 100%;">
                                  <option value="">------กรุณาเลือกเดือน------</option>
                                  <option value="01">มกราคม</option>
                                  <option value="02">กุมภาพันธ์</option>
                                  <option value="03">มีนาคม</option>
                                  <option value="04">เมษายน</option>
                                  <option value="05">พฤษภาคม</option>
                                  <option value="06">มิถุนายน</option>
                                  <option value="07">กรกฎาคม</option>
                                  <option value="08">สิงหาคม</option>
                                  <option value="09">กันยายน</option>
                                  <option value="10">ตุลาคม</option>
                                  <option value="11">พฤศจิกายน</option>
                                  <option value="12">ธันวาคม</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <select name="year" class="form-control text-center select2" style="width: 100%;">
                                  <option value="">------กรุณาเลือก พ.ศ.------</option>
                                  <option value="2019">2562</option>
                                  <option value="2020">2563</option>
                                  <option value="2021">2564</option>
                                  <option value="2022">2565</option>
                                  <option value="2023">2566</option>
                                </select>
                              </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-success pull-left"><i class="fa fa-check-square-o"></i> ตกลง</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.tab-pane -->

                <!-- /.tab-pane -->
                <div class="tab-pane" id="totalsale">
                  <div class="form-group">
                    <div class="box box-default">
                      <!-- /.box-header -->
                      <div class="modal-body col-md-12 table-responsive mailbox-messages">
                        <div class="row">
                          <div class="container">
                            <!-- ------------------------------ยอดหนี้ค้างชำระนอกเขต---------------------------- -->
                            <div class="box-header text-center with-border">
                              <font size="5"> <B> ยอดหนี้ </B></font>
                            </div>
                           
                            <table class="table table-striped table-bordered">
                              <thead>
                                <tr class="info" >
                                  <th class="text-center" width="60%">เขต</th>
                                  <th class="text-center" width="40%">จำนวนเงิน</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php 
                              $total_balance = 0;
                                $sql_outside2 = "SELECT * FROM outside";
                                $objq_outside2 = mysqli_query($conn,$sql_outside2);
                                while($value2 = $objq_outside2->fetch_assoc()){
                                  $id_outside2 = $value2['id_outside'];
                                  $sql_maxid = "SELECT MAX(id_outside_buy) FROM outside_buy_htr WHERE id_outside = $id_outside2";
                                  $objq_maxid = mysqli_query($conn,$sql_maxid);
                                  $objr_maxid = mysqli_fetch_array($objq_maxid);
                                  $id_outside_buy = $objr_maxid['MAX(id_outside_buy)'];

                                  $sql_balance = "SELECT balance FROM outside_buy_htr WHERE id_outside_buy = $id_outside_buy";
                                  $objq_balance = mysqli_query($conn,$sql_balance);
                                  if (empty($objq_balance)) {
                                    $balance = '0';
                                  }else {
                                    $objr_balance = mysqli_fetch_array($objq_balance);
                                    $balance = $objr_balance['balance'];
                                  }
                              ?>
                                <tr>
                                  <td class="text-center"><?php echo $value2['name'].' '.$value2['province'];?></td>
                                  <td class="text-center"><?php echo $balance; ?> </td>
                                </tr>
                               <?php 
                                 $total_balance = $total_balance + $balance;
                                }
                               ?> 
                               <tr  class="info">
                               <th class="text-right">เงินรวม</th>
                               <th class="text-center"><?php echo $total_balance; ?></th>
                               </tr>
                              </tbody>
                            </table>
                            <!-- ------------------------------//ยอดหนี้ค้างชำระนอกเขต---------------------------- -->
                          </div>
                        </div>
                      </div>
                      <div class="box-footer" align="center">
                        <!-- <i href="../pdf_file/admin_sale_history.php" class="btn btn-success"><i class="fa fa-print"> พิมพ์ </i></a> -->
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