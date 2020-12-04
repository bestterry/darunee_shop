<?php
  require "../config_database/config.php";
  require "../session.php"; 
  $id_company = $_GET['id_company'];
  $sql_company = "SELECT name_company FROM bank_company WHERE id_company = $id_company";
  $objq_company = mysqli_query($conn,$sql_company);
  $objr_company = mysqli_fetch_array($objq_company);
?>
<!DOCTYPE html>
<html>

  <?php require 'menu/header.php'; ?>

  <body class=" hold-transition skin-blue layout-top-nav">
   
      <header class="main-header">
       <?php require('menu/header_logout.php'); ?>
      </header>
      <div class="content-wrapper">
        <section class="content">

          <div class="box box-primary">
            <div class="row">
              <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8">
                <div class="topnav">
                  <a class="active" href="list_bank.php"> บัญชีโอนจ่าย </a>
                  <a href="add_bank.php"> เพิ่มบัญชี </a>
                </div>
              </div>
              <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4">
                  <a class="btn button2 pull-right" href="../admin/admin.php"> << เมนูหลัก </a>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <div class="col-12">
                  <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4">
                  </div>
                  <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
                    <font size="5"><B>แก้ไขบัญชี</B></font>
                  </div>
                  <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 text-right"> </div>
                </div>
              </div>
              <br>
              <form action="algorithm/edit_bank.php?id_company=<?php echo $id_company; ?>" class="form-horizontal" method="post" autocomplete="off">
                <div class="box-body no-padding">
                  <div class="mailbox-read-message">

                    <div class="row">
                      <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4">
                          <div class="form-group">
                            <label class="col-sm-2 control-label">บริษัท </label>
                            <div class="col-sm-10">
                              <input type="text" name="name_company" value="<?php echo $objr_company['name_company']; ?>" class="form-control" placeholder="บริษัท">
                            </div>
                          </div>
                        </div>
                        <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8">  </div>
                      </div>
                    </div>
                    <br>

                    <div class="row">
                      <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="col-12">
                          <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <div class="form-group">
                              <label class="col-sm-2 control-label"> สินค้า </label>
                              <div class="col-sm-10">
                                <div class="table-responsive">
                                  <table class="table table-bordered" id="product">
                                    <tr>
                                      <th class="text-center" width="90%"><font color="red" > สินค้า </font></th>
                                      <th class="text-center" width="10%"><font color="red" >#</font></th>
                                    </tr>
                                    <?php 
                                      $sql_product = "SELECT * FROM bank_product WHERE id_company = $id_company";
                                      $objq_product = mysqli_query($conn,$sql_product);
                                      foreach($objq_product as $value_product):
                                    ?>
                                    <tr>
                                      <td class="text-center">
                                        <input type="text" class="form-control text-center" value="<?php echo $value_product['name_product']; ?>">
                                      </td>
                                      <td class="text-center"><a type="button" 
                                          href="algorithm/delete_product.php?id_product=<?php echo $value_product['id_product'];?>&id_company=<?php echo $id_company;?>" class="btn btn-danger">
                                        <i class="fa fa-minus"></i></a>
                                      </td>
                                    </tr>
                                    <?php
                                      endforeach;
                                    ?>
                                    <tr>
                                      <td class="text-center">
                                        <input type="text" name="name_product[]" class="form-control text-center" placeholder="สินค้า">
                                      </td>
                                      <td class="text-center"><button type="button" name="add_product" id="add_product" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                                    </tr>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <div class="form-group">
                              <label class="col-sm-2 control-label"> บัญชี </label>
                              <div class="col-sm-10">
                                <div class="table-responsive">
                                  <table class="table table-bordered" id="plance">
                                    <tr>
                                      <th class="text-center" width="30%"><font color="red" >ชื่อบัญชี </font></th>
                                      <th class="text-center" width="30%"><font color="red" >เลขบัญชี </font></th>
                                      <th class="text-center" width="30%"><font color="red" >ธนาคาร </font></th>
                                      <th class="text-center" width="10%"><font color="red" >#</font></th>
                                    </tr>
                                    <?php 
                                      $sql_bank_list = "SELECT * FROM bank_list WHERE id_company = $id_company";
                                      $objq_bank_list = mysqli_query($conn,$sql_bank_list);
                                      foreach ($objq_bank_list as $value) :
                                      
                                    ?>
                                    <tr>
                                      <td class="text-center">
                                        <input type="text" class="form-control text-center" value="<?php echo $value['name_bank_list']; ?>" disabled>
                                      </td>
                                      <td class="text-center">
                                        <input type="text" class="form-control text-center" value="<?php echo $value['number_bank_list']; ?>" disabled>
                                      </td>
                                      <td class="text-center">
                                        <input type="text" class="form-control text-center" value="<?php echo $value['name_bank']; ?>" disabled>
                                      </td>
                                      <td class="text-center"><a type="button" 
                                          href="algorithm/delete_bank_list.php?id_bank_list=<?php echo $value['id_bank_list'];?>&id_company=<?php echo $id_company;?>" class="btn btn-danger">
                                        <i class="fa fa-minus"></i></a>
                                      </td>
                                    </tr>
                                    <?php
                                      endforeach;
                                    ?>
                                    <tr>
                                      <td class="text-center">
                                        <input type="text" name="name_bank_list[]" class="form-control text-center" placeholder="ชื่อบัญชี">
                                      </td>
                                      <td class="text-center">
                                        <input type="text" name="number_bank_list[]" class="form-control text-center" placeholder="เลขบัญชี">
                                      </td>
                                      <td class="text-center">
                                        <select name="name_bank[]" class="form-control">
                                          <option value="-">-</option>
                                          <option value="กรุงไทย">กรุงไทย</option>
                                          <option value="กสิกรไทย">กสิกรไทย</option>
                                          <option value="ไทยพาณิชย์">ไทยพาณิชย์</option>
                                          <option value="กรุงศรี">กรุงศรี</option>
                                          <option value="ออมสิน">ออมสิน</option>
                                        </select>
                                      </td>
                                      <td class="text-center">
                                        <button type="button" name="add_plance" id="add_plance" class="btn btn-success"><i class="fa fa-plus"></i></button>
                                      </td>
                                    </tr>
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

                <div align="center" class="box-footer">
                  <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> บันทึก</button>
                </div>
              </form>
            </div>
          </div>
        </section>
      </div>

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
            $('#add_product').click(function(){
              i++;
              $('#product').append('<tr id="row'+i+'"><td><input type="text" name="name_product[]" class="form-control text-center" placeholder="สินค้า"></td><td class="text-center"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove_product"><i class="fa fa-minus"></i></button></td></tr>');
              console.log(i);
            });
            
            $(document).on('click', '.btn_remove_product', function(){
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

          $(document).ready(function(){
            var a=1; 
            $('#add_plance').click(function(){
              a++;
              $('#plance').append('<tr id="row'+a+'"><td class="text-center"><input type="text" name="name_bank_list[]" class="form-control text-center" placeholder="ชื่อบัญชี"></td><td class="text-center"> <input type="text" name="number_bank_list[]" class="form-control text-center" placeholder="เลขบัญชี"></td><td class="text-center"><select name="name_bank[]" class="form-control"><option value="-">-</option><option value="กรุงไทย">กรุงไทย</option><option value="กสิกรไทย">กสิกรไทย</option><option value="ไทยพาณิชย์">ไทยพาณิชย์</option><option value="กรุงศรี">กรุงศรี</option><option value="ออมสิน">ออมสิน</option></select></td><td class="text-center"><button type="button" name="remove" id="'+a+'" class="btn btn-danger btn_remove_plance"><i class="fa fa-minus"></i></button></td></tr>');
              console.log(a);
            });
            
            $(document).on('click', '.btn_remove_plance', function(){
              var button_id2 = $(this).attr("id"); 
              $('#row'+button_id2+'').remove();
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

