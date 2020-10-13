<?php
  require "../config_database/config.php";
  require "../session.php";
  require "menu/date.php";

  $id_member_car = $_GET['id_member'];

  $sql_reserve = "SELECT money FROM reserve_money WHERE id_member = $id_member_car";
  $objq_reserve = mysqli_query($conn,$sql_reserve);
  $objr_reserve = mysqli_fetch_array($objq_reserve);
  $reserve_money = $objr_reserve['money'];

  $sql_member = "SELECT id_member,name FROM member WHERE id_member = $id_member_car";
  $objq_member = mysqli_query($conn,$sql_member);
  $objr_member = mysqli_fetch_array($objq_member);
  $name_member = $objr_member['name'];

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
                  <a href="car_rental.php"> ค่าเช่ารถ </a>
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
                    <div class="col-3 col-sm-3 col-md-3 col-xl-3">
                    <a class="btn button2" href="reserve_car.php"></i><< กลับ</a>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                      <div class="text-center">
                        <font size="5">
                          <B align="center">รายการใช้เงินหน่วยรถ : <?php echo $name_member;?> <font color="red"> </font></B>
                        </font>
                      </div>
                    </div>
                    <div class="col-3 col-sm-3 col-md-3 col-xl-3 text-right"></div>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <div class="mailbox-read-message">
                  
                    <div class="col-12 col-sm-12 col-xl-12 col-md-12 col-lg-12">
                      <font size="3" color="red">
                        <B> เงินคงเหลือ  <?php echo $reserve_money;?> </B>
                      </font>
                    </div>
                    <br><br>

                    <div class="col-12">
                      <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                        <table class="table" id="example2">
                          <thead>
                            <tr>
                              <th class="text-center" width="12%">วันที่</th>
                              <th class="text-center" width="12%">รายการ</th>
                              <th class="text-center" width="12%">รับ-จ่าย</th>
                              <th class="text-center" width="12%">คงเหลือ</th>
                              <th class="text-center" width="47%">หมายเหตุ</th>
                              <th class="text-center" width="5%">ลบ</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                              $sql_rs_history = "SELECT * FROM reserve_history 
                                                  INNER JOIN reserve_list ON reserve_history.id_list = reserve_list.id_list
                                                  WHERE reserve_history.id_member_receive = $id_member_car
                                                  GROUP BY reserve_history.id_reserve_history DESC
                                                  LIMIT 1000";
                              $objq_rs_history = mysqli_query($conn,$sql_rs_history);
                              while($value = $objq_rs_history->fetch_assoc()){
                            ?>
                              <?php 
                                if ($value['status']==3||$value['id_list']==18) {
                              ?>
                              <tr>
                                <td class="text-center"><font color="red"><?php echo Datethai($value['date']); ?></font></td>
                                <td class="text-center"><font color="red"><?php echo $value['name_list']; ?></font></td>
                                <td class="text-center"><font color="red"><?php echo $value['money']; ?></font></td>
                                <td class="text-center"><font color="red"><?php echo $value['transfer']; ?></font></td>
                                <td class="text-center"><?php echo $value['note']; ?></td>
                                <td class="text-center">
                                  
                                </td>
                              </tr>
                              <?php
                                }else{
                              ?>
                              <tr>
                                <td class="text-center"><?php echo Datethai($value['date']); ?></td>
                                <td class="text-center"><?php echo $value['name_list']; ?></td>
                                <td class="text-center"><?php echo $value['money']; ?></td>
                                <td class="text-center"><?php echo $value['transfer']; ?></td>
                                <td class="text-center"><?php echo $value['note']; ?></td>
                                <td class="text-center">
                                  <?php 
                                    if ($id_member == 30) {
                                  ?>
                                    <a href="algorithm/delete_reservecar2.php?id_member=<?php echo $id_member_car;?>&&id=<?php echo $value['id_reserve_history']; ?>&&money=<?php echo $value['money'];?>&&money_total=<?php echo $reserve_money;?>" class="btn btn-danger btn-xs">ลบ</a>
                                  <?php 
                                    }else {
                                      
                                    }
                                  ?>
                                </td>
                              </tr>
                            <?php
                                }
                              }
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="box-footer text-right">
                  <a href="#" data-toggle="modal" data-target="#check_list2" class="btn btn-success">PDF</a>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-xl-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <div class="col-12">
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                    
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                      <div class="text-center">
                        <font size="5">
                          <B align="center"> รายการใช้เงินรายวัน : <?php echo $name_member;?> <font color="red"> </font></B>
                        </font>
                      </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4 text-right">
                    </div>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <div class="mailbox-read-message">
                    <div class="col-12">
                      <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                        <table id="example1" class="table">
                          <thead>
                            <tr>
                              <th class="text-center" width="16%">วันที่</th>
                              <th class="text-center" width="16%">น้ำมัน</th>
                              <th class="text-center" width="16%">เบี้ยเลี้ยง</th>
                              <th class="text-center" width="16%">ที่พัก</th>
                              <th class="text-center" width="16%">จ่ายอื่น</th>
                              <th class="text-center" width="16%">รวมเงิน</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php 
                            $aday = date("Y-m-d");
                            $bday = date("Y-m-d", strtotime("-10 day", strtotime($aday)));
                            while(strtotime($bday) <= strtotime($aday)) { 
                          ?>
                            <tr>
                              <td class="text-center"><?php echo Datethai($aday);?></td> 
                              <?php
                                 $sum_money = 0;
                                 $sql_resevelist = "SELECT id_list FROM reserve_list WHERE status = 4";
                                 $objq_reservelist = mysqli_query($conn,$sql_resevelist);
                                 while($value_reservelist = $objq_reservelist->fetch_assoc()){
                                   $id_list = $value_reservelist['id_list'];
                                   $sql_history = "SELECT SUM(money) FROM reserve_history 
                                                   WHERE id_list = $id_list AND id_member = $id_member_car AND DATE_FORMAT(date,'%Y-%m-%d')='$aday'";
                                  $objq_history = mysqli_query($conn,$sql_history);
                                  while($value_history = $objq_history->fetch_assoc()){
                              ?>
                              <td class="text-center"><?php echo $value_history['SUM(money)'];?></td>
                              <?php 
                                  $sum_money = $sum_money + $value_history['SUM(money)'];
                                  }
                                 }
                              ?>
                              <td class="text-center"><?php echo $sum_money;?></td>
                            </tr>
                          <?php 
                              $aday = date ("Y-m-d", strtotime("-1 day", strtotime($aday)));
                            }
                          ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="box-footer text-right">
                <a href="#" data-toggle="modal" data-target="#check_list" class="btn btn-success">PDF</a>
                </div>
              </div>
            </div>
          </div>

        </section>
      </div>
      <?php require("../menu/footer.html"); ?>

      <div class="modal fade" id="check_list" role="dialog">
        <div class="modal-dialog modal-lg">
          <form action="../pdf_file/reserve_car.php" method="post">
            <div class="modal-content">
              <div class="modal-header text-center">
                  <font size="5"><B> โอนจ่ายรายวัน </B></font>
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
                          <div class="col-sm-2">
                            <input type="hidden" name="id_member" value="<?php echo $id_member_car; ?>">
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn pull-left button2" data-dismiss="modal"><< ย้อนกลับ </button>
                <button type="submit" class="btn pull-right button2">ต่อไป >></button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="modal fade" id="check_list2" role="dialog">
        <div class="modal-dialog modal-lg">
          <form action="../pdf_file/reserve_carlist.php" method="post">
            <div class="modal-content">
              <div class="modal-header text-center">
                  <font size="5"><B> รายการโอนจ่าย </B></font>
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
                          <div class="col-sm-2">
                            <input type="hidden" name="id_member" value="<?php echo $id_member_car; ?>">
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
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
    </script>
  </body>

</html>