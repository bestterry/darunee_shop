<?php 
    include("db_connect.php");
    $mysqli = connect();
    $id_radio = $_GET['id_radio'];

    $sql = "SELECT * FROM radio 
            INNER JOIN tbl_amphures ON radio.amphur_id = tbl_amphures.amphur_id
            INNER JOIN tbl_provinces ON radio.province_id = tbl_provinces.province_id
            INNER JOIN radio_time ON radio.id_radio_time = radio_time.id_radio_time
            WHERE radio.id_radio = $id_radio";
    $objq = mysqli_query($mysqli,$sql);
    $objr = mysqli_fetch_array($objq);

    $sql_time = "SELECT id_radio_time,time FROM radio_time";
    $objq_time = mysqli_query($mysqli,$sql_time);
?>

<!DOCTYPE html>
<html>

  <head>
    <?php require('../font/font_style.php'); ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>แก้ไข ORDER</title>
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
  </head>

  <body class=" hold-transition skin-blue layout-top-nav">
    <div>
      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
            </ul>
          </div>
        </nav>
      </header>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
        <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <div class="col-12">
                  <div class="col-4 col-sm-4 col-xl-4 col-md-4">
                  <a type="button" href="radio_list2.php" class="btn btn-danger pull-left"> << กลับ</a>
                  </div>
                  <div class="col-4 col-sm-4 col-xl-4 col-md-4 text-center">
                  <font size="5">
                    <B align="center">เเก้ไขข้อมูลวิทยุเช่า </B>
                  </font>
                  </div>

                  <div class="col-4 col-sm-4 col-xl-4 col-md-4 text-right"></div>
                
                </div>
              </div>
              <!-- /.box-header -->
              <form action="algorithm/edit_radio.php" class="form-horizontal" method="post" autocomplete="off" name="form1" onSubmit="JavaScript:return fncSubmit();">
                <div class="box-body no-padding">
                  <div class="mailbox-read-message">
                    
                      <div class="row">
                        <div class="col-3 col-sm-3 col-md-3 col-xl-3"></div>
                        
                        <div class="col-5 col-sm-5 col-md-5 col-xl-5">
                          <div class="form-group">
                            <label class="col-sm-4 control-label"> ความถี่ MHz :</label>
                            <div class="col-sm-8">
                              <input type="text" name="wave" class="form-control" value="<?php echo $objr['wave'];?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-4 control-label"> ชื่อเจ้าของสถานี :</label>
                            <div class="col-sm-8">
                              <input type="text" name="name_hire" class="form-control" value="<?php echo $objr['name_hire'];?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-4 control-label"> เบอร์โทรสถานี :</label>
                            <div class="col-sm-8">
                              <input type="text" name="tel_hire" class="form-control" value="<?php echo $objr['tel_hire'];?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-4 control-label">ช่วงเวลา :</label>
                            <div class="col-sm-4">
                              <select name="id_radio_time"  class="form-control" >
                                <option value="">-- เลือกช่วงเวลา --</option>
                                <?php while($value = $objq_time->fetch_assoc()){ ?>
                                  <option value="<?php echo $value['id_radio_time'];?>"><?php echo $value['time'];?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="col-sm-4">
                              <input class="form-control" value="<?php echo $objr['time'];?>" disabled/>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-4 control-label">จังหวัด :</label>
                            <div class="col-sm-4">
                              <select name="province_name" data-where="2" class="form-control ajax_address select2" >
                                <option value="">-- เลือกจังหวัด --</option>
                              </select>
                            </div>
                            <div class="col-sm-4">
                              <input class="form-control" value="<?php echo $objr['province_name'];?>" disabled/>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-4 control-label">อำเภอ :</label>
                            <div class="col-sm-4">
                              <select name="amphur_name" data-where="3" class="ajax_address form-control select2" >
                                <option value="">-- เลือกอำเภอ --</option>
                              </select>
                            </div>
                            <div class="col-sm-4">
                              <input class="form-control" value="<?php echo $objr['amphur_name'];?>" disabled/>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-4 control-label">หมายเหตุ :</label>

                            <div class="col-sm-8">
                              <input type="text" name="note" class="form-control" value="<?php echo $objr['note'];?>">
                              <input type="hidden" name="id_radio" value="<?php echo $id_radio; ?>">
                            </div>
                          </div>

                        </div>
                        <div class="col-3 col-sm-3 col-md-3 col-xl-3"></div>
                        <!-- /.row -->
                      </div>
                  </div>
                  <div class="box-footer text-center">
                    <button type="submit" class="btn btn-success" onClick="return confirm('คุณต้องการที่จะบันทึกข้อมูลนี้หรือไม่ ?')";> บันทึก </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </section>

        <!-- jQuery 3 -->
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