<?php
  require "../config_database/config.php";
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
    return "$strDay $strMonthThai $strYear";
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
    <div class="content-wrapper" width="2000px">
      <!-- Main content -->
      <section class="content">
      <div class="col-md-12">
          <div class="box box-primary">
            <!-- /.box-header -->
          <div class="box-header with-border">
            <a type="button" href="../admin/admin.php" class="btn btn-danger "><< เมนูหลัก</a>
            <a type="button" href="add_order.php" class="btn btn-success">ใบสั่งใหม่</a>
            <a type="button" href="../pdf_file/receive_order.php" class="btn btn-warning">PDF</a>
          </div>
          <div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
              <div class=""></div>
                <thead>
                  <tr>
                    <th class="text-center" width="5%">ดู</th>
                    <th class="text-center" width="6%">ID</th>
                    <th class="text-center" width="14%">สินค้า</th>
                    <th class="text-center" width="6%">NO.</th>
                    <th class="text-center" width="10%">เข้า</th>
                    <th class="text-center" width="10%">ถึง</th>
                    <th class="text-center" width="33%">ร้าน</th>
                    <th class="text-center" width="15%">อำเภอ</th>
                    <!-- <th class="text-center" width="10%">จังหวัด</th> -->
                  </tr>
                </thead>
                <tbody>
                 <?php 
                    $order_list = "SELECT * FROM order_list
                                    INNER JOIN product ON order_list.id_product = product.id_product
                                    INNER JOIN tbl2_amphures ON order_list.amphur_id = tbl2_amphures.amphur_id
                                    INNER JOIN tbl2_provinces ON order_list.province_id = tbl2_provinces.province_id
                                    ORDER BY order_list.id_order_list DESC";
                    $objq_addorder = mysqli_query($conn,$order_list);
                    while($value = $objq_addorder->fetch_assoc()){
                 ?>
                  <tr>
                    <td class="text-center"><a href="data_order.php?id_order_list=<?php echo $value['id_order_list']; ?>"><i class="fa fa-search-plus"></i></a></td>
                    <td class="text-center"><?php echo $value['id_order_list'];?></td>
                    <td class="text-center" ><?php echo $value['name_product'].'_'.$value['unit'];?></td>
                    <td class="text-center" ><?php echo $value['num_product']; ?></td>
                    <td class="text-center" ><?php echo DateThai($value['date_getorder']);?></td>
                    <td class="text-center" ><?php echo DateThai($value['date_receive']) ;?></td>
                    <td class="text-center"><?php echo $value['name_store'];?></td>
                    <td class="text-center"><?php echo $value['amphur_name'];?></td>
                    <!-- <td class="text-center"><?php //echo $value['province_name'];?></td> -->
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
        })
      })
    </script>
</body>

</html>