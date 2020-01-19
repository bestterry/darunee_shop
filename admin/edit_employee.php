<?php 
  require "../config_database/config.php";
  require "../session.php";

  $id_member = $_GET['id_member'];
  $list_product = "SELECT * FROM member WHERE id_member = $id_member";
  $objq_member = mysqli_query($conn,$list_product);
  $objr_member = mysqli_fetch_array($objq_member); 
  $status = $objr_member['status'];
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
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <div class="box box-primary">
            <div class="box-header text-center with-border">
              <font size="5">
                <B align="center"> แก้ไขข้อมูล พนักงาน </B>
              </font>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                <form action="algorithm/edit_employee.php" method="post" autocomplete="off">
                  <table class="table table-bordered table-hover">
                    <tbody>
                      <tr bgcolor="#99CCFF">
                        <th class="text-center" width="20%">username</th>
                        <th class="text-center" width="20%">password</th>
                        <th class="text-center" width="20%">ชื่อ</th>
                        <th class="text-center" width="20%">ชื่อเล่น</th>
                        <th class="text-center" width="20%">สถานะ</th>
                      </tr>
                      <tr>
                        <td class="text-center">
                          <input type="hidden" name="id_member" class="form-control text-center col-md-1" value="<?php echo $objr_member['id_member']; ?>">
                          <input type="text" name="username" class="form-control text-center col-md-1" value="<?php echo $objr_member['username']; ?>">
                        </td>
                        <td>
                          <input  type="text" name="password" class="form-control text-center col-md-1" value="<?php echo $objr_member['password']; ?>">
                        </td>
                        <td>
                          <input  type="text" name="name" class="form-control text-center col-md-1" value="<?php echo $objr_member['name']; ?>">
                        </td>
                        <td>
                          <input  type="text" name="name_sub" class="form-control text-center col-md-1" value="<?php echo $objr_member['name_sub']; ?>">
                        </td>
                        <td>
                          <select class="form-control select2" style="width: 100%;" name="status">
                            <option value="admin" <?php if($status == 'admin') { echo "selected='selected'";} ?> >ผู้ดูเเลระบบ</option>
                            <option value="sale" <?php if($status == 'sale') { echo "selected='selected'";} ?> >หน้าร้าน</option>
                            <option value="employee" <?php if($status == 'employee') { echo "selected='selected'";} ?>>พนักงานส่งของ</option>
                          </select>
                        </td>
                      </tr>
                    </tbody>
                  </table>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <div class="box-footer">
              <a type="block" href="add_data.php" class="btn btn-danger"><= กลับ </i> </a> 
              <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"> บันทึก </i></button>
            </div>
            <!-- /.box-footer -->
            </form>
          </div>
          <!-- /. box -->
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
</body>

</html>