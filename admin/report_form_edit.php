<?php 
  date_default_timezone_set('Asia/Bangkok');
  require "../config_database/config.php";
  require "../session.php";
  require "menu/date.php";
  $datetime = date('Y-m-d H:i:s');
  $id = $_GET['id'];
  $sql = "SELECT * FROM report_office WHERE id = $id";
  $objq_sql = mysqli_query($conn,$sql);
  $objr_sql = mysqli_fetch_array($objq_sql);
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

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
            <form action="algorithm/edit_report_work.php" class="form-horizontal" method="post" autocomplete="off" name="form1" onSubmit="JavaScript:return fncSubmit();">
              <div class="box-header with-border">
                <div class="col-12">
                  <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                    <a type="block" href="report_work.php" class="btn button2 pull-left"><< กลับ</a> 
                  </div>
                  <div class="col-4 col-sm-4 col-md-4 col-xl-4 text-center">
                    <font size="5">
                      <B> แก้ไขปฏิบัติงาน สนง. </B>
                    </font>
                  </div>
                  <div class="col-4 col-sm-4 col-md-4 col-xl-4 text-right">
                  
                  </div>
                </div>
              </div>
              <br>
              <div class="box-body no-padding">
                <div class="mailbox-read-message">
                  <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-xl-4"></div>

                 
                    <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-xl-4">

                      <div class="form-group">
                        <label class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label">เข้างาน </label>
                        <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8 ">
                          <input type="text"  name="check_in" class="form-control text-center" value="<?php echo $objr_sql['check_in'];?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label">ออกงาน </label>
                        <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8 ">
                          <input type="text"  name="check_out" class="form-control text-center" value="<?php echo Datethai4($datetime);?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label">ปฏิบัติงาน </label>
                        <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8 ">
                          <select name="id_practice" class="form-control" style="width: 100%;">
                            <?php 
                            $sql_practice = "SELECT id_practice,name_practice FROM rc_practice";
                            $objq_practice = mysqli_query($conn,$sql_practice);
                                while ($value = $objq_practice -> fetch_assoc() ) {
                            ?>
                            <option value="<?php echo $value['id_practice']; ?>" <?php if($value['id_practice']==$objr_sql['id_practice']){echo 'selected';}else{}?>>
                              <?php echo $value['name_practice']; ?>
                            </option>
                            <?php
                              }
                            ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label"> ชื่อ </label>
                        <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8 ">
                          <input type="text" name="note" value="<?php echo $_GET['name']; ?>" class="form-control text-center" disabled>
                          <input type="hidden" name="id" value="<?php echo $id; ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label">หมายเหตุ </label>
                        <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8">
                          <input type="text" name="note" value="<?php echo $objr_sql['note']; ?>" class="form-control text-center">
                        </div>
                      </div>

                    </div>
                  
                  <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-xl-4"></div>
                </div>
              </div>
              <div class="box-footer text-center">
                <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> บันทึก </button>
              </div>
            </form>
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

    </script>
  </body>
</html>
