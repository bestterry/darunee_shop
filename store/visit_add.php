<?php 
    include("db_connect.php");
    $mysqli = connect();
    require "session.php"; 
    
?>
<!DOCTYPE html>
<html>

<head>
  <?php require('../font/font_style.php'); ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>รายการ ORDER </title>
  <!-- Tell the browser to be responsive to screen width -->
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
  <style>
  #customers {
    width: 100%;
  }

  #customers td,
  #customers th {
    border: 1px solid #ddd;
    padding: 8px;
  }

  #customers tr:nth-child(even) {
    background-color: #f2f2f2;
  }

  #customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    background-color: #99CCFF;
  }
  </style>

  <script language="javascript">
    function fncSubmit()
    {
      if(document.form1.name_store.value == "")
      {
        alert('กรุณาระบุชื่อร้านค้า');
        document.form1.name_store.focus();
        return false;
      }	
      if(document.form1.tel.value == "")
      {
        alert('กรุณาระบุเบอร์โทรศัพท์');
        document.form1.tel.focus();		
        return false;
      }	
      if(document.form1.category.value == "")
      {
        alert('กรุณาเลือกประเภทร้านค้า');
        document.form1.category.focus();		
        return false;
      }	
      if(document.form1.address.value == "")
      {
        alert('กรุณาระบุหมู่บ้าน');
        document.form1.address.focus();		
        return false;
      }
      category
      
      document.form1.submit();
    }
  </script>

</head>

<body class=" hold-transition skin-blue layout-top-nav">
  <div>
    <header class="main-header">
    <?php require('menu/header_logout.php');?>
    </header>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="row">
        <!-- Main content -->
        <section class="content">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <table class="table table-bordered" >
                  <tr>
                    <th width="30%" >
                      <a href="visit_shop2.php?district_name=<?php echo $_GET['district_name']; ?>" class="btn btn-danger"><< กลับ</a>
                    </th>
                    <td width="50%" class="text-center"><font size="5"><B align="center">เพิ่มร้านค้า</B></font></td>
                    <td width="20%"></td>
                  </tr>
                </table>
              </div>
              <!-- /.box-header -->
                <div class="mailbox-read-message">
                <div class="row">
                  <div class="container">
                    <form action="algorithm/add_visit.php" class="form-horizontal" method="post" autocomplete="off" name="form1" onSubmit="JavaScript:return fncSubmit();">
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
                              <option value="ไม่กำหนด">ไม่กำหนด</option>
                              <option value="ขายทั้งสองชนิด">ขายทั้งสองชนิด</option>
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

                        <div class="form-group">
                          <label class="col-sm-4 control-label">latitude :</label>
                          <div class="col-sm-8">
                            <input type="text" name="latitude" class="form-control text-center" value="0">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="col-sm-4 control-label">longtitude :</label>
                          <div class="col-sm-8">
                            <input type="text" name="longtitude" class="form-control text-center" value="0">
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
          
      </div>
      </form>
    </div>
  </div>
  </section>
  <!-- jQuery 3 -->
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