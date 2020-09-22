<?php
  include("db_connect.php");
  $mysqli = connect();
  
  $id_order = "SELECT MAX(id_order_list) FROM order_list";
  $objq_order = mysqli_query($mysqli,$id_order);
  $objr_order = mysqli_fetch_array($objq_order);

  $n_id = $objr_order['MAX(id_order_list)']+1;

?>
<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
      if(document.form1.list_order.value == "")
      {
        alert('กรุณาระบุใบสั่งที่');
        document.form1.list_order.focus();
        return false;
      }	
      if(document.form1.date_order.value == "")
      {
        alert('กรุณาระบุวันที่สั่ง');
        document.form1.date_order.focus();		
        return false;
      }	
      if(document.form1.id_product.value == "")
      {
        alert('กรุณาเลือกสินค้า');
        document.form1.id_product.focus();		
        return false;
      }
      if(document.form1.num_product.value == "")
      {
        alert('กรุณาระบุจำนวนสินค้า');
        document.form1.num_product.focus();		
        return false;
      }	
      if(document.form1.name_author.value == "")
      {
        alert('กรุณาระบุผู้เขียนใบสั่ง');
        document.form1.name_author.focus();		
        return false;
      }
      if(document.form1.portage.value == "")
      {
        alert('กรุณาระบุค่าขนส่ง');
        document.form1.portage.focus();		
        return false;
      }

      if(document.form1.catagory_car.value == "")
      {
        alert('กรุณาเลือกประเภทรถ');
        document.form1.catagory_car.focus();		
        return false;
      }
      if(document.form1.licent_plate.value == "")
      {
        alert('กรุณาระบุทะเบียนรถ');
        document.form1.licent_plate.focus();		
        return false;
      }
      if(document.form1.name_sent.value == "")
      {
        alert('กรุณาระบุพนักงานขับรถ.');
        document.form1.name_sent.focus();		
        return false;
      }
      if(document.form1.tel_sent.value == "")
      {
        alert('กรุณาระบุเบอร์ พขร.');
        document.form1.tel_sent.focus();		
        return false;
      }      
      if(document.form1.date_getorder.value == "")
      {
        alert('กรุณาระบุรถเข้า รง. วันที่');
        document.form1.date_getorder.focus();		
        return false;
      }	
      // if(document.form1.date_receive.value == "")
      // {
      //   alert('กรุณาระบุรถมาถึง');
      //   document.form1.date_receive.focus();		
      //   return false;
      // }	
   

      if(document.form1.name_store.value == "")
      {
        alert('กรุณาระบุชื่อร้าน');
        document.form1.name_store.focus();		
        return false;
      }
      if(document.form1.province_name.value == "")
      {
        alert('กรุณาเลือกจังหวัด');
        document.form1.province_name.focus();		
        return false;
      }
      if(document.form1.amphur_name.value == "")
      {
        alert('กรุณาเลือกอำเภอ');
        document.form1.amphur_name.focus();		
        return false;
      }
      
      if(document.form1.name_to.value == "")
      {
        alert('กรุณาระบุชื่อผู้ประสานงาน');
        document.form1.name_to.focus();		
        return false;
      }
      if(document.form1.tel_to.value == "")
      {
        alert('กรุณาระบุเบอร์ผู้ประสานงาน');
        document.form1.tel_to.focus();		
        return false;
      }
    
   
      document.form1.submit();
    }
    function fncSum()
        {
          document.form1.money.value = parseFloat(document.form1.num_product.value) * parseFloat(document.form1.price.value);
        }
  </script>
    <style>
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
    <div class="content-wrapper" style="height: 820px;">
      <!-- Main content -->
      <form action="add_order_finish.php" class="form-horizontal" method="post" autocomplete="off" name="form1" onSubmit="JavaScript:return fncSubmit();">
      <section class="content">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <div>
                <a type="button" href="list_order.php" class="btn button2 pull-left"> << กลับ </a>
              </div> 
            
              <div class="text-center">
                <font size="5">
                  <B align="center"> ข้อมูล (สั่งซื้อสินค้า) </B>
                </font>
              </div> 
            <div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                  <div class="row">
                     <!-- ข้อมูลสินค้า -->
                     <div class="col-md-12">
                      <div>
                        <table class="table table-bordered" id="dynamic_field">
                          <tr>
                            <th width="25%" class="text-right" ><font size="4">ID &nbsp;&nbsp;:</font></th>
                            <td width="25%" ><input type="text" name="id_order_list" class="form-control" value="<?php echo $n_id; ?>"  style="background-color: #e6f7ff;" readonly/></td>
                            <th width="25%" class="text-right" ><font size="4">บาท/ตัน &nbsp;&nbsp;:</font></th>
                            <td width="25%"><input type="number" step="0.01" name="price_portage" onKeyUp="calcfunc()" class="form-control" placeholder="ค่าขนส่ง" value="0"></td>
                          </tr>
                          <tr>
                            <th width="25%" class="text-right"><font size="4" valign="middle">ใบสั่งที่ &nbsp;&nbsp;:</font></th>
                            <td width="25%" > <input type="text" name="list_order" class="form-control" placeholder="ใบสั่งที่" style="background-color: #e6f7ff;"></td>
                            <th width="25%" class="text-right" ><font size="4">ค่าขนส่ง &nbsp;&nbsp;:</font></th>
                            <td width="25%"><input type="number" step="0.01" name="portage" class="form-control"  placeholder="ค่าขนส่ง" value="0"></td>
                          </tr>

                          <tr>
                            <th width="25%" class="text-right" ><font size="4">วันที่สั่ง &nbsp;&nbsp;:</font></th>
                            <td width="25%" ><input type="date" name="date_order" class="form-control" placeholder="วันที่สั่ง" value="-" style="background-color: #e6f7ff;"></td>
                            <th width="25%" class="text-right" ><font size="4">ประเภทรถ &nbsp;&nbsp;:</font></th>
                            <td width="25%">
                              <select name="catagory_car" class="form-control text-center select2" style="background-color: #e6f7ff;">
                                <option class="text-center" value="">-- เลือกประเภทรถ --</option>
                                <option value="พ่วง">รถพ่วง</option>
                                <option value="หกล้อ">รถหกล้อ</option>
                                <option value="สิบล้อ">รถสิบล้อ</option>
                                <option value="ขนส่ง">ฝากขนส่ง</option>
                              </select>
                            </td>
                          </tr>

                          <tr>
                            <th width="25%" class="text-right" ><font size="4"> สินค้า &nbsp;&nbsp;:</font></th>
                            <td width="25%" >
                              <select name="id_product" id="id_product" class="form-control text-center" onchange="sSelect(this.value)" style="background-color: #e6f7ff;">
                                <option class="text-center" value="">-- เลือกสินค้า --</option>
                                <?php 
                                  $product = "SELECT * FROM product WHERE status_order = 1";
                                  $objq_product = mysqli_query($mysqli,$product);
                                  while($value = $objq_product->fetch_array()){
                                ?>
                                <option value="<?php echo $value['id_product'];?>"><?php echo $value['full_name'].'_'.$value['unit'];?></option>
                                <?php 
                                  }
                                ?>
                              </select>
                            </td>
                            <th width="25%" class="text-right"><font size="4">ทะเบียนรถ &nbsp;&nbsp;:</font></th>
                            <td width="25%" ><input type="text" name="licent_plate" class="form-control" placeholder="ทะเบียนรถ" value="-" style="background-color: #e6f7ff;"></td>
                          </tr>

                          <tr>
                            <th width="25%" class="text-right" ><font size="4">จำนวนสินค้า &nbsp;&nbsp;:</font></th>
                            <td width="25%" ><input type="number" step="0.01" name="num_product" onKeyUp="calcfunc()" class="form-control" style="background-color: #e6f7ff;" value=""></td>
                            <th width="25%" class="text-right"><font size="4">พนักงานขับรถ &nbsp;&nbsp;:</font></th>
                            <td width="25%"> <input type="text" name="name_sent" class="form-control" placeholder="ชื่อ พขร." value="-" style="background-color: #e6f7ff;"></td>
                          </tr>

                          <tr>
                            <th width="25%" class="text-right" ><font size="4">ราคาต่อหน่วย &nbsp;&nbsp;:</font></th>
                            <td width="25%" ><input type="number" step="0.01" name="price_num" class="form-control" id="price_num" onKeyUp="calcfunc()" style="background-color: #e6f7ff;" value="0"></td>
                            <th width="25%" class="text-right" ><font size="4">เบอร์โทร พขร. &nbsp;&nbsp;:</font></th>
                            <td width="25%"><input type="text" name="tel_sent" class="form-control" placeholder="เบอร์ พขร." value="-" style="background-color: #e6f7ff;"></td>
                          </tr>

                          <tr>
                            <th width="25%" class="text-right" ><font size="4">ราคาสินค้า &nbsp;&nbsp;:</font></th>
                            <td width="25%"><input type="text" name="money" class="form-control" placeholder="เงินซื้อ" value="0"></td>
                            <th width="25%" class="text-right" ><font size="4">วันที่เข้ารับ &nbsp;&nbsp;:</font></th>
                            <td width="25%"><input type="date" name="date_getorder" class="form-control" ></td>
                          </tr>

                          <tr>
                            <th width="25%" class="text-right" ></th>
                            <td width="25%"></td>
                            <th width="25%" class="text-right"><font size="4">วันที่รถมาถึง &nbsp;&nbsp;:</font></th>
                            <td width="25%"><input type="date" name="date_receive" class="form-control" value="" ></td>
                          </tr>
                        </table>

                        <table class="table table-bordered" id="dynamic_field">
                          <tr>
                            <th width="25%" class="text-right"><font size="4">ชื่อร้าน &nbsp;&nbsp;:</font></th>
                            <td width="25%"><input type="text" name="name_store" placeholder="ชื่อร้าน" class="form-control " value="-" style="background-color: #e6f7ff;"></td>
                            <th width="25%" class="text-right" ><font size="4">ผู้ประสานงาน &nbsp;&nbsp;:</font></th>
                            <td width="25%"><input type="text" name="name_to" placeholder="ผู้ประสานงาน" class="form-control" value="-" style="background-color: #e6f7ff;"></td>
                          </tr>

                          <tr>
                            <th width="25%" class="text-right" ><font size="4">จังหวัด &nbsp;&nbsp;:</font></th>
                            <td width="25%">
                              <select name="province_name" data-where="2" class="form-control ajax_address select2" value="-" style="background-color: #e6f7ff;">
                                <option value="">-- เลือกจังหวัด --</option>
                              </select>
                            </td>
                            <th width="25%" class="text-right"><font size="4">เบอร์โทรประสานงาน &nbsp;&nbsp;:</font></th>
                            <td width="25%"><input type="text" name="tel_to" placeholder="เบอร์ผู้รับ" value="-" class="form-control" style="background-color: #e6f7ff;"></td>
                          </tr>

                          <tr>
                            <th width="25%" class="text-right" ><font size="4">อำเภอ &nbsp;&nbsp;:</font></th>
                            <td width="25%">
                              <select name="amphur_name" data-where="3" class="ajax_address form-control select2" style="background-color: #e6f7ff;" >
                                <option value="">-- เลือกอำเภอ --</option>
                              </select>
                            </td>
                            <th width="25%" class="text-right" ><font size="4">ผู้ออกใบสั่ง &nbsp;&nbsp;:</font></th>
                            <td width="25%"><input type="text" name="name_author" value="" class="form-control " placeholder="ผู้ออกใบสั่ง" style="background-color: #e6f7ff;"></td>
                          </tr>

                          <tr>
                            <th width="25%" class="text-right" ><font size="4">หมายเหตุ &nbsp;&nbsp;:</font></th>
                            <td width="25%"><input type="text" name="note" class="form-control " value="-"></td>
                            <th width="25%" class="text-right"><font size="4">ใบจ่าย &nbsp;&nbsp;:</font></th>
                            <td width="25%"><input type="text" name="invoice" class="form-control" value="NO"></td>
                          </tr>
                        </table>
                        
                      </div>
                    </div>
                  </div>
              </div>
              <div align="center" class="box-footer">
                <button type="submit" class="btn btn-success" name="add" id="add"><i class="fa fa-save"></i> บันทึกข้อมูล </button>
              </div>
            </div>
          </div>
        </div>
      </section>
      </form>
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

      <script type="text/javascript">		
        function sSelect(value){  $.ajax({
            type:"POST",
            url:"select_product.php",
            data:{value:value},
            success:function(data){
                $("#price_num").val(data);
            }
          });
          return false;
        };

          function calcfunc() {
            var val1 = parseFloat(document.form1.price_num.value);
            var val2 = parseFloat(document.form1.num_product.value);
            var val3 = parseFloat(document.form1.price_portage.value);
            document.form1.money.value=val1*val2;
            document.form1.portage.value=((val2*50)/1000)*val3;
          }
      </script> 
</body>

</html>