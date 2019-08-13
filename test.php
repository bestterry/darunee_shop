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
        <!-- add data -->

        <div class="col-md-12">
          <div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-header with-border">
              <a type="button" href="order.php" class="btn btn-danger "><= เมนูหลัก</a>
              <a type="button" href="../pdf_file/list_order.php" class="btn btn-success ">พิมพ์จังหวัด</a>
              <a type="button" href="../pdf_file/list_order2.php" class="btn btn-success ">พิมพ์อำเภอ</a>
              <a type="button" href="../pdf_file/list_order_today.php" class="btn btn-success ">ORDER วันนี้</a>
            </div>
              <div class="box-body no-padding">
                <div class="mailbox-read-message">
                <table id="customers">
                  <tbody>
                    <tr>
                      <th class="text-center" width="5%">ส่ง</th>
                      <th class="text-center" width="5%">สั่ง</th>
                      <th class="text-center" width="5%">แก้</th>
                      <th class="text-center" width="5%">ลบ</th>
                      <th class="text-center" width="5%">ที่</th>
                      <th class="text-center" width="70%">ORDER ค้างส่ง</th>
                      <th class="text-center" width="5%">วัน</th>
                    </tr>
                  <?php 
                    $sql_addorder = "SELECT * FROM addorder 
                                    INNER JOIN tbl_districts ON addorder.district_code = tbl_districts.district_code
                                    INNER JOIN tbl_amphures ON addorder.amphur_id = tbl_amphures.amphur_id
                                    INNER JOIN tbl_provinces ON addorder.province_id = tbl_provinces.province_id
                                    WHERE addorder.status = 'pending' ORDER BY addorder.id_addorder DESC";
                    $objq_addorder = mysqli_query($mysqli,$sql_addorder);
                    while($value = $objq_addorder->fetch_assoc()){
                  ?>
                    <tr>
                      <td class="text-center"><a href="algorithm/sent_order.php?id_addorder=<?php echo $value['id_addorder']; ?>" class="btn btn-success btn-xs" onClick="return confirm('คุณต้องการที่จะเปลี่ยนสถานะเป็นส่งแล้วหรือไม่ ?')";>ส่ง</a></td>
                      <td class="text-center" ><a href="list_order_des.php?id_addorder=<?php echo $value['id_addorder']; ?>"><i class="fa fa-search-plus"></i></a></td>
                      <td class="text-center" ><a href="edit_list_order.php?id_addorder=<?php echo $value['id_addorder']; ?>" class="btn btn-success btn-xs" >แก้</a></td>
                      <td class="text-center" ><a href="delete_list_order.php?id_addorder=<?php echo $value['id_addorder']; ?>" class="btn btn-danger btn-xs" onClick="return confirm('คุณต้องการที่จะลบข้อมูลนี้หรือไม่ ?')";>ลบ</a></td>
                      <td class="text-center"><?php echo $value['id_addorder']; ?></td>
                      <td ><?php echo $value['name_customer'].'   บ.'.$value['village'].' '.'ต.'.$value['district_name'].' '.'อ.'.$value['amphur_name'].' '.'จ.'.$value['province_name'].'  '.$value['tel'];?></td>
                      <td class="text-center" ><?php echo DateThai($value['datetime']);?></td>
                    </tr>
                  <?php 
                    }
                  ?>
                  </tbody>
                </table>
                </div>
              </div>
              <div class="box-footer" align="center"> </div>
            </div>
          </div>

        <!-- //add data -->
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