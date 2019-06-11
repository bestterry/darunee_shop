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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class=" hold-transition skin-blue layout-top-nav ">
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
  <div class="wrapper">
    <header class="main-header">
      <?php require('menu/header_logout.php');?>
    </header>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="height: 1000px;">
      <!-- Content Header (Page header) -->
      <section class="content-header">
      </section>

      <!-- Main content -->
      <section class="content">

        <div class="col-md-2"></div>
        <div class="col-md-8">
          <div class="box box-primary">
            <div class="box-header text-center with-border">
              <font size="5">
                <B align="center"> เบิกสินค้าจาก : <?php echo $objr_zone['name_zone'];?>   </B>
              </font>
            </div>
            <div class="text-right with-border">
              <font size="4">
                <B > ผู้เบิก : 
                        <?php 
                            $sql_member = "SELECT * FROM member WHERE id_member = '$_POST[id_member]'";
                            $objq_member = mysqli_query($conn,$sql_member);
                            $member = mysqli_fetch_array($objq_member);
                            echo $member['name']; 
                        ?>   
                </B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              </font>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                <form action="withdraw_product2.php" method="post">
                  <table class="table table-striped ">
                    <tbody>
                      <tr class="info" >
                        <th class="text-center" width="5%">เลือก
                        </th>
                        <th class="text-center" width="30%">สินค้า_หน่วย
                        </th>
                        <th class="text-center" width="15%">จำนวนที่มี
                        </th>
                      </tr>
                      <?php
                      $i=1;
                      $list_product = "SELECT * FROM product INNER JOIN num_product ON product.id_product = num_product.id_product WHERE num_product.id_zone = '$_POST[id_zone]'";
                      $objq_listproduct = mysqli_query($conn,$list_product);
                          while($list = $objq_listproduct->fetch_assoc()){
                      ?>
                      <tr>
                        <td class="text-center">
                          <input type="checkbox" name="id_num_product[]" value="<?php echo $list['id_numproduct']; ?>">
                        </td>
                        <td>
                          <?php echo $list['name_product'].'_'.$list['unit']; ?>
                        </td>
                        <td class="text-center">
                          <?php echo $list['num'];?>
                        </td>
                      </tr>
                      <?php 
                          $i++; }
                      ?>
                    </tbody>
                  </table>
                            <input type="hidden" name="id_zone" value="<?php echo $_POST['id_zone']; ?>">
                            <input type="hidden" name="name" value="<?php echo $member['name']; ?>">
                            <input type="hidden" name="id_member" value="<?php echo $member['id_member']; ?>">
              </div>
            </div>
            <div class="box-footer">
              <a type="block" href="admin.php" class="btn btn-success pull-left"><<== กลับสู่เมนูหลัก </a> 
              <button type="submit" class="btn btn-success pull-right">ต่อไป =>> </button>
            </div>
            </form>
            <!-- /.box-footer -->
          </div>
        </div>
    </div>
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