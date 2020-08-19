<?php
  include("db_connect.php");
  $mysqli = connect();
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

  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <style>
    thead {
      color: rgb(255, 0, 0);
    }
    .button2 {
      background-color: #b35900;
      color : white;
      } /* Back & continue */
  </style>
</head>

<body class=" hold-transition skin-blue layout-top-nav ">
  <div class="wrapper">

    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="../dist/img/user.png" class="user-image" alt="User Image">
                
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="../dist/img/user.png" class="img-circle" alt="User Image">
                  
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-right">
                    <a href="../login/logout.php" class="btn btn-danger btn-flat">ออกจากระบบ</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <div class="content-wrapper">
      <section class="content">

        <div class="box box-primary">
          <div class="box-header text-center with-border">
            <div class="col-12">
              <div class="col-2 col-sm-2 col-xl-2 col-md-2 text-left">
                <a type="button" href="list_order.php" class="btn button2"><< กลับ</a>
              </div>
              <div class="col-8 col-sm-8 col-xl-8 col-md-8 text-center">
                <B align="center"> 
                  <font size="5"> จำนวน ORDER ค้างส่ง </font>
                  <font size="5" color="red">  
                    <?php 
                        $strDate = date('d-m-Y');
                        echo DateThai($strDate);
                    ?>
                  </font>
                </B>
                </font>
              </div>
              <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
            </div>
          </div> 
          <div class="box-body no-padding">
            <div class="mailbox-read-message">
              <table class="table">
                <thead>
                  <tr>
                  <th class="text-center" width="20%">สินค้า_หน่วย</th>
                  <th class="text-center" width="11%">เชียงใหม่</th>
                  <th class="text-center" width="11%">ลำปาง</th>
                  <th class="text-center" width="11%">พะเยา</th>
                  <th class="text-center" width="11%">เชียงราย</th>
                  <th class="text-center" width="11%">ลำพูน</th>
                  <th class="text-center" width="11%">แพร่</th>
                  <th class="text-center" width="11%">รวม</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                    $sql_pd = "SELECT * FROM product WHERE status_stock = 1";
                    $objq_pd = mysqli_query($mysqli,$sql_pd);
                    while ($value_pd = $objq_pd->fetch_assoc()) {
                    $id_product = $value_pd['id_product'];
                  ?>
                  <tr>
                    <td class="text-center"><?php echo $value_pd['name_product'].'_'.$value_pd['unit']; ?></td>
                    <?php 
                      $total_num = 0;
                      $sql_pv = "SELECT * FROM tbl_provinces";
                      $objq_pv = mysqli_query($mysqli,$sql_pv);
                      while($value_pv = $objq_pv -> fetch_assoc()){
                        $id_province = $value_pv['province_id'];
                        $sql_num = "SELECT SUM(num) FROM listorder INNER JOIN addorder ON listorder.id_addorder = addorder.id_addorder 
                                    WHERE listorder.id_product = $id_product AND addorder.province_id = $id_province AND addorder.status = 'pending'
                                    AND addorder.status_num = 'Y'";
                        $objq_num = mysqli_query($mysqli,$sql_num);
                        $objr_num = mysqli_fetch_array($objq_num);
                        $num = $objr_num['SUM(num)'];
                    ?>
                    <td class="text-center">
                      <?php 
                        if (!isset($num)) {
                          echo "-";
                        }else{
                          echo $num;
                        } 
                      ?>
                    </td>
                      <?php 
                      $total_num = $total_num + $num;
                      }
                      ?>
                    <td class="text-center" ><?php echo $total_num; ?></td>
                  </tr>
                  <?php 
                    }
                  ?>
                </tbody>
              </table>
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