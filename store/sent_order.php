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
    return "$strDay";
  }
?>
<!DOCTYPE html>
<html>

<head>
  <?php require('../font/font_style.php'); ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ส่ง ORDER</title>
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
</head>

<body class=" hold-transition skin-blue layout-top-nav">
  <div>
    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            
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
            <!-- /.box-header -->
          <div class="box-header with-border">
            <a type="button" href="store.php" class="btn btn-danger "><= เมนูหลัก</a>
            <a type="button" href="../pdf_file/list_order.php" class="btn btn-success ">พิมพ์จังหวัด</a>
            <a type="button" href="../pdf_file/list_order2.php" class="btn btn-success ">พิมพ์อำเภอ</a>
            <a type="button" href="../pdf_file/list_order_today.php" class="btn btn-success ">ORDER วันนี้</a>
            <a type="button" href="add_order.php" class="btn btn-warning ">เพิ่ม ORDER</a>

            <br>
            <div class="col-md-12 text-center"><font size="4"><B>ORDER ค้างส่ง</B></font></div>
          </div>
            <div class="box-body no-padding">
                <div class="mailbox-read-message">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="text-center" width="5%">ส่ง</th>
                      <th class="text-center" width="5%">ที่</th>
                      <th class="text-center" width="70%">ที่อยู่ลูกค้า</th>
                      <th class="text-center" width="5%">ทวง</th>
                      <th class="text-center" width="5%">เบิก</th>
                      <th class="text-center" width="5%">วัน</th>
                      <th class="text-center" width="5%">ข้อมูล</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                    $sql_addorder = "SELECT * FROM addorder 
                                    INNER JOIN tbl_districts ON addorder.district_code = tbl_districts.district_code
                                    INNER JOIN tbl_amphures ON addorder.amphur_id = tbl_amphures.amphur_id
                                    INNER JOIN tbl_provinces ON addorder.province_id = tbl_provinces.province_id
                                    WHERE addorder.status = 'pending' ORDER BY addorder.id_addorder DESC";
                    $objq_addorder = mysqli_query($conn,$sql_addorder);
                    while($value = $objq_addorder->fetch_assoc()){
                      $id_wd = $value['id_wd'];
                      $request = $value['request'];
                  ?>
                    <tr>
                      <td class="text-center"><a href="algorithm/sent_order.php?id_addorder=<?php echo $value['id_addorder']; ?>" class="btn btn-success btn-xs" onClick="return confirm('คุณต้องการที่จะส่งสินค้า [<?php echo '('.$value['id_addorder'].')  '.$value['name_customer'].'   บ.'.$value['village']; ?>] หรือไม่ ?')";>ส่ง</a></td>
                      <td class="text-center"><?php echo $value['id_addorder']; ?></td>
                      <td ><?php echo $value['name_customer'].'   บ.'.$value['village'].' '.'ต.'.$value['district_name'].' '.'อ.'.$value['amphur_name'].' '.'จ.'.$value['province_name'].'  '.$value['tel'];?></td>
                      <?php
                        if($request == "N") {
                      ?>
                      <td class="text-center" ><a class="btn btn-danger btn-xs">N</a></td>
                      <?php
                        }else{
                      ?>
                      <td class="text-center" ><a class="btn btn-success btn-xs">Y</a></td>
                      <?php }?>

                      <?php
                        if(empty($id_wd)) {
                      ?>
                      <td class="text-center"><a  href="algorithm/update_id_wd.php?id_member=<?php echo $id_member; ?>&&id_addorder=<?php echo $value['id_addorder']; ?>" class="btn btn-danger btn-xs">N</a></td>
                      <?php
                        }else{
                      ?>
                      <td class="text-center" ><a class="btn btn-success btn-xs">Y</a></td>
                      <?php }?>
                      <!-- <td class="text-center" ><a href="edit_list_order.php?id_addorder=<?php echo $value['id_addorder']; ?>" class="btn btn-success btn-xs" >แก้</a></td> -->
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
          </form>
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
        'paging'      : false,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      }
                              )
    }
     )
    $(function () {
      //Enable iCheck plugin for checkboxes
      //iCheck for checkbox and radio inputs
      $('.mailbox-read-message input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
      }
      
                                                          );
      //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })

      //Enable check and uncheck all functionality
      $(".checkbox-toggle").click(function () {
        var clicks = $(this).data('clicks');
        if (clicks) {
          //Uncheck all checkboxes
          $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
          $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
        }
        else {
          //Check all checkboxes
          $(".mailbox-messages input[type='checkbox']").iCheck("check");
          $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
        }
        $(this).data("clicks", !clicks);
      }
                                 );
      //Handle starring for glyphicon and font awesome
      $(".mailbox-star").click(function (e) {
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
      }
                              );
                              
    }
     );
  </script>

</body>

</html>