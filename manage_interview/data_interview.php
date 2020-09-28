<?php
  include("menu/db_connect.php");
  $mysqli = connect();
  $interview = "SELECT * FROM interview 
                INNER JOIN tbl_amphures ON tbl_amphures.amphur_id = interview.amphures_id
                INNER JOIN tbl_provinces ON tbl_provinces.province_id = interview.provinces_id";
  $objq_interview = mysqli_query($mysqli,$interview);
?>
<!DOCTYPE html>
<html>

  <?php require 'menu/header.php'; ?>

  <body class=" hold-transition skin-blue layout-top-nav">
   
    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            
          </ul>
        </div>
      </nav>
    </header>
    <div class="content-wrapper">
      <section class="content">

        <div class="box box-primary">
          <div class="row">
            <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8">
              <div class="topnav">
                <a href="interview.php"> ค้นหา </a>
                <a class="active" href="data_interview.php"> สัมภาษณ์ทั้งหมด </a>
                <a href="add_interview.php"> เพิ่มสัมภาษณ์ </a>
              </div>
            </div>
            <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <a class="btn button2 pull-right" href="../admin/admin.php"> << เมนูหลัก </a>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <div class="col-12">
                <div class="col-2 col-xs-2 col-sm-2 col-md-2 col-lg-2">
                </div>
                <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8 text-center">
                  <font size="5"><B> สัมภาษณ์ทั้งหมด </B></font>
                </div>
                <div class="col-2 col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
              </div>
            </div>
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                <div class="row">
                  <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <table id="example2" class="table">
                      <thead>
                        <tr>
                          <th class="text-center" width="10%">ชื่อไฟล์</th>
                          <th class="text-center" width="20%">ชื่อ</th>
                          <th class="text-center" width="20%">พื้นที่</th>
                          <th class="text-center" width="40%">หมายเหต</th>
                          <th class="text-center" width="10%">ข้อมูล</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          while($value = $objq_interview->fetch_assoc()){
                        ?>
                        <tr>
                          <td class="text-center"><?php echo $value['name_file'];?></td>
                          <td class="text-center"><?php echo $value['name'];?></td>
                          <td class="text-center"><?php echo 'อ.'.$value['amphur_name'].' จ.'.$value['province_name']; ?></td>
                          <td class="text-center"><?php echo $value['note'];?></td>
                          <td class="text-center"></td>
                        </tr>
                        <?php }?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div align="center" class="box-footer"> </div>
          </div>
        </div>
      </section>
    </div>

    <?php require('menu/script.php'); ?>
        
  </body>
</html>