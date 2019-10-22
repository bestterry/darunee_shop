<?php
  require "../../config_database/config.php";
  require "../../session.php";

  $id_outside = $_POST['id_outside'];
  $pay_money = $_POST['pay_money'];
  $account_rc = $_POST['account_rc'];
  $date_buy = $_POST['date_buy'];
  $date_data = date("Y-m-d");

  $sql_outside = "SELECT MAX(id_outside_buy) FROM outside_buy_htr WHERE id_outside = $id_outside";
  $objq_outside = mysqli_query($conn,$sql_outside);
  $objr_outside = mysqli_fetch_array($objq_outside);
  $id_max = $objr_outside['MAX(id_outside_buy)'];

  $sql_balance = "SELECT * FROM outside_buy_htr WHERE id_outside_buy = $id_max";
  $objq_balance = mysqli_query($conn,$sql_balance);
  $objr_balance = mysqli_fetch_array($objq_balance);

  $befor_balance = $objr_balance['balance'];
  $after_balance = $befor_balance - $pay_money;

        //-------------------------INSERT outside_buy_htr---------------------------------------
        $insert_outside_htr = "INSERT INTO outside_buy_htr (id_outside, id_product, pay_money, balance, account_rc, date_buy, date_data)
                               VALUE ($id_outside, 35, $pay_money, $after_balance, '$account_rc', '$date_buy', '$date_data')";  
        mysqli_query($conn,$insert_outside_htr);
      //-------------------------/INSERT outside_buy_htr---------------------------------------

  header('location:../outside_list.php?id_outside='.$id_outside);
?>