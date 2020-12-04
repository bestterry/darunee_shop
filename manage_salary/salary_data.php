<?php
  require "../config_database/config.php";
  require "../session.php";
  require "menu/date.php";
  $id_member = $_GET['id_member'];
  $month = $_GET['month'];
  $year = $_GET['year'];
  $date = $month-$year;
  $date2 = "$month"."-"."$year";
  $show_date = "01"."-"."$month"."-"."$year";

  $salary = "SELECT * FROM member 
             INNER JOIN salary_pay ON member.id_member = salary_pay.id_member
             INNER JOIN salary_receive ON member.id_member = salary_receive.id_member
             WHERE member.id_member = $id_member AND salary_receive.date = '$date2' AND salary_pay.date = '$date2'";
  $objq_salary = mysqli_query($conn,$salary); 
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

            <?php 
              if ($objq_salary->num_rows > 0) {
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
                      <a href="salary.php?month=<?php echo $month; ?>&year=<?php echo $year; ?>" class="btn btn-danger pull-left"><< กลับ</a>
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                      <B><font size="5">ชื่อ <?php echo $objr_salary['name']; ?></font></B><br>
                      <B><font size="5">เดือน <?php echo Datethai($show_date); ?></font></B>
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                      <a href="manage_salary.php?id_member=<?php echo $id_member; ?>&month=<?php echo $_GET['month']; ?>&year=<?php echo $_GET['year']; ?>" 
                        class="btn btn-success pull-right">จัดการ</a>
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
                                    $sql_debt = "SELECT * FROM salary_debt_history WHERE id_member = $id_member AND date = '$date2' AND id_debt_list = $id_debt_list"; 
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
            <?php
              }else{
                $sql_datamember = "SELECT name,salary FROM member WHERE id_member = $id_member";
                $objq_datamember = mysqli_query($conn,$sql_datamember);
                $objr_datamember = mysqli_fetch_array($objq_datamember);
            ?>
              <div class="box box-primary">

                <div class="box-header with-border text-center"> 
                  <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                      <a href="salary.php?month=<?php echo $month; ?>&year=<?php echo $year; ?>" class="btn btn-danger pull-left"><< กลับ</a>
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4">
                      <B><font size="5">เดือน  <?php echo Datethai($show_date); ?></font></B><br>
                      <B><font size="5">ชื่อ  <?php echo $objr_datamember['name']; ?></font></B>
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-xl-4 text-right">
                      <a href="#" data-toggle="modal" data-target="#add_debt" class="btn btn-success">เพิ่มรายการหนี้</a>
                      <a href="manage_salary.php?id_member=<?php echo $id_member; ?>&month=<?php echo "$month"; ?>&year=<?php echo "$year"; ?>" 
                        class="btn btn-success">จัดการ</a>
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
                                <td class="text-center"><?php echo $objr_datamember['salary']; ?></td>
                              </tr>
                              <tr> 
                              <tr> 
                                <td class="text-center">เบี้ยเลี้ยง</td>
                                <td class="text-center"><?php  ?></td>
                              </tr>
                              <tr> 
                              <tr> 
                                <td class="text-center">ค่าเช่ารถ</td>
                                <td class="text-center"><?php  ?></td>
                              </tr>
                              <tr> 
                              <tr> 
                                <td class="text-center">ค่าขน</td>
                                <td class="text-center"><?php  ?></td>
                              </tr>
                              <tr> 
                              <tr> 
                                <td class="text-center">ค่ายก</td>
                                <td class="text-center"><?php  ?></td>
                              </tr>
                              <tr> 
                                <td class="text-center">อื่นๆ</td>
                                <td class="text-center"><?php  ?></td>
                              </tr>
                              <tr> 
                                <th class="text-center">รวมเงิน</ะ>
                                <th class="text-center"><?php  ?></ะ>
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
                                <td class="text-center"><?php  ?></td>
                              </tr>
                              <tr> 
                                <td class="text-center">เบิกล่วงหน้า</td>
                                <td class="text-center"><?php  ?></td>
                              </tr>
                              <tr> 
                                <td class="text-center">หนี้สำนักงาน</td>
                                <td class="text-center"><?php  ?></td>
                              </tr>
                              <tr> 
                                <td class="text-center">หนี้กองทุน</td>
                                <td class="text-center"><?php  ?></td>
                              </tr>
                              <tr> 
                                <td class="text-center">จ่ายอื่นๆ</td>
                                <td class="text-center"><?php  ?></td>
                              </tr>
                              <tr> 
                                <th class="text-center">รวมเงิน</ะ>
                                <th class="text-center"><?php  ?></ะ>
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
                                $total_debt_hr = 0;
                                $total_debt_owing = 0;
                                $total_debt = 0;
                                  $sql_debt_list = "SELECT * FROM salary_debt_list";
                                  $objq_debt_list = mysqli_query($conn,$sql_debt_list);
                                  foreach($objq_debt_list as $value) :
                                    $id_debt_list = $value['id_debt_list'];
                                    $sql_debt = "SELECT * FROM salary_debt_history WHERE id_member = $id_member AND date = '$date2' AND id_debt_list = $id_debt_list"; 
                                    $objq_debt = mysqli_query($conn,$sql_debt);
                                    if ($objq_debt->num_rows > 0) {
                                      $objr_debt = mysqli_fetch_array($objq_debt);
                                      $money_debt_hr = $objr_debt['money_debt_hr'];
                                      $money_debt_owing = $objr_debt['money_debt_owing'];
                                    }else {
                                      $money_debt_hr = 0;
                                      $money_debt_owing = 0;
                                    }

                                    $sql_salary_debt = "SELECT * FROM salary_debt WHERE id_debt_list = $id_debt_list AND id_member = $id_member";
                                    $objq_salary_debt = mysqli_query($conn,$sql_salary_debt);
                                    if ($objq_salary_debt->num_rows > 0) {
                                      $objr_salary_debt = mysqli_fetch_array($objq_salary_debt);
                                      $money_debt = $objr_salary_debt['money_debt'];
                                    }else {
                                      $money_debt = 0;
                                    }
                                    $total_debt = $total_debt + $money_debt;
                                    $total_debt_hr = $total_debt_hr + $money_debt_hr;
                                ?>
                                <tr> 
                                  <td class="text-center"><?php echo $value['name_debt_list']; ?></td>
                                  <td class="text-center"><?php echo $money_debt; ?></td>
                                  <td class="text-center"><?php echo $money_debt_hr; ?></td>
                                  <td class="text-center"><?php echo $money_debt - $money_debt_hr; ?></td>
                                </tr>
                                <?php
                                  endforeach;
                                ?>
                                <tr> 
                                  <th class="text-center">หนี้คงเหลือ</th>
                                  <th class="text-center"><?php echo $total_debt; ?></th>
                                  <th class="text-center"><?php echo $total_debt_hr; ?></th>
                                  <th class="text-center"><?php echo $total_debt-$total_debt_hr; ?></th>
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
                                <th class="text-center" width="50%"><?php  ?></th>
                              </tr>
                            </thead>
                          </table>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>

              </div>
            <?php
              }
            ?>

          </div>
        </div>

      </section>
    </div>
    <?php require "menu/script.php"; ?>
  </body>

