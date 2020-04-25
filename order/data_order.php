<?php
 require "../config_database/config.php";
 require "../config_database/session.php";
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

   // $mysqli = connect();
   $id_order_list = $_GET['id_order_list'];
   //select SUM NUM PRODUCT 
   $sql_order = "SELECT * FROM order_list 
                   INNER JOIN product ON order_list.id_product = product.id_product
                   WHERE order_list.id_order_list = $id_order_list";
   $objq_order= mysqli_query($conn,$sql_order);
   $objr_order= mysqli_fetch_array($objq_order);

   $amphur_id = $objr_order['amphur_id'];

   $sql_amphur = "SELECT * FROM tbl2_amphures INNER JOIN tbl2_provinces ON tbl2_amphures.province_id = tbl2_provinces.province_id
   WHERE tbl2_amphures.amphur_id = $amphur_id";
   $objq_amphur = mysqli_query($conn,$sql_amphur);
   $objr_amphur = mysqli_fetch_array($objq_amphur);

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
    <section class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <div class='col-sm-12'>
                <div class="col-sm-4">
                  <a type="button" href="list_order.php" class="btn button2 "><< กลับ</a>
                </div>
                <div class="col-sm-4 text-center">
                  <a type="button" href="../pdf_file/data_order.php?id_order_list=<?php echo $id_order_list; ?>" class="btn btn-warning">ใบสั่งซื้อ</a>
                  <a type="button" href="../pdf_file/data_order2.php?id_order_list=<?php echo $id_order_list; ?>" class="btn btn-warning">หลังใบสั่ง</a>
                </div>
                <div class="col-sm-4 text-right">
                <?php 
                  if($status_user == 'boss'){
                ?>
                  <a type="button" href="algorithm/delete_order.php?id_order_list=<?php echo $id_order_list; ?>" class="btn btn-danger" onClick="return confirm('คุณต้องการลบข้อมูลหรือไม่?')";>ลบใบสั่ง</a>
                 <?php 
                    }else{

                  }
                 ?> 
                  <a type="button" href="edit_order.php?id_order_list=<?php echo $id_order_list; ?>" class="btn btn-success pull">edit >></a>
                
                </div>
              </div> 

              <br>
              <br>
              <br>
              <div class="text-center">
                <font size="5">
                  <B align="center">ข้อมูล (สั่งซื้อสินค้า) </B>
                </font>
              </div> 
             
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                  <div class="row">
                     <!-- ข้อมูลสินค้า -->
                     <div class="col-md-12">
                      <div>
                        <table class="table table-bordered" id="dynamic_field">
                          <tr>
                            <td width="25%" class="text-right">ID &nbsp;&nbsp;:</td>
                            <td width="25%" ><?php echo $objr_order["id_order_list"];?></td>
                            <td width="25%" class="text-right" >ค่าขนส่ง &nbsp;&nbsp;:</td>
                            <td width="25%"><?php echo $objr_order['portage'];?></td>
                          </tr>
                          <tr>
                            <td width="25%" class="text-right">ใบสั่งที่ &nbsp;&nbsp;:</td>
                            <td width="25%" ><?php echo $objr_order["list_order"];?></td>
                            <td width="25%" class="text-right" >ประเภทรถ &nbsp;&nbsp;:</td>
                            <td width="25%"><?php echo $objr_order['catagory_car'];?></td>
                          </tr>
                          <tr>
                            <td width="25%" class="text-right" >วันที่สั่ง &nbsp;&nbsp;:</td>
                            <td width="25%" ><?php echo DateThai($objr_order['date_order']); ?></td>
                            <td width="25%" class="text-right">ทะเบียนรถ &nbsp;&nbsp;:</td>
                            <td width="25%" ><?php echo $objr_order['licent_plate'];?></td>
                          </tr>
                          <tr>
                            <td width="25%" class="text-right" > สินค้า &nbsp;&nbsp;:</td>
                            <td width="25%" ><?php echo $objr_order['full_name'];?></td>
                            <td width="25%" class="text-right">พนักงานขับรถ &nbsp;&nbsp;:</td>
                            <td width="25%"> <?php echo $objr_order['name_sent'];?></td>
                          </tr>
                          <tr>
                            <td width="25%" class="text-right" >จำนวนสินค้า &nbsp;&nbsp;:</td>
                            <td width="25%" ><?php echo $objr_order['num_product'].' '.$objr_order['unit'];?></td>
                            <td width="25%" class="text-right" >เบอร์โทร พขร. &nbsp;&nbsp;:</td>
                            <td width="25%"><?php echo $objr_order['tel_sent'];?></td>
                          </tr>
                          <tr>
                            <td width="25%" class="text-right" >ราคาต่อหน่วย &nbsp;&nbsp;:</td>
                            <td width="25%"><?php echo $objr_order['price'];?></td>
                            <td width="25%" class="text-right">วันที่เข้ารับ &nbsp;&nbsp;:</td>
                            <td width="25%"><?php echo DateThai($objr_order['date_getorder']);?></td>
                          </tr>
                          <tr>
                            <td width="25%" class="text-right" >ราคาสินค้า &nbsp;&nbsp;:</td>
                            <td width="25%"><?php echo $objr_order['money'];?></td>
                            <td width="25%" class="text-right">วันที่รถมาถึง &nbsp;&nbsp;:</td>
                            <td width="25%"><?php echo DateThai($objr_order['date_receive']);?></td>
                          </tr>
                        </table>

                        <table class="table table-bordered" id="dynamic_field">
                          <tr>
                            <td width="25%" class="text-right">ชื่อร้าน &nbsp;&nbsp;:</td>
                            <td width="25%"><?php echo $objr_order['name_store'];?></td>
                            <td width="25%" class="text-right" >ผู้ประสานงาน &nbsp;&nbsp;:</td>
                            <td width="25%"><?php echo $objr_order['name_to'];?></td>
                            
                            </td>
                          </tr>
                          <tr>
                            <td width="25%" class="text-right" >จังหวัด &nbsp;&nbsp;:</td>
                            <td width="25%"><?php echo $objr_amphur['province_name'];?></td>
                            <td width="25%" class="text-right">เบอร์โทรประสานงาน &nbsp;&nbsp;:</td>
                            <td width="25%"><?php echo $objr_order['tel_to'];?></td>
                          </tr>
                          <tr>
                            <td width="25%" class="text-right" >อำเภอ &nbsp;&nbsp;:</td>
                            <td width="25%"><?php echo $objr_amphur['amphur_name'];?></td>
                            <td width="25%" class="text-right" >ผู้ออกใบสั่ง &nbsp;&nbsp;:</td>
                            <td width="25%" ><?php echo $objr_order['name_author'];?></td>
                          </tr>
                          <tr>
                            <td width="25%" class="text-right" >หมายเหตุ &nbsp;&nbsp;:</td>
                            <td width="25%"><?php echo $objr_order['note'];?></td>
                            <td width="25%" class="text-right" >ใบจ่าย &nbsp;&nbsp;:</td>
                            <td width="25%"><?php echo $objr_order['invoice'];?></td>
                          </tr>
                        </table>
                        
                      </div>
                    </div>
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
</body>
</html>