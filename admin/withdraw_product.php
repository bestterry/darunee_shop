<?php 
    require "../config_database/config.php"; 
    require "../session.php";
    $sql_zone = "SELECT name_zone FROM zone  WHERE id_zone = '$_POST[id_zone]'";
    $objq_zone = mysqli_query($conn,$sql_zone);
    $objr_zone = mysqli_fetch_array($objq_zone);
 ?>

<!DOCTYPE html>
<html>

<head>
  <?php require('../font/font_style.php');?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>โปรแกรมขายหน้าร้าน</title>
  <!-- Tell the browser to be responsive to screen width -->
  <!-- Bootstrap 3.3.7 -->
  <link rel="icon" type="image/png" href="../images/favicon.ico" />
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

    <style>
      .button2 {
        background-color: #b35900;
        color : white;
        } /* Back & continue */
    </style>

</head>

<body class=" hold-transition skin-blue layout-top-nav ">
  <script language="javascript">
  function fncSubmit() {
    if (document.form1.add_num.value == "") {
      alert('กรุณาระบุจำนวน');
      document.form1.num.focus();
      return false;
    }
    if (document.form1.name.value == "") {
      alert('กรุณาระบุชื่อผู้รับเข้าสินค้า');
      document.form1.name.focus();
      return false;
    }
    document.form1.submit();
  }
  </script>
  <div class="wrapper">
    <header class="main-header">
      <?php require('menu/header_logout.php');?>
    </header>
    <div class="content-wrapper">
      <section class="content-header">
      </section>
      <section class="content">
        <div class="row">
          <div class="col-12 col-sm-12 col-xl-12 col-md-12">
            <div class="box box-primary">
              <form action="withdraw_product2.php" method="post">
                <div class="box-header text-center with-border">
                  <font size="5">
                    <B align="center"> เบิกสินค้าจาก : <?php echo $objr_zone['name_zone'];?></B>&nbsp;&nbsp;&nbsp;
                    <B> ผู้เบิก : 
                      <?php 
                          $sql_member = "SELECT * FROM member WHERE id_member = '$_POST[id_member]'";
                          $objq_member = mysqli_query($conn,$sql_member);
                          $member = mysqli_fetch_array($objq_member);
                          echo $member['name']; 
                      ?>   
                    </B>
                  </font>
                </div>
                <div class="box-body no-padding">
                  <div class="col-12">
                    <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
                    <div class="col-8 col-sm-8 col-xl-8 col-md-8">
                        <div class="mailbox-read-message">
                            <table class="table table-bordered">
                              <tbody>
                                <tr >
                                  <th class="text-center" width="33%"><font color="red">เลือก</font>
                                  </th>
                                  <th class="text-center" width="33%"><font color="red">สินค้า_หน่วย</font></th>
                                  </th>
                                  <th class="text-center" width="33%"><font color="red">จำนวนที่มี</font>
                                  </th>
                                </tr>
                                <?php
                                $i=1;
                                $list_product = "SELECT * FROM product INNER JOIN num_product ON product.id_product = num_product.id_product 
                                                 WHERE num_product.id_zone = '$_POST[id_zone]'
                                                 ORDER BY product.id_product ASC";
                                $objq_listproduct = mysqli_query($conn,$list_product);
                                    while($list = $objq_listproduct->fetch_assoc()){
                                ?>
                                <tr>
                                  <td class="text-center">
                                    <input type="checkbox" name="id_num_product[]" value="<?php echo $list['id_numproduct']; ?>">
                                  </td>
                                  <td class="text-center">
                                    <?php echo $list['name_product'].'_'.$list['unit']; ?>
                                  </td>
                                  <td class="text-center">
                                    <?php echo $list['num'];?>
                                  </td>
                                </tr>
                                <?php 
                                    $i++; }
                                ?>
                              </tbody>
                            </table>
                              <input type="hidden" name="id_zone" value="<?php echo $_POST['id_zone']; ?>">
                              <input type="hidden" name="name" value="<?php echo $member['name']; ?>">
                              <input type="hidden" name="id_member" value="<?php echo $member['id_member']; ?>">
                        </div>
                      </div>
                    <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
                  </div>
                </div>
                <div class="box-footer">
                <?php 
                  if(empty($_GET['status'])){
                ?>
                 <a type="block" href="withdraw_history.php" class="btn button2 pull-left"><< กลับ</a> 
                <?php 
                  }else{
                ?>
                 <a type="block" href="total_stock.php" class="btn button2 pull-left"><< กลับ</a> 
                <?php 
                  }
                ?>
                  <button type="submit" class="btn button2 pull-right">ถัดไป >> </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
    </div>
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
  });
 
  </script>
</body>

</html>