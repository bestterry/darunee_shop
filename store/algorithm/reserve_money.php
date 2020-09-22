<?php 
  require "../../config_database/config.php";
  $id_member = $_POST['id_member'];
  $money = $_POST['money'];
  $id_list = $_POST['id_list'];
  $money_befor = $_POST['money_befor'];
  $note = $_POST['note'];
  $total_money = $money_befor - $money;
  $date = $_POST['date'];

  $update_reserve = "UPDATE reserve_money SET money = $total_money WHERE id_member = $id_member";
  mysqli_query($conn,$update_reserve);

   //-------------------------INSERT outside_buy_htr---------------------------------------
   $insert_reserve = "INSERT INTO reserve_history (money, transfer, id_list, id_member, id_member_receive, status, note, date)
   VALUE ($money, $total_money, $id_list, $id_member, $id_member, 4, '$note', '$date')";  
    mysqli_query($conn,$insert_reserve);
    //-------------------------/INSERT outside_buy_htr---------------------------------------

  header('location:../reserve_money.php');
  
?>