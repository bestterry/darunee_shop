<?php 
  require "../config_database/config.php";
  require "../session.php"; 
  require "menu/date.php";
?>
<!DOCTYPE html>
<html>

  <head>
    <?php require('../font/font_style.php');?>
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
        <?php require('menu/header_logout.php');?>
      </header>
      <div class="content-wrapper">
        <section class="content-header">
        </section>

        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#check" data-toggle="tab">สินค้า</a></li>
                  <li><a href="#addproduct" data-toggle="tab">เพิ่มข้อมูล</a></li>
                  <a href="admin.php" class="btn button2 pull-right"><< เมนูหลัก </a>
                </ul>
                <div class="tab-content">

                  <div class="active tab-pane" id="check">
                    <div class="box box-default">
                      <div class="box-header">
                        <div class="col-12">
                          <div class="col-4 col-sm-4 col-lg-4 col-md-4 col-xl-4"> </div>
                          <div class="col-4 col-sm-4 col-lg-4 col-md-4 col-xl-4 text-center"></div>
                          <div class="col-4 col-sm-4 col-lg-4 col-md-4 col-xl-4 text-right"></div>
                        </div>
                      </div>
                      <div class="box-body">
                        <div class="row" align="center">
                          <div id="myCarousel" class="carousel slide" data-interval="false">

                            <div class="carousel-inner">
                              <?php 
                                $i = 1;
                                $sql_present = "SELECT id,name_product FROM present_product";
                                $objq_present = mysqli_query($conn,$sql_present);
                                while($value = $objq_present->fetch_assoc()){
                              ?>
                                <div class="item <?php if($i == 1){ echo "active";}else{}?>">
                                  <img src="../images/product/<?php echo $value['name_product'];?>" width="1300" height="1200">
                                  <br>
                                  <div class="text-center">
                                    <font size="6"><B><?php echo $value['name_product'];?></B></font>
                                  </div>
                                </div>
                              
                              <?php
                                  $i++;
                                }
                              ?>
                            </div>

                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                              <span class="glyphicon glyphicon-chevron-left"></span>
                              <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                              <span class="glyphicon glyphicon-chevron-right"></span>
                              <span class="sr-only">Next</span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="box-footer">
                        
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane" id="addproduct">
                    <div class="box box-default">
                      <div class="box-header with-border">
                        <div class="col-12">
                          <div class="col-2 col-sm-2 col-xl-2 col-md-2">
                            <a type="button" href="present_product.php" class="btn button2"><< กลับ</a>
                          </div>
                          <div class="col-8 col-sm-8 col-xl-8 col-md-8 text-center">
                            <font size="5"><B>ข้อมูลนำเสนอสินค้า</B></font>
                          </div>
                          <div class="col-2 col-sm-2 col-xl-2 col-md-2 text-right">
                          <a type="button"href="#" data-toggle="modal" data-target="#myModal2" class="btn btn-success" style="color:black;">เพิ่มข้อมูล</a>
                          </div>
                        </div>
                      </div>
                      <div class="box-body no-padding">
                        <div class="mailbox-read-message">
                          <div class="col-1 col-sm-1 col-lg-1 col-md-1 col-xl-1"></div>
                          <div class="col-10 col-sm-10 col-lg-10 col-md-10 col-xl-10">
                            <table id="example2" class="table">
                              <thead>
                                <tr>
                                  <th class="text-center" width="90%">ข้อมูล</th>
                                  <th class="text-center" width="10%">ลบ</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php 
                                $sql_present = "SELECT id,name_product FROM present_product";
                                $objq_present = mysqli_query($conn,$sql_present);
                                while($value = $objq_present->fetch_assoc()){
                              ?>
                                <tr>
                                  <td class="text-center"><?php echo $value['name_product']; ?></td>
                                  <td class="text-center"><a href="algorithm/delete_presentproduct.php?id=<?php echo $value['id']; ?>&&name_product=<?php echo $value['name_product'];?>" class="btn  btn-danger btn-xs" >ลบ</a> </td>   
                                </tr>
                              <?php 
                                }
                              ?>
                              </tbody>
                            </table>
                          </div>
                          <div class="col-1 col-sm-1 col-lg-1 col-md-1 col-xl-1"></div>
                        </div>
                      </div>
                    </div>
                  </div>

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
  </body>

</html>

  <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog modal-lg">
      <form action="algorithm/add_presentproduct.php" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header text-center">
              <font size="5"><B> เพิ่มข้อมูล </B></font>
          </div>
          <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
              <div class="col-8 col-sm-8 col-xl-8 col-md-8">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <th class="text-center" width="30%"><font size="4">รูปสินค้า</font></th>
                      <th class="text-center" width="70%"> 
                        <input name="upload" type="file" class="form-control" style="width: 100%;">
                      </th>
                    </tr>
                  </tbody>
                </table> 
              </div>
              <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
              
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit"  class="btn btn-success pull-right" OnClick="return confirm('ต้องการบันทึกหรือไม่ ?')";>บันทึก</button>
            <button type="button" class="btn button2 pull-left" data-dismiss="modal"><< กลับ</button>
          </div>
        </div>
      </form>
    </div>
  </div>