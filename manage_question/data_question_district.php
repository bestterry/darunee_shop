<?php 
  require "menu/date.php";
  require "db_connect.php";
  $conn = connect();
  $district_id = $_GET['district_id'];
  
  $sql_address = "SELECT district_name,amphur_name,province_name FROM tbl_districts 
                  INNER JOIN tbl_amphures ON tbl_districts.amphur_id = tbl_amphures.amphur_id
                  INNER JOIN tbl_provinces ON tbl_districts.province_id = tbl_provinces.province_id
                  WHERE tbl_districts.district_id = $district_id";
  $objq_address = mysqli_query($conn,$sql_address);
  $objr_address = mysqli_fetch_array($objq_address);

    $know_num = "SELECT * FROM question WHERE district_id = $district_id ";
    $objq_num = mysqli_query($conn,$know_num);
    $num_rows_num = mysqli_num_rows($objq_num);

  // know_team
    $know_teamY = "SELECT * FROM question WHERE know_team = 'Y' AND district_id = $district_id";
    $objq_teamY = mysqli_query($conn,$know_teamY);
    $num_rows_teamY = mysqli_num_rows($objq_teamY);
    $know_team_per = ($num_rows_teamY/$num_rows_num)*100;
    $know_team_per = ceil($know_team_per);

    $know_teamN = "SELECT * FROM question WHERE know_team = 'N' AND district_id = $district_id";
    $objq_teamN = mysqli_query($conn,$know_teamN);
    $num_rows_teamN = mysqli_num_rows($objq_teamN);
    $know_team_perN = ($num_rows_teamN/$num_rows_num)*100;
    $know_team_perN = floor($know_team_perN);

    $know_teamD = "SELECT * FROM question WHERE know_team = 'D' AND district_id = $district_id";
    $objq_teamD = mysqli_query($conn,$know_teamD);
    $num_rows_teamD = mysqli_num_rows($objq_teamD);
  // know team

  // know_radio
    $know_radio = "SELECT * FROM question WHERE radio_team = 'Y' AND district_id = $district_id";
    $objq_radio = mysqli_query($conn,$know_radio);
    $num_radio = mysqli_num_rows($objq_radio);
    $radio_per = ($num_radio/$num_rows_num)*100;
    $radio_per = ceil($radio_per);

    $know_radioN = "SELECT * FROM question WHERE radio_team = 'N' AND district_id = $district_id";
    $objq_radioN = mysqli_query($conn,$know_radioN);
    $num_rows_radioN = mysqli_num_rows($objq_radioN);
    $radio_perN = ($num_rows_radioN/$num_rows_num)*100;
    $radio_perN = floor($radio_perN);

    $know_radioD = "SELECT * FROM question WHERE radio_team = 'D' AND district_id = $district_id";
    $objq_radioD = mysqli_query($conn,$know_radioD);
    $num_rows_radioD = mysqli_num_rows($objq_radioD);
  // know radio

  // use_product
    $know_productY = "SELECT * FROM question WHERE use_product = 'Y' AND district_id = $district_id";
    $objq_productY = mysqli_query($conn,$know_productY);
    $num_useproduct = mysqli_num_rows($objq_productY);
    $useproduct_per = ($num_useproduct/$num_rows_num)*100;
    $useproduct_per = ceil($useproduct_per);

    $know_productN = "SELECT * FROM question WHERE use_product = 'N' AND district_id = $district_id";
    $objq_productN = mysqli_query($conn,$know_productN);
    $num_rows_productN = mysqli_num_rows($objq_productN);
    $useproduct_perN = ($num_rows_productN/$num_rows_num)*100;
    $useproduct_perN = floor($useproduct_perN);
    

    $know_productD = "SELECT * FROM question WHERE use_product = 'D' AND district_id = $district_id";
    $objq_productD = mysqli_query($conn,$know_productD);
    $num_rows_productD = mysqli_num_rows($objq_productD);
  // use_product

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
                <a href="question.php"> แบบสอบถาม </a>
                <a class="active" href="data_question.php"></i> สรุปข้อมูล </a>
              </div>
            </div>
            <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-sm-12 col-md-12 col-xl-12">
            <form action="data_question2.php" method="POST" class="form-horizontal">
              <div class="box box-primary">

                <div class="box-header with-border text-center"> 
                  <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                    <div class="col-2 col-sm-2 col-md-2 col-xl-2">
                      <a href="data_question.php" class="btn btn-danger pull-left"><< กลับ</a>
                    </div>
                    <div class="col-8 col-sm-8 col-md-8 col-xl-8 text-center">
                      <B> 
                          <font size="5">จำแนกผู้ตอบแบบสอบถาม</font> 
                          <br><br>
                          <font color="red" size="5">ต.<?php echo $objr_address['district_name'];?>
                           อ.<?php echo $objr_address['amphur_name']; ?> จ.<?php echo $objr_address['province_name']; ?></font>
                      </B>
                      <br>
                      <br>
                    </div>
                    <div class="col-2 col-sm-2 col-md-2 col-xl-2"></div>
                  </div>
                  <div class="col-12 text-center">
                    <B><font size="4" color="red">ผู้ตอบแบบสอบถาม <?php echo $num_rows_num;?> ราย</font></B>
                  </div>
                </div>
                
                <div class="box-body no-padding">
                  <div class="mailbox-read-message">
                    <div class="col-12">

                    
                      <div class="col-3 col-sm-3 col-md-3 col-xl-3">
                        <table class="table">
                          <thead>
                            <tr>
                              <th width="50%" class="text-left">เพศ</th>
                              <th width="50%" class="text-left"></th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php 
                            $sql_sex = "SELECT * FROM sex";
                            $objq_sex = mysqli_query($conn,$sql_sex);
                            foreach($objq_sex as $value_sex):
                              $id_sex = $value_sex['id_sex'];
                              $sql_sumsex = "SELECT * FROM question WHERE id_sex = $id_sex 
                                            AND district_id = $district_id";
                              $objq_sumsex = mysqli_query($conn,$sql_sumsex);
                              $num_rows_sex = mysqli_num_rows($objq_sumsex);
                          ?>
                            <tr>
                              <td class="text-right"><?php echo $value_sex['sex_name']; ?></td>
                              <td class="text-left"><?php echo $num_rows_sex; ?></td>
                            </tr>
                          <?php 
                            endforeach;
                          ?>
                          </tbody>
                        </table>
                      </div>

                      <div class="col-3 col-sm-3 col-md-3 col-xl-3">
                        <table class="table">
                          <thead>
                            <tr>
                              <th class="text-left" width="50%">อาชีพ</th>
                              <th class="text-left" width="50%"></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                              $sql_career = "SELECT * FROM question_career";
                              $objq_career = mysqli_query($conn,$sql_career);
                              foreach($objq_career as $value_career):
                                $id_career = $value_career['id_career'];
                                $sql_sumcareer = "SELECT * FROM question WHERE id_career = $id_career 
                                              AND district_id = $district_id";
                                $objq_sumcareer = mysqli_query($conn,$sql_sumcareer);
                                $num_rows_career = mysqli_num_rows($objq_sumcareer);
                            ?>
                              <tr>
                                <td class="text-right"><?php echo $value_career['name_career']; ?></td>
                                <td class="text-left"><?php echo $num_rows_career; ?></td>
                              </tr>
                            <?php 
                              endforeach;
                            ?>
                          </tbody>
                        </table>
                      </div>

                      <div class="col-3 col-sm-3 col-md-3 col-xl-3">
                        <table class="table">
                          <thead>
                            <tr>
                              <th width="50%" class="text-left">อายุ</th>
                              <th width="50%" class="text-left"></th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php 
                            $sql_age = "SELECT * FROM question_age";
                            $objq_age = mysqli_query($conn,$sql_age);
                            foreach($objq_age as $value_age):
                              $id_age = $value_age['id_age'];
                              $sql_sumage = "SELECT * FROM question WHERE id_age = $id_age 
                                             AND district_id = $district_id";
                              $objq_sumage = mysqli_query($conn,$sql_sumage);
                              $num_rows_age = mysqli_num_rows($objq_sumage);
                          ?>
                            <tr>
                              <td class="text-right"><?php echo $value_age['name_age']; ?> ปี</td>
                              <td class="text-left"><?php echo $num_rows_age; ?></td>
                            </tr>
                          <?php 
                            endforeach;
                          ?>
                          </tbody>
                        </table>
                      </div>

                      <div class="col-3 col-sm-3 col-md-3 col-xl-3">
                        <table class="table">
                          <thead>
                            <tr>
                              <th width="50%" class="text-left">เศรษฐกิจ</th>
                              <th width="50%" class="text-left"></th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php 
                            $sql_status = "SELECT * FROM question_status";
                            $objq_status = mysqli_query($conn,$sql_status);
                            foreach($objq_status as $value_status):
                              $id_status = $value_status['id_status'];
                              $sql_sumstatus = "SELECT * FROM question WHERE id_status = $id_status 
                                            AND district_id = $district_id";
                              $objq_sumstatus = mysqli_query($conn,$sql_sumstatus);
                              $num_rows_status = mysqli_num_rows($objq_sumstatus);
                          ?>
                            <tr>
                              <td class="text-right"><?php echo $value_status['name_status']; ?></td>
                              <td class="text-left"><?php echo $num_rows_status; ?></td>
                            </tr>
                          <?php 
                            endforeach;
                          ?>
                          </tbody>
                        </table>
                      </div>

                      <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                        <table class="table">
                          <thead>
                            <tr>
                              <th width="16%" class="text-right"></th>
                              <th width="16%" class="text-center">ใช่</th>
                              <th width="16%" class="text-center">%ใช่</th>
                              <th width="16%" class="text-center">ไม่ใช่</th>
                              <th width="16%" class="text-center">%ไม่ใช่</th>
                              <th width="16%" class="text-center">ไม่ตอบ</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th class="text-right">รู้จัก (ทีมงาน)</th>
                              <td class="text-center"><?php echo $num_rows_teamY; ?></td>
                              <td class="text-center"><?php echo $know_team_per+0; ?></td>
                              <td class="text-center"><?php echo $num_rows_teamN; ?></td>
                              <td class="text-center"><?php echo $know_team_perN+0; ?></td>
                              <td class="text-center"><?php echo $num_rows_teamD; ?></td>
                            </tr>
                            <tr>
                              <th class="text-right">ฟังวิทยุ (ทีมงาน)</th>
                              <td class="text-center"><?php echo $num_radio; ?></td>
                              <td class="text-center"><?php echo $radio_per+0;?></td>
                              <td class="text-center"><?php echo $num_rows_radioN; ?></td>
                              <td class="text-center"><?php echo $radio_perN+0;?></td>
                              <td class="text-center"><?php echo $num_rows_radioD; ?></td>
                            </tr>
                            <tr>
                              <th class="text-right">ใช้สินค้า (ทีมงาน)</th>
                              <td class="text-center"><?php echo $num_useproduct; ?></td>
                              <td class="text-center"><?php echo $useproduct_per+0; ?></td>
                              <td class="text-center"><?php echo $num_rows_productN; ?></td>
                              <td class="text-center"><?php echo $useproduct_perN+0; ?></td>
                              <td class="text-center"><?php echo $num_rows_productD; ?></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      
                      <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                        <br>
                        <div class="col-12 text-center">
                          <B><font size="5">จำแนกรายหมู่บ้าน</font></B>
                        </div>
                        <br>
                        <table class="table">
                          <thead>
                            <tr>
                              <th width="12%" class="text-center">หมู่ที่</th>
                              <th width="12%" class="text-center">จำนวน</th>
                              <th width="12%" class="text-center">รู้จัก</th>
                              <th width="12%" class="text-center">%รู้จัก</th>
                              <th width="12%" class="text-center">ฟังวิทยุ</th>
                              <th width="12%" class="text-center">%ฟังวิทยุ</th>
                              <th width="12%" class="text-center">ใช้สินค้า</th>
                              <th width="12%" class="text-center">%ใช้สินค้า</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php 
                            for ($i=1; $i <=30 ; $i++) { 
                              $sql_calvillage = "SELECT * FROM question WHERE address = $i AND district_id = $district_id";
                              $objq_calvillage = mysqli_query($conn,$sql_calvillage);
                              $num_rows_calvillage = mysqli_num_rows($objq_calvillage);
                              if ($num_rows_calvillage == 0) {
                          ?>
                          <?php
                              }else{
                                //num
                                  $know_num = "SELECT * FROM question WHERE district_id = $district_id AND address = $i";
                                  $objq_num = mysqli_query($conn,$know_num);
                                  $num_rows_num = mysqli_num_rows($objq_num);
                                //num

                                 // know_team
                                  $know_teamY = "SELECT * FROM question WHERE know_team = 'Y' AND district_id = $district_id AND address = $i";
                                  $objq_teamY = mysqli_query($conn,$know_teamY);
                                  $num_rows_teamY = mysqli_num_rows($objq_teamY);
                                  $know_team_per = ($num_rows_teamY/$num_rows_num)*100;
                                  $know_team_per = ceil($know_team_per);
                                // know team

                                // know_radio
                                  $know_radio = "SELECT * FROM question WHERE radio_team = 'Y' AND district_id = $district_id AND address = $i";
                                  $objq_radio = mysqli_query($conn,$know_radio);
                                  $num_radio = mysqli_num_rows($objq_radio);
                                  $radio_per = ($num_radio/$num_rows_num)*100;
                                  $radio_per = ceil($radio_per);
                                // know radio

                                // use_product
                                  $know_productY = "SELECT * FROM question WHERE use_product = 'Y' AND district_id = $district_id AND address = $i";
                                  $objq_productY = mysqli_query($conn,$know_productY);
                                  $num_useproduct = mysqli_num_rows($objq_productY);
                                  $useproduct_per = ($num_useproduct/$num_rows_num)*100;
                                  $useproduct_per = ceil($useproduct_per);
                                // use_product
                          ?>
                            <tr>
                              <td class="text-center"><?php echo $i; ?></td>
                              <td class="text-center"><?php echo $num_rows_num; ?></td>
                              <td class="text-center"><?php echo $num_rows_teamY; ?></td>
                              <td class="text-center"><?php echo $know_team_per; ?></td>
                              <td class="text-center"><?php echo $num_radio; ?></td>
                              <td class="text-center"><?php echo $radio_per; ?></td>
                              <td class="text-center"><?php echo $num_useproduct; ?></td>
                              <td class="text-center"><?php echo $useproduct_per; ?></td>
                            </tr>
                          <?php
                              }
                            }
                          ?>
                          </tbody>
                        </table>
                      </div>

                    </div>
                  </div>
                </div>

              </div>
            </form>
          </div>
        </div>
      </section>
    </div>
    <?php require "menu/footer.html"; ?>
    <?php require "menu/script.php"; ?>
  </body>
</html>