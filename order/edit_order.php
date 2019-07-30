<?php 
  require "../config_database/config.php";

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
    $objq_order = mysqli_query($conn,$sql_order);
    $objr_order = mysqli_fetch_array($objq_order);

    $amphur_id = $objr_order['amphur_id'];
    $sql_amphur = "SELECT * FROM tbl_amphures INNER JOIN tbl_provinces ON tbl_amphures.province_id = tbl_provinces.province_id
                  WHERE tbl_amphures.amphur_id = $amphur_id";
    $objq_amphur = mysqli_query($conn,$sql_amphur);
    $objr_amphur = mysqli_fetch_array($objq_amphur);
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
  </style>

  <script language="javascript">
    function fncSubmit()
    {
      if(document.form1.list_order.value == "")
      {
        alert('กรุณาระบุใบสั่งที่');
        document.form1.list_order.focus();
        return false;
      }	
      if(document.form1.date_receive.value == "")
      {
        alert('กรุณาระบุรถมาถึง');
        document.form1.date_receive.focus();		
        return false;
      }	
      if(document.form1.num_product.value == "")
      {
        alert('กรุณาระบุจำนวนสินค้า');
        document.form1.num_product.focus();		
        return false;
      }	
      if(document.form1.price.value == "")
      {
        alert('กรุณาระบุราคา/น.');
        document.form1.price.focus();		
        return false;
      }	
      if(document.form1.portage.value == "")
      {
        alert('กรุณาระบุค่าขนส่ง');
        document.form1.portage.focus();		
        return false;
      }	
      if(document.form1.name_sent.value == "")
      {
        alert('กรุณาระบุชื่อ พขร.');
        document.form1.name_sent.focus();		
        return false;
      }	
      if(document.form1.tel_sent.value == "")
      {
        alert('กรุณาระบุเบอร์ พขร.');
        document.form1.tel_sent.focus();		
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
      if(document.form1.name_author.value == "")
      {
        alert('กรุณาระบุผู้เขียนใบสั่ง');
        document.form1.name_author.focus();		
        return false;
      }
      if(document.form1.status.value == "")
      {
        alert('กรุณาเลือกสถานะ');
        document.form1.status.focus();		
        return false;
      }
      if(document.form1.name_to.value == "")
      {
        alert('กรุณาระบุชื่อผู้รับ');
        document.form1.name_to.focus();		
        return false;
      }
      if(document.form1.tel_to.value == "")
      {
        alert('กรุณาระบุเบอร์ผู้รับ');
        document.form1.tel_to.focus();		
        return false;
      }

      
      document.form1.submit();
    }
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
      <!-- Main content -->
      <section class="content">

        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                <form action="edit_order_finish.php" method="post" autocomplete="off" name="form1" onSubmit="JavaScript:return fncSubmit();">
                  <div class="row">
                    <!-- ข้อมูลลูกค้า -->
                    <div class="col-md-5">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="dynamic_field">
                          <tr>
                            <th bgcolor="#99CCFF" width="25%">ใบสั่งที่ :</th>
                            <th width="85%">
                              <input type="text" name="list_order" class="form-control" value="<?php echo $objr_order['list_order']; ?>">
                              <input type="hidden" name="id_order_list" class="form-control" value="<?php echo $id_order_list; ?>">
                            </th>
                          </tr>
                          <tr>
                            <th bgcolor="#99CCFF" width="25%">วันที่สั่ง :</th>
                            <th width="85%"><input type="text"  class="form-control" value="<?php echo DateThai($objr_order['date_order']); ?>" disabled></th>
                          </tr>
                          <tr>
                            <th bgcolor="#99CCFF" width="25%">รถเข้า รง. :</th>
                            <th width="85%"><input type="text"  class="form-control" value="<?php echo DateThai($objr_order['date_getorder']); ?>" disabled></th>
                          </tr>
                          <tr>
                            <th bgcolor="#99CCFF" width="25%">รถมาถึง :</th>
                            <th width="85%"><input type="date" name="date_receive" class="form-control" value="<?php echo $objr_order['date_receive']; ?>"></th>
                          </tr>
                          <tr>
                            <th bgcolor="#99CCFF" width="25%">สินค้า :</th>
                            <th width="85%"><input type="text" class="form-control" value="<?php echo $objr_order['name_product']; ?>" disabled></th>
                          </tr>
                          <tr>
                            <th bgcolor="#99CCFF" width="25%">จำนวน_หน่วย :</th>
                            <th width="85%"><input type="text" name="num_product" class="form-control" value="<?php echo $objr_order['num_product']; ?>"></th>
                          </tr>
                          <tr>
                            <th bgcolor="#99CCFF" width="25%">ราคา/น. :</th>
                            <th width="85%"><input type="text" name="price" class="form-control" value="<?php echo $objr_order['price']; ?>"></th>
                          </tr>
                          <tr>
                            <th bgcolor="#99CCFF" width="25%">เงินซื้อ(บ.) :</th>
                            <th width="85%"><input type="text" name="money" class="form-control" value="<?php echo $objr_order['money']; ?>" ></th>
                          </tr>
                          <tr>
                            <th bgcolor="#99CCFF" width="25%">ภาษี :</th>
                            <th width="85%"><input type="text" name="vat" class="form-control" value="<?php echo $objr_order['vat']; ?>" ></th>
                          </tr>
                          <tr>
                            <th bgcolor="#99CCFF" width="25%">ค่าขนส่ง :</th>
                            <th width="85%"><input type="text" name="portage" class="form-control" value="<?php echo $objr_order['portage']; ?>"></th>
                          </tr>
                          <tr>
                            <th bgcolor="#99CCFF" width="25%">ค่าลงของ :</th>
                            <th width="85%"><input type="text" name="pay_portage" class="form-control" value="<?php echo $objr_order['pay_portage']; ?>"></th>
                          </tr>
                          <tr>
                            <th bgcolor="#99CCFF" width="25%">ชื่อ พขร. :</th>
                            <th width="85%"><input type="text" name="name_sent" class="form-control" value="<?php echo $objr_order['name_sent']; ?>"></th>
                          </tr>
                          <tr>
                            <th bgcolor="#99CCFF" width="25%">เบอร์ พขร. :</th>
                            <th width="85%"><input type="text" name="tel_sent" class="form-control" value="<?php echo $objr_order['tel_sent']; ?>"></th>
                          </tr>
                          <tr>
                            <th bgcolor="#99CCFF" width="25%">ทะเบียนรถ :</th>
                            <th width="85%"><input type="text" name="licent_plate" class="form-control" value="<?php echo $objr_order['licent_plate']; ?>"></th>
                          </tr>
                          <tr>
                            <th bgcolor="#99CCFF" width="25%">ผู้เขียนใบสั่ง :</th>
                            <th width="85%"><input type="text" name="name_author" class="form-control" value="<?php echo $objr_order['name_author']; ?>"></th>
                          </tr>
                          <tr>
                            <th bgcolor="#ff8080" width="25%">สถานะ :</th>
                            <th width="85%">
                              <select name="status" class="form-control text-center select2" style="width: 100%;">
                                <option class="text-center" value="">-- เลือกสถานะ --</option>
                                <option value="success"> ส่งแล้ว </option>
                                <option value="done"> ยังไม่ได้ส่ง </option>
                              </select>
                            </th>
                          </tr>
                        </table>
                      </div>
                    </div>

                    <!-- ข้อมูลสินค้้า -->
                    <div class="col-md-7">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="dynamic_field">
                        <tr>
                            <th bgcolor="#99CCFF" class="text-center" width="60%">จุดลงของ</th>
                            <th bgcolor="#99CCFF" class="text-center" width="20%">ผู้รับ</th>
                            <th bgcolor="#99CCFF" class="text-center" width="20%">เบอร์ผู้รับ</th>
                          </tr>
                          <tr>
                            <td class="text-center"><?php echo $objr_order['name_store'].'    '.'อ.'.$objr_amphur['amphur_name'].'     จ.'.$objr_amphur['province_name']; ?></td>
                            <td class="text-center"><input type="text" name="name_to" class="form-control text-center" value="<?php echo $objr_order['name_to']; ?>"></td>
                            <td class="text-center"><input type="text" name="tel_to" class="form-control text-center" value="<?php echo $objr_order['tel_to']; ?>"></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    </div>
                  </div>
                    <div class="box-footer with-border">
                      <a type="button" href="list_order.php" class="btn btn-danger"> <= กลับ</a>
                      <button type="submit" class="btn btn-success" name="add" id="add"><i class="fa fa-save"></i> บันทึก ORDER</button>
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

</body>

</html>