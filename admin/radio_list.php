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
  <title>เพิ่ม ORDER ใหม่</title>
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
      <section class="content">
        <div class="col-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <div class="col-12">
                <div class="col-4 col-sm-4 col-xl-4 col-md-4">
                  <a type="button" href="admin.php" class="btn button2 pull-left"> << เมนูหลัก </a>
                </div>
                <div class="col-4 col-sm-4 col-xl-4 col-md-4 text-center">
                  <font size="5"><B>เวลาเช่าวิทยุ</B></font>
                </div>

                <div class="col-4 col-sm-4 col-xl-4 col-md-4 text-right">
                  <a type="button"href="radio_list2.php" class="btn btn-success">ข้อมูลทั้งหมด</a>
                </div>
               
              </div>
            </div>
            <form action="radio_form.php" class="form-horizontal" method="post" autocomplete="off" name="form1" onSubmit="JavaScript:return fncSubmit();">
              <div class="box-body no-padding">
                <div class="mailbox-read-message">
                  <div class="col-12">
                    <div class="row">
                      <div class="col-2 col-sm-2 col-md-2"></div>

                      <div class="col-6 col-sm-6 col-md-6">
                        <div class="form-group">
                          <label class="col-sm-4 control-label"><font size="4">ช่วงเวลา</font></label>
                          <div class="col-sm-8">
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
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label"><font size="4">จังหวัด</font></label>
                          <div class="col-sm-8">
                            <select name="province_name" data-where="2" class="form-control ajax_address select2" >
                              <option value="">-- เลือกจังหวัด --</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label  class="col-sm-4 control-label"><font size="4">อำเภอ</font></label>
                          <div class="col-sm-8">
                            <select name="amphur_name" data-where="3" class="ajax_address form-control select2" >
                              <option value="">-- เลือกอำเภอ --</option>
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
                <button type="submit" class="btn btn-success">ตกลง</button>
              </div>
            </form>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="col-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <div class="col-12">
                <div class="col-4 col-sm-4 col-xl-4 col-md-4"> </div>
                <div class="col-4 col-sm-4 col-xl-4 col-md-4 text-center">
                  <font size="5"><B>ผังเวลาเช่าวิทยุ</B></font>
                </div>
                <div class="col-4 col-sm-4 col-xl-4 col-md-4 text-right">
                  <a type="button"href="radio_chart.php" class="btn btn-success">จัดการ</a>
                </div>
              </div>
            </div>
            <div  class="box box-body">
              <div class="row" align="center">
                <div id="myCarousel" class="carousel slide" data-interval="false">

                  <!-- Wrapper for slides -->
                  <div class="carousel-inner">
                  
                  <?php 
                    $sql_chart = "SELECT id_chart,name_chart FROM radio_chart";
                    $objq_chart = mysqli_query($mysqli,$sql_chart);
                    $i = 1;
                    while($value = $objq_chart->fetch_assoc()){
                  ?>
                    <div class="item <?php if($i == 1){ echo "active";}else{}?>">
                      <img src="../images/radio_chart/<?php echo $value['name_chart'];?>" alt="พะเยา" width="1300" height="1200">
                    </div>
                  <?php
                      $i++;
                    }
                  ?>
                  </div>

                  <!-- Left and right controls -->
                  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

    </div>
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