<?php
  require "../config_database/config.php";
  require "../session.php";
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
                <a class="active" href="salary.php"> เงินได้ </a>
              </div>
            </div>
            <div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <a class="btn button2 pull-right" href="../admin/admin.php"> << เมนูหลัก </a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-sm-12 col-md-12 col-xl-12">
            <div class="box box-primary">
              <div class="box-header with-border text-center"> 
                <B><font size="5">เงินได้</font></B>
              </div>
              <div class="box-body no-padding">
                <div class="mailbox-read-message">
                  <div class="col-12">
                    <table id="example4" class="table">
                      <thead>
                        <tr>
                          <th class="text-center" width="12%">ชื่อ</th>
                          <th class="text-center" width="11%">เงินเดือน</th>
                          <th class="text-center" width="11%">เบี้ยเลี้ยง</th>
                          <th class="text-center" width="11%">ค่าเช่ารถ</th>
                          <th class="text-center" width="11%">ค่าขน</th>
                          <th class="text-center" width="11%">ค่ายก</th>
                          <th class="text-center" width="11%">อื่นๆ</th>
                          <th class="text-center" width="11%">รวม</th>
                          <th class="text-center" width="11%">แก้ไข</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                        $sql_member = "SELECT name,salary FROM member WHERE status_salary = 1";
                        $objq_member = mysqli_query($conn,$sql_member);
                        foreach($objq_member as $value):
                      ?>
                        <tr> 
                          <td class="text-center"><?php echo $value['name'];?></td>
                          <td class="text-center">
                            <input type="number" id="num1" class="text-center form-control" name="salary" value="<?php echo $value['salary'];?>">
                          </td>
                          <td class="text-center">
                            <input type="number" id="num2" class="text-center form-control" name="allowance" value="0">
                          </td> 
                          <td class="text-center">
                            <input type="number" id="num3" class="text-center form-control" name="carrental" value="0">
                          </td>
                          <td class="text-center">
                            <input type="number" id="num4" class="text-center form-control" name="heave" value="0">
                          </td>
                          <td class="text-center">
                            <input type="number" id="num5" class="text-center form-control" name="transport" value="0">
                          </td>
                          <td class="text-center">
                            <input type="number" id="num6" class="text-center form-control" name="etc" value="0">
                          </td>
                          <td class="text-center"></td> 
                          <td class="text-center"></td>
                        </tr>
                        <?php 
                          endforeach;
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="box-footer text-center"> </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  <?php require "menu/script.php"; ?>
  </body>
</html> 