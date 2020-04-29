<?php 
 include("db_connect.php");
 $mysqli = connect();
  $sql_province = "SELECT * FROM tbl_provinces";
  $objq_province = mysqli_query($mysqli,$sql_province);
  $objq_province2 = mysqli_query($mysqli,$sql_province);

   $sql_sc = "SELECT * FROM store_category";
   $objq_sc = mysqli_query($mysqli,$sql_sc);

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
    <script>
      function addStore() {
          if (document.add_store.name_store.value == "") {
            alert('กรุณาระบุชื่อร้านค้า');
            document.add_store.name_store.focus();
            return false;
          }
          if (document.add_store.tel.value == "") {
            alert('กรุณาระบุเบอร์โทรศัพท์');
            document.add_store.tel.focus();
            return false;
          }
          if (document.add_store.address.value == "") {
            alert('กรุณาระบุที่อยู่');
            document.add_store.address.focus();
            return false;
          }
          if (document.add_store.province_name.value == "") {
            alert('กรุณาระบุจังหวัด');
            document.add_store.province_name.focus();
            return false;
          }
          if (document.add_store.province_name.value == "") {
            alert('กรุณาระบุอำเภอ');
            document.add_store.amphur_name.focus();
            return false;
          }
          if (document.add_store.district_name.value == "") {
            alert('กรุณาระบุตำบล');
            document.add_store.district_name.focus();
            return false;
          }
          document.add_store.submit();
        }
    </script>
    <style>
          .button2 {
        background-color: #b35900;
        color : white;
        } /* Back & continue */
    </style>
</head>

