<?php
  require "../config_database/config.php";
  require "../session.php";
  require "menu/date.php";

  $strDate = date('d-m-Y'); 
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
      <!-- Content Header (Page header) -->
      <section class="content-header">
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="text-center box-header with-border">
                <font size="5">
                  <B align="center"> จัดการสินค้าชำรุด </font></B>
              </div>
              <form action="withdraw_productwaste2.php" method="post">
                <div class="box-body col-md-12 table-responsive mailbox-messages">
                  <div class="col-12">
                    <div class="col-2 col-sm-2 col-xl-2 col-md-2 col-lg-4"></div>
                    <div class="col-8 col-sm-8 col-xl-8 col-md-8 col-lg-4">
                      <div class="table-responsive mailbox-messages">
                        <table class="table table-bordered">
                          <tbody>
                            <tr>
                              <th class="text-center" width="30%"><font size="3">เบิกจาก STOCK</font></th>
                              <th class="text-center" width="70%"> 
                                <select name ="id_zone" class="form-control text-center select2" style="width: 100%;">
                                    <?php #endregion
                                      $sql_member = "SELECT * FROM zone ";
                                      $objq_member = mysqli_query($conn,$sql_member);
                                      while($member = $objq_member -> fetch_assoc()){
                                          if ($member['id_zone']==8) {
                                              
                                          }else{
                                    ?>
                                      <option value="<?php echo $member['id_zone']; ?>"><?php echo $member['name_zone']; ?></option>
                                    <?php
                                          }   
                                      } 
                                    ?>
                                </select>
                              </th>
                            </tr>
                          </tbody>
                        </table> 
                        <br> 

                        <table class="table table-bordered">
                          <tbody>
                            <tr>
                              <th class="text-center" width="30%"><font size="3">สถานะสินค้า</font></th>
                              <th class="text-center" width="70%"> 
                                <select name ="status" class="form-control text-center select2" style="width: 100%;">
                                  <option value="normal">ปกติ</option>
                                  <option value="waste">ชำรุด</option>
                                </select>
                              </th>
                            </tr>
                          </tbody>
                        </table>
                        
                      </div>                
                    </div>
                    <div class="col-2 col-sm-2 col-xl-2 col-md-2 col-lg-4"></div>
                  </div>
                </div>
                <div class="box-footer">
                  <button type="submit"  class="btn button2 pull-right">ถัดไป >></button>
                  <a href="admin.php" type="button" class="btn button2 pull-left" ><< เมนูหลัก</a>
                </div>
              </form>
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
      $(document).ready( function() {
          var now = new Date();
      
          var day = ("0" + now.getDate()).slice(-2);
          var month = ("0" + (now.getMonth() + 1)).slice(-2);

          var today = now.getFullYear()+"-"+(month)+"-"+(day) ;


        $('#datePicker').val(today);
      });
  </script>
</body>

</html>