<?php
  require "../config_database/config.php";
  require 'menu/date.php';
  $id_outside = $_GET['id_outside'];
   $sql_noutside = "SELECT * FROM outside WHERE id_outside = $id_outside";
   $objq_noutside = mysqli_query($conn,$sql_noutside);
   $objr_noutside = mysqli_fetch_array($objq_noutside);
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
                    <a href="../pdf_file/outside_list.php?id_outside=<?php echo $id_outside;?>" class="btn btn-success">ประวัติชำระเงิน(PDF)</a>
                  </th>
                  <td width="50%" class="text-center"><font size="5"><B align="center"> ข้อมูลชำระเงิน (นอกเขต) </B></font></td>
                  <td width="20%"></td>
                </tr>
              </table>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                  <form action="algorithm/update_outside.php" class="form-horizontal" method="post" autocomplete="off" name="form1" onSubmit="JavaScript:return fncSubmit();">
                    <div class="col-md-12">
                      <div>
                        <table class="table table-bordered" id="dynamic_field">
                          <tr>
                            <th width="25%" class="text-right" ><font size="4">ชื่อลูกหนี้&nbsp;&nbsp;:</font></th>
                            <th width="25%">
                              <font size="4"><?php echo $objr_noutside['name'];?></font>
                              <input type="hidden" class="form-control" value="<?php echo $objr_noutside['name'];?>"  style="background-color: #e6f7ff;" readonly/>
                            </th>
                            <th width="25%" class="text-right" ><font size="4" valign="middle">จำนวนเงิน &nbsp;&nbsp;:</font></th>
                            <td width="25%">
                              <input type="number" name="pay_money" class="form-control" style="background-color: #e6f7ff;">
                              <input type="hidden" name="id_outside" value="<?php echo $id_outside; ?>">
                            </td>
                          </tr>
                          <tr>
                            <th width="25%" class="text-right"></th>
                            <th width="25%"></th>
                            <th width="25%" class="text-right"><font size="4">บัญชีรับโอน&nbsp;&nbsp;:</font></th>
                            <td width="25%"> <input type="text" name="account_rc" class="form-control" style="background-color: #e6f7ff;"></td>
                          </tr>
                          <tr>
                            <th width="25%" class="text-right"></th>
                            <th width="25%"></th>
                            <th width="25%" class="text-right"><font size="4">วันรับเงิน&nbsp;&nbsp;:</font></th>
                            <td width="25%"> <input type="date" name="date_buy" class="form-control" value="" style="background-color: #e6f7ff;"></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <div class="box-footer">
                    <table class="table table-bordered" >
                      <tr>
                        <th width="30%"> </th>
                        <td width="40%" class="text-center"><font size="5"><B align="center"> ประวัติการชำระเงิน </B></font></td>
                        <td class="text-center" width="30%"><button type="submit" class="btn btn-success" onClick="return confirm('คุณต้องการบันทึกข้อมูลหรือไม่?')";><i class="fa fa-save"></i> บันทึกข้อมูลชำระเงิน </button></td>
                      </tr>
                    </table>
                    </div>
                  </form>
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="example1">
                          <thead>
                            <tr>
                              <th bgcolor="#99CCFF" class="text-center" width="5%">ID</th>
                              <th bgcolor="#99CCFF" class="text-center" width="17%">สินค้า_หน่วย</th>
                              <th bgcolor="#99CCFF" class="text-center" width="8%">จำนวน</th>
                              <th bgcolor="#99CCFF" class="text-center" width="10%">บ/หน่วย</th>
                              <th bgcolor="#99CCFF" class="text-center" width="10%">เป็นเงิน</th>
                              <th bgcolor="#99CCFF" class="text-center" width="11%">ยอดชำระ</th>
                              <th bgcolor="#99CCFF" class="text-center" width="11%">บัญชีรับโอน</th>
                              <th bgcolor="#99CCFF" class="text-center" width="12%">วันที่</th>
                              <th bgcolor="#99CCFF" class="text-center" width="5%">edit</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                              $total_purch = 0;
                              $total_pay = 0;
                              $balance = 0;
                              $sql_outside = "SELECT * FROM outside_buy_htr 
                                              INNER JOIN product ON outside_buy_htr.id_product = product.id_product  
                                              WHERE outside_buy_htr.id_outside = $id_outside
                                              ORDER BY outside_buy_htr.id_outside_buy DESC";
                              $objq_outside = mysqli_query($conn,$sql_outside);
                              while($value = $objq_outside->fetch_assoc()){
                            ?>
                            <tr>
                              <td class="text-center"><?php echo $value['id_outside_buy']; ?></td>
                              <td class="text-center"><?php echo $value['name_product'].'_'.$value['unit']; ?></td>
                              <td class="text-center"><?php echo $value['num_pd']; ?></td>
                              <td class="text-center"><?php echo $value['price_pd']; ?></td>
                              <td class="text-center"><?php echo $value['purch_money']; ?></td>
                              <td class="text-center"><?php echo $value['pay_money']; ?></td>
                              <td class="text-center"><?php echo $value['account_rc']; ?></td>
                              <td class="text-center"><?php echo Datethai3($value['date_buy']); ?></td>
                              <td class="text-center"><a href="outside_list_edit.php?id_outside_buy=<?php echo $value['id_outside_buy']; ?>"><i class="fa fa-cog"></i></a></td>
                            </tr>
                            <?php
                            $total_purch = $total_purch + $value['purch_money'];
                            $total_pay = $total_pay + $value['pay_money'];
                             } 
                             ?>
                          </tbody>
                        </table>

                        <table class="table table-bordered" id="dynamic_field">
                          <tr>
                            <th width="25%" class="text-right" ><font size="4">รวมเงินซื้อ&nbsp;&nbsp;:</font></th>
                            <th width="25%"><font size="4" color="red"><?php echo $total_purch; ?></font></th>
                            <th width="25%" class="text-right" ><font size="4" valign="middle">รวมยอดชำระ&nbsp;&nbsp;:</font></th>
                            <th width="25%"><font size="4" color="red"><?php echo $total_pay; ?></font></th>
                          </tr>
                          <tr>
                            <th width="25%" class="text-right" ><font size="4">หนี้คงเหลือ&nbsp;&nbsp;:</font></th>
                            <th width="25%"><font size="4" color="red"><?php echo $total_purch - $total_pay; ?></font></th>
                            <th width="25%"  ></th>
                            <td width="25%"> </td>
                          </tr>
                        </table>

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