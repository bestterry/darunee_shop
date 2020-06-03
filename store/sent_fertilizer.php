<?php
  require "../config_database/config.php";
  require "../session.php";
  require "menu/date.php";

  $sql_ferti = "SELECT * FROM sent_ferti
                INNER JOIN type_lift ON sent_ferti.id_type_lift = type_lift.id
                INNER JOIN member ON sent_ferti.id_member = member.id_member 
                WHERE sent_ferti.id_member = $id_member ORDER BY sent_ferti.id_sent_ferti DESC";
  $objq_ferti = mysqli_query($conn,$sql_ferti);

  $sql_car = "SELECT id_member,name FROM member WHERE 
              status='employee' AND NOT id_member = 3 AND NOT id_member = 8 AND NOT id_member = 19
              AND NOT id_member = 32 AND NOT id_member = 28";
  $objq_car = mysqli_query($conn,$sql_car);
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

      <div class="content-wrapper">

        <section class="content">
            <div class="box box-default">
            
              <div class="box-header with-border">
                <div class="row">
                  <div class="col-12">
                      <div class="col-md-3 col-sm-3 col-3">
                        <div align="left">
                          <a href="store.php" class="btn button2"><< เมนูหลัก</a>
                        </div>
                      </div>

                      <div class="col-md-6 col-sm-6 col-6">
                        <p align="center">
                          <font size="5">
                            <B>ค่าส่งปุ๋ย</B>
                          </font>
                        </p>
                      </div>

                      <div class="col-md-3 col-sm-3 col-3">
                        <div align="right">
                        
                        </div>
                      </div>
                  
                  </div>
                </div>
              </div>

              <div class="box-body">
                <div class="container">
                  <div class="row">
                    <form class="form-horizontal" action="algorithm/add_sent_ferti.php" method="post" autocomplete="off" name="form1" onSubmit="JavaScript:return fncSubmit();">
                      <div class="row">
                        <section class="col-xs-12 col-md-6">
                          <div class="row">

                            <div class="col-12">
                              <div class="row">
                                <div class="form-group">
                                  <label class="col-sm-3 col-md-3 col-6 control-label">ชื่อ</label>
                                  <div class="col-sm-6 col-md-6 col-6">
                                    <input class="form-control" type="text" value="<?php echo $username;?>" disabled>
                                    <input name="id_member" type="hidden" value="<?php echo $id_member;?>">
                                  </div>
                                  <div class="col-sm-3 col-md-3 col-3"></div>
                                </div>
                              </div>
                            </div>

                            <div class="col-12">
                              <div class="row">
                                <div class="form-group">
                                  <label class="col-sm-3 col-md-3 col-6 control-label">รถ</label>
                                  <div class="col-sm-6 col-md-6 col-6">
                                    <select name="id_car"  class="form-control" style="width: 100%;">
                                      <option value="" >กรุณาเลือกหน่วยรถ</option>
                                      <?php 
                                      while($value = $objq_car->fetch_assoc()){
                                      ?>
                                        <option value="<?php echo $value['id_member']; ?>" ><?php echo $value['name'];?></option>
                                      <?php 
                                        }
                                      ?>
                                      
                                    </select>
                                  </div>
                                  <div class="col-sm-3 col-md-3 col-3"></div>
                                </div>
                              </div>
                            </div>

                            <div class="col-12">
                              <div class="row">
                                <div class="form-group">
                                  <label class="col-sm-3 col-md-3 col-6 control-label">ยก</label>
                                  <div class="col-sm-6 col-md-6 col-6">
                                    <select name="id_type_lift"  class="form-control" style="width: 100%;">
                                      <option value="1" >ขึ้น</option>
                                      <option value="2" >ลง</option>
                                    </select>
                                  </div>
                                  <div class="col-sm-3 col-md-3 col-3"></div>
                                </div>
                              </div>
                            </div>

                          </div>
                        </section>

                        <section class="col-xs-12 col-md-6">
                          <div class="row">
                            <div class="col-12">
                              <div class="row">
                                <div class="form-group">
                                  <label class="col-sm-3 col-md-3 col-6 control-label">จำนวนคน</label>
                                  <div class="col-sm-6 col-md-6 col-6">
                                    <input class="form-control" name="num_cus" id="num_cus" onKeyUp="calcfunc()" type="number" value="">
                                  </div>
                                  <div class="col-sm-3 col-md-3 col-3"></div>
                                </div>
                              </div>
                            </div>

                            <div class="col-12">
                              <div class="row">
                                <div class="form-group">
                                  <label class="col-sm-3 col-md-3 col-6 control-label">จำนวน กส.</label>
                                  <div class="col-sm-6 col-md-6 col-6">
                                    <input class="form-control" name="num_ferti" id="num_ferti" onKeyUp="calcfunc()" type="number" value="">
                                  </div>
                                  <div class="col-sm-3 col-md-3 col-3"></div>
                                </div>
                              </div>
                            </div>

                            <div class="col-12">
                              <div class="row">
                                <div class="form-group">
                                  <label class="col-sm-3 col-md-3 col-6 control-label">ค่ายก</label>
                                  <div class="col-sm-6 col-md-6 col-6">
                                    <input class="form-control" name="money" type="number" id="money" value="">
                                  </div>
                                  <div class="col-sm-3 col-md-3 col-3"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </section>

                        <section class="row">
                          <div class="col-xs-12 col-md-12">
                            <div class="row">
                              <div class="form-group">
                                <label class="col-sm-3 col-md-3 col-3 control-label">สต๊อก</label>
                                <div class="col-sm-6 col-md-6 col-6">
                                  <input class="form-control" name="note" list="note" type="text" value="">
                                  <datalist id="note">
                                    <option value="จุน">
                                    <option value="พาน">
                                    <option value="แม่จัน">
                                    <option value="ลำปาง">
                                    <option value="เวียงป่าเป้า">
                                    <option value="ดอกคำใต้">
                                    <option value="แจ้ห่ม">
                                    <option value="หน่วยรถ">
                                    <option value="ลูกค้า">
                                  </datalist>
                                </div>
                                <div class="col-sm-3 col-md-3 col-3"></div>
                              </div>
                            </div>
                          </div>
                        </section>
                      </div>
                          
                      <div class="row">
                        <div class="text-center col-md-12 col-12" >
                          <button type="submit" class="btn btn-success" onClick="return confirm('คุณต้องการที่จะบันทึกข้อมูลหรือไม่ ?')";><i class="fa fa-check-square-o"></i> บันทึก </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <div class="box-footer with-border">
                <table id="example1" class="table table-striped">
                  <thead>
                  <tr>
                    <th class="text-center" width="10%"> <font color="red">ชื่อ</font> </th>
                    <th class="text-center" width="10%"> <font color="red">ยก</font> </th>
                    <th class="text-center" width="8%"> <font color="red">รถ</font> </th>
                    <th class="text-center" width="8%"> <font color="red">คน</font> </th>
                    <th class="text-center" width="8%"> <font color="red">กส</font> </th>
                    <th class="text-center" width="8%"> <font color="red">ค่ายก</font> </th>
                    <th class="text-center" width="8%"> <font color="red">ค่ารถ</font> </th>
                    <th class="text-center" width="24%"> <font color="red">สต๊อก</font> </th>
                    <th class="text-center" width="16%"> <font color="red">วันที่</font> </th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                    while($value = $objq_ferti->fetch_assoc()){
                      $id_car = $value['id_car'];
                      $sql = "SELECT name FROM member WHERE id_member = $id_car";
                      $objq = mysqli_query($conn,$sql);
                      $objr = mysqli_fetch_array($objq);

                      $id_member = $value['id_member'];

                    if($id_member == $id_car){
                      $car_rental = $value['num_ferti']*0.75;
                    }else{
                      $car_rental = "-";
                    }
                  ?>
                  <tr>
                    <td class="text-center"><?php echo $value['name'];?></td>
                    <td class="text-center"><?php echo $value['name_type_lift'];?></td>
                    <td class="text-center"><?php echo $objr['name'];?></td>
                    <td class="text-center"><?php echo $value['num_cus'];?></td>
                    <td class="text-center"><?php echo $value['num_ferti'];?></td>
                    <td class="text-center"><?php echo $value['money'];?></td>
                    <td class="text-center"><?php echo $car_rental;?></td>
                    <td class="text-center"><?php echo $value['note'];?></td>
                    <td class="text-center"><?php echo Datethai2($value['datetime']);?></td>
                  </tr>
                  <?php
                    }
                  ?>
                  </tbody>
                </table>
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
      function calcfunc() {
                var val1 = parseFloat(document.form1.num_ferti.value);
                var val2 = parseFloat(document.form1.num_cus.value);
                document.form1.money.value= Math.ceil(val1/val2);
                }
    </script>
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
      })
      $(function() {
        //Enable iCheck plugin for checkboxes
        //iCheck for checkbox and radio inputs
        $('.mailbox-messages input[type="checkbox"]').iCheck({
          checkboxClass: 'icheckbox_flat-blue',
          radioClass: 'iradio_flat-blue'
        });
        //Enable check and uncheck all functionality
        $(".checkbox-toggle").click(function() {
          var clicks = $(this).data('clicks');
          if (clicks) {
            //Uncheck all checkboxes
            $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
            $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
          } else {
            //Check all checkboxes
            $(".mailbox-messages input[type='checkbox']").iCheck("check");
            $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
          }
          $(this).data("clicks", !clicks);
        });
        //Handle starring for glyphicon and font awesome
        $(".mailbox-star").click(function(e) {
          e.preventDefault();
          //detect type
          var $this = $(this).find("a > i");
          var glyph = $this.hasClass("glyphicon");
          var fa = $this.hasClass("fa");
          //Switch states
          if (glyph) {
            $this.toggleClass("glyphicon-star");
            $this.toggleClass("glyphicon-star-empty");
          }
          if (fa) {
            $this.toggleClass("fa-star");
            $this.toggleClass("fa-star-o");
          }
        });
      });
    </script>
  </body>

</html>