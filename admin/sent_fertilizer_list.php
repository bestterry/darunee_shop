<?php
  require "../config_database/config.php";
  require "../session.php";
  require "menu/date.php";

  $day = $_GET['day'];
  $sql_ferti = "SELECT * FROM sent_ferti
                INNER JOIN type_lift ON sent_ferti.id_type_lift = type_lift.id
                INNER JOIN member ON sent_ferti.id_member = member.id_member 
                WHERE DATE_FORMAT(datetime,'%Y-%m-%d')='$day'
                ORDER BY sent_ferti.id_sent_ferti";
  $objq_ferti = mysqli_query($conn,$sql_ferti);
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

                <div class="box-header with-border">
                  <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="col-md-3 col-sm-3 col-3">
                          <div align="left">
                            <a href="sent_fertilizer.php" class="btn button2"><< ย้อนกลับ</a>
                          </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-6">
                          <p align="center">
                            <font size="5">
                              <B>ค่าส่งปุ๋ย 
                                <font color="red">
                              <?php 
                                echo DateThai($day);
                              ?>
                                </font> 
                              </B>
                            </font>
                          </p>
                        </div>

                        <div class="col-md-3 col-sm-3 col-3">
                          <div align="right">
                            <a href="../pdf_file/sent_fertilizer.php?day=<?php echo $day; ?>" class="btn btn-success"> PDF </a>
                          </div>
                        </div>
                    
                    </div>
                  </div>
                </div>

                <div class="box-body with-border">
                  <table class="table" id="example2">
                    <thead>
                     <tr>
                      <th class="text-center" width="10%"> <font color="red">ชื่อ</font> </th>
                      <th class="text-center" width="10%"> <font color="red">งาน</font> </th>
                      <th class="text-center" width="9%"> <font color="red">รถ</font> </th>
                      <th class="text-center" width="9%"> <font color="red">คน</font> </th>
                      <th class="text-center" width="9%"> <font color="red">กส</font> </th>
                      <th class="text-center" width="9%"> <font color="red">ค่ายก</font> </th>
                      <th class="text-center" width="9%"> <font color="red">ค่ารถ</font> </th>
                      <th class="text-center" width="25%"> <font color="red">สต๊อก</font> </th>
                      <th class="text-center" width="5%"> <font color="red">เวลา</font> </th>
                      <th class="text-center" width="5%"> <font color="red">แก้ไข</font> </th>
                     </tr>
                    </thead>
                    <tbody>
                    <?php 
                      while($value = $objq_ferti->fetch_assoc()){
                        $id_car = $value['id_car'];
                        $sql = "SELECT name FROM member WHERE id_member = $id_car";
                        $objq = mysqli_query($conn,$sql);
                        $objr = mysqli_fetch_array($objq);

                        $id_member = $value['id_member'];

                        if($id_member == $id_car){
                          $car_rental = $value['num_ferti']*0.75;
                        }else{
                          $car_rental = "-";
                        }
                    ?>
                     <tr>
                      <td class="text-center"><?php echo $value['name'];?></td>
                      <td class="text-center"><?php echo $value['name_type_lift'];?></td>
                      <td class="text-center"><?php echo $objr['name'];?></td>
                      <td class="text-center"><?php echo $value['num_cus'];?></td>
                      <td class="text-center"><?php echo $value['num_ferti'];?></td>
                      <td class="text-center"><?php echo $value['money'];?></td>
                      <td class="text-center"><?php echo $car_rental;?></td>
                      <td class="text-center"><?php echo $value['note'];?></td>
                      <td class="text-center"><?php echo Datethai2($value['datetime']);?></td>
                      <td class="text-center"> 
                        <a href="sent_fertilizer_edit.php?id_sent_ferti=<?php echo $value['id_sent_ferti']; ?>&&day=<?php echo $day; ?>" > >> </a>
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
        'paging': false,
        'lengthChange': false,
        'searching': true,
        'ordering': false,
        'info': true,
        'autoWidth': false
      })
    })
  </script>
</body>

</html>