
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
  <style type="text/css">
    /* important styles */
    .fixed-th-table-wrapper td,
    .fixed-th-table-wrapper th,
    .scrolled-td-table-wrapper td,
    .scrolled-td-table-wrapper th {
      /* Set background to non-transparent color
          because two tables are one above another.
        */
      background: white;
    }
    .fixed-th-table-wrapper {
      /* Make table out of flow */
      position: absolute;
    }
    .fixed-th-table-wrapper th {
        /* Place fixed-th-table th-cells above 
          scrolled-td-table td-cells.
        */
        position: relative;
        z-index: 1;
    }
    .scrolled-td-table-wrapper td {
        /* Place scrolled-td-table td-cells
          above fixed-th-table.
        */
        position: relative;
    }
    .scrolled-td-table-wrapper {
      /* Make horizonal scrollbar if needed */
    }

    /* Simulating border-collapse: collapse,
      because fixed-th-table borders
      are below ".scrolling-td-wrapper table" borders
    */

    table {
        border-spacing: 0;
    }
    td {
      border-style: solid;
      border-color: black;
      border-width: 1px 1px;
      text-align: center;
    }
    th {
      border-style: solid;
      border-color: black;
      border-width: 1px 1px;
      text-align: center;
      background-color: #99CCFF;
    }
    th:first-child {
      border-left-width: 1px;
      
    }
    tr:nth-child(even){background-color: #f2f2f2;}
    tr:last-child td,
    tr:last-child th {
      border-bottom-width: 1px;
    }

    /* Unimportant styles */

    div.ex1 {
      position: fixed;
      top: 60px;
      bottom: 60px;
      left: 60px;
      right: 60px;
      width: auto;
      height: auto;
      overflow: auto;
    }
      td, th {
        padding: 5px;
      }
  </style>
</head>
  <body>
      <div class="ex1">
      <div class="box-header with-border">
        <a type="button" href="store.php" class="btn btn-danger"><= เมนูหลัก</a>
        <a type="button" href="../pdf_file/total_order.php" class="btn btn-success"> PDF </a>
      </div>
        <div>
          <B>
            <font size="4">
              จำนวนค้างส่ง
            </font>
          </B>
        </div>
        <table >
          <tbody>
            <tr>
              <th class="text-center" width="14%">สินค้า_หน่วย</th>
              <th class="text-center" width="14%">พะเยา</th>
              <th class="text-center" width="14%">เชียงราย</th>
              <th class="text-center" width="14%">ลำปาง</th>
              <th class="text-center" width="14%">ลำพูน</th>
              <th class="text-center" width="14%">เชียงใหม่</th>
              <th class="text-center" width="14%">รวม</th>
            </tr>
          <?php 
              $sql_pd = "SELECT * FROM product WHERE NOT id_product = 12 AND NOT id_product = 35";
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
        <div>
          <B>
            <font size="4">
              <?php echo 'ค้างส่ง : ';?> เขต พะเยา
            </font>
          </B>
        </div>
        <table >
          <tbody>
              <tr>
                <th class="text-center" width="10%"></th>
              <?php 
                $sql_amphur = "SELECT * FROM tbl_amphures WHERE id_area = 1";
                $objq_amphur = mysqli_query($mysqli,$sql_amphur);
                while($value_am = $objq_amphur->fetch_assoc()){
              ?> 
                  
                    <th class="text-center" width="9%"><?php echo $value_am['amphur_name'];?></th>
                  
                  <?php }?>
                
                <th class="text-center">รวม</th>
              </tr>
              <tr>
              
              <?php
                
                  $sql_product = "SELECT * FROM product WHERE NOT id_product = 12  AND NOT id_product = 35";
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

        <!-- ค้างส่งเขตเชียงราย -->
        <br>
        <br>
        <div>
          <B>
            <font size="4">
              <?php echo 'ค้างส่ง : ';?> เขต เชียงราย
            </font>
          </B>
        </div>
        <table id="customers">
          <tbody>
              <tr>
                <th class="text-center" width="10%"></th>
              <?php 
                $sql_amphur = "SELECT * FROM tbl_amphures WHERE id_area = 2";
                $objq_amphur = mysqli_query($mysqli,$sql_amphur);
                while($value_am = $objq_amphur->fetch_assoc()){
              ?> 
                  
                    <th class="text-center" width="10%"><?php echo $value_am['amphur_name'];?></th>
                  
                  <?php }?>
                
                <th class="text-center">รวม</th>
              </tr>
              <tr>
              
              <?php
                
                  $sql_product = "SELECT * FROM product WHERE NOT id_product = 12  AND NOT id_product = 35";
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
        <!-- //ค้างส่งเขตเชียงราย -->

        <!-- ค้างส่งลำปาง -->
        <br>
        <br>
        <div>
          <B>
            <font size="4">
              <?php echo 'ค้างส่ง : ';?> เขต ลำปาง
            </font>
          </B>
        </div>
        <table id="customers">
          <tbody>
              <tr>
                <th class="text-center" width="10%"></th>
              <?php 
                $sql_amphur = "SELECT * FROM tbl_amphures WHERE id_area = 3";
                $objq_amphur = mysqli_query($mysqli,$sql_amphur);
                while($value_am = $objq_amphur->fetch_assoc()){
              ?> 
                  
                    <th class="text-center" width="6.5%"><?php echo $value_am['amphur_name'];?></th>
                  
                  <?php }?>
                
                <th class="text-center">รวม</th>
              </tr>
              <tr>
              <?php
                  $sql_product = "SELECT * FROM product WHERE NOT id_product = 12  AND NOT id_product = 35";
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

        <!-- ค้างส่งลำพูน -->
        <br>
        <br>
        <div>
          <B>
            <font size="4">
              <?php echo 'ค้างส่ง : ';?> เขต ลำพูน
            </font>
          </B>
        </div>
        <table id="customers">
          <tbody>
              <tr>
                <th class="text-center" width="10%"></th>
              <?php 
                $sql_amphur = "SELECT * FROM tbl_amphures WHERE id_area = 4";
                $objq_amphur = mysqli_query($mysqli,$sql_amphur);
                while($value_am = $objq_amphur->fetch_assoc()){
              ?> 
                  
                    <th class="text-center" width="10%"><?php echo $value_am['amphur_name'];?></th>
                  
                  <?php }?>
                
                <th class="text-center">รวม</th>
              </tr>
              <tr>
              <?php
                  $sql_product = "SELECT * FROM product WHERE NOT id_product = 12  AND NOT id_product = 35";
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
        <!-- //ค้างส่งลำพูน -->

        <!-- ค้างส่งเชียงใหม่ -->
        <br>
        <br>
        <div>
          <B>
            <font size="4">
              <?php echo 'ค้างส่ง : ';?> เขต เชียงใหม่
            </font>
          </B>
        </div>
        <table id="customers" >
          <tbody>
              <tr>
                <th class="text-center" width="5%"></th>
              <?php 
                $sql_amphur = "SELECT * FROM tbl_amphures WHERE id_area = 5";
                $objq_amphur = mysqli_query($mysqli,$sql_amphur);
                while($value_am = $objq_amphur->fetch_assoc()){
              ?> 
                  
                    <th class="text-center" width="3.8%"><?php echo $value_am['amphur_name'];?></th>
                  
                  <?php }?>
                
                <th class="text-center">รวม</th>
              </tr>
              <tr>
              <?php
                  $sql_product = "SELECT * FROM product WHERE NOT id_product = 12  AND NOT id_product = 35";
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
        <!-- //ค้างส่งเชียงใหม่ -->
      </div>
  </body>
</html>