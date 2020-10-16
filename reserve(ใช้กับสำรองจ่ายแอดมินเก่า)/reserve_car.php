<?php
  require "../config_database/config.php";
  require "../session.php";
  require "menu/date.php";
  $sql_reserve = "SELECT money FROM reserve_money WHERE id_member = 33";
  $objq_reserve = mysqli_query($conn,$sql_reserve);
  $objr_reserve = mysqli_fetch_array($objq_reserve);
  $reserve_money = $objr_reserve['money'];

  $sql_history = "SELECT * FROM reserve_history
                  INNER JOIN member ON reserve_history.id_member_receive = member.id_member
                  WHERE reserve_history.status = 3 ORDER BY reserve_history.id_reserve_history DESC 
                  LIMIT 20";
  $objq_history = mysqli_query($conn,$sql_history);

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
                  <a class="active" href="reserve_car.php"></i> โอนหน่วยรถ </a>
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

          <div class="box box-primary">
            <div class="box-header with-border">
              <div class="col-12">
                <div class="col-4 col-sm-4 col-md-4 col-xl-4"></div>
                <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                  <div class="text-center">
                    <font size="5">
                      <B align="center">สร.หน่วยรถคงเหลือ<font color="red"> </font></B>
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
                      <B> เงินคงเหลือ  <?php echo $reserve_money;?> </B>
                    </font>
                  </div>
                  <br>
                  <br>
                  <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="col-3 col-xs-3 col-sm-3 col-md-3 col-lg-3"></div>
                    <div class="col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6">
                      <table class="table">
                        <thead>
                          <tr>
                            <th class="text-center" width="33%">หน่วยรถ</th>
                            <th class="text-center" width="33%">เงินคงเหลือ</th>
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
                    <div class="col-3 col-xs-3 col-sm-3 col-md-3 col-lg-3"></div>
                  </div>
                </div>
            </div>
          </div>

        </section>

        <section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <div class="col-12">
                <div class="col-4 col-sm-4 col-md-4 col-xl-4"></div>
                <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                  <div class="text-center">
                    <font size="5">
                      <B align="center">โอน สร.หน่วยรถ<font color="red"> </font></B>
                    </font>
                  </div>
                </div>
                <div class="col-4 col-sm-4 col-md-4 col-xl-4 text-right"> </div>
              </div>
            </div>
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                <div class="col-12">
                  
                  <div class="col-12 col-xs-12 col-sm-412col-md-12 col-lg-12">
                    <div class="col-3 col-xs-3 col-sm-3 col-md-3 col-lg-3"></div>
                    <div class="col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6">
                      <table class="table" id="example1">
                        <thead>
                          <tr>
                            <th class="text-center" width="27%">วันที่</th>
                            <th class="text-center" width="32%">หน่วยรถ</th>
                            <th class="text-center" width="32%">เงินโอน</th>
                            <th class="text-center" width="9%">ลบ</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                          while($value = $objq_history -> fetch_assoc()){
                        ?>
                          <tr>
                            <td class="text-center"><?php echo Datethai($value['date']); ?></td> 
                            <td class="text-center"><?php echo $value['name']; ?></td>
                            <td class="text-center"><?php echo $value['money']; ?></td>
                            <td class="text-center">
                              <a href="algorithm/delete_reservecar.php?id_member=<?php echo $value['id_member_receive'];?>&&id=<?php echo $value['id_reserve_history']; ?>&&money=<?php echo $value['money'];?>&&money_total=<?php echo $reserve_money;?>" class="btn btn-danger btn-xs">ลบ</a>
                            </td>
                          </tr>
                        <?php 
                          }
                        ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-3 col-xs-3 col-sm-3 col-md-3 col-lg-3"></div>
                  </div>
                </div>
            </div>
          </div>
        </section>
      </div>
      <?php require("../menu/footer.html"); ?>
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
          <form action="algorithm/reserve_car.php"  method="post">
            <div class="modal-content">
              <div class="modal-header text-center">
                  <font size="5"><B> โอนเงินหน่วยรถ </B></font>
              </div>
              <div class="modal-body col-md-12 table-responsive mailbox-messages">
                <div class="col-12">
                  <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
                  <div class="col-8 col-sm-8 col-xl-8 col-md-8">
                    <div class="table-responsive mailbox-messages">
                      <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <th class="text-center" width="30%"><font size="4">หน่วยรถ</font></th>
                            <th class="text-center" width="70%"> 
                              <select name="id_member"  class="form-control" >
                                <option value="">-- เลือกหน่วยรถ --</option>
                                <?php 
                                  $sql_member = "SELECT * FROM member WHERE status_car = 1";
                                  $objq_member = mysqli_query($conn,$sql_member);
                                    while($value = $objq_member->fetch_assoc()){ 
                                ?>
                                    <option value="<?php echo $value['id_member'];?>"><?php echo $value['name'];?></option>
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
                            <th class="text-center" width="30%"><font size="4">จำนวนเงิน</font></th>
                            <th class="text-center" width="70%"> 
                              <input type="number" name="money" value="5000" class="form-control text-center">
                              <input type="hidden" name="money_befor" value="<?php echo $reserve_money; ?>">
                            </th>
                          </tr>
                        </tbody>
                      </table> 
                      <br>
                      <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <th class="text-center" width="30%"><font size="4">วันที่</font></th>
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
              <div class="modal-footer">
                <button type="submit" class="btn btn-success pull-right">บันทึก</button>
                <button type="button" class="btn button2 pull-left" data-dismiss="modal"><< ย้อนกลับ </button>
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
      $('#example1').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : false,
        'info'        : true,
        'autoWidth'   : false
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