<?php 
  require "../config_database/config.php";
  require "../session.php"; 
  require "menu/date.php";
  $strDate = date('d-m-Y');
  $id_category = $_GET['id_category'];
  $receive_money = "SELECT * FROM rc_receive_money 
                    INNER JOIN rc_practice ON rc_receive_money.id_practice = rc_practice.id_practice
                    INNER JOIN rc_category ON rc_receive_money.id_category = rc_category.id_category
                    INNER JOIN member ON rc_receive_money.id_member = member.id_member
                    WHERE rc_receive_money.id_category = $id_category
                    GROUP BY rc_receive_money.id_receive_money DESC";
  $objq_receive = mysqli_query($conn,$receive_money);
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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
      <?php require('menu/header_logout.php');?>
    </header>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
              <table class="table table-bordered" id="dynamic_field">
                <tr>
                  <th width="30%" > 
                    <a type="button" href="receive_money.php" class="btn button2 "><< กลับ</a>
                  </th>
                  <td width="40%" class="text-center"><font size="5"><B align="center">เงินขาย (รายวัน)</B></font></td>
                  <td width="30%"> 
                    <a type="button" href="../pdf_file/receive_money.php" class="btn btn-warning pull-right">PDF</a> 
                  </td>
                </tr>
              </table>
              <div class="mailbox-read-message">
                 <!-- boss -->
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="text-center" width="6%">รับ</th>
                      <th class="text-center" width="6%">สนง</th>
                      <th class="text-center" width="8%">ชื่อ</th>
                      <th class="text-center" width="8%">งาน</th>
                      <th class="text-center" width="8%">เงิน</th>
                      <th class="text-center" width="8%">ขาย</th>
                      <th class="text-center" width="9%">วันขาย</th>
                      <th class="text-center" width="9%">วันรับเงิน</th>
                      <th class="text-center" width="15%">ชื่อลูกค้า</th>
                      <th class="text-center" width="18%">หมายเหตุ</th>
                      <th class="text-center" width="5%">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      while($value = $objq_receive -> fetch_assoc()){
                    ?>
                    <tr>
                      <td class="text-center" >
                        <?php 
                          $status_boss = $value['status_boss'];
                            if( $status_boss == 'Y'){
                              echo "รับ";
                            }else{
                              echo ":";
                            } 
                        ?>
                      </td>
                      <td class="text-center" >
                        <?php 
                          $status_office = $value['status_office'];
                            if( $status_office == 'Y'){
                              echo "สนง.";
                            }else{
                              echo ";";
                            } 
                        ?>
                      </td>
                      <td class="text-center" ><?php echo $value['name']; ?></td>
                      <td class="text-center" ><?php echo $value['name_practice']; ?></td>
                      <td class="text-center" ><?php echo $value['money']; ?></td>
                      <td class="text-center" ><?php echo $value['name_category']; ?></td>
                      <td class="text-center" ><?php echo $value['date_buy']; ?></td>
                      <td class="text-center" ><?php echo Datethai3($value['date']); ?></td>
                      <td class="text-center" ><?php echo $value['customer']; ?></td>
                      <td class="text-center" ><?php echo $value['note']; ?></td>
                      <td class="text-center" ><a href="receive_money_edit2.php?id_receive_money=<?php echo $value['id_receive_money']; ?>" >>></a></td>
                    </tr>
                      <?php }?>
                  </tbody>
                </table>
                  <!-- //-boss -->
                  
                <br>
                <div class="box-header text-center with-border">
                  <font size="5">
                    <B align="center">เงินขาย (ค้างรับ)</B>
                  </font>
                </div>
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="text-center" width="25%"> <font color="red">หน่วยรถ</font> </th>
                      <th class="text-center" width="15%"> <font color="red">เงินสด</font> </th>
                      <th class="text-center" width="15%"> <font color="red">รับเช็ค</font> </th>
                      <th class="text-center" width="15%"> <font color="red">ขาย สกต.</font> </th>
                      <th class="text-center" width="15%"> <font color="red">เงินเชื่อ</font> </th>
                      <th class="text-center" width="15%"> <font color="red">ฝากขาย</font> </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-center"></td>
                      <?php 
                        $rc_category = "SELECT * FROM rc_category";
                        $objq_category = mysqli_query($conn,$rc_category);
                        while($value = $objq_category->fetch_assoc()){
                          $id_category = $value['id_category'];
                          $sql_sum = "SELECT SUM(money) FROM rc_receive_money WHERE id_category = $id_category AND status_office = 'N' AND status_boss = 'N'";
                          $objq_sum = mysqli_query($conn,$sql_sum);
                          $objr_sum = mysqli_fetch_array($objq_sum);
                      ?>
                      <td class="text-center"> <?php echo $objr_sum['SUM(money)']; ?> </td>
                        <?php } ?>
                    </tr>
                  </tbody>
                </table>
                <br>
                <br>
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="text-center" width="25%"> <font color="red">หน่วยขาย</font> </th>
                      <th class="text-center" width="15%"> <font color="red">เงินสด</font> </th>
                      <th class="text-center" width="15%"> <font color="red">รับเช็ค</font> </th>
                      <th class="text-center" width="15%"> <font color="red">ขาย สกต.</font> </th>
                      <th class="text-center" width="15%"> <font color="red">เงินเชื่อ</font> </th>
                      <th class="text-center" width="15%"> <font color="red">ฝากขาย</font> </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 

                    ?>
                    <tr>
                      <td class="text-center" >สนง.</td>
                    <?php 
                      $sql_category = "SELECT id_category FROM rc_category";
                      $objq_category1 = mysqli_query($conn,$sql_category);
                      while($value_category = $objq_category1->fetch_assoc()){
                        $id_category = $value_category['id_category'];
                        $sql_sum_of = "SELECT SUM(money) FROM rc_receive_money WHERE id_category = '$id_category' AND status_office = 'Y' AND status_boss = 'N'";
                        $objq_sum_of = mysqli_query($conn,$sql_sum_of);
                        $objr_sum_of = mysqli_fetch_array($objq_sum_of);
                        $of_money = $objr_sum_of['SUM(money)'];
                        if (isset($of_money) && !$of_money == 0) {
                          $value_rc = $of_money;
                        }else{
                              $value_rc = '-';
                        } 
                    ?>
                      <td class="text-center" ><?php echo $value_rc; ?></td>
                    <?php } ?>
                    </tr>
                    <?php 
                      $total_money = 0;
                        $sql_idmember = "SELECT * FROM member 
                                          WHERE status = 'employee'
                                          AND NOT id_member = 3
                                          AND NOT id_member = 8
                                          AND NOT id_member = 19";
                        $objq_member = mysqli_query($conn,$sql_idmember);
                        while($value = $objq_member->fetch_assoc()){
                          $id_member = $value['id_member'];
                          $name = $value['name'];
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $name;?></td>
                    <?php 
                      
                      $objq_category2 = mysqli_query($conn,$sql_category);
                      while($value_category = $objq_category2->fetch_assoc()){
                        $id_category = $value_category['id_category'];
                        $sql_sum_cr = "SELECT SUM(money) FROM rc_receive_money WHERE id_category = '$id_category' AND id_member = '$id_member' AND status_office = 'N'";
                        $objq_sum_cr = mysqli_query($conn,$sql_sum_cr);
                        $objr_sum_cr = mysqli_fetch_array($objq_sum_cr);
                        $rc_money = $objr_sum_cr['SUM(money)'];
                        if (isset($rc_money) && !$rc_money == 0) {
                          $value_rc = $rc_money;
                        }else{
                              $value_rc = '-';
                        } 
                    ?>
                          <td class="text-center" ><?php echo $value_rc; ?></td>
                    <?php } ?>
                    </tr>
                    
                    <?php 
                        }
                    ?>
                    <tr>
                      <th class="text-center"> <font color="red">รวมเงิน</font> </th>
                      <?php 
                      $objq_category3 = mysqli_query($conn,$sql_category);
                      while($value_category = $objq_category3->fetch_assoc()){
                        $id_category = $value_category['id_category'];
                        $sql_sum_tt = "SELECT SUM(money) FROM rc_receive_money WHERE id_category = '$id_category' AND status_boss = 'N'";
                        $objq_sum_tt = mysqli_query($conn,$sql_sum_tt);
                        $objr_sum_tt = mysqli_fetch_array($objq_sum_tt);
                        $tt_money = $objr_sum_tt['SUM(money)'];
                        if (isset($tt_money) && !$tt_money == 0) {
                          $value_tt = $tt_money;
                        }else{
                              $value_tt = 0;
                        } 
                    ?>
                      <th class="text-center" > <font color="red"><?php echo $value_tt; ?></font> </th>
                    <?php } ?>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
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
    $(function () {
      $('#example1').DataTable()
      $('#example2').DataTable({
          'paging'      : true,
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : false,
          'info'        : true,
          'autoWidth'   : false
        })
        $('#example3').DataTable({
          'paging'      : true,
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : true
        })
      }
    );
  </script>
</body>

</html>