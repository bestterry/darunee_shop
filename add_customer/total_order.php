<?php
  include("db_connect.php");
  $mysqli = connect();
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
  <?php require('../font/font_style.php'); ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>รวม ORDER ค้างส่ง</title>
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
    <div class="content-wrapper" style="height: 4800px;">
      <!-- Main content -->
      <section class="content">
      <div class="col-md-12">
        <form action="pending_product.php" method="post">
          <div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-header with-border">
              <a type="button" href="order.php" class="btn btn-danger"><= เมนูหลัก</a>
              <a type="button" href="../pdf_file/total_order.php" class="btn btn-success"> PDF </a>
            </div>
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
              <div class="text-center">
                <B>
                  <font size="4">
                    ORDER ค้างส่ง
                  </font>
                </B>
              </div>
              <table id="customers">
                <tbody>
                  <tr>
                    <th class="text-center" width="15%">สินค้า_หน่วย</th>
                    <th class="text-center" width="15%">พะเยา</th>
                    <th class="text-center" width="15%">เวียงป่าเป้า</th>
                    <th class="text-center" width="15%">ลำปาง</th>
                    <th class="text-center" width="15%">ฮอด</th>
                    <th class="text-center" width="15%">แม่จัน</th>
                    <th class="text-center" width="15%">รวม</th>
                  </tr>
                 <?php 
                    $sql_pd = "SELECT * FROM product";
                    $objq_pd = mysqli_query($mysqli,$sql_pd);
                    while ($value_pd = $objq_pd->fetch_assoc()) {
                     $id_product = $value_pd['id_product'];
                  ?>
                  <tr>
                    <td class="text-center"><?php echo $value_pd['name_product'].'_'.$value_pd['unit']; ?></td>
                    <?php 
                      $total_num = 0;
                      for ($i=1; $i < 6; $i++) { 
                        
                      
                        $sql_num = "SELECT SUM(num) FROM addorder 
                                    INNER JOIN listorder ON listorder.id_addorder = addorder.id_addorder 
                                    INNER JOIN tbl_amphures ON addorder.amphur_id = tbl_amphures.amphur_id
                                    WHERE listorder.id_product = $id_product AND addorder.status = 'pending' AND tbl_amphures.id_area = $i";
                        $objq_num = mysqli_query($mysqli,$sql_num);
                        $objr_num = mysqli_fetch_array($objq_num);
                        $num = $objr_num['SUM(num)'];
                    ?>
                    <td class="text-center">
                      <?php 
                        if (!isset($num)) {
                          echo "-";
                        }else{
                          echo $num;
                        } 
                      ?>
                    </td>
                      <?php 
                      $total_num = $total_num + $num;
                      } 
                      ?>
                    <td class="text-center" ><?php echo $total_num; ?></td>
                  </tr>
                  <?php 
                    }
                  ?>
                 
                </tbody>
              </table>
              
              <!-- ค้างส่งพะเยา -->
              <br>
              <br>
              <div class="text-center">
                <B>
                  <font size="4">
                    <?php echo 'ค้างส่ง : ';?> เขต พะเยา
                  </font>
                </B>
              </div>
              <table id="customers">
                <tbody>
                    <tr>
                      <th class="text-center" width="15%"></th>
                    <?php 
                      $sql_amphur = "SELECT * FROM tbl_amphures WHERE id_area = 1";
                      $objq_amphur = mysqli_query($mysqli,$sql_amphur);
                      while($value_am = $objq_amphur->fetch_assoc()){
                    ?> 
                        
                          <th class="text-center" width="6%"><?php echo $value_am['amphur_name'];?></th>
                        
                        <?php }?>
                      
                      <th class="text-center">รวม</th>
                    </tr>
                    <tr>
                    
                    <?php
                      
                        $sql_product = "SELECT * FROM product";
                        $objq_product = mysqli_query($mysqli,$sql_product);
                        while($value_pd = $objq_product->fetch_assoc())
                        {
                          ?>
                          <td class="text-center"><?php echo $value_pd['name_product'].'_'.$value_pd['unit'];?></td>
                          <?php
                          $total_pd = 0;
                          $id_product = $value_pd['id_product'];
                          $sql_amphur = "SELECT * FROM tbl_amphures WHERE id_area = 1";
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
              <!-- //ค้างส่งพะเยา -->


             <!-- ค้างส่งเวียงป่าเป้า -->
              <br>
              <br>
              <div class="text-center">
                <B>
                  <font size="4">
                    <?php echo 'ค้างส่ง : ';?> เขต เวียงป่าเป้า
                  </font>
                </B>
              </div>
              <table id="customers">
                <tbody>
                    <tr>
                      <th class="text-center" width="14%"></th>
                    <?php 
                      $sql_amphur = "SELECT * FROM tbl_amphures WHERE id_area = 2";
                      $objq_amphur = mysqli_query($mysqli,$sql_amphur);
                      while($value_am = $objq_amphur->fetch_assoc()){
                    ?> 
                        
                          <th class="text-center" width="14%"><?php echo $value_am['amphur_name'];?></th>
                        
                        <?php }?>
                      
                      <th class="text-center">รวม</th>
                    </tr>
                    <tr>
                    
                    <?php
                      
                        $sql_product = "SELECT * FROM product";
                        $objq_product = mysqli_query($mysqli,$sql_product);
                        while($value_pd = $objq_product->fetch_assoc())
                        {
                          ?>
                          <td class="text-center"><?php echo $value_pd['name_product'].'_'.$value_pd['unit'];?></td>
                          <?php
                          $total_pd = 0;
                          $id_product = $value_pd['id_product'];
                          $sql_amphur = "SELECT * FROM tbl_amphures WHERE id_area = 2";
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
              <!-- //ค้างส่งเวียงป่าเป้า -->

              <!-- ค้างส่งลำปาง -->
              <br>
              <br>
              <div class="text-center">
                <B>
                  <font size="4">
                    <?php echo 'ค้างส่ง : ';?> เขต ลำปาง
                  </font>
                </B>
              </div>
              <table id="customers">
                <tbody>
                    <tr>
                      <th class="text-center" width="14%"></th>
                    <?php 
                      $sql_amphur = "SELECT * FROM tbl_amphures WHERE id_area = 3";
                      $objq_amphur = mysqli_query($mysqli,$sql_amphur);
                      while($value_am = $objq_amphur->fetch_assoc()){
                    ?> 
                        
                          <th class="text-center" width="7%"><?php echo $value_am['amphur_name'];?></th>
                        
                        <?php }?>
                      
                      <th class="text-center">รวม</th>
                    </tr>
                    <tr>
                    <?php
                        $sql_product = "SELECT * FROM product";
                        $objq_product = mysqli_query($mysqli,$sql_product);
                        while($value_pd = $objq_product->fetch_assoc())
                        {
                          ?>
                          <td class="text-center"><?php echo $value_pd['name_product'].'_'.$value_pd['unit'];?></td>
                          <?php
                          $total_pd = 0;
                          $id_product = $value_pd['id_product'];
                          $sql_amphur = "SELECT * FROM tbl_amphures WHERE id_area = 3";
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
              <!-- //ค้างส่งลำปาง -->

              <!-- ค้างส่งฮอด -->
              <br>
              <br>
              <div class="text-center">
                <B>
                  <font size="4">
                    <?php echo 'ค้างส่ง : ';?> เขต ฮอด
                  </font>
                </B>
              </div>
              <table id="customers">
                <tbody>
                    <tr>
                      <th class="text-center" width="20%"></th>
                    <?php 
                      $sql_amphur = "SELECT * FROM tbl_amphures WHERE id_area = 4";
                      $objq_amphur = mysqli_query($mysqli,$sql_amphur);
                      while($value_am = $objq_amphur->fetch_assoc()){
                    ?> 
                        
                          <th class="text-center" width="20%"><?php echo $value_am['amphur_name'];?></th>
                        
                        <?php }?>
                      
                      <th class="text-center">รวม</th>
                    </tr>
                    <tr>
                    <?php
                        $sql_product = "SELECT * FROM product";
                        $objq_product = mysqli_query($mysqli,$sql_product);
                        while($value_pd = $objq_product->fetch_assoc())
                        {
                          ?>
                          <td class="text-center"><?php echo $value_pd['name_product'].'_'.$value_pd['unit'];?></td>
                          <?php
                          $total_pd = 0;
                          $id_product = $value_pd['id_product'];
                          $sql_amphur = "SELECT * FROM tbl_amphures WHERE id_area = 4";
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
              <!-- //ค้างส่งฮอด -->

              <!-- ค้างส่งแม่จัน -->
              <br>
              <br>
              <div class="text-center">
                <B>
                  <font size="4">
                    <?php echo 'ค้างส่ง : ';?> เขต แม่จัน
                  </font>
                </B>
              </div>
              <table id="customers">
                <tbody>
                    <tr>
                      <th class="text-center" width="11%"></th>
                    <?php 
                      $sql_amphur = "SELECT * FROM tbl_amphures WHERE id_area = 5";
                      $objq_amphur = mysqli_query($mysqli,$sql_amphur);
                      while($value_am = $objq_amphur->fetch_assoc()){
                    ?> 
                        
                          <th class="text-center" width="11%"><?php echo $value_am['amphur_name'];?></th>
                        
                        <?php }?>
                      
                      <th class="text-center">รวม</th>
                    </tr>
                    <tr>
                    <?php
                        $sql_product = "SELECT * FROM product";
                        $objq_product = mysqli_query($mysqli,$sql_product);
                        while($value_pd = $objq_product->fetch_assoc())
                        {
                          ?>
                          <td class="text-center"><?php echo $value_pd['name_product'].'_'.$value_pd['unit'];?></td>
                          <?php
                          $total_pd = 0;
                          $id_product = $value_pd['id_product'];
                          $sql_amphur = "SELECT * FROM tbl_amphures WHERE id_area = 5";
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
              <!-- //ค้างส่งแม่จัน -->
              
              
              </div>
            </div>
            <div class="box-footer">
              
            </div>
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