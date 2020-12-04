<?php 
  require "../config_database/config.php";
  require "../session.php";
  require "menu/date.php";
  $strDate = date('d-m-Y');

  $reserve_money = "SELECT money FROM reserve_money WHERE id_member = $id_member";
  $objq_money = mysqli_query($conn,$reserve_money);
  $objr_money = mysqli_fetch_array($objq_money);
  $money = $objr_money['money'];

  $reserve_reserve = "SELECT * FROM reserve_list WHERE status = 4";
  $objq_reservelist = mysqli_query($conn,$reserve_reserve);

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
        if(document.form1.id_list.value == "")
        {
          alert('กรุณาเลือกรายการ')
          document.form1.id_list.focus();
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
      #customers {
        width: 100%;
      }
      #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
      }
      #customers tr:nth-child(even){background-color: #f2f2f2;}
      #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        background-color: #99CCFF;
      }
      select {
        text-align: center;
        text-align-last: center;
      }
      option {
        text-align: center;
        text-align-last: center;
      }
      input {
        text-align: center;
        text-align-last: center;
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
            <form action="algorithm/reserve_money.php" class="form-horizontal" method="post" autocomplete="off" name="form1" onSubmit="JavaScript:return fncSubmit();">
              <div class="box-header with-border">
                <div class="col-12">
                  <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                    <a type="block" href="store.php" class="btn btn-danger pull-left"><< เมนูหลัก</a> 
                  </div>
                  <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                    <div class="text-center">
                      <font size="5">
                        <B align="center"> เงินสำรองจ่าย </B>
                      </font>
                    </div>
                  </div>
                  <div class="col-4 col-sm-4 col-md-4 col-xl-4 text-right">
                    <a type="block" href="reserve_data.php" class="btn btn-success pull-right">ข้อมูลจ่าย</a> 
                  </div>
                </div>
              </div>
              <br>
              <div class="box-body no-padding">
                <div class="mailbox-read-message">
                  <div class="col-sm-12 text-left">
                    <font size="3" color="red">
                      <B> สำรองจ่ายคงเหลือ : <?php echo $money;?> </B>
                    </font>
                  </div>
                  <br>
                  <br>
                  <table class="table">
                    <tr>
                      <th width="20%" class="text-right"><font size="4">ชื่อ &nbsp;&nbsp;:</font></th>
                      <td width="30%"><input type="text" class="form-control" value="<?php echo $username; ?>"  style="background-color: #e6f7ff;" readonly/></td>
                      <th width="20%" class="text-right" ><font size="4">วันที่ &nbsp;&nbsp;:</font></th>
                      <td width="30%"><input type="date" id="datePicker" name="date" class="form-control text-center"></td>
                    </tr>
                    <tr>
                      <th width="20%" class="text-right"><font size="4" valign="middle">รายการ &nbsp;&nbsp;:</font></th>
                      <td width="30%" >
                        <select name="id_list" class="form-control" style="width: 100%;">
                            <option value="">-- รายการ --</option>
                            <?php 
                              while ($value = $objq_reservelist -> fetch_assoc() ) {
                            ?>
                            <option value="<?php echo $value['id_list']; ?>"><?php echo $value['name_list']; ?></option>
                            <?php
                              }
                            ?>
                        </select>
                      </td>
                      <th width="20%" class="text-right"><font size="4">จำนวนเงิน &nbsp;&nbsp;:</font></th>
                      <td width="30%">
                        <input type="number" name="money" class="form-control text-center">
                        <input type="hidden" name="money_befor" value="<?php echo $money; ?>">
                        <input type="hidden" name="id_member" value="<?php echo $id_member; ?>">
                      </td>
                    </tr>
                    <tr>
                      <th width="20%" class="text-right"><font size="4" valign="middle">รถ &nbsp;&nbsp;:</font></th>
                      <td width="30%" >
                        <select name="id_member_car" class="form-control" style="width: 100%;">
                          <?php 
                            $sql_car = "SELECT name,id_member FROM member WHERE status_reserve = 1 ";
                            $objq_car = mysqli_query($conn,$sql_car);
                            while ($value_car = $objq_car -> fetch_assoc() ) {
                          ?>
                            <option value="<?php echo $value_car['id_member']; ?>" <?php if($id_member==$value_car['id_member']){ echo "selected";}else{}?>>
                            <?php echo $value_car['name']; ?></option>
                          <?php
                            }
                          ?>
                        </select>
                      </td>
                      <th width="20%" class="text-right" ><font size="4">หมายเหตุ &nbsp;&nbsp;:</font></th>
                      <td colspan="3" ><input type="text" name="note" value="-" class="form-control"></td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="box-footer text-center">
                <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> บันทึกข้อมูล </button>
              </div>
            </form>
          </div>

          <div class="box box-primary">
              <div class="box-body no-padding">
                <div class="mailbox-read-message">
                  <div class="col-sm-12 text-center">
                    <font size="5" color="red">
                      <B> ประวัติใช้สำรองจ่าย : <?php echo $username; ?></B>
                    </font>
                  </div>
                  <table class="table" id="example2">
                    <thead>
                      <tr>
                        <th class="text-center" width="16%">วันที่</th>
                        <th class="text-center" width="16%">รายการ</th>
                        <th class="text-center" width="16%">รถ</th>
                        <th class="text-center" width="16%">จำนวนเงิน</th>
                        <th class="text-center" width="16%">คงเหลือ</th>
                        <th class="text-center" width="16%">หมายเหตุ</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $sql_rs_history = "SELECT * FROM reserve_history 
                                            INNER JOIN reserve_list ON reserve_history.id_list = reserve_list.id_list
                                            WHERE reserve_history.id_member_receive = $id_member AND reserve_history.id_list != 18
                                            GROUP BY reserve_history.id_reserve_history DESC
                                            LIMIT 1000";
                        $objq_rs_history = mysqli_query($conn,$sql_rs_history);
                        while($value = $objq_rs_history->fetch_assoc()){
                      ?>
                        <?php 
                          if ($value['status']==3) {
                        ?>
                        <tr>
                          <td class="text-center"><font color="red"><?php echo Datethai($value['date']); ?></font></td>
                          <td class="text-center"><font color="red"><?php echo $value['name_list']; ?></font></td>
                          <td class="text-center"><font color="red">-</font></td>
                          <td class="text-center"><font color="red"><?php echo $value['money']; ?></font></td>
                          <td class="text-center"><font color="red"><?php echo $value['transfer']; ?></font></td>
                          <td class="text-center"><font color="red"><?php echo $value['note']; ?></font></td>
                        </tr>
                        <?php
                          }else{

                            if( $value['id_member_car'] == 0){
                              $id_member_car = 54;
                            }else {
                              $id_member_car = $value['id_member_car'];
                            }
                            $sql_car = "SELECT name FROM member WHERE id_member = $id_member_car";
                            $objq_car = mysqli_query($conn,$sql_car);
                            $objr_car = mysqli_fetch_array($objq_car);
                        ?>
                        <tr>
                          <td class="text-center"><?php echo Datethai($value['date']); ?></td>
                          <td class="text-center"><?php echo $value['name_list']; ?></td>
                          <td class="text-center"><?php echo $objr_car['name']; ?></td>
                          <td class="text-center"><?php echo $value['money']; ?></td>
                          <td class="text-center"><?php echo $value['transfer']; ?></td>
                          <td class="text-center"><?php echo $value['note']; ?></td>
                        </tr>
                      <?php
                          }
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
    </script>
  </body>
</html>
