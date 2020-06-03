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
                  <li class="active"><a href="#today" data-toggle="tab">วันนี้</a></li>
                  <li><a href="#checkday" data-toggle="tab">รายวัน</a></li>
                  <li><a href="#bytime" data-toggle="tab">ช่วงเวลา</a></li>
                  <a href="admin.php" class="btn button2 pull-right"><< เมนูหลัก</a>
                </ul>
                <div class="tab-content">

                  <div class="active tab-pane" id="today">
                    <div class="box box-default">
                      <div class="box-header with-border">
                        <div class="row">
                          <div class="col-md-12 col-12">
                              <div class="col-md-3 col-sm-3 col-3">
                                <div align="left">
                                
                                </div>
                              </div>

                              <div class="col-md-6 col-sm-6 col-6">
                                <p align="center">
                                  <font size="5">
                                    <B>ค่าส่งปุ๋ยวันนี้</B>
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
                      <div class="box-body">
                        <div class="col-md-12">
                          <div class="row">
                            <table class="table table-striped" id="example2">
                              <thead>
                              <tr>
                                <th class="text-center" width="5%"> <font color="red">ที่</font> </th>
                                <th class="text-center" width="10%"> <font color="red">ชื่อ</font> </th>
                                <th class="text-center" width="10%"> <font color="red">ยก</font> </th>
                                <th class="text-center" width="8%"> <font color="red">รถ</font> </th>
                                <th class="text-center" width="8%"> <font color="red">คน</font> </th>
                                <th class="text-center" width="8%"> <font color="red">กส</font> </th>
                                <th class="text-center" width="8%"> <font color="red">ค่ายก</font> </th>
                                <th class="text-center" width="8%"> <font color="red">ค่ารถ</font> </th>
                                <th class="text-center" width="25%"> <font color="red">สต๊อก</font> </th>
                                <th class="text-center" width="5%"> <font color="red">เวลา</font> </th>
                                <th class="text-center" width="5%"> <font color="red">แก้ไข</font> </th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php 
                                $i = 1;
                                $day = date('Y-m-d');
                                $sql_ferti = "SELECT * FROM sent_ferti
                                              INNER JOIN type_lift ON sent_ferti.id_type_lift = type_lift.id
                                              INNER JOIN member ON sent_ferti.id_member = member.id_member 
                                              WHERE DATE_FORMAT(datetime,'%Y-%m-%d')='$day'";
                                $objq_ferti = mysqli_query($conn,$sql_ferti);
                                while($value = $objq_ferti->fetch_assoc()){
                                  $id_car = $value['id_car'];
                                  $sql = "SELECT name FROM member WHERE id_member = $id_car";
                                  $objq = mysqli_query($conn,$sql);
                                  $objr = mysqli_fetch_array($objq);

                                  $id_member = $value['id_member'];

                                  if($id_member == $id_car){
                                    $car_rental = $value['num_ferti']*0.75;
                                  }else{
                                    $car_rental = "-";
                                  }
                              ?>
                              <tr>
                                <td class="text-center"><?php echo $i; ?></td>
                                <td class="text-center"><?php echo $value['name'];?></td>
                                <td class="text-center"><?php echo $value['name_type_lift'];?></td>
                                <td class="text-center"><?php echo $objr['name'];?></td>
                                <td class="text-center"><?php echo $value['num_cus'];?></td>
                                <td class="text-center"><?php echo $value['num_ferti'];?></td>
                                <td class="text-center"><?php echo $value['money'];?></td>
                                <td class="text-center"><?php echo $car_rental;?></td>
                                <td class="text-center"><?php echo $value['note'];?></td>
                                <td class="text-center"><?php echo Datethai2($value['datetime']);?></td>
                                <td class="text-center"> 
                                  <a href="sent_fertilizer_edit.php?id_sent_ferti=<?php echo $value['id_sent_ferti']; ?>&&day=<?php echo $day; ?>" > <i class="fa fa-pencil"></i> </a>
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
                    </div>
                  </div>

                  <div class="tab-pane" id="checkday">
                    <div class="box box-default">
                    <div class="box-header with-border">
                      <div class="row">
                        <div class="col-md-12 col-12">
                            <div class="col-md-3 col-sm-3 col-3">
                              <div align="left">
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
                                    <input class="form-control text-center" type="date" name="day" id="datePicker">
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
                                        <input type="date"  class="form-control text-center"  name="aday">
                                      </div>
                                    </div>
                                    <div class="col-md-6 col-6 col-lg-6 col-xs-6">
                                      <div class="form-group text-center">
                                        <label><font size="5">ถึง</font></label></label>
                                        <input type="date" class="form-control text-center" name="bday">
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

        $(function() {
          $('#example1').DataTable()
          $('#example2').DataTable({
            'paging': false,
            'lengthChange': false,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': false
          })
        })
    </script>
  </body>

</html>