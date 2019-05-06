<?php 
  require "../config_database/config.php";
  require "../session.php"; 
  $strDate = date('d-m-Y');
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
      <?php require('menu/header_logout.php');?>
    </header>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
      </section>
      <!-- Main content -->
      <section class="content">
        <?php 
      $list_product = "SELECT * FROM product INNER JOIN numpd_car ON product.id_product = numpd_car.id_product WHERE numpd_car.id_member = $id_member";
      $query_product = mysqli_query($conn,$list_product);
      $query_product2 = mysqli_query($conn,$list_product);
      require 'menu/menu_left_shop.php'; 

      $list_product = "SELECT * FROM product";
      $query_product = mysqli_query($conn,$list_product);
      $query_product2 = mysqli_query($conn,$list_product);
    ?>
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header text-center with-border">
              <font size="5">
                <B align="center"> ยอดจำหน่าย 
                <font size="5" color="red">
                  <?php 
                  function DateThai($strDate)
                  {
                    $strYear = date("Y",strtotime($strDate))+543;
                    $strMonth= date("n",strtotime($strDate));
                    $strDay= date("j",strtotime($strDate));
                    $strHour= date("H",strtotime($strDate));
                    $strMinute= date("i",strtotime($strDate));
                    $strSeconds= date("s",strtotime($strDate));
                    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
                    $strMonthThai=$strMonthCut[$strMonth];
                    return "$strDay $strMonthThai $strYear";
                  }
                        $strDate = date('d-m-Y');
                        echo DateThai($strDate);
                  ?>
                 </font>
              </font>
              </B>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
              <table class="table table-bordered">
                <tbody>
                  <tr bgcolor="#99CCFF">
                    <th class="text-center" width="15%">ชื่อทีมงาน</th>
                    <th class="text-center" width="5%">รวมเงิน(บ)</th>
                    <th class="text-center" width="5%">Soft HOMDY(ลัง)</th>
                    <th class="text-center" width="5%">Soft HOMDY(ขวด)</th>
                  </tr>
                  <?php 
                    $sql_wp = "SELECT SUM(money) FROM price_history WHERE id_zone = 1 AND DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate'";
                    $objq_wp = mysqli_query($conn,$sql_wp);
                    $objr_wp = mysqli_fetch_array($objq_wp);
                    $sum_wp = $objr_wp['SUM(money)'];

                    //soft ลัง ร้านเวียง
                    $sql_wp_soft1 = "SELECT SUM(num) FROM price_history WHERE id_zone = 1 AND DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate' AND id_product = 1";
                    $objq_wp_soft1 = mysqli_query($conn,$sql_wp_soft1);
                    $objr_wp_soft1 = mysqli_fetch_array($objq_wp_soft1);
                    $sum_wp_soft1 = $objr_wp_soft1['SUM(num)'];
                    //soft ลัง ร้านเวียง

                    //soft ขวด ร้านเวียง
                    $sql_wp_soft2 = "SELECT SUM(num) FROM price_history WHERE id_zone = 1 AND DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate' AND id_product = 2";
                    $objq_wp_soft2 = mysqli_query($conn,$sql_wp_soft2);
                    $objr_wp_soft2 = mysqli_fetch_array($objq_wp_soft2);
                    $sum_wp_soft2 = $objr_wp_soft2['SUM(num)'];
                    //soft ขวด ร้านเวียง
                  ?>
                  <tr>
                    <td class="text-center" width="15%">เวียงป่าเป้า</td>
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
                    <th class="info text-right">รวมเงินทั้งหมด</th>
                    <th class="info text-center"><?php echo $total_money+$sum_wp;?></th>
                    <th class="info text-center"><?php echo $total_numsoft1+$sum_wp_soft1; ?></th>
                    <th class="info text-center"><?php echo $total_numsoft2+$sum_wp_soft2;?></th>
                </tbody>
              </table>
              </div>
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