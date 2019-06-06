<?php 

  require "../config_database/config.php";
  require "../session.php"; 
  require "menu/date.php";

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
</head>

<body class=" hold-transition skin-blue layout-top-nav ">
  <div class="wrapper">
    <header class="main-header">
    <?php 
      require('menu/header_logout.php');
      
      ?>
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
                <li><a href="#profit_today" data-toggle="tab">ตารางปฏิบัติงานวันนี้</a></li>
                <li><a href="#profit_back" data-toggle="tab">ตารางปฏิบัติงานย้อนหลัง</a></li>
                <div align="right">
                  <a href="admin.php" class="btn btn-success"><<== กลับสู่เมนูหลัก</a>
                </div>
              </ul>
              <div class="tab-content">

              
                  <!-- tab-pane -->
                  <div class="active tab-pane" id="profit_today">
                  <div class="box box-default">
                    <div class="box-header text-center with-border">
                      <font size="5">
                        <B>ตารางปฏิบัติงาน  
                          <font size="5" color="red">
                            <?php 
                                $strDate = date('d-m-Y');
                                echo DateThai($strDate);
                            ?>
                          </font>
                         </B>  
                      </font>                        
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                      <div class="row">
                      <table class="table table-striped table-bordered">
                  <tbody>
                    <tr class="info" >
                      <th class="text-center" width="5%">ที่</th>
                      <th class="text-center" width="10%">งานที่ทำ</th>
                      <th class="text-center" width="10%">ชื่อ</th>
                      <th class="text-center" width="25%">พื้นที่ทำงาน(อำเภอ)</th>
                      <th class="text-center" width="13%">sHD ลัง</th>
                      <th class="text-center" width="13%">sHD ขวด</th>
                      <th class="text-center" width="15%">เงินขาย(บ.)</th>
                    </tr>
                    <?php
                    $total_money = 0;
                    $i = 1;
                        $sql_day_car = " SELECT * FROM member 
                        INNER JOIN area ON area.id_member = member.id_member
                        INNER JOIN working ON area.id_working = working.id_working
                        WHERE DATE_FORMAT(area.datetime,'%d-%m-%Y')='$strDate'";
                        $objq_day_car = mysqli_query($conn,$sql_day_car);
                        while ($value = $objq_day_car-> fetch_assoc() ) {
                        $id_member = $value['id_member'];
                        $datetime = $value['datetime'];
                        $name_area = $value['name_area'];
                        $name_work = $value['name_working'];
                        $money = $value['money'];
                        $name = $value['name'];
                        
                        //หา sum soft homdy ลัง
                        $sql_s1 = "SELECT SUM(num) FROM sale_car_history 
                                          WHERE id_product = 1 AND id_member = $id_member AND DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate'";
                        $objq_s1 = mysqli_query($conn,$sql_s1);
                        $objr_s1 = mysqli_fetch_array($objq_s1);

                        //หา sum soft homdy ลัง
                        $sql_s2 = "SELECT SUM(num)FROM sale_car_history 
                                          WHERE id_product = 2 AND id_member = $id_member AND DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate'";
                        $objq_s2 = mysqli_query($conn,$sql_s2);
                        $objr_s2 = mysqli_fetch_array($objq_s2);

                        //หา sum money
                        $sql_money = "SELECT SUM(money) FROM sale_car_history WHERE id_member = $id_member AND DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate'";
                        $objq_money = mysqli_query($conn,$sql_money);
                        $objr_money = mysqli_fetch_array($objq_money);
                        $sale_money =  $objr_money['SUM(money)'];
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $i;?></td>
                      <td class="text-center"><?php echo $name_work;?></td>
                      <td class="text-center"><?php echo $name;?></td>
                      <td class="text-center"><?php echo $name_area;?></td>
                      <td class="text-center"><?php echo $objr_s1['SUM(num)'];?></td>
                      <td class="text-center"><?php echo $objr_s2['SUM(num)'];?></td>
                      <td class="text-center"><?php echo $sale_money;?></td>
                    </tr>
                      <?php 
                      $i++;
                      $total_money = $total_money +  $sale_money; 
                    }?>
                      <tr class="info">
                      <td class="text-center"></td>
                      <td class="text-center"></td>
                      <td class="text-center"></td>
                      <td class="text-center"></td>
                      <td class="text-center"></td>
                      <th class="text-center">รวมเงิน</th>
                      <th class="text-center"><?php echo $total_money; ?></th>
                    </tr>
                  </tbody>
                </table>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.tab-pane -->

                <!-- tab-pane -->
                <div class="tab-pane" id="profit_back">
                  <div class="box box-default">
                    <div class="box-header with-border">

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="row">
                        <div class="container">
                          <form action="profit_back.php" method="post">
                            <div class="col-md-5">
                              <div class="box-body">
                                <strong><i class="fa fa-file-text-o margin-r-5"></i> การใช้</strong>
                                <p> -กรุณาเลือกวันที่ เพื่อตรวจสอบกำไรขายย้อนหลัง</p>
                              </div>
                            </div>
                            <div class="col-md-5">
                              <div class="form-group">
                                <label>วันที่ : </label>
                                <input type="date" name="day">
                              </div>
                              <div class="box-footer">
                                <button type="submit" class="btn btn-success pull-left"><i
                                    class="fa fa-check-square-o"></i> ตกลง</button>
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
                <div class="tab-pane" id="profit_duration">
                  <div class="box box-default">
                    <div class="box-header with-border">

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="row">
                        <div class="container">
                          <form action="profit_duration.php" method="post">
                            <div class="col-md-5">
                              <div class="box-body">
                                <strong><i class="fa fa-file-text-o margin-r-5"></i> การใช้ </strong>
                                <p> -กรุณาเลือกวันที่ เพื่อตรวจสอบกำไรขายย้อนหลัง</p>
                              </div>
                            </div>
                            <div class="col-md-5">
                              <div class="form-group">
                                <label>ตั้งเเต่ : </label>
                                <input type="date" name="aday">
                              </div>
                              <div class="form-group">
                                <label>ถึง &nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                <input type="date" name="bday">
                              </div>
                              <div class="box-footer">
                                <button type="submit" class="btn btn-success pull-left"><i
                                    class="fa fa-check-square-o"></i> ตกลง</button>
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