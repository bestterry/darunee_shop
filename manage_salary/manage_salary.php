<?php
  require "../config_database/config.php";
  require "../session.php";
  require "menu/date.php";
  $id_member = $_GET['id_member'];
  $month = $_GET['month'];
  $year = $_GET['year'];
  $date = "$month"."-"."$year";
  $date2 = $month-$year;
  $show_date = "01"."-"."$month"."-"."$year";

  $member = "SELECT * FROM member WHERE id_member = $id_member";
  $objq_member = mysqli_query($conn,$member);
  $objr_member = mysqli_fetch_array($objq_member);

  $sql_office = "SELECT * FROM salary_debt WHERE id_member = $id_member AND id_debt_list = 1";
  $objq_office = mysqli_query($conn,$sql_office);
  if ($objq_office->num_rows > 0) {
    $objr_office = mysqli_fetch_array($objq_office);
    $id_debt_office = $objr_office['id_salary_debt'];
    $debt_office = $objr_office['money_debt'];
  }else {
    $id_debt_office = 0;
    $debt_office =0;
  }

  $sql_func = "SELECT * FROM salary_debt WHERE id_member = $id_member AND id_debt_list = 2";
  $objq_func = mysqli_query($conn,$sql_func);
  if ($objq_func->num_rows > 0) {
    $objr_func = mysqli_fetch_array($objq_func);
    $id_debt_func = $objr_func['id_salary_debt'];
    $debt_func = $objr_func['money_debt'];
  }else {
    $id_debt_func = 0;
    $debt_func =0;
  }

  $sql_forward = "SELECT * FROM salary_debt WHERE id_member = $id_member AND id_debt_list = 3";
  $objq_forward = mysqli_query($conn,$sql_forward);
  if ($objq_forward->num_rows > 0) {
    $objr_forward = mysqli_fetch_array($objq_forward);
    $id_debt_forward = $objr_forward['id_salary_debt'];
    $debt_forward = $objr_forward['money_debt'];
  }else {
    $id_debt_forward = 0;
    $debt_forward = 0;
  }
  
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
      <?php 
        $check_salary = "SELECT * FROM member 
                         INNER JOIN salary_receive ON salary_receive.id_member = member.id_member
                         INNER JOIN salary_pay ON salary_pay.id_member = member.id_member
                         WHERE member.id_member = $id_member AND salary_receive.date = '$date'";
        $objq_check_salary = mysqli_query($conn,$check_salary);
          if ($objq_check_salary->num_rows == 0) {
      ?>

        <section class="content">
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-xl-12">
              <div class="box box-primary">

                <div class="box-header with-border text-center"> 
                  <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                      <a href="salary_data.php?id_member=<?php echo $id_member; ?>&month=<?php echo $_GET['month']; ?>&year=<?php echo $_GET['year']; ?>" 
                        class="btn btn-danger pull-left"><< กลับ</a>
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                      <B><font size="5">เงินเดือน </font> <font size="5" color="red"><?php echo $objr_member['name']; ?> <?php echo Datethai($show_date); ?></font></B>
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                    </div>
                  </div>
                </div>
                <form action="algorithm/add_salary.php" class="form-horizontal" method="post" autocomplete="off" name="form1">
                  <div class="box-body no-padding">
                    <div class="mailbox-read-message">
                      
                      <div class="col-12">
                        <div class="row">
                          <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                            <br>
                            <div class="text-center"><B> <font size="4">เงินได้</font> </B></div>
                            <br>
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th class="text-center" width="50%">รายการ</th>
                                  <th class="text-center" width="50%">เงิน</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr> 
                                  <td class="text-center">เงินเดือน</td>
                                  <td class="text-center">
                                    <input type="number" class="form-control text-center" id="เงินเดือน" name="salary" onKeyUp="sumsalary()"
                                          value="<?php echo $objr_member['salary']; ?>">
                                  </td>
                                </tr>
                                <?php
                                  $salary = "SELECT * FROM salary_receive_list WHERE NOT id_salary_receive_list = 1";
                                  $objq_salary = mysqli_query($conn,$salary);
                                  foreach($objq_salary as $value_salary) :
                                ?>
                                  <tr> 
                                    <td class="text-center"><?php echo $value_salary['name_salary_receive']; ?></td>
                                    <td class="text-center">
                                      <input type="number" class="form-control text-center" id="<?php echo $value_salary['name_salary_receive']; ?>" 
                                        onKeyUp="sumsalary()" name="<?php echo $value_salary['name_receive_eng']; ?>" value='0'>
                                    </td>
                                  </tr>
                                <?php 
                                  endforeach;
                                ?>
                                <tr> 
                                  <th class="text-center">รวมเงิน</th>
                                  <th class="text-center">
                                    <input type="number" class="form-control text-center" id="total_salary" value="0" disabled/>
                                  </th>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                            <br>
                            <div class="text-center"><B> <font size="4">เงินจ่าย</font> </B></div>
                            <br>
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th class="text-center" width="50%">รายการ</th>
                                  <th class="text-center" width="50%">เงิน</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                                $pay = "SELECT * FROM salary_pay_list";
                                $objq_pay = mysqli_query($conn,$pay);
                                foreach($objq_pay as $value_pay) :
                              ?>
                                <tr> 
                                  <td class="text-center"><?php echo $value_pay['name_salary_pay']; ?></td>
                                  <td class="text-center">
                                    <input type="number" class="form-control text-center" id="<?php echo $value_pay['name_salary_pay']; ?>" 
                                    onKeyUp="sumsalary()" name="<?php echo $value_pay['name_pay_eng']; ?>" value="0">
                                  </td>
                                </tr>
                              <?php 
                                endforeach;
                              ?>
                                <tr> 
                                  <th class="text-center">รวมเงิน</ะ>
                                  <th class="text-center">
                                    <input type="number" class="form-control text-center" id="total_pay" value="0" disabled/>
                                  </th>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="row">
                          <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                            <br>
                            <div class="text-center"><B> <font size="4">รายการหนี้</font> </B></div>
                            <br>
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th class="text-center" width="25%">รายการหนี้</th>
                                  <th class="text-center" width="25%">ยอดค้าง</th>
                                  <th class="text-center" width="25%">หัก</th>
                                  <th class="text-center" width="25%">คงเหลือ</th>
                                </tr>
                              </thead>
                              <tbody>

                                <!-- หนี้สำนักงาน -->
                                <tr> 
                                  <td class="text-center">หนี้สำนักงาน</td>
                                  <td class="text-center">
                                    <input type="number" class="form-control text-center" name="total_debt_office" id="debt_office" 
                                          value="<?php echo $debt_office; ?>" readonly/>
                                    <input type="hidden" class="form-control text-center" name="id_debt_office" value="1">
                                  </td>
                                  <td class="text-center">
                                    <input type="number" class="form-control text-center" id="pay_debt_office" value="0" readonly/>
                                  </td>
                                  <td class="text-center">
                                    <input type="number" class="form-control text-center" name="owing_debt_office" id="owing_debt_office" value="0" readonly/>
                                  </td>
                                </tr>
                                <!-- //หนี้สำนักงาน -->

                                <!-- หนี้กองทุน -->
                                <tr> 
                                  <td class="text-center">หนี้กองทุน</td>
                                  <td class="text-center">
                                    <input type="number" class="form-control text-center" name="total_debt_fund" id="debt_func" 
                                          value="<?php echo $debt_func; ?>" readonly/>
                                    <input type="hidden" class="form-control text-center" name="id_debt_fund" value="2">
                                  </td>
                                  <td class="text-center">
                                    <input type="number" class="form-control text-center" id="pay_debt_fund" value="0" disabled/>
                                  </td>
                                  <td class="text-center">
                                    <input type="number" class="form-control text-center" name="owing_debt_fund" id="owing_debt_fund" value="0" readonly/>
                                  </td>
                                </tr>
                                <!-- //หนี้กองทุน -->

                                <!-- เบิกล่วงหน้า -->
                                <tr> 
                                  <td class="text-center">เบิกล่วงหน้า</td>
                                  <td class="text-center">
                                    <input type="number" class="form-control text-center" name="total_debt_withdraw" id="debt_forward" 
                                          value="<?php echo $debt_forward; ?>" readonly/>
                                    <input type="hidden" class="form-control text-center" name="id_debt_withdraw" value="3">
                                  </td>
                                  <td class="text-center">
                                    <input type="number" class="form-control text-center" id="pay_debt_withdraw" value="0" disabled/>
                                  </td>
                                  <td class="text-center">
                                    <input type="number" class="form-control text-center" name="owing_debt_withdraw" id="owing_debt_withdraw" value="0" readonly/>
                                  </td>
                                </tr>
                                <!-- //เบิกล่วงหน้า -->

                                <tr> 
                                  <th class="text-center">หนี้คงเหลือ</th>
                                  <th class="text-center"></th>
                                  <th class="text-center"></th>
                                  <th class="text-center"></th>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                            <br>
                            <div class="text-center"><B> <font size="4">รับโอน</font> </B></div>
                            <br>
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th class="text-center" width="50%">รับโอนสุทธิ</th>
                                  <th class="text-center" width="50%">
                                    <input type="text" class="form-control text-center" id="total_money" value="0" disabled/>
                                  </th>
                                </tr>
                              </thead>
                            </table>
                          </div>
                        </div>
                      </div>
                      
                    </div>
                  </div>

                  <div class="box-footer text-center"> 
                    <button type="submit" class="btn btn-success">บันทึก</button>
                    <input type="hidden" name="id_member" value="<?php echo $id_member; ?>">
                    <input type="hidden" name="date" value="<?php echo $date; ?>">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </section>

      <?php
        }else {
          $salary = "SELECT * FROM member 
                     INNER JOIN salary_pay ON member.id_member = salary_pay.id_member
                     INNER JOIN salary_receive ON member.id_member = salary_receive.id_member
                     WHERE member.id_member = $id_member AND salary_receive.date = '$date' AND salary_pay.date = '$date'";
          $objq_salary = mysqli_query($conn,$salary); 
      ?>

        <section class="content">
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-xl-12">
              <?php 
                  $objr_salary = mysqli_fetch_array($objq_salary);
                  $salary = $objr_salary['salary'];
                  $allowance = $objr_salary['allowance'];
                  $carrental = $objr_salary['carrental'];
                  $heave = $objr_salary['heave'];
                  $transport = $objr_salary['transport'];
                  $etc_receive = $objr_salary['etc_receive'];
                  $total_receive = $salary + $allowance + $carrental + $heave + $transport + $etc_receive;
                
                  $social_security = $objr_salary['social_security'];
                  $withdraw = $objr_salary['withdraw'];
                  $debt_office = $objr_salary['debt_office'];
                  $debt_fund = $objr_salary['debt_fund'];
                  $etc_pay = $objr_salary['etc_pay'];
                  $total_pay = $social_security + $withdraw + $debt_fund + $debt_office + $etc_pay;
              ?>
              <div class="box box-primary">

                <div class="box-header with-border text-center"> 
                  <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                      <a href="salary_data.php?id_member=<?php echo $id_member; ?>&month=<?php echo $_GET['month']; ?>&year=<?php echo $_GET['year']; ?>" 
                          class="btn btn-danger pull-left"><< กลับ
                      </a>
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                      <B><font size="5">เงินเดือน </font> <font size="5" color="red"><?php echo $objr_salary['name']; ?> <?php echo Datethai($show_date); ?></font></B>
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                    </div>
                  </div>
                </div>

                <div class="box-body no-padding">
                  <div class="mailbox-read-message">

                    <div class="col-12">
                      <div class="row">

                        <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                          <br>
                          <div class="text-center"><B> <font size="4">เงินได้</font> </B></div>
                          <br>
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th class="text-center" width="50%">รายการ</th>
                                <th class="text-center" width="50%">เงิน</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr> 
                                <td class="text-center">เงินเดือน</td>
                                <td class="text-center"><?php echo $objr_salary['salary']; ?></td>
                              </tr>
                              <tr> 
                              <tr> 
                                <td class="text-center">เบี้ยเลี้ยง</td>
                                <td class="text-center"><?php echo $objr_salary['allowance']; ?></td>
                              </tr>
                              <tr> 
                              <tr> 
                                <td class="text-center">ค่าเช่ารถ</td>
                                <td class="text-center"><?php echo $objr_salary['carrental']; ?></td>
                              </tr>
                              <tr> 
                              <tr> 
                                <td class="text-center">ค่าขน</td>
                                <td class="text-center"><?php echo $objr_salary['heave']; ?></td>
                              </tr>
                              <tr> 
                              <tr> 
                                <td class="text-center">ค่ายก</td>
                                <td class="text-center"><?php echo $objr_salary['transport']; ?></td>
                              </tr>
                              <tr> 
                                <td class="text-center">อื่นๆ</td>
                                <td class="text-center"><?php echo $objr_salary['etc_receive']; ?></td>
                              </tr>
                              <tr> 
                                <th class="text-center">รวมเงิน</ะ>
                                <th class="text-center"><?php echo $total_receive; ?></ะ>
                              </tr>
                            </tbody>
                          </table>
                        </div>

                        <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                          <br>
                          <div class="text-center"><B> <font size="4">เงินจ่าย</font> </B></div>
                          <br>
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th class="text-center" width="50%">รายการ</th>
                                <th class="text-center" width="50%">เงิน</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr> 
                                <td class="text-center">ประกันสังคม</td>
                                <td class="text-center"><?php echo $objr_salary['social_security']; ?></td>
                              </tr>
                              <tr> 
                                <td class="text-center">เบิกล่วงหน้า</td>
                                <td class="text-center"><?php echo $objr_salary['withdraw']; ?></td>
                              </tr>
                              <tr> 
                                <td class="text-center">หนี้สำนักงาน</td>
                                <td class="text-center"><?php echo $objr_salary['debt_office']; ?></td>
                              </tr>
                              <tr> 
                                <td class="text-center">หนี้กองทุน</td>
                                <td class="text-center"><?php echo $objr_salary['debt_fund']; ?></td>
                              </tr>
                              <tr> 
                                <td class="text-center">จ่ายอื่นๆ</td>
                                <td class="text-center"><?php echo $objr_salary['etc_pay']; ?></td>
                              </tr>
                              <tr> 
                                <th class="text-center">รวมเงิน</ะ>
                                <th class="text-center"><?php echo $total_pay; ?></ะ>
                              </tr>
                            </tbody>
                          </table>
                        </div>

                      </div>
                    </div>

                    <div class="col-12">
                      <div class="row">
                        <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                          <br>
                          <div class="text-center"><B> <font size="4">รายการหนี้</font> </B></div>
                          <br>
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th class="text-center" width="25%">รายการหนี้</th>
                                  <th class="text-center" width="25%">ยอดค้าง</th>
                                  <th class="text-center" width="25%">หัก</th>
                                  <th class="text-center" width="25%">คงเหลือ</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                $Sumtotal_debt_hr = 0;
                                $total_debt_owing = 0;
                                $Sumtotal_debt = 0;
                                  $sql_debt_list = "SELECT * FROM salary_debt_list";
                                  $objq_debt_list = mysqli_query($conn,$sql_debt_list);
                                  foreach($objq_debt_list as $value) :
                                    $id_debt_list = $value['id_debt_list'];
                                    $sql_debt = "SELECT * FROM salary_debt_history WHERE id_member = $id_member AND date = '$date' AND id_debt_list = $id_debt_list"; 
                                    $objq_debt = mysqli_query($conn,$sql_debt);
                                    if ($objq_debt->num_rows > 0) {
                                      $objr_debt = mysqli_fetch_array($objq_debt);
                                      $money_debt_hr = $objr_debt['money_debt_hr'];
                                      $money_debt_owing = $objr_debt['money_debt_owing'];
                                      $total_debt = $money_debt_hr + $money_debt_owing;
                                    }else {
                                      $money_debt_hr = 0;
                                      $money_debt_owing = 0;
                                      $total_debt = $money_debt_hr + $money_debt_owing;
                                    }
                                    $Sumtotal_debt = $Sumtotal_debt + $total_debt;
                                    $Sumtotal_debt_hr = $Sumtotal_debt_hr + $money_debt_hr;
                                ?>
                                <tr> 
                                  <td class="text-center"><?php echo $value['name_debt_list']; ?></td>
                                  <td class="text-center"><?php echo $total_debt; ?></td>
                                  <td class="text-center"><?php echo $money_debt_hr; ?></td>
                                  <td class="text-center"><?php echo $money_debt_owing; ?></td>
                                </tr>
                                <?php
                                  endforeach;
                                ?>
                                <tr> 
                                  <th class="text-center">หนี้คงเหลือ</th>
                                  <th class="text-center"><?php echo $Sumtotal_debt; ?></th>
                                  <th class="text-center"><?php echo $Sumtotal_debt_hr; ?></th>
                                  <th class="text-center"><?php echo $Sumtotal_debt-$Sumtotal_debt_hr; ?></th>
                                </tr>
                              </tbody>
                            </table>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-xl-6">
                          <br>
                          <div class="text-center"><B> <font size="4">รับโอน</font> </B></div>
                          <br>
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th class="text-center" width="50%">รับโอนสุทธิ</th>
                                <th class="text-center" width="50%"><?php echo $total_receive - $total_pay; ?></th>
                              </tr>
                            </thead>
                          </table>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>

              </div>
            </div>
          </div>
        </section>

      <?php 
        }
      ?>
    </div>

  <?php require "menu/script.php"; ?>
  <script type="text/javascript">

    function sumsalary() {
      var value1 = parseFloat(document.form1.เงินเดือน.value);
      var value2 = parseFloat(document.form1.เบี้ยเลี้ยง.value);
      var value3 = parseFloat(document.form1.ค่าเช่ารถ.value);
      var value4 = parseFloat(document.form1.ค่าขน.value);
      var value5 = parseFloat(document.form1.ค่ายก.value);
      var value6 = parseFloat(document.form1.อื่นๆ.value);
      document.getElementById("total_salary").value = value1+value2+value3+value4+value5+value6;

      var value7 = parseFloat(document.form1.ประกันสังคม.value);
      var value8 = parseFloat(document.form1.เบิกล่วงหน้า.value);
      var value9 = parseFloat(document.form1.หนี้สำนักงาน.value);
      var value10 = parseFloat(document.form1.หนี้กองทุน.value);
      var value11 = parseFloat(document.form1.จ่ายอื่นๆ.value);
      var value12 = parseFloat(document.getElementById("debt_office").value);
      var value13 = parseFloat(document.getElementById("debt_func").value);
      var value14 = parseFloat(document.getElementById("debt_forward").value);

      document.getElementById("total_pay").value = value7+value8+value9+value10+value11;
      document.getElementById("pay_debt_office").value = value9;
      document.getElementById("pay_debt_fund").value = value10;
      document.getElementById("pay_debt_withdraw").value = value8;
      document.getElementById("owing_debt_office").value = value12-value9;
      document.getElementById("owing_debt_fund").value = value13-value10;
      document.getElementById("owing_debt_withdraw").value = value14-value8;
      document.getElementById('total_money').value = (value1+value2+value3+value4+value5+value6)-(value7+value8+value9+value10+value11);
    }

  </script>
  </body>
</html> 