<?php 
  require "../config_database/config.php";

  $list_order = $_POST['list_order'];
  $id_product = $_POST['id_product'];
  $num_product = $_POST['num_product'];
  $price = $_POST['price'];
  $money = $_POST['money'];
  $vat = $_POST['vat'];
  $date_order = $_POST['date_order'];
  $date_getorder = $_POST['date_getorder'];
  $name_sent = $_POST['name_sent'];
  $tel_sent = $_POST['tel_sent'];
  $catagory_car = $_POST['catagory_car'];
  $licent_plate = $_POST['licent_plate'];
  $name_author = $_POST['name_author'];

  $name_store = $_POST['name_store'];
  $amphur_id = $_POST['amphur_name'];
  $province_id = $_POST['province_name'];
  $name_to = $_POST['name_to'];
  $tel_to = $_POST['tel_to'];
  
  
  // $sql = "INSERT INTO order_list (list_order, id_product, num_product, price, money, vat, date_order, date_getorder,  name_sent, tel_sent, catagory_car,licent_plate, name_author, status, name_store, amphur_id, province_id, name_to, tel_to)
  //                     VALUES ('$list_order', $id_product,$num_product, $price, $money, '$vat', '$date_order','$date_getorder', '$name_sent', '$tel_sent', '$catagory_car','$licent_plate', '$name_author', 'done', '$name_store', $amphur_id, $province_id, '$name_to', '$tel_to')";
  // mysqli_query($conn,$sql);

  $sql_amphur = "SELECT * FROM tbl_amphures INNER JOIN tbl_provinces ON tbl_amphures.province_id = tbl_provinces.province_id
                WHERE tbl_amphures.amphur_id = $amphur_id";
  $objq_amphur = mysqli_query($conn,$sql_amphur);
  $objr_amphur = mysqli_fetch_array($objq_amphur);

  function DateThai($strDate)
  {
    $strYear = date("Y",strtotime($strDate))+543-2500;
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
</head>

<body class=" hold-transition skin-blue layout-top-nav">
  <div>
    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="../dist/img/user.png" class="user-image" alt="User Image">
                <span class="hidden-xs"></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="dist/img/user.png" class="img-circle" alt="User Image">

                  <p>
                    <small>สาขา : </small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-right">
                    <a href="login/logout.php" class="btn btn-danger btn-flat">ออกจากระบบ</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">

        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header text-center with-border">
              <font size="5">
                <B align="center"> ใบสั่งสินค้า <font color="red"> </font></B>
              </font>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                <form action="finish.php" method="post" autocomplete="off">
                  <div class="row">
                    <!-- ข้อมูลลูกค้า -->
                    <div class="col-md-4">
                      <div class="table-responsive">
                        <table class="table table-bordered">
                          <tr>
                            <th bgcolor="#99CCFF" width="25%">ใบสั่งที่ :</th>
                            <th width="85%"><?php echo $list_order; ?></th>
                          </tr>
                          <tr>
                            <th bgcolor="#99CCFF" width="25%">วันที่สั่ง :</th>
                            <th width="85%"><?php echo Datethai($date_order); ?></th>
                          </tr>
                          <tr>
                            <th bgcolor="#99CCFF" width="25%">รถเข้า รง. วันที่ :</th>
                            <th width="85%"><?php echo Datethai($date_getorder); ?></th>
                          </tr>
                          <tr>
                            <th bgcolor="#99CCFF" width="25%">สินค้า :</th>
                            <th width="85%"><?php echo $id_product; ?></th>
                          </tr>
                          <tr>
                            <th bgcolor="#99CCFF" width="25%">จำนวน_หน่วย  :</th>
                            <th width="85%"><?php echo $num_product; ?></th>
                          </tr>
                          <tr>
                            <th bgcolor="#99CCFF" width="25%">ราคา_หน่วย  :</th>
                            <th width="85%"><?php echo $price; ?></th>
                          </tr>
                          <tr>
                            <th bgcolor="#99CCFF" width="25%">เงินซื้อ(บ.)  :</th>
                            <th width="85%"><?php echo $money; ?></th>
                          </tr>
                          <tr>
                            <th bgcolor="#99CCFF" width="25%">ภาษี :</th>
                            <th width="85%"><?php echo $vat; ?></th>
                          </tr>
                          <tr>
                            <th bgcolor="#99CCFF" width="25%">ชื่อ พขร. :</th>
                            <th width="85%"><?php echo $name_sent; ?></th>
                          </tr>
                          <tr>
                            <th bgcolor="#99CCFF" width="25%">เบอร์ พขร. :</th>
                            <th width="85%"><?php echo $tel_sent; ?></th>
                          </tr>
                          <tr>
                            <th bgcolor="#99CCFF" width="25%">ประเภทรถ :</th>
                            <th width="85%"><?php echo $catagory_car; ?></th>
                          </tr>
                          <tr>
                            <th bgcolor="#99CCFF" width="25%">ทะเบียนรถ :</th>
                            <th width="85%"><?php echo $licent_plate; ?></th>
                          </tr>
                          <tr>
                            <th bgcolor="#99CCFF" width="25%">ผู้เขียนใบสั่ง :</th>
                            <th width="85%"><?php echo $name_author; ?></th>
                          </tr>
                        </table>
                      </div>
                    </div>

                    <!-- ข้อมูลสินค้้า -->
                    <div class="col-md-8">
                      <div class="table-responsive">
                        <table class="table table-bordered">
                          <tr>
                            <th bgcolor="#99CCFF" class="text-center" width="60%">จุดลงของ</th>
                            <th bgcolor="#99CCFF" class="text-center" width="20%">ผู้รับ</th>
                            <th bgcolor="#99CCFF" class="text-center" width="20%">เบอร์ผู้รับ</th>
                          </tr>
                          <tr>
                            <td  class="text-center"><?php echo  $name_store.'    '.'อ.'.$objr_amphur['amphur_name'].'     จ.'.$objr_amphur['province_name']; ?></td>
                            <td  class="text-center"><?php echo $name_to; ?></td>
                            <td class="text-center"><?php echo $tel_to; ?></td>
                          </tr>
                        </table>
                      </div>
                    </div>

                  </div>
              </div>
              <div class="box-footer">
                <a type="button" href="order.php" class="btn btn-danger"> <<== กลับสู่หน้าหลัก</a> 
                <a type="button" href="add_order.php" class="btn btn-success">เพิ่มใบสั่งสินค้า</a> 
              </div> 
              </div> 
            </form> 
          </div> 
          </div> 
        </section> 
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

</body>

</html>