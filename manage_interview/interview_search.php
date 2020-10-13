<?php
  include("menu/db_connect.php");
  $mysqli = connect();

  require "menu/interview_search.php";

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
                <a class="active" href="interview.php"> ค้นหา </a>
                <a href="data_interview.php"> สัมภาษณ์ทั้งหมด </a>
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
                  <a class="btn button2 pull-left" href="interview.php"> << กลับ </a>
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
                  <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <table id="example2" class="table">
                      <thead>
                        <tr>
                          <th class="text-center" width="9%">ชื่อไฟล์</th>
                          <th class="text-center" width="10%">ชื่อ</th>
                          <th class="text-center" width="15%">พื้นที่</th>
                          <th class="text-center" width="15%">สินค้า</th>
                          <th class="text-center" width="15%">ใช้กับ</th>
                          <th class="text-center" width="5%">เกรด</th>
                          <th class="text-center" width="25%">หมายเหต</th>
                          <th class="text-center" width="5%">#</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          while($value = $objq_interview->fetch_assoc()){
                            $id = $value['id'];
                        ?>
                        <tr>
                          <td class="text-center"><?php echo $value['name_file'];?></td>
                          <td class="text-center"><?php echo $value['name'];?></td>
                          <td class="text-center"><?php echo 'อ.'.$value['amphur_name'].' จ.'.$value['province_name']; ?></td>
                          <td class="text-center">
                           <?php 
                            $sql_product = "SELECT * FROM interview_product 
                                            INNER JOIN product ON interview_product.id_product = product.id_product
                                            WHERE interview_product.id = $id";
                            $objq_product = mysqli_query($mysqli,$sql_product);
                            while($value_product = $objq_product -> fetch_assoc()){
                              echo $value_product['name_product'].'<br>';
                            }
                           ?>
                          </td>
                          <td class="text-center">
                           <?php 
                            $sql_plance = "SELECT * FROM interview_plance
                                            INNER JOIN plance ON interview_plance.id_plance = plance.id_plance
                                            WHERE interview_plance.id = $id";
                            $objq_plance = mysqli_query($mysqli,$sql_plance);
                            while($value_plance = $objq_plance -> fetch_assoc()){
                              echo $value_plance['name_plance'].'<br>';
                            }
                           ?>
                          </td>
                          <td class="text-center"><?php echo $value['grade'];?></td>
                          <td class="text-center"><?php echo $value['note'];?></td>
                          <td class="text-center">
                            <?php 
                              if ($value['status']=='N') {
                            ?>
                              <a href="algorithm/edit_status.php?status=search&id_interview=<?php echo $value['id_interview'];?>&province_name=<?php echo $_GET['province_name'];?>&amphur_name=<?php echo $_GET['amphur_name']; ?>&id_product=<?php echo $_GET['id_product']; ?>&id_plance=<?php $_GET['id_plance']; ?>" 
                              class="btn btn-success btn-xs">เปิด</a>
                            <?php
                              }else {
                              echo "เปิดเเล้ว";
                              }
                            ?>
                          </td>
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