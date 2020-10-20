<?php 
  include("db_connect.php");
  $mysqli = connect();
  require "session.php"; 

    $sql_province = "SELECT * FROM tbl_provinces";
    $objq_province = mysqli_query($mysqli,$sql_province);
    $objq_province2 = mysqli_query($mysqli,$sql_province);
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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class=" hold-transition skin-blue layout-top-nav ">
  <div class="wrapper">
    <header class="main-header">
    <?php require('menu/header_logout.php');?>
    </header>

    <div class="content-wrapper">
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#store2" data-toggle="tab">ค้นหารายตำบล</a></li>
                <li><a href="#check" data-toggle="tab">ตรวจ</a></li>
                <div align="right">
                  <a href="store.php" class="btn btn-danger"><< เมนูหลัก</a>
                </div>
              </ul>
                
              <div class="tab-content">
                <!-- ------------------------------ค้นหารายอำเภอ---------------------------- -->
                <div class="tab-pane active" id="store2">
                  <form action="visit_shop2.php" class="form-horizontal" method="get">
                    <div class="box box-default">
                      <div class="box-header with-border text-center">
                        <font size="5"><B> ค้นหาระเบีนร้านค้า </B></font>
                      </div>
                      
                      <div class="box-body">
                        <div class="row">
                            
                          <div class="col-12">
                            <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
                            <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4">
                              <div class="form-group">
                                <label class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label">จังหวัด :</label>
                                <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                  <select name="province_name" data-where="2"
                                    class="form-control ajax_address select2">
                                    <option value="">-- เลือกจังหวัด --</option>
                                  </select>
                                </div>
                              </div>
                              
                              <div class="form-group">
                                <label class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label">อำเภอ :</label>
                                <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                  <select name="amphur_name" data-where="3"
                                    class="ajax_address form-control select2">
                                    <option value="">-- เลือกอำเภอ --</option>
                                  </select>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label">ตำบล :</label>
                                <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                  <select name="district_name" data-where="4"
                                    class="ajax_address form-control select2" style="width: 100%;">
                                    <option value="">-- เลือกตำบล --</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
                          </div>
                            
                        </div>
                      </div>

                      <div align="center" class="box-footer">
                        <button type="submit" class="btn btn-success"><i class="fa fa-search"> ค้นหา </i></button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- ------------------------------//ค้นหารายอำเภอ---------------------------- -->

                <!-- ------------------------------เพิ่มร้าน---------------------------- -->
                <div class="tab-pane" id="check">
                  <div class="box box-default">
                    <div class="box-body">
                      <div class="row">
                        <div class="container">
                          <div class="box-header text-center with-border">
                              <B align="center"> 
                                <font size="4">  </font>
                              </B>
                            </div>
                            <table class="table table-striped table-bordered">
                              <tbody>
                                <tr class="info">
                                  <th class="text-center" width="50%">จังหวัด</th>
                                  <th class="text-center" width="25%">เยี่ยมแล้ว</th>
                                  <th class="text-center" width="25%">ไม่ได้เยี่ยม</th>
                                </tr>
                                <?php 
                                  while($value_pr2 = $objq_province2->fetch_array()){
                                    $province_id = $value_pr2['province_id'];
                                  //   //ร้านค้าเยี่ยมแล้ว//
                                  $sql_a = "SELECT id_store FROM store WHERE status = 'Y' AND province_id = $province_id";
                                  if ($result=mysqli_query($mysqli,$sql_a))
                                    {
                                    // Return the number of rows in result set
                                    $rowcount1=mysqli_num_rows($result);
                                    }else{
                                      $rowcount1 = 0;
                                    }
                                    //ร้านค้าเยี่ยมแล้ว//

                                    //ร้านค้ายังไม่ได้เยี่ยม//
                                  $sql_b = "SELECT id_store FROM store WHERE status = 'N' AND province_id = $province_id";
                                  if ($result2=mysqli_query($mysqli,$sql_b))
                                    {
                                    // Return the number of rows in result set
                                    $rowcount2=mysqli_num_rows($result2);
                                    }else{
                                      $rowcount2 = 0;
                                    }
                                    //ร้านค้ายังไม่ได้เยี่ยม//
                                ?>
                                <tr>
                                  <td class="text-center"><?php echo $value_pr2['province_name']; ?></td>
                                  <td class="text-center"><?php echo $rowcount1; ?></td>
                                  <td class="text-center"><?php echo $rowcount2; ?></td>
                                </tr>
                                  <?php }?>
                              </tbody>
                            </table>
                        <?php 
                          while($value_pr = $objq_province->fetch_array()){
                            $province_id = $value_pr['province_id'];
                        ?>


                          <div class="box-header text-center with-border">
                            <B align="center"> 
                              <font size="4"> <?php echo $value_pr['province_name'];?> </font>
                            </B>
                          </div>
                          <table class="table table-striped table-bordered">
                            <tbody>
                              <tr class="info">
                                <th class="text-center" width="50%">อำเภอ</th>
                                <th class="text-center" width="25%">เยี่ยมแล้ว</th>
                                <th class="text-center" width="25%">ไม่ได้เยี่ยม</th>
                              </tr>
                              
                              <?php 
                                $sql_amphur = "SELECT * FROM tbl_amphures WHERE province_id = $province_id";
                                $objq_amphur = mysqli_query($mysqli,$sql_amphur);
                                while($value_am = $objq_amphur->fetch_array()){
                                  $amphur_id = $value_am['amphur_id'];

                                  //ร้านค้าเยี่ยมแล้ว//
                                  $sql_a = "SELECT id_store FROM store WHERE status = 'Y' AND amphur_id = $amphur_id";
                                  if ($result=mysqli_query($mysqli,$sql_a))
                                    {
                                    // Return the number of rows in result set
                                    $rowcount1=mysqli_num_rows($result);
                                    }else{
                                      $rowcount1 = 0;
                                    }
                                    //ร้านค้าเยี่ยมแล้ว//

                                    //ร้านค้ายังไม่ได้เยี่ยม//
                                  $sql_b = "SELECT id_store FROM store WHERE status = 'N' AND amphur_id = $amphur_id";
                                  if ($result2=mysqli_query($mysqli,$sql_b))
                                    {
                                    // Return the number of rows in result set
                                    $rowcount2=mysqli_num_rows($result2);
                                    }else{
                                      $rowcount2 = 0;
                                    }
                                    //ร้านค้ายังไม่ได้เยี่ยม//
                              ?>
                              <tr>
                                <td class="text-center"><?php echo $value_am['amphur_name']; ?></td>
                                <td class="text-center"><?php echo $rowcount1; ?></td>
                                <td class="text-center"><?php echo $rowcount2; ?></td>
                              </tr>
                                <?php } ?>
                            </tbody>
                          </table>
                        <?php  } ?>
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