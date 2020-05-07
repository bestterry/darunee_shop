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
                  <a type="button" href="order.php" class="btn button2 pull-left"><< เมนูหลัก</a>
                  <a type="button" href="../pdf_file/list_order_today.php" class="btn btn-success pull-right">ORDER วันนี้</a>
                </div>
                <div class="box-body no-padding">
                  <div class="mailbox-read-message">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th class="text-center" width="5%">#</th>
                          <th class="text-center" width="70%">ข้อมูล ORDER ค้างส่ง</th>
                          <th class="text-center" width="5%">ทวง</th>
                          <th class="text-center" width="5%">เบิก</th>
                          <th class="text-center" width="5%">#</th>
                          <th class="text-center" width="5%">#</th>
                          <th class="text-center" width="5%">#</th>
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
                        ?>
                        <tr>
                          <td class="text-center"><a href="algorithm/sent_order.php?id_addorder=<?php echo $value['id_addorder']; ?>" class="btn btn-success btn-xs" onClick="return confirm('คุณต้องการที่จะเปลี่ยนสถานะเป็นส่งแล้วหรือไม่ ?')";>ส่ง</a></td>             
                          <td ><?php echo $value['id_addorder'].' '.$value['name_customer'].'   บ.'.$value['village'].' '.'ต.'.$value['district_name'].' '.'อ.'.$value['amphur_name'].' '.'จ.'.$value['province_name'].'  '.$value['tel'];?></td>
                          <?php
                            if($request == "N") {
                          ?>
                          <td class="text-center" ><a href="edit_list_order.php?id_addorder=<?php echo $value['id_addorder']; ?>" class="btn btn-danger btn-xs">N</a></td>
                          <?php
                            }else{
                          ?>
                          <td class="text-center" ><a href="edit_list_order.php?id_addorder=<?php echo $value['id_addorder']; ?>" class="btn btn-success btn-xs">Y</a></td>
                          <?php }?>
                          <?php
                            if(empty($id_wd)) {
                          ?>
                          <td class="text-center"><a href="algorithm/update_id_wd.php?id_addorder=<?php echo $value['id_addorder']; ?>&&status=N" class="btn btn-danger btn-xs">N</a></td>
                          <?php
                            }else{
                          ?>
                          <td class="text-center" ><a href="algorithm/update_id_wd.php?id_addorder=<?php echo $value['id_addorder']; ?>&&status=Y" class="btn btn-success btn-xs">Y</a></td>
                          <?php }?>
                          <td class="text-center" ><a href="edit_list_order.php?id_addorder=<?php echo $value['id_addorder']; ?>" class="fa fa-pencil" ></a></td>
                          <td class="text-center" ><?php echo DateThai($value['datetime']);?></td>
                          <td class="text-center" ><a href="list_order_des.php?id_addorder=<?php echo $value['id_addorder']; ?>"><i class="fa fa-search-plus"></i></a></td>
                         </tr>
                        <?php 
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="box-footer" align="center"> </div>
              </div>
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
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      }
       )
    }
     )
  </script>

</body>

</html>