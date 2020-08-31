<?php
  require "../config_database/config.php";
  require "../session.php";
  require "menu/date.php";

  $strDate = date('d-m-Y'); 
  $list_product = "SELECT * FROM product WHERE status_stock = 1";
  $objq_product = mysqli_query($conn,$list_product);
  $objq_product2 = mysqli_query($conn,$list_product);
  $objq_product3 = mysqli_query($conn,$list_product);

  $member = "SELECT * FROM member 
             WHERE status = 'employee' AND NOT id_member = 28 AND NOT id_member = 32";
  $objq_member = mysqli_query($conn,$member);
?>

<!DOCTYPE html>
<html>

<head>
  <?php require('../font/font_style.php'); ?>
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

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
      .button2 {
        background-color: #b35900;
        color : white;
        } /* Back & continue */
  </style>
</head>

<body class=" hold-transition skin-blue layout-top-nav ">
  <div class="wrapper">
    <header class="main-header">
      <?php require('menu/header_logout.php'); ?>
    </header>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <!-- form start -->
          <div class="col-md-12">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
              <li class="active"><a href="#today" data-toggle="tab">วันนี้</a></li>
                <li><a href="#checkday" data-toggle="tab">รายวัน</a></li>
                <!-- <li><a href="#bytime" data-toggle="tab">ช่วงเวลา</a></li> -->
                <li><a href="#change" data-toggle="tab">ระหว่างรถ</a></li>
                
                <div align="right">
                  <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-success"> เบิกสินค้า </a>
                  <a href="admin.php" class="btn button2"><< เมนูหลัก</a>
                </div>
              </ul>
              <div class="tab-content">

                <!-- tab-pane -->
                <div class="active tab-pane" id="today">
                  <div class="box box-default">
                   
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="box-body">
                              <div class="text-center">
                                <font size="5"><B>ประวัติ (เบิกสินค้า)
                                <font color="red">
                                  <?php 
                                    echo DateThai($strDate);
                                  ?>
                                    </font> 
                                  </B>
                                </font>
                              </div>
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th class="text-center" width="30%"> <font color="red">สินค้า_หน่วย</font> </th>
                                    <th class="text-center" width="8%"> <font color="red">จำนวน</font> </th>
                                    <th class="text-center" width="10%"> <font color="red">ผู้เบิก</font> </th>
                                    <th class="text-center" width="10%"> <font color="red">เบิกจาก</font></th>
                                    <th class="text-center" width="30%"> <font color="red">หมายเหตุ</font> </th>
                                    <th class="text-center" width="6%"> <font color="red">เวลา</font> </th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                  $date = "SELECT * FROM draw_history 
                                            INNER JOIN product ON draw_history.id_product = product.id_product 
                                            INNER JOIN member ON draw_history.id_member = member.id_member
                                            INNER JOIN zone ON draw_history.id_zone = zone.id_zone
                                            WHERE DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate'";
                                  $objq = mysqli_query($conn, $date);
                                  while ($value = $objq->fetch_assoc()) {
                                    ?>
                                    <tr>
                                      <td class="text-center">
                                        <?php echo $value['name_product'] . '_' . $value['unit']; ?>
                                      </td>
                                      <td class="text-center">
                                        <?php echo $value['num_draw']; ?>
                                      </td>
                                      <td class="text-center">
                                        <?php echo $value['name']; ?>
                                      </td>
                                      <td class="text-center">
                                        <?php echo $value['name_zone']; ?>
                                      </td>
                                      <td class="text-center">
                                        <?php echo $value['note']; ?>
                                      </td>
                                      <td class="text-center">
                                        <?php echo DateThai2($value['datetime']); ?>
                                      </td>
                                    </tr>
                                  <?php
                                    }
                                  ?>
                                </tbody>
                              </table>
                            <!-- ------------------------------//ยอดขายรวม---------------------------- -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.tab-pane -->

                <!-- tab-pane -->
                <div class="tab-pane" id="checkday">
                  <div class="box box-default">
                    <div class="text-center box-header with-border">
                      <B><font size="5">  ยอดเบิกสินค้า(รายวัน) </font></B> 
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="row">
                        
                          <form action="checkday_withdraw_history.php" method="post">
                            <div class="row">
                              <div class="container">
                                <div class="col-md-12">
                                  <div class="box-body">
                                    <div class="form-group">
                                      <label class="col-sm-4 control-label text-right"></label>
                                      <div class="col-sm-4">
                                        <input class="form-control" type="date" name="day" id="datePicker">
                                      </div>
                                      <div class="col-sm-4"></div>
                                    </div>
                                  </div>

                                  <div class="box-footer text-center">
                                    <div align="center" >
                                      <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> ตกลง </button>
                                    </div>
                                  </div>

                                </div>
                              </div>
                            </div>
                          </form>
                        
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane" id="bytime">
                  <div class="box box-default">
                    <div class="text-center box-header with-border">
                      <B><font size="5"> ยอดเบิกสินค้า (ตามช่วงเวลา) </font></B> 
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="row">
                        <form action="withdraw_history_bytime.php" method="post">
                          <div class="box-body">
                            <div class="row">
                              <div class="container">
                                <div class="col-md-6">
                                  <div class="form-group text-center">
                                    <label> <font size="5">ตั้งเเต่</font></label>
                                    <input type="date"  class="form-control"  name="aday">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group text-center">
                                    <label><font size="5">ถึง</font></label></label>
                                    <input type="date" class="form-control" name="bday">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="box-footer text-center">
                            <button type="submit" class="btn btn-success "><i class="fa fa-check-square-o"></i> ตกลง </button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- tab-pane -->
                <div class="tab-pane" id="change">
                  <div class="box box-default">
                    <div class="box-header with-border">
                    <div class="box-header with-border">
                      <p align="center">
                        <font size="5"><B>โอนสินค้า (ระหว่างรถ) <font color="red"> <?php echo DateThai($strDate); ?></font></B> </font>
                      </p>
                    </div>
                    <table class="table ">
                      <thead>
                        <tr>
                          <th class="text-center" width="35%"><font color="red">สินค้า_หน่วย</font></th>
                          <th class="text-center" width="12%"><font color="red">จำนวน</font></th>
                          <th class="text-center" width="12%"><font color="red">ผู้ส่ง</font></th>
                          <th class="text-center" width="12%"><font color="red">ผู้รับ</font></th>
                          <th class="text-center" width="25%"><font color="red">หมายเหตุ</font></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $date = "SELECT * FROM change_bwt_car
                            INNER JOIN product ON change_bwt_car.id_product = product.id_product 
                            WHERE DATE_FORMAT(datetime,'%d-%m-%Y')='$strDate'";
                        $objq = mysqli_query($conn, $date);
                        while ($value = $objq->fetch_assoc()) {
                          $name1 = "SELECT name FROM member WHERE id_member = $value[id_member_send]";
                          $objq_name1 = mysqli_query($conn,$name1);
                          $objr_name1 = mysqli_fetch_array($objq_name1);
                          $name2 = "SELECT name FROM member WHERE id_member = $value[id_member_receive]";
                          $objq_name2 = mysqli_query($conn,$name2);
                          $objr_name2 = mysqli_fetch_array($objq_name2);
                          ?>
                          <tr>
                            <td class="text-center">
                              <?php echo $value['name_product'] . '_' . $value['unit']; ?>
                            </td>
                            <td class="text-center">
                              <?php echo $value['num']; ?>
                            </td>
                            <td class="text-center">
                              <?php echo $objr_name1['name']; ?>
                            </td>
                            <td class="text-center">
                              <?php echo $objr_name2['name']; ?>
                            </td>
                            <td class="text-center">
                              <?php echo $value['note']; ?>
                            </td>
                          </tr>
                          <?php
                        }
                        ?>
                      </tbody>
                    </table>
                    </div>
                  </div>
                </div>
                <!-- /.tab-pane -->
                
              </div>
              <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php require("../menu/footer.html"); ?>

    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog modal-lg">
        <form action="withdraw_product.php" method="post">
          <div class="modal-content">
            <div class="modal-header text-center">
                <font size="5"><B align = "center"> เบิกสินค้า </B></font>
            </div>
            <div class="modal-body col-md-12 table-responsive mailbox-messages">
              <div class="col-12">
                <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
                <div class="col-8 col-sm-8 col-xl-8 col-md-8">
                  <div class="table-responsive mailbox-messages">
                    <table class="table table-bordered">
                      <tbody>
                        <tr>
                          <th class="text-center" width="30%"><font size="3">เบิกจาก STOCK</font></th>
                          <th class="text-center" width="70%"> 
                            <select name ="id_zone" class="form-control text-center select2" style="width: 100%;">
                                <?php #endregion
                                $sql_member = "SELECT * FROM zone ";
                                $objq_member = mysqli_query($conn,$sql_member);
                                while($member = $objq_member -> fetch_assoc()){
                                    if ($member['id_zone']==8) {
                                        
                                    }else{
                                ?>
                                    <option value="<?php echo $member['id_zone']; ?>"><?php echo $member['name_zone']; ?></option>
                                <?php
                                    }   
                                } 
                                ?>
                            </select>
                          </th>
                        </tr>
                      </tbody>
                    </table> 
                    <br> 

                    <table class="table table-bordered">
                      <tbody>
                        <tr>
                          <th class="text-center" width="30%"><font size="3">ผู้ขอเบิก</font></th>
                          <th class="text-center" width="70%"> 
                            <select name ="id_member" class="form-control text-center select2" style="width: 100%;">
                                <?php #endregion
                                $sql_member = "SELECT * FROM member WHERE status = 'employee' AND NOT id_member = 3";
                                $objq_member = mysqli_query($conn,$sql_member);
                                while($member = $objq_member -> fetch_assoc()){
                                    
                                ?>
                                    <option value="<?php echo $member['id_member']; ?>"><?php echo $member['name']; ?></option>
                                <?php
                                  } 
                                ?>
                            </select>
                          </th>
                        </tr>
                      </tbody>
                    </table>
                    
                  </div>                
                </div>
                <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit"  class="btn button2 pull-right">ถัดไป >></button>
              <button type="button" class="btn button2 pull-left" data-dismiss="modal"><< ย้อนกลับ</button>
            </div>
          </div>
        </form>
      </div>
    </div>

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
      $(document).ready( function() {
          var now = new Date();
      
          var day = ("0" + now.getDate()).slice(-2);
          var month = ("0" + (now.getMonth() + 1)).slice(-2);

          var today = now.getFullYear()+"-"+(month)+"-"+(day) ;


        $('#datePicker').val(today);
      });
  </script>
</body>

</html>