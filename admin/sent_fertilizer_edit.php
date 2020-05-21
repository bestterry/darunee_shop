<?php
  require "../config_database/config.php";
  require "../session.php";
  require "menu/date.php";

  $id = $_GET['id_sent_ferti'];
  $day = $_GET['day'];
  $sql_ferti = "SELECT * FROM sent_ferti
                INNER JOIN type_lift ON sent_ferti.id_type_lift = type_lift.id
                INNER JOIN member ON sent_ferti.id_member = member.id_member 
                WHERE sent_ferti.id_sent_ferti = $id";
  $objq_ferti = mysqli_query($conn,$sql_ferti);
  $objr_ferti = mysqli_fetch_array($objq_ferti);
  $id_type_lift = $objr_ferti['id_type_lift'];
  $id_car = $objr_ferti['id_car'];

  $sql_member = "SELECT name FROM member WHERE id_member = $id_car";
  $objq_member = mysqli_query($conn,$sql_member);
  $objr_member = mysqli_fetch_array($objq_member);

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
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <div class="box box-default">
              <div class="box-header with-border">
                <div class="row">
                  <div class="col-md-12 col-12">
                      <div class="col-md-3 col-sm-3 col-3">
                        <div align="left">
                          <a href="sent_fertilizer_list.php?day=<?php echo $day; ?>" class="btn button2"><< ย้อนกลับ</a>
                        </div>
                      </div>

                      <div class="col-md-6 col-sm-6 col-6">
                        <p align="center">
                          <font size="5">
                            <B>ค่าส่งปุ๋ย วันที่</B>
                          </font>
                        </p>
                      </div>

                      <div class="col-md-3 col-sm-3 col-3">
                        <div>
                         
                        </div>
                      </div>
                  
                  </div>
                </div>
              </div>
                <form class="form-horizontal" action="algorithm/edit_sent_ferti.php?day=<?php echo $day; ?>" method="post" autocomplete="off" name="form1" onSubmit="JavaScript:return fncSubmit();">
                  <div class="box-body with-border">
                  
                    <div class="row">
                      <div class="col-md-3 col-sm-3"></div>
                      <div class="col-md-6 col-sm-6">
                        
                        <div class="row">
                          <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-6 control-label">ชื่อ</label>
                            <div class="col-sm-9 col-md-9 col-6">
                              <input class="form-control" type="text" value="<?php echo $objr_ferti['name'];?>" disabled>
                              <input name="id" type="hidden" value="<?php echo $id; ?>">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-6 control-label">รถ</label>
                            <div class="col-sm-9 col-md-9 col-6">
                              <select name="id_car" class="form-control" style="width: 100%;">
                                <option value="<?php echo $objr_ferti['id_car'];?>"  selected='selected'><?php echo $objr_member['name'];?></option>
                                <?php 
                                   while($value = $objq_car->fetch_assoc()){
                                ?>
                                    <option value="<?php echo $value['id_member']; ?>" ><?php echo $value['name'];?></option>
                                <?php 
                                    }
                                ?>
                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-6 control-label">งาน</label>
                            <div class="col-sm-9 col-md-9 col-6">
                              <select name="id_type_lift" class="form-control" style="width: 100%;">
                                <option value="1"  <?php if($id_type_lift == 1){ echo "selected='selected'";} ?>>ยกขึ้น</option>
                                <option value="2"  <?php if($id_type_lift == 2){ echo "selected='selected'";} ?>>ยกลง</option>
                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-6 control-label">คน</label>
                            <div class="col-sm-9 col-md-9 col-6">
                              <input class="form-control" name="num_cus" id="num_cus" onKeyUp="calcfunc()" type="text" value="<?php echo $objr_ferti['num_cus'];?>">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-6 control-label"> กส.</label>
                            <div class="col-sm-9 col-md-9 col-6">
                              <input class="form-control" name="num_ferti" id="num_ferti" onKeyUp="calcfunc()" type="text" value="<?php echo $objr_ferti['num_ferti'];?>">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-6 control-label">ค่ายก</label>
                            <div class="col-sm-9 col-md-9 col-6">
                              <input class="form-control" name="money" type="text" id="money" value="<?php echo $objr_ferti['money'];?>">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="form-group">
                            <label class="col-sm-3 col-md-3 col-6 control-label">รายการ</label>
                            <div class="col-sm-9 col-md-9 col-6">
                              <input class="form-control" name="note" type="text" value="<?php echo $objr_ferti['note'];?>">
                            </div>
                          </div>
                        </div>
                       
                      </div>
                      <div class="col-md-3 col-sm-3"></div>
                    </div>
                  
                  </div>
                  <div class="box-footer with-border">
                    <div align="center" >
                      <button type="submit" class="btn btn-success" onClick="return confirm('คุณต้องการที่จะเปลี่ยนแปลงข้อมูลหรือไม่ ?')";><i class="fa fa-check-square-o"></i> บันทึก </button>
                      <a type="button" href="algorithm/delete_sent_ferti.php?id_sent_ferti=<?php echo $id; ?>" class="btn btn-danger" onClick="return confirm('คุณต้องการที่จะลบข้อมูลหรือไม่?')";> ลบ </a>
                    </div>
                  </div>
                </form>
              </div>
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
     function calcfunc() {
              var val1 = parseFloat(document.form1.num_ferti.value);
              var val2 = parseFloat(document.form1.num_cus.value);
              document.form1.money.value=val1/val2;
              }
  </script>
</body>

</html>