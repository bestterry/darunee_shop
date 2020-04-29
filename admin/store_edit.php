<?php 
    include("db_connect.php");
    $mysqli = connect();
    $id_store = $_GET['id_store'];
    $sql_store = "SELECT * FROM store  
    INNER JOIN tbl_districts ON store.district_code = tbl_districts.district_code
    INNER JOIN tbl_amphures ON store.amphur_id = tbl_amphures.amphur_id
    INNER JOIN tbl_provinces ON store.province_id = tbl_provinces.province_id
    INNER JOIN store_category ON store.id_category = store_category.id
    INNER JOIN store_product_category ON store.id_product_category = store_product_category.id
    WHERE store.id_store = $id_store";
    $objq_store = mysqli_query($mysqli,$sql_store); 
    $objr_store = mysqli_fetch_array($objq_store);
    $id_category = $objr_store['id_category'];
    $id_product_category = $objr_store['id_product_category'];
    $status = $objr_store['status'];
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

      #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
      }

      #customers tr:nth-child(even){background-color: #f2f2f2;}
      #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        background-color: #99CCFF;
      }
      .button2 {
        background-color: #b35900;
        color : white;
        } /* Back & continue */
    </style>

  <script language="javascript">
    //  function fncSum()
    //     {
    //       document.form1.money.value = parseFloat(document.form1.num_product.value) * parseFloat(document.form1.price.value);
    //     }
  </script>

