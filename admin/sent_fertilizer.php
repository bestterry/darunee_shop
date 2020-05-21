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

      <div class="content-wrapper">

        <section class="content"> 
          <div class="row">
            <!-- form start -->
            <div class="col-md-12">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#checkday" data-toggle="tab">ค่าส่งปุ๋ยรายวัน</a></li>
                  <li><a href="#bytime" data-toggle="tab">ค่าส่งปุ๋ยตามช่วงเวลา</a></li>
                </ul>
                <div class="tab-content">

                  <div class="active tab-pane" id="checkday">
                    <div class="box box-default">
                    <div class="box-header with-border">
                      <div class="row">
                        <div class="col-md-12 col-12">
                            <div class="col-md-3 col-sm-3 col-3">
                              <div align="left">
                                <a href="admin.php" class="btn button2"><< เมนูหลัก</a>
                              </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-6">
                              <p align="center">
                                <font size="5">
                                  <B>ค่าส่งปุ๋ยรายวัน</B>
                                </font>
                              </p>
                            </div>

                            <div class="col-md-3 col-sm-3 col-3">
                              <div align="right">
                              
                              </div>
                            </div>
                        
                        </div>
                      </div>
                    </div>
                      <!-- /.box-header -->
                      <form action="sent_fertilizer_list.php" method="get">
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

                  <div class="tab-pane" id="bytime">
                    <div class="box box-default">
                      <div class="text-center box-header with-border">
                        <B><font size="5"> ค่าส่งปุ๋ยตามช่วงเวลา </font></B> 
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <div class="col-12">
                          <div class="row">
                            <form action="../pdf_file/sent_fertilizer2.php" method="post">
                              <div class="box-body">
                                <div class="row">
                                  <div class="container">
                                    <div class="col-md-6 col-6 col-lg-6 col-xs-6">
                                      <div class="form-group text-center">
                                        <label> <font size="5">ตั้งเเต่</font></label>
                                        <input type="date"  class="form-control"  name="aday">
                                      </div>
                                    </div>
                                    <div class="col-md-6 col-6 col-lg-6 col-xs-6">
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