<?php 
  require "../config_database/config.php";
  require "../session.php"; 
  require "menu/date.php";

  $list_product = "SELECT * FROM product WHERE status_stock = 1";
  $query_product = mysqli_query($conn,$list_product);
  $query_product2 = mysqli_query($conn,$list_product);
  $query_product3 = mysqli_query($conn,$list_product);
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <style>
    thead {
      color: rgb(255, 0, 0);
    }
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
        <div class="box box-primary">
          <div class="box-header text-center with-border">
            <B align="center"> 
              <font size="5"> สต๊อกร้าน </font>
              <font size="5" color="red">  
                <?php 
                    $strDate = date('d-m-Y');
                    echo DateThai($strDate);
                ?>
              </font>
            </B>
          </div>
          <div class="box-body no-padding">
            <div class="mailbox-read-message">

              <table class="table">
                <thead>
                  <tr>
                  <th class="text-center" width="10%">สินค้า_หน่วย</th>
                    <th class="text-center" width="5%">จุน</th>
                    <th class="text-center" width="5%">พาน1</th>
                    <th class="text-center" width="5%">พาน2</th>
                    <th class="text-center" width="5%">ดคต1</th>
                    <th class="text-center" width="5%">ดคต2</th>
                    <th class="text-center" width="5%">วปป.</th>
                    <th class="text-center" width="5%">เกาะคา</th>
                    <th class="text-center" width="5%">ลำพูน</th>
                    <th class="text-center" width="5%">ขายส่ง</th>
                    <th class="text-center" width="5%">แม่จัน</th>
                    <th class="text-center" width="5%">จห</th>
                    <th class="text-center" width="5%">แพร่</th>
                    <th class="text-center" width="5%">รถ</th>
                    <th class="text-center" width="5%">ทั้งหมด</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $i=1;
                      while($product = $query_product ->fetch_assoc()){
                        
                    ?>
                  <tr>
                    <td class="text-center" >
                      <?php echo $product['name_product'].'_'.$product['unit']; ?>
                    </td>
                    <!-- -------------------------------จุน------------------------------------ -->
                    <?php 
                        $SQL_num = "SELECT * FROM num_product WHERE id_product = $product[id_product] AND id_zone = 3";
                        $objq_num = mysqli_query($conn,$SQL_num);
                        $objr_num = mysqli_fetch_array($objq_num);
                        if((!isset($objr_num['num'])) || ($objr_num['num'] == 0) ){
                      ?>
                    <td class="text-center">-</td>
                    <?php
                        }else{
                      ?>
                    <td class="text-center" ><?php echo $objr_num['num']; ?></td>
                    <?php 
                        } 
                      
                      ?>
                    <!-- -------------------------------//จุน------------------------------------ -->
                    <!-- -------------------------------พาน------------------------------------ -->
                    <?php 
                        $SQL_num = "SELECT * FROM num_product WHERE id_product = $product[id_product] AND id_zone = 4";
                        $objq_num = mysqli_query($conn,$SQL_num);
                        $objr_num = mysqli_fetch_array($objq_num);
                        if((!isset($objr_num['num'])) || ($objr_num['num'] == 0) ){
                      ?>
                    <td class="text-center">-</td>
                    <?php
                        }else{
                      ?>
                    <td class="text-center" ><?php echo $objr_num['num']; ?></td>
                    <?php 
                        } 
                      
                      ?>
                    <!-- -------------------------------//พาน------------------------------------ -->
                    <!-- -------------------------------พาน2------------------------------------ -->
                    <?php 
                        $SQL_num = "SELECT * FROM num_product WHERE id_product = $product[id_product] AND id_zone = 13";
                        $objq_num = mysqli_query($conn,$SQL_num);
                        $objr_num = mysqli_fetch_array($objq_num);
                        if((!isset($objr_num['num'])) || ($objr_num['num'] == 0) ){
                      ?>
                    <td class="text-center">-</td>
                    <?php
                        }else{
                      ?>
                    <td class="text-center" ><?php echo $objr_num['num']; ?></td>
                    <?php 
                        } 
                      
                      ?>
                    <!-- -------------------------------//พาน2------------------------------------ -->
                    <!-- -------------------------------ดคต.------------------------------------ -->
                    <?php 
                        $SQL_num = "SELECT * FROM num_product WHERE id_product = $product[id_product] AND id_zone = 2";
                        $objq_num = mysqli_query($conn,$SQL_num);
                        $objr_num = mysqli_fetch_array($objq_num);
                        if((!isset($objr_num['num'])) || ($objr_num['num'] == 0) ){
                          ?>
                        <td class="text-center">-</td>
                    <?php
                        }else{
                      ?>
                    <td class="text-center" ><?php echo $objr_num['num']; ?></td>
                    <?php 
                        } 
                      
                      ?>
                    <!-- -------------------------------//ดคต2.------------------------------------ -->
                    <!-- -------------------------------ดคต.------------------------------------ -->
                    <?php 
                        $SQL_num = "SELECT * FROM num_product WHERE id_product = $product[id_product] AND id_zone = 12";
                        $objq_num = mysqli_query($conn,$SQL_num);
                        $objr_num = mysqli_fetch_array($objq_num);
                        if((!isset($objr_num['num'])) || ($objr_num['num'] == 0) ){
                          ?>
                        <td class="text-center">-</td>
                    <?php
                        }else{
                      ?>
                    <td class="text-center" ><?php echo $objr_num['num']; ?></td>
                    <?php 
                        } 
                      
                      ?>
                    <!-- -------------------------------//ดคต2.------------------------------------ -->
                      <!-- -------------------------------วปป..------------------------------------ -->
                      <?php 
                        $SQL_num = "SELECT * FROM num_product WHERE id_product = $product[id_product] AND id_zone = 1";
                        $objq_num = mysqli_query($conn,$SQL_num);
                        $objr_num = mysqli_fetch_array($objq_num);
                        if((!isset($objr_num['num'])) || ($objr_num['num'] == 0) ){
                          ?>
                        <td class="text-center">-</td>
                    <?php
                        }else{
                      ?>
                    <td class="text-center" ><?php echo $objr_num['num']; ?></td>
                    <?php 
                        } 
                      
                      ?>
                    <!-- -------------------------------//วปป.------------------------------------ -->
                      <!-- -------------------------------ลป.------------------------------------ -->
                      <?php 
                        $SQL_num = "SELECT * FROM num_product WHERE id_product = $product[id_product] AND id_zone = 6";
                        $objq_num = mysqli_query($conn,$SQL_num);
                        $objr_num = mysqli_fetch_array($objq_num);
                        if((!isset($objr_num['num'])) || ($objr_num['num'] == 0) ){
                          ?>
                        <td class="text-center">-</td>
                    <?php
                        }else{
                      ?>
                    <td class="text-center" ><?php echo $objr_num['num']; ?></td>
                    <?php 
                        } 
                      
                      ?>
                    <!-- -------------------------------//ลป.------------------------------------ -->
                      <!-- -------------------------------ลพ.------------------------------------ -->
                                          <?php 
                        $SQL_num = "SELECT * FROM num_product WHERE id_product = $product[id_product] AND id_zone = 10";
                        $objq_num = mysqli_query($conn,$SQL_num);
                        $objr_num = mysqli_fetch_array($objq_num);
                        if((!isset($objr_num['num'])) || ($objr_num['num'] == 0) ){
                          ?>
                        <td class="text-center">-</td>
                    <?php
                        }else{
                      ?>
                    <td class="text-center" ><?php echo $objr_num['num']; ?></td>
                    <?php 
                        } 
                      
                      ?>
                    <!-- -------------------------------//ลพ.------------------------------------ -->
                      <!-- -------------------------------ขายส่ง.------------------------------------ -->
                      <?php 
                        $SQL_num = "SELECT * FROM num_product WHERE id_product = $product[id_product] AND id_zone = 7";
                        $objq_num = mysqli_query($conn,$SQL_num);
                        $objr_num = mysqli_fetch_array($objq_num);
                        if((!isset($objr_num['num'])) || ($objr_num['num'] == 0) ){
                          ?>
                        <td class="text-center">-</td>
                    <?php
                        }else{
                      ?>
                    <td class="text-center" ><?php echo $objr_num['num']; ?></td>
                    <?php 
                        } 
                      
                      ?>
                    <!-- -------------------------------//ขายส่ง.------------------------------------ -->
                      <!-- -------------------------------แม่จัน.------------------------------------ -->
                      <?php 
                        $SQL_num = "SELECT * FROM num_product WHERE id_product = $product[id_product] AND id_zone = 5";
                        $objq_num = mysqli_query($conn,$SQL_num);
                        $objr_num = mysqli_fetch_array($objq_num);
                        if((!isset($objr_num['num'])) || ($objr_num['num'] == 0) ){
                          ?>
                        <td class="text-center">-</td>
                    <?php
                        }else{
                      ?>
                    <td class="text-center" ><?php echo $objr_num['num']; ?></td>
                    <?php 
                        } 
                      
                      ?>
                    <!-- -------------------------------//แม่จัน.------------------------------------ -->

                    <!-- -------------------------------จห.------------------------------------ -->
                      <?php 
                        $SQL_num = "SELECT * FROM num_product WHERE id_product = $product[id_product] AND id_zone = 11";
                        $objq_num = mysqli_query($conn,$SQL_num);
                        $objr_num = mysqli_fetch_array($objq_num);
                        if((!isset($objr_num['num'])) || ($objr_num['num'] == 0) ){
                      ?>
                    <td class="text-center">-</td>
                    <?php
                        }else{
                      ?>
                    <td class="text-center" ><?php echo $objr_num['num']; ?></td>
                    <?php 
                        } 
                      
                      ?>
                    <!-- -------------------------------//จห.------------------------------------ -->

                    <!-- -------------------------------แพร่.------------------------------------ -->
                    <?php 
                        $SQL_num = "SELECT * FROM num_product WHERE id_product = $product[id_product] AND id_zone = 14";
                        $objq_num = mysqli_query($conn,$SQL_num);
                        $objr_num = mysqli_fetch_array($objq_num);
                        if((!isset($objr_num['num'])) || ($objr_num['num'] == 0) ){
                      ?>
                    <td class="text-center">-</td>
                    <?php
                        }else{
                      ?>
                    <td class="text-center" ><?php echo $objr_num['num']; ?></td>
                    <?php 
                        } 
                      
                      ?>
                    <!-- -------------------------------//แพร่.------------------------------------ -->

                    <!-- -------------------------------รวมรถ------------------------------------ -->
                    <?php 
                        $SQL_num_car = "SELECT SUM(num) FROM numpd_car WHERE id_product = $product[id_product]";
                        $objq_num_car = mysqli_query($conn,$SQL_num_car);
                        $objr_num_car = mysqli_fetch_array($objq_num_car);
                        $total_numcar = $objr_num_car['SUM(num)'];
                        if((!isset($total_numcar)) || ($total_numcar == 0) ){
                          ?>
                        <td class="text-center">-</td>
                    <?php
                        }else{
                      ?>
                    <td class="text-center"><?php echo $total_numcar; ?></td>
                    <?php 
                        } 
                      ?>
                    <!-- -------------------------------//รวมรถ------------------------------------ -->

                    <!-- -------------------------------รวมทั้งหมด------------------------------------ -->
                    <?php 
                        $SQL_num = "SELECT SUM(num) FROM num_product WHERE id_product = $product[id_product]";
                        $objq_num = mysqli_query($conn,$SQL_num);
                        $objr_num = mysqli_fetch_array($objq_num);

                        $total_num = $objr_num['SUM(num)'];
                        $total_numstore = $total_numcar+$total_num;
                        
                        if($total_numstore == 0 ){
                          ?>
                        <td class="text-center">0</td>
                    <?php
                        }else{
                      ?>
                    <td class="text-center"><?php echo $total_numstore; ?></td>
                    <?php 
                        } 
                      ?>
                    <!-- -------------------------------//รวมทั้งหมด------------------------------------ -->

                  </tr>
                  <?php $i++; } ?>
                </tbody>
              </table>

            </div>
          </div>
          <div class="box-footer">
            <a href="store.php" class="btn btn-danger pull-left"> << เมนูหลัก </a>
            <a href="../pdf_file/admin_total_stock.php" class="btn btn-success pull-right"> PDF </a>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="box box-primary">
          <div class="box-header text-center with-border">
            <B align="center"> 
              <font size="5"> สต๊อกสินค้าชำรุด </font>
              <font size="5" color="red">  
                <?php 
                    $strDate = date('d-m-Y');
                    echo DateThai($strDate);
                ?>
              </font>
            </B>
          </div>
          <div class="box-body no-padding">
            <div class="mailbox-read-message">
              <table class="table">
                <thead>
                  <tr>
                    <th class="text-center" width="10%">สินค้า_หน่วย</th>
                    <th class="text-center" width="5%">จุน</th>
                    <th class="text-center" width="5%">พาน1</th>
                    <th class="text-center" width="5%">พาน2</th>
                    <th class="text-center" width="5%">ดคต1</th>
                    <th class="text-center" width="5%">ดคต2</th>
                    <th class="text-center" width="5%">วปป.</th>
                    <th class="text-center" width="5%">เกาะคา</th>
                    <th class="text-center" width="5%">ลำพูน</th>
                    <th class="text-center" width="5%">แม่จัน</th>
                    <th class="text-center" width="5%">จห</th>
                    <th class="text-center" width="5%">แพร่</th>
                    <th class="text-center" width="5%">หาย</th>
                    <th class="text-center" width="5%">ทั้งหมด</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $i=1;
                    while($product = $query_product3 ->fetch_assoc()){ 
                  ?>
                  <tr>
                    <td class="text-center" >
                      <?php echo $product['name_product'].'_'.$product['unit']; ?>
                    </td>
                    <!-- -------------------------------จุน------------------------------------ -->
                    <?php 
                        $SQL_num = "SELECT * FROM num_productwaste WHERE id_product = $product[id_product] AND id_zone = 3";
                        $objq_num = mysqli_query($conn,$SQL_num);
                        $objr_num = mysqli_fetch_array($objq_num);
                        if((!isset($objr_num['num'])) || ($objr_num['num'] == 0) ){
                      ?>
                    <td class="text-center">-</td>
                    <?php
                        }else{
                      ?>
                    <td class="text-center" ><?php echo $objr_num['num']; ?></td>
                    <?php 
                        } 
                      
                      ?>
                    <!-- -------------------------------//จุน------------------------------------ -->
                    <!-- -------------------------------พาน------------------------------------ -->
                    <?php 
                        $SQL_num = "SELECT * FROM num_productwaste WHERE id_product = $product[id_product] AND id_zone = 4";
                        $objq_num = mysqli_query($conn,$SQL_num);
                        $objr_num = mysqli_fetch_array($objq_num);
                        if((!isset($objr_num['num'])) || ($objr_num['num'] == 0) ){
                      ?>
                    <td class="text-center">-</td>
                    <?php
                        }else{
                      ?>
                    <td class="text-center" ><?php echo $objr_num['num']; ?></td>
                    <?php 
                        } 
                      
                      ?>
                    <!-- -------------------------------//พาน------------------------------------ -->
                    <!-- -------------------------------พาน2------------------------------------ -->
                    <?php 
                        $SQL_num = "SELECT * FROM num_productwaste WHERE id_product = $product[id_product] AND id_zone = 13";
                        $objq_num = mysqli_query($conn,$SQL_num);
                        $objr_num = mysqli_fetch_array($objq_num);
                        if((!isset($objr_num['num'])) || ($objr_num['num'] == 0) ){
                      ?>
                    <td class="text-center">-</td>
                    <?php
                        }else{
                      ?>
                    <td class="text-center" ><?php echo $objr_num['num']; ?></td>
                    <?php 
                        } 
                      
                      ?>
                    <!-- -------------------------------//พาน2------------------------------------ -->
                    <!-- -------------------------------ดคต.------------------------------------ -->
                    <?php 
                        $SQL_num = "SELECT * FROM num_productwaste WHERE id_product = $product[id_product] AND id_zone = 2";
                        $objq_num = mysqli_query($conn,$SQL_num);
                        $objr_num = mysqli_fetch_array($objq_num);
                        if((!isset($objr_num['num'])) || ($objr_num['num'] == 0) ){
                          ?>
                        <td class="text-center">-</td>
                    <?php
                        }else{
                      ?>
                    <td class="text-center" ><?php echo $objr_num['num']; ?></td>
                    <?php 
                        } 
                      
                      ?>
                    <!-- -------------------------------//ดคต2.------------------------------------ -->
                    <!-- -------------------------------ดคต.------------------------------------ -->
                    <?php 
                        $SQL_num = "SELECT * FROM num_productwaste WHERE id_product = $product[id_product] AND id_zone = 12";
                        $objq_num = mysqli_query($conn,$SQL_num);
                        $objr_num = mysqli_fetch_array($objq_num);
                        if((!isset($objr_num['num'])) || ($objr_num['num'] == 0) ){
                          ?>
                        <td class="text-center">-</td>
                    <?php
                        }else{
                      ?>
                    <td class="text-center" ><?php echo $objr_num['num']; ?></td>
                    <?php 
                        } 
                      
                      ?>
                    <!-- -------------------------------//ดคต2.------------------------------------ -->
                      <!-- -------------------------------วปป..------------------------------------ -->
                      <?php 
                        $SQL_num = "SELECT * FROM num_productwaste WHERE id_product = $product[id_product] AND id_zone = 1";
                        $objq_num = mysqli_query($conn,$SQL_num);
                        $objr_num = mysqli_fetch_array($objq_num);
                        if((!isset($objr_num['num'])) || ($objr_num['num'] == 0) ){
                          ?>
                        <td class="text-center">-</td>
                    <?php
                        }else{
                      ?>
                    <td class="text-center" ><?php echo $objr_num['num']; ?></td>
                    <?php 
                        } 
                      
                      ?>
                    <!-- -------------------------------//วปป.------------------------------------ -->
                      <!-- -------------------------------ลป.------------------------------------ -->
                      <?php 
                        $SQL_num = "SELECT * FROM num_productwaste WHERE id_product = $product[id_product] AND id_zone = 6";
                        $objq_num = mysqli_query($conn,$SQL_num);
                        $objr_num = mysqli_fetch_array($objq_num);
                        if((!isset($objr_num['num'])) || ($objr_num['num'] == 0) ){
                          ?>
                        <td class="text-center">-</td>
                    <?php
                        }else{
                      ?>
                    <td class="text-center" ><?php echo $objr_num['num']; ?></td>
                    <?php 
                        } 
                      
                      ?>
                    <!-- -------------------------------//ลป.------------------------------------ -->
                      <!-- -------------------------------ลพ.------------------------------------ -->
                                          <?php 
                        $SQL_num = "SELECT * FROM num_productwaste WHERE id_product = $product[id_product] AND id_zone = 10";
                        $objq_num = mysqli_query($conn,$SQL_num);
                        $objr_num = mysqli_fetch_array($objq_num);
                        if((!isset($objr_num['num'])) || ($objr_num['num'] == 0) ){
                          ?>
                        <td class="text-center">-</td>
                    <?php
                        }else{
                      ?>
                    <td class="text-center" ><?php echo $objr_num['num']; ?></td>
                    <?php 
                        } 
                      
                      ?>
                    <!-- -------------------------------//ลพ.------------------------------------ -->
                    
                    <!-- -------------------------------แม่จัน.------------------------------------ -->
                      <?php 
                        $SQL_num = "SELECT * FROM num_productwaste WHERE id_product = $product[id_product] AND id_zone = 5";
                        $objq_num = mysqli_query($conn,$SQL_num);
                        $objr_num = mysqli_fetch_array($objq_num);
                        if((!isset($objr_num['num'])) || ($objr_num['num'] == 0) ){
                          ?>
                        <td class="text-center">-</td>
                    <?php
                        }else{
                      ?>
                    <td class="text-center" ><?php echo $objr_num['num']; ?></td>
                    <?php 
                        } 
                      
                    ?>
                    <!-- -------------------------------//แม่จัน.------------------------------------ -->
                    <!-- -------------------------------จห.------------------------------------ -->
                      <?php 
                        $SQL_num = "SELECT * FROM num_productwaste WHERE id_product = $product[id_product] AND id_zone = 11";
                        $objq_num = mysqli_query($conn,$SQL_num);
                        $objr_num = mysqli_fetch_array($objq_num);
                        if((!isset($objr_num['num'])) || ($objr_num['num'] == 0) ){
                      ?>
                    <td class="text-center">-</td>
                    <?php
                        }else{
                      ?>
                    <td class="text-center" ><?php echo $objr_num['num']; ?></td>
                    <?php 
                        } 
                      
                      ?>
                    <!-- -------------------------------//จห.------------------------------------ -->

                    <!-- -------------------------------แพร่.------------------------------------ -->
                    <?php 
                        $SQL_num = "SELECT * FROM num_productwaste WHERE id_product = $product[id_product] AND id_zone = 14";
                        $objq_num = mysqli_query($conn,$SQL_num);
                        $objr_num = mysqli_fetch_array($objq_num);
                        if((!isset($objr_num['num'])) || ($objr_num['num'] == 0) ){
                      ?>
                    <td class="text-center">-</td>
                    <?php
                        }else{
                      ?>
                    <td class="text-center" ><?php echo $objr_num['num']; ?></td>
                    <?php 
                        } 
                      
                      ?>
                    <!-- -------------------------------//แพร่.------------------------------------ -->
                    <!-- -------------------------------ขายส่ง.------------------------------------ -->
                    <?php 
                        $SQL_num = "SELECT * FROM num_productwaste WHERE id_product = $product[id_product] AND id_zone = 9";
                        $objq_num = mysqli_query($conn,$SQL_num);
                        $objr_num = mysqli_fetch_array($objq_num);
                        if((!isset($objr_num['num'])) || ($objr_num['num'] == 0) ){
                          ?>
                        <td class="text-center">-</td>
                    <?php
                        }else{
                      ?>
                    <td class="text-center" ><?php echo $objr_num['num']; ?></td>
                    <?php 
                        } 
                      
                      ?>
                    <!-- -------------------------------//ขายส่ง.------------------------------------ -->

                    <!-- -------------------------------รวมทั้งหมด------------------------------------ -->
                    <?php 
                        $SQL_num = "SELECT SUM(num) FROM num_productwaste WHERE id_product = $product[id_product]";
                        $objq_num = mysqli_query($conn,$SQL_num);
                        $objr_num = mysqli_fetch_array($objq_num);

                        $total_num = $objr_num['SUM(num)'];
                        
                        if($total_num == 0 ){
                          ?>
                        <td class="text-center">0</td>
                    <?php
                        }else{
                      ?>
                    <td class="text-center"><?php echo $total_num; ?></td>
                    <?php 
                        } 
                      ?>
                    <!-- -------------------------------//รวมทั้งหมด------------------------------------ -->

                  </tr>
                  <?php 
                      $i++; 
                    } 
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="box-footer">
            <a href="store.php" class="btn btn-danger pull-left"> << เมนูหลัก </a>
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
  </script>
</body>

</html>