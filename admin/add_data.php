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
  <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
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

    <div class="content-wrapper">
      <section class="content-header">
      </section>

      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#adduser" data-toggle="tab">เพิ่มพนักงาน</a></li>
                <li><a href="#addproduct" data-toggle="tab">เพิ่มสินค้า</a></li>
                <li><a href="#settingproductcar" data-toggle="tab">แก้ไขจำนวนสินค้าในรถ</a></li>
                <li><a href="#addproductcar" data-toggle="tab">เพิ่มสินค้าเข้ารถ</a></li>
                <li><a href="#settingproduct" data-toggle="tab">แก้ไขข้อมูลสินค้า</a></li>
                <li><a href="#settingemployee" data-toggle="tab">แก้ไขข้อมูลพนักงาน</a></li>
                <div align="right">
                  <a href="admin.php" class="btn btn-danger"><< เมนูหลัก</a>
                </div>
              </ul>
              <div class="tab-content">
                <!-- เพิ่มพนักงาน -->
                <div class="active tab-pane" id="adduser">
                  <form class="form-horizontal" action="algorithm/add_user.php" method="post" autocomplete="off">
                    <div class="box box-default">
                      <div class="box-header with-border text-center">
                        <font size="5"><B> เพิ่มพนักงาน</B> </font>
                      </div>
                      <div class="box-body with-border">
                        <div class="row">
                          <div class="col-md-3 col-sm-3 col-lg-3"></div>

                          <div class="col-sm-6 col-md-6 col-lg-6">

                            <div class="row">
                              <div class="form-group">
                                <label class="col-sm-3 col-md-3 col-6 control-label">ชื่อ-นามสกุล</label>
                                <div class="col-sm-6 col-md-6 col-lg-6 col-6">
                                  <input class="form-control" type="text" name="full_name">
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="form-group">
                                <label class="col-sm-3 col-md-3 col-6 control-label">ชื่อ</label>
                                <div class="col-sm-6 col-md-6 col-lg-6 col-6">
                                  <input class="form-control" type="text" name="name">
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="form-group">
                                <label class="col-sm-3 col-md-3 col-6 control-label">ชื่อเล่น</label>
                                <div class="col-sm-6 col-md-6 col-6">
                                  <input class="form-control" type="text" name="sub_name">
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="form-group">
                                <label class="col-sm-3 col-md-3 col-6 control-label">สถานะ</label>
                                <div class="col-sm-6 col-md-6 col-6">
                                  <select name="status" class="form-control" style="width: 100%;">
                                    <option value="admin">ผู้ดูแลระบบ</option>
                                    <option value="sale">หน้าร้าน</option>
                                    <option value="employee">พนักงานส่งของ</option>
                                    <option value="boss">หัวหน้า</option>
                                  </select>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="form-group">
                                <label class="col-sm-3 col-md-3 col-6 control-label">Username</label>
                                <div class="col-sm-6 col-md-6 col-6">
                                  <input class="form-control" type="text" name="username">
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="form-group">
                                <label class="col-sm-3 col-md-3 col-6 control-label">Password</label>
                                <div class="col-sm-6 col-md-6 col-6">
                                  <input class="form-control" type="text" name="password">
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="form-group">
                                <label class="col-sm-3 col-md-3 col-6 control-label">แสดงหน่วยรถ</label>
                                <div class="col-sm-9 col-md-9 col-6">
                                  <label class="switch">
                                    <input type="checkbox" name="status_car">
                                    <span class="slider round"></span>
                                  </label>
                                </div>
                              </div>
                            </div>

                          </div>

                          <div class="col-md-3 col-sm-3 col-lg-3"></div>
                        </div>
                      </div>

                      <div class="box-footer" align="center">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> บันทึก </button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /เพิ่มพนักงาน -->

                <!-- เพิ่มสินค้า -->
                <div class="tab-pane" id="addproduct">
                  <div class="box box-default">
                    <div class="row">
                      <form action="algorithm/add_product2.php" method="post" class="form-horizontal" autocomplete="off">
                        <div class="box-header with-border text-center">
                          <font size="5"><B> เพิ่มสินค้า </B></font>
                        </div>

                        <div class="box-body">
                          <div class="row">
                            <div class="col-md-3 col-sm-3 col-lg-3"></div>
                            <div class="col-md-6 col-sm-6 col-lg-6">

                              <div class="row">
                                <div class="form-group">
                                  <label class="col-sm-3 col-md-3 col-6 control-label">ชื่อย่อ </label>
                                  <div class="col-sm-6 col-md-6 col-6">
                                    <input type="text" name="name_product" class="form-control">
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="form-group">
                                  <label class="col-sm-3 col-md-3 col-6 control-label">ชื่อเต็ม </label>
                                  <div class="col-sm-6 col-md-6 col-6">
                                    <input type="text" name="full_name" class="form-control">
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="form-group">
                                  <label class="col-sm-3 col-md-3 col-6 control-label">หน่วยนับ </label>
                                  <div class="col-sm-6 col-md-6 col-6">
                                    <input type="text" name="unit" class="form-control">
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="form-group">
                                  <label class="col-sm-3 col-md-3 col-6 control-label">ราคาซื้อมา </label>
                                  <div class="col-sm-6 col-md-6 col-6">
                                    <input type="number" name="price_num" class="form-control">
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="form-group">
                                  <label class="col-sm-3 col-md-3 col-6 control-label">ราคาขาย </label>
                                  <div class="col-sm-6 col-md-6 col-6">
                                    <input type="number" name="price_outside" class="form-control">
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-3 col-sm-3 col-lg-3"></div>
                          </div>
                        </div>

                        <div class="box-footer" align="center">
                          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> บันทึก </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- /เพิ่มสินค้า -->

                <!-- แก้ไขสินค้าในรถ -->
                <div class="tab-pane" id="settingproductcar">
                  <div class="box box-default">
                    <div class="row">
                      <form action="edit_productcar.php" method="get" class="form-horizontal" autocomplete="off">
                        <div class="box-header with-border text-center">
                          <font size="5"><B>แก้ไขจำนวนสินค้าในรถ</B></font>
                        </div>

                        <div class="box-body">
                          <div class="row">
                            <div class="col-md-3 col-sm-3 col-lg-3"></div>
                            <div class="col-md-6 col-sm-6 col-lg-6">
                              <div class="row">
                                <div class="form-group">
                                  <label class="col-sm-3 col-md-3 col-3 control-label">เลือกหน่วยรถ </label>
                                  <div class="col-sm-6 col-md-6 col-6">
                                    <select class="form-control select2" style="width: 100%;" name="id_membercar">
                                      <?php
                                        $sql_member = "SELECT * FROM member WHERE status='employee' AND status_car = 1";
                                        $objq_member = mysqli_query($conn,$sql_member);
                                        while($value = $objq_member->fetch_assoc()){
                                      ?>
                                        <option name="id_member" value="<?php echo $value['id_member'];?>"><?php echo $value['name'];?></option>
                                      <?php }?>  
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-lg-3"></div>
                          </div>
                        </div>

                        <div class="box-footer" align="center">
                          <button type="submit" class="btn btn-success"><i class="fa fa-true"></i> ตกลง </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- /เเก้ไขสินค้า -->

                <!-- เพิ่มสินค้ารถ -->
                <div class="tab-pane" id="addproductcar">
                  <div class="box box-default">
                    <div class="row">
                      <form action="add_numproductcar.php" method="post" class="form-horizontal" autocomplete="off">
                        <div class="box-header with-border text-center">
                          <font size="5"><B>เพิ่มสินค้าเข้ารถ</B></font>
                        </div>

                        <div class="box-body">
                          <div class="row">
                            <div class="col-md-3 col-sm-3 col-lg-3"></div>
                            <div class="col-md-6 col-sm-6 col-lg-6">
                              <div class="row">
                                <div class="form-group">
                                  <label class="col-sm-3 col-md-3 col-3 control-label">เลือกหน่วยรถ </label>
                                  <div class="col-sm-6 col-md-6 col-6">
                                    <select class="form-control" style="width: 100%;" name="id_member">
                                      <option selected="selected">-</option>
                                      <?php
                                        $sql_member = "SELECT * FROM member WHERE status='employee' AND status_car = 1";
                                        $objq_member = mysqli_query($conn,$sql_member);
                                        while($value = $objq_member->fetch_assoc()){
                                      ?>
                                        <option name="id_member" value="<?php echo $value['id_member'];?>"><?php echo $value['name'];?></option>
                                      <?php }?>  
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-lg-3"></div>
                          </div>
                        </div>

                        <div class="box-footer" align="center">
                          <button type="submit" class="btn btn-success"><i class="fa fa-true"></i> ตกลง </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- /เพิ่มสินค้ารถ -->
                
                <!-- แก้ไขสินค้า -->
                <div class="tab-pane" id="settingproduct">
                  <div class="box box-default">
                    <!-- /.box-header -->
                    <div class="box-header with-border text-center">
                      <font size="5"><B>แก้ไขข้อมูลสินค้า</B></font>
                    </div>
                    <div class="box-body">
                      <div class="row">
                        <div class="container">
                          <table class="table">
                            <thead>
                              <tr >
                                <th class="text-center" width="50%"> <font color="red">สินค้า_หน่วย</font> </th>
                                <th class="text-center" width="25%"> <font color="red">แก้ไข</font> </th>
                                <th class="text-center" width="25%"> <font color="red">ลบ</font> </th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php 
                                  $total_money = 0;
                                  $date = "SELECT * FROM product";  
                                  $objq = mysqli_query($conn,$date);
                                  while($value = $objq ->fetch_assoc()){ 
                              ?>
                              <tr>
                                <td class="text-center">
                                  <?php echo $value['name_product'].'_'. $value['unit']; ?>
                                </td>
                                <td class="text-center">
                                  <a href="edit_product.php?id_product=<?php echo $value['id_product']; ?>" type="button" class="btn btn-success btn-xs">>></a>
                                </td>
                                <td class="text-center">
                                  <a href="algorithm/delete_product.php?id_product=<?php echo $value['id_product']; ?>" type="button" class="btn btn-danger btn-xs" onClick="return confirm('คุณต้องการที่จะลบข้อมูลหรือไม่ ?')";>ลบ</a>
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
                <!-- /เเก้ไขสินค้า -->

                <!-- แก้ไขพนักงาน -->
                <div class="tab-pane" id="settingemployee">
                  <div class="box box-default">
                    <!-- /.box-header -->
                    <div class="box-header with-border text-center">
                      <font size="5"><B> แก้ไขข้อมูลพนักงาน</B> </font>
                    </div>
                    <div class="box-body">
                      <div class="row">
                        <div class="container">
                          <table class="table">
                            <thead>
                              <tr>
                                <th class="text-center" width="25%"> <font color="red">ชื่อพนักงาน</font> </th>
                                <th class="text-center" width="25%"> <font color="red">สถานะ</font> </th>
                                <th class="text-center" width="25%"> <font color="red">แสดงหน่วยรถ</font> </th>
                                <th class="text-center" width="25%"> <font color="red">แก้ไข</font> </th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php #endregion
                                  $sql_member = "SELECT * FROM member";  
                                  $objq_member = mysqli_query($conn,$sql_member);
                                  while($value = $objq_member ->fetch_assoc()){ 
                              ?>
                              <tr>
                                <td class="text-center"><?php echo $value['name']; ?></td>
                                <td class="text-center"> <?php echo $value['status']; ?></td>
                                <td class="text-center"> <?php echo $value['status_car']; ?></td>
                                <td class="text-center">
                                  <a href="edit_employee.php?id_member=<?php echo $value['id_member']; ?>" type="button" class="btn btn-success btn-xs">>></a>
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
                <!-- /เเก้ไขพนักงาน -->

              </div>
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
    })
    $(function() {
      //Enable iCheck plugin for checkboxes
      //iCheck for checkbox and radio inputs
      $('.mailbox-messages input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
      });
      //Enable check and uncheck all functionality
      $(".checkbox-toggle").click(function() {
        var clicks = $(this).data('clicks');
        if (clicks) {
          //Uncheck all checkboxes
          $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
          $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
        } else {
          //Check all checkboxes
          $(".mailbox-messages input[type='checkbox']").iCheck("check");
          $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
        }
        $(this).data("clicks", !clicks);
      });
      //Handle starring for glyphicon and font awesome
      $(".mailbox-star").click(function(e) {
        e.preventDefault();
        //detect type
        var $this = $(this).find("a > i");
        var glyph = $this.hasClass("glyphicon");
        var fa = $this.hasClass("fa");
        //Switch states
        if (glyph) {
          $this.toggleClass("glyphicon-star");
          $this.toggleClass("glyphicon-star-empty");
        }
        if (fa) {
          $this.toggleClass("fa-star");
          $this.toggleClass("fa-star-o");
        }
      });
    });
  </script>
</body>

</html>