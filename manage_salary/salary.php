<?php
  require "../config_database/config.php";
  require "../session.php";
  require "menu/date.php";
  $month = $_GET['month'];
  $year = $_GET['year'];
  $date = $month.'-'.$year;
  $show_date = "01"."-"."$month"."-"."$year";
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
                <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                  <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                    <a href="../admin/admin.php" class="btn btn-danger pull-left"><< กลับ</a>
                  </div>
                  <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                  <B><font size="5">จัดการเงินเดือน</font> <font size="5" color="red"><?php echo Datethai($show_date); ?></font></B>
                  </div>
                  <div class="col-4 col-sm-4 col-md-4 col-xl-4"></div>
                </div> 
              <div class="box-body no-padding">
                <div class="mailbox-read-message">
                  <div class="col-12">
                    <table id="example4" class="table">
                      <thead>
                        <tr>
                          <th class="text-center" width="20%">ชื่อ</th>
                          <th class="text-center" width="20%">เงินเดือน</th>
                          <th class="text-center" width="20%">หนี้ สนง.</th>
                          <th class="text-center" width="20%">หนี้กองทุน</th>
                          <th class="text-center" width="20%">จัดการ</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                        $sql_member = "SELECT id_member,name,salary FROM member WHERE status_salary = 1";
                        $objq_member = mysqli_query($conn,$sql_member);
                        foreach($objq_member as $value):
                          $id_member = $value['id_member'];

                          // เงินเดือน
                          $sql_salary = "SELECT salary FROM salary_receive WHERE id_member = $id_member AND date = '$date'";
                          $objq_salary = mysqli_query($conn,$sql_salary);
                          if ($objq_salary->num_rows > 0) {
                            $objr_salary = mysqli_fetch_array($objq_salary);
                            $salary = $objr_salary['salary'];
                          }else {
                            $salary = '-';
                          }
                          // เงินเดือน

                          // หนี้ สนง.
                          $sql_debt_office = "SELECT salary FROM salary_receive WHERE id_member = $id_member AND date = '$date'";
                          $objq_debt_office = mysqli_query($conn,$sql_debt_office);
                          if ($objq_debt_office->num_rows > 0) {
                            $objr_debt_office = mysqli_fetch_array($objq_debt_office);
                            $salary = $objr_debt_office['salary'];
                          }else {
                            $salary = '-';
                          }
                          // หนี้ สนง.
                      ?>
                        <tr> 
                          <td class="text-center"><?php echo $value['name'];?></td>
                          <td class="text-center"><?php echo $salary;?></td>
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                          <td class="text-center">
                            <a href="salary_data.php?id_member=<?php echo $id_member?>&month=<?php echo $month; ?>&year=<?php echo $year; ?>">>></a>
                          </td>
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