<?php 
    require "../config_database/config.php"; 
    print_r($_POST);
    $district_code = $_POST['district_name'];
    $sql_store = "SELECT * FROM store 
                  INNER JOIN tbl_districts ON store.district_code = tbl_districts.district_code
                  INNER JOIN tbl_amphures ON store.amphur_id = tbl_amphures.amphur_id
                  INNER JOIN tbl_provinces ON store.province_id = tbl_provinces.province_id
                  WHERE store.district_code = '$district_code'";
    $objq_store = mysqli_query($conn,$sql_store);

    die();
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

  #customers td,
  #customers th {
    border: 1px solid #ddd;
    padding: 8px;
  }

  #customers tr:nth-child(even) {
    background-color: #f2f2f2;
  }

  #customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    background-color: #99CCFF;
  }
  </style>

  <script language="javascript">
  //  function fncSum()
  //     {
  //       document.form1.money.value = parseFloat(document.form1.num_product.value) * parseFloat(document.form1.price.value);
  //     }
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
      <div class="row">
        <!-- Main content -->
        <section class="content">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <div class="text-center">
                <a href="store.php" class="btn btn-danger pull-left"><< กลับ</a>
                <a href="algorithm/changeST_store.php?amphur_name=<?php echo $amphur_name; ?>&&status=<?php echo $status; ?>" class="btn btn-success pull-right">เปลี่ยนสถานะ</a>
                  <font size="5">
                    <B align="center"></B>
                  </font>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <div class="mailbox-read-message">
                  <div class="modal-content">
                    <div class="modal-body col-md-12 table-responsive mailbox-messages">
                      <div class="table-responsive">
                        <div class="col-md-12">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th bgcolor="#99CCFF" class="text-center" width="10%">สถานะ</th>
                                <th bgcolor="#99CCFF" class="text-center" width="20%">ชื่อร้านค้า</th>
                                <th bgcolor="#99CCFF" class="text-center" width="40%">ที่อยู่</th>
                                <th bgcolor="#99CCFF" class="text-center" width="15%">เบอร์โทร</th>
                                <th bgcolor="#99CCFF" class="text-center" width="15%">ประเภท</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php 
                            while($value = $objq_store->fetch_assoc()){
                            ?>
                              <tr>
                              <?php 
                                if($_POST['status']=="Y"){
                              ?>
                                <td class="text-center"><small class="label bg-green" >Y</small></td>
                              <?php
                              }else{
                              ?>
                                <td class="text-center"><small class="label bg-red">N</small></td>
                              <?php
                              }
                              ?> 
                                <td class="text-center"><?php echo $value['name_store'];?></td>
                                <td class="text-center"><?php echo $value['address'].' ต.'.$value['district_name'].' อ.'.$value['amphur_name'].' จ.'.$value['province_name'];?></td>
                                <td class="text-center"><?php echo $value['tel'];?></td>
                                <td class="text-center"><?php echo $value['category'];?></td>
                              </tr>
                            <?php }?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
      </div>
      </form>
    </div>
  </div>
  </section>
  <!-- jQuery 3 -->
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