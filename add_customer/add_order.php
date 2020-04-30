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

  <script language="javascript">
    function fncSubmit()
    {
      if(document.form1.name_customer.value == "")
      {
        alert('กรุณาระบุชื่อลูกค้า');
        document.form1.name_customer.focus();
        return false;
      }	
      if(document.form1.tel.value == "")
      {
        alert('กรุณาระบุเบอร์โทรศัพท์');
        document.form1.tel.focus();		
        return false;
      }	
      
      document.form1.submit();
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
              
              <div class="text-center">
                <font size="5">
                  <B align="center"> เพิ่ม ORDER <font color="red"> </font></B>
                </font>
              </div>
              <div>
                <a type="button" href="order.php" class="btn button2 pull-left"> << กลับ </a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                <form action="finish.php" class="form-horizontal" method="post" autocomplete="off" name="form1" onSubmit="JavaScript:return fncSubmit();">
                  <div class="row">
                    <div class="col-md-5">
                     
                        <div class="form-group">
                        <label class="col-sm-4 control-label">จังหวัด :</label>
                        <div class="col-sm-8">
                          <select name="province_name" data-where="2" class="form-control ajax_address select2" >
                            <option value="">-- เลือกจังหวัด --</option>
                          </select>
                        </div>
                      </div>
                      <!-- /.form-group -->
                      <div class="form-group">
                        <label  class="col-sm-4 control-label">อำเภอ :</label>
                        <div class="col-sm-8">
                          <select name="amphur_name" data-where="3" class="ajax_address form-control select2" >
                            <option value="">-- เลือกอำเภอ --</option>
                          </select>
                        </div>
                      </div>
                      <!-- /.form-group -->
                      <div class="form-group">
                        <label class="col-sm-4 control-label">ตำบล :</label>
                        <div class="col-sm-8">
                          <select name="district_name" data-where="4" class="ajax_address form-control select2" style="width: 100%;">
                            <option value="">-- เลือกตำบล --</option>
                          </select>
                        </div>
                      </div>

                      <!-- /.form-group -->
                      <div class="form-group">
                        <label class="col-sm-4 control-label">บ้าน(ม) :</label>

                        <div class="col-sm-8">
                          <input type="text" name="village" class="form-control" placeholder="หมู่บ้าน">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-4 control-label">ลูกค้า :</label>
                        <div class="col-sm-8">
                          <input type="text" name="name_customer" class="form-control" placeholder="ชื่อลูกค้า">
                        </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-4 control-label">โทร :</label>
                          <div class="col-sm-8">
                            <input class="form-control" name="tel" placeholder="เบอร์โทรศัพท์">
                          </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-4 control-label">หมายเหตุ :</label>

                        <div class="col-sm-8">
                          <input type="text" name="note" class="form-control" value="-">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-7">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="dynamic_field">
                          <tr>
                            <th class="text-center" width="30%"><font color="red" >สินค้า_หน่วย </font></th>
                            <th class="text-center" width="20%"><font color="red" >บ/น.</font></th>
                            <th class="text-center" width="15%"><font color="red" >จำนวน </font></th>
                            <th class="text-center" width="25%"><font color="red" >เงิน </font></th>
                            <th class="text-center" width="10%"><font color="red" >#</font></th>
                          </tr>
                          <tr>
                            <td class="text-center">
                              <select name="id_product[]" class="form-control text-center" onchange="sSelect(this.value)" style="width: 100%;">
                                <option class="text-center" value="">-- เลือกสินค้า --</option>
                              <?php 
                                  $product = "SELECT * FROM product WHERE NOT id_product = 12 AND NOT id_product = 35";
                                  $objq_product = mysqli_query($mysqli,$product);
                                  while($value = $objq_product->fetch_array()){
                                ?>
                                  <option value="<?php echo $value['id_product'];?>"><?php echo $value['name_product'].'_'.$value['unit'];?></option>
                                <?php 
                                  }
                                ?>
                              </select>
                            </td>
                            <td><input type="number" name="price[]" id="price" onKeyUp="calcfunc()" placeholder="บ/น" class="form-control text-center" value=""/></td>
                            <td><input type="number" name="num[]"   id="num"   onKeyUp="calcfunc()" placeholder="จำนวน" class="form-control text-center" value=""/></td>
                            <td><input type="number" name="money[]" id="money" placeholder="เงิน" class="form-control text-center" value=""/></td>
                            <td class="text-center"><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <!-- /.row -->
                    
                  </div>
              </div>
              <div align="center" class="box-footer">
                
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> บันทึก ORDER</button>
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

    <script>
        $(document).ready(function(){
          var i=1; 
          $('#add').click(function(){
            i++;
            $('#dynamic_field').append('<tr id="row'+i+'"><td><select name="id_product[]" class="form-control" onchange="sSelect'+i+'(this.value)" style="width: 100%;"> <option value="">-- เลือกสินค้า --</option><?php $product = "SELECT * FROM product";$objq_product = mysqli_query($mysqli,$product);while($value = $objq_product->fetch_array()){?><option value="<?php echo $value['id_product'];?>"><?php echo $value['name_product'].'_'.$value['unit'];?></option> <?php }?></select></td><td><input type="number" name="price[]" id="price'+i+'" onKeyUp="calcfunc'+i+'()" placeholder="บ/น" class="form-control text-center" /></td><td class="text-center"><input type="text" name="num[]" id="num'+i+'" onKeyUp="calcfunc'+i+'()" placeholder="จำนวน" class="form-control text-center" /></td><td><input type="number" name="money[]" id="money'+i+'" placeholder="เงิน" class="form-control text-center" /></td><td class="text-center"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-minus"></i></button></td></tr>');
            console.log(i);
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

        function sSelect(value){
            $.ajax({
                      type:"POST",
                      url:"select_product.php",
                      data:{value:value},
                      success:function(data){
                        $("#price").val(data);
                      }
                  });
  
              return false;
              }

            

        function sSelect2(value){
            $.ajax({
                      type:"POST",
                      url:"select_product.php",
                      data:{value:value},
                      success:function(data){
                        $("#price2").val(data);
                      }
                  });
  
              return false;
              }
        
        function sSelect3(value){
            $.ajax({
                      type:"POST",
                      url:"select_product.php",
                      data:{value:value},
                      success:function(data){
                        $("#price3").val(data);
                      }
                  });
  
              return false;
              }
              
        function sSelect4(value){
            $.ajax({
                      type:"POST",
                      url:"select_product.php",
                      data:{value:value},
                      success:function(data){
                        $("#price4").val(data);
                      }
                  });
  
              return false;
              }
              
        function sSelect5(value){
            $.ajax({
                      type:"POST",
                      url:"select_product.php",
                      data:{value:value},
                      success:function(data){
                        $("#price5").val(data);
                      }
                  });
  
              return false;
              }

        function sSelect6(value){
            $.ajax({
                      type:"POST",
                      url:"select_product.php",
                      data:{value:value},
                      success:function(data){
                        $("#price6").val(data);
                      }
                  });
  
              return false;
              }
              
        function calcfunc() {
              var val1 = parseFloat(document.form1.price.value);
              var val2 = parseFloat(document.form1.num.value);
              document.form1.money.value=val1*val2;
            }

        function calcfunc2() {
            var val1 = parseFloat(document.form1.price2.value);
            var val2 = parseFloat(document.form1.num2.value);
            document.form1.money2.value=val1*val2;
          }

          function calcfunc3() {
            var val1 = parseFloat(document.form1.price3.value);
            var val2 = parseFloat(document.form1.num3.value);
            document.form1.money3.value=val1*val2;
          }

          function calcfunc4() {
            var val1 = parseFloat(document.form1.price4.value);
            var val2 = parseFloat(document.form1.num4.value);
            document.form1.money4.value=val1*val2;
          }

          function calcfunc5() {
            var val1 = parseFloat(document.form1.price5.value);
            var val2 = parseFloat(document.form1.num5.value);
            document.form1.money5.value=val1*val2;
          }

          function calcfunc6() {
            var val1 = parseFloat(document.form1.price6.value);
            var val2 = parseFloat(document.form1.num6.value);
            document.form1.money6.value=val1*val2;
          }
            

    </script>
      

</body>

</html>