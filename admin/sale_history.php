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
</head>
<body class=" hold-transition skin-blue layout-top-nav ">
<div class="wrapper">
  <header class="main-header">
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
    </nav>
  </header>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <!-- Main content -->
    <section class="content">
    <?php 
      $list_product = "SELECT * FROM product";
      $query_product = mysqli_query($conn,$list_product);
      $query_product2 = mysqli_query($conn,$list_product);
    ?>
            <div class="box box-primary">
              <div class="box-header with-border">
                 <B>
                  <font size="4">
                     ประวัติการขายสินค้า ประจำวันที่(
                   <font size="4" color="red">
                    <?php echo $strDate = date('d-m-Y');?>
                   </font>) 
                  </font>
                 </B>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
              <!-- ------------------------------ร้านเวียงป่าเป้า---------------------------- -->
              
                <B>
                  <font size="4">
                     ร้านเวียงป่าเป้า
                  </font>
                </B>
                <table class="table table-bordered">
                  <tbody>
                    <tr bgcolor="#99CCFF">
                      <th class="text-center" width="35%">รายการ</th>
                      <th class="text-center" width="15%">จำนวน</th>
                      <th class="text-center" width="12%">บ/หน่วย</th>
                      <th class="text-center" width="13%">เงินขาย(บาท)</th>
                      <th class="text-center" width="20%">หมายเหตุ</th>
                    </tr>
          <?php #endregion
              $total_money = 0;
              $date = "SELECT * FROM product INNER JOIN price_history 
                        ON product.id_product = price_history.id_product 
                        WHERE DATE_FORMAT(price_history.datetime,'%d-%m-%Y')='$strDate'";
              $objq = mysqli_query($conn,$date);
              while($value = $objq ->fetch_assoc()){ 
          ?>
                    <tr>
                      <td>
                        <?php echo $value['name_product']; ?>
                      </td>
                      <td class="text-center">
                        <?php echo $value['num'];?>  
                        <?php echo $value['unit']; ?>
                      </td>
                      <td class="text-center">
                        <?php echo $value['price']; ?>
                      </td>
                      <td class="text-center">
                        <?php echo $value['money']; ?>
                      </td>
                      <td class="text-center">
                        <?php echo $value['note']; ?>
                      </td>
                    </tr>
              <?php
                  $total_money = $total_money + $value['money'];
                }
              ?>
                    <tr>
                      <td style="visibility:collapse;"></td>
                      <td style="visibility:collapse;"></td>
                      <th  bgcolor="#EAF4FF" class="text-center">รวมเป็นเงิน</th>
                      <th  bgcolor="#EAF4FF" class="text-center"><?php echo $total_money;?></th>
                      <td style="visibility:collapse;"></td>
                    </tr>
                  </tbody>
                </table>
                <!-- ------------------------------//ร้านเวียงป่าเป้า---------------------------- -->

                <?php for ($i=4; $i < 15; $i++) { 
                  $sql_member = "SELECT * FROM member WHERE id_member = $i";
                  $objq_member = mysqli_query($conn,$sql_member);
                  $objr_member = mysqli_fetch_array($objq_member);

                  $check = "SELECT * FROM product INNER JOIN sale_car_history
                            ON product.id_product = sale_car_history.id_product 
                            WHERE sale_car_history.id_member = $i AND DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate'";
                  $objq_check = mysqli_query($conn,$check);
                  $objr_check = mysqli_fetch_array($objq_check);
                  if(!isset($objr_check['num'])){

                  }else{
                ?>
                <B>
                  <font size="4">
                     <?php echo $objr_member['name']; ?>
                  </font>
                </B>
                <table class="table table-bordered">
                  <tbody>
                    <tr bgcolor="#99CCFF">
                      <th class="text-center" width="35%">รายการ</th>
                      <th class="text-center" width="15%">จำนวน</th>
                      <th class="text-center" width="12%">บ/หน่วย</th>
                      <th class="text-center" width="13%">เงินขาย(บาท)</th>
                      <th class="text-center" width="20%">หมายเหตุ</th>
                    </tr>
          <?php #endregion
          $total_money = 0;
                $SQL_product = "SELECT * FROM product INNER JOIN sale_car_history
                                ON product.id_product = sale_car_history.id_product 
                                WHERE sale_car_history.id_member = $i AND DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate'";
                $objq_product = mysqli_query($conn,$SQL_product);
                while($product = $objq_product -> fetch_assoc()){
          ?>
                    <tr>
                      <td>
                        <?php echo $product['name_product']; ?>
                      </td>
                      <td class="text-center">
                        <?php echo $product['num'];?>  
                        <?php echo $product['unit']; ?>
                      </td>
                      <td class="text-center">
                        <?php echo $product['price']; ?>
                      </td>
                      <td class="text-center">
                        <?php echo $product['money']; ?>
                      </td>
                      <td class="text-center">
                        <?php echo $product['note']; ?>
                      </td>
                    </tr>
          <?php 
                $total_money = $total_money + $product['money'];
               } 
          ?>
                    <tr>
                      <td style="visibility:collapse;"></td>
                      <td style="visibility:collapse;"></td>
                      <th  bgcolor="#EAF4FF" class="text-center">รวมเป็นเงิน</th>
                      <th  bgcolor="#EAF4FF" class="text-center"><?php echo $total_money;?></th>
                      <td style="visibility:collapse;"></td>
                    </tr>
                  </tbody>
                </table>
          <?php
                  } 
                }
          ?>
              </div>
            </div>
            <div class="box-footer" align="center">
              <a href="../pdf_file/admin_sale_history.php" class="btn btn-success"><i class="fa fa-print"> พิมพ์ </i></a>
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