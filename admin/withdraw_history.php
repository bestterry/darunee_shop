<?php
  require "../config_database/config.php";
  require "../session.php";
  require "menu/date.php";

  $strDate = date('d-m-Y'); 
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
                <li class="active"><a href="#checkday" data-toggle="tab">ยอดเบิกรายวัน</a></li>
                <li><a href="#bytime" data-toggle="tab">ตามช่วงเวลา</a></li>
                <li><a href="#change" data-toggle="tab">โอนระหว่างรถ</a></li>
                
                <div align="right">
                  <a href="admin.php" class="btn button2"><< เมนูหลัก</a>
                </div>
              </ul>
              <div class="tab-content">

                <!-- tab-pane -->
                <div class="active tab-pane" id="checkday">
                  <div class="box box-default">
                    <div class="text-center box-header with-border">
                      <B><font size="5">  ยอดเบิกสินค้า(รายวัน) </font></B> 
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="row">
                        
                          <form action="checkday_withdraw_history.php" method="post">
                            <div class="row">
                              <div class="container">
                                <div class="col-md-12">
                                  <div class="box-body">
                                    <div class="form-group">
                                      <label class="col-sm-4 control-label text-right"></label>
                                      <div class="col-sm-4">
                                        <input class="form-control" type="date" name="day" id="datePicker">
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
                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane" id="bytime">
                  <div class="box box-default">
                    <div class="text-center box-header with-border">
                      <B><font size="5"> ยอดเบิกสินค้า (ตามช่วงเวลา) </font></B> 
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="row">
                        <form action="withdraw_history_bytime.php" method="post">
                          <div class="box-body">
                            <div class="row">
                              <div class="container">
                                <div class="col-md-6">
                                  <div class="form-group text-center">
                                    <label> <font size="5">ตั้งเเต่</font></label>
                                    <input type="date"  class="form-control"  name="aday">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group text-center">
                                    <label><font size="5">ถึง</font></label></label>
                                    <input type="date" class="form-control" name="bday">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="box-footer text-center">
                            <button type="submit" class="btn btn-success "><i class="fa fa-check-square-o"></i> ตกลง </button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- tab-pane -->
                <div class="tab-pane" id="change">
                  <div class="box box-default">
                    <div class="box-header with-border">
                    <div class="box-header with-border">
                      <p align="center">
                        <font size="5"><B>โอนสินค้าระหว่างรถ<font color="red"> <?php echo DateThai($strDate); ?></font></B> </font>
                      </p>
                    </div>
                    <table class="table table-striped">
                      <tbody>
                        <tr class="info">
                          <th class="text-center" width="5%">ที่</th>
                          <th class="text-center" width="30%">สินค้า_หน่วย</th>
                          <th class="text-center" width="12%">จำนวน</th>
                          <th class="text-center" width="12%">ผู้ส่ง</th>
                          <th class="text-center" width="12%">ผู้รับ</th>
                          <th class="text-center" width="25%">หมายเหตุ</th>
                        </tr>
                        <?php #endregion
                        $i = 1;
                        $date = "SELECT * FROM change_bwt_car
                            INNER JOIN product ON change_bwt_car.id_product = product.id_product 
                            WHERE DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate'";
                        $objq = mysqli_query($conn, $date);
                        while ($value = $objq->fetch_assoc()) {
                          $name1 = "SELECT name FROM member WHERE id_member = $value[id_member_send]";
                          $objq_name1 = mysqli_query($conn,$name1);
                          $objr_name1 = mysqli_fetch_array($objq_name1);
                          $name2 = "SELECT name FROM member WHERE id_member = $value[id_member_receive]";
                          $objq_name2 = mysqli_query($conn,$name2);
                          $objr_name2 = mysqli_fetch_array($objq_name2);
                          ?>
                          <tr>
                            <td class="text-center">
                              <?php echo $i; ?>
                            </td>
                            <td class="text-center">
                              <?php echo $value['name_product'] . '_' . $value['unit']; ?>
                            </td>
                            <td class="text-center">
                              <?php echo $value['num']; ?>
                            </td>
                            <td class="text-center">
                              <?php echo $objr_name1['name']; ?>
                            </td>
                            <td class="text-center">
                              <?php echo $objr_name2['name']; ?>
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