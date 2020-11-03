<?php 
  include("db_connect.php");

  function DateThai($strDate)
  {
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
  }

  function Datetime($strDate)
  {
  $strYear = (date("Y",strtotime($strDate))+543)-2500;
  $strMonth= date("n",strtotime($strDate));
  $strDay= date("j",strtotime($strDate));
  $strHour= date("H",strtotime($strDate));
  $strMinute= date("i",strtotime($strDate));
  $strSeconds= date("s",strtotime($strDate));
  $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
  $strMonthThai=$strMonthCut[$strMonth];
  return "$strHour:$strMinute น.";
  }

  $strDate = date('d-m-Y');

    $mysqli = connect();
    $id_addorder = $_GET['id_addorder'];
    $sql_addorder = "SELECT * FROM addorder 
                    INNER JOIN tbl_districts ON addorder.district_code = tbl_districts.district_code
                    INNER JOIN tbl_amphures ON addorder.amphur_id = tbl_amphures.amphur_id
                    INNER JOIN tbl_provinces ON addorder.province_id = tbl_provinces.province_id
                    WHERE addorder.id_addorder = $id_addorder";
    $objq_addorder = mysqli_query($mysqli,$sql_addorder);
    $objr_addorder = mysqli_fetch_array($objq_addorder);


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
  </head>

  <body class=" hold-transition skin-blue layout-top-nav">
      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
            </ul>
          </div>
        </nav>
      </header>
      <div class="content-wrapper">
        <section class="content">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <div class="col-12">
                  <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-xl-4">
                    <div class="text-left">
                      <a type="button" href="edit_list_order.php?id_addorder=<?php echo $_GET['id_addorder'];?>" class="btn btn-danger"><< กลับ</a> 
                    </div>
                  </div>
                  <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-xl-4">
                    <div class=" text-center">
                      <font size="5">
                        <B align="center"> ข้อมูลสั่งสินค้า <font color="red"> </font></B>
                      </font>
                    </div>
                  </div>
                  <div class="col-4 col-sm-4 col-md-4 col-xl-4"></div>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <div class="mailbox-read-message">
                  <form action="finish.php" method="post" autocomplete="off">
                    <div class="row">
                      <!-- ข้อมูลลูกค้า -->
                      <div class="col-5 col-xs-5 col-sm-5 col-md-5 col-xl-5">
                        <div class="table-responsive">
                          <table class="table table-bordered" id="dynamic_field">
                            <tr>
                              <th width="100%" class="text-right"><?php echo $id_addorder.'        '.$objr_addorder['name_customer']; ?></th>
                            </tr>
                            <tr>
                              <th width="100%"  class="text-right">
                                <?php 
                                  echo 'บ.'.$objr_addorder['village'];
                                ?>
                              </th>
                            </tr>
                            <tr>
                              <th width="100%" class="text-right">
                                <?php 
                                  echo 'ต.'.$objr_addorder['district_name'].' '.'อ.'.$objr_addorder['amphur_name'].' '.'จ.'.$objr_addorder['province_name'];
                                ?>
                              </th>
                            </tr>
                            <tr>
                              <th width="100%" class="text-right">
                                <?php 
                                  echo 'สั่ง  '.DateThai($objr_addorder['datetime']).' '. $objr_addorder['name_member'].'        '.Datetime($objr_addorder['datetime']).'        '.$objr_addorder['tel'];
                                ?>
                              </th>
                            </tr>
                            <tr>
                              <th width="100%" class="text-right">
                                <?php 
                                  echo $objr_addorder['note'];
                                ?>
                              </th>
                            </tr>
                            <tr>
                              <th width="100%" class="text-right">
                                <?php 
                                  $request = $objr_addorder['request'];
                                  if ($request == 'Y') {
                                    echo 'ทวง';
                                  }else{
                                    echo '';
                                  }
                                ?>
                              </th>
                            </tr>
                          </table>
                        </div>
                      </div>

                      <!-- ข้อมูลสินค้้า -->
                      <div class="col-7 col-xs-7 col-sm-7 col-md-7 col-xl-7">
                        <div class="table-responsive">
                          <table class="table table-bordered" id="dynamic_field">
                            <tr>
                              <th class="text-center" width="35%"> <font color="red">สินค้า_หน่วย</font> </th>
                              <th class="text-center" width="20%"> <font color="red">บ/น</font> </th>
                              <th class="text-center" width="20%"><font color="red">จำนวน</font></th>
                              <th class="text-center" width="25%"><font color="red">เงิน</font></th>
                            </tr>
                            <?php 
                                  $total_money = 0;
                                  $seach_listorder = "SELECT * FROM listorder 
                                                      INNER JOIN product ON listorder.id_product = product.id_product
                                                      WHERE listorder.id_addorder = $id_addorder";
                                  $objq_listorder = mysqli_query($mysqli,$seach_listorder);
                                  while($value = $objq_listorder->fetch_assoc()){
                                    $money = $value['money'];
                            ?>
                            <tr>
                              <td class="text-center"><?php echo $value['name_product'].'_'.$value['unit']; ?></td>
                              <td class="text-center"><?php echo $value['price']; ?></td>
                              <td class="text-center"><?php echo $value['num']; ?></td>
                              <td class="text-center"><?php echo $money; ?></td>
                            </tr>
                            <?php
                              $total_money = $total_money + $money;
                            }  
                            
                            ?>
                              <th colspan="3" class="text-center" width="55%"><font color="red">รวมเงิน</font></th>
                              <th  class="text-center" width="15%"><font color="red"><?php echo  $total_money; ?></font> </th>
                          </table>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="box-footer">
                
                </div> 
              </div> 
            </form> 
          </div> 
        </section>
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