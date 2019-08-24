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
                <li><a href="#profit_today" data-toggle="tab">ยอดจำหน่าย</a></li>
                <li><a href="#profit_back" data-toggle="tab">กำไรขายย้อนหลัง</a></li>
                <li><a href="#profit_duration" data-toggle="tab">กำไรขายตามช่วงเวลา</a></li>
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
                        <B>ยอดจำหน่าย 
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
                      <div class="mailbox-read-message col-md-2">
                      </div>  
                      <div class="mailbox-read-message col-md-8">
                        <table class="table table table-striped table-bordered ">
                          <tbody>
                            <tr class="info" >
                              <th class="text-center" width="15%">ชื่อทีมงาน</th>
                              <th class="text-center" width="5%">เงินขาย(บ)</th>
                              <th class="text-center" width="5%">Soft HOMDY(ลัง)</th>
                              <th class="text-center" width="5%">Soft HOMDY(ขวด)</th>
                            </tr>
                            <?php 
                              $sql_wp = "SELECT SUM(money) FROM price_history WHERE DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate'";
                              $objq_wp = mysqli_query($conn,$sql_wp);
                              $objr_wp = mysqli_fetch_array($objq_wp);
                              $sum_wp = $objr_wp['SUM(money)'];

                              //soft ลัง ร้านเวียง
                              $sql_wp_soft1 = "SELECT SUM(num) FROM price_history WHERE DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate' AND id_product = 1";
                              $objq_wp_soft1 = mysqli_query($conn,$sql_wp_soft1);
                              $objr_wp_soft1 = mysqli_fetch_array($objq_wp_soft1);
                              $sum_wp_soft1 = $objr_wp_soft1['SUM(num)'];
                              //soft ลัง ร้านเวียง

                              //soft ขวด ร้านเวียง
                              $sql_wp_soft2 = "SELECT SUM(num) FROM price_history WHERE DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate' AND id_product = 2";
                              $objq_wp_soft2 = mysqli_query($conn,$sql_wp_soft2);
                              $objr_wp_soft2 = mysqli_fetch_array($objq_wp_soft2);
                              $sum_wp_soft2 = $objr_wp_soft2['SUM(num)'];
                              //soft ขวด ร้านเวียง
                            ?>
                            <tr>
                              <td class="text-center" width="15%">หน้าร้าน</td>
                              <td class="text-center" width="5%"><?php echo $sum_wp;?></td>
                              <td class="text-center" width="5%"><?php echo $sum_wp_soft1;?></td>
                              <td class="text-center" width="5%"><?php echo $sum_wp_soft2;?></td>
                            </tr>
                            <?php 
                            $total_money = 0;
                            $total_numsoft1 = 0;
                            $total_numsoft2 = 0;
                              $sql_idmember = "SELECT * FROM member";
                              $objq_member = mysqli_query($conn,$sql_idmember);
                              while($value = $objq_member->fetch_assoc()){
                                $id_member = $value['id_member'];
                                $sql_sum = "SELECT SUM(money),name FROM sale_car_history INNER JOIN member ON sale_car_history.id_member = member.id_member 
                                            WHERE sale_car_history.id_member = $id_member AND DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate'";
                                $objq_sum = mysqli_query($conn,$sql_sum);
                                $objr_sum = mysqli_fetch_array($objq_sum);

                                //soft homdy ลัง
                                $sql_sum_soft1 = "SELECT SUM(num) FROM sale_car_history 
                                                  WHERE id_member = $id_member AND DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate' AND id_product = 1";
                                $objq_sum_soft1 = mysqli_query($conn,$sql_sum_soft1);
                                $objr_sum_soft1 = mysqli_fetch_array($objq_sum_soft1);
                                //soft homdy ลัง

                                //soft homdy ขวด
                                $sql_sum_soft2 = "SELECT SUM(num) FROM sale_car_history 
                                                  WHERE id_member = $id_member AND DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate' AND id_product = 2";
                                $objq_sum_soft2 = mysqli_query($conn,$sql_sum_soft2);
                                $objr_sum_soft2 = mysqli_fetch_array($objq_sum_soft2);
                                //soft homdy ขวด


                                $name = $objr_sum['name'];
                                $sum_money = $objr_sum['SUM(money)'];
                                $num_soft1 = $objr_sum_soft1['SUM(num)'];
                                $num_soft2 = $objr_sum_soft2['SUM(num)'];
                                if (isset($sum_money) && !$sum_money == 0) {
                                  
                            ?>
                            <tr>
                              <td class="text-center"><?php echo $name;?></td>
                              <td class="text-center"><?php echo $sum_money;?></td>
                              <td class="text-center"><?php echo  $num_soft1; ?></td>
                              <td class="text-center"><?php echo  $num_soft2; ?></td>
                            </tr>
                            <?php 
                              }else{

                              }
                              $total_money = $total_money + $sum_money;
                              $total_numsoft1 = $total_numsoft1 + $num_soft1;
                              $total_numsoft2 = $total_numsoft2 + $num_soft2;
                            }
                            ?>
                              <th class="info text-right">รวม</th>
                              <th class="info text-center"><?php echo $total_money+$sum_wp;?></th>
                              <th class="info text-center"><?php echo $total_numsoft1+$sum_wp_soft1; ?></th>
                              <th class="info text-center"><?php echo $total_numsoft2+$sum_wp_soft2;?></th>
                          </tbody>
                        </table>
                      </div>
                      <!-- /row -->
                      <div class="mailbox-read-message col-md-2">
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