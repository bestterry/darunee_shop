<?php 
    include("db_connect.php");
    $mysqli = connect();
    require "session.php"; 
    $district_code = $_GET['district_name'];
    
    $sql_store = "SELECT * FROM store  
                  INNER JOIN tbl_districts ON store.district_code = tbl_districts.district_code
                  INNER JOIN tbl_amphures ON store.amphur_id = tbl_amphures.amphur_id
                  INNER JOIN tbl_provinces ON store.province_id = tbl_provinces.province_id
                  INNER JOIN store_category ON store.id_category = store_category.id
                  INNER JOIN store_product_category ON store.id_product_category = store_product_category.id
                  WHERE store.district_code = $district_code AND store.status = 'N'";
    $objq_store = mysqli_query($mysqli,$sql_store);
    
    $objq_store2 = mysqli_query($mysqli,$sql_store);
    $objr_store = mysqli_fetch_array($objq_store2);

    if(isset($objr_store)){
      $district_name = "ตำบล  ".$objr_store['district_name'];
    }else{
      $district_name = "ไม่มีข้อมูลร้าน";
    }
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

</head>

<body class=" hold-transition skin-blue layout-top-nav">
  <div class="wrapper">
    <header class="main-header">
      <?php require('menu/header_logout.php');?>
    </header>

    <div class="content-wrapper">
      <div class="row">
        <section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <div class="col-12">
                <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 text-left">
                  <a href="visit_shop.php" class="btn btn-danger"><< กลับ</a>
                </div>
                <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
                  <font size="5"><B><?php echo $district_name;?></B></font>
                </div>
                <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
              </div>
            </div>
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th bgcolor="#99CCFF" class="text-center" width="10%">สถานะ</th>
                        <th bgcolor="#99CCFF" class="text-center" width="40%">ข้อมูลร้านค้า</th>
                        <th bgcolor="#99CCFF" class="text-center" width="14%">เบอร์โทร</th>
                        <th bgcolor="#99CCFF" class="text-center" width="13%">ร้าน</th>
                        <th bgcolor="#99CCFF" class="text-center" width="13%">ขาย</th>
                        <th bgcolor="#99CCFF" class="text-center" width="5%">พิกัด</th>
                        <th bgcolor="#99CCFF" class="text-center" width="5%">แก้ไข</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                      while($value = $objq_store->fetch_assoc()){
                    ?>
                      <tr>
                        <td class="text-center">
                          <?php 
                            if($value['status'] == "N"){
                          ?>
                            <a href="algorithm/update_ststore.php?id_store=<?php echo $value['id_store']; ?>&&status=N&&district_code=<?php echo $district_code; ?>" class="btn btn-danger btn-xs" onClick="return confirm('คุณต้องการที่จะเยี่ยมร้าน [<?php echo $value['name_store'];?>] หรือไม่ ?')";>เยี่ยมร้าน</a>
                          <?php 
                            }else {
                          ?>
                              <a href="algorithm/update_ststore.php?id_store=<?php echo $value['id_store']; ?>&&status=Y&&district_code=<?php echo $district_code; ?>" class="btn btn-success btn-xs" onClick="return confirm('คุณต้องการที่จะเปลี่ยนสถานะเป็นไม่ได้เยี่ยมหรือไม่ ?')";>เยี่ยมร้าน</a>
                          <?php 
                            
                            }
                          ?>

                        </td>
                        <td><?php echo $value['name_store'].'  '.$value['address'].'  '.' ต.'.$value['district_name'].'  '.'อ.'.$value['amphur_name'].' จ.'.$value['province_name'];?></td>
                        <td class="text-center"><?php echo $value['tel'];?></td>
                        <td class="text-center"><?php echo $value['name_category'];?></td>
                        <td class="text-center"><?php echo $value['name_product_category'];?></td>
                        <td class="text-center">
                          <?php 
                            if ($value['latitude']==0) {
                              echo '-';
                            }else {
                          ?>
                            <a href="https://www.google.com/maps/search/?api=1&query=<?php echo $value['latitude'];?>,<?php echo $value['longtitude']; ?>" class="btn btn-default btn-xs" target="_blank"><i class="fa fa-map-marker"></i>
                          <?php 
                            }
                          ?>
                        </td>
                        <td class="text-center"><a href="visit_edit.php?id_store=<?php echo $value['id_store']; ?>" ><i class="fa fa-cog"></i></a></td>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
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