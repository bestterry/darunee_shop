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

  <script language="javascript">
    function fncSubmit()
    {
      if(document.form1.name_customer.value == "")
      {
        alert('กรุณาระบุชื่อลูกค้า');
        document.form1.name_customer.focus();
        return false;
      }	
      if(document.form1.village.value == "")
      {
        alert('กรุณาระบุหมู่บ้าน');
        document.form1.village.focus();		
        return false;
      }	
      if(document.form1.province_name.value == "")
      {
        alert('กรุณาระบุจังหวัด');
        document.form1.province_name.focus();
        return false;
      }	
      if(document.form1.amphur_name.value == "")
      {
        alert('กรุณาระบุอำเภอ');
        document.form1.amphur_name.focus();		
        return false;
      }	
      if(document.form1.district_name.value == "")
      {
        alert('กรุณาระบุตำบล');
        document.form1.district_name.focus();		
        return false;
      }	

      
      
      document.form1.submit();
    }
  </script>
  
</head>

<body class=" hold-transition skin-blue layout-top-nav">
  <div class="wrapper">
    <header class="main-header">
    <?php //require('menu/header_logout.php');?>
    </header>
    
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
          
            <div class="box-header text-center with-border">
            <table class="table table-bordered" >
                <tr>
                  <th width="30%" >
                    <a type="block" href="admin.php" class="btn btn-danger"><< เมนูหลัก</a>

                    <a href="#" data-toggle="modal" data-target="#cu" class="btn btn-success">PDF</a>
                      <div class="modal fade" id="cu" role="dialog">
                        <div class="modal-dialog modal-lg">
                          <form action="../pdf_file/acc_list.php" method="post">
                            <div class="modal-content">
                              <div class="modal-header text-center">
                                <font size="5"><B> เงินขาย สกต. </B></font>
                              </div>
                              <div class="modal-body col-md-12 table-responsive mailbox-messages">
                                <div class="table-responsive mailbox-messages">
                                  <div class="col-md-6">
                                    <div class="box-body">
                                      <strong><i class="fa fa-file-text-o margin-r-6"></i> การใช้ </strong>
                                      <p>&nbsp;&nbsp;&nbsp;&nbsp;-กรุณาเลือกวันที่ เพื่อดูข้อมูลเงินขาย สกต. ตามช่วงเวลา</p>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group text-center">
                                      <label>ตั้งเเต่ : </label>
                                      <input type="date" name="aday">
                                    </div>
                                    <div class="form-group text-center">
                                      <label>ถึง &nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                      <input type="date" name="bday">
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit"  class="btn btn-success pull-right">ถัดไป ==>></button>
                                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-close"> ปิดหน้าต่างนี้</i></button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                  </th>
                  <td width="40%" class="text-center"><font size="5"><B align="center">ขาย สกต. </B></font></td>
                  <td width="30%"></td>
                </tr>
              </table>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                <form action="algorithm/acc_market.php" class="form-horizontal" method="post" autocomplete="off" name="form1" onSubmit="JavaScript:return fncSubmit();">
                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-group">
                        <label class="col-sm-2 control-label">ชื่อลูกค้า :</label>

                        <div class="col-sm-10">
                          <input type="text" name="name_customer" class="form-control" placeholder="ชื่อลูกค้า">
                        </div>
                      </div>
                      <!-- /.form-group -->
                      <div class="form-group">
                        <label class="col-sm-2 control-label">บ้าน :</label>

                        <div class="col-sm-10">
                          <input type="text" name="village" class="form-control" placeholder="หมู่บ้าน">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">จังหวัด :</label>
                        <div class="col-sm-10">
                          <select name="province_name" data-where="2" class="form-control ajax_address select2" >
                            <option value="">-- เลือกจังหวัด --</option>
                          </select>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label  class="col-sm-2 control-label">อำเภอ :</label>
                        <div class="col-sm-10">
                          <select name="amphur_name" data-where="3" class="ajax_address form-control select2" >
                            <option value="">-- เลือกอำเภอ --</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">ตำบล :</label>
                        <div class="col-sm-10">
                          <select name="district_name" data-where="4" class="ajax_address form-control select2" style="width: 100%;">
                            <option value="">-- เลือกตำบล --</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">เบอร์โทร :</label>
                        <div class="col-sm-10">
                          <input type="text" name="tel" class="form-control" value="-" maxlength="200">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">หมายเหตุ :</label>
                        <div class="col-sm-10">
                          <input type="text" name="note" class="form-control" value="-" maxlength="200">
                        </div>
                      </div>

                      <div class="form-group">
                      
                        <div class="col-sm-12">
                        <button type="submit" type="submit" class="btn btn-success pull-right"> <i class="fa fa-save"></i> บันทึกข้อมูล </button>
                        </div>
                      </div>
                    </div>
                  
                    
                    <div class="col-md-7">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="dynamic_field">
                          <tr>
                            <th bgcolor="#66b3ff" class="text-center" width="40%">สินค้า_หน่วย</th>
                            <th bgcolor="#66b3ff" class="text-center" width="15%">จำนวน</th>
                            <th bgcolor="#66b3ff" class="text-center" width="15%">ราคา/น.</th>
                            <th bgcolor="#66b3ff" class="text-center" width="15%">จัดการ</th>
                          </tr>
                          <tr>
                            <td class="text-center">
                              <select name="id_product[]" class="form-control text-center select2" style="width: 100%;">
                                <option class="text-center" value="">-- เลือกสินค้า --</option>
                              <?php 
                                  $product = "SELECT * FROM product";
                                  $objq_product = mysqli_query($mysqli,$product);
                                  while($value = $objq_product->fetch_array()){
                                ?>
                                  <option value="<?php echo $value['id_product'];?>"><?php echo $value['name_product'].'_'.$value['unit'];?></option>
                                <?php 
                                  }
                                ?>
                              </select>
                            </td>
                            <td><input type="text" name="num[]" placeholder="จำนวน" class="form-control text-center" /></td>
                            <td><input type="text" name="price[]" placeholder="ราคา/น." class="form-control text-center" /></td>
                            <td class="text-center"><button type="button" name="add" id="add" class="btn btn-success">เพิ่มสินค้า</button></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <!-- /.row -->
                  </div>
                </form>
              </div>
              <div  class="box-body">
                <table id="example1" class="table table-bordered" >
                  <thead>
                    <tr>
                      <th bgcolor="#66b3ff" class="text-center" width="10%">วันที่</th>
                      <th bgcolor="#66b3ff" class="text-center" width="15%">ชื่อลูกค้า</th>
                      <th bgcolor="#66b3ff" class="text-center" width="45%">ที่อยู่</th>
                      <th bgcolor="#66b3ff" class="text-center" width="10%">ข้อมูล</th>
                      <th bgcolor="#66b3ff" class="text-center" width="10%">แก้ไข</th>
                      <th bgcolor="#66b3ff" class="text-center" width="10%">ลบ</th>
                    </tr>
                  </thead>
                  <?php 
                    $sql_acc = "SELECT * FROM acc_market INNER JOIN tbl_districts ON acc_market.district_id = tbl_districts.district_code
                                INNER JOIN tbl_amphures  ON acc_market.amphur_id = tbl_amphures.amphur_id
                                INNER JOIN tbl_provinces ON acc_market.province_id = tbl_provinces.province_id";
                    $objq_acc = mysqli_query($mysqli,$sql_acc);
                    while($value = $objq_acc->fetch_assoc()){
                  ?>
                  <tbody>
                    <tr> 
                      <td class="text-center"><?php echo $value['date_acc'];?></td>
                      <td class="text-center"><?php echo $value['name_customer'];?></td>
                      <td class="text-center"><?php echo $value['village'].'   ต.'.$value['district_name'].'  อ.'.$value['amphur_name'].'  จ.'.$value['province_name'].' '.$value['tel'];?></td>
                      <td class="text-center" ><a href="acc_market_list.php?id_acc_market=<?php echo $value['id_acc_market']; ?>"><i class="fa fa-search-plus"></i></a></td>
                      <td class="text-center" ><a href="acc_market_edit.php?id_acc_market=<?php echo $value['id_acc_market']; ?>" class="btn btn-success btn-xs" >แก้ไข</a></td>
                      <td class="text-center" ><a href="algorithm/delete_list_acc.php?id_acc_market=<?php echo $value['id_acc_market']; ?>" class="btn btn-danger btn-xs" onClick="return confirm('คุณต้องการลบข้อมูล สกต.หรือไม?')";>ลบ</a></td>
                    </tr>
                    <?php }?>
                  </tbody>
                </table>
              </div>
            </div>
            
          </div>
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

      <script>
      $(document).ready(function(){
        var i=1;
        $('#add').click(function(){
          i++;
          $('#dynamic_field').append('<tr id="row'+i+'"><td><select name="id_product[]" class="form-control select2" style="width: 100%;"> <option value="">-- เลือกสินค้า --</option><?php $product = "SELECT * FROM product";$objq_product = mysqli_query($mysqli,$product);while($value = $objq_product->fetch_array()){?><option value="<?php echo $value['id_product'];?>"><?php echo $value['name_product'].'_'.$value['unit'];?></option> <?php }?></select></td><td class="text-center"><input type="text" name="num[]" placeholder="จำนวน" class="form-control text-center" /></td><td><input type="text" name="price[]" placeholder="ราคา/น." class="form-control text-center" /></td><td class="text-center"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">ลบ</button></td></tr>');
        });
        
        $(document).on('click', '.btn_remove', function(){
          var button_id = $(this).attr("id"); 
          $('#row'+button_id+'').remove();
        });
        
        $('#submit').click(function(){		
          $.ajax({
            success:function(data)
            {
              alert(data);
              $('#add_name')[0].reset();
            }
          });
        });
        
      });
      </script>

        <script>
        $(function () {
          $('#example1').DataTable()
          $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
          })
        })
      </script>
</body>

</html>