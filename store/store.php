<?php 
  require "../config_database/config.php";
  require "../session.php"; 
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class=" hold-transition skin-blue layout-top-nav ">
<div class="wrapper">

  <header class="main-header">

  
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
    </nav>
  </header>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <!-- Main content -->
    <section class="content">
  
      <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <font size="6"><p align = "center"> สต๊อกรถ </font></p>
                <font size="4"><b align = "left"> เจ้าของรถ : <?php echo $username; ?></font></b>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <div class="mailbox-read-message">
                <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-warning"><span class="glyphicon glyphicon-plus"></span>เพิ่มรายการสินค้า</a>
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <form action="algorithm/add_store.php" method="post">
                            <div class="modal-content">
                                <div class="col-md-3"></div>
                                <div class="modal-header">
                                    <font size="6"><p align = "center"> เลือกรายการสินค้า </p></font>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="modal-body col-md-8 table-responsive mailbox-messages">
                                  <div class="table-responsive mailbox-messages">
                                      <table class="table table-hover table-striped table-bordered">
                                        <tbody>
                                          <tr>
                                                <th class="text-center" width="20%">เลือกสินค้า</th>
                                                <th class="text-center" width="35%">ชื่อสินค้า</th>
                                                <th class="text-center" width="15%">หน่วยนับ</th>
                                              <?php
                                                $product = "SELECT * FROM product";
                                                $query_product = mysqli_query($conn,$product);
                                                while($list_product = $query_product ->fetch_assoc()){
                                              ?>
                                            <tr>
                                                <td class="text-center" width="15%"><input type="checkbox" name="id_product[]" value="<?php echo $list_product['id_product'];?>"></td>
                                                <td  width="35%"><?php echo $list_product['name_product'];?></td>
                                                <td class="text-center" width="15%"><?php echo $list_product['unit']; ?></td>
                                               <?php } ?>
                                            </tr>
                                            </tbody>
                                      </table>
                                  </div>
                                  <input type="hidden" name="id_member" value="<?php echo $id_member; ?>">
                                  <button type="submit"  class="btn btn-success pull-left"><i class="fa fa-save"> บันทึก </i></button>
                                  <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-close"> ปิดหน้าต่างนี้</i></button>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- ------------------------------------------------------------------------------------- -->
                <br>
                  <form action="store_2.php" method="post" autocomplete="off">
                    <table class="table table-bordered table-hover">
                        <tbody>
                          <tr bgcolor="#99CCFF">
                            <th class="text-center" width="5%" >ลำดับ</th>
                            <th class="text-center" >สินค้า</th>
                            <th class="text-center" width="6%">หน่วย</th>
                            <th class="text-center" width="9%">ยกมา(+)</th>
                            <th class="text-center" width="9%">รับเข้า(+)</th>
                            <th class="text-center" width="9%">เบิกออก(-)</th>
                            <th class="text-center" width="9%">ขาย(-)</th>
                            <th class="text-center" width="9%">อื่นๆ(-)</th>
                            <th class="text-center" width="9%">คืนร้าน</th>
                            <th class="text-center" width="9%">เหลือ</th>
                            <th class="text-center" width="9%">นับจริง</th>
                          </tr>
      <?php 
        $store = "SELECT * FROM store_incar INNER JOIN product 
                  ON store_incar.id_product = product.id_product WHERE store_incar.id_member = $id_member";
        $query_store = mysqli_query($conn,$store);
        $i = 1;
        while($list = $query_store -> fetch_assoc()){
      ?>
                          <tr>
                            <td class="text-center"><?php echo $i; ?><input type="hidden" name="id_store_incar[]"  class="form-control text-center col-md-2" value="<?php echo $list['id_store_incar'];?>"></td>
                            <td class="text-center"  ><input type="text" name="name_product[]"  class="form-control text-center col-md-2" value="<?php echo $list['name_product'];?>" readonly/></td>
                            <td class="text-center"  ><input type="text" name="unit[]"  class="form-control text-center col-md-2" value="<?php echo $list['unit'];?>" readonly/></td>
                            <td bgcolor="#ccffcc" class="text-center"  ><input type="text" name="bring[]"  class="form-control text-center col-md-2" value="<?php echo $list['bring'];?>" ></td>
                            <td bgcolor="#ccffcc" class="text-center"  ><input type="text" name="input[]"  class="form-control text-center col-md-2" value="<?php echo $list['input'];?>"></td>
                            <td bgcolor="#ffc2b3" class="text-center"  ><input type="text" name="draw[]"  class="form-control text-center col-md-2" value="<?php echo $list['draw'];?>"></td>
                            <td bgcolor="#ffc2b3" class="text-center"  ><input type="text" name="sale[]"  class="form-control text-center col-md-2" value="<?php echo $list['sale'];?>" ></td>
                            <td bgcolor="#ffc2b3" class="text-center"  ><input type="text" name="etc[]"  class="form-control text-center col-md-2" value="<?php echo $list['etc'];?>"></td>
                            <td bgcolor="#ffc2b3" class="text-center"  ><input type="text" name="return[]"  class="form-control text-center col-md-2" value="<?php echo $list['ret'];?>"></td>
                            <td bgcolor="#b3ffff" class="text-center"  ><?php echo $list['surplus'];?></td>
                            <td bgcolor="#b3ffff" class="text-center"  ><input type="text" name="count[]"  class="form-control text-center col-md-2" value="<?php echo $list['count'];?>"></td>
                          </tr>
        <?php
          $i++;}
        ?>                   
                        </tbody>
                    </table>
                </div>
                <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
            <!-- /.box-footer -->
            <div class="box-footer">
             <button type="submit" class="btn btn-success pull-right"><i class="fa fa-calculator"> </i>  คำนวณ</button>

             <a href="algorithm/update_store.php?id_member=<?php echo $id_member; ?>" type="button" class="btn btn-info pull-left"><i class="fa fa-refresh"> </i>  ปรับปรุง</a>
            </div>
            <!-- /.box-footer -->
        </div>
        </form>
        <!-- /. box -->
    </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

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
      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      }
                              )
    }
     )
    $(function () {
      //Enable iCheck plugin for checkboxes
      //iCheck for checkbox and radio inputs
      $('.mailbox-messages input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
      }
                                                          );
      //Enable check and uncheck all functionality
      $(".checkbox-toggle").click(function () {
        var clicks = $(this).data('clicks');
        if (clicks) {
          //Uncheck all checkboxes
          $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
          $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
        }
        else {
          //Check all checkboxes
          $(".mailbox-messages input[type='checkbox']").iCheck("check");
          $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
        }
        $(this).data("clicks", !clicks);
      }
                                 );
      //Handle starring for glyphicon and font awesome
      $(".mailbox-star").click(function (e) {
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
      }
                              );
    }
     );
  </script>
</body>
</html>
