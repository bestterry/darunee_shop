<?php
  include("menu/db_connect.php");
  $mysqli = connect();
  
  $id_interview = $_GET['id_interview'];
  $interview = "SELECT * FROM interview 
                INNER JOIN tbl2_amphures ON tbl2_amphures.amphur_id = interview.amphures_id
                INNER JOIN tbl2_provinces ON tbl2_provinces.province_id = interview.provinces_id
                WHERE interview.id_interview = $id_interview";
  $objq_interview = mysqli_query($mysqli,$interview);
  $value = mysqli_fetch_array($objq_interview);
  $id = $value['id'];

  $sql_plance = "SELECT * FROM interview_plance 
                INNER JOIN plance ON interview_plance.id_plance = plance.id_plance
                WHERE interview_plance.id = $id";
  $objq_plance = mysqli_query($mysqli,$sql_plance);

  $sql_product = "SELECT * FROM interview_product 
                  INNER JOIN product ON interview_product.id_product = product.id_product
                  WHERE interview_product.id = $id";
  $objq_product = mysqli_query($mysqli,$sql_product);
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
                  <font size="5"><B> ข้อมูลสัมภาษณ์ </B></font>
                </div>
                <div class="col-2 col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
              </div>
            </div>
            <div class="box-body no-padding">
              <div class="mailbox-read-message">
                <div class="row">
                  <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <div class="text-center">
                      <B><font size="4">ข้อมูล</font></B>
                    </div>
                    <br>
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <tr>
                          <th class="text-center" width="50%">ชื่อไฟล์</th>
                          <td><?php echo $value['name_file'];?></td>
                        </tr>
                        <tr>
                          <th class="text-center">ชื่อ</th>
                          <td><?php echo $value['name'];?></td>
                        </tr>
                        <tr>
                          <th class="text-center">พื้นที่</th>
                          <td><?php echo 'อ.'.$value['amphur_name'].' จ.'.$value['province_name']; ?></td>
                        </tr>
                        <tr>
                          <th class="text-center">หมายเหตุ</th>
                          <td><?php echo $value['note'];?></td>
                        </tr>
                      </table>
                    </div>
                  </div>

                  <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <div class="text-center">
                      <B><font size="4">สินค้า</font></B>
                    </div>
                    <br>
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <tr>
                          <th class="text-center" width="50%">ที่</th>
                          <th class="text-center" width="50%">สินค้า</th>
                        </tr>
                        <?php 
                          $i = 1;
                          while($value_product = $objq_product->fetch_assoc()){
                        ?>
                          <tr>
                            <td class="text-center"><?php echo $i; ?></td>
                            <td class="text-center"><?php echo $value_product['name_product']; ?></td>
                          </tr>
                        <?php 
                            $i++;
                          }
                        ?>
                      </table>
                    </div>
                  </div>

                  <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <div class="text-center">
                      <B><font size="4">ใช้กับ</font></B>
                    </div>
                    <br>
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <tr>
                          <th class="text-center" width="50%">ที่</th>
                          <th class="text-center" width="50%">ใช้กับ</th>
                        </tr>
                        <?php 
                          $i = 1;
                          while($value_plance = $objq_plance->fetch_assoc()){
                        ?>
                          <tr>
                            <td class="text-center"><?php echo $i; ?></td>
                            <td class="text-center"><?php echo $value_plance['name_plance']; ?></td>
                          </tr>
                        <?php 
                            $i++;
                          }
                        ?>
                      </table>
                    </div>
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