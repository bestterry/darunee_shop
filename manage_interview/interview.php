<?php
  include("menu/db_connect.php");
  $mysqli = connect();

  $sql_product = "SELECT id_product,full_name FROM product WHERE status_order = 1";
  $objq_product = mysqli_query($mysqli,$sql_product);

  $sql_plance = "SELECT id_plance,name_plance FROM plance";
  $objq_plance = mysqli_query($mysqli,$sql_plance);
?>
<!DOCTYPE html>
<html>

<?php require 'menu/header.php'; ?>

  <body class=" hold-transition skin-blue layout-top-nav">

    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
          </ul>
        </div>
      </nav>
    </header>

    <div class="content-wrapper">
      <section class="content">
        <div class="box box-primary">
          <div class="row">
            <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8">
              <div class="topnav">
                <a class="active" href="interview.php"> ค้นหา </a>
                <a href="data_interview.php"> สัมภาษณ์ทั้งหมด </a>
                <a href="add_interview.php"> เพิ่มสัมภาษณ์ </a>
              </div>
            </div>
            <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <a class="btn button2 pull-right" href="../admin/admin.php"> << เมนูหลัก </a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <div class="text-center">
                  <font size="5">
                    <B align="center"> ค้นหาสัมภาษณ์ <font color="red"> </font></B>
                  </font>
                </div>
              </div>
              <form action="interview_search.php" class="form-horizontal" method="get" autocomplete="off">
                <div class="box-body">
                  <div class="mailbox-read-message">
                    <div class="col-12">
                      <div class="row">
                        <div class="col-2 col-sm-2 col-md-2"></div>
                        <div class="col-8 col-sm-8 col-md-8">
                          <div class="form-group">
                            <label class="col-sm-4 control-label"><font size="4">จังหวัด</font></label>
                            <div class="col-sm-8">
                              <select name="province_name" data-where="2" value="" class="form-control ajax_address select2" style="width: 50%;">
                                <option value="">-- เลือกจังหวัด --</option>
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-4 control-label"><font size="4">อำเภอ</font></label>
                            <div class="col-sm-8">
                              <select name="amphur_name" data-where="3" class="ajax_address form-control select2" style="width: 50%;">
                                <option value="">-- เลือกอำเภอ --</option>
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-4 control-label"><font size="4">สินค้า</font></label>
                            <div class="col-sm-8">
                              <select name="id_product" class=" form-control" style="width: 50%;">
                                <option value="">-- สินค้า --</option>
                                <?php
                                  while($value_product = $objq_product->fetch_assoc()){
                                ?>
                                <option value="<?php echo $value_product['id_product']; ?>"><?php echo $value_product['full_name']; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-4 control-label"><font size="4">ชนิดพืช</font></label>
                            <div class="col-sm-8">
                              <select name="id_plance" class=" form-control" style="width: 50%;">
                              <option value="">-- ชนิดพืช --</option>
                                <?php
                                  while($value_plance = $objq_plance->fetch_assoc()){
                                ?>
                                <option value="<?php echo $value_plance['id_plance']; ?>"><?php echo $value_plance['name_plance']; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div> 
                        </div>
                        <div class="col-4 col-sm-4 col-md-4"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div align="center" class="box-footer">
                  <button type="submit" class="btn btn-success">ค้นหา</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
    </div>
    <script src="../bower_components/jquery/dist/jquery.min.js">
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js">
    </script>
    <!-- DataTables -->
    <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js">
    </script>
    <script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js">
    </script>
    <!-- SlimScroll -->
    <script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js">
    </script>
    <!-- FastClick -->
    <script src="../bower_components/fastclick/lib/fastclick.js">
    </script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js">
    </script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js">
    </script>
    <script src="../plugins/iCheck/icheck.min.js">
    </script>
    <script type="text/javascript">
      $(function() {

        // เมื่อโหลดขึ้นมาครั้งแรก ให้ ajax ไปดึงข้อมูลจังหวัดทั้งหมดมาแสดงใน
        // ใน select ที่ชื่อ province_name 
        // หรือเราไม่ใช้ส่วนนี้ก็ได้ โดยไปใช้การ query ด้วย php แสดงจังหวัดทั้งหมดก็ได้
        $.post("menu/getAddress.php", {
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
              $.post("menu/getAddress.php", {
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