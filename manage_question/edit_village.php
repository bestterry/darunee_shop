<?php
  require "db_connect.php";
  require "menu/date.php";
  $conn = connect();

  $id_village = $_GET['id_village'];
  $sql_village = "SELECT * FROM tbl_village
                  INNER JOIN tbl_districts ON tbl_village.district_id = tbl_districts.district_id
                  INNER JOIN tbl_amphures ON tbl_amphures.amphur_id = tbl_districts.amphur_id
                  INNER JOIN tbl_provinces ON tbl_provinces.province_id = tbl_districts.province_id
                  WHERE id_village = $id_village";
  $objq_village = mysqli_query($conn,$sql_village);
  $objr_village = mysqli_fetch_array($objq_village);
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
                <a href="question.php"> แบบสอบถาม </a>
                <a href="data_question.php"></i> สรุปข้อมูล </a>
                <a class="active" href="manage_village.php"></i> หมู่บ้าน </a>
              </div>
            </div>
            <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4">
            </div>
          </div>
        </div>
        
          <div class="col-12 col-sm-12 col-md-12 col-xl-12">
            
            <div class="box box-primary">
              <form action="algorithm/edit_village.php?id_village=<?php echo $id_village; ?>" method="POST" class="form-horizontal">
                <div class="box-header with-border text-center"> 
                  <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                      <a href="../admin/admin.php" class="btn btn-danger pull-left"><< เมนูหลัก</a>
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4 text-center">
                      <B> <font size="5">แก้ไขหมู่บ้าน</font> </B>
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4"></div>
                  </div>
                </div>

                <div class="box-body no-padding">
                  <div class="mailbox-read-message">
                    <div class="row">
                      <div class="col-12">
                        <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
                        <div class="col-8 col-sm-8 col-xl-8 col-md-8">
                          <div class="form-group">
                            <label class="col-2 col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">จังหวัด</label>
                            <div class="col-10 col-xs-10 col-sm-10 col-md-10 col-lg-10">
                              <div class="col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <select name="province_id" data-where="2" class="form-control ajax_address select2">
                                </select>
                              </div>
                              <div class="col-6 col-xs-6 col-sm62 col-md-6 col-lg-6">
                                <input type="text" class="form-control" value="<?php echo $objr_village['province_name'];?>" readonly>
                              </div>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-2 col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">อำเภอ</label>
                            <div class="col-10 col-xs-10 col-sm-10 col-md-10 col-lg-10">
                              <div class="col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <select name="amphur_id" data-where="3" class="ajax_address form-control select2" >
                                </select>
                              </div>
                              <div class="col-6 col-xs-6 col-sm62 col-md-6 col-lg-6">
                                <input type="text" class="form-control" value="<?php echo $objr_village['amphur_name'];?>" readonly>
                              </div>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-2 col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">ตำบล</label>
                            <div class="col-10 col-xs-10 col-sm-10 col-md-10 col-lg-10">
                              <div class="col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <select name="district_id" data-where="4" class="ajax_address form-control select2">
                                </select>
                              </div>
                              <div class="col-6 col-xs-6 col-sm62 col-md-6 col-lg-6">
                                <input type="text" class="form-control" value="<?php echo $objr_village['district_name'];?>" readonly>
                              </div>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-2 col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">หมู่บ้าน </label>
                            <div class="col-10 col-xs-10 col-sm-10 col-md-10 col-lg-10">
                              <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <input type="hidden" name="district_id2" value="<?php echo $objr_village['district_id']; ?>">
                                <input type="text" class="form-control" name="name_village" value="<?php echo $objr_village['name_village']; ?>">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
                      </div>
                    </div>
                    
                  </div>
                </div>

                <div class="box-footer text-center">
                  <button type="submit" class="btn btn-success">บันทึก</button>
                </div>
              </form>
            </div>
          </div>
      </section>
    </div>
    <?php require "menu/footer.html"; ?>
    <?php require "menu/script.php"; ?>
  <script type="text/javascript">
    $(function() {

      // เมื่อโหลดขึ้นมาครั้งแรก ให้ ajax ไปดึงข้อมูลจังหวัดทั้งหมดมาแสดงใน
      // ใน select ที่ชื่อ province_name 
      // หรือเราไม่ใช้ส่วนนี้ก็ได้ โดยไปใช้การ query ด้วย php แสดงจังหวัดทั้งหมดก็ได้
      $.post("getAddress.php", {
        IDTbl: 1
      }, function(data) {
        $("select[name=province_id]").html(data);
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
