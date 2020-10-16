<?php
  require "../config_database/config.php";
  require "../session.php";
  require "menu/date.php";

  $id_carrental = $_GET['id'];
  
  $query = "SELECT * FROM car_rental 
            INNER JOIN rc_practice ON rc_practice.id_practice = car_rental.id_practice 
            INNER JOIN member ON member.id_member = car_rental.id_member
            WHERE id_carrental = $id_carrental";  
  $result = mysqli_query($conn, $query);
  $objr = mysqli_fetch_array($result);
  $name_member = $objr['name'];
  $money = $objr['money'];
  $name_practice = $objr['id_practice'];
  $note = $objr['note'];
  $date = $objr['date'];
  $id_practice = $objr['id_practice'];
  $member_car = $objr['member_car'];
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
                <form action="algorithm/car_rental.php?status=<?php echo $_GET['status']; ?>" method="post" class="form-horizontal">
                  <div class="box-header">
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                      <a type="button" href="car_rental.php" class="btn button2" ><< กลับ</a>  
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4 text-center">
                      <font size="5">
                        <B align="center">แก้ไขปฏิบัติงานและค่าเช่ารถ </B>
                      </font>
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4"></div>
                  </div>
                  <div class="box-body">  
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4"></div>
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4">

                      <div class="form-group">
                        <label for="car_rental" class="col-4 col-sm-4 col-md-4 col-xl-4 control-label">วันที่</label>
                        <div class="col-8 col-sm-8 col-md-8 col-xl-8">
                          <input type="date" class="form-control" name="date" id="car_rental" value="<?php echo $date; ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="name" class="col-4 col-sm-4 col-md-4 col-xl-4 control-label">ชื่อ</label>
                        <div class="col-8 col-sm-8 col-md-8 col-xl-8">
                          <input type="text" class="form-control" id="name" value="<?php echo $name_member ?>" readonly/>
                          <input type="hidden" class="form-control" id="name" name="id_carrental" value="<?php echo $id_carrental?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="rc_practice" class="col-4 col-sm-4 col-md-4 col-xl-4 control-label">ใช้รถ</label>
                        <div class="col-8 col-sm-8 col-md-8 col-xl-8">
                          <select name="member_car" class="form-control">
                          <?php 
                            $sql_member = "SELECT id_member,name FROM member WHERE status_reserve = 1";
                            $objq_member = mysqli_query($conn,$sql_member);
                            while($value = $objq_member->fetch_assoc()){ 
                          ?>
                          <option value="<?php echo $value['id_member']; ?>" <?php if($member_car==$value['id_member']){ echo "selected";}else{}?>>
                          <?php echo $value['name']; ?></option>
                          <?php
                            }
                          ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="rc_practice" class="col-4 col-sm-4 col-md-4 col-xl-4 control-label">ปฏิบัติงาน</label>
                        <div class="col-8 col-sm-8 col-md-8 col-xl-8">
                          <select name="id_practice" class="form-control">
                          <?php 
                            $sql_practice = "SELECT * FROM rc_practice";
                            $objq_practice = mysqli_query($conn,$sql_practice);
                            while($value = $objq_practice->fetch_assoc()){ 
                          ?>
                          <option value="<?php echo $value['id_practice']; ?>" <?php if($id_practice==$value['id_practice']){ echo "selected";}else{}?>>
                          <?php echo $value['name_practice']; ?></option>
                          <?php
                            }
                          ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="car_rental" class="col-4 col-sm-4 col-md-4 col-xl-4 control-label">ค่าเช่ารถ</label>
                        <div class="col-8 col-sm-8 col-md-8 col-xl-8">
                          <input type="text" class="form-control" name="money" id="car_rental" value="<?php echo $money; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="note" class="col-4 col-sm-4 col-md-4 col-xl-4 control-label">หมายเหตุ</label>
                        <div class="col-8 col-sm-8 col-md-8 col-xl-8">
                          <input type="text" class="form-control" name="note" id="note" value="<?php echo $note; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4"></div>
                  </div>  
                  <div class="box-footer text-center">  
                    <button type="submit" class="btn btn-success" data-dismiss="modal">บันทึก</button>  
                  </div> 
                </form> 
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