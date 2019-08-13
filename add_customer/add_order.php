<?php 
  include("db_connect.php");
  $mysqli = connect();
  
  $strDate = date('d-m-Y');
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
    <?php 
        require 'algorithm/header_logout.php'; 
    ?>
    </header>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
      </section>
      <!-- Main content -->
      <section class="content">
       
      <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header text-center with-border">
              <font size="5">
                <B align="center"> ใบสั่งสินค้า <font color="red"> </font></B>
              </font>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                <form action="finish.php" class="form-horizontal" method="post" autocomplete="off" name="form1" onSubmit="JavaScript:return fncSubmit();">
                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-group">
                        <label class="col-sm-2 control-label">ลูกค้า :</label>

                        <div class="col-sm-10">
                          <input type="text" name="name_customer" class="form-control" placeholder="ชื่อลูกค้า">
                        </div>
                      </div>
                      <!-- /.form-group -->
                      <div class="form-group">
                        <label class="col-sm-2 control-label">บ้าน :</label>

                        <div class="col-sm-10">
                          <input type="text" name="village" class="form-control" placeholder="หมู่บ้าน">
                        </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-2 control-label">โทร :</label>
                          <div class="col-sm-10">
                            <input class="form-control" name="tel" placeholder="เบอร์โทรศัพท์">
                          </div>
                        </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">จังหวัด :</label>
                        <div class="col-sm-10">
                          <select name="province_name" data-where="2" class="form-control ajax_address select2" >
                            <option value="">-- เลือกจังหวัด --</option>
                          </select>
                        </div>
                      </div>
                      <!-- /.form-group -->
                      <div class="form-group">
                        <label  class="col-sm-2 control-label">อำเภอ :</label>
                        <div class="col-sm-10">
                          <select name="amphur_name" data-where="3" class="ajax_address form-control select2" >
                            <option value="">-- เลือกอำเภอ --</option>
                          </select>
                        </div>
                      </div>
                      <!-- /.form-group -->
                      <div class="form-group">
                        <label class="col-sm-2 control-label">ตำบล :</label>
                        <div class="col-sm-10">
                          <select name="district_name" data-where="4" class="ajax_address form-control select2" style="width: 100%;">
                            <option value="">-- เลือกตำบล --</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">หมายเหตุ :</label>

                        <div class="col-sm-10">
                          <input type="text" name="note" class="form-control" value="-" maxlength="200">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-7">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="dynamic_field">
                          <tr>
                            <th bgcolor="#4dd2ff" class="text-center" width="55%">สินค้า_หน่วย</th>
                            <th bgcolor="#4dd2ff" class="text-center" width="15%">จำนวน</th>
                            <th bgcolor="#4dd2ff" class="text-center" width="15%">จัดการ</th>
                          </tr>
                          <tr>
                            <td class="text-center">
                              <select name="id_product[]" class="form-control text-center select2" style="width: 100%;">
                                <option class="text-center" value="">-- เลือกสินค้า --</option>
                              <?php 
                                  $product = "SELECT * FROM product";
                                  $objq_product = mysqli_query($mysqli,$product);
                                  while($value = $objq_product->fetch_array()){
                                ?>
                                  <option value="<?php echo $value['id_product'];?>"><?php echo $value['name_product'].'_'.$value['unit'];?></option>
                                <?php 
                                  }
                                ?>
                              </select>
                            </td>
                            <td><input type="text" name="num[]" placeholder="จำนวน" class="form-control text-center" /></td>
                            <td class="text-center"><button type="button" name="add" id="add" class="btn btn-success">เพิ่มสินค้า</button></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <!-- /.row -->
                    
                  </div>
              </div>
              <div align="center" class="box-footer">
                <a type="button" href="order.php" class="btn btn-danger pull-left"> <= เมนูหลัก</a>
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> บันทึก ORDER</button>
              </div>
            </div>
            </form>
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