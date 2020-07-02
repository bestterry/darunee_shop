<?php
  require "../config_database/config.php";
  require "../session.php";

  $id_radio_time = $_POST['id_radio_time'];
  $province_id = $_POST['province_name'];

  if(empty($_POST['amphur_name'])){
    $sql = "SELECT * FROM radio 
            INNER JOIN tbl_amphures ON radio.amphur_id = tbl_amphures.amphur_id
            INNER JOIN tbl_provinces ON radio.province_id = tbl_provinces.province_id
            INNER JOIN radio_time ON radio.id_radio_time = radio_time.id_radio_time
            WHERE radio.id_radio_time=$id_radio_time AND radio.province_id=$province_id ";
    $objq = mysqli_query($conn,$sql);
    $objq2 = mysqli_query($conn,$sql);
  }else{
    $amphur_id = $_POST['amphur_name'];
    $sql = "SELECT * FROM radio 
            INNER JOIN tbl_amphures ON radio.amphur_id = tbl_amphures.amphur_id
            INNER JOIN tbl_provinces ON radio.province_id = tbl_provinces.province_id
            INNER JOIN radio_time ON radio.id_radio_time = radio_time.id_radio_time
            WHERE radio.id_radio_time=$id_radio_time AND radio.province_id=$province_id AND radio.amphur_id=$amphur_id";
    $objq = mysqli_query($conn,$sql);
    $objq2 = mysqli_query($conn,$sql);
  }
  $objr = mysqli_fetch_array($objq2);
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

    <div class="content-wrapper">
      <section class="content-header">
      </section>

      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <?php 
            if (isset($objr['province_name'])) {
              if(empty($_POST['amphur_name'])){
            ?>
              <div class="box box-default">
                <div class="box-header">
                  <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                    <div class="row">
                    <div class="col-4 col-sm-4 col-xl-4 col-md-4">
                      <a type="button" href="radio_list.php" class="btn button2 pull-left"> << กลับ </a>
                    </div>
                    <div class="col-4 col-sm-4 col-xl-4 col-md-4">
                      <div class="text-center">
                        <font size="5"><B>เวลาเช่าวิทยุ <?php echo 'จ.'.$objr['province_name']; ?></B></font>
                        <br>
                        <br>
                        <font size="4" color="red"><B> <?php echo $objr['time']; ?></B></font>
                      </div>
                    </div>
                    <div class="col-4 col-sm-4 col-xl-4 col-md-4"></div>
                    </div>
                  </div>
                </div>
                <div class="box-body">
                  <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                    <div class="row">
                      <table class="table">
                        <tbody>
                          <?php #endregion
                            while ($value = $objq->fetch_assoc()) {
                          ?>
                          <tr>
                            <td class="text-right" width="50%">
                              <font size="4"><?php echo $value['wave']; ?>&nbsp;&nbsp;MHz&nbsp;&nbsp;&nbsp;&nbsp;</font>
                            </td>
                            <td class="text-left" width="50%">
                              &nbsp;&nbsp;&nbsp;&nbsp;<font size="4"><?php echo $value['amphur_name']; ?></font>
                              &nbsp;&nbsp;<font size="4"><?php echo $value['name_hire']; ?></font>
                              &nbsp;&nbsp;<font size="4"><?php echo $value['tel_hire']; ?></font>
                              &nbsp;&nbsp;<font size="4" color="red"><?php echo $value['note']; ?></font>
                            </td>
                            
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
            <?php }else{?>
              <div class="box box-default">
                <div class="box-header">
                  <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                    <div class="row">
                    <div class="col-4 col-sm-4 col-xl-4 col-md-4">
                      <a type="button" href="radio_list.php" class="btn button2 pull-left"> << กลับ </a>
                    </div>
                    <div class="col-4 col-sm-4 col-xl-4 col-md-4">
                      <div class="text-center">
                        <font size="4"><B>เวลาเช่าวิทยุ <?php echo 'จ.'.$objr['province_name']; ?></B></font>
                        <br>
                        <br>
                        <font size="4" color="red"><B> <?php echo $objr['time']; ?></B></font>
                      </div>
                    </div>
                    <div class="col-4 col-sm-4 col-xl-4 col-md-4"></div>
                    </div>
                  </div>
                </div>
                <div class="box-body">
                  <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                    <div class="row">
                      <table class="table">
                        <tbody>
                          <?php #endregion
                            while ($value = $objq->fetch_assoc()) {
                          ?>
                          <tr>
                            <td class="text-right" width="50%">
                              <font size="4"><?php echo $value['wave'];?>&nbsp;&nbsp;MHz</font>
                            </td>
                            <td class="text-left" width="50%">
                              <font size="4"><?php echo $value['amphur_name']; ?></font>
                              &nbsp;&nbsp;<font size="4"><?php echo $value['name_hire']; ?></font>
                              &nbsp;&nbsp;<font size="4"><?php echo $value['tel_hire']; ?></font>
                              &nbsp;&nbsp;<font size="4" color="red"><?php echo $value['note']; ?>
                            </td>
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
            <?php
              }
            }else{
           ?>  
              <div class="container">
                <div class="alert alert-danger alert-dismissible text-center">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class="icon fa fa-ban"></i> ไม่มีข้อมูล!</h4>
                </div>
              </div>
           <?php
            }
           ?>
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