<?php 
  require "menu/date.php";
  require "db_connect.php";
  $conn = connect();
  $district_id = $_POST['district_id'];
  $address = $_POST['address'];
  
  $sql_address = "SELECT district_name,amphur_name FROM tbl_districts 
                  INNER JOIN tbl_amphures ON tbl_districts.amphur_id = tbl_amphures.amphur_id
                  WHERE tbl_districts.district_id = $district_id";
  $objq_address = mysqli_query($conn,$sql_address);
  $objr_address = mysqli_fetch_array($objq_address);

  // know_team
    $know_teamY = "SELECT * FROM question WHERE know_team = 'Y' AND district_id = $district_id AND address = $address";
    $objq_teamY = mysqli_query($conn,$know_teamY);
    $num_rows_teamY = mysqli_num_rows($objq_teamY);

    $know_teamN = "SELECT * FROM question WHERE know_team = 'N' AND district_id = $district_id AND address = $address";
    $objq_teamN = mysqli_query($conn,$know_teamN);
    $num_rows_teamN = mysqli_num_rows($objq_teamN);

    $know_teamD = "SELECT * FROM question WHERE know_team = 'D' AND district_id = $district_id AND address = $address";
    $objq_teamD = mysqli_query($conn,$know_teamD);
    $num_rows_teamD = mysqli_num_rows($objq_teamD);
  // know team

  // know_team
    $know_productY = "SELECT * FROM question WHERE use_product = 'Y' AND district_id = $district_id AND address = $address";
    $objq_productY = mysqli_query($conn,$know_productY);
    $num_rows_productY = mysqli_num_rows($objq_productY);

    $know_productN = "SELECT * FROM question WHERE use_product = 'N' AND district_id = $district_id AND address = $address";
    $objq_productN = mysqli_query($conn,$know_productN);
    $num_rows_productN = mysqli_num_rows($objq_productN);

    $know_productD = "SELECT * FROM question WHERE use_product = 'D' AND district_id = $district_id AND address = $address";
    $objq_productD = mysqli_query($conn,$know_productD);
    $num_rows_productD = mysqli_num_rows($objq_productD);
  // know team

  // know_team
    $know_radioY = "SELECT * FROM question WHERE radio_team = 'Y' AND district_id = $district_id AND address = $address";
    $objq_radioY = mysqli_query($conn,$know_radioY);
    $num_rows_radioY = mysqli_num_rows($objq_radioY);

    $know_radioN = "SELECT * FROM question WHERE radio_team = 'N' AND district_id = $district_id AND address = $address";
    $objq_radioN = mysqli_query($conn,$know_radioN);
    $num_rows_radioN = mysqli_num_rows($objq_radioN);

    $know_radioD = "SELECT * FROM question WHERE radio_team = 'D' AND district_id = $district_id AND address = $address";
    $objq_radioD = mysqli_query($conn,$know_radioD);
    $num_rows_radioD = mysqli_num_rows($objq_radioD);
