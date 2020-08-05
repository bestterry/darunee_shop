<?php 
    require "../config_database/config.php"; 
    require "../session.php";
    $sql_zone = "SELECT name_zone FROM zone  WHERE id_zone = '$_POST[id_zone]'";
    $objq_zone = mysqli_query($conn,$sql_zone);
    $objr_zone = mysqli_fetch_array($objq_zone);
 ?>

<!DOCTYPE html>
<html>

<head>
  <?php require('../font/font_style.php');?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>โปรแกรมขายหน้าร้าน</title>
  <!-- Tell the browser to be responsive to screen width -->
  <!-- Bootstrap 3.3.7 -->
  <link rel="icon" type="image/png" href="../images/favicon.ico" />
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
  <script language="javascript">
    function fncSubmit() {
      if (document.form1.add_num.value == "") {
        alert('กรุณาระบุจำนวน');
        document.form1.num.focus();
        return false;
      }
      if (document.form1.name.value == "") {
        alert('กรุณาระบุชื่อผู้รับเข้าสินค้า');
        document.form1.name.focus();
        return false;
      }
      document.form1.submit();
    }
  </script>
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
      <!-- Content Header (Page header) -->
      <section class="content-header">
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header text-center with-border">
              <font size="5">
                <B align="center">รับสินค้าเข้า : <?php echo $objr_zone['name_zone'];?></B>&nbsp;&nbsp;&nbsp;&nbsp;
                <B > ผู้ส่ง : <?php echo $_POST['name']; ?> </B>
              </font>
            </div>
            <form action="algorithm/add_product.php" method="post" autocomplete="off">
              <div class="box-body no-padding">
                <div class="col-12">
                  <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
                  <div class="col-8 col-sm-8 col-xl-8 col-md-8">
                    <div class="mailbox-read-message">
                      <table class="table table-bordered">
                              <tbody>
                          <?php 
                              $id_member = $_POST['id_member'];
                              if($id_member == 19){
                            ?>
                          <tr class="info">
                            <th class="text-center" width="5%">ลำดับ
                            </th>
                            <th class="text-center" width="35%">ชื่อสินค้า
                            </th>
                            <th class="text-center" width="20%">หน่วยนับ
                            </th>
                            <th class="text-center" width="20%">จำนวนสินค้ารับเข้า
                            </th>
                          </tr>
                          <?php
                        for ($i=0; $i < count($_POST['id_product']); $i++) { 
                          
                              $id_product = $_POST['id_product'][$i];
                              $list_product = "SELECT * FROM product  WHERE id_product = $id_product";
                              $objq_listproduct = mysqli_query($conn,$list_product);
                              $list = mysqli_fetch_array($objq_listproduct);
                          ?>
                          <tr>
                            <td class="text-center">
                              <?php echo $i+1; ?>
                              <input type="hidden" name="id_product[]" value="<?php echo $list['id_product']; ?>">
                            </td>
                            <td>
                              <?php echo $list['name_product']; ?>
                            </td>
                            <td class="text-center">
                              <?php echo $list['unit'];?>
                            </td>
                            <td class="text-center">
                              <input class="text-center" type="text" name="num_after[]" placeholder="0">
                            </td>
                          </tr>
                          <?php 
                            }
                              }
                          
                              else{
                            ?>
                          <tr>
                            <th class="text-center" width="33%"> <font color="red">สินค้า_หน่วย</font>
                            </th>
                            <th class="text-center" width="33%"> <font color="red">จำนวนที่มี</font>
                            </th>
                            <th class="text-center" width="33%"> <font color="red">จำนวนรับเข้า</font>
                            </th </tr> <?php
                        for ($i=0; $i < count($_POST['id_numpd_car']); $i++) { 
                          
                              $numpd_car = $_POST['id_numpd_car'][$i];
                              $list_product = "SELECT * FROM product INNER JOIN numpd_car ON product.id_product = numpd_car.id_product WHERE numpd_car.id_numPD_car = $numpd_car";
                              $objq_listproduct = mysqli_query($conn,$list_product);
                              $list = mysqli_fetch_array($objq_listproduct);
                          ?> <tr>
                            <td class="text-center">
                              <input type="hidden" name="id_numpd_car[]" value="<?php echo $list['id_numPD_car']; ?>">
                              <input type="hidden" name="id_product[]" value="<?php echo $list['id_product']; ?>">
                              <?php echo $list['name_product'].'_'.$list['unit']; ?>
                            </td>
                            <td class="text-center">
                              <?php echo $list['num'];?>
                              <input type="hidden" name="num_befor[]" value="<?php echo $list['num']; ?>">
                            </td>
                            <td class="text-center">
                              <input class="text-center form-control" type="text" name="num_after[]" placeholder="0">
                            </td>
                          </tr>
                          <?php 
                            }
                              }
                          ?>
                        </tbody>
                      </table>
                      <div class="col-md-12">
                        <table class="table table-bordered">
                          <tbody>
                            <tr>
                              <th class="text-center">หมายเหตุ : <input size="50" class="text-center" type="text" name="note" value="-">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            </tr>
                          </tbody>
                        </table>
                        <input type="hidden" name="id_zone"   value="<?php echo $_POST['id_zone']; ?>">
                        <input type="hidden" name="id_member" value="<?php echo $_POST['id_member']; ?>">
                      </div>
                    </div>                  
                  </div>
                  <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
              </div>
              <div class="box-footer">
                <div class="col-12">
                  <div class="col-4 col-sm-4 col-xl-4 col-md-4">
                    <a type="block" href="add_history.php" class="btn button2"><< กลับ</a> 
                  </div>
                  <div class="col-4 col-sm-4 col-xl-4 col-md-4 text-center">
                    <button type="submit" class="btn btn-success center" onClick="return confirm('คุณต้องการที่จะบันทึกข้อมูลนี้หรือไม่ ?')";> รับสินค้าเข้า</button>
                  </div>
                  <div class="col-4 col-sm-4 col-xl-4 col-md-4"></div>
                </div>
              </div>
            </form>
          </div>
          <!-- /. box -->
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
    $('.mailbox-read-message input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });
    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function() {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-read-message input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-read-message input[type='checkbox']").iCheck("check");
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