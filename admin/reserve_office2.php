<?php
  require "../config_database/config.php";
  require "../session.php";
  require "menu/date.php";
  $sql_reserve = "SELECT money FROM reserve_money WHERE id_member = 33";
  $objq_reserve = mysqli_query($conn,$sql_reserve);
  $objr_reserve = mysqli_fetch_array($objq_reserve);
  $reserve_money = $objr_reserve['money'];

  $sql_history = "SELECT * FROM reserve_history INNER JOIN reserve_list ON reserve_history.id_list = reserve_list.id_list
                  WHERE reserve_history.status = 2 ORDER BY reserve_history.id_reserve_history DESC 
                  LIMIT 1000";
  $objq_history = mysqli_query($conn,$sql_history);
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
                  <a href="reserve_money.php"> รับเงินสำรองจ่าย </a>
                  <a class="active" href="reserve_office.php"> โอนเงินจ่าย </a>
                  <a href="reserve_car.php"></i> โอนหน่วยรถ </a>
                  <a href="reserve_datacar.php"></i> ใช้จ่ายหน่วยรถ </a>
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
                          <B align="center"> โอนเงินจ่าย สนง.<font color="red"> </font></B>
                        </font>
                      </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4 text-right">
                      <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-success"> ทำรายการ </a>
                    </div>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <div class="mailbox-read-message">
                    <div class="col-12">
                      <div class="col-sm-12 text-left">
                          <font size="3" color="red">
                            <B> สำรองจ่ายคงเหลือ : <?php echo $reserve_money;?> </B>
                          </font>
                      </div>
                      <br>
                      <br>
                      <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                        <table id="example1" class="table">
                          <thead>
                            <tr>
                              <th class="text-center" width="25%">วันที่</th>
                              <th class="text-center" width="25%">รายการ</th>
                              <th class="text-center" width="25%">จำนวนเงิน</th>
                              <th class="text-center" width="25%">หมายเหตุ</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php 
                            while($value = $objq_history -> fetch_assoc()){
                          ?>
                            <tr>
                              <td class="text-center"><?php echo Datethai($value['date']); ?></td> 
                              <td class="text-center"><?php echo $value['name_list']; ?></td>
                              <td class="text-center"><?php echo $value['money']; ?></td>
                              <td class="text-center"><?php echo $value['note']; ?></td>
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
            </div>
          </div>
        </section>

        <section class="content">
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-xl-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <div class="col-12">
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4"></div>
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                      <div class="text-center">
                        <font size="5">
                          <B align="center"> โอนเงินจ่าย สนง.<font color="red"> </font></B>
                        </font>
                      </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4 text-right"> 
                      <a href="#" data-toggle="modal" data-target="#check_back" class="btn btn-success"> เลือกวันที่ </a>
                    </div>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <div class="mailbox-read-message">
                    <table id="example2" class="table">
                      <thead>
                        <tr>
                          <th class="text-center" width="14%">วันที่</th>
                          <?php
                            $sql_resevelist = "SELECT id_list,name_list FROM reserve_list WHERE status = 2";
                            $objq_reservelist = mysqli_query($conn,$sql_resevelist);
                              while($value_reservename = $objq_reservelist->fetch_assoc()){
                          ?>
                          <th class="text-center" width="14%"><?php echo $value_reservename['name_list'];?></th>
                          <?php 
                              }
                          ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $aday = $_POST['aday'];
                          $bday = $_POST['bday'];
                          while(strtotime($bday) >= strtotime($aday)) { 
                        ?>
                        <tr>
                          <td class="text-center"><?php echo Datethai($bday);?></td> 
                          <?php
                              $objq_reservelist2 = mysqli_query($conn,$sql_resevelist);
                              while($value_reservelist  = $objq_reservelist2->fetch_assoc()){
                                $id_list = $value_reservelist['id_list'];
                                $sql_history = "SELECT SUM(money) FROM reserve_history 
                                                WHERE id_list = $id_list AND DATE_FORMAT(date,'%Y-%m-%d')='$bday'";
                              $objq_history = mysqli_query($conn,$sql_history);
                              while($value_history = $objq_history->fetch_assoc()){
                          ?>
                          <td class="text-center"><?php echo $value_history['SUM(money)'];?></td>
                          <?php 
                              }
                              }
                          ?>
                        </tr>
                        <?php 
                            $bday = date ("Y-m-d", strtotime("-1 day", strtotime($bday)));
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <?php require("../menu/footer.html"); ?>
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
          <form action="algorithm/reserve_office.php" method="post">
            <div class="modal-content">
              <div class="modal-header text-center">
                  <font size="5"><B> โอนเงินจ่าย </B></font>
              </div>
              <div class="modal-body col-md-12 table-responsive mailbox-messages">
                <div class="col-12">
                  <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
                  <div class="col-8 col-sm-8 col-xl-8 col-md-8">
                    <div class="table-responsive mailbox-messages">
                      <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <th class="text-center" width="30%"><font size="3">รายการ</font></th>
                            <th class="text-center" width="70%"> 
                              <select name="id_list"  class="form-control" >
                                <option value="">-- เลือกรายการ --</option>
                                <?php 
                                  $sql_list = "SELECT * FROM reserve_list WHERE status = 2";
                                  $objq_list = mysqli_query($conn,$sql_list);
                                    while($value = $objq_list->fetch_assoc()){ ?>
                                    <option value="<?php echo $value['id_list'];?>"><?php echo $value['name_list'];?></option>
                                <?php } ?>
                              </select>
                            </th>
                          </tr>
                        </tbody>
                      </table> 
                      <br> 
                      <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <th class="text-center" width="30%"><font size="3">จำนวนเงิน</font></th>
                            <th class="text-center" width="70%"> 
                              <input type="number" name="money" class="form-control text-center">
                              <input type="hidden" name="money_befor" value="<?php echo $reserve_money; ?>">
                            </th>
                          </tr>
                        </tbody>
                      </table> 
                      <br> 
                      <table class="table table-bordered ">
                        <tbody>
                          <tr>
                            <th class="text-center" width="30%"><font size="3">หมายเหตุ</font></th>
                            <th class="text-center" width="70%"> 
                              <input type="text" name="note" value='-' class="form-control text-center">
                            </th>
                          </tr>
                        </tbody>
                      </table>
                      <br>
                      <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <th class="text-center" width="30%"><font size="3">วันที่</font></th>
                            <th class="text-center" width="70%"> 
                              <input type="date" name="date" id="datePicker" class="form-control text-center">
                            </th>
                          </tr>
                        </tbody>
                      </table> 
                      <br> 
                    </div>
                  </div>
                  <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
                </div>
              </div>
              <div class="modal-footer text-center">
                <button type="button" class="btn pull-left button2" data-dismiss="modal"><< ย้อนกลับ </button>
                <button type="submit" class="btn btn-success">บันทึก</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="modal fade" id="check_back" role="dialog">
        <div class="modal-dialog modal-lg">
          <form action="reserve_office2.php" method="post">
            <div class="modal-content">
              <div class="modal-header text-center">
                  <font size="5"><B> เลือกวันที่ </B></font>
              </div>
              <div class="modal-body col-md-12 table-responsive mailbox-messages">
                <div class="col-12">
                    <div class="table-responsive mailbox-messages">
                      <div class="col-12">
                        <div class="col-md-6 text-center">
                          <div class="col-sm-2"></div>
                          <div class="col-sm-8">
                              <B><font size="5">ตั้งแต่</font></B>
                          </div>
                          <div class="col-sm-2"></div>
                        </div>
                        <div class="col-md-6 text-center"> 
                          <div class="col-sm-2"></div>
                          <div class="col-sm-8">
                            <B><font size="5">ถึง</font></B>
                          </div>
                          <div class="col-sm-2"></div>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="col-md-6 text-center">
                          <div class="col-sm-2"></div>
                          <div class="col-sm-8">
                            <input class="form-control text-center" type="date" name="aday">
                          </div>
                          <div class="col-sm-2"></div>
                        </div>
                        <div class="col-md-6 text-center"> 
                          <div class="col-sm-2"></div>
                          <div class="col-sm-8">
                            <input class="form-control text-center" type="date" name="bday">
                          </div>
                          <div class="col-sm-2"></div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
              <br>
              <br>
              <div class="modal-footer text-center">
                <button type="button" class="btn pull-left button2" data-dismiss="modal"><< ย้อนกลับ </button>
                <button type="submit" class="btn pull-right button2">ต่อไป >></button>
              </div>
            </div>
          </form>
        </div>
      </div>
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
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : false,
            'info'        : true,
            'autoWidth'   : false
          });
          $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : false,
            'info'        : true,
            'autoWidth'   : false
          });
       });
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