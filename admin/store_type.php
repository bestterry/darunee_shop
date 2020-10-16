<?php 
  require "../config_database/config.php"; 
  require "../session.php"; 
  $id_category = $_GET['id_category'];
  $sql_store = "SELECT * FROM store  
                INNER JOIN tbl_districts ON store.district_code = tbl_districts.district_code
                INNER JOIN tbl_amphures ON store.amphur_id = tbl_amphures.amphur_id
                INNER JOIN tbl_provinces ON store.province_id = tbl_provinces.province_id
                INNER JOIN store_category ON store.id_category = store_category.id
                INNER JOIN store_product_category ON store.id_product_category = store_product_category.id
                WHERE store.id_category = $id_category";
  $objq_store = mysqli_query($conn,$sql_store);
  $objq_store2 = mysqli_query($conn,$sql_store);
  $objr_store = mysqli_fetch_array($objq_store2);
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

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
      .button2 {
        background-color: #b35900;
        color : white;
        } 
    </style>
  </head>

  <body class=" hold-transition skin-blue layout-top-nav">
    <div class="wrapper">

      <header class="main-header">
        <?php require('menu/header_logout.php');?>
      </header>

      <div class="content-wrapper">
        <section class="content">
          <div class="col-12">
            <div class="box box-primary">

              <div class="box-header with-border">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <a type="button" href="store.php" class="btn button2"><< กลับ</a>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <div class="text-center">
                      <font size="5">
                        <B align="center">
                          <?php 
                            echo 'ร้าน'.$objr_store['name_category'];
                          ?>
                          </B>
                      </font>
                    </div>
                  </div>
                  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"></div>
                </div>
              </div>

              <div class="box-body no-padding">
                <div class="mailbox-read-message">
                
                  <table id="example2" class="table table-striped">
                    <thead>
                      <tr>
                        <th bgcolor="#99CCFF" class="text-center" width="10%">เยี่ยม</th>
                        <th bgcolor="#99CCFF" class="text-center" width="65%">ข้อมูลร้านค้า</th>
                        <th bgcolor="#99CCFF" class="text-center" width="10%">ร้าน</th>
                        <th bgcolor="#99CCFF" class="text-center" width="10%">ขาย</th>
                        <th bgcolor="#99CCFF" class="text-center" width="5%">#</th>
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
                            <a href="algorithm/update_ststore.php?id_store=<?php echo $value['id_store']; ?>&&status=N&&district_code=<?php echo $district_code; ?>" class="btn btn-danger btn-xs" onClick="return confirm('คุณต้องการที่จะเปลี่ยนสถานะเป็นยังเยี่ยมแล้วหรือไม่ ?')";>N</a>
                          <?php 
                            }else {
                          ?>
                            <a href="algorithm/update_ststore.php?id_store=<?php echo $value['id_store']; ?>&&status=Y&&district_code=<?php echo $district_code; ?>" class="btn btn-success btn-xs" onClick="return confirm('คุณต้องการที่จะเปลี่ยนสถานะเป็นไม่ได้เยี่ยมหรือไม่ ?')";>Y</a>
                          <?php 
                          
                            }
                          ?>

                        </td>
                        <td><?php echo $value['name_store'].'  '.$value['address'].'  '.' ต.'.$value['district_name'].'  '.'อ.'.$value['amphur_name'].' จ.'.$value['province_name'].' '.$value['tel'];?></td>
                        
                        <td class="text-center"><?php echo $value['name_category'];?></td>
                        <td class="text-center"><?php echo $value['name_product_category'];?></td>
                        <td class="text-center"><a href="store_edit.php?id_store=<?php echo $value['id_store']; ?>" class="btn btn-success btn-xs">แก้</td>
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

      <?php require("../menu/footer.html"); ?>
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
          'order': [],
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