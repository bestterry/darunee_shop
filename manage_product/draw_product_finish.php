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
    <title>โปรแกรมขายหน้าร้าน
    </title>
    <!-- Tell the browser to be responsive to screen width -->
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
          <div class="col-md-2">
          </div>
          <div class="col-md-8">
            <div class="box box-primary">
              <div class="box-header with-border">
                <font size="6">
                  <p align = "center"> รายการรับเข้าสินค้า
                </font>
                </p>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                <form action="../pdf_file/draw_add.php?status=draw" method="post" target="_blank" autocomplete="off">
                  <table class="table table-bordered table-hover">
                    <tbody>
                      <tr bgcolor="#99CCFF">
                        <th class="text-center" width="5%">ลำดับ
                        </th>
                        <th class="text-center" >ชื่อสินค้า
                        </th>
                        <th class="text-center" width="15%" >จำนวนสินค้าที่เบิก
                        </th>
                        <th class="text-center" width="10%" >หน่วยนับ
                        </th>
                      </tr>
                      <?php //คำนวณสรายการสินค้า
$id_member = $_POST['id_member'];
$sql_member = "SELECT * FROM member WHERE id_member = $id_member";
$objq_member = mysqli_query($conn,$sql_member);
$objr_member = mysqli_fetch_array($objq_member);
$total_price_money = 0;
for($i=0;$i<count($_POST['id_product']);$i++){
               $id_numproduct = $_POST['id_product'][$i];
               $num_product = $_POST['num_product'][$i];
    
               $num_product_instore = "SELECT * FROM num_product INNER JOIN product ON num_product.id_product = product.id_product WHERE num_product.id_numproduct='$id_numproduct' AND num_product.id_zone='$id_zone'";
               $objq_num_product_instore = mysqli_query($conn,$num_product_instore);
               $objr_num_product_instore = mysqli_fetch_array($objq_num_product_instore);
               $total_num_product = $objr_num_product_instore['num']-$num_product;
               $name_product = $objr_num_product_instore['name_product'];
               $id_product = $objr_num_product_instore['id_product'];
               $unit = $objr_num_product_instore['unit'];
               if($total_num_product < 0){
          echo "สินค้ามีจำนวนไม่เพียงพอ";

                }else{
                      //Update NUM product in database
                      $update_num_product = "UPDATE num_product SET num = $total_num_product WHERE id_numproduct = $id_numproduct AND id_zone=$id_zone";
                      $objq_update = mysqli_query($conn,$update_num_product);
                      //INsert history buy product
                      $insert_history = "INSERT INTO draw_history (num_draw, id_product, id_member, note, id_zone)
                      VALUES ( $num_product,$id_product,$id_member,'-',$id_zone)";
                      mysqli_query($conn,$insert_history);
                      //Insert numPD_car
                      $seach_product = "SELECT * FROM numpd_car WHERE id_product = $id_product AND id_member = $id_member";
                      $objq_seach = mysqli_query($conn,$seach_product);
                      $objr_seach = mysqli_fetch_array($objq_seach);
                      $id_numpd_car = $objr_seach['id_numPD_car'];
                      $num = $objr_seach['num'];
                          if(isset($objr_seach)){
                            $total_PD = $num + $num_product;
                            $update_numpd_car = "UPDATE numpd_car SET num = $total_PD WHERE id_numpd_car = $id_numpd_car ";
                            mysqli_query($conn,$update_numpd_car);
                          }else{
                            $insert_numPD_car = "INSERT INTO numpd_car (num, id_product, id_member)
                            VALUES ( $num_product,$id_product,$id_member)";
                            mysqli_query($conn,$insert_numPD_car);
                          }

?>
                      <tr>
                        <td class="text-center" >
                          <?php echo $i+1 ?>
                        </td>
                        <td >
                          <?php echo $name_product; ?>
                        </td>
                        <td class="text-center" >
                          <?php echo $num_product; ?>
                        </td>
                        <td class="text-center" >
                          <?php echo $unit; ?>
                        </td>
                        <input class ="hidden" type="text" name="name_product[]" value="<?php echo $name_product; ?>">
                        <input class ="hidden" type="text" name="unit[]" value="<?php echo $num_product; ?>">
                        <input class ="hidden" type="text" name="num_product[]" value="<?php echo $unit; ?>">
                      </tr>
      <?php
          }
        }
       ?>
                    </tbody>
                  </table>
                  <div class="col-md-6">
                  </div>
                  <div class="col-md-6">
                    <table class="table table-bordered table-hover">
                      <tbody>
                        <tr>
                          <th class="text-center">ชื่อผู้เบิกสินค้า
                          </th>
                          <th bgcolor="#99CCFF" class="text-center"> 
                            <?php echo $objr_member['name']; ?>
                            <input class ="hidden" type="text" name="name" value="<?php echo $objr_member['name']; ?>">
                          </th>
                        </tr>
                      </tbody>
                    </table>
                  </div> 
                  </div>
              </div>
              <!-- /.mailbox-read-message -->
              <!-- /.box-footer -->
              <div class="box-footer">
                  <a href="../product.php" class="btn btn-success pull-left" ><i class="fa fa-arrow-left"> กลับ </i></a>
                  <button type="submit" class="btn btn-success pull-right" ><i class="fa fa-print"> พิมพ์  </i></button>
              </div>
              </form>
            <!-- /.box-footer -->
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
