<?php 
  require "../../config_database/config.php";
  require "../../session.php";
  $money = $_POST['money'];
  $money_befor = $_POST['money_befor'];
  $note = $_POST['note'];
  $date = $_POST['date'];
  $total_money = $money + $money_befor;

  $update_reserve = "UPDATE reserve_money SET money = $total_money WHERE id_member = 33";
  mysqli_query($conn,$update_reserve);

   //-------------------------INSERT outside_buy_htr---------------------------------------
   $insert_reserve = "INSERT INTO reserve_history (money, id_list, id_member, status, note, date)
   VALUE ($money, 1, 30, 1, '$note', '$date')";  
    mysqli_query($conn,$insert_reserve);
    //-------------------------/INSERT outside_buy_htr---------------------------------------

  header('location:../reserve_money.php');
  
?>