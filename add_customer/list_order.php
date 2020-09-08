<?php
  include("db_connect.php");
  $mysqli = connect();
  function DateThai($strDate)
  {
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay";
  }
?>
<!DOCTYPE html>
<html>

<head>
  <?php require('../font/font_style.php'); ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>รายการ ORDER</title>
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
    thead {
      color : red;
    }

    .button2 {
      background-color: #b35900;
      color : white;
      } /* Back & continue */
  </style>

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
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
              <div class="box box-primary">
                <!-- /.box-header -->
                <div class="box-header with-border">
                  <div class="col-12">
                    <div class="col-1 col-sm-1 col-xl-1 col-md-1">
                      <a type="button" href="../admin/admin.php" class="btn button2"><< เมนูหลัก</a>
                    </div>
                    <div class="col-11 col-sm-11 col-xl-11 col-md-11 text-right">
                      <a type="button" href="../pdf_file/list_order_today.php" class="btn btn-warning" style="color:black;">OR วันนี้</a>
                      <a type="button" href="#" data-toggle="modal" data-target="#employee" class="btn btn-warning" style="color:black;">OR เบิก</a>
                      <a type="button" href="../pdf_file/list_order2.php" class="btn btn-warning" style="color:black;">OR ทั้งหมด</a>
                      <a type="button" href="#" data-toggle="modal" data-target="#myModal" class="btn btn-warning" style="color:black;">ค้างส่ง(อ)</a>
                      <a type="button" href="#" data-toggle="modal" data-target="#myModal2" class="btn btn-warning" style="color:black;">ส่งแล้ว(อ)</a>
                      <a type="button" href="order_success.php" class="btn btn-danger" style="color:black;">OR วันนี้(ส่ง)</a>
                      <a type="button" href="total_order.php" class="btn btn-danger" style="color:black;">ค้างส่งรวม</a>
                      <a type="button" href="#" data-toggle="modal" data-target="#mymodal3" class="btn btn-danger" style="color:black;">ค้างส่ง(จ)</a>
                      <a type="button" href="add_order.php" class="btn btn-danger" style="color:black;">เพิ่ม OR</a>
                    </div>
                  </div>
                </div>
                <form action="../pdf_file/pick_order.php" method="post" autocomplete="off"> 
                  <div class="box-body no-padding">
                    <div class="mailbox-read-message">
                      <table id="example2" class="table">
                        <thead>
                          <tr>
                            <th class="text-center" width="80%">ข้อมูล ORDER ค้างส่ง</th>
                            <th class="text-center" width="5%">ทวง</th>
                            <th class="text-center" width="5%">เบิก</th>
                            <th class="text-center" width="5%">วันที่</th>
                            <th class="text-center" width="5%">แก้</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $sql_addorder = "SELECT * FROM addorder 
                                            INNER JOIN tbl_districts ON addorder.district_code = tbl_districts.district_code
                                            INNER JOIN tbl_amphures ON addorder.amphur_id = tbl_amphures.amphur_id
                                            INNER JOIN tbl_provinces ON addorder.province_id = tbl_provinces.province_id
                                            WHERE addorder.status = 'pending' ORDER BY addorder.id_addorder DESC";
                            $objq_addorder = mysqli_query($mysqli,$sql_addorder);
                            while($value = $objq_addorder->fetch_assoc()){
                              $request = $value['request'];
                              $id_wd = $value['id_wd'];
                              if(empty($id_wd)){
                                $name_member = '';
                               
                              }else{
                                $sql_member = "SELECT name_sub FROM member WHERE id_member = $id_wd";
                                $objq_member = mysqli_query($mysqli,$sql_member);
                                $objr_member = mysqli_fetch_array($objq_member);
                                $name_member = $objr_member['name_sub'];
                                
                              }
                          ?>
                          <tr>
                            <td><?php echo $value['id_addorder'].'&nbsp; &nbsp;&nbsp;  '.$value['name_customer'].'   บ.'.$value['village'].' '.'ต.'.$value['district_name'].' '.'อ.'.$value['amphur_name'].' '.'จ.'.$value['province_name'].'  '.$value['tel'];?></td>
                            <td class="text-center"><?php if($request=='Y'){echo "ทวง";}else{}?></td>                         
                            <td class="text-center"><?php echo $name_member; ?></td>
                            <td class="text-center" ><?php echo DateThai($value['datetime']);?></td>
                            <td class="text-center" ><a href="edit_list_order.php?id_addorder=<?php echo $value['id_addorder']; ?>&&status=pending">>></a></td>
                          </tr>
                          <?php 
                            }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <form action="../pdf_file/list_order3.php" method="post">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <font size="5"><B> รายการ ORDER (อำเภอ) </B></font>
                        </div>
                        <div class="modal-body col-md-12 table-responsive mailbox-messages">
                          <div class="table-responsive mailbox-messages">

                            <table class="table table-bordered">
                            <tbody>
                                <tr>
                                <th class="text-center" width="30%"><font size="5">จังหวัด</font></th>
                                <th bgcolor="#99CCFF" class="text-center" width="70%"> 
                                    <select name="province_name" data-where="2" class="form-control ajax_address select2" style="width: 100%;">
                                        <option value="">-- เลือกจังหวัด --</option>
                                    </select>
                                </th>
                                </tr>
                            </tbody>
                            </table> 
                            <br> 

                          <table class="table table-bordered">
                            <tbody>
                                <tr>
                                <th class="text-center" width="30%"><font size="5">อำเภอ</font></th>
                                <th bgcolor="#99CCFF" class="text-center" width="70%"> 
                                <select name="amphur_name" data-where="3" class="form-control ajax_address select2" style="width: 100%;">
                                    <option value="">-- เลือกอำเภอ --</option>
                                </select>
                                </th>
                                </tr>
                            </tbody>
                            </table>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit"  class="btn button2 pull-right">ถัดไป >></button>
                          <button type="button" class="btn button2 pull-left" data-dismiss="modal"><< กลับ</button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
          <div class="modal fade" id="myModal2" role="dialog">
            <div class="modal-dialog modal-lg">
                <form action="../pdf_file/list_order4.php" method="post">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <font size="5"><B> รายการ ORDER ส่งแล้ว (อำเภอ) </B></font>
                        </div>
                        <div class="modal-body col-md-12 table-responsive mailbox-messages">
                          <div class="table-responsive mailbox-messages">

                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                    <th class="text-center" width="30%"><font size="5">จังหวัด</font></th>
                                    <th bgcolor="#99CCFF" class="text-center" width="70%"> 
                                        <select name="province_name" data-where="2" class="form-control ajax_address select2" style="width: 100%;">
                                            <option value="">-- เลือกจังหวัด --</option>
                                        </select>
                                    </th>
                                    </tr>
                                </tbody>
                            </table> 
                            <br> 

                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                    <th class="text-center" width="30%"><font size="5">อำเภอ</font></th>
                                    <th bgcolor="#99CCFF" class="text-center" width="70%"> 
                                    <select name="amphur_name" data-where="3" class="form-control ajax_address select2" style="width: 100%;">
                                        <option value="">-- เลือกอำเภอ --</option>
                                    </select>
                                    </th>
                                    </tr>
                                </tbody>
                            </table>
                            <br> 

                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit"  class="btn button2 pull-right">ต่อไป >></button>
                          <button type="button" class="btn button2 pull-left" data-dismiss="modal"><< กลับ</button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
          <div class="modal fade" id="mymodal3" role="dialog">
            <div class="modal-dialog modal-lg">
                <form action="total_order3.php" method="post">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <font size="5"><B> จำนวน ORDER ค้างส่ง </B></font>
                        </div>
                        <div class="modal-body col-md-12 table-responsive mailbox-messages">
                          <div class="table-responsive mailbox-messages">

                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                    <th class="text-center" width="30%"><font size="5">จังหวัด</font></th>
                                    <th bgcolor="#99CCFF" class="text-center" width="70%"> 
                                        <select name="province_name" data-where="2" class="form-control ajax_address select2" style="width: 100%;">
                                            <option value="">-- เลือกจังหวัด --</option>
                                        </select>
                                    </th>
                                    </tr>
                                </tbody>
                            </table> 
                            <br>  
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit"  class="btn button2 pull-right">ต่อไป >></button>
                          <button type="button" class="btn button2 pull-left" data-dismiss="modal"><< กลับ</button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
          <div class="modal fade" id="employee" role="dialog">
            <div class="modal-dialog modal-lg">
              <form action="../pdf_file/list_order_withdraw.php" method="post">
                <div class="modal-content">
                  <div class="modal-header text-center">
                    <font size="5"><B>ORDER เบิก</B></font>
                  </div>
                  <div class="modal-body col-md-12 table-responsive mailbox-messages">
                    <div class="table-responsive mailbox-messages">
                      <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <th class="text-center" width="30%"><font size="4">หน่วยรถ</font></th>
                            <th class="text-center" width="70%"> 
                              <select name="id_member" class="form-control" style="width: 100%;">
                                <option value="">-- เลือกหน่วยรถ --</option>
                                <?php 
                                  $sql_carmember = "SELECT id_member,name FROM member WHERE status ='employee' AND status_car=1";
                                  $objq_carmember = mysqli_query($mysqli,$sql_carmember);
                                  while($value_carmember = $objq_carmember->fetch_assoc()){
                                ?>
                                <option value="<?php echo $value_carmember['id_member'];?>"><?php echo $value_carmember['name'];?></option>
                                <?php
                                  }
                                ?>
                              </select>
                            </th>
                          </tr>
                        </tbody>
                      </table> 
                      <br> 
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit"  class="btn button2 pull-right">ต่อไป >></button>
                    <button type="button" class="btn button2 pull-left" data-dismiss="modal"><< กลับ</button>
                  </div>
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
    <script>
      $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
          'paging'      : true,
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : false,
          'info'        : true,
          'autoWidth'   : false,
        }
        )
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
            targetObj.html("<option>.. กำลังโหลดข้อมูล .. </option>"); // แสดงสถานะกำลังโหลด  
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