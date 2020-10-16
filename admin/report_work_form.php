<?php 
  date_default_timezone_set('Asia/Bangkok');
  require "../config_database/config.php";
  require "../session.php";
  require "menu/date.php";
  $strDate = date('d-m-Y');
  $strDate2 = date('Y-m-d');
  $datetime = date('Y-m-d H:i:s');

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
    <script language="javascript">
      function fncSubmit()
      {
        if(document.form1.date.value == "")
        {
          alert('กรุณาเลือกวันที่');
          document.form1.date.focus();
          return false;
        }	
        if(document.form1.id_practice.value == "")
        {
          alert('กรุณาเลือกรายการ')
          document.form1.id_practice.focus();
          return false;
        }	
        if(document.form1.money.value == "")
        {
          alert('กรุณาระบุจำนวนเงิน');
          document.form1.money.focus();		
          return false;
        }	
        if(document.form1.note.value == "")
        {
          alert('กรุณาระบุหมายเหตุ');
          document.form1.note.focus();		
          return false;
        }	
        document.form1.submit();
      }
    </script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
      .button2 {
        background-color: #b35900;
        color : white;
        } /* Back & continue */
        .topnav {
          background-color: while;
          overflow: hidden;
        }
    </style>
  </head>
  <body class=" hold-transition skin-blue layout-top-nav ">

    <div class="wrapper">
      <header class="main-header">
      <?php require('menu/header_logout.php');?>
      </header>

      <div class="content-wrapper">
        <section class="content">
         
          <div class="box box-primary">
            <div class="box-header with-border">
              <div class="col-12">
                <div class="col-3 col-xs-3 col-sm-3 col-md-3 col-xl-3 text-left">
                  <a type="block" href="report_work.php" class="btn button2 pull-left"><< กลับ</a> 
                </div>
                <div class="col-6 col-xs-6 col-sm-6 col-md-6 col-xl-6 text-center">
                  <font size="5">
                    <B> ผลรวมปฏิบัติงาน สนง.</B>
                  </font>
                </div>
                <div class="col-3 col-xs-3 col-sm-3 col-md-3 col-xl-3 text-right">
                  <!-- <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-success"> ผลรวม </a> -->
                </div>
              </div>
            </div>

            <div class="box-body no-padding">
              <div class="mailbox-read-message">
              <div class="col-12">
                <div class="col-2 col-xs-2 col-sm-2 col-md-2 col-xl-2"></div>
                <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-xl-8">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th class="text-center" width="14%"></th>
                        <?php 
                          $sql_practice = "SELECT id_practice,name_practice FROM rc_practice WHERE status_office ='Y'";
                          $objq_practice = mysqli_query($conn,$sql_practice);
                          while($value_practice = $objq_practice->fetch_assoc()){
                        ?>
                        <th class="text-center" width="14%"><?php echo $value_practice['name_practice']; ?></th>
                        <?php    
                          }
                        ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $sql_member = "SELECT id_member,name FROM member WHERE status = 'admin'";
                        $objq_member = mysqli_query($conn,$sql_member);
                        while($value_member = $objq_member->fetch_assoc()){
                          $id_member = $value_member['id_member'];
                      ?>
                      <tr>
                        <th class="text-center" width="14%"><?php echo $value_member['name']; ?></th>
                        <?php 
                           $objq_practice2 = mysqli_query($conn,$sql_practice);
                           while($value_practice = $objq_practice2->fetch_assoc()){
                             $id_practice = $value_practice['id_practice'];
                             $sql_report_office = "SELECT COUNT(id) FROM report_office WHERE id_member = $id_member AND id_practice = $id_practice";
                             $objq_report_office = mysqli_query($conn,$sql_report_office);
                             $objr_report_office = mysqli_fetch_array($objq_report_office);

                             if ($objr_report_office['COUNT(id)']==0) {
                               $value = '';
                             }else {
                               $value = $objr_report_office['COUNT(id)'];
                             }
                        ?>
                        <td class="text-center" width="14%"><?php echo $value; ?></td>
                        <?php 
                           }
                        ?>
                      </tr>
                      <?php    
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
                <div class="col-2 col-xs-2 col-sm-2 col-md-2 col-xl-2"></div>
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
