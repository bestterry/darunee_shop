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
        <div class="row">
          <div class="col-12 col-sm-12 col-md-12 col-xl-12">
            <div class="box box-primary">
              <div class="box-header with-border text-center"> 
                <B><font size="5">จัดการเงินเดือน</font></B>
              </div>
              <div class="box-body no-padding">
                <div class="mailbox-read-message">
                  <div class="col-12">
                    <table id="example4" class="table">
                      <thead>
                        <tr>
                          <th class="text-center" width="12%">ชื่อ</th>
                          <th class="text-center" width="11%">เงินเดือน</th>
                          <th class="text-center" width="11%">จัดการ</th>
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