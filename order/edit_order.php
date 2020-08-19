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
    return "$strDay $strMonthThai $strYear";
  }

    $sql_product = "SELECT * FROM product WHERE status_order = 1";
    $objq_product = mysqli_query($mysqli,$sql_product);
     

    // $mysqli = connect();
    $id_order_list = $_GET['id_order_list'];
    //select SUM NUM PRODUCT 
    $sql_order = "SELECT * FROM order_list 
                    INNER JOIN product ON order_list.id_product = product.id_product
                    WHERE order_list.id_order_list = $id_order_list";
    $objq_order = mysqli_query($mysqli,$sql_order);
    $objr_order = mysqli_fetch_array($objq_order);

    $amphur_id = $objr_order['amphur_id'];
    $sql_amphur = "SELECT * FROM tbl2_amphures INNER JOIN tbl2_provinces ON tbl2_amphures.province_id = tbl2_provinces.province_id
                  WHERE tbl2_amphures.amphur_id = $amphur_id";
    $objq_amphur = mysqli_query($mysqli,$sql_amphur);
    $objr_amphur = mysqli_fetch_array($objq_amphur);

    $portage = $objr_order['portage'];
    if(!isset($portage)){
     $Vportage = 0;
    }else{
     $Vportage = $portage;
    } 
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
  </head>
  <body class=" hold-transition skin-blue layout-top-nav">
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
      <div class="content-wrapper">
        <section class="content">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <div> <a type="button" href="data_order.php?id_order_list=<?php echo $id_order_list;?>" class="btn button2 pull-left"> << กลับ </a> </div>
                <div class="text-center">
                  <font size="5">
                    <B align="center"> แก้ไขเพิ่มเติม (ข้อมูลใบสั่ง) </B>
                  </font>
                </div> 
              </div>
              <div class="box-body no-padding">
                <form action="edit_order_finish.php" class="form-horizontal" method="post" autocomplete="off" name="form1" onSubmit="JavaScript:return fncSubmit();">
                  <div class="mailbox-read-message">
                    <div class="row">
                      <div class="col-md-12">
                        <table class="table table-bordered" id="dynamic_field">
                          <tr>
                            <th width="20%" class="text-right"><font size="4" valign="middle">ID &nbsp;&nbsp;:</font></th>
                            <td width="30%" ><input type="text" name="id_order_list" class="form-control" value="<?php echo $id_order_list; ?>" disabled></td>
                            <th width="25%" class="text-right" ><font size="4">บาท/ตัน &nbsp;&nbsp;:</font></th>
                            <td width="25%"><input type="number" name="price_portage" onKeyUp="calcfunc()" class="form-control" value="<?php echo $objr_order['price_portage']; ?>"></td>
                          </tr>
                          <tr>
                            <th width="20%" class="text-right"><font size="4" valign="middle">ใบสั่งที่ &nbsp;&nbsp;:</font></th>
                            <td width="30%" > 
                            <input type="text" name="list_order" class="form-control" value="<?php echo $objr_order['list_order']; ?>">
                            <input type="hidden" name="id_order_list" class="form-control" value="<?php echo $id_order_list; ?>">
                            </td>
                            <th width="25%" class="text-right" ><font size="4">ค่าขนส่ง &nbsp;&nbsp;:</font></th>
                            <td width="25%"><input type="number" name="portage" onKeyUp="calcfunc()" class="form-control" value="<?php echo $Vportage; ?>"></td>
                          </tr>
                          <tr>
                            <th width="20%" class="text-right" ><font size="4">วันที่สั่ง &nbsp;&nbsp;:</font></th>
                            <td width="30%" ><input type="date" name="date_order" class="form-control" value="<?php echo $objr_order['date_order']; ?>"/></td>
                            <th width="25%" class="text-right" ><font size="4">ประเภทรถ &nbsp;&nbsp;:</font></th>
                            <td width="25%"><input type="text" name="catagory_car" class="form-control" value="<?php echo $objr_order['catagory_car']; ?>"></td>
                          </tr>
                          <tr>
                            <th width="20%" class="text-right" ><font size="4"> สินค้า &nbsp;&nbsp;:</font></th>
                            <td width="30%">
                              <label for="inputEmail3" class="col-sm-6 control-label"><?php echo $objr_order['full_name']; ?> </label>
                              <div class="col-sm-6">
                                <select name="id_product" class=" form-control" style="background-color: #e6f7ff;" >
                                  <option value="">-- เลือกสนค้า --</option>
                                  <?php
                                    while($value = $objq_product->fetch_assoc()){
                                  ?>
                                  <option value="<?php echo $value['id_product'];?>"><?php echo $value['full_name']. '('.$value['unit'].')';?></option>
                                  <?php
                                    }
                                  ?>
                                </select>
                              </div>
                            </th>
                            <th width="25%" class="text-right"><font size="4">ทะเบียนรถ &nbsp;&nbsp;:</font></th>
                            <td width="25%" ><input type="text" name="licent_plate" class="form-control" value="<?php echo $objr_order['licent_plate']; ?>"></td>
                          </tr>
                          <tr>
                            <th width="20%" class="text-right" ><font size="4">จำนวนสินค้า &nbsp;&nbsp;:</font></th>
                            <td width="30%"><input type="number" name="num_product"  onKeyUp="calcfunc()" class="form-control" value="<?php echo $objr_order['num_product']; ?>"></td>
                            <th width="25%" class="text-right"><font size="4">พนักงานขับรถ &nbsp;&nbsp;:</font></th>
                            <td width="25%"> <input type="text" name="name_sent" class="form-control" value="<?php echo $objr_order['name_sent']; ?>"></td>
                          </tr>
                          <tr>
                            <th width="20%" class="text-right"><font size="4">ราคาต่อหน่วย &nbsp;&nbsp;:</font></th>
                            <td width="30%"><input type="number" name="price"  onKeyUp="calcfunc()"  class="form-control" value="<?php echo $objr_order['price']; ?>"></td>
                            <th width="25%" class="text-right" ><font size="4">เบอร์โทร พขร. &nbsp;&nbsp;:</font></th>
                            <td width="25%"><input type="text" name="tel_sent" class="form-control" value="<?php echo $objr_order['tel_sent']; ?>"></td>
                          </tr>
                          <tr>
                            <th width="20%" class="text-right"><font size="4">ราคาสินค้า &nbsp;&nbsp;:</font></th>
                            <td width="30%"><input type="number" name="money"  class="form-control" value="<?php echo $objr_order['money']; ?>"></td>
                            <th width="25%" class="text-right"><font size="4">วันที่เข้ารับ &nbsp;&nbsp;:</font></th>
                            <td width="25%"><input type="date" name="date_getorder"  class="form-control" value="<?php echo $objr_order['date_getorder']; ?>"></td>
                          </tr>
                          <tr>
                            <th width="20%" class="text-right"><font size="4"</font></th>
                            <td width="30%"></td>
                            <th width="25%" class="text-right"><font size="4">วันที่รถมาถึง &nbsp;&nbsp;:</font></th>
                            <td width="25%"><input type="date" name="date_receive"  class="form-control" value="<?php echo $objr_order['date_receive']; ?>"></td>
                          </tr>
                        </table>

                        <table class="table table-bordered" id="dynamic_field">
                          <tr>
                            <th width="15%" class="text-right"><font size="4">ชื่อร้าน &nbsp;&nbsp;:</font></th>
                            <td width="35%"><input type="text" name="name_store" value="<?php echo $objr_order['name_store']; ?>" class="form-control " /></td>
                            <th width="25%" class="text-right" ><font size="4">ผู้ประสานงาน &nbsp;&nbsp;:</font></th>
                            <td width="25%"><input type="text" name="name_to" class="form-control" value="<?php echo $objr_order['name_to'];?>"/></td>
                            </td>
                          </tr>
                          <tr>
                            <th width="15%" class="text-right" ><font size="4">จังหวัด &nbsp;&nbsp;:</font></th>
                            <td width="35%" class="text-left">
                              <label for="inputEmail3" class="col-sm-4 control-label"><?php echo 'จ.'.$objr_amphur['province_name']; ?> </label>
                              <div class="col-sm-8">
                                <select name="province_name" data-where="2" class="form-control ajax_address select2" style="background-color: #e6f7ff;">
                                  <option value="">-- เลือกจังหวัด --</option>
                                </select>
                              </div>
                            </td>
                            <th width="25%" class="text-right"><font size="4">เบอร์โทรประสานงาน &nbsp;&nbsp;:</font></th>
                            <td width="25%"><input type="text" name="tel_to" value="<?php echo $objr_order['tel_to'];?>"  class="form-control "></td>
                          </tr>
                          <tr>
                            <th width="15%" class="text-right" ><font size="4">อำเภอ &nbsp;&nbsp;:</font></th>
                            <td width="35%">
                              <label for="inputEmail3" class="col-sm-4 control-label"><?php echo 'อ.'.$objr_amphur['amphur_name']; ?> </label>
                              <div class="col-sm-8">
                                <select name="amphur_name" data-where="3" class="ajax_address form-control select2" style="background-color: #e6f7ff;" >
                                  <option value="">-- เลือกอำเภอ --</option>
                                </select>
                              </div>
                            </td>
                            <th width="25%" class="text-right" ><font size="4">ผู้ออกใบสั่ง &nbsp;&nbsp;:</font></th>
                            <td width="25%"><input type="text" name="name_author" class="form-control" value="<?php echo $objr_order['name_author']; ?>"></td>
                          </tr>
                          <tr>
                            <th width="15%" class="text-right" ><font size="4">หมายเหตุ &nbsp;&nbsp;:</font></th>
                            <td width="35%"><input type="text" name="note" class="form-control" value="<?php echo $objr_order['note'];?>"></td>
                            <th width="25%" style="background-color:#ff9999;" class="text-right"><font size="4">ใบจ่าย &nbsp;&nbsp;:</font></th>
                            <td width="25%" style="background-color:#ff9999;"><input type="text" name="invoice" class="form-control" value="<?php echo $objr_order['invoice']; ?>"></td>
                          </tr>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <div align="center" class="box-footer">
                      <button type="submit" class="btn btn-success" name="add" id="add"><i class="fa fa-save"></i> บันทึกข้อมูล </button>
                    </div>
                  </div>
                </form>
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

        function calcfunc() {
                var val1 = parseFloat(document.form1.price.value);
                var val2 = parseFloat(document.form1.num_product.value);
                var val3 = parseFloat(document.form1.price_portage.value);
                document.form1.money.value=val1*val2;
                document.form1.portage.value=((val2*50)/1000)*val3;
              }
      </script>
  </body>

</html>