// know team
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
                          <font size="5">สรุปข้อมูลแบบสอบถาม</font> 
                          <br><br>
                          <font color="red" size="5">หมู่ <?php echo $address; ?> ต.<?php echo $objr_address['district_name'];?>
                           อ.<?php echo $objr_address['amphur_name']; ?></font>
                      </B>
                      <br>
                      <br>
                    </div>
                    <div class="col-2 col-sm-2 col-md-2 col-xl-2"></div>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <div class="mailbox-read-message">
                    <div class="col-12">
                    
                      <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th width="50%" class="text-center">เพศ</th>
                              <th width="50%" class="text-center">จำนวน</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php 
                            $sql_sex = "SELECT * FROM sex";
                            $objq_sex = mysqli_query($conn,$sql_sex);
                            foreach($objq_sex as $value_sex):
                              $id_sex = $value_sex['id_sex'];
                              $sql_sumsex = "SELECT * FROM question WHERE id_sex = $id_sex 
                                            AND district_id = $district_id AND address = $address";
                              $objq_sumsex = mysqli_query($conn,$sql_sumsex);
                              $num_rows_sex = mysqli_num_rows($objq_sumsex);
                          ?>
                            <tr>
                              <td class="text-center"><?php echo $value_sex['sex_name']; ?></td>
                              <td class="text-center"><?php echo $num_rows_sex; ?></td>
                            </tr>
                          <?php 
                            endforeach;
                          ?>
                          </tbody>
                        </table>
                      </div>

                      <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th class="text-center" width="50%">อาชีพ</th>
                              <th class="text-center" width="50%">จำนวน</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                              $sql_career = "SELECT * FROM question_career";
                              $objq_career = mysqli_query($conn,$sql_career);
                              foreach($objq_career as $value_career):
                                $id_career = $value_career['id_career'];
                                $sql_sumcareer = "SELECT * FROM question WHERE id_career = $id_career 
                                              AND district_id = $district_id AND address = $address";
                                $objq_sumcareer = mysqli_query($conn,$sql_sumcareer);
                                $num_rows_career = mysqli_num_rows($objq_sumcareer);
                            ?>
                              <tr>
                                <td class="text-center"><?php echo $value_career['name_career']; ?></td>
                                <td class="text-center"><?php echo $num_rows_career; ?></td>
                              </tr>
                            <?php 
                              endforeach;
                            ?>
                          </tbody>
                        </table>
                      </div>

                      <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th width="50%" class="text-center">อายุ</th>
                              <th width="50%" class="text-center">จำนวน</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php 
                            $sql_age = "SELECT * FROM question_age";
                            $objq_age = mysqli_query($conn,$sql_age);
                            foreach($objq_age as $value_age):
                              $id_age = $value_age['id_age'];
                              $sql_sumage = "SELECT * FROM question WHERE id_age = $id_age 
                                             AND district_id = $district_id AND address = $address";
                              $objq_sumage = mysqli_query($conn,$sql_sumage);
                              $num_rows_age = mysqli_num_rows($objq_sumage);
                          ?>
                            <tr>
                              <td class="text-center"><?php echo $value_age['name_age']; ?></td>
                              <td class="text-center"><?php echo $num_rows_age; ?></td>
                            </tr>
                          <?php 
                            endforeach;
                          ?>
                          </tbody>
                        </table>
                      </div>

                      <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th width="50%" class="text-center">ฐานะ</th>
                              <th width="50%" class="text-center">จำนวน</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php 
                            $sql_status = "SELECT * FROM question_status";
                            $objq_status = mysqli_query($conn,$sql_status);
                            foreach($objq_status as $value_status):
                              $id_status = $value_status['id_status'];
                              $sql_sumstatus = "SELECT * FROM question WHERE id_status = $id_status 
                                            AND district_id = $district_id AND address = $address";
                              $objq_sumstatus = mysqli_query($conn,$sql_sumstatus);
                              $num_rows_status = mysqli_num_rows($objq_sumstatus);
                          ?>
                            <tr>
                              <td class="text-center"><?php echo $value_status['name_status']; ?></td>
                              <td class="text-center"><?php echo $num_rows_status; ?></td>
                            </tr>
                          <?php 
                            endforeach;
                          ?>
                          </tbody>
                        </table>
                      </div>

                      <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                      <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th width="25%" class="text-center">ทีมงาน</th>
                              <th width="25%" class="text-center">ใช่</th>
                              <th width="25%" class="text-center">ไม่ใช่</th>
                              <th width="25%" class="text-center">ไม่ได้ถาม</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td class="text-center">รู้จักทีมงาน</td>
                              <td class="text-center"><?php echo $num_rows_teamY; ?></td>
                              <td class="text-center"><?php echo $num_rows_teamN; ?></td>
                              <td class="text-center"><?php echo $num_rows_teamD; ?></td>
                            </tr>
                            <tr>
                              <td class="text-center">ใช้สินค้าทีมงาน</td>
                              <td class="text-center"><?php echo $num_rows_productY; ?></td>
                              <td class="text-center"><?php echo $num_rows_productN; ?></td>
                              <td class="text-center"><?php echo $num_rows_productD; ?></td>
                            </tr>
                            <tr>
                              <td class="text-center">ฟังวิทยุทีมงาน</td>
                              <td class="text-center"><?php echo $num_rows_radioY; ?></td>
                              <td class="text-center"><?php echo $num_rows_radioN; ?></td>
                              <td class="text-center"><?php echo $num_rows_radioD; ?></td>
                            </tr>
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