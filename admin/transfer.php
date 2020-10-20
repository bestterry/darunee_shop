<?php
  require "../config_database/config.php";
  require "../session.php";
  require "menu/date.php";

  $sql_transfer = "SELECT * FROM transfer_list INNER JOIN transfer_product ON transfer_list.id_transfer_pd = transfer_product.id_transfer_pd
                  ORDER BY transfer_list.id_transfer_list DESC 
                  LIMIT 300";
  $objq_transfer = mysqli_query($conn,$sql_transfer);
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
        .topnav {
          background-color: while;
          overflow: hidden;
        }

        /* Style the links inside the navigation bar */
        .topnav a {
          float: left;
          color: black;
          text-align: center;
          padding: 14px 16px;
          text-decoration: none;
          font-size: 15px;
        }

        /* Change the color of links on hover */
        .topnav a:hover {
          background-color: #ddd;
          color: black;
        }

        /* Add a color to the active/current link */
        .topnav a.active {
          background-color: #3c8dbc;
          color: white;
        }
    </style>
  </head>

  <body class=" hold-transition skin-blue layout-top-nav ">

    <div class="wrapper">
      <header class="main-header">
        <?php require('menu/header_logout.php'); ?>
      </header>

      <div class="content-wrapper">

        <section class="content">
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-xl-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <div class="col-12">
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                      <a href="admin.php" class="btn button2"><< กลับ</a>
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                      <div class="text-center">
                        <font size="5">
                          <B align="center">โอนจ่าย<font color="red"> </font></B>
                        </font>
                      </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4 text-right">
                      <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-success"> ทำรายการ </a>
                    </div>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <div class="mailbox-read-message">
                    <div class="col-12">

                      <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                        <table id="example1" class="table">
                          <thead>
                            <tr>
                              <th class="text-center" width="10%">วันที่โอน</th>
                              <th class="text-center" width="10%">รับโอน</th>
                              <th class="text-center" width="10%">ชื่อบัญชี</th>
                              <th class="text-center" width="10%">สินค้า</th>
                              <th class="text-center" width="10%">จำนวนเงิน</th>
                              <th class="text-center" width="10%">ผู้โอน</th>
                              <th class="text-center" width="10%">ใบจ่าย</th>
                              <th class="text-center" width="20%">หมายเหตุ</th>
                              <th class="text-center" width="5%">#</th>
                              <th class="text-center" width="5%">แก้</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php 
                            while($value = $objq_transfer -> fetch_assoc()){
                          ?>
                            <tr>
                              <td class="text-center"><?php echo DateThai($value['date']);?></td>
                              <td class="text-center"><?php echo $value['name_transfer'];?></td>
                              <td class="text-center"><?php echo $value['account_name'];?></td>
                              <td class="text-center"><?php echo $value['name_transfer_pd'];?></td>
                              <td class="text-center"><?php echo $value['money'];?></td>
                              <td class="text-center"><?php echo $value['transferor'];?></td>
                              <td class="text-center"><?php echo $value['payment_slip'];?></td>
                              <td class="text-center"><?php echo $value['note'];?></td>
                              <td class="text-center" >
                                <?php 
                                  $status = $value['status_pay'];
                                    if( $status == 'Y'){
                                ?>
                                <a href="algorithm/edit_statustransfer.php?id_transfer_list=<?php echo $value['id_transfer_list']; ?>&&status_pay=N" 
                                   class="btn btn-success btn-xs" onClick="return confirm('คุณต้องการที่จะเปลี่ยนสถานะเป็นไม่ได้โอนหรือไม่ ?')";>Y</a>
                                <?php
                                    }else{
                                ?>
                                <a href="algorithm/edit_statustransfer.php?id_transfer_list=<?php echo $value['id_transfer_list']; ?>&&status_pay=Y" 
                                   class="btn btn-danger btn-xs" onClick="return confirm('คุณต้องการที่จะเปลี่ยนสถานะเป็นโอนแล้วหรือไม่ ?')";>N</a>
                                <?php
                                      echo "";
                                    } 
                                ?>
                              </td>
                              <td class="text-center">
                                <a href="transfer_edit.php?id_transfer_list=<?php echo $value['id_transfer_list']; ?>" class="btn btn-success btn-xs" >>></a>
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
                </div>
                <div class="box-footer text-right">
                  <!-- <a href="#" data-toggle="modal" data-target="#check_list" class="btn btn-success">PDF</a> -->
                </div>
              </div>
            </div>
          </div>
        </section>

        <section class="content">
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-xl-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <div class="col-12">
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4"></div>
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                      <div class="text-center">
                        <font size="5">
                          <B align="center">ยอดรวมโอนจ่าย<font color="red"> </font></B>
                        </font>
                      </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4 text-right"> </div>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <div class="mailbox-read-message">
                    <div class="col-12">

                      <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-xl-12">
                        <div class="col-3 col-xs-3 col-sm-3 col-md-3 col-xl-3"></div>
                        <div class="col-6 col-xs-6 col-sm-6 col-md-6 col-xl-6">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th class="text-center" width="50%">สินค้า</th>
                                <th class="text-center" width="50%">เงินโอน</th>
                                
                              </tr>
                            </thead>
                            <tbody>
                            <?php 
                              $sql_transferPD = "SELECT * FROM transfer_product";
                              $objq_transferPD = mysqli_query($conn,$sql_transferPD);
                              while($value = $objq_transferPD -> fetch_assoc()){
                                $id_transfer_pd = $value['id_transfer_pd'];
                                $sql_sumtransfer = "SELECT SUM(money) FROM transfer_list WHERE id_transfer_pd = $id_transfer_pd AND status_pay = 'N'";
                                $objq_sumtransfer = mysqli_query($conn,$sql_sumtransfer);
                                $objr_sumtransfer = mysqli_fetch_array($objq_sumtransfer);
                            ?>
                              <tr>
                                <td class="text-center"><?php echo $value['name_transfer_pd']; ?></td>
                                <td class="text-center"><?php echo $objr_sumtransfer['SUM(money)']; ?></td>
                              </tr>
                            <?php 
                              }
                            ?>
                            </tbody>
                          </table>
                        </div>
                        <div class="col-3 col-xs-3 col-sm-3 col-md-3 col-xl-3"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="box-footer text-right"></div>
              </div>
            </div>
          </div>
        </section>

      </div>
      <?php require("../menu/footer.html"); ?>
      
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
          <form action="algorithm/add_transfer.php" method="post" class="form-horizontal">
            <div class="modal-content">
              <div class="modal-header text-center">
                  <font size="5"><B> โอนจ่าย </B></font>
              </div>
              <div class="modal-body col-md-12 table-responsive mailbox-messages">
                <div class="col-12">
                  <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
                  <div class="col-8 col-sm-8 col-xl-8 col-md-8">

                    <div class="form-group">
                      <label class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label">วันที่ </label>
                      <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input type="date" class="form-control text-center" id="datePicker" name="date">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label">รับโอน</label>
                      <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input type="text" class="form-control text-center" name="name_transfer">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label">ชื่อบัญชี</label>
                      <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input type="text" class="form-control text-center" name="account_name">
                      </div>
                    </div>
                              
                    <div class="form-group">
                      <label class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label"> สินค้า </label>
                      <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <select name="id_transfer_pd"  class="form-control" >
                          <option value="">-- เลือกรายการ --</option>
                          <?php 
                            $sql_list = "SELECT * FROM transfer_product";
                            $objq_list = mysqli_query($conn,$sql_list);
                              while($value = $objq_list->fetch_assoc()){ ?>
                              <option value="<?php echo $value['id_transfer_pd'];?>"><?php echo $value['name_transfer_pd'];?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label">จำนวนเงิน</label>
                      <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input type="text" class="form-control text-center" name="money">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label">ผู้โอน</label>
                      <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input type="text" class="form-control text-center" name="transferor">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label">ใบจ่าย</label>
                      <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input type="text" class="form-control text-center" name="payment_slip">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label">หมายเหตุ</label>
                      <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input type="text" class="form-control text-center" name="note">
                      </div>
                    </div>

                  </div>
                  <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
                </div>
              </div>
              <div class="modal-footer text-center">
                <button type="button" class="btn pull-left button2" data-dismiss="modal"><< ย้อนกลับ </button>
                <button type="submit" class="btn btn-success">บันทึก</button>
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
       $(function () {
          $('#example1').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : false,
            'info'        : true,
            'autoWidth'   : false
          });
       });
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