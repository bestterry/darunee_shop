<?php 
  require "../config_database/config.php";
  require "../session.php"; 
?>

<!DOCTYPE html>
<html>
<head>
<?php require('../font/font_style.php');?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ทีมงานคุณดารุณี</title>
    <link rel="icon" type="image/png" href="../images/favicon.ico"/>
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style>
#customers {
  
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
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
  <div class="content-wrapper" style="height: 850;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <!-- Main content -->
    <section class="content">
    <?php 
      $list_product = "SELECT * FROM product INNER JOIN numpd_car ON product.id_product = numpd_car.id_product WHERE numpd_car.id_member = $id_member";
      $query_product = mysqli_query($conn,$list_product);
      
    ?>
    <div class="col-md-3"></div>
    <div class="col-md-6">
            <div class="box box-primary">
              <div class="box-header text-center with-border">
                <font size="5">
                  <B> สินค้าคงเหลือบนรถ </B>
                </font>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                <table id="customers">
                  <tbody>
                    <tr>
                      <th class="text-center" width="10%">ลำดับ
                      </th>
                      <th class="text-center" width="40%">สินค้า_หน่วย
                      </th>
                      <th class="text-center" width="15%">จำนวน
                      </th>
                    </tr>
                    <?php 
                    $i=1;
                      while($product = $query_product ->fetch_assoc()){
                        
                    ?>
                    <tr>
                      <td class="text-center" width="10%">
                        <?php echo $i; ?>
                      </td>
                      <td width="40%">
                        <?php echo $product['name_product'].'_'.$product['unit']; ?>
                      </td>
                      <td class="text-center" width="15%">
                        <?php echo $product['num']; ?> 
                      </td>
                    </tr>
                      <?php $i++; } ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="box-footer">
            <a type="block" href="store.php" class="btn btn-success"><<= กลับหน้าหลัก </i></a>
            </div>
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
      $('.mailbox-messages input[type="checkbox"]').iCheck({
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
</body>
</html>
