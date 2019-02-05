<?php
session_start();
if($_SESSION['UserID'] == "")
{
    header("location:../login/login_admin.php");
    exit();
}

if($_SESSION['Status'] != "admin")
{
    echo "Homepage_admin";
    exit();
}

require '../connect/connect.php';
$strSQL = "SELECT * FROM member WHERE UserID = '".$_SESSION['UserID']."' ";
$objQuery = mysqli_query($conn,$strSQL);
$objResult = mysqli_fetch_array($objQuery);
?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Waterwork</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="../index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>Waterwork</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
         
          <!-- /account -->
          </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
      
        
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview menu-open">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>ข้อมุลผู้ใช้น้ำประปา</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="edit_user.php"><i class="fa fa-circle-o"></i>จัดการเเก้ไขข้อมูลผู้ใช้น้ำประปา</a></li>
            <li class="active"><a href="insert_user.php"><i class="fa fa-circle-o"></i>เพิ่มรายชื่อผู้ใช้น้ำประปา</a></li>
            <li><a href="user_data.php"><i class="fa fa-circle-o"></i>ข้อมุลผู้ใช้น้ำประปาทั้งหมด</a></li>
          </ul>
        </li>
        <li class="treeview">
         <a href="#">
            <i class="fa fa-dashboard"></i> <span>ข้อมุลเจ้าหน้าที่</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="edit_personnel.php"><i class="fa fa-circle-o"></i>เเก้ไขข้อมุลเจ้าหน้าที่</a></li>
            <li><a href="data_ep.php"><i class="fa fa-circle-o"></i>ข้อมุลเจ้าหน้าที่</a></li>
            <li><a href="insert_personnel.php"><i class="fa fa-circle-o"></i>เพิ่มรายชื่อเจ้าหน้าที่</a></li>
            <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>ข้อมุลการเเจ้งปัญหา</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="form_apply.php"><i class="fa fa-circle-o"></i> General</a></li>
            <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
            <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
            <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
            <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
            <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>ข้อมุลอุปกรณ์</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="data_tool.php"><i class="fa fa-circle-o"></i>รายการอุปกรณ์</a></li>
            <li><a href="withdraw_tool.php"><i class="fa fa-circle-o"></i> เบิกถอนอุปกรณ์</a></li>
            <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>ข้อมุลสถิติ</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
            <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
          </ul>
        </li>
        
       
        
        
        <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>คู่มือ</span></a></li>
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
                    เพิ่มรายการผู้ใช้น้ำประปา
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
        <li>ข้อมูลผู้ใช้น้ำ</li>
        <li class="active">เพิ่มรายการผู้ใช้น้ำประปา</li>
      </ol>
    </section>
    <form action="user_form.php" method="post">
    <!-- Main content -->
     <section class="content">
      <div class="row">
        <!-- left column -->
       <div class="col-md-6">
          <!-- Horizontal Form -->
         <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">ชื่อ-นามสกุล</h3>
            </div>
            <div role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="txtuserid">UserID</label>
                  <input type="text" name="txtuserid" class="form-control" id="txtuserid" placeholder="UserID">
                </div>
                <div class="form-group">
                  <label for="txtname">ชื่อ</label>
                  <input type="text" name="txtname" class="form-control" id="txtname" placeholder="ชื่อ">
                </div>
                <div class="form-group">
                  <label for="txtlastname">นามสกุล</label>
                  <input type="text" name="txtlastname" class="form-control" id="txtlastname" placeholder="นามสกุล">
                </div>
                <div class="form-group">
                  <label for="txtage">อายุ</label>         
                    <input type="text" name="txtage" class="form-control" id="txtage" >                 
                </div> 
                <div class="form-group">
                  <label for="txtNoage">เกิดวันที่</label>                         
                    <input type="text" name="txtNoage" class="form-control" id="txtNoage" >                                    
                </div>
                <div class="form-group">  
                    <label for="txtno">เลขบัตรประชาชน</label>      
                        <input type="text" name="txtno" class="form-control" id="txtno" >
                </div>
                <div class="form-group">
                  <label for="txtexp">วันหมดอายุ</label>
                    <input type="text" name="txtexp" class="form-control" id="txtexp" >
                </div> 
                
                <!-- /.box-body -->
            </div>
          </div>
        </div>
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">ที่อยู่</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div role="form">
              <div class="box-body">
              
                <div class="form-group">
                  <label for="txtaddress">บ้านเลขที่</label>
                    <input type="text" name="txtaddress" class="form-control" id="txtaddress" >
                </div>
                <div class="form-group">
                  <label for="inputPassword3">หมู่ที่</label>
                    <input type="text" name="txtvillageno" class="form-control" id="inputPassword3" >
                </div>
                <div class="form-group">
                  <label for="inputPassword3">ถนน</label>
                    <input type="text" name="txtroad" class="form-control" id="inputPassword3" >
                </div>
                <div class="form-group">
                  <label for="inputPassword3">ตำบล</label>
                    <input type="text" class="form-control" id="inputPassword3" value="บ้านถ้ำ">
                </div>
                <div class="form-group">
                  <label for="inputPassword3">อำเภอ</label>
                    <input type="text" class="form-control" id="inputPassword3" value="ดอกคำใต้">
                </div>
                <div class="form-group">
                  <label for="inputPassword3">จังหวัด</label>
                    <input type="text" class="form-control" id="inputPassword3" value="พะเยา">
                </div>
                <div class="form-group">
                  <label for="inputPassword3">รหัสไปรษณีย์</label>
                    <input type="text" class="form-control" id="inputPassword3" value="56000">
                </div>
                <div class="form-group">
                  <label for="inputPassword3">อาชีพ</label>
                    <input type="text" name="txtcareer" class="form-control" id="inputPassword3" >
                </div>
                <div class="form-group">
                  <label for="inputPassword3">สถานที่ทำงาน</label>
                    <input type="text" name="txtplace" class="form-control" id="inputPassword3" >
                </div>
                <div class="form-group">
                  <label for="inputPassword3">โทรศัพท์</label>
                    <input type="text" name="txttell" class="form-control" id="inputPassword3" >
                </div>
              </div>
              </div>
             </div>
                
             <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">ชำระเงิน</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div role="form">
              <div class="box-body">
            
            <div class="form-group">
                  <label for="inputPassword3">ธนาคาร</label>
                    <input type="text" name="txtbank" class="form-control" id="inputPassword3" >
             </div>
             <div class="form-group">
                  <label for="inputPassword3">สาขา</label>
                    <input type="text" name="txtbranch" class="form-control" id="inputPassword3" >
             </div>
             <div class="form-group">
                  <label for="inputPassword3">เลขที่บัญชี</label>
                    <input type="text" name="txtNobank" class="form-control" id="inputPassword3" >
             </div>
             <div class="form-group">
                  <label for="inputPassword3">ประเภทบัญชี</label>
                    <input type="text" name="txtTypebank" class="form-control" id="inputPassword3" >
             </div>
             <div class="form-group">
                  <label for="inputPassword3">ชื่อบัญชี</label>
                    <input type="text" name="txtNamebank" class="form-control" id="inputPassword3" >             
              </div> 
             </div>                            
             </div>                       
             </div>  
            
              
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-left">ตกลง</button>
              </div>
              <!-- /.box-footer -->
            </div>
          </div>
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
      
    </section>
    <!-- /.content -->
    </form>
   >
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="../bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="../bower_components/Chart.js/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>