<body class=" hold-transition skin-blue layout-top-nav ">
  <div class="wrapper">
    <header class="main-header">
    </header>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <!-- form start -->
          <div class="col-md-12">
           <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#search" data-toggle="tab">ค้นหาระเบียนร้าน</a></li>
                <li><a href="#search_type" data-toggle="tab">ค้นหาประเภทร้าน</a></li>
                <li><a href="#addstore" data-toggle="tab">เพิ่มร้าน</a></li>
                <li><a href="#check" data-toggle="tab">จำนวนร้าน</a></li>
                <li><a href="#setting_amphur" data-toggle="tab">ตั้งค่าสถานะ</a></li>
                <div align="right">
                  <a href="admin.php" class="btn button2"><< เมนูหลัก</a>
                </div> 
              </ul> 
              <div class="tab-content">
                <!-- ------------------------------ค้นหารายอำเภอ---------------------------- -->
                <div class="tab-pane active" id="search">
                  <div class="box box-default">
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="row">
                        <div class="container">
                          <form action="store_search.php" class="form-horizontal" method="get">
                            <div class="col-md-12">

                              <div class="form-group">
                                <label class="col-sm-4 control-label">จังหวัด :</label>
                                <div class="col-sm-4">
                                  <select name="province_name" data-where="2"
                                    class="form-control ajax_address select2">
                                    <option value="">-- เลือกจังหวัด --</option>
                                  </select>
                                  <div class="col-sm-4"></div>
                                </div>
                              </div>
                              <!-- /.form-group -->
                              <div class="form-group">
                                <label class="col-sm-4 control-label">อำเภอ :</label>
                                <div class="col-sm-4">
                                  <select name="amphur_name" data-where="3"
                                    class="ajax_address form-control select2">
                                    <option value="">-- เลือกอำเภอ --</option>
                                  </select>
                                </div>
                                <div class="col-sm-4"></div>
                              </div>
                              <!-- /.form-group -->
                              <div class="form-group">
                                <label class="col-sm-4 control-label">ตำบล :</label>
                                <div class="col-sm-4">
                                  <select name="district_name" data-where="4"
                                    class="ajax_address form-control select2" style="width: 100%;">
                                    <option value="">-- เลือกตำบล --</option>
                                  </select>
                                </div>
                                <div class="col-sm-4"></div>
                              </div>

                              <div class="box-footer">
                                <div align="center" >
                                  <button type="submit" class="btn btn-success"><i class="fa fa-search"> ค้นหาระเบียนร้าน </i></button>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- ------------------------------//ค้นหารายอำเภอ---------------------------- -->

                <!-- ------------------------------ค้นหาประเภทร้าน---------------------------- -->
                <div class="tab-pane" id="search_type">
                  <div class="box box-default">
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="row">
                        <div class="container">
                          <form action="store_type.php" class="form-horizontal" method="get">
                            <div class="col-md-12">

                              <div class="form-group">
                                <label class="col-sm-4 control-label">ประเภทร้าน :</label>
                                <div class="col-sm-4">
                                  <select name="id_category" class="form-control">
                                    <option value="">-- เลือกประเภทร้าน --</option>
                                    <?php
                                      while($value_sc = $objq_sc ->fetch_assoc()){
                                    ?>
                                    <option value="<?php echo $value_sc['id'];?>"><?php echo $value_sc['name_category'];?></option>
                                    <?php    
                                      }
                                    ?>
                                  </select>
                                  <div class="col-sm-4"></div>
                                </div>
                              </div>
                              <div class="box-footer">
                                <div align="center" >
                                  <button type="submit" class="btn btn-success"><i class="fa fa-search"> ค้นหา </i></button>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- ------------------------------//ค้นหาประเภทร้าน---------------------------- -->

                <!-- ------------------------------เพิ่มร้าน---------------------------- -->
                <div class="tab-pane" id="addstore">
                  <div class="box box-default">
                    <div class="box-header with-border">
                      <div class="text-center">
                        <font size="5">
                          <B align="center">
                            เพิ่มร้านค้า
                          </B>
                        </font>
                      </div>
                    </div>
                    <div class="box-body">
                      <form action="algorithm/add_store.php" class="form-horizontal" method="post" autocomplete="off" name="add_store" onSubmit="JavaScript:return addStore();">
                        <div class="row">
                          <div class="container">
                            <div class="col-md-12">
                              
                              <table class="table table-bordered" id="dynamic_field">
                                <tr>
                                  <th width="25%" class="text-right" ><font size="4">จังหวัด &nbsp;&nbsp;:</font></th>
                                  <td width="25%" class="text-left">
                                    <select name="province_name" data-where="2" class="form-control ajax_address select2" style="background-color: #e6f7ff;">
                                      <option value="">-- เลือกจังหวัด --</option>
                                    </select>
                                  <th width="25%" class="text-right"><font size="4" valign="middle">ชื่อร้านค้า &nbsp;&nbsp;:</font></th>
                                  <td width="25%" > 
                                    <input type="text" name="name_store" class="form-control" value="">
                                  </td>
                                  </td>
                                </tr>

                                <tr>
                                  <th width="25%" class="text-right" ><font size="4">อำเภอ &nbsp;&nbsp;:</font></th>
                                  <td width="25%">
                                    <select name="amphur_name" data-where="3" class="ajax_address form-control select2" style="background-color: #e6f7ff;" >
                                      <option value="">-- เลือกอำเภอ --</option>
                                    </select>
                                  </td>
                                  <th width="25%" class="text-right" ><font size="4">ที่อยู่ &nbsp;&nbsp;:</font></th>
                                  <td width="25%" class="text-left"><input type="text" name="address" class="form-control" value=""></td>
                                </tr>

                                <tr>
                                  <th width="25%" class="text-right" ><font size="4">ตำบล &nbsp;&nbsp;:</font></th>
                                  <td width="25%">
                                    <select name="district_name" data-where="4" class="ajax_address form-control select2" style="background-color: #e6f7ff;" >
                                      <option value="">-- เลือกตำบล --</option>
                                    </select>
                                  </td>
                                  <th width="25%" class="text-right" ><font size="4">เบอร์โทร &nbsp;&nbsp;:</font></th>
                                  <td width="25%"><input type="text" name="tel" class="form-control" value=""></td>
                                </tr>

                                <tr>
                                  <th width="25%" class="text-right" ><font size="4">LAT &nbsp;&nbsp;:</font></th>
                                  <td width="25%">
                                    <input type="text" name="latitude" class="form-control" value="0">
                                  </td>
                                  <th width="25%" class="text-right"><font size="4" valign="middle">ประเภทร้าน &nbsp;&nbsp;:</font></th>
                                  <td width="25%" > 
                                    <select name="id_category" class="form-control" style="width: 100%;">
                                      <option value="">------กรุณาเลือก------</option>
                                      <option value="1">ส่ง</option>
                                      <option value="2">ปลีก</option>
                                      <option value="3">รถเร่</option>
                                    </select>
                                  </td>
                                </tr>

                                <tr>
                                  <th width="25%" class="text-right" ><font size="4">LONG &nbsp;&nbsp;:</font></th>
                                  <td width="25%">
                                    <input type="text" name="longtitude" class="form-control" value="0">
                                  </td>
                                  <th width="25%" class="text-right"><font size="4" valign="middle">ประเภทสินค้า &nbsp;&nbsp;:</font></th>
                                  <td width="25%" > 
                                    <select name="id_product_category" class="form-control" style="width: 100%;">
                                      <option value="">------กรุณาเลือก------</option>
                                      <option value="1">ปุ๋ย</option>
                                      <option value="2">ของกิน</option>
                                      <option value="3">ทั้งสอง</option>
                                    </select>
                                  </td>
                                </tr>

                                <tr>
                                  <th width="25%" class="text-right" ></th>
                                  <td width="25%" class="text-left"></td>
                                  <th width="25%" class="text-right" ><font size="4">สถานะ &nbsp;&nbsp;:</font></th>
                                  <td width="25%">
                                  <select name="status" class="form-control" style="width: 100%;">
                                      <option value="">------กรุณาเลือกสถานะ------</option>
                                      <option value="N">ไม่เยี่ยม</option>
                                      <option value="Y">เยี่ยมแล้ว</option>
                                    </select>
                                  </td>
                                </tr>
                              </table>

                            </div>
                            <div align="center" class="box-footer">
                              <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> บันทึกข้อมูล </button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- ------------------------------เพิ่มร้าน---------------------------- -->

                <!-- ------------------------------ตรวจสอบ---------------------------- -->
                <div class="tab-pane" id="check">
                  <div class="box box-default">
                    <div class="box-header with-border">
                      <div class="text-center">
                        <font size="5">
                          <B align="center">
                            จำนวนร้านค้า (ตามระเบียน)
                          </B>
                        </font>
                      </div>
                    </div>
                    <div class="box-body">
                      <div class="row">
                        <div class="container">
                            <table class="table table-striped table-bordered">
                              <tbody>
                                <tr>
                                  <th class="text-center" width="40%"><font color="red">จังหวัด</font></th>
                                  <th class="text-center" width="20%"><font color="red">จำนวนร้าน</font></th>
                                  <th class="text-center" width="20%"><font color="red">เยี่ยมแล้ว</font></th>
                                  <th class="text-center" width="20%"><font color="red">ไม่ได้เยี่ยม</font></th>
                                </tr>
                                <?php 
                                  while($value_pr2 = $objq_province2->fetch_array()){
                                    $province_id = $value_pr2['province_id'];

                                     //ร้านค้าเยี่ยมแล้ว อำเภอ//
                                  $sql = "SELECT id_store FROM store WHERE  province_id = $province_id";
                                  if ($result=mysqli_query($mysqli,$sql))
                                    {
                                    // Return the number of rows in result set
                                    $rowcount = mysqli_num_rows($result);
                                    }else{
                                      $rowcount = 0;
                                    }
                                    //ร้านค้าเยี่ยมแล้ว อำเภอ //

                                    //ร้านค้าเยี่ยมแล้ว//
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
                                  <td class="text-center"><?php echo $rowcount; ?></td>
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
                              <font size="4" color="red"> <?php echo $value_pr['province_name'];?> </font>
                            </B>
                          </div>
                          <table class="table table-striped table-bordered">
                            <tbody>
                              <tr>
                                <th class="text-center" width="40%"><font color="red">อำเภอ</font></th>
                                <th class="text-center" width="20%"><font color="red">จำนวนร้าน</font></th>
                                <th class="text-center" width="20%"><font color="red">เยี่ยมแล้ว</font></th>
                                <th class="text-center" width="20%"><font color="red">ไม่ได้เยี่ยม</font></th>
                              </tr>
                              
                              <?php 
                                $sql_amphur = "SELECT * FROM tbl_amphures WHERE province_id = $province_id";
                                $objq_amphur = mysqli_query($mysqli,$sql_amphur);
                                while($value_am = $objq_amphur->fetch_array()){
                                  $amphur_id = $value_am['amphur_id'];

                                  //ร้านค้าเยี่ยมแล้ว//
                                  $sql = "SELECT id_store FROM store WHERE amphur_id = $amphur_id";
                                  if ($result=mysqli_query($mysqli,$sql))
                                    {
                                    // Return the number of rows in result set
                                    $rowcount=mysqli_num_rows($result);
                                    }else{
                                      $rowcount = 0;
                                    }

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
                                <td class="text-center"><?php echo $rowcount; ?></td>
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
                <!-- ------------------------------ตรวจสอบ---------------------------- -->

                <!-- ------------------------------ตั้งค่า---------------------------- -->
                <div class="tab-pane" id="setting_amphur">
                  <div class="box box-default">
                 
                    <div class="box-body">
                      <div class="row">
                        <div class="container">
                          <form action="store_search2.php" class="form-horizontal" method="post">
                            <div class="col-md-12">  

                              <div class="form-group">
                                  <label class="col-sm-4 control-label">จังหวัด :</label>
                                  <div class="col-sm-4">
                                    <select name="province_name" data-where="2" class="form-control ajax_address select2" style="width: 100%;">
                                      <option value="">-- เลือกจังหวัด --</option>
                                    </select>
                                  </div>
                                  <div class="col-sm-4 "></div>
                                </div>
                                
                              <div class="form-group">
                                <label class="col-sm-4 control-label">อำเภอ :</label>
                                <div class="col-sm-4">
                                  <select name="amphur_name" data-where="3" class="ajax_address form-control select2">
                                    <option value="">-- เลือกอำเภอ --</option>
                                  </select>
                                </div>
                                <div class="col-sm-4 "></div>
                              </div>
                                
                              <div class="form-group">
                                <label class="col-sm-4 control-label">สถานะ :</label>
                                <div class="col-sm-4">
                                  <select name="status" class="form-control text-center select2" style="width: 100%;">
                                    <option value="">------กรุณาเลือก------</option>
                                    <option value="Y">เยี่ยมแล้ว</option>
                                    <option value="N">ไม่ได้เยี่ยม</option>
                                  </select>
                                </div>
                                <div class="col-sm-4 "></div>
                              </div>

                              <div class="box-footer">
                               <div align="center">
                                <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> กำหนดสถานะ </button>
                               </div>
                              </div>
                            </div>
                          </form>
                      </div>
                    </div>

                  </div>
                </div>
                <!-- ------------------------------ตั้งค่า---------------------------- -->

               
             </div>
            </div>
           </div>
        </div>
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