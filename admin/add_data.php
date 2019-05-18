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
        <div class="row">
          <!-- form start -->
          <div class="col-md-12">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li><a href="#adduser" data-toggle="tab">เพิ่มพนักงาน</a></li>
                <li><a href="#addproduct" data-toggle="tab">เพิ่มสินค้า</a></li>
                <li><a href="#settingproduct" data-toggle="tab">แก้ไขข้อมูลสินค้า</a></li>
                <li><a href="#settingproductcar" data-toggle="tab">แก้ไขจำนวนสินค้าในรถ</a></li>
                <li><a href="#addproductcar" data-toggle="tab">เพิ่มสินค้าเข้ารถ</a></li>
              </ul>
              <div class="tab-content">
                <!-- เพิ่มพนักงาน -->
                <div class="active tab-pane" id="adduser">
                  <div class="form-group">
                    <form action="algorithm/add_user.php" method="post" autocomplete="off">
                      <div class="box box-default">
                        <!-- /.box-header -->
                        <div class="box-body">
                          <div class="row">
                            <div class="container">
                              <div class="box-header with-border">
                                <font size="4">
                                  <B>
                                    เพิ่มพนักงาน
                                  </B>
                                </font>
                              </div>

                              <div class="col-md-12">
                                <div class="form-group col-md-3">
                                  <label for="txtname">ชื่อ :</label>
                                  <input type="text" name="name" class="form-control" placeholder="ชื่อ">
                                </div>
                              </div>

                              <div class="col-md-12">
                                <div class="form-group col-md-4">
                                  <label for="txtlastname">username :</label>
                                  <input type="text" name="username" class="form-control" placeholder="username">
                                </div>
                                <div class="form-group col-md-4">
                                  <label for="txtlastname">password :</label>
                                  <input type="text" name="password" class="form-control" placeholder="password">
                                </div>
                              </div>

                              <div class="col-md-12">
                                <div class="form-group col-md-2">
                                  <label for="inputPassword3">สถานะ :</label>
                                  <select class="form-control select2" style="width: 100%;" name="status">
                                    <option selected="selected">...กรุณาเลือกสถานะ...</option>
                                    <option name="admin" value="admin">ผู้ดูเเลระบบ</option>
                                    <option name="sale" value="sale">พนักงานหน้าร้าน</option>
                                    <option name="employee" value="employee">พนักงานส่งของ</option>
                                  </select>
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>
                        <div class="box-footer" align="center">
                          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> บันทึก </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <!-- /เพิ่มพนักงาน -->

                <!-- เพิ่มสินค้า -->
                <div class="tab-pane" id="addproduct">
                  <div class="box box-default">
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="row">
                        <div class="container">
                          <form action="algorithm/add_product2.php" method="post" autocomplete="off">
                            <div class="box-header with-border">
                              <font size="4">
                                <B>
                                  เพิ่มสินค้า
                                </B>
                              </font>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group col-md-3">
                                <label for="txtname">ชื่อสินค้า :</label>
                                <input type="text" name="name_product" class="form-control" placeholder="ชื่อสินค้า">
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group col-md-4">
                                <label for="unit">หน่วยนับ : </label>
                                <input type="text" name="unit" class="form-control" placeholder="หน่วย">
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group col-md-2">
                                <label for="inputPassword3">ราคาซื้อมา :</label>
                                <input type="text" name="price_num" class="form-control" placeholder="ราคา">
                              </div>
                            </div>
                            <div class="box-footer" align="center">
                              <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> บันทึก </button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /เพิ่มสินค้า -->

                <!-- แก้ไขสินค้า -->
                <div class="tab-pane" id="settingproduct">
                  <div class="box box-default">
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="row">
                        <div class="container">
                          <form action="algorithm/add_product2.php" method="post" autocomplete="off">
                            <div class="box-header with-border">
                              <font size="4">
                                <B>
                                  แก้ไขข้อมูลสินค้า
                                </B>
                              </font>
                            </div>
                            <table class="table table-striped ">
                              <tbody>
                                <tr class="info" >
                                  <th class="text-center">ชื่อสินค้า</th>
                                  <th class="text-center" width="15%">หน่วย</th>
                                  <th class="text-center" width="12%">แก้ไข</th>
                                  <th class="text-center" width="12%">ลบ</th>
                                </tr>
                                <?php #endregion
                                                  $total_money = 0;
                                                  $date = "SELECT * FROM product";  
                                                  $objq = mysqli_query($conn,$date);
                                                  while($value = $objq ->fetch_assoc()){ 
                                              ?>
                                <tr>
                                  <td>
                                    <?php echo $value['name_product']; ?>
                                  </td>
                                  <td class="text-center">
                                    <?php echo $value['unit']; ?>
                                  </td>
                                  <td class="text-center">
                                    <a href="edit_product.php?id_product=<?php echo $value['id_product']; ?>" type="button" class="btn btn-success"><i class="fa fa-cog"></i></a>
                                  </td>
                                  <td class="text-center">
                                    <a href="algorithm/delete_product.php?id_product=<?php echo $value['id_product']; ?>" type="button" class="btn btn-danger"><i class="fa fa-minus-square"></i></a>
                                  </td>
                                </tr>
                                <?php
                                  }
                                ?>
                              </tbody>
                            </table>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /เเก้ไขสินค้า -->

                <!-- แก้ไขสินค้าในรถ -->
                <div class="tab-pane" id="settingproductcar">
                  <div class="box box-default">
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="row">
                        <div class="container">
                          <form action="edit_productcar.php" method="post" autocomplete="off">
                            <div class="box-header with-border">
                              <font size="4">
                                <B>
                                แก้ไขจำนวนสินค้าในรถ
                                </B>
                              </font>
                            </div>
                              <table  class="table table-bordered">
                                <tbody>
                                  <th width="20%">กรุณาเลือกบุคคล</th>
                                  <th>
                                    <select class="form-control select2" style="width: 50%;" name="id_membercar">
                                      <option selected="selected">-</option>
                                    <?php
                                      $sql_member = "SELECT * FROM member WHERE status='employee'";
                                      $objq_member = mysqli_query($conn,$sql_member);
                                      while($value = $objq_member->fetch_assoc()){
                                    ?>
                                      <option name="id_member" value="<?php echo $value['id_member'];?>"><?php echo $value['name'];?></option>
                                    <?php }?>  
                                    </select>
                                  </th>
                                </tbody>
                              </table>
                              <div class="box-footer" align="center">
                                <button type="submit" class="btn btn-success"><i class="fa fa-true"></i> ตกลง </button>
                              </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /เเก้ไขสินค้า -->

                <!-- เพิ่มสินค้ารถ -->
                <div class="tab-pane" id="addproductcar">
                  <div class="box box-default">
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="row">
                        <div class="container">
                          <form action="add_numproductcar.php" method="post" autocomplete="off">
                            <div class="box-header with-border">
                              <font size="4">
                                <B>
                                  เพิ่มสินค้าเข้ารถ
                                </B>
                              </font>
                            </div>
                              <table  class="table table-bordered">
                                <tbody>
                                  <th width="20%">กรุณาเลือกบุคคล</th>
                                  <th>
                                  <select class="form-control select2" style="width: 50%;" name="id_member">
                                    <option selected="selected">-</option>
                                  <?php
                                    $sql_member = "SELECT * FROM member WHERE status='employee'";
                                    $objq_member = mysqli_query($conn,$sql_member);
                                    while($value = $objq_member->fetch_assoc()){
                                  ?>
                                    <option name="id_member" value="<?php echo $value['id_member'];?>"><?php echo $value['name'];?></option>
                                  <?php }?>  
                                  </select>
                                  </th>
                                </tbody>
                              </table>
                              <div class="box-footer" align="center">
                                <button type="submit" class="btn btn-success"><i class="fa fa-true"></i> ตกลง </button>
                              </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /เพิ่มสินค้ารถ -->

              </div>
              <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
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