<?php 
    require "../config_database/config.php"; 
    require "../session.php"; 
    $district_code = $_GET['district_name'];
    $sql_store = "SELECT * FROM store  
                  INNER JOIN tbl_districts ON store.district_code = tbl_districts.district_code
                  INNER JOIN tbl_amphures ON store.amphur_id = tbl_amphures.amphur_id
                  INNER JOIN tbl_provinces ON store.province_id = tbl_provinces.province_id
                  INNER JOIN store_category ON store.id_category = store_category.id
                  INNER JOIN store_product_category ON store.id_product_category = store_product_category.id
                  WHERE store.district_code = $district_code";
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

  <body class=" hold-transition skin-blue layout-top-nav ">
    <div class="wrapper">
      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../dist/img/user.png" class="user-image" alt="User Image">
                  <span class="hidden-xs"></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="user-header">
                    <img src="../dist/img/user.png" class="img-circle" alt="User Image">
                    <p>
                      <small>ADMIN</small>
                    </p>
                  </li>
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="../login/logout.php" class="btn btn-danger btn-flat">ออกจากระบบ</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      
      <div class="content-wrapper">
        <section class="content">
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
                          echo 'ต.'.$objr_store['district_name'].' อ.'.$objr_store['amphur_name'].' จ.'.$objr_store['province_name'];
                        ?>
                        </B>
                    </font>
                  </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                  <a type="button" href="algorithm/store_edit_amphur.php?district_code=<?php echo $district_code; ?>" class="btn btn-success pull-right" OnClick="return confirm('ต้องการเปลี่ยนสถานะเป็นส่งแล้วทั้งหมด หรือไม่')">เปลี่ยนสถานะ</a>
                </div>
              </div>
            </div>
            
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                <div class="col-12">
                  <table class="table table-bordered">
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
    
  </body>

</html>