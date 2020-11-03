<?php 
  require "../config_database/config.php";
  require "../session.php";

  $id_member = $_GET['id_member'];
  $list_product = "SELECT * FROM member WHERE id_member = $id_member";
  $objq_member = mysqli_query($conn,$list_product);
  $objr_member = mysqli_fetch_array($objq_member); 
  $status = $objr_member['status'];
  $status_car = $objr_member['status_car'];
?>
<!DOCTYPE html>
<html>

<head>
  <?php require('../font/font_style.php');?>
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
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }

    .switch input { 
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked + .slider {
      background-color: #2196F3;
    }

    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }
  </style>
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
        <div class="col-12">
          <div class="box box-primary">
            <form action="algorithm/edit_employee.php" class="form-horizontal" method="post" autocomplete="off">
              <div class="box-header text-center with-border">
                <font size="5">
                  <B align="center"> แก้ไขข้อมูล พนักงาน </B>
                </font>
              </div>

              <div class="box-body with-border">
                <div class="row">
                  <div class="col-md-3 col-sm-3 col-lg-3"></div>

                  <div class="col-sm-6 col-md-6 col-lg-6">

                    <div class="row">
                      <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-6 control-label">ชื่อ-นามสกุล</label>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-6">
                          <input class="form-control" type="text" name="full_name" value="<?php echo $objr_member['full_name']; ?>">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-6 control-label">ชื่อ</label>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-6">
                          <input class="form-control" type="text" name="name" value="<?php echo $objr_member['name']; ?>">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-6 control-label">ชื่อเล่น</label>
                        <div class="col-sm-6 col-md-6 col-6">
                          <input class="form-control" type="text" name="name_sub" value="<?php echo $objr_member['name_sub'];?>">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-6 control-label">สถานะ</label>
                        <div class="col-sm-6 col-md-6 col-6">
                          <select name="status" class="form-control" style="width: 100%;">
                            <option value="admin" <?php if($status == 'admin'){ echo "selected"; } ?>>ผู้ดูแลระบบ</option>
                            <option value="sale" <?php if($status == 'sale'){ echo "selected"; }?> >หน้าร้าน</option>
                            <option value="employee" <?php if($status == 'employee'){ echo "selected"; }?>>พนักงานส่งของ</option>
                            <option value="boss" <?php if($status == 'boss'){ echo "selected"; }?>>หัวหน้า</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-6 control-label">Username</label>
                        <div class="col-sm-6 col-md-6 col-6">
                          <input class="form-control" type="text" name="username" value="<?php echo $objr_member['username'];?>">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-6 control-label">Password</label>
                        <div class="col-sm-6 col-md-6 col-6">
                          <input class="form-control" type="text" name="password" value="<?php echo $objr_member['password'];?>">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group">
                        <label class="col-sm-3 col-md-3 col-6 control-label">แสดงหน่วยรถ</label>
                        <div class="col-sm-9 col-md-9 col-6">
                          <label class="switch">
                            <input type="checkbox" name="status_car" <?php if($status_car == 1){ echo "checked"; }else{} ?>>
                            <span class="slider round"></span>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-3 col-sm-3 col-lg-3"></div>
                </div>
              </div>
              
              <div class="box-footer">
                <input type="hidden" name="id_member" value="<?php echo $id_member; ?>">
                <a type="block" href="add_data.php" class="btn btn-danger"><< กลับ </a> 
                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save" onClick="return confirm('คุณต้องการที่จะบันทึกข้อมูลหรือไม่ ?')";> 
                บันทึก </i></button>
              </div>
            </form>
          </div>
        </div>
      </section>
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