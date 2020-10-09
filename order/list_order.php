<?php
  require "../config_database/config.php";
  require "../config_database/session.php";
  function DateThai($strDate)
  {
    $strYear = date("Y",strtotime($strDate))+543-2500;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai$strYear";
  }

  function DateThai2($strDate)
  {
    $strYear = date("Y",strtotime($strDate));
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay";
  }

  $sql_invoice = "SELECT SUM(money) FROM order_list WHERE invoice = 'NO'";
  $objq_invoice = mysqli_query($conn,$sql_invoice);
  $objr_invoice = mysqli_fetch_array($objq_invoice);

  $order_list = "SELECT * FROM order_list
  INNER JOIN product ON order_list.id_product = product.id_product
  INNER JOIN tbl2_amphures ON order_list.amphur_id = tbl2_amphures.amphur_id
  INNER JOIN tbl2_provinces ON order_list.province_id = tbl2_provinces.province_id
  ORDER BY order_list.id_order_list DESC";
  $objq_addorder = mysqli_query($conn,$order_list);

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
        <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <div class="col-sm-12">
                  <a type="button" href="../admin/admin.php" class="btn button2 pull-left"><< เมนูหลัก</a>
                  <a type="button" href="add_order.php" class="btn btn-success pull-right"> <i class="fa fa-plus"></i> ใบสั่งใหม่</a>
                </div>

                <div class="col-sm-12 text-center">
                    <font size="5">
                      <B> ประวัติ (สั่งซื้อสินค้า) </B>
                    </font>
                </div>
                <?php 
                  if($status_user == 'boss'){
                ?>
                <div class="col-sm-12 text-left">
                    <font size="3" color="red">
                      <B> ยอดหนี้ค้างจ่าย  <?php echo $objr_invoice['SUM(money)'];?> </B>
                    </font>
                </div>
                <?php 
                  }else{
                  }
                ?>
              </div>

              <div class="box-body">
                <?php 
                  if($status_user == 'boss'){
                ?>
                  <table id="example2" class="table table-bordered">
                    <thead>
                      <tr>
                        <th class="text-center" width="6%"><font color="red">ID</font></th>
                        <th class="text-center" width="13%"><font color="red">วันสั่ง</font></th>
                        <th class="text-center" width="10%"><font color="red">ใบสั่ง</font></th>
                        <th class="text-center" width="13%"><font color="red">สินค้า</font></th>
                        <th class="text-center" width="6%"><font color="red">U</font></th>
                        <th class="text-center" width="5%"><font color="red">N</font></th>
                        <th class="text-center" width="10%"><font color="red">เงินซื้อ</font></th>
                        <th class="text-center" width="12%"><font color="red">มาถึง</font></th>
                        <th class="text-center" width="10%"><font color="red">อำเภอ</font></th>
                        <th class="text-center" width="8%"><font color="red">จ่าย</font></th>
                        <th class="text-center" width="7%"><font color="red">ข้อมูล</font></th>
                        <!-- <th class="text-center" width="10%">จังหวัด</th> -->
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                        while($value = $objq_addorder->fetch_assoc()){
                    ?>
                      <tr>
                        <td class="text-center"><?php echo $value['id_order_list'];?></td>
                        <td class="text-center" ><?php echo DateThai($value['date_order']);?></td>
                        <td class="text-center"><?php echo $value['list_order'];?></td>
                        <td class="text-center" ><?php echo $value['name_product'].'_'.$value['unit'];?></td>
                        <td class="text-center" ><?php echo $value['price']; ?></td>
                        <td class="text-center" ><?php echo $value['num_product']; ?></td>
                        <td class="text-center" ><?php echo $value['money']; ?></td>
                        <td class="text-center" ><?php echo DateThai($value['date_receive']) ;?></td>
                        <td class="text-center"><?php echo $value['amphur_name'];?></td>
                        <td class="text-center"><?php echo $value['invoice'];?></td>
                        <td class="text-center"><a href="data_order.php?id_order_list=<?php echo $value['id_order_list']; ?>">>></a></td>
                        <!-- <td class="text-center"><?php //echo $value['province_name'];?></td> -->
                      </tr>
                    <?php 
                      }
                    ?>
                    </tbody>
                  </table>
                <?php 
                  }else{
                ?>
                  <table id="example2" class="table table-bordered">
                    <thead>
                      <tr>
                        <th class="text-center" width="5%"><font color="red">ID</font></th>
                        <th class="text-center" width="10%"><font color="red">วันสั่ง</font></th>
                        <th class="text-center" width="10%"><font color="red">ใบสั่ง</font></th>
                        <th class="text-center" width="10%"><font color="red">สินค้า</font></th>
                        <th class="text-center" width="5%"><font color="red">U</font></th>
                        <th class="text-center" width="5%"><font color="red">N</font></th>
                        <th class="text-center" width="10%"><font color="red">เงินซื้อ</font></th>
                        <th class="text-center" width="10%"><font color="red">เข้า รง.</font></th>
                        <th class="text-center" width="10%"><font color="red">มาถึง</font></th>
                        <th class="text-center" width="10%"><font color="red">อำเภอ</font></th>
                        <th class="text-center" width="5%"><font color="red">จ่าย</font></th>
                        <th class="text-center" width="5%"><font color="red">สั่ง</font></th>
                        <th class="text-center" width="5%"><font color="red">ข้อมูล</font></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                        while($value = $objq_addorder->fetch_assoc()){
                    ?>
                      <tr>
                        <td class="text-center"><?php echo $value['id_order_list'];?></td>
                        <td class="text-center" ><?php echo DateThai($value['date_order']);?></td>
                        <td class="text-center"><?php echo $value['list_order'];?></td>
                        <td class="text-center" ><?php echo $value['name_product'].'_'.$value['unit'];?></td>
                        <td class="text-center" ><?php echo $value['price']; ?></td>
                        <td class="text-center" ><?php echo $value['num_product']; ?></td>
                        <td class="text-center" ><?php echo $value['money']; ?></td>
                        <td class="text-center" ><?php echo DateThai($value['date_getorder']) ;?></td>
                        <td class="text-center" ><?php echo DateThai($value['date_receive']) ;?></td>
                        <td class="text-center"><?php echo $value['amphur_name'];?></td>
                        <td class="text-center"><?php echo $value['invoice'];?></td>
                        <td class="text-center"><?php echo $value['name_author'];?></td>
                        <td class="text-center"><a href="data_order.php?id_order_list=<?php echo $value['id_order_list']; ?>">>></a></td>
                      </tr>
                    <?php 
                      }
                    ?>
                    </tbody>
                  </table>
                <?php 
                  }
                ?>
              </div>
          </div>
        </div>
      </section>

      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <font size="4"> สินค้าสั่งซื้อรายเดือน </font> 
            </div>
            <form action="list_order2.php" method="post">
              <div class="modal-body col-sm-12">
                <div class="form-group">
                  
                  <div class="col-sm-12">
                    <label class="col-sm-4 control-label text-right"><font size="5"> ตั้งแต่วันที :</font></label>
                    <div class="col-sm-8">
                      <input class="form-control" type="date" name="aday">
                    </div>
                  </div>
                  
                  <div class="col-sm-12">
                    <label class="col-sm-4 control-label text-right"><font size="5"> ถึงวันที :</font></label>
                    <div class="col-sm-8">
                      <input class="form-control" type="date" name="bday">
                    </div>
                  </div>
                </div>
                
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary center-block">ค้นหา</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

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
          'order'    : [],
          'info'        : true,
          'autoWidth'   : false
        })
        }
      );
    </script>
  </body>

</html>