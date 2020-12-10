<?php 
  require "../../config_database/config.php"; 

   $id_member = $_POST['id_member'];
   $date = $_POST['date'];

   $salary = $_POST['salary'];
   $allowance = $_POST['allowance'];
   $carrental = $_POST['carrental'];
   $heave = $_POST['heave'];
   $transport = $_POST['transport'];
   $etc_receive = $_POST['etc_receive'];

   $social = $_POST['social'];
   $debt_fund = $_POST['debt_fund'];
   $etc_pay = $_POST['etc_pay'];

   $id_debt_office = $_POST['id_debt_office'];
   $total_debt_office = $_POST['total_debt_office'];
   $debt_office = $_POST['debt_office'];
   $owing_debt_office = $_POST['owing_debt_office'];

   $id_debt_fund = $_POST['id_debt_fund'];
   $total_debt_fund = $_POST['total_debt_fund'];
   $debt_fund = $_POST['debt_fund'];
   $owing_debt_fund = $_POST['owing_debt_fund'];

   $id_debt_withdraw = $_POST['id_debt_withdraw'];
   $total_debt_withdraw = $_POST['total_debt_withdraw'];
   $debt_withdraw = $_POST['withdraw'];
   $owing_debt_withdraw = $_POST['owing_debt_withdraw'];

    //update หนี้ค้างจ่าย
    if ($debt_office != 0) {
      $update_debtoffice = "UPDATE salary_debt SET money_debt = $owing_debt_office WHERE id_debt_list = 1 AND id_member = $id_member";
      mysqli_query($conn,$update_debtoffice);   
    }

    if ($debt_fund != 0) {
      $update_debtfund = "UPDATE salary_debt SET money_debt = $owing_debt_fund WHERE id_debt_list = 2 AND id_member = $id_member";
      mysqli_query($conn,$update_debtfund); 
    }

    if ($debt_withdraw != 0) {
      $update_debtdraw = "UPDATE salary_debt SET money_debt = $owing_debt_withdraw WHERE id_debt_list = 3 AND id_member = $id_member";
      mysqli_query($conn,$update_debtdraw); 
    }
    //-Update หนี้ค้างจ่าย

   //เพิ่มประวัติชำระเงิน หนี้สนง.
   $insert_debtoffice = "INSERT INTO salary_debt_history (money_debt_hr, money_debt_owing, id_member, date, id_debt_list)
                         VALUE ($debt_office, $owing_debt_office, $id_member, '$date', 1)";
                         mysqli_query($conn,$insert_debtoffice);
   //-เพิ่มประวัติชำระเงิน หนี้สนง.

  //เพิ่มประวัติชำระเงิน หนี้กองทุน.
  $insert_debtfund = "INSERT INTO salary_debt_history (money_debt_hr, money_debt_owing, id_member, date, id_debt_list)
                      VALUE ($debt_fund, $owing_debt_fund, $id_member, '$date', 2)";
                      mysqli_query($conn,$insert_debtfund);
  //-เพิ่มประวัติชำระเงิน หนี้กองทุน.

  //เพิ่มประวัติชำระเงิน หนี้กองทุน.
  $insert_debtwithdraw = "INSERT INTO salary_debt_history (money_debt_hr, money_debt_owing, id_member, date, id_debt_list)
                          VALUE ($debt_withdraw, $owing_debt_withdraw, $id_member, '$date', 3)";
                          mysqli_query($conn,$insert_debtwithdraw);
  //-เพิ่มประวัติชำระเงิน หนี้กองทุน.

  //เพิ่มประวัติรับเงินเดือน
  $sql_salary_receive = "INSERT INTO salary_receive (id_member, date, salary, allowance, carrental, heave, transport, etc_receive)
                          VALUE ($id_member, '$date', $salary, $allowance, $carrental, $heave, $transport, $etc_receive)";
  mysqli_query($conn,$sql_salary_receive);
  //-เพิ่มประวัติรับเงินเดือน

  //เพิ่มประวัติจ่ายหนี้
  $sql_salary_pay = "INSERT INTO salary_pay(id_member, date, debt_office, debt_fund, social_security, withdraw, etc_pay)
                      VALUE ($id_member, '$date', $debt_office, $debt_fund, $social, $withdraw, $etc_pay)";
  mysqli_query($conn,$sql_salary_pay);
  //-เพิ่มประวัติจ่ายหนี้

?>