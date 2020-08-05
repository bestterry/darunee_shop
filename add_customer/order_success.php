<?php
  include("db_connect.php");
  $mysqli = connect();
  $date_sent = date("Y-m-d");
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
  function DateThai2($strDate)
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
?>
<!DOCTYPE html>
<html>

<head>
  <?php require('../font/font_style.php'); ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>รายการ ORDER ส่งเเล้ว</title>
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
    thead {
      color : red;
    }

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
                  <div class="col-12">
                    <div class="col-2 col-sm-2 col-xl-2 col-md-2">
                      <a type="button" href="list_order.php" class="btn button2"><< กลับ</a>
                    </div>
                    <div class="col-8 col-sm-8 col-xl-8 col-md-8 text-center">
                      <font size="5">
                        <B>ORDER ส่งแล้ว <?php echo DateThai2($date_sent); ?></B>
                      </font>
                    </div>
                    <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
                  </div>
                </div>
                <form action="../pdf_file/pick_order.php" method="post" autocomplete="off"> 
                  <div class="box-body no-padding">
                    <div class="mailbox-read-message">
                      <table id="example2" class="table">
                        <thead>
                          <tr>
                            <th class="text-center" width="4%">แก้</th>
                            <th class="text-center" width="4%">#</th>
                            <th class="text-center" width="83%">ข้อมูล ORDER ส่งแล้ว</th>
                            <th class="text-center" width="4%">ทวง</th>
                            <th class="text-center" width="4%">เบิก</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $sql_addorder = "SELECT * FROM addorder 
                                            INNER JOIN tbl_districts ON addorder.district_code = tbl_districts.district_code
                                            INNER JOIN tbl_amphures ON addorder.amphur_id = tbl_amphures.amphur_id
                                            INNER JOIN tbl_provinces ON addorder.province_id = tbl_provinces.province_id
                                            WHERE addorder.status = 'success' AND addorder.date_sent = '$date_sent' 
                                            ORDER BY addorder.id_addorder DESC";
                            $objq_addorder = mysqli_query($mysqli,$sql_addorder);
                            while($value = $objq_addorder->fetch_assoc()){
                              $request = $value['request'];
                              $id_wd = $value['id_wd'];
                              if(empty($id_wd)){
                                $name_member = '';
                               
                              }else{
                                $sql_member = "SELECT name_sub FROM member WHERE id_member = $id_wd";
                                $objq_member = mysqli_query($mysqli,$sql_member);
                                $objr_member = mysqli_fetch_array($objq_member);
                                $name_member = $objr_member['name_sub'];
                                
                              }
                          ?>
                          <tr>
                            <td class="text-center" ><a href="edit_list_order.php?id_addorder=<?php echo $value['id_addorder']; ?>&&status=success" class="fa fa-pencil" ></a></td>
                            <td class="text-center" ><?php echo DateThai($value['datetime']);?></td>
                            <!-- <td class="text-center"><a href="algorithm/sent_order.php?id_addorder=<?php echo $value['id_addorder']; ?>&&status=2" class="btn btn-success btn-xs" onClick="return confirm('คุณต้องการที่จะเปลี่ยนสถานะเป็นส่งแล้วหรือไม่ ?')";>ส่ง</a></td>              -->
                            <td ><?php echo $value['id_addorder'].' '.$value['name_customer'].'   บ.'.$value['village'].' '.'ต.'.$value['district_name'].' '.'อ.'.$value['amphur_name'].' '.'จ.'.$value['province_name'].'  '.$value['tel'];?></td>
                            <!-- <td class="text-center" ><input type="checkbox" name="id_addorder[]" value="<?php echo $value['id_addorder']; ?>"></td> -->
                            <td class="text-center"><?php if($request=='Y'){echo "ทวง";}else{}?></td>                         
                            <td class="text-center"><?php echo $name_member; ?></td>
                          </tr>
                          <?php 
                            }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <!-- <div class="box-footer" align="center"> <button type="submit" class="btn btn-success"> ตกลง </button> </div> -->
                </form>
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
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : false,
        }
        )
      });
    </script>
</body>

</html>