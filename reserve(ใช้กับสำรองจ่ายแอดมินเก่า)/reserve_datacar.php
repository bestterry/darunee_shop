<?php
  require "../config_database/config.php";
  require "../session.php";
  require "menu/date.php";

  $sql_reserve = "SELECT money FROM reserve_money WHERE id_member = 33";
  $objq_reserve = mysqli_query($conn,$sql_reserve);
  $objr_reserve = mysqli_fetch_array($objq_reserve);
  $reserve_money = $objr_reserve['money'];

  $sql_member = "SELECT id_member,name FROM member WHERE status_car = 1";
  $objq_member = mysqli_query($conn,$sql_member);
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
        .topnav {
          background-color: while;
          overflow: hidden;
        }

        /* Style the links inside the navigation bar */
        .topnav a {
          float: left;
          color: black;
          text-align: center;
          padding: 14px 16px;
          text-decoration: none;
          font-size: 15px;
        }

        /* Change the color of links on hover */
        .topnav a:hover {
          background-color: #ddd;
          color: black;
        }

        /* Add a color to the active/current link */
        .topnav a.active {
          background-color: #3c8dbc;
          color: white;
        }
    </style>
  </head>

  <body class=" hold-transition skin-blue layout-top-nav ">

    <div class="wrapper">
      <header class="main-header">
        <?php require('menu/header_logout.php'); ?>
      </header>

      <div class="content-wrapper">
        <section class="content">
          <div class="box box-primary">
            <div class="row">
              <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8">
                <div class="topnav">
                  <a href="reserve_office.php"> โอนจ่ายสนง </a>
                  <a class="active" href="reserve_datacar.php"></i> หน่วยรถ </a>
                  <a href="reserve_carvalue.php"> ใช้จ่ายหน่วยรถ </a>
                  <a href="car_rental.php"> ปฏิบัติงานและค่าเช่ารถ </a>
                  <a href="reserve_money.php"> รับเงิน </a>
                </div>
              </div>
              <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4">
                  <a class="btn button2 pull-right" href="../admin/admin.php"> << เมนูหลัก </a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-xl-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <div class="col-12">
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4"></div>
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                      <div class="text-center">
                        <font size="5">
                          <B align="center"> ข้อมูลสำรองจ่ายหน่วยรถ </B>
                        </font>
                      </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4 text-right"></div>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <div class="mailbox-read-message">
                    <div class="col-sm-12 text-left">
                      <font size="3" color="red">
                        <B> เงินคงเหลือ : <?php echo $reserve_money;?> </B>
                      </font>
                    </div>
                    <br>
                    <br>
                    <div class="col-12">
                      <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                        <table id="example1" class="table">
                          <thead>
                            <tr>
                              <th class="text-center" width="33%">หน่วยรถ</th>
                              <th class="text-center" width="33%">สรจ.คงเหลือ</th>
                              <th class="text-center" width="33%">ข้อมูลใช้เงิน</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php 
                          $mnoey = 0;
                            while($value = $objq_member -> fetch_assoc()){
                              $id_member = $value['id_member'];
                              $sql_reserve = "SELECT money FROM reserve_money WHERE id_member = $id_member";
                              $objq_reserve = mysqli_query($conn,$sql_reserve);
                              if ($objq_reserve->num_rows > 0) {
                                $objr_reserve = mysqli_fetch_array($objq_reserve);
                                $money = $objr_reserve['money'];
                              }else {
                                $money = 0;
                              }
                          ?>
                            <tr>
                              <td class="text-center"><?php echo ($value['name']); ?></td> 
                              <td class="text-center"><?php echo $money; ?></td>
                              <td class="text-center"><a href="reserve_datacar2.php?id_member=<?php echo $id_member;?>">>></a></td>
                            </tr>
                          <?php 
                            }
                          ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="box-footer"></div>
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
       $(function () {
          $('#example1').DataTable({
            'paging'      : false,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : false,
            'info'        : true,
            'autoWidth'   : false
            });
       });
    </script>
  </body>

</html>