<?php 
 require "../config_database/config.php";
 require "../session.php";
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
</head>
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
                <li class="active"><a href="#store2" data-toggle="tab">ประวัติการเบิกเงิน</a></li>
                <!-- <li><a href="#store3" data-toggle="tab">เยี่ยมร้าน</a></li> -->
                <li><a href="#addstore" data-toggle="tab">โอนเงิน</a></li>
                <!-- <li><a href="#store3" data-toggle="tab">ตั้งค่า</a></li> -->
                <div align="right">
                  <a href="admin.php" class="btn btn-success"><< เมนูหลัก</a>
                </div> 
              </ul> 
              <div class="tab-content">
                <!-- ------------------------------ค้นหารายอำเภอ---------------------------- -->
                <div class="tab-pane active" id="store2">
                  <div class="box box-default">
                    <div class="box-header with-border"> </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="row">
                        <div class="container">
                          <form action="reserve_mn_hr.php" class="form-horizontal" method="post">
                            <div class="col-md-8">

                              <div class="form-group">
                                <label class="col-sm-2 control-label">ชื่อพนักงาน :</label>
                                <div class="col-sm-10">
                                  <select name="id_member" data-where="2" class="form-control ajax_address select2">
                                    <option value="">-- ชื่อพนักงาน --</option>
                                    <?php 
                                      $member = "SELECT * FROM member";
                                      $objq_member = mysqli_query($conn,$member);
                                      $objq_member2 = mysqli_query($conn,$member);
                                       while($value1 = $objq_member -> fetch_assoc()){
                                    ?>
                                    <option value="<?php echo $value1['id_member'];?>"><?php echo $value1['name']; ?></option>
                                    <?php 
                                       }
                                    ?>
                                  </select>
                                </div>
                              </div>
                              <!-- /.form-group -->
                             
                              <div align="center" class="box-footer">
                                <button type="submit" class="btn btn-success"><i class="fa fa-search"> ค้นหา </i></button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- ------------------------------//ค้นหารายอำเภอ---------------------------- -->


                <!-- ------------------------------เพิ่มร้าน---------------------------- -->
                <div class="tab-pane" id="addstore">
                  <div class="box box-default">
                    <div class="box-body">
                      <div class="row">
                        <div class="container">
                        <form action="algorithm/add_store.php" class="form-horizontal" method="post" autocomplete="off" name="add_store" onSubmit="JavaScript:return addStore();">
                            <div class="row">
                              <!-- ข้อมูลสินค้า -->
                              <div class="col-md-12">
                                <div>
                                  <table class="table table-bordered" id="dynamic_field">
                                    <tr>
                                    <th width="25%" class="text-right"><font size="4" valign="middle">ชื่อพนักงาน &nbsp;&nbsp;:</font></th>
                                      <td width="25%" > 
                                      <select name="id_member" data-where="2" class="form-control ajax_address select2">
                                        <option value="">-- ชื่อพนักงาน --</option>
                                        <?php 
                                          while($value2 = $objq_member2 -> fetch_assoc()){
                                        ?>
                                        <option value="<?php echo $vale2['id_member'];?>"><?php echo $value2['name']; ?></option>
                                        <?php 
                                          }
                                        ?>
                                      </select>
                                      </td>
                                      <th width="25%" class="text-right" ><font size="4">จำนวนเงิน &nbsp;&nbsp;:</font></th>
                                      <td width="25%"><input type="text" name="tel" class="form-control" value=""></td>
                                    </tr>
                                    
                                  </table>
                                  </div>
                                  <div class="col-md-3"></div>

                                </div>
                              </div>
                            </div>
                        </div>
                        <div align="center" class="box-footer">
                          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> บันทึกข้อมูล </button>
                        </div>
                      </div>
                      </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- ------------------------------เพิ่มร้าน---------------------------- -->

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

</body>

</html>