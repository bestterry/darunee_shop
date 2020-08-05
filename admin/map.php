<?php
  include("db_connect.php");
  $mysqli = connect();
?>

<!DOCTYPE html>
<html>

<head>
  <?php require('../font/font_style.php'); ?>
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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
    .button2 {
      background-color: #b35900;
      color : white;
      } /* Back & continue */
  </style>
</head>

<body class=" hold-transition skin-blue layout-top-nav ">
  
  <div class="wrapper">
    <div class="content-wrapper">
      <section class="content-header">
      </section>

      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#check" data-toggle="tab">ค้นหาแผนที่</a></li>
                <li><a href="#addimage" data-toggle="tab">เพิ่มแผนที่</a></li>
                <li><a href="#setting" data-toggle="tab">ตั้งค่า</a></li>
              </ul>
              <div class="tab-content">

                <div class="active tab-pane" id="check">
                  <form action="map_show.php" method="post" class="form-horizontal">
                    <div class="box box-default">
                      <div class="box-header">
                        <div class="col-12">
                          <div class="col-4 col-sm-4 col-lg-4 col-md-4 col-xl-4">
                            <a href="admin.php" class="btn button2"><< เมนูหลัก </a>
                          </div>
                          <div class="col-4 col-sm-4 col-lg-4 col-md-4 col-xl-4 text-center">
                            <B><font size="5">ค้นหารูปแผนที่</font></B> 
                          </div>
                          <div class="col-4 col-sm-4 col-lg-4 col-md-4 col-xl-4 text-right">
                            <!-- <a href="map_edit.php" class="btn btn-success">จัดการแผนที่ </a> -->
                          </div>
                        </div>
                      </div>
                      <div class="box-body">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <div class="col-sm-4"></div>
                              <div class="col-sm-4">
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">จังหวัด :</label>
                                  <div class="col-sm-8">
                                    <select name="province_name" data-where="2" class="form-control ajax_address select2" >
                                      <option value="">-- เลือกจังหวัด --</option>
                                    </select>
                                  </div>
                                </div>
                             
                                <div class="form-group">
                                  <label  class="col-sm-4 control-label">อำเภอ :</label>
                                  <div class="col-sm-8">
                                    <select name="amphur_name" data-where="3" class="ajax_address form-control select2" >
                                      <option value="">-- เลือกอำเภอ --</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-4"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="box-footer text-center">
                          <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> ค้นหา </button>
                      </div>
                    </div>
                  </form>
                </div>

                <div class="tab-pane" id="addimage">
                  <form action="map_upload.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="box box-default">
                      <!-- /.box-header -->
                      <div class="box-header text-center">
                        <B><font size="5">เพิ่มแผนที่</font></B> 
                      </div>
                      <div class="box-body">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <div class="col-sm-4"></div>
                              <div class="col-sm-4">
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">จังหวัด :</label>
                                  <div class="col-sm-8">
                                    <select name="province_name" data-where="2" class="form-control ajax_address select2" >
                                      <option value="0">-- เลือกจังหวัด --</option>
                                    </select>
                                  </div>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                  <label  class="col-sm-4 control-label">อำเภอ :</label>
                                  <div class="col-sm-8">
                                    <select name="amphur_name" data-where="3" class="ajax_address form-control select2" >
                                      <option value="0">-- เลือกอำเภอ --</option>
                                    </select>
                                  </div>
                                </div>

                                 <!-- /.form-group -->
                                 <div class="form-group">
                                  <label class="col-sm-4 control-label">รูปภาพ :</label>
                                  <div class="col-sm-8">
                                    <input name="upload" type="file" class=" form-control" style="width: 100%;">
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-4"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="box-footer text-center">
                          <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> เพิ่ม </button>
                      </div>
                    </div>
                  </form>
                </div>

                <div class="tab-pane" id="setting">
                  <div class="box box-default">
                    <!-- /.box-header -->
                    <div class="box-header text-center">
                      <B><font size="5">ตั้งค่า</font></B> 
                    </div>
                    <div class="box-body">
                      <div class="row">
                      <div class="col-md-12">
                          <div class="col-2 col-sm-2 col-lg-2 col-md-2 col-xl-2"></div>
                          <div class="col-8 col-sm-8 col-lg-8 col-md-8 col-xl-8">
                            <table id="example2" class="table">
                              <thead>
                                <tr>
                                  <th class="text-center" width="85%">ข้อมูล</th>
                                  <th class="text-center" width="5%">ดู</th>
                                  <th class="text-center" width="5%">ลบ</th>
                                  <th class="text-center" width="5%">แก้</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php 
                                $sql_map = "SELECT id_map,name_map FROM map";
                                $objq_map = mysqli_query($mysqli,$sql_map);
                                while($value = $objq_map->fetch_assoc()){
                              ?>
                                <tr>
                                  <td class="text-center"><?php echo $value['name_map']; ?></td>
                                  <td class="text-center"><a href="map_show2.php?id_map=<?php echo $value['id_map']; ?>" class="btn btn-success btn-xs">ดู</a></td>
                                  <td class="text-center"><a href="algorithm/delete_map.php?id_map=<?php echo $value['id_map']; ?>&&name_map=<?php echo $value['name_map'];?>" class="btn  btn-danger btn-xs" >ลบ</a> </td>  
                                  <td class="text-center"><a href="edit_map.php?id_map=<?php echo $value['id_map']; ?>&&name_map=<?php echo $value['name_map'];?>" class="btn btn-success btn-xs" >แก้</a> </td> 
                                </tr>
                              <?php 
                                }
                              ?>
                              </tbody>
                            </table>
                          </div>
                          <div class="col-2 col-sm-2 col-lg-2 col-md-2 col-xl-2"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>


        </div>
      </section>
    </div>

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
  <script type="text/javascript">
    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
          'paging'      : true,
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : true
        }
        )
      });
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