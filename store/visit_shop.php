<?php 
 include("db_connect.php");
 $mysqli = connect();
 require "session.php"; 
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
                <!-- <li class="active"><a href="#store" data-toggle="tab">ทั้งหมด</a></li> -->
                <li class="active"><a href="#store2" data-toggle="tab">ค้นหารายตำบล</a></li>
                <li><a href="#add_store" data-toggle="tab">เพิ่มร้านค้าใหม่</a></li>

                <div align="right">
                  <a href="store.php" class="btn btn-danger"><< เมนูหลัก</a>
                  </div> 
                  </ul> 
                   <div class="tab-content">
                      <!-- /.tab-pane -->
                      <div class="tab-pane" id="store">
                        <!-- ------------------------------ทั้งหมด---------------------------- -->
                        <form action="outside_price.php" method="post">
                          <div class="modal-content">
                            <div class="modal-body col-md-12 table-responsive mailbox-messages">
                              <div class="table-responsive">
                                <div class="col-md-12">
                                  <table id="example1" class="table table-striped">
                                    <thead>
                                      <tr>
                                        <th bgcolor="#99CCFF" class="text-center" width="20%">ชื่อร้านค้า</th>
                                        <th bgcolor="#99CCFF" class="text-center" width="40%">ที่อยู่</th>
                                        <th bgcolor="#99CCFF" class="text-center" width="15%">เบอร์โทร</th>
                                        <th bgcolor="#99CCFF" class="text-center" width="15%">ประเภท</th>
                                        <th bgcolor="#99CCFF" class="text-center" width="10%">สถานะ</th>
                                        <th bgcolor="#99CCFF" class="text-center" width="5%">แก้ไข</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td class="text-center">ร้านสุธัมงานดี</td>
                                        <td class="text-center">58 หมู่ที่5 ต.ท่าก๊อ อ.แม่สรวย จ.เชียงราย</td>
                                        <td class="text-center">085-145-2554</td>
                                        <td class="text-center">ร้านขายปุ๋ย</td>
                                        <td class="text-center">ยังไม่ได้เยี่ยม</td>
                                        <td class="text-center"><a href="store_edit.php" ><i class="fa fa-cog"></i></a></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-success pull-right">ถัดไป >></button>
                            </div>
                          </div>
                        </form>
                      </div>
                      <!-- ------------------------------ทั้งหมด---------------------------- -->

                      <!-- ------------------------------ค้นหารายอำเภอ---------------------------- -->
                      <div class="tab-pane active" id="store2">
                        <div class="box box-default">
                          <div class="box-header with-border"> </div>
                          <!-- /.box-header -->
                          <div class="box-body">
                            <div class="row">
                              <div class="container">
                                <form action="visit_shop2.php" class="form-horizontal" method="get">
                                  <div class="col-md-8">

                                    <div class="form-group">
                                      <label class="col-sm-2 control-label">จังหวัด :</label>
                                      <div class="col-sm-10">
                                        <select name="province_name" data-where="2"
                                          class="form-control ajax_address select2">
                                          <option value="">-- เลือกจังหวัด --</option>
                                        </select>
                                      </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                      <label class="col-sm-2 control-label">อำเภอ :</label>
                                      <div class="col-sm-10">
                                        <select name="amphur_name" data-where="3"
                                          class="ajax_address form-control select2">
                                          <option value="">-- เลือกอำเภอ --</option>
                                        </select>
                                      </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                      <label class="col-sm-2 control-label">ตำบล :</label>
                                      <div class="col-sm-10">
                                        <select name="district_name" data-where="4"
                                          class="ajax_address form-control select2" style="width: 100%;">
                                          <option value="">-- เลือกตำบล --</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div align="center" class="box-footer">
                                      <button type="submit" class="btn btn-success"><i class="fa fa-search"> ค้นหา </i></button>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- ------------------------------//ค้นหารายอำเภอ---------------------------- -->

                      <!-- ------------------------------เยี่ยมร้าน---------------------------- -->
                      <div class="tab-pane" id="store3">
                        <div class="box box-default">
                          <div class="box-header with-border">

                          </div>
                          <!-- /.box-header -->
                          <div class="box-body">
                            <div class="row">
                              <div class="container">
                                <form action="store_search2.php" class="form-horizontal" method="post">
                                  <div class="col-md-4">
                                    <div class="box-body">
                                      <strong><i class="fa fa-file-text-o margin-r-5"></i> การใช้</strong>
                                      <p> -กรุณาเลือก ระเบียนร้านค้า เยี่ยมแล้ว หรือไม่ได้เยี่ยม </p>
                                    </div>
                                  </div>
                                  <div class="col-md-8">
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">จังหวัด :</label>
                                      <div class="col-sm-10">
                                        <select name="province_name" data-where="2"
                                          class="form-control ajax_address select2">
                                          <option value="">-- เลือกจังหวัด --</option>
                                        </select>
                                      </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                      <label class="col-sm-2 control-label">อำเภอ :</label>
                                      <div class="col-sm-10">
                                        <select name="amphur_name" data-where="3"
                                          class="ajax_address form-control select2">
                                          <option value="">-- เลือกอำเภอ --</option>
                                        </select>
                                      </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                      <label class="col-sm-2 control-label">ตำบล :</label>
                                      <div class="col-sm-10">
                                        <select name="district_name" data-where="4"
                                          class="ajax_address form-control select2" style="width: 100%;">
                                          <option value="">-- เลือกตำบล --</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                    <label class="col-sm-2 control-label">สถานะ :</label>
                                      <div class="col-sm-10">
                                      <select name="status" class="form-control text-center select2" style="width: 100%;">
                                        <option value="">------กรุณาเลือก------</option>
                                        <option value="success">เยี่ยมแล้ว</option>
                                        <option value="diss">ไม่ได้เยี่ยม</option>
                                      </select>
                                    </div>
                                    </div>
                                    <div class="box-footer">
                                      <button type="submit" class="btn btn-success pull-left"><i
                                          class="fa fa-check-square-o"></i> ตกลง</button>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- ------------------------------เยี่ยมร้าน---------------------------- -->
                      <!-- ------------------------------เพิ่มร้าน---------------------------- -->
                      <div class="tab-pane" id="add_store">
                        <div class="box box-default">
                          <div class="box-header with-border">

                          </div>
                          <!-- /.box-header -->
                          <div class="box-body">
                            <div class="row">
                              <div class="container">
                                <form action="algorithm/add_visit.php" class="form-horizontal" method="post">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">ชื่อร้านค้า :</label>
                                      <div class="col-sm-8">
                                        <input type="text" name="name_store" class="form-control text-center" placeholder="ชื่อร้านค้า">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">เบอร์โทรศัพท์ :</label>
                                      <div class="col-sm-8">
                                        <input type="text" name="tel" class="form-control text-center" placeholder="เบอร์โทรศัพท์">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">ประเภทร้าน :</label>
                                      <div class="col-sm-8">
                                        <select name="category" class="form-control text-center select2" style="width: 100%;">
                                          <option value="">------กรุณาเลือก------</option>
                                          <option value="ขายปุ๋ย">ขายปุ๋ย</option>
                                          <option value="ขายของบริโภค">ขายของบริโภค</option>
                                          <option value="ขายทั้งสองชนิด">ขายทั้งสองชนิด</option>
                                          <option value="ไม่กำหนด">ไม่กำหนด</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">สถานะ :</label>
                                      <div class="col-sm-8">
                                        <select name="status" class="form-control text-center select2" style="width: 100%;">
                                          <option value="N">ไม่ได้เยี่ยม</option>
                                          <option value="Y">เยี่ยมแล้ว</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">จังหวัด :</label>
                                      <div class="col-sm-8">
                                        <select name="province_name" data-where="2"
                                          class="form-control ajax_address select2">
                                          <option value="">-- เลือกจังหวัด --</option>
                                        </select>
                                      </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">อำเภอ :</label>
                                      <div class="col-sm-8">
                                        <select name="amphur_name" data-where="3"
                                          class="ajax_address form-control select2">
                                          <option value="">-- เลือกอำเภอ --</option>
                                        </select>
                                      </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">ตำบล :</label>
                                      <div class="col-sm-8">
                                        <select name="district_name" data-where="4"
                                          class="ajax_address form-control select2" style="width: 100%;">
                                          <option value="">-- เลือกตำบล --</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">หมู่บ้าน :</label>
                                      <div class="col-sm-8">
                                        <input type="text" name="address" class="form-control text-center" placeholder="หมู่บ้าน">
                                      </div>
                                    </div>
                                  </div>
                                    <div class="box-footer text-center">
                                      <button type="submit" class="btn btn-success "><i class="fa fa-save"></i> บันทึก </button>
                                    </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- ------------------------------เพิ่มร้าน---------------------------- -->
                </div>
            </div>
          </div>
        </div>
    </div>
  </div>
  <!-- /.tab-pane -->
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

  <script type="text/javascript">
  $(function() {

    // เมื่อโหลดขึ้นมาครั้งแรก ให้ ajax ไปดึงข้อมูลจังหวัดทั้งหมดมาแสดงใน
    // ใน select ที่ชื่อ province_name 
    // หรือเราไม่ใช้ส่วนนี้ก็ได้ โดยไปใช้การ query ด้วย php แสดงจังหวัดทั้งหมดก็ได้
    $.post("getAddress.php", {
      IDTbl: 1
    }, function(data) {
      $("select[name=province_name]").html(data);
    });
    // สร้างตัวแปร สำหรับเก็บค่าข้อความให้เลือกรายการ เช่น เลือกจังหวัด
    // เราจะเก็บค่านี้ไว้ใช้กรณีมีการรีเซ็ต หรือเปลี่ยนแปลงรายการใหม่
    var chooseText = [];
    $(".ajax_address").each(function(i, k) {
      var initObj = $(".ajax_address").eq(i).find("option:eq(0)")[0];
      chooseText[i] = initObj;
    });

    // ส่วนของการตรวจสอบ และดึงข้อมูล ajax สังเกตว่าเราใช้ css คลาสชื่อ ajax_address
    // ดังนั้น css คลาสชื่อนี้จำเป็นต้องกำหนด หรือเราจะเปลี่ยนเป็นชื่ออื่นก็ได้ แต่จำไว้ว่า
    // ต้องเปลี่ยนในส่วนนี้ด้วย
    $(".ajax_address").on("change", function() {
      var indexObj = $(".ajax_address").index(this); // เก็บค่า index ไว้ใช้งานสำหรับอ้างอิง
      // วนลูปรีเซ็ตค่า select ของแต่ละรายการ โดยเอาค่าจาก array ด้านบนที่เราได้เก็บไว้
      $(".ajax_address").each(function(i, k) {
        if (i > indexObj) { // รีเซ็ตค่าของรายการที่ไม่ได้เลือก
          $(".ajax_address").eq(i).html(chooseText[i]);
        }
      });

      var obj = $(this);
      var IDCheck = obj.val(); // ข้อมูลที่เราจะใช้เช็คกรณี where เช่น id ของจังหวัด
      var IDWhere = obj.data("where"); // ค่าจาก data-where ค่าน่าจะเป็นตัวฟิลด์เงื่อนไขที่เราจะใช้
      var targetObj = $("select[data-where='" + (IDWhere + 1) + "']"); // ตัวที่เราจะเปลี่ยนแปลงข้อมูล
      if (targetObj.length > 0) { // ถ้ามี obj เป้าหมาย
        targetObj.html("<option>.. กำลังโหลดข้อมูล.. </option>"); // แสดงสถานะกำลังโหลด  
        setTimeout(function() { // หน่วงเวลานิดหน่อยให้เห็นการทำงาน ตัดเออกได้
          // ส่งค่าไปทำการดึงข้อมูล option ตามเงื่อนไข
          $.post("getAddress.php", {
            IDTbl: IDWhere,
            IDCheck: IDCheck,
            IDWhere: IDWhere - 1
          }, function(data) {
            targetObj.html(data); // แสดงค่าผลลัพธ์
          });
        }, 0);
      }
    });

  });
  </script>
</body>

</html>