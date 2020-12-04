<?php 
  date_default_timezone_set('Asia/Bangkok');
  require "../config_database/config.php";
  require "../session.php";
  require "menu/date.php";
  $strDate = date('d-m-Y');
  $strDate2 = date('Y-m-d');
  $datetime = date('Y-m-d H:i:s');

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
            <form action="algorithm/add_report_work.php" class="form-horizontal" method="post" autocomplete="off" name="form1" onSubmit="JavaScript:return fncSubmit();">
              <div class="box-header with-border">
                <div class="col-12">
                  <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                    <a type="block" href="admin.php" class="btn button2 pull-left"><< เมนูหลัก</a> 
                  </div>
                  <div class="col-4 col-sm-4 col-md-4 col-xl-4 text-center">
                    <font size="5">
                      <B> ปฏิบัติงาน สนง. </B>
                    </font>
                  </div>
                  <div class="col-4 col-sm-4 col-md-4 col-xl-4 text-right">
                  <!-- <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-success"> ปฏิบัติงาน สนง. </a> -->
                  </div>
                </div>
              </div>
              <br>
              <div class="box-body no-padding">
                <div class="mailbox-read-message">
                  <div class="col-2 col-xs-2 col-sm-2 col-md-2 col-xl-2"></div>

                  <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-xl-8">
                    <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-xl-4">
                      <table class="table table-bordered">
                        <thead>
                          <th class="text-center" width="50%">เลือก</th>
                          <th class="text-center" width="50%">ชื่อ</th>
                        </thead>
                        <tbody>
                          <?php 
                            $user_office = "SELECT id_member,name FROM member WHERE status = 'admin'";
                            $objq_office = mysqli_query($conn,$user_office);
                            while ($value = $objq_office -> fetch_assoc()) {
                          ?>
                          <tr>
                            <td class="text-center"><input type="checkbox" name="id_member[]" value="<?php echo $value['id_member']; ?>"></td>
                            <td class="text-center"><?php echo $value['name']; ?></td>
                          </tr>
                          <?php
                            }
                          ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-xl-8">

                      <div class="form-group">
                        <label class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label">เข้างาน </label>
                        <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8 ">
                          <input type="text"  name="check_in" class="form-control text-center" value="<?php echo Datethai4($datetime);?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label"> ปฏิบัติงาน </label>
                        <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8 ">
                          <select name="id_practice" class="form-control" style="width: 100%;">
                            <option value="">-- รายการ --</option>
                            <?php 
                            $sql_practice = "SELECT id_practice,name_practice FROM rc_practice";
                            $objq_practice = mysqli_query($conn,$sql_practice);
                                while ($value = $objq_practice -> fetch_assoc() ) {
                            ?>
                            <option value="<?php echo $value['id_practice']; ?>"><?php echo $value['name_practice']; ?></option>
                            <?php
                              }
                            ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label">หมายเหตุ </label>
                        <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8">
                          <input type="text" name="note" value="-" class="form-control text-center">
                        </div>
                      </div>

                    </div>
                  </div>

                  <div class="col-2 col-xs-2 col-sm-2 col-md-2 col-xl-2"></div>
                </div>
              </div>
              <div class="box-footer text-center">
                <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> บันทึก </button>
              </div>
            </form>
          </div>

          <div class="box box-primary">
            <div class="box-header with-border">
              <div class="col-12">
                <div class="col-3 col-xs-3 col-sm-3 col-md-3 col-xl-3 text-center"></div>
                <div class="col-6 col-xs-6 col-sm-6 col-md-6 col-xl-6 text-center">
                  <font size="5">
                    <B> ประวัติปฏิบัติงาน สนง.</B>
                  </font>
                </div>
                <div class="col-3 col-xs-3 col-sm-3 col-md-3 col-xl-3 text-right">
                  <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-success"> ผลรวม </a>
                </div>
              </div>
            </div>

            <div class="box-body no-padding">
              <div class="mailbox-read-message">
              <div class="col-12">
                <table class="table" id="example2">
                  <thead>
                    <tr>
                      <th class="text-center" width="15%">เข้างาน</th>
                      <th class="text-center" width="15%">ออกงาน</th>
                      <th class="text-center" width="15%">ปฏิบัติงาน</th>
                      <th class="text-center" width="15%">ชื่อ</th>
                      <th class="text-center" width="30%">หมายเหตุ</th>
                      <th class="text-center" width="5%">แก้</th>
                      <th class="text-center" width="5%">ลบ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $sql_report_office = "SELECT * FROM report_office 
                                         INNER JOIN rc_practice ON report_office.id_practice = rc_practice.id_practice
                                         INNER JOIN member ON report_office.id_member = member.id_member
                                         GROUP BY report_office.id DESC
                                         LIMIT 1000";
                      $objq_report_office = mysqli_query($conn,$sql_report_office);
                      while($value = $objq_report_office->fetch_assoc()){ 
                    ?>
                      <tr>
                        <td class="text-center"><?php echo $value['check_in']; ?></td>
                        <td class="text-center"><?php echo $value['check_out']; ?></td>
                        <td class="text-center"><?php echo $value['name_practice']; ?></td>
                        <td class="text-center"><?php echo $value['name']; ?></td>
                        <td class="text-center"><?php echo $value['note']; ?></td>
                        <td class="text-center">
                          <a href="report_form_edit.php?id=<?php echo $value['id']; ?>&&name=<?php echo $value['name'];?>" class="btn btn-xs btn-success"> แก้ </a>
                        </td>
                        <td class="text-center">
                          <a href="algorithm/delete_form_report.php?id=<?php echo $value['id']; ?>" class="btn btn-xs btn-danger"> ลบ </a>
                        </td>
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
          </div>

        </section>
      </div>

      <?php require("../menu/footer.html"); ?>
    </div>
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog modal-lg">
        <form action="report_work_form.php" method="post">
          <div class="modal-content">
            <div class="modal-header text-center">
                <font size="5"><B> ข้อมูลปฏิบัติงาน สนง</B></font>
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
            'lengthMenu'  : [ 20, 50, 75, 100 ],
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
