<?php 
  include("../config_database/config.php");
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

    $id_addorder = $_GET['id_addorder'];
    $sql_addorder = "SELECT * FROM addorder 
                    INNER JOIN tbl_districts ON addorder.district_code = tbl_districts.district_code
                    INNER JOIN tbl_amphures ON addorder.amphur_id = tbl_amphures.amphur_id
                    INNER JOIN tbl_provinces ON addorder.province_id = tbl_provinces.province_id
                    WHERE addorder.id_addorder = $id_addorder";
    $objq_addorder = mysqli_query($conn,$sql_addorder);
    $objr_addorder = mysqli_fetch_array($objq_addorder);


?>
<!DOCTYPE html>
<html>

<head>
  <?php require('../font/font_style.php'); ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>โปรแกรมขายหน้าร้าน</title>
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
  <style>
          #customers {
            
            width: 100%;
          }

          #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
          }

          #customers tr:nth-child(even){background-color: #f2f2f2;}


          #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #99CCFF;
          
          }
        </style>
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
                    <div class="col-md-5">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="dynamic_field">
                          <tr>
                            <th bgcolor="#99CCFF" width="25%">ชื่อ :</th>
                            <th width="85%"><?php echo $objr_addorder['name_customer']; ?></th>
                          </tr>
                          <tr>
                            <th bgcolor="#99CCFF" width="25%">ที่อยู่ :</th>
                            <th width="85%">
                              <?php 
                                echo 'บ.'.$objr_addorder['village'].' '.'ต.'.$objr_addorder['district_name'].' '.'อ.'.$objr_addorder['amphur_name'].' '.'จ.'.$objr_addorder['province_name'];
                              ?>
                            </th>
                          </tr>
                          <tr>
                            <th bgcolor="#99CCFF" width="25%">เบอร์โทร :</th>
                            <th width="85%"><?php echo $objr_addorder['tel']; ?></th>
                          </tr>
                          <tr>
                            <th bgcolor="#99CCFF" width="25%">วันที่สั่ง :</th>
                            <th width="85%">
                              <?php 
                                echo DateThai($objr_addorder['datetime']);
                              ?>
                            </th>
                          </tr>
                        </table>
                      </div>
                    </div>

                    <!-- ข้อมูลสินค้้า -->
                    <div class="col-md-7">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="dynamic_field">
                          <tr>
                            <th bgcolor="#99CCFF" class="text-center" width="70%">สินค้า</th>
                            <th bgcolor="#99CCFF" class="text-center" width="15%">จำนวน</th>
                          </tr>
                          <?php 
                                $total_money = 0;
                                $seach_listorder = "SELECT * FROM listorder 
                                                    INNER JOIN product ON listorder.id_product = product.id_product
                                                    WHERE listorder.id_addorder = $id_addorder";
                                $objq_listorder = mysqli_query($conn,$seach_listorder);
                                while($value = $objq_listorder->fetch_assoc()){
                          ?>
                          <tr>
                            <td><?php echo $value['name_product'].'_'.$value['unit']; ?></td>
                            <td class="text-center"><?php echo $value['num']; ?></td>
                          </tr>
                          <?php
                           } 
                          ?>
                        </table>
                      </div>
                    </div>

                  </div>
              </div>
              <div align="left" class="box-footer">
                <a type="button" href="sent_order.php" class="btn btn-success">
                  <<== กลับ</a> </div> </div> </form> </div> </div> </section> <!-- jQuery 3 -->
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