</head>
<body class=" hold-transition skin-blue layout-top-nav">
  <div>
    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="../dist/img/user.png" class="user-image" alt="User Image">
                <span class="hidden-xs"></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="dist/img/user.png" class="img-circle" alt="User Image">
                  <p>
                    <small>สาขา : </small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-right">
                    <a href="login/logout.php" class="btn btn-danger btn-flat">ออกจากระบบ</a>
                  </div>
                </li>
              </ul>
            </li>
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
              <div class="text-center">
                <font size="5">
                  <B align="center">เพิ่มเติมแก้ไข (ข้อมูลร้านค้า)</B>
                </font>
              </div> 
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
              <form action="algorithm/edit_store.php" class="form-horizontal" method="post" autocomplete="off" name="form1" onSubmit="JavaScript:return fncSubmit();">
                  <div class="row">
                     <!-- ข้อมูลสินค้า -->
                     <div class="col-md-12">
                      <table class="table table-bordered" id="dynamic_field">
                        <tr>
                          <th width="15%" class="text-right"><font size="4">จังหวัด &nbsp;&nbsp;:</font></th>
                          <td width="35%" > 
                            <label for="inputEmail3" class="col-sm-4 control-label"><?php echo $objr_store['province_name']; ?></label>
                            <div class="col-sm-8">
                              <select name="province_name" data-where="2" class="form-control ajax_address select2" style="background-color: #e6f7ff;">
                                <option value="">-- เลือกจังหวัด --</option>
                              </select>
                            </div>
                          </td>
                          <th width="25%" class="text-right"><font size="4" valign="middle">ชื่อร้านค้า &nbsp;&nbsp;:</font></th>
                          <td width="25%" > 
                            <input type="text" name="name_store" class="form-control" value="<?php echo $objr_store['name_store']; ?>">
                            <input type="hidden" name="id_store" class="form-control" value="<?php echo $objr_store['id_store']; ?>">
                          </td>
                        </tr>
                        <tr>
                          <th width="15%" class="text-right" ><font size="4">อำเภอ &nbsp;&nbsp;:</font></th>
                          <td width="35%">
                            <label for="inputEmail3" class="col-sm-4 control-label"><?php echo $objr_store['amphur_name']; ?></label>
                            <div class="col-sm-8">
                              <select name="amphur_name" data-where="3" class="ajax_address form-control select2" style="background-color: #e6f7ff;" >
                                <option value="">-- เลือกอำเภอ --</option>
                              </select>
                            </div>
                          </td>
                            <th width="25%" class="text-right" ><font size="4">ที่อยู่ &nbsp;&nbsp;:</font></th>
                            <td width="25%" class="text-left"><input type="text" name="address" class="form-control" value="<?php echo $objr_store['address']; ?>"></div> 
                          </td>
                        </tr>
                        <tr>
                          <th width="15%" class="text-right" ><font size="4">ตำบล &nbsp;&nbsp;:</font></th>
                          <td width="35%">
                            <label for="inputEmail3" class="col-sm-4 control-label"><?php echo $objr_store['district_name'];?> </label>
                            <div class="col-sm-8">
                              <select name="district_name" data-where="4" class="ajax_address form-control select2" style="background-color: #e6f7ff;" >
                                <option value="">-- เลือกตำบล --</option>
                              </select>
                            </div>
                          </td>
                          <th width="25%" class="text-right" ><font size="4">เบอร์โทร &nbsp;&nbsp;:</font></th>
                          <td width="25%"><input type="text" name="tel" class="form-control" value="<?php echo $objr_store['tel']; ?>"></td> 
                          </td>
                        </tr>
                        <tr>
                          <th width="15%" class="text-right" ><font size="4">LAT &nbsp;&nbsp;:</font></th>
                          <td width="35%">
                            <input type="text" name="latitude" class="form-control" value="<?php echo $objr_store['latitude'];?>">
                          </td>
                          <th width="25%" class="text-right"><font size="4" valign="middle">ประเภทร้าน &nbsp;&nbsp;:</font></th>
                          <td width="25%" > 
                            <select name="id_category"  class="form-control" style="width: 100%;">
                              <option value="1"  <?php if($id_category == 1){ echo "selected='selected'";} ?>>ร้านค้าส่ง</option>
                              <option value="2"  <?php if($id_category == 2){ echo "selected='selected'";} ?>>ร้านค้าปลีก</option>
                              <option value="3"  <?php if($id_category == 3){ echo "selected='selected'";} ?>>รถส่งของ</option>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <th width="15%" class="text-right" ><font size="4">LONG &nbsp;&nbsp;:</font></th>
                          <td width="35%">
                            <input type="text" name="longtitude" class="form-control" value="<?php echo $objr_store['longtitude'];?>">
                          </td>
                          <th width="25%" class="text-right"><font size="4" valign="middle">ประเภทสินค้า &nbsp;&nbsp;:</font></th>
                          <td width="25%" > 
                            <select name="id_product_category"  class="form-control" style="width: 100%;">
                              <option value="1"  <?php if($id_product_category == 1){ echo "selected='selected'";} ?>>ปุ๋ย</option>
                              <option value="2"  <?php if($id_product_category == 2){ echo "selected='selected'";} ?>>ของกิน</option>
                              <option value="3"  <?php if($id_product_category == 3){ echo "selected='selected'";} ?>>ทั้งสอง</option>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <th width="15%" class="text-right"><font size="4" valign="middle"> </font></th>
                          <td width="35%">  </td>
                          <th width="25%" class="text-right" ><font size="4">สถานะ &nbsp;&nbsp;:</font></th>
                          <td width="25%">
                            <select name="status"  class="form-control" style="width: 100%;">
                              <option value="N"  <?php if($status == "N"){ echo "selected='selected'";} ?>>ไม่ได้เยี่ยม</option>
                              <option value="Y"  <?php if($status == "Y"){ echo "selected='selected'";} ?>>เยี่ยมแล้ว</option>
                            </select>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>
              </div>
              <div align="center" class="box-footer">
                <input type="hidden" name="id_store" class="form-control" value="<?php echo $objr_store['id_store']; ?>">
                <a type="button" href="store_search.php?district_name=<?php echo $objr_store['district_code']; ?>" class="btn button2 pull-left" > << กลับ </a>
                <button type="submit" class="btn btn-success" onClick="return confirm('คุณต้องการที่จะบันทึกข้อมูลหรือไม่ ?')";><i class="fa fa-save" ></i> บันทึกข้อมูล </button>
                <a type="button" href="algorithm/delete_store.php?id_store=<?php echo $id_store; ?>&&district_name=<?php echo $objr_store['district_code']; ?>" class="btn btn-danger pull-right" onClick="return confirm('คุณต้องการที่จะลบข้อมูลร้านค้าหรือไม่ ?')";><i class="fa fa-minus-square"></i> ลบร้านค้า </a>
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