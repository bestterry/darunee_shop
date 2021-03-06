<?php 
    include("db_connect.php");
    $mysqli = connect();

    $sql = "SELECT * FROM radio 
            INNER JOIN tbl_amphures ON radio.amphur_id = tbl_amphures.amphur_id
            INNER JOIN tbl_provinces ON radio.province_id = tbl_provinces.province_id
            INNER JOIN radio_time ON radio.id_radio_time = radio_time.id_radio_time
            ORDER BY radio_time.id_radio_time ASC";
    $objq = mysqli_query($mysqli,$sql);
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
    .button2 {
          background-color: #b35900;
          color : white;
          } /* Back & continue */
  </style>


</head>

<body class=" hold-transition skin-blue layout-top-nav">
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
      <div class="row">
        <!-- Main content -->
        <section class="content">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <div class="col-12">
                  <div class="col-4 col-sm-4 col-xl-4 col-md-4">
                    <a type="button" href="radio_list.php" class="btn button2 pull-left"> << กลับ </a>
                  </div>
                  <div class="col-4 col-sm-4 col-xl-4 col-md-4 text-center">
                    <font size="5"><B></B></font>
                  </div>

                  <div class="col-4 col-sm-4 col-xl-4 col-md-4 text-right">
                    <a type="button"href="#" data-toggle="modal" data-target="#myModal2" class="btn btn-success">เพิ่มเวลาเช่า</a>
                  </div>
               
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <div class="mailbox-read-message">
                  <div class="modal-content">
                    <div class="modal-body col-md-12 table-responsive mailbox-messages">
                      <div class="table-responsive">
                        <div class="col-md-12">
                          <table id="example2" class="table">
                            <thead>
                              <tr>
                                <th class="text-center" width="90%">ข้อมูลวิทยุเช่า (ทั้งหมด)</th>
                                <th class="text-center" width="5%">แก้ไข</th>
                                <th class="text-center" width="5%">ลบ</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                              $i = 1;
                              while($value = $objq->fetch_assoc()){
                            ?>
                              <tr>
                                <td>
                                  <?php echo $value['time'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$value['wave'].' '.'MHz'.
                                    '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$value['name_hire'].'&nbsp;&nbsp;'.$value['tel_hire'].
                                    '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'อ.'.$value['amphur_name'].'&nbsp;&nbsp;จ.'.$value['province_name'].
                                    '&nbsp;&nbsp;&nbsp;&nbsp;'.$value['note']; 
                                  ?>
                                </td>
                                <td class="text-center"><a href="radio_edit.php?id_radio=<?php echo $value['id_radio']; ?>" class="btn btn-success btn-xs">แก้</td>
                                <td class="text-center"><a href="algorithm/delete_radio.php?id_radio=<?php echo $value['id_radio']; ?>" class="btn btn-danger btn-xs" OnClick="return confirm('ต้องการลบข้อมูลหรือไม่ ?')";>ลบ</td>
                              </tr>
                            <?php
                                $i++; 
                              }
                            ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <div class="modal fade" id="myModal2" role="dialog">
          <div class="modal-dialog modal-lg">
            <form action="algorithm/add_radio.php" method="post">
              <div class="modal-content">
                <div class="modal-header text-center">
                  <div class="col-12">
                    <div class="col-3 col-sm-3 col-xl-3 col-md-3">
                      <button type="button" class="btn button2 pull-left" data-dismiss="modal"><< กลับ</button>
                    </div>
                    <div class="col-6 col-sm-6 col-xl-6 col-md-6 text-center"> 
                      <font size="5"><B> เพิ่มข้อมูลวิทยุเช่า </B></font>
                    </div>
                    <div class="col-3 col-sm-3 col-xl-3 col-md-3"></div>
                  </div>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="col-3 col-sm-3 col-xl-3 col-md-3"></div>
                      <div class="col-6 col-sm-6 col-xl-6 col-md-6">
                        <table class="table table-bordered">
                          <tbody>
                            <tr>
                              <th class="text-right" width="30%"><font size="4">จังหวัด</font></th>
                              <th class="text-center" width="70%"> 
                                <select name="province_name" data-where="2" class="form-control ajax_address select2" >
                                  <option value="">-- เลือกจังหวัด --</option>
                                </select>
                              </th>
                            </tr>
                            <tr>
                              <th class="text-right" width="30%"><font size="4">อำเภอ</font></th>
                              <th class="text-center" width="70%"> 
                                <select name="amphur_name" data-where="3" class="ajax_address form-control select2" >
                                  <option value="">-- เลือกอำเภอ --</option>
                                </select>
                              </th>
                            </tr>
                            <tr>
                              <th class="text-right" width="30%"><font size="4">ความถี่ MHz</font></th>
                              <th class="text-center" width="70%"> 
                                <input name="wave" class="form-control" style="width: 100%;">
                              </th>
                            </tr>
                            <tr>
                              <th class="text-right" width="30%"><font size="4">ช่วงเวลา</font></th>
                              <th class="text-center" width="70%"> 
                                <select name="id_radio_time" class=" form-control" style="width: 100%;">
                                  <option value="">-- เลือกเวลา --</option>
                                  <?php 
                                    $sql_time = "SELECT id_radio_time,time FROM radio_time";
                                    $objq_time = mysqli_query($mysqli,$sql_time);
                                    while($value_time = $objq_time->fetch_assoc()){
                                  ?>
                                  <option value="<?php echo $value_time['id_radio_time'];?>"><?php echo $value_time['time'];?></option>
                                  <?php    
                                    }
                                  ?>
                                </select>
                              </th>
                            </tr>
                            <tr>
                              <th class="text-right" width="30%"><font size="4">ชื่อเจ้าของ</font></th>
                              <th class="text-center" width="70%"> 
                                <input name="name_hire" class="form-control" style="width: 100%;" value="-">
                              </th>
                            </tr>
                            <tr>
                              <th class="text-right" width="30%"><font size="4">เบอร์โทรสถานี</font></th>
                              <th class="text-center" width="70%"> 
                                <input name="tel_hire" class="form-control" style="width: 100%;"  value="-">
                              </th>
                            </tr>
                            <tr>
                              <th class="text-right" width="30%"><font size="4">หมายเหตุ</font></th>
                              <th class="text-center" width="70%"> 
                                <input name="note" class="form-control" style="width: 100%;">
                              </th>
                            </tr>
                          </tbody>
                        </table> 
                      </div>
                      <div class="col-3 col-sm-3 col-xl-3 col-md-3"></div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <div class="col-12">
                    <div class="col-3 col-sm-3 col-xl-3 col-md-3">
                    </div>
                    <div class="col-6 col-sm-6 col-xl-6 col-md-6 text-center"> 
                      <button type="submit"  class="btn btn-success" OnClick="return confirm('ต้องการบันทึกหรือไม่ ?')";>บันทึก</button>
                    </div>
                    <div class="col-3 col-sm-3 col-xl-3 col-md-3"></div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div> 
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
  <script>
    $(function() {
      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': false,
        'info': true,
        'autoWidth': false
      })
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