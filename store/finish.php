<?php 
  require "../config_database/config.php";
  require "../session.php"; 
  
  $name_customer = $_POST['name_customer'];
  $id_province = $_POST['province_name'];
  $id_amphur = $_POST['amphur_name'];
  $id_district = $_POST['district_name'];
  $village = $_POST['village'];
  $tel = $_POST['tel'];
  $note = $_POST['note'];
  
  $insert_addorder = "INSERT INTO addorder (name_customer, tel, village, district_code, amphur_id, province_id, note, name_member, status)
                      VALUES ('$name_customer', '$tel', '$village', $id_district, $id_amphur, $id_province, '$note', '$username', 'pending')";
  mysqli_query($conn,$insert_addorder);
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
                    <div class="col-md-5">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="dynamic_field">
                          <tr>
                            <th bgcolor="#0099ff" width="25%">ชื่อ :</th>
                            <th width="85%"><?php echo $name_customer; ?></th>
                          </tr>
                          <tr>
                            <th bgcolor="#0099ff" width="25%">ที่อยู่ :</th>
                            <th width="85%">
                              <?php 
                                $sql_district = "SELECT * FROM tbl_districts WHERE district_code = $id_district";
                                $objq_district = mysqli_query($conn,$sql_district);
                                $objr_district = mysqli_fetch_array($objq_district);
                                
                                $sql_amphur = "SELECT * FROM tbl_amphures WHERE amphur_id = $id_amphur";
                                $objq_amphur = mysqli_query($conn,$sql_amphur);
                                $objr_amphur = mysqli_fetch_array($objq_amphur);

                                $sql_province = "SELECT * FROM tbl_provinces WHERE province_id = $id_province";
                                $objq_province = mysqli_query($conn,$sql_province);
                                $objr_province = mysqli_fetch_array($objq_province);

                                echo "$village".' '.'ต.'.$objr_district['district_name'].' '.'อ.'.$objr_amphur['amphur_name'].' '.'จ.'.$objr_province['province_name'];
                              ?>
                            </th>
                          </tr>
                          <tr>
                            <th bgcolor="#0099ff" width="25%">เบอร์โทร :</th>
                            <th width="85%"><?php echo $tel; ?></th>
                          </tr>
                          <tr>
                            <th bgcolor="#0099ff" width="25%">หมายเหตุ :</th>
                            <th width="85%"><?php echo $note; ?></th>
                          </tr>
                        </table>
                      </div>
                    </div>

                    <!-- ข้อมูลสินค้้า -->
                    <div class="col-md-7">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="dynamic_field">
                          <tr>
                            <th bgcolor="#0099ff" class="text-center" width="70%">สินค้า</th>
                            <th bgcolor="#0099ff" class="text-center" width="15%">จำนวน</th>
                          </tr>
                          <?php 
                            $num_product = COUNT($_POST['id_product']);
                            for ($i=0; $i < $num_product; $i++) { 

                                $id_product = $_POST['id_product'][$i];
                                $num = $_POST['num'][$i];

                                $seach_idaddorder = "SELECT MAX(id_addorder) AS id_addorder FROM addorder";
                                $objq_addorder = mysqli_query($conn,$seach_idaddorder);
                                $objr_addorder = mysqli_fetch_array($objq_addorder);
                                $id_addorder = $objr_addorder['id_addorder'];

                                $insert_listorder = "INSERT INTO listorder (id_product, num, id_addorder)
                                                    VALUES ($id_product, $num, $id_addorder)";
                                mysqli_query($conn,$insert_listorder);

                                $sql_product = "SELECT * FROM product WHERE id_product = $id_product";
                                $objq_product = mysqli_query($conn,$sql_product);
                                $objr_product = mysqli_fetch_array($objq_product);
                          ?>
                          <tr>
                            <td  class="text-center"><?php echo $objr_product['name_product'].'_'.$objr_product['unit']; ?></td>
                            <td class="text-center"><?php echo $num; ?></td>
                          </tr>
                          <?php
                            }
                          ?>
                        </table>
                      </div>
                    </div>

                  </div>
              </div>
              <div class="box-footer">
                <a type="button" href="sent_order.php" class="btn btn-danger"> <= หน้าหลัก</a> 
                <a type="button" href="add_order.php" class="btn btn-success">เพิ่มใบสั่งสินค้า</a> 
                </div> 
              </div> 
            </form> 
          </div> 
          </div> 
        </section> <!-- jQuery 3 -->
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