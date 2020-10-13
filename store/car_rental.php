<?php 
  require "../config_database/config.php";
  require "../session.php";
  require "menu/date.php";
  $strDate = date('d-m-Y');
  $strDate2 = date('Y-m-d');

?>

<!DOCTYPE html>
<html>
  <head>
    <?php require('../font/font_style.php');?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ทีมงานคุณดารุณี</title>
    <link rel="icon" type="image/png" href="../images/favicon.ico"/>
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
    <script language="javascript">
      function fncSubmit()
      {
        if(document.form1.date.value == "")
        {
          alert('กรุณาเลือกวันที่');
          document.form1.date.focus();
          return false;
        }	
        if(document.form1.id_practice.value == "")
        {
          alert('กรุณาเลือกรายการ')
          document.form1.id_practice.focus();
          return false;
        }	
        if(document.form1.money.value == "")
        {
          alert('กรุณาระบุจำนวนเงิน');
          document.form1.money.focus();		
          return false;
        }	
        if(document.form1.note.value == "")
        {
          alert('กรุณาระบุหมายเหตุ');
          document.form1.note.focus();		
          return false;
        }	
        document.form1.submit();
      }
    </script>
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
    </style>
  </head>
  <body class=" hold-transition skin-blue layout-top-nav ">

    <div class="wrapper">
      <header class="main-header">
      <?php require('menu/header_logout.php');?>
      </header>

      <div class="content-wrapper">
        <section class="content">
          <div class="box box-primary">
            <form action="algorithm/add_car_rental.php" class="form-horizontal" method="post" autocomplete="off" name="form1" onSubmit="JavaScript:return fncSubmit();">
              <div class="box-header with-border">
                <div class="col-12">
                  <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                    <a type="block" href="store.php" class="btn btn-danger pull-left"><< เมนูหลัก</a> 
                  </div>
                  <div class="col-4 col-sm-4 col-md-4 col-xl-4 text-center">
                    <font size="5">
                      <B> ค่าเช่ารถ </B>
                    </font>
                  </div>
                  <div class="col-4 col-sm-4 col-md-4 col-xl-4 text-right">
                  <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-success"> ข้อมูลค่าเช่ารถ </a>
                  </div>
                </div>
              </div>
              <br>
              <div class="box-body no-padding">
                <div class="mailbox-read-message">
                  <table class="table">
                    <tr>
                      <th width="20%" class="text-right"><font size="4">ชื่อ &nbsp;&nbsp;:</font></th>
                      <td width="30%">
                        <input type="text" class="form-control" value="<?php echo $username; ?>"  style="background-color: #e6f7ff;" readonly/>
                        <input type="hidden" class="form-control" value="<?php echo $id_member; ?>" id="id_member1" name="id_member1">
                      </td>
                      <th width="20%" class="text-right" ><font size="4">วันที่ &nbsp;&nbsp;:</font></th>
                      <td width="30%"><input type="date" id="datePicker" name="date" class="form-control text-center"></td>
                    </tr>
                    <tr>
                      <th width="20%" class="text-right"><font size="4" valign="middle">ปฏิบัติงาน &nbsp;&nbsp;:</font></th>
                      <td width="30%" >
                        <select name="id_practice" id="id_practice" onchange="sSelect(this.value)" class="form-control" style="width: 100%;">
                            <option value="">-- รายการ --</option>
                            <?php 
                              $rc_practice = "SELECT * FROM rc_practice";
                              $objq_practice = mysqli_query($conn,$rc_practice);
                                while ($value = $objq_practice -> fetch_assoc() ) {
                            ?>
                            <option value="<?php echo $value['id_practice']; ?>"><?php echo $value['name_practice']; ?></option>
                            <?php
                              }
                            ?>
                        </select>
                      </td>
                      <th width="20%" class="text-right"><font size="4">รถ &nbsp;&nbsp;:</font></th>
                      <td width="30%">
                        <select name="member_car" class="form-control" style="width: 100%;">
                          <option value="54">-- กรุณาเลือกหน่วยรถ --</option>
                          <?php 
                           $sql_car = "SELECT id_member,name FROM member WHERE status_reserve = 1";
                           $objq_car = mysqli_query($conn,$sql_car);
                              while ($value = $objq_car -> fetch_assoc() ) {
                          ?>
                          <option value="<?php echo $value['id_member']; ?>"><?php echo $value['name']; ?></option>
                          <?php
                            }
                          ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <th width="20%" class="text-right"><font size="4">ค่าเช่ารถ &nbsp;&nbsp;:</font></th>
                      <td width="30%">
                        <input type="number" name="money" id="car_rental" value="0" class="form-control text-center">
                      </td>
                      <th width="20%" class="text-right" ><font size="4">หมายเหตุ &nbsp;&nbsp;:</font></th>
                      <td colspan="30%" ><input type="text" name="note" value="-" class="form-control"></td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="box-footer text-center">
                <?php 
                  $sql_checkday = "SELECT id_carrental FROM car_rental WHERE id_member = $id_member AND date = '$strDate2'";
                  $objq_checkday = mysqli_query($conn,$sql_checkday);
                  if ($objq_checkday->num_rows > 0) {
                ?>

                <?php
                  }else{
                ?>
                <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> บันทึก </button>
                <?php
                  }
                ?>
              </div>
            </form>
          </div>

          <div class="box box-primary">
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                <div class="col-sm-12 text-center">
                  <font size="5" color="red">
                    <B> ประวัติใช้รถ : <?php echo $username; ?></B>
                  </font>
                </div>
                <table class="table" id="example2">
                  <thead>
                    <tr>
                      <th class="text-center" width="20%">วันที่</th>
                      <th class="text-center" width="15%">ปฏิบัติงาน</th>
                      <th class="text-center" width="15%">ใช้รถ</th>
                      <th class="text-center" width="15%">ค่าเช่ารถ</th>
                      <th class="text-center" width="35%">หมายเหตุ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $sql_rs_history = "SELECT * FROM car_rental 
                                         INNER JOIN rc_practice ON car_rental.id_practice = rc_practice.id_practice
                                         WHERE car_rental.id_member = $id_member
                                         GROUP BY car_rental.id_carrental DESC
                                         LIMIT 1000";
                      $objq_rs_history = mysqli_query($conn,$sql_rs_history);
                      while($value = $objq_rs_history->fetch_assoc()){ 
                        $member_car = $value['member_car'];
                        $sql_member = "SELECT name FROM member WHERE id_member = $member_car";
                        $objq_member = mysqli_query($conn,$sql_member);
                        $objr_member = mysqli_fetch_array($objq_member);
                    ?>
                      <tr>
                        <td class="text-center"><?php echo Datethai($value['date']); ?></td>
                        <td class="text-center"><?php echo $value['name_practice']; ?></td>
                        <td class="text-center"><?php echo $objr_member['name']; ?></td>
                        <td class="text-center"><?php echo $value['money']; ?></td>
                        <td class="text-center"><?php echo $value['note']; ?></td>
                      </tr>
                      <?php
                      ?>
                    <?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </section>
      </div>

      <?php require("../menu/footer.html"); ?>
    </div>
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog modal-lg">
        <form action="data_carrental.php" method="post">
          <div class="modal-content">
            <div class="modal-header text-center">
                <font size="5"><B> ข้อมูลค่าเช่ารถ </B></font>
            </div>
            <div class="modal-body table-responsive mailbox-messages">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="table-responsive mailbox-messages">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-center"> 
                      <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
                      <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <B><font size="5">ตั้งแต่</font></B>
                      </div>
                      <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-center"> 
                      <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
                      <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <B><font size="5">ถึง</font></B>
                      </div>
                      <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-center">
                      <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
                      <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input class="form-control text-center" type="date" name="aday">
                      </div>
                      <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
                    </div>
                    <div class="ol-xs-6 col-sm-6 col-md-6 col-lg-6 text-center"> 
                      <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
                      <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input class="form-control text-center" type="date" name="bday">
                      </div>
                      <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success pull-right">ต่อไป</button>
              <button type="button" class="btn button2 pull-left" data-dismiss="modal"><< ย้อนกลับ </button>
            </div>
          </div>
        </form>
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
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : false,
            'info'        : true,
            'autoWidth'   : false
            });
            $('#example2').DataTable({
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

      function sSelect(value){  
        $.ajax({
          type:"POST",
          url:"algorithm/select_carrental.php",
          data:{value:value},
          success:function(data){
            $("#car_rental").val(data);
            console.log(data);
          }
        });
        return false;
      };

    </script>
  </body>
</html>
