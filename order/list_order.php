<?php
  require "../config_database/config.php";

  function DateThai($strDate)
  {
    $strYear = date("Y",strtotime($strDate))+543-2500;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
  }
?>
<!DOCTYPE html>
<html>

<head>
  <?php require('../font/font_style.php'); ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>รายการ ORDER</title>
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
  </style>
</head>

<body class=" hold-transition skin-blue layout-top-nav">
  <div>
    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            
          </ul>
        </div>
      </nav>
    </header>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" width="2000px">
      <!-- Main content -->
      <section class="content">
      <div class="col-md-12">
          <div class="box box-primary">
            <!-- /.box-header -->
          <div class="box-header with-border">
            <a type="button" href="order.php" class="btn btn-danger "><= เมนูหลัก</a>
          </div>
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
              <table id="customers">
                <tbody>
                  <tr>
                    <th class="text-center" width="5%">ข้อมูล</th>
                    <th class="text-center" width="5%">แก้</th>
                    <th class="text-center" width="10%">ใบสั่งที่</th>
                    <th class="text-center" width="30%">สินค้า_หน่วย</th>
                    <th class="text-center" width="10%">จำนวน</th>
                    <th class="text-center" width="10%">ราคา</th>
                    <th class="text-center" width="10%">เงินซื้อ</th>
                    <th class="text-center" width="10%">วันที่สั่ง</th>
                    <th class="text-center" width="10%">สถานะ</th>
                  </tr>
                 <?php 
                 
                  $order_list = "SELECT * FROM order_list
                                   INNER JOIN product ON order_list.id_product = product.id_product
                                   ORDER BY order_list.id_order_list DESC";
                  $objq_addorder = mysqli_query($conn,$order_list);
                  while($value = $objq_addorder->fetch_assoc()){
                    $num_product = $value['num_product'];
                    $price = $value['price'];
                    $total_money = $num_product * $price;
                    $status = $value['status'];
                 ?>
                  <tr>
                    <td class="text-center"><a href="data_order.php?id_order_list=<?php echo $value['id_order_list']; ?>"><i class="fa fa-search-plus"></i></a></td>
                    <td class="text-center" ><a href="edit_order.php?id_order_list=<?php echo $value['id_order_list']; ?>" class="btn btn-success btn-xs" >แก้</a></td>
                    <td class="text-center"><?php echo $value['list_order'];?></td>
                    <td class="text-center" ><?php echo $value['name_product'];?></td>
                    <td class="text-center" ><?php echo $num_product; ?></td>
                    <td class="text-center" ><?php echo $price; ?></td>
                    <td class="text-center" ><?php echo $total_money; ?></td>
                    <td class="text-center" ><?php echo DateThai($value['date_order']);?></td>
                     <td class="text-center">
                     <?php  
                        if($status=="done"){
                      ?>
                        <span class="label label-danger">ไม่ได้จ่าย</span>
                      <?php
                        }else {
                      ?>
                        <span class="label label-success">จ่ายแล้ว</span>
                      <?php  
                        }
                     ?>
                    </td>
                  </tr>
                 <?php 
                  }
                 ?>
                </tbody>
              </table>
              </div>
            </div>
            <div class="box-footer" align="center"> </div>
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
      $('.mailbox-read-message input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
      }
      
                                                          );
      //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })

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