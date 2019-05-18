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
      <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <font size="6"><p align = "center"> รายการขายสินค้า </font></p>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <div class="mailbox-read-message">
                  <form action="sale_product_finish.php" method="post" autocomplete="off">
                    <table class="table table-bordered">
                        <tbody>
                          <tr bgcolor="#99CCFF">
                            <th class="text-center" width="5%" >ลำดับ</th>
                            <th class="text-center" >สินค้า_หน่วย</th>
                            <th class="text-center" width="15%">จำนวน</th>
                            <th class="text-center" width="15%">บ/หน่วย</th>
                            <th class="text-center" width="15%">เงินขาย(บ)</th>
                          </tr>
                          <?php
                          $total_money = 0;
                          $note = $_POST['note'];
                            for($i=0;$i<count($_POST["id_numPD"]);$i++)
                            {
                              $id_numPD = $_POST['id_numPD'][$i];
                              $num_product = $_POST['num_product'][$i];
                              $price_product = $_POST['price_product'][$i];
                              $money = $num_product * $price_product;
                              $money2 = round($money);
                              $id_product = $_POST['id_product'][$i];
                              if($price_product == 0){
                                $status = 'free';
                              }else{
                                $status = 'sale';
                              }
                              //insert sale_car_history
                              $insert_numPD = "INSERT INTO sale_car_history (num,price,money,id_product,status,id_member,note) 
                                               VALUE ($num_product,$price_product, $money2,$id_product,'$status',$id_member,'$note')";
                              mysqli_query($conn,$insert_numPD);

                              //update numpd_car
                              $seach_num = "SELECT * FROM numpd_car WHERE id_numPD_car = $id_numPD";
                              $objq_seach = mysqli_query($conn,$seach_num);
                              $objr_seach = mysqli_fetch_array($objq_seach);
                              $befor_num = $objr_seach['num'];
                              $total_num = $befor_num - $num_product;
                              if($total_num == 0){
                                $delete_numPD = "DELETE FROM numpd_car WHERE id_numPD_car = $id_numPD";
                                mysqli_query($conn,$delete_numPD);
                              }else{
                                $update_numPD = "UPDATE numpd_car SET num = $total_num WHERE id_numPD_car = $id_numPD";
                                mysqli_query($conn,$update_numPD);
                              }
                              
                          ?>
                          <tr>
                            <td class="text-center"><?php echo $i+1;?></td>
                            <td><?php echo $_POST['name_product'][$i].'_'.$_POST['unit'][$i];?></td>
                            <td class="text-center" ><?php echo $_POST['num_product'][$i];?></td>
                            <td class="text-center"><?php echo $_POST['price_product'][$i];?></td>
                            <td class="text-center"><?php echo $money2;?></td>
                          </tr>
                          <?php  
                              $total_money = $total_money + $money2; 
                          }
                          ?>
                          <tr>
                            <td style="visibility:collapse;"></td>
                            <td style="visibility:collapse;"></td>
                            <td style="visibility:collapse;"></td>
                            <th bgcolor="#EAF4FF" class="text-center">รวมเป็นเงิน</th>
                            <th class="text-center" bgcolor="#EAF4FF"><?php echo $total_money; ?></th>
                          </tr>
                        </tbody>
                    </table>

                    <div class="col-md-12">
                      <table class="table table-bordered ">
                        <tbody>
                        <tr  bgcolor="#99CCFF">
                        <th width="15%" class="text-center">หมายเหตุ : </th>
                        <th width="85%" class="text-center"><?php echo $note; ?></th>
                        </tr>
                        </tbody>
                      </table>
                    </div>
                </div>
                <!-- /.mailbox-read-message -->
            </div>
            <div class="box-footer">
            <a type="block" href="store.php" class="btn btn-success"><<= กลับหน้าหลัก </i></a>
            </div>
            <!-- /.box-footer -->
            </form>
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
