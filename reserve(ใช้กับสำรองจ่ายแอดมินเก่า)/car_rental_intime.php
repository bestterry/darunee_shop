<?php
  require "../config_database/config.php";
  require "../session.php";
  require "menu/date.php";

  $date = date("Y-m-d");

  $aday = $_POST['aday'];
  $bday = $_POST['bday'];

  $sql_member = "SELECT id_member,name FROM member WHERE status_reserve = 1";
  $objq_member = mysqli_query($conn,$sql_member);
  $objq_member2 = mysqli_query($conn,$sql_member);
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
                  <a href="reserve_car.php"></i> โอนหน่วยรถ </a>
                  <a href="reserve_carvalue.php"> ใช้จ่ายหน่วยรถ </a>
                  <a class="active" href="car_rental.php"> ปฏิบัติงานและค่าเช่ารถ </a>
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
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                      <li><a href="#today" data-toggle="tab">รายวัน</a></li>
                      <li class="active"><a href="#intime" data-toggle="tab">ช่วงเวลา</a></li>
                    </ul> 
                    <div class="tab-content">

                      <div class="tab-pane" id="today">
                        <form action="car_rentalday.php" method="get">
                          <div class="box-body">
                            <div class="col-12">
                              <div align="center">
                                <font size="5">
                                  <B align="center">ปฏิบัติงานและค่าเช่ารถ</B>
                                </font>
                              </div>
                              <br>
                              <div class="table-responsive mailbox-messages">
                                <div class="col-12">
                                  <div class="col-4 col-sm-4 col-md-4 col-xl-4 text-center"></div>
                                  <div class="col-4 col-sm-4 col-md-4 col-xl-4 text-center"> 
                                    <input class="form-control text-center" type="date" value="<?php echo $date;?>" name="day">
                                  </div>
                                  <div class="col-4 col-sm-4 col-md-4 col-xl-4 text-center"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="box-footer text-center">
                            <button type="submit" class="btn btn-success">ตกลง</button>
                          </div>
                        </form>
                        <div class="box-body">
                          <div class="mailbox-read-message">
                            <div class="col-12">
                              <table id="example1" class="table">
                                <thead>
                                  <tr>
                                    <th class="text-center" width="20%">หน่วยรถ</th>
                                    <th class="text-center" width="20%">ปฏิบัติงาน</th>
                                    <th class="text-center" width="20%">ค่าเช่ารถ</th>
                                    <th class="text-center" width="35%">หมายเหตุ</th>
                                    <th class="text-center" width="5%">แก้ไข</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                    while($value = $objq_member -> fetch_assoc()){
                                      $id_member = $value['id_member'];
                                  ?>
                                    <tr>
                                      <td class="text-center"><?php echo ($value['name']); ?></td> 
                                      <?php
                                        $sum_money = 0;
                                        $sql_carrental = "SELECT * FROM car_rental 
                                                          INNER JOIN rc_practice ON rc_practice.id_practice = car_rental.id_practice 
                                                          WHERE id_member = $id_member AND date = '$date'";
                                        $objq_carrental = mysqli_query($conn,$sql_carrental);
                                        if ($objq_carrental->num_rows > 0 ) {
                                        $objr_carental = mysqli_fetch_array($objq_carrental);
                                      ?>
                                      <td class="text-center"><?php echo $objr_carental['name_practice'];?></td>
                                      <td class="text-center"><?php echo $objr_carental['money'];?></td>
                                      <td class="text-center"><?php echo $objr_carental['note'];?></td>
                                      <td class="text-center">
                                        <a type="button" href="car_rental_edit.php?id=<?php echo $objr_carental['id_carrental']; ?>&&status=today" class="btn btn-success btn-xs">แก้</a>
                                      </td>
                                      <?php 
                                        }else{
                                      ?>
                                      <td class="text-center">-</td>
                                      <td class="text-center">-</td>
                                      <td class="text-center">-</td>
                                      <td class="text-center">-</td>
                                      <?php 
                                        }
                                      ?>
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

                      <div class="tab-pane active" id="intime">
                        <div class="col-12">
                          <form action="car_rental_intime.php" method="post">
                            <div class="box-body">
                              <div align="center">
                                <font size="5">
                                <B align="center">ค่าเช่ารถ</B>
                                </font>
                              </div>
                              <div class="table-responsive mailbox-messages">
                                <div class="col-12">
                                  <div class="col-6 col-sm-6 col-md-6 col-xl-6 text-center">
                                    <div class="col-2 col-sm-2 col-md-2 col-xl-2"></div>
                                    <div class="col-8 col-sm-8 col-md-8 col-xl-8">
                                        <B><font size="5">ตั้งแต่</font></B>
                                    </div>
                                    <div class="col-2 col-sm-2 col-md-2 col-xl-2"></div>
                                  </div>
                                  <div class="col-6 col-sm-6 col-md-6 col-xl-6 text-center"> 
                                    <div class="col-2 col-sm-2 col-md-2 col-xl-2"></div>
                                    <div class="col-8 col-sm-8 col-md-8 col-xl-8">
                                      <B><font size="5">ถึง</font></B>
                                    </div>
                                    <div class="col-2 col-sm-2 col-md-2 col-xl-2"></div>
                                  </div>
                                </div>
                                <div class="col-12">
                                  <div class="col-6 col-sm-6 col-md-6 col-xl-6 text-center">
                                    <div class="col-2 col-sm-2 col-md-2 col-xl-2"></div>
                                    <div class="col-8 col-sm-8 col-md-8 col-xl-8">
                                      <input class="form-control text-center" type="date" value="<?php echo $aday;?>" name="aday">
                                    </div>
                                    <div class="col-2 col-sm-2 col-md-2 col-xl-2"></div>
                                  </div>
                                  <div class="col-6 col-sm-6 col-md-6 col-xl-6 text-center"> 
                                    <div class="col-2 col-sm-2 col-md-2 col-xl-2"></div>
                                    <div class="col-8 col-sm-8 col-md-8 col-xl-8">
                                      <input class="form-control text-center" type="date" value="<?php echo $bday;?>" name="bday">
                                    </div>
                                    <div class="col-2 col-sm-2 col-md-2 col-xl-2"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="box-footer text-center">
                              <button type="submit" class="btn btn-success">ตกลง</button>
                            </div>
                          </form>
                          <div class="box-body">
                            <div class="col-12">
                              <div class="col-3 col-sm-3 col-md-3 col-xl-3"></div>
                              <div class="col-6 col-sm-6 col-md-6 col-xl-6 text-center">
                                <div align="center">
                                  <font size="5">
                                  <B align="center"> <font color="red"><?php echo Datethai($aday);?></font> ถึง <font color="red"> <?php echo Datethai($bday);?></font></B>
                                  </font>
                                </div>
                                <br>
                                  <table class="table">
                                    <thead>
                                      <tr>
                                        <th class="text-right" width="50%">หน่วยรถ</th>
                                        <th class="text-left" width="50%">ค่าเช่ารถ</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                      $sum_money = 0;
                                        while($value = $objq_member2 -> fetch_assoc()){
                                          $id_member = $value['id_member'];
                                      ?>
                                        <tr>
                                          <td class="text-right"><?php echo ($value['name']); ?></td> 
                                          <?php
                                            $sql_carrental = "SELECT SUM(money) FROM car_rental WHERE id_member = $id_member 
                                                              AND(date BETWEEN '$aday' AND '$bday')";
                                            $objq_carrental = mysqli_query($conn,$sql_carrental);
                                            if ($objq_carrental->num_rows > 0 ) {
                                            $objr_carental = mysqli_fetch_array($objq_carrental);
                                            $money = $objr_carental['SUM(money)'];
                                            $sum_money = $sum_money + $money;
                                          ?>
                                          <td class="text-left"><?php echo $money;?></td>
                                          <?php 
                                            }else{
                                          ?>
                                          <td class="text-left">-</td>
                                          <?php 
                                            }
                                          ?>
                                        </tr>
                                      <?php 
                                        }
                                      ?>
                                      <tr>
                                        <th class="text-right">รวม</th>
                                        <th class="text-left"><?php echo $sum_money; ?></th>
                                      </tr>
                                    </tbody>
                                  </table>
                              </div>
                              <div class="col-3 col-sm-3 col-md-3 col-xl-3"></div>
                            </div>
                          </div>
                          <div class="box-footer text-center">
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
    
  </body>

</html>