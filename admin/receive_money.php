<?php 
  require "../config_database/config.php";
  require "../session.php"; 
  require "menu/date.php";
  $strDate = date('d-m-Y');
  $receive_money = "SELECT * FROM rc_receive_money 
                    INNER JOIN rc_practice ON rc_receive_money.id_practice = rc_practice.id_practice
                    INNER JOIN rc_category ON rc_receive_money.id_category = rc_category.id_category
                    INNER JOIN member ON rc_receive_money.id_member = member.id_member
                    GROUP BY rc_receive_money.id_receive_money DESC";
  $objq_receive = mysqli_query($conn,$receive_money);
  $objq_receive2 = mysqli_query($conn,$receive_money);
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
    #customers {
      
      width: 100%;
    }

    #customers td, #customers th {
      border: 1px solid #ddd;
      padding: 8px;
    }

    #customers tr:nth-child(even){background-color: #f2f2f2;}


    #customers th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: center;
      background-color: #99CCFF;
    
    }
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
                    <a type="button" href="admin.php" class="btn btn-danger "><< เมนูหลัก</a>
                    <a type="button" href="../pdf_file/receive_money.php" class="btn btn-success ">PDF</a>
                  </th>
                  <td width="40%" class="text-center"><font size="5"><B align="center"> เงินขายรายวัน </B></font></td>
                  <td width="30%"> </td>
                </tr>
              </table>
              <div class="mailbox-read-message">
              <?php 
                if ($id_member == 30) {
               ?>
                 <!-- boss -->
                 <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="text-center" width="5%">ลบ</th>
                        <th class="text-center" width="7%">ชื่อ</th>
                        <th class="text-center" width="5%">รับ</th>
                        <th class="text-center" width="7%">งาน</th>
                        <th class="text-center" width="5%">สนง</th>
                        <th class="text-center" width="7%">เงิน</th>
                        <th class="text-center" width="7%">รับ</th>
                        <th class="text-center" width="16%">วันขาย</th>
                        <th class="text-center" width="16%">วันรับ</th>
                        <!-- <th class="text-center" width="12%">พื้นที่</th> -->
                        <th class="text-center" width="20%">หมายเหตุ</th>
                        <th class="text-center" width="5%">edit</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        while($value = $objq_receive2 -> fetch_assoc()){
                      ?>
                      <tr>
                        <td class="text-center" > <a href="algorithm/delete_receive_money.php?id_receive_money=<?php echo $value['id_receive_money']; ?>" class="btn btn-danger btn-xs" onClick="return confirm('คุณต้องการที่จะลบข้อมูล <?php echo $value['name']; ?> หรือไม่ ?')";>X</a></td>
                        <td class="text-center" ><?php echo $value['name']; ?></td>
                        <td class="text-center" >
                          <?php 
                            $status_boss = $value['status_boss'];
                              if( $status_boss == 'Y'){
                          ?>
                          <a href="algorithm/receive_money.php?id_receive_money=<?php echo $value['id_receive_money']; ?>&&status=N&&statusb=boss" class="btn btn-success btn-xs" onClick="return confirm('คุณต้องการที่จะเปลี่ยนสถานะเป็นยังไม่ได้รับหรือไม่ ?')";>Y</a>
                          <?php
                              }else{
                          ?>
                          <a href="algorithm/receive_money.php?id_receive_money=<?php echo $value['id_receive_money']; ?>&&status=Y&&statusb=boss" class="btn btn-danger btn-xs" onClick="return confirm('คุณต้องการที่จะเปลี่ยนสถานะเป็นรับแล้วหรือไม่ ?')";>N</a>
                          <?php
                                echo "";
                              } 
                          ?>
                        </td>
                        <td class="text-center" ><?php echo $value['name_practice']; ?></td>
                        <td class="text-center" >
                          <?php 
                              $status = $value['status_office'];
                                if( $status == 'Y'){
                            ?>
                            <a href="algorithm/receive_money.php?id_receive_money=<?php echo $value['id_receive_money']; ?>&&status=N&&statusb=office" class="btn btn-success btn-xs" onClick="return confirm('คุณต้องการที่จะเปลี่ยนสถานะเป็นยังไม่ได้รับหรือไม่ ?')";>Y</a>
                            <?php
                                }else{
                            ?>
                            <a href="algorithm/receive_money.php?id_receive_money=<?php echo $value['id_receive_money']; ?>&&status=Y&&statusb=office" class="btn btn-danger btn-xs" onClick="return confirm('คุณต้องการที่จะเปลี่ยนสถานะเป็นรับแล้วหรือไม่ ?')";>N</a>
                            <?php
                                  echo "";
                                } 
                          ?>
                        </td>
                        <td class="text-center" ><?php echo $value['money']; ?></td>
                        <td class="text-center" ><?php echo $value['name_category']; ?></td>
                        <td class="text-center" ><?php echo $value['date_buy']; ?></td>
                        <td class="text-center" ><?php echo Datethai3($value['date']); ?></td>
                        <!-- <td class="text-center" ><?php echo $value['area']; ?></td> -->
                        <td class="text-center" ><?php echo $value['note']; ?></td>
                        <td class="text-center" > <a href="receive_money_edit.php?id_receive_money=<?php echo $value['id_receive_money']; ?>" class="fa fa-cog"></a></td>
                      </tr>
                        <?php }?>
                    </tbody>
                  </table>
                  <!-- //-boss -->

               <?php    
                 }else{
               ?>
                  <!-- สนง -->
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="text-center" width="5%">รับ</th>
                        <th class="text-center" width="8%">ชื่อ</th>
                        <th class="text-center" width="10%">งาน</th>
                        <th class="text-center" width="10%">เงินขาย</th>
                        <th class="text-center" width="8%">การรับ</th>
                        <th class="text-center" width="10%">วันขาย</th>
                        <th class="text-center" width="10%">วันรับ</th>
                        <th class="text-center" width="32%">หมายเหตุ</th>
                        <th class="text-center" width="7%">สนง</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        while($value = $objq_receive -> fetch_assoc()){
                      ?>
                      <tr>
                        <td class="text-center" >
                          <?php 
                            $status = $value['status_boss'];
                              if( $status == 'Y'){
                          ?>
                            <span class="label label-success pull-center"> Y </span>
                          <?php
                              }else{
                          ?>
                            <span class="label label-danger pull-center"> N </span>
                          <?php
                                echo "";
                              } 
                          ?>
                        </td>
                        <td class="text-center" ><?php echo $value['name']; ?></td>
                        <td class="text-center" ><?php echo $value['name_practice']; ?></td>
                        <td class="text-center" ><?php echo $value['money']; ?></td>
                        <td class="text-center" ><?php echo $value['name_category']; ?></td>
                        <td class="text-center" ><?php echo $value['date_buy']; ?></td>
                        <td class="text-center" ><?php echo Datethai3($value['date']); ?></td>
                        <td class="text-center" ><?php echo $value['note']; ?></td>
                        <td class="text-center" >
                          <?php 
                            $status = $value['status_office'];
                              if( $status == 'Y'){
                          ?>
                          <a href="algorithm/receive_money.php?id_receive_money=<?php echo $value['id_receive_money']; ?>&&status=N&&statusb=office" class="btn btn-success btn-xs" onClick="return confirm('คุณต้องการที่จะเปลี่ยนสถานะเป็นยังไม่ได้รับหรือไม่ ?')";>Y</a>
                          <?php
                              }else{
                          ?>
                          <a href="algorithm/receive_money.php?id_receive_money=<?php echo $value['id_receive_money']; ?>&&status=Y&&statusb=office" class="btn btn-danger btn-xs" onClick="return confirm('คุณต้องการที่จะเปลี่ยนสถานะเป็นรับแล้วหรือไม่ ?')";>N</a>
                          <?php
                                echo "";
                              } 
                          ?>
                        </td>
                      </tr>
                        <?php }?>
                    </tbody>
                  </table>
                  <!-- //สนง -->
              <?php     
                    }
              ?>
            
              <br>
              <br>
              <div class="box-header text-center with-border">
                <font size="5">
                  <B align="center">เงินขายอยู่กับ(ทีมส่ง) </B>
                </font>
              </div>
              <table id="customers">
                <tbody>
                  <tr>
                    <th class="text-center" width="20%">เงินสด</th>
                    <th class="text-center" width="20%">รับเช็ค</th>
                    <th class="text-center" width="20%">สกต.</th>
                    <th class="text-center" width="20%">เงินเชื่อ</th>
                    <th class="text-center" width="20%">ฝากขาย</th>
                  </tr>
                  <tr>
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
                <div class="box-header text-center with-border">
                  <font size="5">
                    <B align="center">เงินขายอยู่กับ(สำนักงาน)</B>
                  </font>
                </div>
                <table id="customers">
                  <tbody>
                    <tr>
                      <th class="text-center" width="20%">เงินสด</th>
                      <th class="text-center" width="20%">รับเช็ค</th>
                      <th class="text-center" width="20%">สกต.</th>
                      <th class="text-center" width="20%">เงินเชื่อ</th>
                      <th class="text-center" width="20%">ฝากขาย</th>
                    </tr>
                    <tr>
                      <?php 
                        $rc_category = "SELECT * FROM rc_category";
                        $objq_category = mysqli_query($conn,$rc_category);
                        while($value = $objq_category->fetch_assoc()){
                          $id_category = $value['id_category'];
                          $sql_sum = "SELECT SUM(money) FROM rc_receive_money WHERE id_category = $id_category AND status_office = 'Y' AND status_boss = 'N'";
                          $objq_sum = mysqli_query($conn,$sql_sum);
                          $objr_sum = mysqli_fetch_array($objq_sum);
                      ?>
                      <td class="text-center"> <?php echo $objr_sum['SUM(money)']; ?> </td>
                        <?php } ?>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="box-footer">
               
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
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      }
                              )
    }
    )
    $(function () {
      //Enable iCheck plugin for checkboxes
      //iCheck for checkbox and radio inputs
      $('.mailbox-read-message input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
      }
                                              );
      //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
      //Enable check and uncheck all functionality
      $(".checkbox-toggle").click(function () {
        var clicks = $(this).data('clicks');
        if (clicks) {
          //Uncheck all checkboxes
          $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
          $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
        }
        else {
          //Check all checkboxes
          $(".mailbox-messages input[type='checkbox']").iCheck("check");
          $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
        }
        $(this).data("clicks", !clicks);
      }
                        );
      //Handle starring for glyphicon and font awesome
      $(".mailbox-star").click(function (e) {
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
      }
                              );
                              
    }
    );
    </script>
    <script>
    $(function () {
      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      })
    })
  </script>
</body>

</html>