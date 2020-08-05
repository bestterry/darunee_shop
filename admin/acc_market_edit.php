<?php
    require "../config_database/config.php";
    require "../session.php";
    $id_acc_market = $_GET['id_acc_market'];
    $sql_acc = "SELECT * FROM acc_market 
                INNER JOIN tbl_districts ON acc_market.district_id = tbl_districts.district_code
                INNER JOIN tbl_amphures ON acc_market.amphur_id = tbl_amphures.amphur_id
                INNER JOIN tbl_provinces ON acc_market.province_id = tbl_provinces.province_id
                WHERE id_acc_market = $id_acc_market";
    $objq_acc = mysqli_query($conn,$sql_acc);
    $objr_acc = mysqli_fetch_array($objq_acc);
?>
<!DOCTYPE html>
<html>

<head>
  <?php require('../font/font_style.php'); ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>เพิ่ม ORDER ใหม่</title>
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
  
</head>

<body class=" hold-transition skin-blue layout-top-nav">
  <div class="wrapper">
    <header class="main-header">
    <?php require('menu/header_logout.php');?>
    </header>
    
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header text-center with-border">
              <font size="4">
                <B align="center">เเก้ไข ORDER สกต.<font color="red"> </font></B>
              </font>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                <form action="algorithm/edit_acc_market.php" class="form-horizontal" method="post" autocomplete="off" name="form1" onSubmit="JavaScript:return fncSubmit();">
                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-group">
                        <label class="col-sm-4 control-label">ลูกค้า :</label>
                        <div class="col-sm-8">
                          <input type="text" name="name_customer" class="form-control" value="<?php echo $objr_acc['name_customer'];?>">
                          <input type="hidden" name="id_acc_market" value="<?php echo $id_acc_market; ?>">
                        </div>
                      </div>
                      <!-- /.form-group -->
                      <div class="form-group">
                        <label class="col-sm-4 control-label">บ้าน :</label>

                        <div class="col-sm-8">
                          <input type="text" name="village" class="form-control" value="<?php echo $objr_acc['village'];?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-4 control-label">ตำบล :</label>
                        <div class="col-sm-8">
                          <input class="form-control" value="<?php echo $objr_acc['district_name'];?>" disabled>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-4 control-label">อำเภอ :</label>
                        <div class="col-sm-8">
                          <input class="form-control" value="<?php echo $objr_acc['amphur_name'];?>" disabled/>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-4 control-label">จังหวัด :</label>
                        <div class="col-sm-8">
                          <input class="form-control" value="<?php echo $objr_acc['province_name'];?>" disabled/>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-4 control-label">เบอร์โทร :</label>

                        <div class="col-sm-8">
                          <input type="text" name="tel" class="form-control"  value="<?php echo $objr_acc['tel'];?>">
                         </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-4 control-label">หมายเหตุ :</label>

                        <div class="col-sm-8">
                          <input type="text" name="note" class="form-control" value="<?php echo $objr_acc['note'];?>">
                         </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-4 control-label">วันที่ขาย :</label>

                        <div class="col-sm-8">
                          <input type="date" name="date_acc" class="form-control" value="<?php echo $objr_acc['date_acc'];?>">
                         </div>
                      </div>


                    </div>
                    <div class="col-md-7">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="dynamic_field">
                          <tr>
                            <th bgcolor="#66b3ff" class="text-center" width="40%">สินค้า_หน่วย</th>
                            <th bgcolor="#66b3ff" class="text-center" width="15%">จำนวน</th>
                            <th bgcolor="#66b3ff" class="text-center" width="15%">บ/น.</th>
                            <th bgcolor="#66b3ff" class="text-center" width="15%">#</th>
                          </tr>
                          <tr>
                            <?php 
                              $sql_num = "SELECT * FROM acc_market_list INNER JOIN product ON acc_market_list.id_product = product.id_product
                              WHERE acc_market_list.id_acc_market = $id_acc_market GROUP BY acc_market_list.id_acc_market_list ASC";
                              $objq_num = mysqli_query($conn,$sql_num);
                              while ($value = $objq_num->fetch_assoc()) {
                            ?>
                            <td class="text-center">
                              <input type="text" class="form-control text-center" value="<?php echo $value['name_product'].'_'.$value['unit']; ?>" disabled/>
                              <input type="hidden" name="id_acc_market_list[]" value="<?php echo $value['id_acc_market_list']; ?>">
                            </td>
                            <td><input type="text" name="num_product[]" class="form-control text-center" value="<?php echo $value['num_product']; ?>"></td>
                            <td><input type="text" name="price[]" class="form-control text-center" value="<?php echo $value['price']; ?>"></td>
                            <td class="text-center"><a href="algorithm/delete_acc_market.php?id_acc_market_list=<?php echo $value['id_acc_market_list']; ?>&&id_acc_market=<?php echo $id_acc_market;?>" type="button" class="btn btn-danger"><i class="fa fa-minus"></i></a></td>
                          </tr>
                            <?php
                            }
                            ?>
                          <tr>
                            <td class="text-center">
                              <select name="id_product2[]" class="form-control text-center select2" style="width: 100%;">
                                <option value="list">-- เลือกสินค้า --</option>
                              <?php 
                                  $product = "SELECT * FROM product";
                                  $objq_product = mysqli_query($conn,$product);
                                  while($value = $objq_product->fetch_array()){
                                ?>
                                  <option value="<?php echo $value['id_product'];?>"><?php echo $value['name_product'].'_'.$value['unit'];?></option>
                                <?php 
                                  }
                                ?>
                              </select>
                            </td>
                            <td><input type="text" name="num_product2[]" placeholder="จำนวน" class="form-control text-center" /></td>
                            <td><input type="text" name="price2[]" placeholder="ราคา/น." class="form-control text-center" /></td>
                            <td class="text-center"><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <!-- /.row -->
                  </div>
              </div>
              <div align="center" class="box-footer">
                <a type="button" href="acc_market_sale.php" class="btn btn-danger pull-left"> << กลับ</a>
                <button type="submit" class="btn btn-success" onClick="return confirm('คุณต้องการที่จะบันทึกข้อมูลนี้หรือไม่ ?')";>  บันทึก ORDER </button>
              </div>
            </div>
            </form>
          </div>
        </div>
      </section>

      <!-- jQuery 3 -->
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
        $(document).ready(function(){
          var i=1;
          $('#add').click(function(){
            i++;
            $('#dynamic_field').append('<tr id="row'+i+'"><td><select name="id_product2[]" class="form-control select2" style="width: 100%;"> <option value="">-- เลือกสินค้า --</option><?php $product = "SELECT * FROM product";$objq_product = mysqli_query($conn,$product);while($value = $objq_product->fetch_array()){?><option value="<?php echo $value['id_product'];?>"><?php echo $value['name_product'].'_'.$value['unit'];?></option> <?php }?></select></td><td class="text-center"><input type="text" name="num_product2[]" placeholder="จำนวน" class="form-control text-center" /></td><td class="text-center"><input type="text" name="price2[]" placeholder="ราคา/น." class="form-control text-center" /></td><td class="text-center"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-minus"></i></button></td></tr>');
          });
          
          $(document).on('click', '.btn_remove', function(){
            var button_id = $(this).attr("id"); 
            $('#row'+button_id+'').remove();
          });
          
          $('#submit').click(function(){		
            $.ajax({
              success:function(data)
              {
                alert(data);
                $('#add_name')[0].reset();
              }
            });
          });
          
        });
      </script>
  </body>
</html>