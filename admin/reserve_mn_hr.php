<?php
  require "../config_database/config.php";
  require 'menu/date.php';

?>
<!DOCTYPE html>
<html>

<head>
  <?php require('../font/font_style.php'); ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>เพิ่ม ORDER ใหม่</title>
  <!-- Tell the browser to be responsive to screen width -->
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

  <script language="javascript">
    function fncSubmit()
    {
      if(document.form1.pay_money.value == "")
      {
        alert('กรุณากรอกจำนวนเงิน');
        document.form1.pay_money.focus();
        return false;
      }	
      if(document.form1.account_rc.value == "")
      {
        alert('กรุณาระบุบัญชีรับโอน');
        document.form1.account_rc.focus();
        return false;
      }	
      if(document.form1.date_buy.value == "")
      {
        alert('กรุณาระบุวันรับเงิน');
        document.form1.date_buy.focus();
        return false;
      }	
      document.form1.submit();
    }
  </script>
  
</head>

<body class=" hold-transition skin-blue layout-top-nav">
  <div class="wrapper">
    <header class="main-header">
    <?php //require('menu/header_logout.php');?>
    </header>
    
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
          
            <div class="box-header text-center with-border">
            <table class="table table-bordered" >
                <tr>
                  <th width="30%" >
                    <a type="block" href="outside.php" class="btn btn-danger"><< กลับ</a>
                  </th>
                  <td width="50%" class="text-center"><font size="5"><B align="center">ประวัติการเบิกเงิน</B></font></td>
                  <td width="20%"></td>
                </tr>
              </table>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
             
                  <br>
                    <div class="col-md-12">
                     <form action="outside_show.php?id_outside=<?php ?>" class="form-horizontal" method="post" autocomplete="off">
                      <div class="table-responsive mailbox-messages">
                        <table class="table table-bordered" id="example1">
                          <thead>
                            <tr>
                              <th bgcolor="#99CCFF" class="text-center" width="5%">ID</th>
                              <th bgcolor="#99CCFF" class="text-center" width="20%">วันที่</th>
                              <th bgcolor="#99CCFF" class="text-center" width="35%">รายการ</th>
                              <th bgcolor="#99CCFF" class="text-center" width="20%">จำนวนเงิน</th>
                              <th bgcolor="#99CCFF" class="text-center" width="20%">เงินคงเหลือ</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                             
                            ?>
                            <tr>
                              <td class="text-center"><?php  ?></td>
                              <td class="text-center"><?php  ?></td>
                              <td class="text-center"><?php  ?></td>
                              <td class="text-center"><?php  ?></td>
                              <td class="text-center"><?php  ?></td>
                              
                            </tr>
                            <?php
                             
                             ?>
                          </tbody>
                        </table>

                        <table class="table table-bordered" id="dynamic_field">
                          <!-- <tr>
                            <th width="25%" class="text-right" ><font size="4">รวมเงินซื้อ&nbsp;&nbsp;:</font></th>
                            <th width="25%"><font size="4" color="red"><?php echo $total_purch; ?></font></th>
                            <th width="25%" class="text-right" ><font size="4" valign="middle">รวมยอดชำระ&nbsp;&nbsp;:</font></th>
                            <th width="25%"><font size="4" color="red"><?php echo $total_pay; ?></font></th>
                          </tr> -->
                          <tr>
                            <th width="25%" class="text-right" ><font size="4">เงินคงเหลือ&nbsp;&nbsp;:</font></th>
                            <th width="25%"><font size="4" color="red"><?php  ?></font></th>
                            <th width="25%"></th>
                            <td width="25%" class="text-center"></td>
                          </tr>
                        </table>
                      </div>
                     </form>
                    </div>
              </div>
            </div>
          </div>
          </div>
        </div>
        </div>
      </section>
      </div>
    <!-- /.content-wrapper -->
        <?php require("../menu/footer.html"); ?>
      </div>

      <!-- jQuery 3 -->
      <script src="../bower_components/jquery/dist/jquery.min.js">
      </script>
      <!-- Bootstrap 3.3.7 -->
      <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js">
      </script>
      <!-- DataTables -->
      <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js">
      </script>
      <script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js">
      </script>
      <!-- SlimScroll -->
      <script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js">
      </script>
      <!-- FastClick -->
      <script src="../bower_components/fastclick/lib/fastclick.js">
      </script>
      <!-- AdminLTE App -->
      <script src="../dist/js/adminlte.min.js">
      </script>
      <!-- AdminLTE for demo purposes -->
      <script src="../dist/js/demo.js">
      </script>
      <script src="../plugins/iCheck/icheck.min.js">
      </script>
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