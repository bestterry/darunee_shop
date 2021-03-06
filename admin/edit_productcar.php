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
      <?php require('menu/header_logout.php');?>
    </header>

    <div class="content-wrapper">
      <section class="content-header">
      </section>

      <section class="content">
        <div class="row">
          <div class="col-12"> 
            <div class="box box-default">
              
              <div class="box-header with-border text-center">
                <font size="5"> <B> แก้ไขสินค้าในรถ</B> </font>
              </div>

              <div class="box-body with-border">
                <div class="row">
                  <div class="container">
                    <form action="algorithm/add_product2.php" method="post" autocomplete="off">
                      
                      <table class="table table-bordered">
                        <thead>
                          <tr bgcolor="#99CCFF">
                            <th class="text-center">ชื่อสินค้า</th>
                            <th class="text-center" width="15%">จำนวน</th>
                            <th class="text-center" width="12%">แก้ไข</th>
                            <th class="text-center" width="12%">ลบ</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php #endregion
                              $id_membercar = $_GET['id_membercar'];
                              $total_money = 0;
                              $date = "SELECT * FROM numpd_car INNER JOIN product ON numpd_car.id_product = product.id_product 
                                      WHERE numpd_car.id_member = $id_membercar";  
                              $objq = mysqli_query($conn,$date);
                              while($value = $objq ->fetch_assoc()){ 
                          ?>
                          <tr>
                            <td  class="text-center">
                              <?php echo $value['name_product'].'('.$value['unit'].')'; ?>
                            </td>
                            <td class="text-center">
                              <?php echo $value['num'];?>
                            </td>
                            <td class="text-center">
                              <a href="edit_productcar2.php?id_numPD_car=<?php echo $value['id_numPD_car'];?>&&id_membercar=<?php echo $id_membercar; ?>" type="button" class="btn btn-success btn-xs"><i class="fa fa-cog"></i></a>
                            </td>
                            <td class="text-center">
                              <a href="algorithm/delete_PDcar.php?id_numpd_car=<?php echo $value['id_numPD_car']; ?>" type="button" class="btn btn-danger btn-xs"><i class="fa fa-minus-square"></i></a>
                            </td>
                          </tr>
                          <?php
                            }
                          ?>
                        </tbody>
                      </table>

                    </form>
                  </div>
                </div>
              </div>

              <div class="box-footer">
              <a href="add_data.php" type="button" class="btn btn-danger"> <<กลับ </a>
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