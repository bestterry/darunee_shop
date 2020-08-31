<?php 
    require "../config_database/config.php"; 
    require "../session.php";
    $status = $_POST['status'];
?>

<!DOCTYPE html>
<html>

  <head>
    <?php require('../font/font_style.php');?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>โปรแกรมขายหน้าร้าน</title>
    <!-- Tell the browser to be responsive to screen width -->
    <!-- Bootstrap 3.3.7 -->
    <link rel="icon" type="image/png" href="../images/favicon.ico" />
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
        <?php require('menu/header_logout.php');?>
      </header>
      <div class="content-wrapper">
        <section class="content-header">
        </section>
        <section class="content">
          <div class="row">
            <div class="col-12 col-sm-12 col-xl-12 col-md-12">
              <div class="box box-primary">
                <form action="algorithm/withdraw_productwaste.php" method="post">
                  <div class="box-header text-center with-border">
                    <font size="5"><B>
                      <?php 
                        if($status == 'normal'){
                          echo 'แยกสินค้าชำรุด'.' : '.$_POST['name'];
                        }else{
                          echo 'แยกสินค้าชำรุด'.' : '.$_POST['name'];
                        }
                      ?>
                    </B></font>
                  </div>
                  <div class="box-body no-padding">
                    <div class="col-12">
                      <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
                      <div class="col-8 col-sm-8 col-xl-8 col-md-8">
                          <div class="mailbox-read-message">
                            <table class="table table-bordered">
                              <tbody>
                                <tr>
                                  <th class="text-center" width="33%"><font color="red">สินค้า_หน่วย</font></th>
                                  <th class="text-center" width="33%"><font color="red">จำนวนที่มี</font> </th>
                                  <th class="text-center" width="33%"><font color="red">จำนวนชำรุด</font></th>
                                </tr>
                                <?php
                                  for($i=0;$i<count($_POST['id_numproduct']);$i++){
                                      $id_numproduct = $_POST['id_numproduct'][$i];
                                    if ($status == 'normal') {
                                      $list_product = "SELECT * FROM num_product INNER JOIN product ON product.id_product = num_product.id_product 
                                                       WHERE num_product.id_numproduct = $id_numproduct";
                                      $objq_listproduct = mysqli_query($conn,$list_product);
                                      $objr_listproduct = mysqli_fetch_array($objq_listproduct);
                                    }else {
                                      $list_product = "SELECT * FROM num_productwaste INNER JOIN product ON product.id_product = num_productwaste.id_product 
                                                       WHERE num_productwaste.id_numproductwaste = $id_numproduct";
                                      $objq_listproduct = mysqli_query($conn,$list_product);
                                      $objr_listproduct = mysqli_fetch_array($objq_listproduct);
                                    }
                                ?>
                                <tr>
                                  <td class="text-center"><?php echo $objr_listproduct['name_product'].'_'.$objr_listproduct['unit']; ?></td>
                                  <td class="text-center"><?php echo $objr_listproduct['num']; ?></td>
                                  <td class="text-center">
                                    <input class="text-center form-control" type="text" name="num_after[]" placeholder="0">
                                    <input type="hidden" name="num_befor[]" value="<?php echo $objr_listproduct['num'];?>">
                                    <input type="hidden" name="id_numproduct[]" value="<?php echo $id_numproduct; ?>">
                                    <input type="hidden" name="id_product[]" value="<?php echo $objr_listproduct['id_product']; ?>">
                                  </td>
                                </tr>
                                <?php 
                                  }
                                ?>
                              </tbody>
                            </table>
                            <input type="hidden" name="id_zone" value="<?php echo $_POST['id_zone']; ?>">
                            <input type="hidden" name="status" value="<?php echo $status; ?>">
                          </div>
                        </div>
                      <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
                    </div>
                  </div>
                  <div class="box-footer">
                    <a type="block" href="withdraw_productwaste.php" class="btn button2 pull-left"><< กลับ</a> 
                    <button type="submit" class="btn btn-success pull-right">บันทึก </button>
                  </div>
                </form>
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
    });
  
    </script>
  </body>

</html>