<?php

require "../config_database/config.php";
require "../session.php";
require "menu/date.php";

?>

<!DOCTYPE html>
<html>

<head>
  <?php require('../font/font_style.php'); ?>
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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class=" hold-transition skin-blue layout-top-nav ">
  <div class="wrapper">
    <header class="main-header">
      <?php require('menu/header_logout.php'); ?>
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
                <li><a href="#timeline" data-toggle="tab">ยอดเบิกรายวัน</a></li>
                <li><a href="#checkday" data-toggle="tab">ตรวจสอบยอดเบิกรายวัน</a></li>
              </ul>
              <div class="tab-content">
                <!-- /.tab-pane -->
                <div class="active tab-pane" id="timeline">
                  <div class="form-group">
                    <div class="box box-default">
                      <!-- /.box-header -->
                      <div class="box-body">
                        <div class="row">
                          <div class="container">
                            <?php
                            $list_product = "SELECT * FROM product";
                            $query_product = mysqli_query($conn, $list_product);
                            $query_product2 = mysqli_query($conn, $list_product);
                            
                            ?>
                            <!-- ------------------------------ยอดขายรวม---------------------------- -->
                            <div class="box-header with-border">
                              <p align="center">
                                <font size="5">
                                  <B>ประวัติรับเข้าสินค้า 
                                    <font color="red">
                                  <?php 
                                        $strDate = date('d-m-Y');
                                        echo DateThai($strDate); 
                                  ?>
                                    </font>
                                 </B> 
                                </font>
                              </p>
                            </div>
                            <table class="table table-bordered">
                              <tbody>
                                <tr bgcolor="#99CCFF">
                                  <th class="text-center" width="5%">ลำดับ</th>
                                  <th class="text-center" width="30%">สินค้า_หน่วย</th>
                                  <th class="text-center" width="10%">จำนวน</th>
                                  <th class="text-center" width="13%">ผู้ส่ง</th>
                                  <th class="text-center" width="13%">รับเข้า</th>
                                  <th class="text-center" width="30%">หมายเหตุ</th>
                                </tr>
                                <?php #endregion
                                $i = 1;
                                $date = "SELECT * FROM add_history 
                                    INNER JOIN product ON add_history.id_product = product.id_product 
                                    INNER JOIN member ON add_history.id_member = member.id_member
                                    INNER JOIN zone ON add_history.id_zone = zone.id_zone
                                    WHERE DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate'";
                                $objq = mysqli_query($conn, $date);
                                while ($value = $objq->fetch_assoc()) {
                                  ?>
                                  <tr>
                                    <td class="text-center">
                                      <?php echo $i; ?>
                                    </td>
                                    <td>
                                      <?php echo $value['name_product'] . '_' . $value['unit']; ?>
                                    </td>
                                    <td class="text-center">
                                      <?php echo $value['num_add']; ?>
                                    </td>
                                    <td class="text-center">
                                      <?php echo $value['name']; ?>
                                    </td>
                                    <td class="text-center">
                                      <?php echo $value['name_zone']; ?>
                                    </td>
                                    <td class="text-center">
                                      <?php echo $value['note']; ?>
                                    </td>
                                  </tr>
                                  <?php
                                  $i++;
                                }
                                ?>
                              </tbody>
                            </table>
                            <!-- ------------------------------//ยอดขายรวม---------------------------- -->


                            <!-- ------------------------------ยอดขายรวม---------------------------- -->
                            <div class="box-header with-border">
                              <font size="4"><B>ยอดรับเข้าสินค้า</B></font> 
                            </div>
                            <table class="table table-bordered">
                              <tbody>
                                <tr bgcolor="#99CCFF">
                                  <th class="text-center" width="40%">สินค้า_หน่วย</th>
                                  <th class="text-center" width="20%">จำนวน</th>
                                </tr>
                                <?php #endregion
                                $sql_history = "SELECT * FROM product";
                                $objq_history = mysqli_query($conn, $sql_history);
                                while ($history = $objq_history->fetch_assoc()) {
                                  $id_product = $history['id_product'];
                                  $total_sale = "SELECT SUM(add_history.num_add) FROM add_history 
                                              INNER JOIN product ON add_history.id_product=product.id_product
                                              WHERE add_history.id_product = '$id_product' AND DATE_FORMAT(add_history.datetime,'%d-%m-%Y')='$strDate'";
                                  $objq_sale = mysqli_query($conn, $total_sale);
                                  $objr_sale = mysqli_fetch_array($objq_sale);
                                  $num_product = $objr_sale['SUM(add_history.num_add)'];
                                  if (isset($num_product)) {
                                    ?>
                                    <tr>
                                      <td>
                                        <?php echo $history['name_product'] . '_' . $history['unit']; ?>
                                      </td>
                                      <td class="text-center">
                                        <?php echo $num_product; ?>
                                      </td>
                                    </tr>
                                  <?php }
                              } ?>
                              </tbody>
                            </table>
                            <!-- ------------------------------//ยอดขายรวม---------------------------- -->

                          </div>
                        </div>
                      </div>
                      <div class="box-footer" align="center">
                        <a href="../pdf_file/add_history_admin.php" class="btn btn-success"><i class="fa fa-print">
                            พิมพ์ </i></a>
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
                          <form action="checkday_add_history.php" method="post">
                            <div class="col-md-5">
                              <div class="box-body">
                                <strong><i class="fa fa-file-text-o margin-r-5"></i> การใช้</strong>
                                <p> -กรุณาเลือกวันที่ เพื่อตรวจสอบข้อมูลการเบิกย้อนหลัง</p>
                              </div>
                            </div>
                            <div class="col-md-5">
                              <div class="form-group">
                                <label>วันที่ : </label>
                                <input type="date" name="day">
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
                <div class="tab-pane" id="settings">
                  <div class="box box-default">
                    <div class="box-header with-border">

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="row">
                        <div class="container">
                          <form action="check_sale_history.php" method="post">
                            <div class="col-md-5">
                              <div class="box-body">
                                <strong><i class="fa fa-file-text-o margin-r-5"></i> การใช้</strong>
                                <p> -กรุณาเลือกวันที่ เพื่อตรวจสอบข้อมูลสถิติการขายย้อนหลัง</p>
                              </div>
                            </div>
                            <div class="col-md-5">
                              <div class="form-group">
                                <label>ตั้งเเต่ : </label>
                                <input type="date" name="aday">
                              </div>
                              <div class="form-group">
                                <label>ถึง &nbsp;&nbsp;&nbsp;: </label>
                                <input type="date" name="bday">
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