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
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">
  <!-- Google Font -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition register-page">
  <div class="container">
    <div class="box box-primary">
      <div class="box-header with-border">
        <font size="4">
          <B> ประวัติรับเข้าสินค้า ประจำวันที่(
            <font size="4" color="red">
              <?php echo $strDate = date('d-m-Y');?>
            </font>)
        </font>
        </B>
      </div>
      <!-- /.box-header -->
      <div class="box-body no-padding">
        <div class="mailbox-read-message">
          <table class="table table-hover table-striped table-bordered">
            <tbody>
              <tr bgcolor="#99CCFF">
                <th class="text-center" width="40%">รายการ</th>
                <th class="text-center" width="15%">จำนวน</th>
                <th class="text-center" width="15%">ชื่อผู้ส่ง</th>
                <th class="text-center" width="25%">หมายเหตุ</th>
                <th class="text-center" width="10%">แก้ไข</th>
              </tr>
              <?php #endregion
									$date = "SELECT * FROM add_history INNER JOIN product ON add_history.id_product = product.id_product INNER JOIN member ON add_history.id_member = member.id_member
														WHERE DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate' AND add_history.id_zone = $id_zone";
									$objq = mysqli_query($conn,$date);
									while($value = $objq ->fetch_assoc()){
							?>
              <tr>
                <td>
                  <?php echo $value['name_product']; ?>
                </td>
                <td class="text-center">
                  <?php echo $value['num_add'];?> (
                  <?php echo $value['unit']; ?>)
                </td>
                <td class="text-center">
                  <?php echo $value['name'];?>
                </td>
                <td class="text-center">
                  <?php echo $value['note'];?>
                </td>
                <td class="text-center">
                  <a href="edit_add_history.php?id_add=<?php echo $value['id_add_history']; ?>"><span
                      class="glyphicon glyphicon-cog"></span></a>
                </td>
              </tr>
              <?php
                              }
                            ?>
            </tbody>
          </table>
        </div>
        <!-- /.mailbox-read-message -->
        <div class="box-header with-border">
          <font size="4">
            <B> ยอดรวมรับเข้าสินค้า ประจำวันที่(
              <font size="4" color="red">
                <?php echo $strDate = date('d-m-Y');?>
              </font>)
          </font>
          </B>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <div class="mailbox-read-message">
            <table class="table table-hover table-striped table-bordered">
              <tbody>
                <tr bgcolor="#99CCFF">
                  <th class="text-center" width="40%">รายการ</th>
                  <th class="text-center" width="20%">จำนวน</th>
                </tr>
                <?php #endregion
                            $sql_history = "SELECT * FROM product";
                            $objq_history = mysqli_query($conn,$sql_history);
                            while($history = $objq_history ->fetch_assoc()){
                              $id_product = $history['id_product'];
                              $total_sale = "SELECT SUM(add_history.num_add) FROM add_history 
                                              INNER JOIN product ON add_history.id_product=product.id_product
                                              WHERE add_history.id_product = '$id_product' AND DATE_FORMAT(add_history.datetime,'%d-%m-%Y')='$strDate' AND add_history.id_zone=$id_zone";
                              $objq_sale = mysqli_query($conn,$total_sale);
                              $objr_sale = mysqli_fetch_array($objq_sale);
                              $num_product = $objr_sale['SUM(add_history.num_add)'];
                              if(isset($num_product)){ 
                          ?>
                <tr>
                  <td>
                    <?php echo $history['name_product']; ?>
                  </td>
                  <td class="text-center">
                    <?php echo$num_product; ?> (
                    <?php echo $history['unit']; ?>)
                  </td>
                </tr>
                <?php }
																
                          } ?>
              </tbody>
            </table>
            <div class="box-footer">
              <div class="col-md-6 col-md-push-6">
                <a type="button" href="../pdf_file/add_history.php" class="btn btn-success">
                  <i class="fa fa-print"> พิมพ์ </i>
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- /.register-box -->
        <!-- jQuery 3 -->
        <script src="../bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="../plugins/iCheck/icheck.min.js"></script>
        <script>
        $(function() {
          $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
          });
        });
        </script>
</body>

</html>