<?php 
  require "../config_database/config.php";
  require "../session.php"; 
  require "menu/date.php";

  $list_product = "SELECT * FROM product WHERE status_stock = 1 ";
  $query_product = mysqli_query($conn,$list_product);
  $query_product2 = mysqli_query($conn,$list_product);
  $query_product3 = mysqli_query($conn,$list_product);
  $query_product4 = mysqli_query($conn,$list_product);
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

    <!-- Google Font -->
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <style>
      thead {
        color: rgb(255, 0, 0);
      }
      .button2 {
        background-color: #b35900;
        color : white;
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
            <div class="col-12 col-xs-12 col-sm-12 col-xl-12 col-md-12">
              <div class="col-4 col-sm-4 col-xl-4 col-md-4"> 
                <a href="admin.php" class="btn btn-danger pull-left"> << เมนูหลัก </a>
              </div>
              <div class="col-4 col-sm-4 col-xl-4 col-md-4">
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
              <div class="col-4 col-sm-4 col-xl-4 col-md-4 text-right">
                <a href="#" data-toggle="modal" data-target="#add_product" class="btn btn-success"> รับสินค้า </a>
                <a href="#" data-toggle="modal" data-target="#withdraw_product" class="btn btn-success"> เบิกสินค้า </a>
              </div>
            </div>
          </div>
          <div class="box-body no-padding">
            <div class=" mailbox-read-message">

            <!-- สต๊อกสินค้า -->
              <div style="overflow-x:auto;">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="text-center" width="10%">สินค้า_หน่วย</th>
                      <th class="text-center" width="5%">จุน</th>
                      <th class="text-center" width="5%">พาน</th>
                      <th class="text-center" width="5%">ดคต1</th>
                      <th class="text-center" width="5%">ดคต2</th>
                      <th class="text-center" width="5%">วปป.</th>
                      <th class="text-center" width="5%">เกาะคา</th>
                      <th class="text-center" width="5%">ลำพูน</th>
                      <th class="text-center" width="5%">ขายส่ง</th>
                      <th class="text-center" width="5%">แม่จัน</th>
                      <th class="text-center" width="5%">จห</th>
                      <th class="text-center" width="5%">แพร่</th>
                      <th class="text-center" width="5%">ฝาง</th>
                      <th class="text-center" width="5%">รถ</th>
                      <th class="text-center" width="5%">ทั้งหมด</th>
                      <th class="text-center" width="5%">U</th>
                      <th class="text-center" width="5%">ราคา</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $i=1;
                      $sum_price = 0;
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
                      <!-- -------------------------------//พาน------------------------------------ -->

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
                      <!-- -------------------------------//ดคต.------------------------------------ -->

                      <!-- -------------------------------ดคต2.------------------------------------ -->
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

                      <!-- -------------------------------ชปก.------------------------------------ -->
                        <?php 
                            $SQL_num = "SELECT * FROM num_product WHERE id_product = $product[id_product] AND id_zone = 15";
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
                      <!-- -------------------------------//ชปก.------------------------------------ -->

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
                          $price_num = $product['price_num'];
                          $total_numstore = $total_numcar+$total_num;
                          $total_price = $price_num * ($total_num+$total_numcar);
                          $sum_price = $sum_price + $total_price;
                          
                          if($total_numstore == 0 ){
                        ?>
                          <td class="text-center">0</td>
                          <td class="text-center">0</td>
                          <td class="text-center">0</td>
                        <?php
                          }else{
                        ?>
                          <td class="text-center"><?php echo $total_numstore; ?></td>
                          <td class="text-center"><?php echo $price_num; ?></td>
                          <td class="text-center"><?php echo $total_price; ?></td>
                        <?php 
                          } 
                        ?>
                      <!-- -------------------------------//รวมทั้งหมด------------------------------------ -->

                    </tr>
                    <?php 
                      $i++; 
                      } 
                    ?>
                    <tr>
                      <td class="text-center"></td>
                      <td class="text-center"></td>
                      <td class="text-center"></td>
                      <td class="text-center"></td>
                      <td class="text-center"></td>
                      <td class="text-center"></td>
                      <td class="text-center"></td>
                      <td class="text-center"></td>
                      <td class="text-center"></td>
                      <td class="text-center"></td>
                      <td class="text-center"></td>
                      <td class="text-center"></td>
                      <td class="text-center"></td>
                      <td class="text-center"></td>
                      <td class="text-center"></td>
                      <th class="text-center">รวม</th>
                      <th class="text-center"><?php echo $sum_price; ?></th>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="box-footer">
                <a href="../pdf_file/admin_total_stock.php" class="btn btn-success pull-right"> PDF(สต๊อกร้าน) </a>
              </div>
              <br>
            <!-- //สต๊อกสินค้า -->

            <!-- สต๊อกรถ -->
              <div class="text-center">
                <B> 
                  <font size="5"> สต๊อกรถ </font>
                </B>
              </div>
              <div style="overflow-x:auto;">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="text-center" width="7%">สินค้า_หน่วย</th>
                        <?php 
                          $sql_member = "SELECT id_member,name_sub FROM member WHERE status_car = 1";
                          $objq_member = mysqli_query($conn,$sql_member);
                          while($value = $objq_member -> fetch_assoc()){
                        ?>
                        <th class="text-center" width="4%"><?php echo $value['name_sub'];?></th>
                        <?php 
                          }
                        ?>
                    <th class="text-center">รวม</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      while ($product = $query_product2->fetch_assoc()) {
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $product['name_product'].'_'.$product['unit']; ?></td>
                      <!-- -------------------------------รถ------------------------------------ -->
                      <?php
                      $sum = 0;
                        $objq_member2 = mysqli_query($conn,$sql_member);
                        while($value2 = $objq_member2 -> fetch_assoc()){
                          
                          $id_member = $value2['id_member'];
                          $SQL_num = "SELECT * FROM numpd_car WHERE id_product = $product[id_product] AND id_member = $id_member";
                          $objq_num = mysqli_query($conn, $SQL_num);
                          $objr_num = mysqli_fetch_array($objq_num);
                          if((!isset($objr_num['num'])) || ($objr_num['num'] == 0)){
                      ?>
                        <td class="text-center">-</td>
                      <?php
                        } else {
                          $num_pd = $objr_num['num'];
                          $sum =$sum + $num_pd;
                      ?>
                        <td class="text-center"><?php echo $num_pd; ?></td>
                      <?php
                          }
                        }
                      ?>
                      <td class="text-center"><?php echo $sum; ?></td>
                    </tr>
                    <?php 
                      } 
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="box-footer">
                <a href="../pdf_file/admin_car_stock.php" class="btn btn-success pull-right"> PDF(สต๊อกรถ) </a>
              </div>
              <br>
            <!-- //สต๊อกรถ -->

            <!-- สต๊อกสินค้าชำรุด -->
              <div class="text-center">
                <B> 
                  <font size="5"> สต๊อกสินค้าชำรุด </font>
                </B>
              </div>
              <div style="overflow-x:auto;">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="text-center" width="10%">สินค้า_หน่วย</th>
                      <th class="text-center" width="5%">จุน</th>
                      <th class="text-center" width="5%">พาน</th>
                      <th class="text-center" width="5%">ดคต1</th>
                      <th class="text-center" width="5%">ดคต2</th>
                      <th class="text-center" width="5%">วปป.</th>
                      <th class="text-center" width="5%">เกาะคา</th>
                      <th class="text-center" width="5%">ลำพูน</th>
                      <th class="text-center" width="5%">แม่จัน</th>
                      <th class="text-center" width="5%">จห</th>
                      <th class="text-center" width="5%">แพร่</th>
                      <th class="text-center" width="5%">ฝาง</th>
                      <th class="text-center" width="5%">หาย</th>
                      <th class="text-center" width="5%">ทั้งหมด</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $i=1;
                      while($product = $query_product4 ->fetch_assoc()){ 
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
                      <!-- -------------------------------//พาน------------------------------------ -->

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

                      <!-- -------------------------------ชปก.------------------------------------ -->
                        <?php 
                          $SQL_num = "SELECT * FROM num_productwaste WHERE id_product = $product[id_product] AND id_zone = 15";
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
                      <!-- -------------------------------//ชปก.------------------------------------ -->

                      <!-- -------------------------------หาย.------------------------------------ -->
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
                      <!-- -------------------------------//หาย.------------------------------------ -->

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
            <!-- //สต๊อกสินค้าชำรุด -->

            </div>
          </div>
        </div>
      </section>
      <?php require("../menu/footer.html"); ?>
    </div>

      <div class="modal fade" id="add_product" role="dialog">
        <div class="modal-dialog modal-lg">
          <form action="add_product.php?status=stock" method="post">
            <div class="modal-content">
              <div class="modal-header text-center">
                  <font size="5"><B> รับสินค้า </B></font>
              </div>
              <div class="modal-body col-md-12 table-responsive mailbox-messages">
                <div class="col-12">
                  <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
                  <div class="col-8 col-sm-8 col-xl-8 col-md-8">
                    <div class="table-responsive mailbox-messages">
                      <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <th class="text-center" width="30%"><font size="3">รับเข้า STOCK</font></th>
                            <th class="text-center" width="70%"> 
                            <select name ="id_zone" class="form-control text-center select2" style="width: 100%;">
                              <?php #endregion
                              $sql_member = "SELECT * FROM zone ";
                              $objq_member = mysqli_query($conn,$sql_member);
                              while($member = $objq_member -> fetch_assoc()){
                                  if ($member['id_zone']==8) {
                                      
                                  }else{
                              ?>
                                  <option value="<?php echo $member['id_zone']; ?>"><?php echo $member['name_zone']; ?></option>
                              <?php 
                                  }
                              } 
                              ?>
                            </select>
                            </th>
                          </tr>
                        </tbody>
                      </table> 
                      <br> 
                      <table class="table table-bordered ">
                        <tbody>
                        <tr>
                          <th class="text-center" width="30%"><font size="3">ผู้ส่งของ</font></th>
                          <th class="text-center" width="70%"> 
                            <select name ="id_member" class="form-control text-center select2" style="width: 100%;">
                                <?php #endregion
                                $sql_member = "SELECT * FROM member WHERE status = 'employee' AND NOT id_member = 3";
                                $objq_member = mysqli_query($conn,$sql_member);
                                while($member = $objq_member -> fetch_assoc()){
                                ?>
                                    <option value="<?php echo $member['id_member']; ?>"><?php echo $member['name']; ?></option>
                                <?php } ?>
                            </select>
                          </th>
                        </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn button2 pull-right">ถัดไป >></button>
                <button type="button" class="btn button2 pull-left" data-dismiss="modal"><< ย้อนกลับ </button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="modal fade" id="withdraw_product" role="dialog">
        <div class="modal-dialog modal-lg">
          <form action="withdraw_product.php?status=stock" method="post">
            <div class="modal-content">
              <div class="modal-header text-center">
                  <font size="5"><B align = "center"> เบิกสินค้า </B></font>
              </div>
              <div class="modal-body col-md-12 table-responsive mailbox-messages">
                <div class="col-12">
                  <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
                  <div class="col-8 col-sm-8 col-xl-8 col-md-8">
                      <div class="table-responsive mailbox-messages">
                        <table class="table table-bordered">
                          <tbody>
                            <tr>
                            <th class="text-center" width="30%"><font size="3">เบิกจาก STOCK</font></th>
                            <th class="text-center" width="70%"> 
                              <select name ="id_zone" class="form-control text-center select2" style="width: 100%;">
                                  <?php #endregion
                                  $sql_member = "SELECT * FROM zone ";
                                  $objq_member = mysqli_query($conn,$sql_member);
                                  while($member = $objq_member -> fetch_assoc()){
                                      if ($member['id_zone']==8) {
                                          
                                      }else{
                                  ?>
                                      <option value="<?php echo $member['id_zone']; ?>"><?php echo $member['name_zone']; ?></option>
                                  <?php
                                      }   
                                  } 
                                  ?>
                              </select>
                            </th>
                            </tr>
                          </tbody>
                        </table> 
                        <br> 
                        <table class="table table-bordered">
                          <tbody>
                            <tr>
                            <th class="text-center" width="30%"><font size="3">ผู้ขอเบิก</font></th>
                            <th class="text-center" width="70%"> 
                            <select name ="id_member" class="form-control text-center select2" style="width: 100%;">
                                <?php #endregion
                                $sql_member = "SELECT * FROM member WHERE status = 'employee'";
                                $objq_member = mysqli_query($conn,$sql_member);
                                while($member = $objq_member -> fetch_assoc()){
                                    
                                ?>
                                    <option value="<?php echo $member['id_member']; ?>"><?php echo $member['name']; ?></option>
                                <?php
                                  } 
                                ?>
                            </select>
                            </th>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                  </div>
                  <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit"  class="btn button2 pull-right">ถัดไป >></button>
                <button type="button" class="btn button2 pull-left" data-dismiss="modal"><< ย้อนกลับ</button>
              </div>
            </div>
          </form>
        </div>
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