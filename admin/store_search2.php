<?php 
    require "../config_database/config.php"; 
    $amphur_name = $_POST['amphur_name'];
    $status = $_POST['status'];
    $sql_store = "SELECT * FROM store 
                  INNER JOIN tbl_districts ON store.district_code = tbl_districts.district_code
                  INNER JOIN tbl_amphures ON store.amphur_id = tbl_amphures.amphur_id
                  INNER JOIN tbl_provinces ON store.province_id = tbl_provinces.province_id
                  INNER JOIN store_category ON store.id_category = store_category.id
                  INNER JOIN store_product_category ON store.id_product_category = store_product_category.id
                  WHERE store.amphur_id = '$amphur_name' AND store.status = '$status'";
    $objq_store = mysqli_query($conn,$sql_store);
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
                    <img src="dist/img/user.png" class="img-circle" alt="User Image">
                    <p>
                      <small>สาขา : </small>
                    </p>
                  </li>
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

      <div class="content-wrapper">
        <section class="content">
          <div class="col-12">
            <div class="box box-primary">

              <div class="box-header with-border">
                <div class="text-center">
                  <a href="store.php" class="btn btn-danger pull-left"><< กลับ</a>
                  <a href="algorithm/changeST_store.php?amphur_name=<?php echo $amphur_name; ?>&&status=<?php echo $status; ?>" class="btn btn-success pull-right">เปลี่ยนสถานะ</a>
                </div>
              </div>

              <div class="box-body no-padding">
                <div class="mailbox-read-message">

                  <table  class="table table-striped">
                    <thead>
                      <tr>
                        <th bgcolor="#99CCFF" class="text-center" width="10%">สถานะ</th>
                        <th bgcolor="#99CCFF" class="text-center" width="40%">ข้อมูลร้านค้า</th>
                        <th bgcolor="#99CCFF" class="text-center" width="15%">เบอร์โทร</th>
                        <th bgcolor="#99CCFF" class="text-center" width="15%">ร้าน</th>
                        <th bgcolor="#99CCFF" class="text-center" width="15%">ขาย</th>
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
                            <a href="algorithm/update_ststore.php?id_store=<?php echo $value['id_store']; ?>&&status=N&&district_code=<?php echo $district_code; ?>" class="btn btn-danger btn-xs" onClick="return confirm('คุณต้องการที่จะเปลี่ยนสถานะเป็นยังเยี่ยมแล้วหรือไม่ ?')";><i class="fa fa-close"></i></a>
                          <?php 
                            }else {
                          ?>
                            <a href="algorithm/update_ststore.php?id_store=<?php echo $value['id_store']; ?>&&status=Y&&district_code=<?php echo $district_code; ?>" class="btn btn-success btn-xs" onClick="return confirm('คุณต้องการที่จะเปลี่ยนสถานะเป็นไม่ได้เยี่ยมหรือไม่ ?')";><i class="fa fa-check"></i></a>
                          <?php 
                          
                            }
                          ?>

                        </td>
                        <td><?php echo $value['name_store'].'  '.$value['address'].'  '.' ต.'.$value['district_name'].'  '.'อ.'.$value['amphur_name'].' จ.'.$value['province_name'];?></td>
                        <td class="text-center"><?php echo $value['tel'];?></td>
                        <td class="text-center"><?php echo $value['name_category'];?></td>
                        <td class="text-center"><?php echo $value['name_product_category'];?></td>
                        <td class="text-center"><a href="store_edit.php?id_store=<?php echo $value['id_store']; ?>" ><i class="fa fa-cog"></i></a></td>
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