<?php
  include("db_connect.php");
  $mysqli = connect();
  $province_id = $_POST['province_name'];

  $sql_province = "SELECT * FROM tbl_provinces WHERE province_id = $province_id";
  $objq_province = mysqli_query($mysqli,$sql_province);
  $objr_province = mysqli_fetch_array($objq_province);
          
  function DateThai($strDate)
  {
    $strYear = date("Y",strtotime($strDate))+543;
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

  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <style>
    thead {
      color: rgb(255, 0, 0);
    }
    .button2 {
      background-color: #b35900;
      color : white;
      } /* Back & continue */
  </style>
</head>

<body class=" hold-transition skin-blue layout-top-nav ">
  <div class="wrapper">

    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="../dist/img/user.png" class="user-image" alt="User Image">
                
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="../dist/img/user.png" class="img-circle" alt="User Image">
                  
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-right">
                    <a href="../login/logout.php" class="btn btn-danger btn-flat">ออกจากระบบ</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <div class="content-wrapper">
      <section class="content">
        <?php 
          $province_id = $_POST['province_name'];
          if ($province_id == 38) {
        ?>
          <div class="box box-primary">
            <div class="box-header text-center with-border">
              <div class="col-12">
                <div class="col-2 col-sm-2 col-xl-2 col-md-2 text-left">
                  <a type="button" href="list_order.php" class="btn button2"><< กลับ</a>
                </div>
                <div class="col-8 col-sm-8 col-xl-8 col-md-8 text-center">
                  <B align="center"> 
                    <font size="5"> จำนวน ORDER ค้างส่ง (<?php echo $objr_province['province_name']; ?>) </font>
                  </B>
                  </font>
                </div>
                <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
              </div>
            </div> 
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                <table class="table">
                  <thead>
                  <tr>
                    <th class="text-center" width="4%"></th>
                    <?php 
                      $sql_amphur = "SELECT * FROM tbl_amphures WHERE province_id = 38";
                      $objq_amphur = mysqli_query($mysqli,$sql_amphur);
                      while($value_am = $objq_amphur->fetch_assoc()){
                    ?>  
                    <th class="text-center" width="4%"><?php echo $value_am['amphur_subname'];?></th>
                    <?php }?>
                    
                    <th class="text-center">รวม</th>
                  </tr>
                  </thead>
                  <tbody>
                    <tr>
                    <?php
                      $sql_product = "SELECT * FROM product WHERE status_stock = 1";
                      $objq_product = mysqli_query($mysqli,$sql_product);
                      while($value_pd = $objq_product->fetch_assoc())
                      {
                    ?>
                    <td class="text-center"><?php echo $value_pd['name_product'].'_'.$value_pd['unit'];?></td>
                    <?php
                      $total_pd = 0;
                      $id_product = $value_pd['id_product'];
                      $sql_amphur = "SELECT * FROM tbl_amphures WHERE province_id = 38";
                      $objq_amphur = mysqli_query($mysqli,$sql_amphur);
                      while($value_am = $objq_amphur->fetch_assoc())
                      {
                        
                        $amphur_id = $value_am['amphur_id'];
                        $sql_numpd = "SELECT SUM(num) FROM listorder 
                                      INNER JOIN addorder ON listorder.id_addorder = addorder.id_addorder
                                      INNER JOIN product ON listorder.id_product = product.id_product
                                      WHERE addorder.amphur_id = $amphur_id AND listorder.id_product = $id_product AND addorder.status = 'pending'";
                        $objq_numpd = mysqli_query($mysqli,$sql_numpd);
                        $objr_numpd = mysqli_fetch_array($objq_numpd);
                        $numpd = $objr_numpd['SUM(num)'];
                    ?>
                    <td class="text-center">
                      <?php 
                      if (!isset($numpd)) {
                        echo "-";
                      }else{
                        echo $numpd;
                      }
                      
                      ?>
                    </td>
                    <?php 
                      $total_pd = $total_pd + $numpd;
                      }
                    ?>
                    <td class="text-center"><?php echo "$total_pd";?></td>
                  </tr>
                  <?php 
                    }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        <?php 
          }elseif($province_id == 40) {
        ?> 
          <div class="box box-primary">
            <div class="box-header text-center with-border">
              <div class="col-12">
                <div class="col-2 col-sm-2 col-xl-2 col-md-2 text-left">
                  <a type="button" href="list_order.php" class="btn button2"><< กลับ</a>
                </div>
                <div class="col-8 col-sm-8 col-xl-8 col-md-8 text-center">
                  <B align="center"> 
                    <font size="5"> จำนวน ORDER ค้างส่ง (<?php echo $objr_province['province_name']; ?>) </font>
                  </B>
                  </font>
                </div>
                <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
              </div>
            </div> 
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="text-center" width="10%"></th>
                      <?php 
                        $sql_amphur = "SELECT * FROM tbl_amphures WHERE province_id = $province_id";
                        $objq_amphur = mysqli_query($mysqli,$sql_amphur);
                        while($value_am = $objq_amphur->fetch_assoc()){
                      ?> 
                      <th class="text-center" width="6.5%"><?php echo $value_am['amphur_subname'];?></th>
                      <?php }?>
                      <th class="text-center">รวม</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    <?php
                      $sql_product = "SELECT * FROM product WHERE status_stock = 1";
                      $objq_product = mysqli_query($mysqli,$sql_product);
                      while($value_pd = $objq_product->fetch_assoc())
                      {
                    ?>
                      <td class="text-center"><?php echo $value_pd['name_product'].'_'.$value_pd['unit'];?></td>
                      <?php
                        $total_pd = 0;
                        $id_product = $value_pd['id_product'];
                        $sql_amphur = "SELECT * FROM tbl_amphures WHERE province_id = $province_id";
                        $objq_amphur = mysqli_query($mysqli,$sql_amphur);
                        while($value_am = $objq_amphur->fetch_assoc())
                        {
                          
                          $amphur_id = $value_am['amphur_id'];
                          $sql_numpd = "SELECT SUM(num) FROM listorder 
                                        INNER JOIN addorder ON listorder.id_addorder = addorder.id_addorder
                                        INNER JOIN product ON listorder.id_product = product.id_product
                                        WHERE addorder.amphur_id = $amphur_id AND listorder.id_product = $id_product AND addorder.status = 'pending'";
                          $objq_numpd = mysqli_query($mysqli,$sql_numpd);
                          $objr_numpd = mysqli_fetch_array($objq_numpd);
                          $numpd = $objr_numpd['SUM(num)'];
                      ?>
                      <td class="text-center">
                        <?php 
                        if (!isset($numpd)) {
                          echo "-";
                        }else{
                          echo $numpd;
                        }
                        ?>
                      </td>
                      <?php 
                        $total_pd = $total_pd + $numpd;
                        }
                      ?>
                      <td class="text-center"><?php echo "$total_pd";?></td>
                    </tr>
                    <?php 
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        <?php 
          }elseif($province_id == 39) {
        ?> 
          <div class="box box-primary">
            <div class="box-header text-center with-border">
              <div class="col-12">
                <div class="col-2 col-sm-2 col-xl-2 col-md-2 text-left">
                  <a type="button" href="list_order.php" class="btn button2"><< กลับ</a>
                </div>
                <div class="col-8 col-sm-8 col-xl-8 col-md-8 text-center">
                  <B align="center"> 
                    <font size="5"> จำนวน ORDER ค้างส่ง (<?php echo $objr_province['province_name']; ?>) </font>
                  </B>
                  </font>
                </div>
                <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
              </div>
            </div> 
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="text-center" width="10%"></th>
                      <?php 
                        $sql_amphur = "SELECT * FROM tbl_amphures WHERE province_id = $province_id";
                        $objq_amphur = mysqli_query($mysqli,$sql_amphur);
                        while($value_am = $objq_amphur->fetch_assoc()){
                      ?> 
                      <th class="text-center" width="10%"><?php echo $value_am['amphur_name'];?></th>
                      <?php }?>
                      <th class="text-center">รวม</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    <?php
                      $sql_product = "SELECT * FROM product WHERE status_stock = 1";
                      $objq_product = mysqli_query($mysqli,$sql_product);
                      while($value_pd = $objq_product->fetch_assoc())
                      {
                    ?>
                      <td class="text-center"><?php echo $value_pd['name_product'].'_'.$value_pd['unit'];?></td>
                      <?php
                        $total_pd = 0;
                        $id_product = $value_pd['id_product'];
                        $sql_amphur = "SELECT * FROM tbl_amphures WHERE province_id = $province_id";
                        $objq_amphur = mysqli_query($mysqli,$sql_amphur);
                        while($value_am = $objq_amphur->fetch_assoc())
                        {
                          
                          $amphur_id = $value_am['amphur_id'];
                          $sql_numpd = "SELECT SUM(num) FROM listorder 
                                        INNER JOIN addorder ON listorder.id_addorder = addorder.id_addorder
                                        INNER JOIN product ON listorder.id_product = product.id_product
                                        WHERE addorder.amphur_id = $amphur_id AND listorder.id_product = $id_product AND addorder.status = 'pending'";
                          $objq_numpd = mysqli_query($mysqli,$sql_numpd);
                          $objr_numpd = mysqli_fetch_array($objq_numpd);
                          $numpd = $objr_numpd['SUM(num)'];
                      ?>
                      <td class="text-center">
                        <?php 
                        if (!isset($numpd)) {
                          echo "-";
                        }else{
                          echo $numpd;
                        }
                        ?>
                      </td>
                      <?php 
                        $total_pd = $total_pd + $numpd;
                        }
                      ?>
                      <td class="text-center"><?php echo "$total_pd";?></td>
                    </tr>
                    <?php 
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        <?php 
          }elseif($province_id == 44) {
        ?> 
          <div class="box box-primary">
            <div class="box-header text-center with-border">
              <div class="col-12">
                <div class="col-2 col-sm-2 col-xl-2 col-md-2 text-left">
                  <a type="button" href="list_order.php" class="btn button2"><< กลับ</a>
                </div>
                <div class="col-8 col-sm-8 col-xl-8 col-md-8 text-center">
                  <B align="center"> 
                    <font size="5"> จำนวน ORDER ค้างส่ง (<?php echo $objr_province['province_name']; ?>) </font>
                  </B>
                  </font>
                </div>
                <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
              </div>
            </div> 
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="text-center" width="10%"></th>
                      <?php 
                        $sql_amphur = "SELECT * FROM tbl_amphures WHERE province_id = $province_id";
                        $objq_amphur = mysqli_query($mysqli,$sql_amphur);
                        while($value_am = $objq_amphur->fetch_assoc()){
                      ?> 
                      <th class="text-center" width="9%"><?php echo $value_am['amphur_name'];?></th>
                      <?php }?>
                      <th class="text-center" width="9%">รวม</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    <?php
                      $sql_product = "SELECT * FROM product WHERE status_stock = 1";
                      $objq_product = mysqli_query($mysqli,$sql_product);
                      while($value_pd = $objq_product->fetch_assoc())
                      {
                    ?>
                      <td class="text-center"><?php echo $value_pd['name_product'].'_'.$value_pd['unit'];?></td>
                      <?php
                        $total_pd = 0;
                        $id_product = $value_pd['id_product'];
                        $sql_amphur = "SELECT * FROM tbl_amphures WHERE province_id = $province_id";
                        $objq_amphur = mysqli_query($mysqli,$sql_amphur);
                        while($value_am = $objq_amphur->fetch_assoc())
                        {
                          
                          $amphur_id = $value_am['amphur_id'];
                          $sql_numpd = "SELECT SUM(num) FROM listorder 
                                        INNER JOIN addorder ON listorder.id_addorder = addorder.id_addorder
                                        INNER JOIN product ON listorder.id_product = product.id_product
                                        WHERE addorder.amphur_id = $amphur_id AND listorder.id_product = $id_product AND addorder.status = 'pending'";
                          $objq_numpd = mysqli_query($mysqli,$sql_numpd);
                          $objr_numpd = mysqli_fetch_array($objq_numpd);
                          $numpd = $objr_numpd['SUM(num)'];
                      ?>
                      <td class="text-center">
                        <?php 
                        if (!isset($numpd)) {
                          echo "-";
                        }else{
                          echo $numpd;
                        }
                        ?>
                      </td>
                      <?php 
                        $total_pd = $total_pd + $numpd;
                        }
                      ?>
                      <td class="text-center"><?php echo "$total_pd";?></td>
                    </tr>
                    <?php 
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        <?php
          }else{
        ?>
          <div class="box box-primary">
            <div class="box-header text-center with-border">
              <div class="col-12">
                <div class="col-2 col-sm-2 col-xl-2 col-md-2 text-left">
                  <a type="button" href="list_order.php" class="btn button2"><< กลับ</a>
                </div>
                <div class="col-8 col-sm-8 col-xl-8 col-md-8 text-center">
                  <B align="center"> 
                    <font size="5"> จำนวน ORDER ค้างส่ง (<?php echo $objr_province['province_name']; ?>) </font>
                  </B>
                  </font>
                </div>
                <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
              </div>
            </div> 
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="text-center" width="10%"></th>
                      <?php 
                        $sql_amphur = "SELECT * FROM tbl_amphures WHERE province_id = $province_id";
                        $objq_amphur = mysqli_query($mysqli,$sql_amphur);
                        while($value_am = $objq_amphur->fetch_assoc()){
                      ?> 
                      <th class="text-center" width="10%"><?php echo $value_am['amphur_name'];?></th>
                      <?php }?>
                      <th class="text-center">รวม</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php
                          $sql_product = "SELECT * FROM product WHERE status_stock = 1";
                          $objq_product = mysqli_query($mysqli,$sql_product);
                          while($value_pd = $objq_product->fetch_assoc())
                          {
                      ?>
                      <td class="text-center"><?php echo $value_pd['name_product'].'_'.$value_pd['unit'];?></td>
                      <?php
                        $total_pd = 0;
                        $id_product = $value_pd['id_product'];
                        $objq_amphur2 = mysqli_query($mysqli,$sql_amphur);
                        while($value_am = $objq_amphur2->fetch_assoc())
                        {
                          $amphur_id = $value_am['amphur_id'];
                          $sql_numpd = "SELECT SUM(num) FROM listorder 
                                        INNER JOIN addorder ON listorder.id_addorder = addorder.id_addorder
                                        INNER JOIN product ON listorder.id_product = product.id_product
                                        WHERE addorder.amphur_id = $amphur_id AND listorder.id_product = $id_product AND addorder.status = 'pending'";
                          $objq_numpd = mysqli_query($mysqli,$sql_numpd);
                          $objr_numpd = mysqli_fetch_array($objq_numpd);
                          $numpd = $objr_numpd['SUM(num)'];
                      ?>
                      <td class="text-center">
                        <?php 
                        if (!isset($numpd)) {
                          echo "-";
                        }else{
                          echo $numpd;
                        }
                        
                        ?>
                      </td>
                      <?php 
                        $total_pd = $total_pd + $numpd;
                        }
                      ?>
                      <td class="text-center"><?php echo "$total_pd";?></td>
                    </tr>
                      <?php 
                        }
                      ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        <?php
          }
        ?>
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