</html> 

<div class="modal fade" id="add_debt" role="dialog">
        <div class="modal-dialog modal-lg">
          <form action="algorithm/add_debt.php" method="post" class="form-horizontal" autocomplete="off">
            <div class="modal-content">
              <div class="modal-header text-center">
                  <font size="5"><B> เพิ่มรายการหนี้ </B></font>
              </div>
              <div class="modal-body col-md-12 table-responsive mailbox-messages">
                <div class="col-12">
                  <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
                  <div class="col-8 col-sm-8 col-xl-8 col-md-8">

                    <div class="form-group">
                      <label class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label"> รายการหนี้ </label>
                      <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <select name="id_debt_list" class="form-control">
                          <?php 
                            $sql_debt_list = "SELECT * FROM salary_debt_list";
                            $objq_debt_list = mysqli_query($conn,$sql_debt_list);
                            foreach ($objq_debt_list as $value) :
                          ?>
                            <option value="<?php echo $value['id_debt_list'];?>"><?php echo $value['name_debt_list']; ?></option>
                          <?php
                            endforeach;
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label">จำนวนเงิน</label>
                      <div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input type="number" class="form-control" name="money_debt">
                        <input type="hidden" class="form-control" name="id_member" value="<?php echo $id_member; ?>">
                        <input type="hidden" class="form-control" name="month" value="<?php echo $month; ?>">
                        <input type="hidden" class="form-control" name="year" value="<?php echo $year; ?>">
                      </div>
                    </div>

                  </div>
                  <div class="col-2 col-sm-2 col-xl-2 col-md-2"></div>
                </div>
              </div>
              <div class="modal-footer text-center">
                <button type="button" class="btn pull-left button2" data-dismiss="modal"><< ย้อนกลับ </button>
                <button type="submit" class="btn btn-success">บันทึก</button>
              </div>
            </div>
          </form>
        </div>
      </div>