<?php
  require "../config_database/config.php";
  require "../session.php";
  require "menu/date.php";

  $aday = $_POST['aday'];
  $bday = $_POST['bday'];

  $list_product = "SELECT * FROM product WHERE status_stock = 1";
  $objq_product = mysqli_query($conn,$list_product);
  $objq_product2 = mysqli_query($conn,$list_product);
  $objq_product3 = mysqli_query($conn,$list_product);

  $member = "SELECT * FROM member 
             WHERE status = 'employee' AND NOT id_member = 28 AND NOT id_member = 32";
  $objq_member = mysqli_query($conn,$member);
?>

<!DOCTYPE html>
<html>

<head>
  <?php require('../font/font_style.php'); ?>
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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
      .button2 {
        background-color: #b35900;
        color : white;
        } /* Back & continue */
  </style>
</head>

<body class=" hold-transition skin-blue layout-top-nav ">
  <div class="wrapper">
    <header class="main-header">
      <?php require('menu/header_logout.php'); ?>
    </header>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <div class="box box-default">
                <div align="left">
                  <a href="admin.php" class="btn button2"><< เมนูหลัก</a>
                </div>
                <div class="box-header with-border">
                  <p align="center">
                    <font size="5">
                      <B>ยอดรับสินค้า ตั้งแต่
                      <font color="red"> <?php echo DateThai($aday); ?></font> 
                      ถึง 
                      <font color="red"> <?php echo DateThai($bday); ?></font> 
                      </B>
                    </font>
                  </p>
                </div>

                <div class="box-body with-border">
                  <!-- ------------------------------ยอดขายรวม---------------------------- -->
                  
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <td class="text-center" width="10%"><font color="red">สินค้า_หน่วย</font></td>
                        <?php 
                          while($value = $objq_member->fetch_assoc()){
                        ?>
                        <td class="text-center" width="5%"><font color="red"><?php echo $value['name_sub']; ?></font></td>
                        <?php 
                          }
                        ?>
                        <td class="text-center" width="6%"><font color="red">รวม</font></td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      
                        while($value = $objq_product->fetch_assoc()){
                          $id_product = $value['id_product'];
                      ?>
                      <tr>
                      <td class="text-center" ><?php echo $value['name_product'].'_'.$value['unit']; ?></td>
                      <?php 
                          $total_num = 0;
                          $member = "SELECT * FROM member 
                                    WHERE status = 'employee' AND NOT id_member = 28 AND NOT id_member = 32";
                          $objq_member2 = mysqli_query($conn,$member);
                          while($value_member = $objq_member2->fetch_assoc()){
                            
                            $id_member = $value_member['id_member'];
                            $sql_draw = "SELECT SUM(num_add) FROM add_history WHERE id_product = $id_product 
                                        AND id_member = $id_member AND (datetime between '$aday 00:00:00' and '$bday 23:59:59')";
                            $objq_draw = mysqli_query($conn,$sql_draw);
                            $objr_draw = mysqli_fetch_array($objq_draw);

                            if(isset($objr_draw['SUM(num_add)'])){
                              $num_draw = $objr_draw['SUM(num_add)'];
                              
                            }else{
                              $num_draw = "-";
                            }
                      ?>
                        <td class="text-center" ><?php echo $num_draw; ?></td>
                      <?php 
                        $total_num = $total_num + $objr_draw['SUM(num_add)'];
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
</body>

</html>