<?php
  include("menu/db_connect.php");
  $mysqli = connect();
  $id_interview = $_GET['id_interview'];
  $interview = "SELECT * FROM interview 
                INNER JOIN tbl2_amphures ON tbl2_amphures.amphur_id = interview.amphures_id
                INNER JOIN tbl2_provinces ON tbl2_provinces.province_id = interview.provinces_id
                WHERE interview.id_interview = $id_interview";
  $objq_interview = mysqli_query($mysqli,$interview);
  $objr_interview = mysqli_fetch_array($objq_interview);
?>
<!DOCTYPE html>
<html>

  <?php require 'menu/header.php'; ?>

  <body class=" hold-transition skin-blue layout-top-nav">
   
      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              
            </ul>
          </div>
        </nav>
      </header>
      <div class="content-wrapper">
        <section class="content">

          <div class="box box-primary">
            <div class="row">
              <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8">
                <div class="topnav">
                  <a href="interview.php"> ค้นหา </a>
                  <a class="active" href="data_interview.php"> สัมภาษณ์ทั้งหมด </a>
                  <a href="add_interview.php"> เพิ่มสัมภาษณ์ </a>
                </div>
              </div>
              <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4">
                  <a class="btn button2 pull-right" href="../admin/admin.php"> << เมนูหลัก </a>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <div class="col-12">
                  <div class="col-2 col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    <a class="btn button2 pull-left" href="data_interview.php"> << กลับ </a>
                  </div>
                  <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8 text-center">
                    <font size="5"><B> แก้ไข สัมภาษณ์</B></font>
                  </div>
                  <div class="col-2 col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
                </div>
              </div>
              <form action="algorithm/edit_interview.php" class="form-horizontal" method="post" autocomplete="off" name="form1" onSubmit="JavaScript:return fncSubmit();">
                <div class="box-body no-padding">
                  <div class="mailbox-read-message">
                    <div class="row">
                      <div class="col-2 col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
                      <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8">

                        <div class="col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6">
                          <div class="form-group">
                            <label class="col-sm-4 control-label">ชื่อไฟล์ </label>
                            <div class="col-sm-8">
                              <input type="text" name="name_file" class="form-control" value="<?php echo $objr_interview['name_file']; ?>">
                              <input type="hidden" name="id_interview" class="form-control" value="<?php echo $id_interview; ?>">
                              <input type="hidden" name="id" class="form-control" value="<?php echo $objr_interview['id']; ?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-4 control-label">ชื่อ </label>
                            <div class="col-sm-8">
                              <input type="text" name="name" class="form-control" placeholder="ชื่อลูกค้า" value="<?php echo $objr_interview['name']; ?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-4 control-label">grade </label>
                            <div class="col-sm-8">
                              <select name="grade" class="form-control text-center" style="width: 100%;">
                                <option class="text-center" value="A" <?php if($objr_interview['grade']== 'A'){echo "selected";}?>> A </option>
                                <option class="text-center" value="B" <?php if($objr_interview['grade']== 'B'){echo "selected";}?>> B </option>
                                <option class="text-center" value="C" <?php if($objr_interview['grade']== 'C'){echo "selected";}?>> C </option>
                                <option class="text-center" value="D" <?php if($objr_interview['grade']== 'D'){echo "selected";}?>> D </option>
                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6">
                          <div class="form-group">
                            <label class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label">จังหวัด </label>
                            <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4">
                              <select name="province_id" data-where="2" class="form-control ajax_address select2" >
                                <option value="<?php echo $objr_interview['province_id'];?>"></option>
                              </select>
                            </div>
                            <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4">
                              <input type="text" class="form-control" value="<?php echo $objr_interview['province_name']; ?>" disabled>
                              <input type="hidden" name="province_id1" class="form-control" value="<?php echo $objr_interview['province_id']; ?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label  class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label">อำเภอ </label>
                            <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4">
                              <select name="amphur_id" data-where="3" class="ajax_address form-control select2" >
                                <option value="">-- เลือกอำเภอ --</option>
                              </select>
                            </div>
                            <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4">
                              <input type="text" class="form-control" value="<?php echo $objr_interview['amphur_name']; ?>" disabled>
                              <input type="hidden" name="amphur_id1" class="form-control" value="<?php echo $objr_interview['amphur_id']; ?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-4 control-label">เปิดแล้ว </label>
                            <div class="col-sm-8">
                              <label class="switch">
                                <input type="checkbox" name="status" <?php if($objr_interview['status']=="Y"){ echo "checked"; }else{} ?>>
                                <span class="slider round"></span>
                              </label>
                            </div>
                          </div>

                        </div>

                        

                        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                          <div class="form-group">
                            <label class="col-sm-2 control-label">หมายเหตุ </label>
                            <div class="col-sm-10">
                              <input type="text" name="note" class="form-control" value="<?php echo $objr_interview['note']; ?>">
                            </div>
                          </div>
                        </div>

                        <div class="col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6">
                          <div class="form-group">
                            <label class="col-sm-4 control-label"> </label>
                            <div class="col-sm-8">
                              <div class="table-responsive">
                                <table class="table table-bordered" id="product">
                                  <tr>
                                    <th class="text-center" width="90%"><font color="red"> สินค้า </font></th>
                                    <th class="text-center" width="10%"><font color="red">#</font></th>
                                  </tr>
                                  <tr>
                                    <?php 
                                      $sql_iv_product = "SELECT * FROM interview_product 
                                                      INNER JOIN product ON interview_product.id_product = product.id_product
                                                      WHERE interview_product.id = $objr_interview[id]";
                                      $objq_iv_product = mysqli_query($mysqli,$sql_iv_product);
                                      while($value_product = $objq_iv_product -> fetch_assoc()){
                                    ?>
                                    <tr>
                                      <td class="text-center"><?php echo $value_product['name_product']; ?></td>
                                      <td class="text-center">
                                       <a href="algorithm/delete_product.php?id_iv_product=<?php echo $value_product['id_iv_product']; ?>&&id_interview=<?php echo $id_interview;?>" 
                                          class="btn btn-danger"><i class="fa fa-minus"></i></a>
                                      </td>
                                    </tr>
                                    <?php 
                                      }
                                    ?>
                                    <td class="text-center">
                                      <select name="id_product[]" class="form-control text-center" style="width: 100%;">
                                        <option class="text-center" value="">-- เลือกสินค้า --</option>
                                        <?php 
                                          $product = "SELECT * FROM product WHERE status_order = 1";
                                          $objq_product = mysqli_query($mysqli,$product);
                                          while($value = $objq_product->fetch_array()){
                                        ?>
                                          <option value="<?php echo $value['id_product'];?>"><?php echo $value['full_name'];?></option>
                                        <?php 
                                          }
                                        ?>
                                      </select>
                                    </td>
                                    <td class="text-center"><button type="button" name="add_product" id="add_product" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                                  </tr>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6">
                          <div class="form-group">
                            <label class="col-sm-4 control-label">  </label>
                            <div class="col-sm-8">
                              <div class="table-responsive">
                                <table class="table table-bordered" id="plance">
                                  <tr>
                                    <th class="text-center" width="90%"><font color="red" >ใช้กับ </font></th>
                                    <th class="text-center" width="10%"><font color="red" >#</font></th>
                                  </tr>
                                  <tr>
                                    <?php 
                                     $sql_plance = "SELECT * FROM interview_plance
                                                    INNER JOIN plance ON interview_plance.id_plance = plance.id_plance
                                                    WHERE interview_plance.id = $objr_interview[id]";
                                      $objq_plance = mysqli_query($mysqli,$sql_plance);
                                      while($value_plance = $objq_plance -> fetch_assoc()){
                                    ?>
                                      <tr>
                                        <td class="text-center"><?php echo $value_plance['name_plance']; ?></td>
                                        <td class="text-center">
                                          <a href="algorithm/delete_plance.php?id_iv_plance=<?php echo $value_plance['id_iv_plance'];?>&&id_interview=<?php echo $id_interview;?>" 
                                             class="btn btn-danger"><i class="fa fa-minus"></i></a>
                                        </td>
                                      </tr>
                                    <?php 
                                      }
                                    ?>
                                    <td class="text-center">
                                      <select name="id_plance[]" class="form-control text-center" style="width: 100%;">
                                        <option class="text-center" value="">-- เลือกใช้ --</option>
                                        <?php 
                                          $plance = "SELECT * FROM plance";
                                          $objq_plance = mysqli_query($mysqli,$plance);
                                          while($value = $objq_plance->fetch_array()){
                                        ?>
                                          <option value="<?php echo $value['id_plance'];?>"><?php echo $value['name_plance'];?></option>
                                        <?php 
                                          }
                                        ?>
                                      </select>
                                    </td>
                                    <td class="text-center"><button type="button" name="add_plance" id="add_plance" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                                  </tr>
                                </table>
                              </div>
                            </div>
                          </div>
                          
                        </div>

                      </div>
                      <div class="col-2 col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
                      
                    </div>
                  </div>
                </div>

                <div align="center" class="box-footer">
                  <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> บันทึก</button>
                </div>
              </form>
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
            $.post("menu/getAddress.php", {
              IDTbl: 1
            }, function(data) {
              $("select[name=province_id]").html(data);
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
                  $.post("menu/getAddress.php", {
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
              $('#add_product').click(function(){
                i++;
                $('#product').append('<tr id="row'+i+'"><td><select name="id_product[]" class="form-control" style="width: 100%;"> <option value="">-- เลือกสินค้า --</option><?php $product = "SELECT * FROM product WHERE status_order = 1";$objq_product = mysqli_query($mysqli,$product);while($value = $objq_product->fetch_array()){?><option value="<?php echo $value['id_product'];?>"><?php echo $value['full_name'];?></option> <?php }?></select></td><td class="text-center"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove_product"><i class="fa fa-minus"></i></button></td></tr>');
                console.log(i);
              });
              
              $(document).on('click', '.btn_remove_product', function(){
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

            $(document).ready(function(){
              var a=1; 
              $('#add_plance').click(function(){
                a++;
                $('#plance').append('<tr id="row'+a+'"><td><select name="id_plance[]" class="form-control" style="width: 100%;"> <option value="">-- เลือกใช้กับ --</option><?php $plance = "SELECT * FROM plance";$objq_plance = mysqli_query($mysqli,$plance);while($value = $objq_plance->fetch_array()){?><option value="<?php echo $value['id_plance'];?>"><?php echo $value['name_plance'];?></option> <?php }?></select></td><td class="text-center"><button type="button" name="remove" id="'+a+'" class="btn btn-danger btn_remove_plance"><i class="fa fa-minus"></i></button></td></tr>');
                console.log(a);
              });
              
              $(document).on('click', '.btn_remove_plance', function(){
                var button_id2 = $(this).attr("id"); 
                $('#row'+button_id2+'').remove();
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
        

  </body>

</html>